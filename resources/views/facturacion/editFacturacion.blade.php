@extends('layaouts.plantilla')

@section('content')
    <div class="container">
        <h6>Editar cantidad del articulo {{$nombreArticulo}}</h6>
        <form action="/PI2019-SebastianDuque-ProyectoUno/public/facturacion/update/{{$codigo}}" method="POST">
            @method('PUT')
            @csrf

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Cantidad que desea comprar del articulo {{$nombreArticulo}}</label>
                <input type="text" class="form-control" name="cantidad" id="cantidad" value="<?=htmlspecialchars($cantidad);?>">
            </div>

            <button type="submit" class="btn btn-success">editar</button>
        </form>
    </div>
@endsection