<?php

namespace App\Services;
use App\Models\Articulo;

interface ArticuloServiceInterface {

    public function listarArticulos();

    public function filtrarArticuloPorRef($ref);

    public function filtrarPorPrecios($valueRef);

    public function traerPorCodigo($codigo);

    public function salvarArticulo(Articulo $articulo);

    public function actualizarArticulo(Articulo $articulo);

    public function borrarArticulo($codigo);

}