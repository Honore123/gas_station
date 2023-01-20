<?php

namespace Database\Seeders;

use App\Models\Material;
use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect(['Tyres','Engine Oil'])->each(function ($material) {
            Material::firstOrCreate([
                'material_type'=>$material
            ]);
        });
    }
}
