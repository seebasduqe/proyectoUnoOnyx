@extends('content')


@section('content')
    <h1>El articulo seleccionado es este: 
        <?php 
        foreach ($articulos as $articulo) {
            echo $articulo->nombre;
        }
    ?>
    </h1>
@endsection