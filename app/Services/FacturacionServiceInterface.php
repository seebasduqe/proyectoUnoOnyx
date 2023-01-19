<?php

namespace App\Services;

use Symfony\Component\HttpKernel\Event\ControllerArgumentsEvent;

interface FacturacionServiceInterface {

    public function generarIdMovimiento();

    public function leerMovimiento($id_movimiento);

    public function sacarTotal($id_movimiento);

    public function generarFactura($id_movimiento, $nota, $dineroRecibido);

    public function leerFacturaPorId($id_movimiento);

    public function controlarStock($id_movimiento);


    
}