<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Category;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;

class AdminMenuItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $category = Category::orderBy('id', 'DESC')->get();

        $query = MenuItem::orderBy('id', 'DESC');

        if ($request->has('categories_id') && $request->categories_id != '') {
            $query->where('categories_id', $request->categories_id);
        }

        $items = $query->get();

        return view('admin.menu-item.index', compact('items', 'category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::orderBy('id', 'DESC')->get();
        return view('admin.menu-item.create', compact('category'));
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
            'categories_id' => 'required',
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

            $file->move('menuItem', $name);

            $input['file'] = "$name";
        }

        // $input = $request->all();
        MenuItem::create($input);
        return redirect('/admin/menu-item')->with('success', "Add Record Successfully");
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
        $category = Category::orderBy('id', 'DESC')->get();
        $item = MenuItem::findOrFail($id);
        return view('admin.menu-item.edit', compact('category', 'item'));
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
            'item_name' => 'required',
            'categories_id' => 'required',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        $push = MenuItem::findOrFail($id);

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

            if ($push->file == "/menuItem/") {
            } else {
                if (file_exists(public_path() . $push->file)) {
                    unlink(public_path() . $push->file);
                }
            }
        }

        $push->update($input);

        return  redirect('/admin/menu-item')->with('success', "Update Record Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = MenuItem::findOrFail($id);
        if ($item->file == '/menuItem/') {
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
        $item = MenuItem::findOrFail($request->id);

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

    public function importPage()
    {
        return view('admin.menu-item.import');
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
            if (empty(trim($row[0])) || empty(trim($row[1]))) {
                continue;
            }

            $categoryName = trim($row[0]);
            $category = Category::where('category_name', $categoryName)->first();
            if (!$category) {
                continue;
            }

            if ($this->itemExists($category->id, $row[1])) {
                continue;
            }

            $imageUrl = trim($row[2]);
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

                    // Save to public/menuItem
                    $filePath = public_path('menuItem/' . $name);
                    file_put_contents($filePath, $imageContent);

                    $fileName = $name;
                } catch (\Exception $e) {
                    \Log::error("Failed to download image: " . $e->getMessage());
                }
            }

            try {
                MenuItem::create([
                    'categories_id' => $category->id,
                    'item_name' => strtoupper(trim($row[1])),
                    'file' => $fileName,
                    'priority' => $row[3] ? trim($row[3]) : '',
                ]);
            } catch (\Exception $e) {
                \Log::error('Error inserting row: ' . $e->getMessage());
            }
        }

        return back()->with('success', 'Records imported successfully.');
    }

    public function itemExists($category, $name)
    {
        return MenuItem::where(['categories_id' => $category, 'item_name' => $name])->exists();
    }
}
