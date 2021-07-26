<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    //
    public function index(){
        $brands = Brand::latest()->paginate(5);

        return view('admin.brand.index', compact('brands'));
    }

    public function insertBrand(Request $request){
        $validateData = $request->validate([
            'brand_name' => 'required||max:255',
            'brand_img' => 'required||mimes:png,jpg,jpge'
        ]
        );

        // insert
        $brand_img = $request->file('brand_img');
        $brand_name = hexdec(uniqid());
        $brand_ext = strtolower($brand_img->getClientOriginalExtension());
        $img_name = $brand_name . '.' . $brand_ext;
        $up_location = 'image/brand/';
        $last_img = $up_location . $img_name;
        $brand_img->move($up_location, $img_name);

        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_img' => $last_img,
            'created_at' => Carbon::now()
        ]);
        return Redirect()->back()->with('success', 'Brand inserted successfully');
    }

    public function edit($id){
        $brand = Brand::find($id);
        return view('admin.brand.edit', compact('brand'));
    }

    public function updateBrand(Request $request, $id){
        $validateData = $request->validate([
            'brand_name' => 'max:255',
            'brand_img' => 'mimes:png,jpg,jpge'
        ]);

        // insert
        $old_img = $request->old_img;

        $brand_img = $request->file('brand_img');

        if($brand_img){ // Nếu update hình ảnh thì update

            $brand_name = hexdec(uniqid());
            $brand_ext = strtolower($brand_img->getClientOriginalExtension());
            $img_name = $brand_name . '.' . $brand_ext;
            $up_location = 'image/brand/';
            $last_img = $up_location . $img_name;
            $brand_img->move($up_location, $img_name);


            unlink($old_img);
            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'brand_img' => $last_img,
                'created_at' => Carbon::now()
            ]);
            return Redirect()->back()->with('success', 'Brand updated successfully');
        }else{ // chỉ update tên
            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'created_at' => Carbon::now()
            ]);
            return Redirect()->back()->with('success', 'Brand updated successfully');
        }

    }

    public function delete($id){
        $delete_brand = Brand::find($id);

        $old_img = $delete_brand->brand_img;
        unlink($old_img);
        $delete_brand->delete();
        return Redirect()->back()->with('success', 'Brand deleted successfully');
    }
}
