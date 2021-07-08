<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Category;
// use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    //
    public function index(){
        $categories = Category::latest()->paginate(5);
        $trash_cat = Category::onlyTrashed()->latest()->paginate(3);
        // $categories = DB::table('categories')->latest()->paginate(5);

        // $categories = DB::table('categories')
        //             ->join('users', 'categories.user_id', 'users.id')
        //             ->select('categories.*', 'users.name')
        //             ->latest()->paginate(5);
        return view('admin.category.index', compact('categories', 'trash_cat'));
    }

    public function AddCat(Request $request){
        $validatedData = $request->validate([
            'category_name' => 'required|unique:categories|max:255'
        ],
        [
            'category_name.required' => 'Không được để trống trường "Category name" !',
            'category_name.max' => 'Không được vượt quá 255 kí tự'
        ]
        );
        // Cach thu nhat
        // Category::insert([
        //     'category_name' => $request->category_name,
        //     'user_id' => Auth::user()->id,
        //     // Carbon de lay thoi gian hien tai
        //     'created_at' => Carbon::now(),
        // ]);

        // Query builder
        // $data = array();
        // $data['category_name'] = $request->category_name;
        // $data['user_id'] = Auth::user()->id;
        // DB::table('categories')->insert($data);

        // Cach thu ba
        // $category->created_at = Carbon::now();
        // Khi insert bang cach thu hai thi khong can phai them truong created_at
        $category = new Category();
        $category->category_name = $request->category_name;
        $category->user_id = Auth::user()->id;
        $category->save();
        return Redirect()->back()->with('success', 'Category Inserted Successful');
    }

    public function edit($id){
        $categories = Category::find($id);
        return view('admin.category.edit', compact('categories'));
    }

    public function update(Request $request,$id){
        // $update = Category::find($id);
        // $update->name = $request->category_name;
        // $update->save();

        $update = Category::find($id)->update([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id
        ]);
        return Redirect()->route('all.category')->with('success', 'Category Updated Successful');
    }

    public function softDelete($id){
        $delete = Category::find($id)->delete();
        return Redirect()->back()->with('success', 'Category Soft Deleted Successful');
    }

    public function restore($id){
        $restore = Category::withTrashed()->find($id)->restore();
        return Redirect()->back()->with('success', 'Restore Successful');
    }

    public function delete($id){
        $delete = Category::withTrashed()->find($id)->forceDelete();
        return Redirect()->back()->with('success', 'Delete Successful');
    }
}
