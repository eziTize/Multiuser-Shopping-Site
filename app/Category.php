<?php

namespace App;

use Validator;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    
	protected $fillable = [
             'name', 'slug'
        ];


        /*
        |----------------------------------------------------------------
        |   Validation rules
        |----------------------------------------------------------------
        */
            public $rules = array(

                'name'          => 'required',
                'slug'          => 'unique:categories',
            );


        /*
        |----------------------------------------------------------------
        |   Validate data for add & extend & update records
        |----------------------------------------------------------------
        */
        public function validate($data,$type){
           
                $ruleType = $this->rules;

            $validator = Validator::make($data,$ruleType);

            if($validator->fails()){
                return $validator;
            }
        }

		/*
        |----------------------------------------------------------------
        |   Data Relation
        |----------------------------------------------------------------
        */
	    public function products()
	    {
	    	return $this->hasMany('App\Product');
	    }
}