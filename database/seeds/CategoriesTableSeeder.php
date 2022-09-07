<?php

use Illuminate\Database\Seeder;
use App\Category;
use Illuminate\Support\Str;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories=[
            'Antipasti',
            'Primi',
            'Secondi',
            'Contorni',
            'Piatti unici',
        ];

        // Per ogni elemento dell'array creo una nuova riga nel db
        foreach($categories as $category_name){
            $new_category = new Category();
            $new_category->name = $category_name;
            $new_category->slug = Str::slug($category_name, '-');
            $new_category->save();
        }
    }
}
