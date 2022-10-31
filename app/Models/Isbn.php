<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Isbn extends Model
{
    use HasFactory;

    protected $table = 'isbn';
    public $timestamps = false;
    protected $guarded = ['id'];

    public function buku(){
        return $this->hasOne(Buku::class);
    }
}
