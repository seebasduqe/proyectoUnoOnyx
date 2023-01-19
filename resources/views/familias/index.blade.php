@extends('layaouts.plantilla')

@section('content')
      <div class="container">
      
        <div class="row">
          <div class="col-md-4">
            <h6>Lista de familias</h6>
          </div>
          <div class="col-md-4 offset-md-4">
            <a href="/PI2019-SebastianDuque-ProyectoUno/public/familias/new"> <button type="button" class="btn btn-outline-info"> Nuevo <img src="new.svg" width="20" height="20" > </button> </a>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 offset-md-3">
            <table class="table">
              <thead>
                <tr>
                  <th>#codigo</th>
                  <th>familia</th>
                  <th>descripcion</th>
                  <th>opciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($familias as $familia)
                <tr>
                <td> {{ $familia->codigo }}  </td>
                <td> {{ $familia->nombre }}  </td>
                <td> {{ $familia->descripcion }}  </td>
                <td><a href="familias/edit/{{$familia->codigo}}"><button class="btn btn-outline-success">editar</button></a></td>
                <td><button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#exampleModal_{{$familia->nombre}}">borrar</button></td>
                </tr>
                                                <!-- Modal -->
                <div class="modal fade" id="exampleModal_{{$familia->nombre}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
              
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel_"> Eliminar familia </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
              
                      <div class="modal-body">
                        Seguro que desea eliminar la categoria {{$familia->nombre}}
                      </div>
      
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <form action="/PI2019-SebastianDuque-ProyectoUno/public/familias/delete/{{ $familia->codigo }}" method="POST">
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
      </div>
@endsection