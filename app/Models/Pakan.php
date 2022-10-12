<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pakan extends Model
{
    use HasFactory;

    use SoftDeletes;
    
    protected $dates = ['deleted_at'];

    protected $table = 'pakan';
    
    protected $fillable = [ 'nama', 
                            'jenis',
                            'perusahaan',
                            'stok',
                            'keterangan'];

    public function pakanmasuk(){
        return $this->hasMany(PakanMasuk::class);
    }

    public function pakankeluar(){
        return $this->hasMany(PakanKeluar::class);
    }

    public function recording(){
        return $this->hasMany(Recording::class);
    }
}
