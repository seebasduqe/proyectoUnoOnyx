<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use App\Models\Familia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\ArticuloServiceInterface;

class ArticulosController extends Controller
{

        protected $articuloService;

        public function __construct(ArticuloServiceInterface $articuloService)
        {
            $this->articuloService = $articuloService;
        }


    public function index(Request $request){

        $valueRef = $request->session()->get('ref');

        $palabraClave = request('palabraClave');

        //Estructura de control para listar todos los articulos o por referencia o por precio
        if($palabraClave){

            //listar articulo por busqueda 
            $articulos = $this->articuloService->filtrarArticuloPorRef($palabraClave);

        }  else if($valueRef){
                //listar articulo por precio
                $articulos = $this->articuloService->filtrarPorPrecios($valueRef);

        } else {
                //listar todos los articulos
                $articulos = $this->articuloService->listarArticulos();
        }

        return view('articulos.index', ['articulos' => $articulos]);
    }

    public function show($codigo){

        $articulo = DB::select('select * from articulos where codigo = ?', [$codigo]);
        return view('articulos.show', ['articulos' => $articulo]);
    }


    //Revisar porque no me esta disparando el formulario create 
    public function create(Request $request){

        $articulo = new Articulo();

        $articulo->codigo = $request->codigo;
        $articulo->nombre = $request->nombre;
        $articulo->descripcion = $request->descripcion;

        $precioCompraString = $request->precioCompra;
        $articulo->precioCompra = floatval($precioCompraString);

        $precioVentaString = $request->precioVenta;
        $articulo->precioVenta = floatval($precioVentaString);

        $stockString = $request->stock;
        $articulo->stock = intval($stockString);
        $articulo->categoria = $request->categoria;
        
        $exitoGuardado = $this->articuloService->salvarArticulo($articulo);

        if($exitoGuardado){
            return redirect('articulos');
        } else {
            $categorias = Familia::all();
            return view('articulos.new', ['categorias' => $categorias, 'error' => $error=true]);
        }
        
    }

    public function formArticulos($validacion = null){

        $categorias = Familia::all();

        return view('articulos.new', ['categorias' => $categorias, 'error' => $error=false]);
    }


    public function edit(Request $request){
        
        $articulo = new Articulo();

        $articulo->codigo = $request->codigo;
        $articulo->nombre = $request->nombre;
        $articulo->descripcion = $request->descripcion;

        $precioCompraString = $request->precioCompra;
        $articulo->precioCompra = floatval($precioCompraString);

        $precioVentaString = $request->precioVenta;
        $articulo->precioVenta = floatval($precioVentaString);

        $stockString = $request->stock;
        $articulo->stock = intval($stockString);
        $articulo->categoria = $request->categoria;
        
        $this->articuloService->actualizarArticulo($articulo);

        return redirect('articulos');
    }

    public function formEdit($codigo){

        $articulo = DB::select('select * from articulos where codigo=?', [$codigo]);

        foreach($articulo as $item){
            $codigobd = $item->codigo; 
            $nombre = $item->nombre;
            $descripcion = $item->descripcion;
            $precioCompra = $item->precioCompra;
            $precioVenta = $item->precioVenta;
            $stock = $item->stock;
            $categoria = $item->categoria;
        }

        return view('articulos.edit', ['codigo' => $codigobd, 'nombre' => $nombre, 'descripcion' => $descripcion, 'precioCompra' => $precioCompra, 'precioVenta' => $precioVenta, 'stock' => $stock, 'categoria' => $categoria]);
    }

    public function delete($codigo){
        
        $this->articuloService->borrarArticulo($codigo);

        return redirect('articulos');
    }

    public function filtrar($ref){
        return redirect('articulos')->with('ref', $ref);
    }
}
