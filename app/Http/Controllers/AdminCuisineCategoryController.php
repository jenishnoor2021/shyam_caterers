<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\CuisineCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AdminCuisineCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = CuisineCategory::orderBy('id', 'DESC')->get();
        return view('admin.cuisinecategory.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cuisinecategory.create');
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
            'category_name' => 'required',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        $request->merge([
            'category_name' => strtoupper($request->category_name)
        ]);

        $input = $request->all();

        if ($file = $request->file('file')) {

            $str = $file->getClientOriginalName();
            $str = str_replace(' ', '_', $str);

            $name = time() . $str;

            $file->move('cusinecategory', $name);

            $input['file'] = "$name";
        }

        CuisineCategory::create($input);
        return redirect('/admin/cuisine_category')->with('success', "Add Record Successfully");
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
        $category = CuisineCategory::findOrFail($id);
        return view('admin.cuisinecategory.edit', compact('category'));
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
            'category_name' => 'required',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        $push = CuisineCategory::findOrFail($id);

        $request->merge([
            'category_name' => strtoupper($request->category_name)
        ]);

        $input = $request->all();

        if ($file = $request->file('file')) {

            $str = $file->getClientOriginalName();
            $str = str_replace(' ', '_', $str);

            $name = time() . $str;

            $file->move('cusinecategory', $name);

            $input['file'] = "$name";

            if ($push->file == "/cusinecategory/") {
            } else {
                if (file_exists(public_path() . $push->file)) {
                    @unlink(public_path() . $push->file);
                }
            }
        }

        $push->update($input);

        return  redirect('/admin/cuisine_category')->with('success', "Update Record Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = CuisineCategory::findOrFail($id);
        if ($category->file == '/cusinecategory/') {
        } else {
            if (file_exists(public_path() . $category->file)) {
                @unlink(public_path() . $category->file);
            }
        }
        $category->delete();

        return  Redirect::back()->with('success', "Deleted Record Successfully");
    }


    public function statusUpdate(Request $request)
    {
        $category = CuisineCategory::findOrFail($request->id);

        if ($category) {
            $category->is_active = !$category->is_active; // Toggle the status
            $category->save();

            return response()->json([
                'success' => true,
                'status' => $category->is_active ? 'Show' : 'Hide'
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Id not found!']);
    }
}
