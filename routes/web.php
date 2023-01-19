<?php

use App\Http\Controllers\ArticulosController;
use App\Http\Controllers\FacturacionController;
use App\Http\Controllers\FamiliaController;
use App\Http\Controllers\MovimientosController;
use App\Http\Controllers\PagoReporteController;
use App\Http\Controllers\WelcomeController;
use App\Models\Familia;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', [WelcomeController::class, 'index']);


Route::controller(FacturacionController::class)->group(function(){
    Route::get('facturacion', 'index');
    Route::get('/facturacion/agg/{codigo}','recibirArticulos');
    Route::get('facturacion/delete/{id}', 'delete');
    Route::get('facturacion/edit/{id}', 'formEdit');
    Route::put('facturacion/update/{id}', 'edit');
});


//Rutas de metodos crud de familias
Route::controller(FamiliaController::class)->group(function(){
    Route::get('familias','index');
    Route::get('familias/ver/{codigo}','show');
    Route::post('familias/create', 'create');
    Route::get('familias/new', 'formView');
    Route::get('familias/edit/{codigo}', 'formEdit');
    Route::put('familias/update', 'edit');
    Route::delete('familias/delete/{codigo}', 'delete');
    
});



//rutas metodos crud de articulos
Route::controller(ArticulosController::class)->group(function(){
    Route::get('articulos', 'index');
    Route::get('articulos/{ref}', 'index');
    Route::get('articulos/ver/{codigo}', 'show');
    Route::get('articulos/generar/nuevo', 'formArticulos');
    Route::post('articulos/create', 'create');
    Route::get('articulos/edit/{codigo}', 'formEdit');
    Route::put('articulos/update', 'edit');
    Route::delete('articulos/delete/{codigo}', 'delete');
    Route::get('articulos/filtrar/{ref}', 'filtrar');
});


Route::controller(PagoReporteController::class)->group(function(){
    Route::get('pagos','ventanillaDePago');
    Route::get('reporte','reporte');
    Route::post('facturacion/create', 'createFactura');
});
