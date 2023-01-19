@extends('layaouts.plantilla')

@section('content')

    @if (!$exitoOperacion)
    <div class="alert alert-danger" role="alert">
        La familia ingresada ya se encuentra registrada
    </div>
    @endif

    <div class="container card border-success mb-3" style="max-width: 18rem;">
        <h1>Familia de Articulos</h1>
        <form action="/PI2019-SebastianDuque-ProyectoUno/public/familias/create" method="POST">
            @csrf
            
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Codigo o referencia de la familia</label>
                <input type="text" class="form-control" name="codigo" id="codigo" placeholder="escriba aqui codigo de la familia">
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="escriba aqui nombre de la familia">
            </div>


            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Descripcion de familia</label>
                <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="descripcion">
            </div>
           

            <button type="submit" class="btn btn-success">enviar</button>
          </form>
    </div>
@endsection