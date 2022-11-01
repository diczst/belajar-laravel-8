<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    use HasFactory;

    protected $table = 'ulasan';
    public $timestamps = false;
    protected $guarded = ['id'];

    public function buku(){
        return $this->belongsTo(Buku::class);
    }
}
