<?php

namespace App\Http\Controllers;

use App\Models\Dishe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Validator;

class AdminDishesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dishes = Dishe::orderBy('id', 'DESC')->get();
        return view('admin.dishes.index', compact('dishes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.dishes.create');
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
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        $input = $request->all();
        if ($file = $request->file('file')) {

            $str = $file->getClientOriginalName();
            $str = str_replace(' ', '_', $str);

            $name = time() . $str;

            $file->move('dishe', $name);

            $input['file'] = "$name";
        }

        // $input = $request->all();
        Dishe::create($input);
        return redirect('/admin/dishes')->with('success', "Add Record Successfully");
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
        $image = Dishe::findOrFail($id);
        return view('admin.dishes.edit', compact('image'));
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
            'file' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        $push = Dishe::findOrFail($id);

        $input = $request->all();

        if ($file = $request->file('file')) {

            $str = $file->getClientOriginalName();
            $str = str_replace(' ', '_', $str);

            $name = time() . $str;

            $file->move('dishe', $name);

            $input['file'] = "$name";

            if ($push->file == "/dishe/") {
            } else {
                if (file_exists(public_path() . $push->file)) {
                    unlink(public_path() . $push->file);
                }
            }
        }

        $push->update($input);

        return  redirect('/admin/dishes')->with('success', "Update Record Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image = Dishe::findOrFail($id);
        if ($image->file == '/dishe/') {
        } else {
            if (file_exists(public_path() . $image->file)) {
                unlink(public_path() . $image->file);
            }
        }
        $image->delete();

        return  Redirect::back()->with('success', "Deleted Record Successfully");
    }


    public function statusUpdate(Request $request)
    {
        $image = Dishe::findOrFail($request->id);

        if ($image) {
            $image->is_active = !$image->is_active; // Toggle the status
            $image->save();

            return response()->json([
                'success' => true,
                'status' => $image->is_active ? 'Show' : 'Hide'
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Id not found!']);
    }
}
