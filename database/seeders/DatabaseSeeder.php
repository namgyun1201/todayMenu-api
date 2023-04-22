<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Imports\IngredientImport;
use App\Imports\RecipieImport;
use App\Imports\ProcessImport;

use Maatwebsite\Excel\Facades\Excel;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Excel::import(new RecipieImport(), storage_path('app/public/recipie_excel/recipie.xlsx'));
        Excel::import(new IngredientImport(), storage_path('app/public/recipie_excel/ingredient.xlsx'));
        Excel::import(new ProcessImport(), storage_path('app/public/recipie_excel/process.xlsx'));
    }
}
