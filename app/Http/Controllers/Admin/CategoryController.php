<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Redirect;
use App\Admin;
use App\Category;
use App\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /*
    |------------------------------------------------------------------
    |   Category List Page
    |------------------------------------------------------------------
    */
    public function index(Request $request)
    {
        
        //Display Paginated with orderby
        $categories = Category::orderBy('created_at', 'desc')->paginate(8);
        $query = $request->input('category_name');

    
         if($request->get('category_name'))
        {

            $data = Category::where('name', 'like', "%$query%")->paginate(8); //search

        }

        else{

            $data = Category::orderBy('created_at', 'desc')->paginate(8); //normal
        }


        $data = [
            'data' => $data,
            //'category' => Category::get(),
            'link' => env('admin').'/categories/'
        ];

        return View('admin.categories.index',$data);

    }


    /*
    |------------------------------------------------------------------
    |   Category Create page
    |------------------------------------------------------------------
    */

    public function create()
    {
        $data = [
            'data' => new Category,
           // 'categories' => Category::all(),
            'link' => env('admin').'/categories/'
        ];

        return View('admin.categories.create',$data);
    }

    /*
    |------------------------------------------------------------------
    |   Category Store
    |------------------------------------------------------------------
    */

    public function store(Request $request)
    {

        $data = new Category;

        if($data->validate($request->all(),"create")){
            return Redirect(env('admin').'/categories/create')->withErrors($data->validate($request->all(),"create"))->withInput();
        }

        $data->name = $request->input('name');
        $data->ref_pct = $request->input('ref_pct');

        if($request->input('slug')){

        	$data->slug = $request->input('slug');
        }

        else{

        	$data->slug = Str::slug($request->input('name'));

        }

        $data->save();

        return Redirect(env('admin').'/categories')->with('message','Category Created Successfully.');

    }


    /*
    |------------------------------------------------------------------
    |   Category Edit Page
    |------------------------------------------------------------------
    */
    public function edit($id)
    {

          $data = [
            'id' => $id,
            'data' => Category::findOrFail($id),
            //'categories' => Category::all(),
            'link' => env('admin').'/categories/'
        ];

        return View('admin.categories.edit',$data);

    }

    /*
    |------------------------------------------------------------------
    |   Category Update
    |------------------------------------------------------------------
    */
    public function update(Request $request, $id)
    {
        
        $data = Category::findOrFail($id);
        
        $this->validate($request, [
            'name' => 'required', 
            'slug' =>[
                        Rule::unique('categories')->ignore($data->id),
                    ],
        ]);
  
        $data->name = $request->input('name');
        $data->ref_pct = $request->input('ref_pct');

        if($request->input('slug')){

        	$data->slug = $request->input('slug');
        }

        else{

        	$data->slug = Str::slug($request->input('name'));

        }

        $data->save();

        return Redirect(env('admin').'/categories')->with('message','Category Updated Successfully.');

    }

    /*
    |------------------------------------------------------------------
    |   Category Delete
    |------------------------------------------------------------------
    */

    public function destroy($id)
    {
    
      $data = Category::findOrFail($id);

      $products = Product::where('category_name', $data->name)->get();

      foreach($products as $product){

      	$product->category_name = null;
      	$product->save();

      }

      $data->delete();

       return Redirect(env('admin').'/categories')->with('message','Category Deleted Successfully.');

    }
}
