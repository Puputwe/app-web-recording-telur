<?php

namespace App\Exports;

use App\Models\Produksi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ProduksiExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Produksi::select(
            'id_kandang',
            'id_populasi',
            'tgl_produksi', 
            'jml_telur', 
             'keterangan')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Kode Kandang',
            'Kode Populasi',
            'Tanggal Produksi', 
            'Jumlah Telur', 
            'Keterangan'
		];
	}
}
