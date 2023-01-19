<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MovimientosController extends Controller
{
    public function index(){

        return view('movimientos.index');
    }

    public function show($codigo){
        return view('movimientos.show');
    }

    public function formMovimiento(){
        return view('movimientos.new');
    }

    public function create(Request $request){

        $codigo = request('codigo');
        $tipo = request('tipo');

        DB::insert('insert into movimientos(codigo,tipo) values(?,?)', [$codigo, $tipo]);

        return redirect('movimientos');
    }

    public function edit($codigo){

    }

    public function delete($codigo){
        
    }
}
