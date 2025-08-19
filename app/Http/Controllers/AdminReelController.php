<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Reel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class AdminReelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reels = Reel::orderBy('id', 'DESC')->Paginate(10);
        return view('admin.reels.index', compact('reels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.reels.create');
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
            // 'file' => 'required|mimes:mp4,mov,avi,wmv|max:10240',
            'file' => 'required|mimes:mp4,mov,avi,wmv',
            'poster' => 'required|image|mimes:jpeg,png,jpg,webp|max:10240',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        $input = $request->all();
        if ($file = $request->file('file')) {

            $str = $file->getClientOriginalName();
            $str = str_replace(' ', '_', $str);

            $name = time() . $str;

            $file->move('reels', $name);

            $input['file'] = "$name";
        }

        if ($file1 = $request->file('poster')) {

            $str = $file1->getClientOriginalName();
            $str = str_replace(' ', '_', $str);

            $nameP = time() . $str;

            $file1->move('reels', $nameP);

            $input['poster'] = "$nameP";
        }

        Reel::create($input);
        Session::flash('success', "Record Save Successfully");
        return redirect('admin/reel');
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
        $reel = Reel::findOrFail($id);
        return view('admin.reels.edit', compact('reel'));
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
        $push = Reel::findOrFail($id);

        $validator = Validator::make($request->all(), [
            // 'file' => 'required|mimes:mp4,mov,avi,wmv|max:10240',
            'file' => 'required|mimes:mp4,mov,avi,wmv',
            'poster' => 'required|image|mimes:jpeg,png,jpg,webp|max:10240',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        $input = $request->all();

        if ($file = $request->file('file')) {

            $str = $file->getClientOriginalName();
            $str = str_replace(' ', '_', $str);

            $name = time() . $str;

            $file->move('reels', $name);

            $input['file'] = "$name";

            if (file_exists(public_path() . $push->file)) {
                @unlink(public_path() . $push->file);
            }
        }

        if ($file1 = $request->file('poster')) {

            $str = $file1->getClientOriginalName();
            $str = str_replace(' ', '_', $str);

            $name1 = time() . $str;

            $file1->move('reels', $name1);

            $input['poster'] = "$name1";

            if (file_exists(public_path() . $push->poster)) {
                @unlink(public_path() . $push->poster);
            }
        }

        $push->update($input);
        return redirect('admin/reel');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $push = Reel::findOrFail($id);
        if ($push->file == '/reels/') {
        } else {
            if (file_exists(public_path() . $push->file)) {
                @unlink(public_path() . $push->file);
            }
        }
        if ($push->poster == '/reels/') {
        } else {
            if (file_exists(public_path() . $push->poster)) {
                @unlink(public_path() . $push->poster);
            }
        }
        $push->delete();

        return  Redirect::back();
    }

    public function statusUpdate(Request $request)
    {
        $reel = Reel::find($request->id);

        if ($reel) {
            $reel->is_active = !$reel->is_active; // Toggle the status
            $reel->save();

            return response()->json([
                'success' => true,
                'status' => $reel->is_active ? 'Show' : 'Hide'
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Id not found!']);
    }
}
