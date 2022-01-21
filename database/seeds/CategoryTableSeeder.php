<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Models\Category::create([
            'name' => 'Komputer'
        ]);

        App\Models\Category::create([
            'name' => 'Tablet'
        ]);

        App\Models\Category::create([
            'name' => 'Smartphone'
        ]);
    }
}
