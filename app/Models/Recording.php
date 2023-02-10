<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recording extends Model
{
    use HasFactory;

    use SoftDeletes;
    
    protected $dates = ['deleted_at'];
    
    protected $table = 'recording';
    
    protected $fillable = [ 'id_users',
                            'id_kandang', 
                            'id_pakan',
                            'tanggal',
                            'tot_telur',
                            'berat_telur',
                            'tot_pakan',
                            'jml_aym',
                            'hd',
                            'fcr'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function kandang(){
        return $this->belongsTo(Kandang::class);
    }
    public function populasi(){
        return $this->belongsTo(Populasi::class);
    }
    public function pakan(){
        return $this->belongsTo(Pakan::class);
    }
}
