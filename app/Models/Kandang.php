<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kandang extends Model
{
    use HasFactory;

    use SoftDeletes;
    
    protected $dates = ['deleted_at'];

    protected $table = 'kandang';
    
    protected $fillable = [ 'kd_kandang', 
                            'tgl_chickin',
                            'status',
                            'kapasitas'];

    public function populasi(){
        return $this->hasMany(Populasi::class);
    }

    public function produksi(){
        return $this->hasMany(Produksi::class);
    }

    public function pop(){
        return $this->belongsTo(Populasi::class);
    }

    public function recording(){
        return $this->hasMany(Recording::class);
    }
}
