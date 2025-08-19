<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\CuisineItem;
use Illuminate\Http\Request;
use App\Models\CuisineCategory;
use Illuminate\Support\Facades\Redirect;

class AdminCuisineItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $category = CuisineCategory::orderBy('id', 'DESC')->get();
        $query = CuisineItem::orderBy('id', 'DESC');

        if ($request->has('categories_id') && $request->categories_id != '') {
            $query->where('cuisine_category_id', $request->categories_id);
        }

        $items = $query->get();

        return view('admin.cuisineitem.index', compact('items', 'category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = CuisineCategory::orderBy('id', 'DESC')->get();
        return view('admin.cuisineitem.create', compact('category'));
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
            'item_name' => 'required',
            'cuisine_category_id' => 'required',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        $request->merge([
            'item_name' => strtoupper($request->item_name)
        ]);

        $input = $request->all();
        if ($file = $request->file('file')) {

            $str = $file->getClientOriginalName();
            $str = str_replace(' ', '_', $str);

            $name = time() . $str;

            $file->move('cusineitems', $name);

            $input['file'] = "$name";
        }

        // $input = $request->all();
        CuisineItem::create($input);
        return redirect('/admin/cuisine_items')->with('success', "Add Record Successfully");
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
        $category = CuisineCategory::orderBy('id', 'DESC')->get();
        $item = CuisineItem::findOrFail($id);
        return view('admin.cuisineitem.edit', compact('category', 'item'));
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
            // 'file' => 'required',
            'item_name' => 'required',
            'cuisine_category_id' => 'required',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        $push = CuisineItem::findOrFail($id);

        $request->merge([
            'item_name' => strtoupper($request->item_name)
        ]);

        $input = $request->all();

        if ($file = $request->file('file')) {

            $str = $file->getClientOriginalName();
            $str = str_replace(' ', '_', $str);

            $name = time() . $str;

            $file->move('gallery', $name);

            $input['file'] = "$name";

            if ($push->file == "/cusineitems/") {
            } else {
                if (file_exists(public_path() . $push->file)) {
                    unlink(public_path() . $push->file);
                }
            }
        }

        $push->update($input);

        return  redirect('/admin/cuisine_items')->with('success', "Update Record Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = CuisineItem::findOrFail($id);
        if ($item->file == '/cusineitems/') {
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
        $item = CuisineItem::findOrFail($request->id);

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
