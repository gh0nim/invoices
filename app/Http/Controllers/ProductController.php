<?php

namespace App\Http\Controllers;

use App\Product;
use App\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function show_products()
    {
        return view(
            'products.show_products',
            [
                'products' => Product::all(),
                'sections' => Section::all()

            ]
        );
    }
    public function add_products(Request $request)
    {
        // $section_id=DB::table('products')->select('section_id')->first();
        $validatedData = Product::where('product_name', $request->product_name)->exists();
        if ($validatedData) {
            session()->flash('fail', ' المنتج مسجل مسبقا');
            return redirect('/show_products');
        } elseif ($request->product_name == '') {

            session()->flash('fail', ' اسم المنتج مطلوب');
            return redirect('/show_products');
        } else {
            Product::create([
                'product_name' => $request->product_name,
                'description' => $request->description,
                'section_id' => $request->section_id,
                // 'Created_by' => Auth::user()->name
            ]);
            session()->flash('success', 'تم اضافة المنتج بنجاح');
            return redirect('/show_products');
        }
    }
    public function delete_product(Request $request)
    {
        Product::find($request->product_id)->delete();
        session()->flash('delete_product', 'تم حذف المنتج بنجاح');

        return redirect('/show_products');
    }

    public function edit_products(Request $request)
    {
        // if ($request->section_id == null) {

        // }
        Product::where('id', $request->product_id)
            ->update([
                'product_name' => $request->product_name,
                'section_id' => $request->section_id,
                'description' => $request->description,

            ]);


        session()->flash('update_product', 'تم تعديل المنتج بنجاح');

        return redirect('/show_products');
        // return response($request);
    }
}
