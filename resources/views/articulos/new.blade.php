@extends('layaouts.plantilla')

@section('content')

    @if ($error)
    <div class="alert alert-danger" role="alert">
        El articulo ingresado ya se encuentra registrado
    </div>
    @endif
        
    <div class="container card border-success mb-3" style="max-width: 18rem;">

        <div class="mb-3">   <h1>Añadir nuevo articulo</h1></div>

        <form action="/PI2019-SebastianDuque-ProyectoUno/public/articulos/create" method="POST">
            @csrf

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Codigo o referencia</label>
                <input type="text" class="form-control" name="codigo" id="codigo" placeholder="escriba aqui codigo del articulo">
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="escriba aqui el nombre del articulo">
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Descripcion</label>
                <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="escriba aqui una descripcion del articulo">
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">precio de compra</label>
                <input type="text" class="form-control" name="precioCompra" id="precioCompra" placeholder="escriba aqui a como se compro el articulo">
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">precio de venta</label>
                <input type="text" class="form-control" name="precioVenta" id="precioVenta" placeholder="escriba aqui a como se va a vender el articulo">
            </div>
            
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">stock</label>
                <input type="text" class="form-control" name="stock" id="stock" placeholder="escriba aqui cuantas unidades compro">
            </div>


            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">categoria</label>
                <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="categoria">
                    <option selected>categoria</option>
                        @foreach ($categorias as $categoria)
                        <option value={{$categoria->codigo}}>{{$categoria->nombre}}</option>
                        @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-success">enviar</button>
        </form>

    </div>
@endsection