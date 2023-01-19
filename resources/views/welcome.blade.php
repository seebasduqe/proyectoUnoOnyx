@extends('layaouts.plantilla')

@section('content')
    <div class="container">
        <h5>Bienvenido a la tienda informatica</h5>
        <p>Aqui puede encontrar una lista de todos los articulos disponibles</p>

        <div class="container">
            <div class="row row-cols-2">
                @foreach ($articulos as $articulo)
                <div class="col">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                          <h6 class="card-title">{{$articulo->nombre}}</h6>
                          <p class="card-text">{{$articulo->descripcion}}</p>
                          <p class="card-text">{{$articulo->precioVenta}}</p>
                          <a href="/PI2019-SebastianDuque-ProyectoUno/public/facturacion/agg/{{$articulo->codigo}}" class="btn btn-primary">comprar <img src="iconCart.svg" alt="carrito de compras"  width="30" height="30"></a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection