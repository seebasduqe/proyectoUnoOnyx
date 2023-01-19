@extends('layaouts.plantilla')

@section('content')
    <div class="container">

        @if ($controlStock)
        <h4> *Se valido la disponibilidad de los productos y si hay existencia </h4>
        @else
        <h4> *Se valido la disponibilidad de los productos y no hay existencia, aun asi se continuo con la venta </h4>
        @endif

        <div class="container">
            <div class="jumbotron">
                <h1 class="display-4">Gracias por su compra!</h1>
                <h5>Acabas de comprar: </h5>
                <table>
                    <thead class="table-primary">
                        <tr>
                            <th>articulo</th>
                            <th>cantidad</th>
                            <th>precio Und</th>
                            <th>subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($articulosVendidos as $item)
                        <tr>
                            <td> {{$item->nombre}} </td>
                            <td> {{$item->cantidad}} </td>
                            <td> {{$item->precioVenta}} </td>
                            <td> {{$item->subtotal}} </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <hr class="my-4">

                @foreach ($datosFactura as $item)
                <h6>Con un valor en total de: $ {{$item->costo_total }} </h6>
                <h6>Entregaste: $ {{ $item->dinero_recibido }} </h6>
                <h6> y tu devuelta fue de: $ {{$item->dinero_devuelto }} </h6>
                <h6>Nota de venta: {{$item->nota }} </h6>
                <h6> Compra realizada el {{$item->fecha }}</h6>
                @endforeach

                  <a class="btn btn-primary btn-lg" href="/PI2019-SebastianDuque-ProyectoUno/public/" role="button">volver a inicio</a>

              </div>
        </div>
    </div>


@endsection