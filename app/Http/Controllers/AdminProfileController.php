<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class AdminProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profiles = Profile::orderBy('id', 'DESC')->get();
        return view('admin.member_profile.index', compact('profiles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.member_profile.create');
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
            'name' => 'required',
            'file' => 'required',
            'image' => 'required',
            'email' => 'required',
            'contact' => 'required|digits:10',
            'whatsapp_no' => 'required|digits:10',
            'address' => 'required',
            'facebook' => 'required',
            'twitter' => 'required',
            'instagram' => 'required',
            'linkdin' => 'required',
            'website' => 'required',
            'map' => 'required',
            'youtube' => 'required',
            'slug' => 'required|string|unique:profiles,slug',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withInput($request->all())->withErrors($validator);
        }

        $name = null;
        if ($file = $request->file('image')) {

            $str = $file->getClientOriginalName();
            $str = str_replace(' ', '_', $str);

            $name = time() . $str;

            $file->move('profile', $name);
        }

        $logo = null;
        if ($file = $request->file('file')) {

            $str = $file->getClientOriginalName();
            $str = str_replace(' ', '_', $str);

            $logo = time() . $str;

            $file->move('profile', $logo);
        }

        $profileData = $request->all();
        $profileData['image'] = $name;
        $profileData['file'] = $logo;
        $profileData['slug'] = Str::slug($request->slug);

        Profile::create($profileData);

        return redirect('admin/profile')->with('success', "Add Record Successfully");
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
        $profile = Profile::findOrFail($id);
        return view('admin.member_profile.edit', compact('profile'));
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
            'name' => 'required',
            // 'file' => 'required',
            // 'image' => 'required',
            'email' => 'required',
            'contact' => 'required|digits:10',
            'whatsapp_no' => 'required|digits:10',
            'address' => 'required',
            'facebook' => 'required',
            'twitter' => 'required',
            'instagram' => 'required',
            'linkdin' => 'required',
            'website' => 'required',
            'map' => 'required',
            'youtube' => 'required',
            'slug' => 'required|string|unique:profiles,slug',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withInput($request->all())->withErrors($validator);
        }

        $company = Profile::findOrFail($id);

        if ($file = $request->file('image')) {

            $str = $file->getClientOriginalName();
            $str = str_replace(' ', '_', $str);

            $name = time() . $str;

            $file->move('profile', $name);

            if ($company->image != '/profile/') {
                if (file_exists(public_path() . $company->image)) {
                    unlink(public_path() . $company->image);
                }
            }

            $company->update([
                'image' => $name ?? '',
            ]);
        }

        if ($file = $request->file('file')) {

            $str = $file->getClientOriginalName();
            $str = str_replace(' ', '_', $str);

            $logo = time() . $str;

            $file->move('profile', $logo);

            if ($company->file != '/profile/') {
                if (file_exists(public_path() . $company->file)) {
                    unlink(public_path() . $company->file);
                }
            }

            $company->update([
                'file' => $logo ?? '',
            ]);
        }

        $input = $request->all();
        $input = $request->except(['file', 'image']);

        $company->update($input);
        return redirect('admin/profile')->with('success', "Update Record Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $companycount = Profile::count();
        if ($companycount == 1) {
            return Redirect::back()->with('error', "You can not delete this record");
        }
        $company = Profile::findOrFail($id);
        if ($company->file != '/profile/') {
            if (file_exists(public_path() . $company->file)) {
                unlink(public_path() . $company->file);
            }
        }
        if ($company->image != '/profile/') {
            if (file_exists(public_path() . $company->image)) {
                unlink(public_path() . $company->image);
            }
        }
        $company->delete();
        return Redirect::back()->with('success', "Delete Record Successfully");
    }

    public function statusUpdate(Request $request)
    {
        $comapny = Profile::find($request->id);

        if ($comapny) {
            $comapny->is_active = !$comapny->is_active; // Toggle the status
            $comapny->save();

            return response()->json([
                'success' => true,
                'status' => $comapny->is_active ? 'Active' : 'De-active'
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Id not found!']);
    }
}
