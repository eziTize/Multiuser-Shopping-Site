<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Product;
use App\Cart as Cart_main;
use Auth;

class Cart extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {


        $product = Product::get();
        $user_id = auth('api')->user()->id;
    

        return [

                'cart_id' => $this->id,
                'user_id' => $this->user_id,
                'product' => $product->find($this->product_id)->name,
                'unit_price' => number_format($product->find($this->product_id)->price, 2),
                'quantity' => $this->quantity,
                'total' => number_format(($product->find($this->product_id)->price) * ($this->quantity), 2),
        ];
    }
}
