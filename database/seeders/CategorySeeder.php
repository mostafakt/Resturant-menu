<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $grandCat = Category::factory(1)->create(['name' => 'grandCate',
            'parent_id' => null,
            'grand_id' => null]);

         $parentCat = Category::factory(1)->create(['name' => 'parentCate',
            'parent_id' => null,
            'grand_id' => $grandCat[0]->id]);


        $childCat = Category::factory(1)->create(['name' => 'childCate',
            'parent_id' => $parentCat[0]->id,
            'grand_id' => $grandCat[0]->id]);
        Category::factory(5)->create();
    }
}
