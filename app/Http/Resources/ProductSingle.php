<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Cart as Cart_main;
use Auth;

class ProductSingle extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $quantity = 0;
        $cart_id = '';

        if(Auth::guard('api')->check()){

        $user_id = auth('api')->user()->id;
        $in_cart = Cart_main::where('user_id', $user_id)->where('product_id', $this->id)->first();
                
                if($in_cart){
                    $quantity = $in_cart->quantity;
                    $cart_id = $in_cart->id;
                }
        }        

         return [

                'id' => $this->id,
                'name' => $this->name,
                'slug' => $this->slug,
                'description' => $this->description,
                'units' => $this->units,
                'price' => $this->price,
                'mrp' => $this->mrp,
                'image' => $this->image,
                'category_name' => $this->category_name,
                'inCart' => $quantity,
                'cartId' => $cart_id
        ];
        
    }
}