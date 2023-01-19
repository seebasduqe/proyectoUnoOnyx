<?php

namespace App\Services;

use App\Models\Articulo;
use Illuminate\Support\Facades\DB;

class ArticuloService implements ArticuloServiceInterface {

    protected $articulo;

    public function __construct(Articulo $articulo)
    {
        $this->articulo = $articulo;
    }

    public function listarArticulos()
    {
        $articulos = Articulo::all();
        $articulos = DB::select('select a.codigo, a.nombre, a.descripcion, a.precioCompra, a.precioVenta, a.stock, f.nombre as categoria from articulos a join familias f on f.codigo = a.categoria;');
        return $articulos;
    }


    //filtrar articulo o buscar por referencia
    public function filtrarArticuloPorRef($palabraClave)
    {
        $palabraClaveLike = "%$palabraClave%";

        $articuloEncontrado = DB::select('select * from articulos where codigo LIKE ? or nombre LIKE ? or descripcion like ? or categoria like ?', [$palabraClaveLike,$palabraClaveLike, $palabraClaveLike,$palabraClaveLike]);
                                        //	FROM clientes WHERE nombre LIKE '%a%' or nombre LIKE '%r%' 
        return $articuloEncontrado;
    }


    public function filtrarPorPrecios($valueRef)
    {
        $articulosPrecioCMayorMenor = DB::select('select *  from articulos order by precioCompra DESC');
        $articulosPrecioCMenorMayor = DB::select('select *  from articulos order by precioCompra ASC');

        $articulosPrecioVMayorMenor = DB::select('select *  from articulos order by precioVenta DESC');
        $articulosPrecioVMenorMayor = DB::select('select *  from articulos order by precioVenta ASC');
        
        switch($valueRef){
            case 'precioCMayorMenor':
                return $articulos = $articulosPrecioCMayorMenor;
            case 'precioCMenorMayor':
                return $articulos = $articulosPrecioCMenorMayor;
            case 'precioVMayorMenor':
                return $articulos = $articulosPrecioVMayorMenor;
            case 'precioVMenorMayor':
                return $articulos = $articulosPrecioVMenorMayor;
        }  
    }

    public function traerPorCodigo($codigo)
    {
        $articulo = DB::table('articulos')->where('codigo', $codigo);
    }

    public function salvarArticulo(Articulo $articulo)
    {

        $exitoOperacion = true;

        $articuloVerificacion = DB::select('select codigo from articulos where (codigo = ? or nombre = ?)', [$articulo->codigo, $articulo->nombre]);
        
        if($articuloVerificacion){
            $exitoOperacion = false;
        } else {
            $articulo->save();
        }

        return $exitoOperacion;
    }

    public function actualizarArticulo(Articulo $articulo)
    {
        DB::table('articulos')
        ->where('codigo', $articulo->codigo)
        ->update([
                    'codigo' => $articulo->codigo,
                    'nombre' => $articulo->nombre,
                    'descripcion' => $articulo->descripcion,
                    'precioCompra' => $articulo->precioCompra,
                    'precioVenta' => $articulo->precioVenta,
                    'stock' => $articulo->stock,
                    'categoria' => $articulo->categoria
                ]);
    }

    public function borrarArticulo($codigo)
    {
        DB::table('articulos')->where('codigo', $codigo)->delete();
    }

}