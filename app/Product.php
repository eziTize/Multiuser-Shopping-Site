<?php
namespace App;

use Validator;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

        protected $table = "products";
        protected $fillable = [
             'name', 'slug', 'price', 'units', 'description', 'image', 'category_name'
        ];

        /*
        |----------------------------------------------------------------
        |   Validation rules
        |----------------------------------------------------------------
        */
            public $rules = array(

                'name'          => 'required',
                'slug'          => 'unique:products',
                'price'         => 'required',
                'category_name' => 'required',
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

        public function catgeory(){
            return $this->belongsTo('App\Catgeory');
        }

        public function OrderProduct()
        {
           return $this->hasMany('App\OrderProduct');
        }
 }

