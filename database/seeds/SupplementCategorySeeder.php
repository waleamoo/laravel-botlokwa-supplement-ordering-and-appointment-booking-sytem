<?php

use Illuminate\Database\Seeder;

class SupplementCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new \App\SupplementCategory([
            'supplement_category_name' => 'Work-out Supplements'
        ]);
        $category->save();
        $category = new \App\SupplementCategory([
            'supplement_category_name' => 'Anti-ageing Supplements'
        ]);
        $category->save();
        $category = new \App\SupplementCategory([
            'supplement_category_name' => 'Skin Supplements'
        ]);
        $category->save();
        
        $category = new \App\SupplementCategory([
            'supplement_category_name' => 'Nutrition Supplements'
        ]);
        $category->save();
        $category = new \App\SupplementCategory([
            'supplement_category_name' => 'Heart Supplements'
        ]);
        $category->save();

        $category = new \App\SupplementCategory([
            'supplement_category_name' => 'Hair Supplements'
        ]);
        $category->save();
        
    }
}
