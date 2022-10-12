<?php

namespace App\Exports;

use App\Models\Populasi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PopulasiExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    protected $id;

    function __construct($id) {
            $this->id = $id;
    }

    public function collection()
    {
        return Populasi::select('kd_ayam', 'tgl_tetas', 'status')->where('id_kandang', $this->id)->get();
    }

    public function headings(): array
    {
        return [
            'Kode Ayam',
            'Tanggal Tetas', 
            'Status'
		];
	}
}
