<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;

class AdminCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('id', 'DESC')->get();
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
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

            $file->move('category', $name);

            $input['file'] = "$name";
        }

        Category::create($input);
        return redirect('/admin/category')->with('success', "Add Record Successfully");
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
        $category = Category::findOrFail($id);
        return view('admin.category.edit', compact('category'));
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

        $push = Category::findOrFail($id);

        $request->merge([
            'category_name' => strtoupper($request->category_name)
        ]);

        $input = $request->all();

        if ($file = $request->file('file')) {

            $str = $file->getClientOriginalName();
            $str = str_replace(' ', '_', $str);

            $name = time() . $str;

            $file->move('category', $name);

            $input['file'] = "$name";

            if ($push->file == "/category/") {
            } else {
                if (file_exists(public_path() . $push->file)) {
                    unlink(public_path() . $push->file);
                }
            }
        }

        $push->update($input);

        return  redirect('/admin/category')->with('success', "Update Record Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        if ($category->file == '/category/') {
        } else {
            if (file_exists(public_path() . $category->file)) {
                unlink(public_path() . $category->file);
            }
        }
        $category->delete();

        return  Redirect::back()->with('success', "Deleted Record Successfully");
    }


    public function statusUpdate(Request $request)
    {
        $category = Category::findOrFail($request->id);

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

    public function importPage()
    {
        return view('admin.category.import');
    }

    public function importStore(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx',
        ]);

        $path = $request->file('file')->store('temp');

        $data = Excel::toCollection(null, $path)->first();

        foreach ($data as $key => $row) {

            if ($key == 0) {
                continue;
            }

            // Check required fields - skip row if missing
            if (empty(trim($row[0]))) {
                continue;
            }

            if ($this->categoryExists($row[0])) {
                continue;
            }

            $imageUrl = trim($row[1]);
            $fileName = null;

            if (!empty($imageUrl)) {
                try {
                    $cleanUrl = strtok($imageUrl, '?');

                    $ext = pathinfo(parse_url($cleanUrl, PHP_URL_PATH), PATHINFO_EXTENSION);
                    if (!$ext) {
                        $ext = 'jpg';
                    }

                    $name = time() . '_' . uniqid() . '.' . $ext;

                    // Download image
                    $imageContent = file_get_contents($imageUrl);

                    // Save to public/
                    $filePath = public_path('category/' . $name);
                    file_put_contents($filePath, $imageContent);

                    $fileName = $name;
                } catch (\Exception $e) {
                    \Log::error("Failed to download image: " . $e->getMessage());
                }
            }

            try {
                Category::create([
                    'category_name' => strtoupper(trim($row[0])),
                    'file' => $fileName,
                    'priority' => $row[2] ? trim($row[2]) : '',
                ]);
            } catch (\Exception $e) {
                \Log::error('Error inserting row: ' . $e->getMessage());
            }
        }

        return back()->with('success', 'Records imported successfully.');
    }

    public function categoryExists($name)
    {
        return Category::where(['category_name' => $name])->exists();
    }
}
