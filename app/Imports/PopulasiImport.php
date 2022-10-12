<?php

namespace App\Imports;

use App\Models\Populasi;
use Maatwebsite\Excel\Concerns\ToModel;

class PopulasiImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Populasi([
            'id_kandang'    => $row[0],
            'kd_ayam'       => $row[1],
            'tgl_tetas'     => $row[2],
            'status'        => $row[3],
        ]);
    }
}
