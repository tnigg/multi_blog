<?php

namespace Database\Seeders;

use App\Models\Category;
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
        $html = new Category();
        $html->name = 'HTML';
        $html->slug = 'html';
        $html->save();

        $php = new Category();
        $php->name = 'PHP';
        $php->slug = 'php';
        $php->save();

        $java = new Category();
        $java->name = 'Java';
        $java->slug = 'java';
        $java->save();
    }
}
