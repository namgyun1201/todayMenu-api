<?php

namespace App\Imports;

use App\Models\Recipie;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class RecipieImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $recipie = new Recipie();

        $recipie->name = $row[0];
        $recipie->introduction = $row[1];
        $recipie->type_code = $row[2];
        $recipie->type = $row[3];
        $recipie->time = $row[4];
        $recipie->calorie = $row[5];
        $recipie->capacity = $row[6];
        $recipie->difficulty = $row[7];
        $recipie->price = $row[8];
        $recipie->image_link = $row[9];

        return $recipie;
    }

    public function startRow(): int
    {
        return 2;
    }
}
