<?php

namespace App\Http\Controllers;

use Auth;
use App\Product;
use App\Category;
use App\Http\Resources\Product as ProductResource;
use App\Http\Resources\ProductSingle;
use Illuminate\Http\Request;
use App\Http\Requests;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Get Products

        //Display Paginated
        //$products = Product::paginate(8);

        //Display Paginated with orderby
        $products = Product::orderBy('created_at', 'desc')->paginate(8);
        //Display A Few
        //$products = Product::inRandomOrder()->take(8)->get();

        //Display all
       //$products = Product::all();

        // Return Collection as resource
        return ProductResource::collection($products);



    }


    public function rIndex()
    {
        //Get Products

        //Display Paginated
        //$products = Product::paginate(8);

        //Display Paginated with orderby
        $products = Product::inRandomOrder()->take(4)->get();
        //Display A Few
        //$products = Product::inRandomOrder()->take(8)->get();

        //Display all
       //$products = Product::all();

        // Return Collection as resource
        return ProductResource::collection($products);

    }


    public function fIndex()
    {
        //Get Products

        //Display Paginated
        //$products = Product::paginate(8);

        //Display Paginated with orderby
        $products = Product::where('category_name', 'Sanitization')->inRandomOrder()->take(4)->get();
        //Display A Few
        //$products = Product::inRandomOrder()->take(8)->get();

        //Display all
       //$products = Product::all();

        // Return Collection as resource
        return ProductResource::collection($products);

    }


    public function showCat($slug)
    {
        //Get Single Product
        //$product = Product::findOrFail($id);

        $category = Category::where('slug', $slug)->firstOrFail();
        $CName = $category->name;

        $products = Product::all();

         $showCat = $products->where('category_name', $CName);
         $showCat->all();

        return ProductResource::collection($showCat);

        //return response()->json($product,200);
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

/*
        $product = Product::create([
                'name' => $request->name,
                'description' => $request->description,
                'slug' =>  $request->slug,
                'units' => $request->units,
                'price' => $request->price,
                'image' => $request->image,
            ]);

---------------------

       return response()->json([
           'status' => (bool) $product,
         'data'   => $product,
         'message' => $product ? 'Product Created!' : 'Error Creating Product'
      ]);

  */

        $categories = Category::all();

        $product = new Product;


        $product->id = $request->input('product_id');

        $product->category_name = $request->input('category_name');

        $product->name = $request->input('name');
        $product->description = $request->input('description');

        $product->slug = $request->input('slug');

        $product->price = $request->input('price');
        //$product->image = $request->input('image');

        if($product->save()) {

            return new ProductResource($product);

        }

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

        return new ProductSingle($product);

        //return response()->json($product,200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

         $product = Product::findOrFail($id);

         return new ProductResource($product);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //

        $categories = Category::all();

        $product = Product::findOrFail($request->product_id);


        $product->id = $request->input('product_id');
        
        $product->category_name = $request->input('category_name');

        $product->name = $request->input('name');
        $product->description = $request->input('description');

        $product->slug = $request->input('slug');

        $product->price = $request->input('price');
        //$product->image = $request->input('image');

        if($product->save()) {

        return new ProductResource($product);

        }

       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    
  $product = Product::findOrFail($id);

    if($product->delete()) {

            return new ProductResource($product);
        }
    }



}
