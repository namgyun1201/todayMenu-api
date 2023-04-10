<?php

namespace App\Imports;

use App\Models\Process;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ProcessImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $process = new Process();

        $process->recipie_id = $row[0];
        $process->position = $row[1];
        $process->description = $row[2];
        $process->image_link = $row[3];
        $process->tip = $row[4];

        return $process;
    }

    public function startRow(): int
    {
        return 2;
    }
}
