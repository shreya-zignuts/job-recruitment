<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Database\Seeders\CategorySeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run() : void
    {
        Category::create(['name' => 'UI/UX Designer']);
        Category::create(['name' => 'Software Engineer']);
        Category::create(['name' => 'Security Engineer']);
        Category::create(['name' => 'Full stack Engineer']);
        Category::create(['name' => 'DevOps Engineer']);
        Category::create(['name' => 'Data Scientist']);
        Category::create(['name' => 'Q a engineer']);
        Category::create(['name' => 'Game Developer']);
        Category::create(['name' => 'A i engineer']);
        Category::create(['name' => 'Backend Engineer']);
        Category::create(['name' => 'Frontend Engineer']);
        Category::create(['name' => 'Mobile Applications Developers']);

    }
}
