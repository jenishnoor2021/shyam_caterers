<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Validator;

class AdminEventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::orderBy('id', 'DESC')->get();
        return view('admin.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.events.create');
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
            'file' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'poster' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'event_type' => 'required',
            'detail' => 'required',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        $request->merge([
            'event_type' => strtoupper($request->event_type)
        ]);

        $input = $request->all();
        if ($file = $request->file('file')) {

            $str = $file->getClientOriginalName();
            $str = str_replace(' ', '_', $str);

            $name = time() . $str;

            $file->move('events', $name);

            $input['file'] = "$name";
        }

        if ($file1 = $request->file('poster')) {

            $str1 = $file1->getClientOriginalName();
            $str1 = str_replace(' ', '_', $str1);

            $name1 = time() . $str1;

            $file1->move('events', $name1);

            $input['poster'] = "$name1";
        }

        // $input = $request->all();
        Event::create($input);
        return redirect('/admin/events')->with('success', "Add Record Successfully");
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
        $event = Event::findOrFail($id);
        return view('admin.events.edit', compact('event'));
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
            // 'file' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            // 'poster' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'event_type' => 'required',
            'detail' => 'required',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        $push = Event::findOrFail($id);

        $request->merge([
            'event_type' => strtoupper($request->event_type)
        ]);

        $input = $request->all();

        if ($file = $request->file('file')) {

            $str = $file->getClientOriginalName();
            $str = str_replace(' ', '_', $str);

            $name = time() . $str;

            $file->move('events', $name);

            $input['file'] = "$name";

            if ($push->file == "/events/") {
            } else {
                if (file_exists(public_path() . $push->file)) {
                    @unlink(public_path() . $push->file);
                }
            }
        }

        if ($file1 = $request->file('poster')) {

            $str1 = $file1->getClientOriginalName();
            $str1 = str_replace(' ', '_', $str1);

            $name1 = time() . $str1;

            $file1->move('events', $name1);

            $input['poster'] = "$name1";

            if ($push->poster == "/events/") {
            } else {
                if (file_exists(public_path() . $push->poster)) {
                    @unlink(public_path() . $push->poster);
                }
            }
        }

        $push->update($input);

        return  redirect('/admin/events')->with('success', "Update Record Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image = Event::findOrFail($id);
        if ($image->file == '/events/') {
        } else {
            if (file_exists(public_path() . $image->file)) {
                @unlink(public_path() . $image->file);
            }
        }
        if ($image->poster == '/events/') {
        } else {
            if (file_exists(public_path() . $image->poster)) {
                @unlink(public_path() . $image->poster);
            }
        }
        $image->delete();

        return  Redirect::back()->with('success', "Deleted Record Successfully");
    }


    public function statusUpdate(Request $request)
    {
        $event = Event::findOrFail($request->id);

        if ($event) {
            $event->is_active = !$event->is_active; // Toggle the status
            $event->save();

            return response()->json([
                'success' => true,
                'status' => $event->is_active ? 'Show' : 'Hide'
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Id not found!']);
    }
}
