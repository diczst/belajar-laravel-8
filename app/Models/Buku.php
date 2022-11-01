<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'buku';
    public $timestamps = false;
    protected $guarded = ['id'];

    public function isbn(){
        return $this->belongsTo(Isbn::class);
    }

    // menambahkan s berarti jamak (hasMany = memiliki banyak)
    public function ulasans(){
        return $this->hasMany(Ulasan::class);
    }
}
