@extends('layaouts.plantilla')
@section('content')

@section('content')
    <div class="container">

        <h6>Editar articulo </h6>
        <form action="/PI2019-SebastianDuque-ProyectoUno/public/articulos/update" method="POST">
            @method('PUT')
            @csrf
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Codigo o referencia</label>
                <input type="text" class="form-control" name="codigo" id="codigo" value="<?=htmlspecialchars($codigo);?>">
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Articulo</label>
                <input type="text" class="form-control" name="nombre" id="nombre" value="<?=htmlspecialchars($nombre);?>">
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Descripcion</label>
                <input type="text" class="form-control" name="descripcion" id="descripcion" value="<?=htmlspecialchars($descripcion);?>">
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">precio de compra</label>
                <input type="text" class="form-control" name="precioCompra" id="precioCompra" value="<?=htmlspecialchars($precioCompra);?>">
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">precio de venta</label>
                <input type="text" class="form-control" name="precioVenta" id="precioVenta" value="<?=htmlspecialchars($precioVenta);?>">
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">stock</label>
                <input type="text" class="form-control" name="stock" id="stock" value="<?=htmlspecialchars($stock);?>">
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">categoria</label>
                <input type="text" class="form-control" name="categoria" id="categoria" value="<?=htmlspecialchars($categoria);?>">
            </div>

            <button type="submit" class="btn btn-success">editar</button>
        </form>
    </div>
@endsection
