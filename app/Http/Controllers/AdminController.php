<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Validator;
use App\Models\User;
use App\Models\Dishe;
use App\Models\Event;
use App\Models\Slider;
use App\Models\Contact;
use App\Models\Gallery;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\CuisineCategory;
use App\Models\CuisineItem;
use App\Models\EventType;
use App\Models\Functio;
use App\Models\MenuItem;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Twilio\Rest\Client;
use Exception;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{

    public function login(Request $req)
    {
        // return $req->input();
        $user = User::where(['username' => $req->username])->first();
        if (!$user || !Hash::check($req->password, $user->password)) {
            return redirect()->back()->with('alert-error', 'Username or password is not matched');
            // return "Username or password is not matched";
        } else {
            if ($user->is_active == 1) {
                Auth::loginUsingId($user->id);
                $req->session()->put('user', $user);
                return redirect('/admin/dashboard');
            } else {
                return redirect()->back()->with('alert-error', 'Your account is not activated. Please contact to administrator!!');
            }
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }

    public function dashboard()
    {
        $countGallery = Gallery::Where('is_active', 1)->count();
        $countEvents = Event::Where('is_active', 1)->count();
        $countFunctions = Functio::Where('is_active', 1)->count();
        $countEventType = EventType::Where('is_active', 1)->count();
        $countCategory = Category::Where('is_active', 1)->count();
        $countMenuItem = MenuItem::Where('is_active', 1)->count();
        $countCuiCate = CuisineCategory::Where('is_active', 1)->count();
        $countCuiItem = CuisineItem::Where('is_active', 1)->count();
        $countContacts = Contact::count();
        $currentMonthEvents = Booking::whereMonth('event_date', Carbon::now()->month)->whereYear('event_date', Carbon::now()->year)->where('event_date', '>=', Carbon::today())->orderBy('event_date', 'ASC')->get();

        return view('admin.index', compact('countGallery', 'countContacts', 'currentMonthEvents', 'countEvents', 'countFunctions', 'countEventType', 'countCategory', 'countMenuItem', 'countCuiCate', 'countCuiItem'));
    }

    public function profiledit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.profile.edit', compact('user'));
    }

    public function profileUpdate(Request $request)
    {
        $user = Session::get('user');
        if (!(Hash::check($request->get('current_password'), $user->password))) {
            // The passwords matches
            return redirect()->back()->with("error", "Your current password does not matches with the password you provided. Please try again.");
        }

        if (strcmp($request->get('current_password'), $request->get('new_password')) == 0) {
            //Current password and new password are same
            return redirect()->back()->with("error", "New Password cannot be same as your current password. Please choose a different password.");
        }

        $validatedData = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:6|confirmed',
        ]);

        //Change Password
        $user = Session::get('user');
        $user->password = bcrypt($request->get('new_password'));
        $user->original_password = $request->get('new_password');
        $user->save();

        return redirect()->back()->with("success", "Password changed successfully !");
    }

    // public function siteHomePage()
    // {
    //     return redirect('/booking-form');
    // }

    public function siteHomePage()
    {
        // return view('auth.login');

        $slider = Slider::where('is_show', 1)->inRandomOrder()->first();
        $eventTypes = Event::where('is_active', 1)->get();
        $dishes = Dishe::where('is_active', 1)->inRandomOrder()->take(3)->get();
        return view('front.index', compact('slider', 'dishes', 'eventTypes'));
    }

    public function about()
    {
        return view('front.about');
    }

    public function gallery()
    {
        $events = Event::where('is_active', 1)->get();

        $eventGalleries = [];

        foreach ($events as $event) {
            $galleries = Gallery::where('events_id', $event->id)
                ->where('is_active', 1)
                ->inRandomOrder()
                ->take(6)
                ->get();

            if ($galleries->isNotEmpty()) {
                $eventGalleries[] = [
                    'event' => $event,
                    'galleries' => $galleries
                ];
            }
        }

        // dd($eventGalleries);

        return view('front.gallery', compact('eventGalleries'));
    }

    public function event($id)
    {
        $event = Event::with('images')->findOrFail($id);
        return view('front.event', compact('event'));
    }

    public function cuisine($id)
    {
        $cuisine = CuisineCategory::with('items')->findOrFail($id);
        return view('front.cuisine', compact('cuisine'));
    }

    public function contact()
    {
        $events = EventType::orderBy('event_name', 'ASC')->get();
        return view('front.contact', compact('events'));
    }

    public function storeContact(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'contact' => 'required',
            'event' => 'required',
            'event_date' => 'required',
            'address' => 'required',
            'venu' => 'required',
            // 'message' => 'required',
            'other_event' => 'required_if:event,other'
        ]);

        // Honeypot check
        if (!empty($request->website)) {
            return back()->withErrors(['error' => 'Bot detected'])->withInput();
        }

        if ($validator->fails()) {
            return Redirect::back()->withInput($request->all())->withErrors($validator);
        }

        // if user selected "Other", replace event with other_event input
        $eventValue = $request->event === 'other' ? $request->other_event : $request->event;

        // dd($request->all());

        // $input = $request->all();
        $input = $request->except(['website']);
        $input['event'] = $eventValue; // overwrite event value
        unset($input['other_event']);  // remove extra field
        Contact::create($input);

        try {
            $twilio = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));

            $body = "New Contact Form Submission\n\n" .
                "Name: {$request->name}\n" .
                "Contact: {$request->contact}\n" .
                "Event: {$request->event}";

            $twilio->messages->create(
                env('OWNER_WHATSAPP'),
                [
                    "from" => env('TWILIO_WHATSAPP_FROM'),
                    "body" => $body
                ]
            );
        } catch (Exception $e) {
            // Log the error for debugging
            Log::error('Twilio send error: ' . $e->getMessage());

            // Optional: Notify admin or display friendly message
            // return redirect()->back()->with("warning", "Contact saved, but failed to send WhatsApp notification.");
        }

        return redirect()->back()->with("success", "Contact request send successfully!");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {}
}
