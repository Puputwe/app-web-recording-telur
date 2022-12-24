<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produksi extends Model
{
    use HasFactory;

    use SoftDeletes;
    
    protected $dates = ['deleted_at'];

    protected $table = 'produksi';
    
    protected $fillable = [ 'id_populasi',
                            'id_kandang',
                            'tgl_produksi', 
                            'jml_telur', 
                            'keterangan'];

    public function populasi(){
        return $this->belongsTo(Populasi::class);
    }

    public function kandang(){
        return $this->belongsTo(Kandang::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
