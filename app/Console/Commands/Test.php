<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Ingredient;
use App\Models\Recipie;
use App\Models\Process;

use App\Imports\IngredientImport;
use App\Imports\RecipieImport;
use App\Imports\ProcessImport;

use Maatwebsite\Excel\Facades\Excel;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // $data = Excel::toCollection(new RecipieImport(), storage_path('app/public/레시피 정보/레시피 기본정보.xlsx'));
        // dd($data[0]);

        // $a = new Ingredient([
        //     'name' => 'a'
        // ]);
        // dd($a);
        // $data = Excel::import(new RecipieImport(), storage_path('app/public/레시피 정보/레시피 기본정보.xlsx'));

        $data = Excel::import(new RecipieImport(), storage_path('app/public/레시피 정보/레시피.xlsx'));
        $data = Excel::import(new IngredientImport(), storage_path('app/public/레시피 정보/레시피 재료.xlsx'));
        $data = Excel::import(new ProcessImport(), storage_path('app/public/레시피 정보/레시피 과정.xlsx'));
        dd($data);

        dd($excel);

    }
}
