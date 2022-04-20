<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect(['Earrings','Necklace'])->each(function ($material) {
            ProductCategory::firstOrCreate([
                'category_name'=>$material
            ]);
        });
    }
}
