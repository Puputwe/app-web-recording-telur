<?php

namespace App\Exports;

use App\Models\Recording;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class RecordingAllExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
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
            ->get();
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
