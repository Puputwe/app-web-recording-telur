<?php

namespace App\Imports;

use App\Models\Produksi;
use App\Models\Kandang;
use App\Models\Populasi;
use Maatwebsite\Excel\Concerns\ToModel;

class ProduksiImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Produksi([
            'id_kandang'    => $row[0],
            'id_populasi'   => $row[1],
            'tgl_produksi'  => $row[2], 
            'jml_telur'     => $row[3], 
            'keterangan'    => $row[4],
        ]);
    }
}
