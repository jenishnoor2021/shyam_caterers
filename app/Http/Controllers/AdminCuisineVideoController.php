<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\CuisineVideo;
use Illuminate\Http\Request;
use App\Models\CuisineCategory;
use Illuminate\Support\Facades\Redirect;

class AdminCuisineVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = CuisineVideo::orderBy('id', 'DESC');
        $items = $query->get();

        return view('admin.cuisinevideo.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cuisinevideo.create');
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
            'file' => 'required|mimes:mp4,mov,avi,wmv',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        $input = $request->all();
        if ($file = $request->file('file')) {

            $str = $file->getClientOriginalName();
            $str = str_replace(' ', '_', $str);

            $name = time() . $str;

            $file->move('cusinevideos', $name);

            $input['file'] = "$name";
        }

        // $input = $request->all();
        CuisineVideo::create($input);
        return redirect('/admin/cuisine_video')->with('success', "Add Record Successfully");
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
        $item = CuisineVideo::findOrFail($id);
        return view('admin.cuisinevideo.edit', compact('item'));
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
            'file' => 'required',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        $push = CuisineVideo::findOrFail($id);

        $input = $request->all();

        if ($file = $request->file('file')) {

            $str = $file->getClientOriginalName();
            $str = str_replace(' ', '_', $str);

            $name = time() . $str;

            $file->move('cusinevideos', $name);

            $input['file'] = "$name";

            if ($push->file == "/cusinevideos/") {
            } else {
                if (file_exists(public_path() . $push->file)) {
                    unlink(public_path() . $push->file);
                }
            }
        }

        $push->update($input);

        return  redirect('/admin/cuisine_video')->with('success', "Update Record Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = CuisineVideo::findOrFail($id);
        if ($item->file == '/cusinevideos/') {
        } else {
            if (file_exists(public_path() . $item->file)) {
                unlink(public_path() . $item->file);
            }
        }
        $item->delete();

        return  Redirect::back()->with('success', "Deleted Record Successfully");
    }


    public function statusUpdate(Request $request)
    {
        $item = CuisineVideo::findOrFail($request->id);

        if ($item) {
            $item->is_active = !$item->is_active; // Toggle the status
            $item->save();

            return response()->json([
                'success' => true,
                'status' => $item->is_active ? 'Show' : 'Hide'
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Id not found!']);
    }
}
