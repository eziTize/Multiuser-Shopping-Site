<?php
use App\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        Category::create([

            		'name' => "Electronics",
                    'slug' => "electronics",
                    'created_at' => new DateTime,
                    'updated_at' => null,

        ]);

                Category::create([

            		'name' => "Electric Fans",
                    'slug' => "electric-fans",
                    'created_at' => new DateTime,
                    'updated_at' => null,

        ]);


                Category::create([

            		'name' => "Sewing Machines",
                    'slug' => "sewing-machines",
                    'created_at' => new DateTime,
                    'updated_at' => null,

        ]);


        Category::create([

            		'name' => "Electric Lights",
                    'slug' => "electric-lights",
                    'created_at' => new DateTime,
                    'updated_at' => null,

        ]);


        Category::create([

            		'name' => "Home Appliances",
                    'slug' => "home-appliances",
                    'created_at' => new DateTime,
                    'updated_at' => null,

        ]);
    }
}
