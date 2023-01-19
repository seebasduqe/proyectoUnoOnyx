@extends('layaouts.plantilla')

@section('content')
    <div class="container">
        <h5>Facturacion</h5>
        <p>Articulos añadidos al carrito: </p>

        <table>
            <thead class="table-primary">
                <tr>
                    <th>#Codigo</th>
                    <th>articulo</th>
                    <th>cantidad</th>
                    <th>precio Und</th>
                    <th>subtotal</th>
                    <th>opciones</th>
                </tr>
            </thead>
            <tbody>
                @for ($i=0; $i < count($articulosDelCarrito); $i++)
                <tr>
                    <td>{{$articulosDelCarrito[$i]->codigo_producto}} </td> 
                    <td>{{$articulosDelCarrito[$i]->nombre}} </td>
                    <td>{{$articulosDelCarrito[$i]->cantidad}} </td>
                    <td> ${{$articulosDelCarrito[$i]->precioVenta}} </td>
                    <td> ${{ $articulosDelCarrito[$i]->subtotal }} </td> 
                    <td><a href="facturacion/edit/{{$articulosDelCarrito[$i]->codigo_producto}}"><button type="button" class="btn btn-outline-success">editar</button></a></td>
                    <td><a href="facturacion/delete/{{$articulosDelCarrito[$i]->id}}"><button type="button" class="btn btn-outline-danger">Quitar</button></a></td>        
                </tr>
            @endfor
            </tbody>
        </table>
        <br>

        <div class="container">
            <h5>Total de su compra: &nbsp &nbsp &nbsp ${{$total}}</h5>
        </div>

        <div class="container">
            <a href="pagos"><button type="button" class="btn btn-primary"> Ir a pagos <img src="bank.svg" width="20" height="20"> </button> </a>
        </div>

    </div>
@endsection