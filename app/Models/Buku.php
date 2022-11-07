<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model{
    // use HasFactory; 
    protected $guarded = ['id'];
    public $timestamps = false;

    protected $table = "buku";

    public function kategori(){
        return $this->belongsTo(Kategori::class);
    }
}
