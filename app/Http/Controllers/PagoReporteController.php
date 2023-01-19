<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FacturacionServiceInterface;

class PagoReporteController extends Controller
{

    protected $facturacionService;

    public function __construct(FacturacionServiceInterface $facturacionService)
    {
        $this->facturacionService = $facturacionService;
    }

    public function ventanillaDePago(){
        return view('pagosYreportes.pago');
    }

    public function reporte(Request $request){

        $id_movimientoSig = $this->facturacionService->generarIdMovimiento();
        $id_movimientoSigInt = intval($id_movimientoSig);
        $id_movimientoInt = --$id_movimientoSigInt;

        $datosFactura = $this->facturacionService->leerFacturaPorId($id_movimientoInt);

        $articulosVendidos = $this->facturacionService->leerMovimiento($id_movimientoInt);

        //verificacion de stock
        $controlStock = $this->facturacionService->controlarStock($id_movimientoInt);

        return view('pagosYreportes.reporte', ['articulosVendidos' => $articulosVendidos, 'datosFactura' => $datosFactura, 'controlStock' => $controlStock]);
    }

    public function createFactura(Request $request){
        
        $dineroRecibido = request('dineroRecibido');
        $nota = request('nota'); 

        $id_movimiento = $this->facturacionService->generarIdMovimiento();

        $this->facturacionService->generarFactura($id_movimiento, $nota, $dineroRecibido);

        return redirect('reporte');
    }
}
