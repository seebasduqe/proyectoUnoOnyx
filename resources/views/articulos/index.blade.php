@extends('layaouts.plantilla')


@section('content')
    <div class="container">

        <div class="d-flex bd-highlight">
            <div class="p-2 flex-grow-1 bd-highlight">
                <h6>Lista de articulos </h6> 
            </div>

            <div class="p-2 bd-highlight">                
                <a class="nav-link dropdown-toggle" href="articulos" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="filter.svg" alt="filter"  width="25" height="25">Filtrar
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li> <option value="buscarPorNombre" class="dropdown-item"> Buscar por nombre </option> </li>
                    <li><a class="dropdown-item" href="articulos/filtrar/precioCMayorMenor">precio compra, mayor precio a menor precio</a></li>
                    <li><a class="dropdown-item" href="articulos/filtrar/precioCMenorMayor">precio compra, menor precio a mayor precio</a></li>
                    <li><a class="dropdown-item" href="articulos/filtrar/precioVMayorMenor">precio venta, mayor precio a menor precio </a></li>
                    <li><a class="dropdown-item" href="articulos/filtrar/precioVMenorMayor">precio compra, menor precio a mayor precio</a></li>
                  </ul>
            </div>


            <div class="p-2 bd-highlight">
                <form class="d-flex" method="GET">
                    @csrf
                    <input class="form-control me-2" type="search" placeholder="buscar articulo" aria-label="Search" name="palabraClave">
                    <button class="btn btn-outline-success" type="submit">buscar  <img src="lupa.svg" alt="filter"  width="10" height="10"></button>
                  </form>
            </div>
        </div>


        <div class="d-flex flex-row-reverse bd-highlight">
            <div class="p-2 bd-highlight">
                <a href="/PI2019-SebastianDuque-ProyectoUno/public/articulos/generar/nuevo"> <button type="button" class="btn btn-outline-info"> nuevo <img src="new.svg" width="20" height="20" > </button> </a>
            </div>
          </div>

          <div class="table-responsive-sm">
            <table class="table">
                <thead>
                    <tr>
                       <th>codigo</th> 
                       <th>articulo</th>
                       <th colspan="2">descripcion</th>
                       <th>precio compra</th>
                       <th>precio venta</th>
                       <th>stock</th>
                       <th>categoria</th>
                       <th>opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($articulos as $articulo)
                    <tr>
                        <td> {{$articulo->codigo}} </td>
                        <td> {{$articulo->nombre}} </td>
                        <td colspan="2"> {{$articulo->descripcion}} </td>
                        <td> ${{$articulo->precioCompra}} </td>
                        <td> ${{$articulo->precioVenta}} </td>
                        <td> {{$articulo->stock}} und </td>
                        <td> {{$articulo->categoria}} </td>
                        <td><a href="articulos/edit/{{$articulo->codigo}}"><button type="button" class="btn btn-outline-success">editar</button></a></td>
                        <td><button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#exampleModal_{{$articulo->codigo}}">borrar</button></td>
                    </tr>
                      <!-- Modal -->
                    <div class="modal fade" id="exampleModal_{{$articulo->codigo}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Eliminar articulo</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
        
                                <div class="modal-body">
                                    Esta seguro de eliminar el articulo {{$articulo->nombre}}
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    <form action="/PI2019-SebastianDuque-ProyectoUno/public/articulos/delete/{{ $articulo->codigo }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger">borrar</button>
                                    </form>
                                </div>
                            </div>
                        </div> 
                    </div>
                    @endforeach
                </tbody>
            </table>    
        </div>
        
    </div>
@endsection
