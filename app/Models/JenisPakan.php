<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisPakan extends Model
{
    use HasFactory;

    protected $table = 'jenis_pakan';
    
    protected $fillable = ['id', 'jenis'];

    public function pakan(){
        return $this->hasMany(Pakan::class);
    }
}
