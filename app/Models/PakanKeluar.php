<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PakanKeluar extends Model
{
    use HasFactory;
    
    protected $table = 'pakan_keluar';
    
    protected $fillable = [ 'id_pakan',
                            'jml_pakan', 
                            'tgl_keluar'];

    public function pakan(){
        return $this->belongsTo(Pakan::class);
    }
}
