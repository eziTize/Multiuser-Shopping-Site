<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Order extends Model
{
    //

use SoftDeletes;

        protected $fillable = [
            'ph_no', 'user_id', 'email', 'address', 'amount'
        ];

        public function user()
	    {
	        return $this->belongsTo('App\User');
	    }
}
