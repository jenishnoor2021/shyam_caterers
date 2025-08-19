<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;

class AdminBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Booking::query();

        $query = Booking::query();

        // Apply month filter
        if ($request->filled('month')) {
            try {
                $month = Carbon::parse($request->month);
                $query->whereMonth('event_date', $month->month)
                    ->whereYear('event_date', $month->year);
            } catch (\Exception $e) {
                // Ignore if invalid input
            }
        }

        // Apply specific date filter
        if ($request->filled('date')) {
            try {
                $date = Carbon::parse($request->date)->toDateString();
                $query->whereDate('event_date', $date);
            } catch (\Exception $e) {
                // Ignore if invalid input
            }
        }

        // $booking = $query->latest()->get();
        $booking = $query->orderBy('event_date', 'desc')->get();

        return view('admin.booking.index', compact('booking'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        DB::table('booking_menu_items')->where('booking_id', $id)->delete();
        $booking->delete();

        return  Redirect::back()->with('success', "Deleted Record Successfully");
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids', []);

        if (!empty($ids)) {
            Booking::whereIn('id', $ids)->delete();
            return redirect()->route('admin.booking.index', [
                'month' => $request->month,
                'date' => $request->date,
            ])->with('success', 'Selected bookings deleted successfully.');
        }

        return redirect()->back()->with('error', 'No records selected for deletion.');
    }
}
