<?php

namespace App\Imports;

use App\Models\Recording;
use Maatwebsite\Excel\Concerns\ToModel;

class RecordingImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Recording([
            'id_kandang'    => $row[0],
            'id_pakan'      => $row[1],
            'tanggal'       => $row[2],
            'jml_telur'     => $row[3],
            'berat_telur'   => $row[4],
            'jml_pakan'     => $row[5],
            'ayam_hidup'    => $row[6],
            'ayam_afkir'    => $row[7],
            'ayam_mati'     => $row[8],
            'hd'            => $row[9],
            'fcr'           => $row[10]
        ]);
    }
}
