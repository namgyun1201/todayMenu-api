<?php

namespace App\Imports;

use App\Models\Ingredient;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class IngredientImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $ingredient = new Ingredient();

        $ingredient->recipie_id = $row[0];
        $ingredient->name = $row[1];
        $ingredient->capacity = $row[2];
        $ingredient->type_code = $row[3];
        $ingredient->type = $row[4];

        return $ingredient;
    }

    public function startRow(): int
    {
        return 2;
    }
}
