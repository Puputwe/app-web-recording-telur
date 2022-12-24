<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Populasi extends Model
{
    use HasFactory;

    use SoftDeletes;
    
    protected $dates = ['deleted_at'];
    
    protected $table = 'populasi';
    
    protected $fillable = [ 'id_kandang',
                            'kd_ayam',
                            'tgl_tetas',
                            'status_aym'];

    public function kandang(){
        return $this->belongsTo(Kandang::class);
    }
    
    public function produksi(){
        return $this->hasMany(Produksi::class);
    }

    public function recording(){
        return $this->hasMany(Recording::class);
    }
}
