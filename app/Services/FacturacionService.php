<?php

namespace App\Services;

use App\Models\Facturacion;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class FacturacionService implements FacturacionServiceInterface {


    public function generarIdMovimiento(){

        $idUltimoMovimiento = DB::table('facturacion')->max('id_movimiento');
        $id_movimientoInt= ++$idUltimoMovimiento;
        $id_movimiento = strval($id_movimientoInt);

        return $id_movimiento;
    }

    public function leerMovimiento($id_movimiento){
                
        //consulta para determinar ultimo movimiento, para empezar uno nuevo
        
        //Traemos los articulos del carrito junto a su nombre y precio con un join
        $articulosDelCarrito = DB::select(
            'select am.id, am.codigo_producto, a.nombre, am.cantidad, a.precioVenta, am.subtotal from articulos_por_movimientos as am CROSS JOIN articulos as a where (am.id_movimiento = ? and am.codigo_producto = a.codigo)', [$id_movimiento]);

        return $articulosDelCarrito;
    }

    public function sacarTotal($id_movimiento){

        $totalDB = DB::select('select sum(subtotal) as total from articulos_por_movimientos where id_movimiento = ?', [$id_movimiento]);

        foreach($totalDB as $item){
            $total = $item->total;
        }

        return $total;
    }

/*
Se debe verificar la existencia en stock antes de vender, dependiendo de una variable.
Si controlarStock es true, se debe validar el stock
Si controlarStock es false, se puede vender aunque no haya existencias en stock.
 */

    public function generarFactura($id_movimiento, $nota, $dineroRecibido)
    {
        $totalDB = DB::select('select sum(subtotal) as total from articulos_por_movimientos where id_movimiento = ?', [$id_movimiento]);

        foreach($totalDB as $item){
            $total = $item->total;
        }
        
        $dineroDevuelto = $dineroRecibido- $total;
        $tipoMovimiento = 'venta';
        $fecha = date('Y-m-d H:i:s');
        
        if($total){
            DB::insert('insert into movimientos (id_movimiento, tipo, fecha, total) values(?,?,?,?)', [$id_movimiento, $tipoMovimiento, $fecha, $total]);
            DB::insert('insert into facturacion (id_movimiento, nota, dinero_recibido, dinero_devuelto, costo_total, fecha) values (?, ?, ?, ?, ?, ?)', [$id_movimiento, $nota, $dineroRecibido, $dineroDevuelto, $total, $fecha]);
        }
    }

    public function leerFacturaPorId($id_movimiento)
    {
        $factura = DB::select('select * from facturacion where id_movimiento = ?', [$id_movimiento]);
        return $factura;
    }

    public function controlarStock($id_movimiento){

        //Primero traigo el id y  la cantidad en la venta de los productos
        $productosVendidos = DB::select('select codigo_producto, cantidad from articulos_por_movimientos where id_movimiento = ?', [$id_movimiento]);

        //En esta array guardo la resta entre el stock del articulo y la cantidad que se vendio de este
        $alcanzo = Array();

        foreach($productosVendidos as $productoVendido){
            $id_articulo = $productoVendido->codigo_producto;

            $cantidad =  $productoVendido->cantidad;

            $productosDeBodega = DB::select('select stock from articulos where codigo = ?', [$id_articulo]);

            foreach($productosDeBodega as $producto){
                $stock = $producto->stock;
            }

            $alcanzoUnd = $stock - $cantidad;

            DB::update('update articulos set stock = ? where codigo= ?', [$alcanzoUnd, $id_articulo]);

            array_push($alcanzo, $alcanzoUnd);
        }

        //Recorro el array donde esta la diferencia entre cantidad y stock de los articulos ha vender, para validar si hay menos articulos de lo que se pretende vender
        
        $controlarStock=true;

        foreach($alcanzo as $item => $alcanzo){
            if( $alcanzo < 0 ){
                $controlarStock=false;
                break;
            }
        }

        return $controlarStock;

    }
}