<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Redirect;
use App\Admin;
use App\Product;
use App\Category;
//use Session;
//use App\Http\Requests;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;


class ProductController extends Controller
{
    /*
    |------------------------------------------------------------------
    |   Product List Page
    |------------------------------------------------------------------
    */
    public function index(Request $request)
    {
        
        //Display Paginated with orderby
        //$products = Product::orderBy('created_at', 'desc')->paginate(8);
        $query = $request->input('product_name');

    
        if($request->get('product_name'))
        {

            $data = Product::where('name', 'like', "%$query%")->paginate(8); //search
        }

        else{

            $data = Product::orderBy('created_at', 'desc')->paginate(8); //normal
        }


        $data = [
            'data' => $data,
            'product' => Product::get(),
            'category' => Category::get(),
            'link' => env('admin').'/products/'
        ];

        return View('admin.products.index',$data);

    }


    /*
    |------------------------------------------------------------------
    |   Product Create page
    |------------------------------------------------------------------
    */

    public function create()
    {
        $data = [
            'data' => new Product,
            'categories' => Category::all(),
            'link' => env('admin').'/products/'
        ];

        return View('admin.products.create',$data);
    }

    /*
    |------------------------------------------------------------------
    |   Product Store
    |------------------------------------------------------------------
    */

    public function store(Request $request)
    {


        $categories = Category::all();
        $data = new Product;

        if($data->validate($request->all(),"create")){
            return Redirect(env('admin').'/products/create')->withErrors($data->validate($request->all(),"create"))->withInput();
        }

        $data->category_name = $request->input('category_name');
        $data->name = $request->input('name');
        $data->description = $request->input('description');
        if($request->input('slug')){

            $data->slug = $request->input('slug');
        }

        else{

            $data->slug = Str::slug($request->input('name'));

        }
        $data->price = $request->input('price');
        $data->mrp = $request->input('mrp');
        $data->units = $request->input('units');

         //Image Upload
        if(request()->image){

            $product_image_new_name = time().'.'.request()->image->getClientOriginalName();
            request()->image->move('uploads/products', $product_image_new_name);
            $data->image = 'uploads/products/'.$product_image_new_name;
        }

        $data->save();


        //Session::flash('success', 'Product created.');

        return Redirect(env('admin').'/products')->with('message','Product Created Successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        //Get Single Product
        //$product = Product::findOrFail($id);

         $product = Product::where('slug', $slug)->firstOrFail();

      //  return new ProductResource($product);

        //return response()->json($product,200);
    }

    /*
    |------------------------------------------------------------------
    |   Product Edit Page
    |------------------------------------------------------------------
    */
    public function edit($id)
    {

          $data = [
            'id' => $id,
            'data' => Product::findOrFail($id),
            'categories' => Category::all(),
            'link' => env('admin').'/products/'
        ];

        return View('admin.products.edit',$data);

    }

    /*
    |------------------------------------------------------------------
    |   Product Update
    |------------------------------------------------------------------
    */
    public function update(Request $request, $id)
    {
        
        $data = Product::findOrFail($id);
        $categories = Category::all();

        $this->validate($request, [
            'name' => 'required', 
            'price' => 'required',
            'category_name' => 'required',
            'slug' =>[
                        Rule::unique('products')->ignore($data->id),
                    ],
        ]);

        $data->category_name = $request->input('category_name');
        $data->name = $request->input('name');
        $data->description = $request->input('description');
        if($request->input('slug')){

            $data->slug = $request->input('slug');
        }

        else{

            $data->slug = Str::slug($request->input('name'));

        }
        
        $data->price = $request->input('price');
        $data->mrp = $request->input('mrp');
        $data->units = $request->input('units');


        //Image Upload
        if(request()->image){

            $product_image_new_name = time().'.'.request()->image->getClientOriginalName();
            request()->image->move('uploads/products', $product_image_new_name);
            $data->image = 'uploads/products/'.$product_image_new_name;
        }

        $data->save();

        return Redirect(env('admin').'/products')->with('message','Product Updated Successfully.');

    }

    /*
    |------------------------------------------------------------------
    |   Product Delete
    |------------------------------------------------------------------
    */

    public function destroy($id)
    {
    
      $data = Product::findOrFail($id);
      $data->delete();

       return Redirect(env('admin').'/products')->with('message','Product Deleted Successfully.');

    }
}
