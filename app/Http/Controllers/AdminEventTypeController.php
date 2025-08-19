<?php

namespace App\Http\Controllers;

use App\Models\EventType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Validator;

class AdminEventTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $eventTypes = EventType::orderBy('id', 'DESC')->get();
        return view('admin.event-type.index', compact('eventTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.event-type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'event_name' => 'required',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        $request->merge([
            'event_name' => strtoupper($request->event_name)
        ]);

        $input = $request->all();

        EventType::create($input);
        return redirect('/admin/event-type')->with('success', "Add Record Successfully");
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
        $eventType = EventType::findOrFail($id);
        return view('admin.event-type.edit', compact('eventType'));
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
        $validator = Validator::make($request->all(), [
            'event_name' => 'required',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        $push = EventType::findOrFail($id);

        $request->merge([
            'event_name' => strtoupper($request->event_name)
        ]);

        $input = $request->all();

        $push->update($input);

        return  redirect('/admin/event-type')->with('success', "Update Record Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $eventType = EventType::findOrFail($id);
        $eventType->delete();

        return  Redirect::back()->with('success', "Deleted Record Successfully");
    }


    public function statusUpdate(Request $request)
    {
        $eventType = EventType::findOrFail($request->id);

        if ($eventType) {
            $eventType->is_active = !$eventType->is_active; // Toggle the status
            $eventType->save();

            return response()->json([
                'success' => true,
                'status' => $eventType->is_active ? 'Show' : 'Hide'
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Id not found!']);
    }
}
