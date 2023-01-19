<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Services\FamiliaServiceInterface;
use App\Models\Familia;


class FamiliaController extends Controller
{


    protected $familiaService;

    //Instancio la clase familia service para traer todos sus metodos

    public function __construct(FamiliaServiceInterface $familiaService)
    {
        $this->familiaService = $familiaService;
    }

    public function index(){

        $familias = $this->familiaService->listarFamilias();
        
        return view('familias.index', ['familias' => $familias]);
    }



    public function create(Request $request){

        $familia = new Familia();
        $familia->codigo = request('codigo');
        $familia->nombre = request('nombre');
        $familia->descripcion = request('descripcion');

        $exitoOperacion = $this->familiaService->salvarFamilia($familia);


        if($exitoOperacion){
            return redirect('familias');
        } else {
            return view('familias.create', ['exitoOperacion' => $exitoOperacion]);
        }

    }

    public function formView(){
        return view('familias.create', ['exitoOperacion' => $exitoOperacion = true]);
    }

    public function formEdit($codigo){

        $familia = DB::select('select * from familias where codigo = ?', [$codigo]);

        foreach($familia as $item){
            $codigodb = $item->codigo;
            $nombre = $item->nombre;
            $descripcion = $item->descripcion;
        }

        return view('familias.edit', ['codigo' => $codigodb, 'nombre' => $nombre, 'descripcion' => $descripcion]);
    }

    public function edit(Request $request){
    
        $familia = new Familia();
        $familia->codigo = request('codigo');
        $familia->nombre = request('nombre');
        $familia->descripcion = request('descripcion');

        $this->familiaService->actualizarFamilia($familia, $familia->codigo);
        
        return redirect('familias');
    }

    public function delete($codigo){

        
        $this->familiaService->borrarFamilia($codigo);

        return redirect('familias');
    }
}
