<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Booking;
use App\Models\Functio;
use App\Models\Category;
use App\Models\EventType;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Twilio\Rest\Client;

class EventController extends Controller
{
    public function bookingPage()
    {
        return view('front.booking');
    }

    public function contactsFind(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'contact' => 'required',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withInput($request->all())->withErrors($validator);
        }

        $booking = Booking::where('phone_no', $request->contact)->latest()->first();

        if (!$booking) {
            return Redirect::back()->withErrors('Booking not found for this contact number.');
        }

        return redirect()->route('bookings.edit', $booking->id);
    }

    public function create()
    {
        $functions = Functio::where('is_active', 1)->orderBy('function_type', 'ASC')->get();
        $eventtypes = EventType::where('is_active', 1)->orderBy('event_name', 'ASC')->get();
        return view('front.booking-form', compact('functions', 'eventtypes'));
        // return view('layouts.bookings', compact('functions', 'eventtypes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string',
            'phone_no' => 'required|string',
            'email' => 'required|email',
            'address' => 'required|string',
            'venue' => 'required|string',
            'event_type' => 'required|string',
            // 'event_date' => 'required|date',
            'functions' => 'required|array',
            // 'functions.*.type' => 'required|string',
            'functions.*.fun_id' => 'required|exists:functios,id',
            'functions.*.person' => 'required|string',
            'functions.*.datetime' => 'required|date',
            // 'functions.*.rate' => 'required|numeric',
        ]);

        $booking = new Booking();
        $booking->customer_name = $validated['customer_name'];
        $booking->phone_no = $validated['phone_no'];
        $booking->email = $validated['email'];
        $booking->address = $validated['address'];
        $booking->venue = $validated['venue'];
        $booking->event_type = $validated['event_type'];
        // $booking->event_date = $validated['event_date'];
        $booking->function_name = json_encode($validated['functions']);
        $booking->status = 'Pending';
        $booking->save();

        // $message = "Hello {$validated['customer_name']}, your booking has been created successfully for {$validated['event_type']} on {$validated['event_date']}.";
        // $whatsappNumber = '91' . $validated['customer_mobile'];
        // $whatsappNumber = '919913861160';
        // $whatsappLink = "https://wa.me/{$whatsappNumber}?text=" . urlencode($message);

        $twilio = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));

        $body = "New Booking Form Submission\n\n" .
            "Name: {$request->customer_name}\n" .
            "Event: {$request->event}";

        $twilio->messages->create(
            env('OWNER_WHATSAPP'), // Owner's WhatsApp number
            [
                "from" => env('TWILIO_WHATSAPP_FROM'),
                "body" => $body
            ]
        );

        return redirect()->route('bookings.edit', $booking->id)
            ->with('success', 'Booking created successfully.');
    }

    public function edit($id)
    {
        $booking = Booking::findOrFail($id);
        $functions = json_decode($booking->function_name, true);
        $functionOptions = Functio::get();
        $eventtypes = EventType::where('is_active', 1)->orderBy('event_name', 'ASC')->get();

        return view('front.booking-edit', compact('booking', 'functions', 'functionOptions', 'eventtypes'));
        // return view('layouts.bookings-edit', compact('booking', 'functions', 'functionOptions', 'eventtypes'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string',
            'phone_no' => 'required|string',
            'email' => 'required|email',
            'address' => 'required|string',
            'venue' => 'required|string',
            'event_type' => 'required|string',
            // 'event_date' => 'required|date',
            'functions' => 'required|array',
            // 'functions.*.type' => 'required|string',
            'functions.*.fun_id' => 'required|exists:functios,id',
            'functions.*.person' => 'required|string',
            'functions.*.datetime' => 'required|date',
        ]);

        // dd($request->all());

        $booking = Booking::findOrFail($id);
        $booking->update([
            'customer_name' => $validated['customer_name'],
            'phone_no' => $validated['phone_no'],
            'email' => $validated['email'],
            'address' => $validated['address'],
            'venue' => $validated['venue'],
            'event_type' => $validated['event_type'],
            // 'event_date' => $validated['event_date'],
            'function_name' => json_encode($validated['functions']),
        ]);

        // === Update booking_menu_items correctly ===

        // STEP 1: Fetch all current combinations from the DB
        $existing = DB::table('booking_menu_items')
            ->where('booking_id', $booking->id)
            ->get()
            ->map(function ($item) {
                return [
                    'function_id' => $item->function_id,
                    'datetime' => $item->datetime,
                    'person' => $item->person,
                    'items' => $item->items,
                ];
            })->toArray();

        // STEP 2: Prepare new combinations
        $new = collect($validated['functions'])->map(function ($f) {
            return [
                'function_id' => $f['fun_id'],
                'datetime' => $f['datetime'],
                'person' => $f['person'],
            ];
        })->toArray();

        // STEP 3: Compare and find items to delete, preserve, or insert
        $toDelete = array_udiff($existing, $new, function ($a, $b) {
            return $a['function_id'] <=> $b['function_id']
                ?: strcmp($a['datetime'], $b['datetime'])
                ?: strcmp($a['person'], $b['person']);
        });

        $toInsert = array_udiff($new, $existing, function ($a, $b) {
            return $a['function_id'] <=> $b['function_id']
                ?: strcmp($a['datetime'], $b['datetime'])
                ?: strcmp($a['person'], $b['person']);
        });

        // STEP 4: Delete removed ones
        foreach ($toDelete as $del) {
            DB::table('booking_menu_items')
                ->where('booking_id', $booking->id)
                ->where('function_id', $del['function_id'])
                ->where('datetime', $del['datetime'])
                ->where('person', $del['person'])
                ->delete();
        }

        // STEP 5: Insert new ones
        foreach ($toInsert as $ins) {
            DB::table('booking_menu_items')->insert([
                'booking_id' => $booking->id,
                'function_id' => $ins['function_id'],
                'person' => $ins['person'],
                'datetime' => $ins['datetime'],
                'items' => json_encode([]), // or empty array/string
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // return redirect()->route('bookings.edit', $id)->with('success', 'Booking updated!');
        return redirect()->route('menu.preparation', $id)->with('success', 'Booking updated!');
    }

    public function menuPreparation(Booking $booking)
    {
        $eventName = EventType::find($booking->event_type)?->event_name;
        $functions = json_decode($booking->function_name, true);
        $categories = Category::all();
        $items = MenuItem::all();

        $itemsMap = $items->keyBy('id');

        $selectedItemsRaw = DB::table('booking_menu_items')
            ->where('booking_id', $booking->id)
            ->pluck('items', 'function_id');

        $selectedItems = [];

        foreach ($selectedItemsRaw as $func => $json) {
            $selectedItems[$func] = json_decode($json, true);
        }

        return view('front.menu-preparation', compact('booking', 'functions', 'categories', 'items', 'itemsMap', 'selectedItems', 'eventName'));
        // return view('layouts.menu-preparation', compact('booking', 'functions', 'categories', 'items', 'itemsMap', 'selectedItems', 'eventName'));
    }

    public function addItem(Request $request)
    {
        try {
            $request->validate([
                'booking_id' => 'required|integer',
                'function_id' => 'required|integer',
                'person'       => 'required|string', // or integer depending on your schema
                'datetime'     => 'required|date',
                'item_id' => 'required|integer',
                'category_id' => 'required|integer',
            ]);

            $bookingId = $request->booking_id;
            $functionId = $request->function_id;
            $person     = $request->person;
            $datetime   = $request->datetime;
            $itemId = $request->item_id;
            $categoryId = $request->category_id;

            $record = DB::table('booking_menu_items')
                ->where('booking_id', $bookingId)
                ->where('function_id', $functionId)
                ->where('person', $person)
                ->where('datetime', $datetime)
                ->first();

            $items = $record ? json_decode($record->items, true) : [];

            if (!is_array($items)) {
                $items = [];
            }

            $alreadyExists = collect($items)->contains(function ($item) use ($itemId) {
                return isset($item['item_id']) && $item['item_id'] == $itemId;
            });

            if (!$alreadyExists) {
                $items[] = [
                    'item_id' => $itemId,
                    'category_id' => $categoryId,
                ];
            }

            DB::table('booking_menu_items')->updateOrInsert(
                ['booking_id' => $bookingId, 'function_id' => $functionId, 'person' => $person, 'datetime' => $datetime],
                ['items' => json_encode($items), 'updated_at' => now(),]
            );

            $item = MenuItem::with('Categories')->find($itemId);

            return response()->json([
                'success' => true,
                'category_name' => $item->Categories->category_name ?? 'Unknown'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to add item: ' . $e->getMessage()
            ], 500);
        }
    }

    public function removeItem(Request $request)
    {
        // Log::info('Remove item request:', $request->all());

        try {
            $request->validate([
                'booking_id' => 'required|integer',
                'function_id' => 'required|integer',
                'person'       => 'required|string',
                'datetime'     => 'required|date',
                'item_id' => 'required|integer'
            ]);

            $bookingId = $request->booking_id;
            $functionId = $request->function_id;
            $person     = $request->person;
            $datetime   = $request->datetime;
            $itemId = $request->item_id;

            $record = DB::table('booking_menu_items')
                ->where('booking_id', $bookingId)
                ->where('function_id', $functionId)
                ->where('person', $person)
                ->where('datetime', $datetime)
                ->first();

            if (!$record) {
                return response()->json(['success' => false, 'message' => 'No record found']);
            }

            $items = json_decode($record->items, true);
            $items = array_filter($items, function ($item) use ($itemId) {
                return isset($item['item_id']) && $item['item_id'] != $itemId;
            });

            $items = array_values($items);

            DB::table('booking_menu_items')
                ->where('booking_id', $bookingId)
                ->where('function_id', $functionId)
                ->where('person', $person)
                ->where('datetime', $datetime)
                ->update(['items' => json_encode($items), 'updated_at' => now(),]);

            return response()->json([
                'success' => true,
                'message' => 'Item removed successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to remove item: ' . $e->getMessage()
            ], 500);
        }
    }

    public function menuStore(Request $request)
    {
        // Handle PDF generation or database save logic
        // dd($request->all());

        $bookingId = $request->input('booking_id');

        return redirect()->route('menu.pdf', $bookingId)->with('success', 'Menu saved!');
    }

    // public function generatePDF(Booking $booking)
    // {
    //     $items = MenuItem::with('Categories')->get()->keyBy('id');
    //     $menus = DB::table('booking_menu_items')->where('booking_id', $booking->id)->get();
    //     $eventDetails = json_decode($booking->function_name, true);
    //     return Pdf::loadView('front.pdf', compact('booking', 'menus', 'eventDetails', 'items'))->stream('menu.pdf');
    // }

    public function generatePDF(Booking $booking)
    {
        $items = MenuItem::with('Categories')->get()->keyBy('id');
        $menus = DB::table('booking_menu_items')->where('booking_id', $booking->id)->get();
        $eventDetails = json_decode($booking->function_name, true);

        // Build a safe filename
        $partyName = $booking->customer_name ?? '{party_name}'; // adjust if your column is different
        $time = now()->format('Ymd_His');

        // Make it URL/file safe (remove spaces, special chars)
        $partyNameSlug = \Str::slug($partyName, '_');

        $fileName = "shyamcaterers_{$partyNameSlug}_{$time}.pdf";

        return Pdf::loadView('front.pdf', compact('booking', 'menus', 'eventDetails', 'items'))
            ->download($fileName);
    }
}
