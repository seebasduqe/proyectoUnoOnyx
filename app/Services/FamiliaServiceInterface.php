<?php

namespace App\Services;

use App\Models\Familia;

interface FamiliaServiceInterface {


    public function listarFamilias();

    public function traerFamiliaPorId($codigo);

    public function salvarFamilia($familia);

    public function actualizarFamilia($familia, $codigo);

    public function borrarFamilia($codigo);

}