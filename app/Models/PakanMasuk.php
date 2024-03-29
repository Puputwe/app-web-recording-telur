<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PakanMasuk extends Model
{
    use HasFactory;

    
    use SoftDeletes;
    
    protected $dates = ['deleted_at'];
    
    protected $table = 'stok';
    
    protected $fillable = [ 'id_pakan',
                            'jml_pakan', 
                            'tgl_masuk'];

    public function pakan(){
        return $this->belongsTo(Pakan::class);
    }
}
