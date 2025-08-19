<?php

namespace App\Http\Controllers;

use App\Models\Functio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Validator;

class AdminFunctionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $functions = Functio::orderBy('id', 'DESC')->get();
        return view('admin.function.index', compact('functions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.function.create');
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
            'function_type' => 'required',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        $request->merge([
            'function_type' => strtoupper($request->function_type)
        ]);

        $input = $request->all();

        Functio::create($input);
        return redirect('/admin/function')->with('success', "Add Record Successfully");
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
        $function = Functio::findOrFail($id);
        return view('admin.function.edit', compact('function'));
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
            'function_type' => 'required',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        $push = Functio::findOrFail($id);

        $request->merge([
            'function_type' => strtoupper($request->function_type)
        ]);

        $input = $request->all();

        $push->update($input);

        return  redirect('/admin/function')->with('success', "Update Record Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $function = Functio::findOrFail($id);
        $function->delete();

        return  Redirect::back()->with('success', "Deleted Record Successfully");
    }


    public function statusUpdate(Request $request)
    {
        $function = Functio::findOrFail($request->id);

        if ($function) {
            $function->is_active = !$function->is_active; // Toggle the status
            $function->save();

            return response()->json([
                'success' => true,
                'status' => $function->is_active ? 'Show' : 'Hide'
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Id not found!']);
    }
}
