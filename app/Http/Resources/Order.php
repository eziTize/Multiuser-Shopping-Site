<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Order extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [

                'id' => $this->id,
                'user_id' => $this->user_id,
                'ph_no' => $this->ph_no,
                'transaction_id' => $this->transaction_id,
                'email' => $this->email,
                'address' => $this->address,
                'amount' => number_format($this->amount, 2),
                'is_delivered' => $this->is_delivered,
                'status' => $this->status,
                'type' => $this->type,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
        ];
    }
}
