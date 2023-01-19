<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class WelcomeController extends Controller
{
    public function index(Request $request){

        $articulos = DB::select('select * from articulos');

        return view('welcome', ['articulos' => $articulos]);
    }
}
