<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use DataTables;

class ProductController extends Controller
{
    public function index(Request $request){
        if($request->ajax()){
         $products = Product::with('category')->get();
        //  dd($products);
         return DataTables::of($products)
         ->addColumn('action',function($product){
            $btn='<a href="product/edit/'.$product->id .'" type="button" class="btn btn-sm btn-info ti-pencil-alt" title="Edit"> Edit</a>
            <a href="product/delete/'.$product->id .'" type="button" class="btn btn-sm btn-danger ti-trash" title="delete"> Delete <br>';
              return  $btn;
             })
        ->editColumn('category',function($product){
            return $product->category->name;
        })
         ->make(true);

        }
        return view('product.index');
     }

     public function create(Request $request)
     {

        $categories = Category::all();

         return view('product.create',compact('categories'));
     }

     public function store(Request $request)
     {
         // validation
     $this->validate($request,[
         'name' => 'required',
         ]);

        $product = new Product();
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->save();
        return redirect()->route('product.index')->with('success','Product created successfully!');
     }

     public function edit($id)
     {
         $data = Product::with('category')->find($id);
         $categories = Category::all();

         return view('product.edit',compact('data','categories'));
     }


     public function update(Request $request ,$id)
     {
     // validation
     $this->validate($request,[
         'name' => 'required',
         ]);

        $product = Product::find($id);
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->save();
        return redirect()->route('product.index')->with('success','Product updated successfully!');
     }
     public function delete($id)
    {
        $data = Product::find($id);
        $data->delete();
        return redirect()->route('product.index')->with('success','Product deleted successfully!');

    }
}
