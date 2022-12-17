<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use DataTables;

class CategoryController extends Controller
{

    public function index(Request $request){
        if($request->ajax()){
         $categories = Category::get();
         return DataTables::of($categories)
         ->addColumn('action',function($category){
            $btn='<a href="category/edit/'.$category->id .'" type="button" class="btn btn-sm btn-info ti-pencil-alt" title="Edit"> Edit</a>
            <a href="category/delete/'.$category->id .'" type="button" class="btn btn-sm btn-danger ti-trash" title="delete"> Delete <br>';
              return  $btn;
             })
         ->make(true);

        }
        return view('category.index');
     }
    public function create(Request $request)
    {

        return view('category.create');
    }
    public function store(Request $request)
    {
        // validation
    $this->validate($request,[
        'name' => 'required',
        ]);

       $category = new Category();
       $category->name = $request->name;
       $category->save();
       return redirect()->route('category.index')->with('success','Category created successfully!');
    }
    public function edit($id)
    {
        $data = Category::find($id);
        return view('category.edit',compact('data'));
    }

    public function update(Request $request ,$id)
    {
    // validation
    $this->validate($request,[
        'name' => 'required',
        ]);

       $category = Category::find($id);
       $category->name = $request->name;
       $category->save();
       return redirect()->route('category.index')->with('success','Category updated successfully!');
    }

    public function delete($id)
    {
        $data = Category::find($id);
        $data->delete();
        return redirect()->route('category.index')->with('success','Category deleted successfully!');

    }
}
