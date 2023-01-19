@extends('layaouts.plantilla')

@section('content')
    <div class="container">
        <form action="/PI2019-SebastianDuque-ProyectoUno/public/facturacion/create" method="POST">
            @csrf

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Ingre el dinero recibido</label>
                <input type="text" class="form-control" name="dineroRecibido" id="dineroRecibido" placeholder="$0.0">
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Escriba nota o sugerencia</label>
                <input type="text" class="form-control" name="nota" id="nota" placeholder="nota">
            </div>

            <button type="submit" class="btn btn-success"> pagar <img src="money.svg" width="20" height="20"> </button>

        </form>
    </div>

@endsection