<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(){
    	return "Halo saya dari method index(), class BookController";
    }
}
