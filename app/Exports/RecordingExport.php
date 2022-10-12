<?php

namespace App\Exports;

use App\Models\Recording;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class RecordingExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    protected $id;

    function __construct($id) {
            $this->id = $id;
    }

    public function collection()
    {
        return Recording::select(
        'id_kandang',
        'id_pakan',
        'tanggal',
        'jml_telur',
        'berat_telur',
        'jml_pakan',
        'ayam_hidup',
        'ayam_afkir',
        'ayam_mati',
        'hd',
        'fcr')
        ->where('id_kandang', $this->id)->get();
    }

    public function headings(): array
    {
        return [
            'Kode Kandang',
            'Kode Pakan',
            'Tanggal', 
            'Jumlah Telur', 
            'Berat Telur', 
            'Jumlah Pakan',
            'Ayam Hidup',
            'Ayam Afkir',
            'Ayam Mati',
            'HDP',
            'FCR'
		];
	}

}
