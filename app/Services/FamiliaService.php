<?php

namespace App\Services;

use App\Models\Familia;
use Illuminate\Support\Facades\DB;

class FamiliaService implements FamiliaServiceInterface {

    protected $familia;

    public function __construct(Familia $familia)
    {
            $this->familia = $familia;
    }


    public function listarFamilias()
    {
        $familias = Familia::all();

        return $familias;
    }


    public function traerFamiliaPorId($codigo)
    {
        $familia = DB::select('select * from familias where codigo = ?', [$codigo]);
        return $familia;
    }


    public function salvarFamilia($familia)
    {

        $articuloVerificado = DB::select('select codigo from familias where (codigo = ? or nombre = ?)', [$familia->codigo, $familia->nombre]);

        $exitoOperacion = true;

        if($articuloVerificado){
            $exitoOperacion = false;
        } else {
            $familia->save();
        }

        return $exitoOperacion;
    }

    public function actualizarFamilia($familia, $codigo)
    {
        $familiaActualizada = DB::table('familias')
                                ->where('codigo', $familia->codigo)
                                ->update(['codigo' =>  $familia->codigo, 'nombre' => $familia->nombre, 'descripcion' => $familia->descripcion]);
        
    }

    public function borrarFamilia($codigo)
    {
        DB::table('familias')->where('codigo', $codigo)->delete();
    }
}
