<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class produk extends Model
{
    use HasFactory;
    protected $table='produk';
    protected $guarded=['id'];
    public function kategori(){
        return $this->hasOne(Kategori::class,'id','id_Kategori');
    }
}
