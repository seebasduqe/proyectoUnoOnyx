<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use App\Services\FacturacionServiceInterface;

class FacturacionController extends Controller
{


    protected $facturacionService;

    public function __construct(FacturacionServiceInterface $facturacionService)
    {
        $this->facturacionService = $facturacionService;
    }


    public function index(){
        
        //Aqui traigo el id del movimiento presente
        $id_movimiento = $this->facturacionService->generarIdMovimiento();

        //listamos el movimiento completo
        $articulosDelCarrito = $this->facturacionService->leerMovimiento($id_movimiento);

        //sacamos el total del movimiento de la suma de los subtotal 
        $total = $this->facturacionService->sacarTotal($id_movimiento);


        return view('facturacion.index', ['articulosDelCarrito' => $articulosDelCarrito, 'total' => $total]);
    }

    public function recibirArticulos($codigo,){

        //Consulta para determinar el ultimo movimiento, para empezar uno nuevo
        $id_movimiento = $this->facturacionService->generarIdMovimiento();

        
        //Determinar si ya esta el articulo en el movimiento, si está se suma una vez en cantidad, sino esta se agrega y se deja cantidad por defecto en 1

        if(DB::table('articulos_por_movimientos')->where('codigo_producto', $codigo)->where('id_movimiento', $id_movimiento)->exists()){

            DB::table('articulos_por_movimientos')->where('codigo_producto', $codigo)->where('id_movimiento', $id_movimiento)->increment('cantidad');

            $cantidadDB = DB::select('select cantidad from articulos_por_movimientos where codigo_producto = ?', [$codigo]);
            $articulodb = DB::select('select precioVenta from articulos where codigo = ?', [$codigo]);

            foreach($cantidadDB as $item){
                $cantidad = $item->cantidad;
            }

            foreach($articulodb as $item){
                $precioVenta = $item->precioVenta;
            }

            $subtotal = $cantidad * $precioVenta;

            DB::update('update articulos_por_movimientos set subtotal = ? where codigo_producto = ?', [$subtotal,$codigo]);

        } else {


            $articulodb = DB::select('select precioVenta from articulos where codigo = ?', [$codigo]);

            foreach($articulodb as $item){
                $precioVenta = $item->precioVenta;
            }

            DB::insert('insert into articulos_por_movimientos(id_movimiento, codigo_producto, cantidad, subtotal) values(?, ?, ?, ?)', [$id_movimiento, $codigo, 1, $precioVenta]);
        }

        return redirect('/');
    }

    public function formEdit($codigo){

        $articulo = DB::select('select a.codigo, a.nombre, am.cantidad from articulos_por_movimientos am cross join articulos a where (am.codigo_producto = ? and am.codigo_producto = a.codigo)', [$codigo]);

        foreach($articulo as $item){
            $codigo = $item->codigo;
            $nombre = $item->nombre;
            $cantidad = $item->cantidad;
        }

        return view('facturacion.editFacturacion', ['codigo' => $codigo, 'nombreArticulo' => $nombre, 'cantidad' => $cantidad]);
    }

    public function edit(Request $request, $codigo_producto){

        $cantidad= request('cantidad');
      
        $precioDB = DB::select('select precioVenta from articulos where codigo = ?', [$codigo_producto]);

        foreach($precioDB as $item){
            $precio = $item->precioVenta;
        }

        $subtotal = $cantidad * $precio;

        DB::table('articulos_por_movimientos')->where('codigo_producto', $codigo_producto)->update(['cantidad' => $cantidad, 'subtotal' => $subtotal]);

        return redirect('facturacion');
    }

    public function delete($id){

        DB::table('articulos_por_movimientos')->where('id', $id)->delete();
        return redirect('facturacion');
    }

}
