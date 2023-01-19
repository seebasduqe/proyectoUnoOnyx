<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar familia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>
<body>

    <div class="container">
        <h6>Editar familia</h6>
        <form action="/PI2019-SebastianDuque-ProyectoUno/public/familias/update" method="POST">
            @method('PUT')
            @csrf

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Codigo o referencia</label>
                <input type="text" class="form-control" name="codigo" id="codigo" value="<?=htmlspecialchars($codigo);?>">
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">familia</label>
                <input type="text" class="form-control" name="nombre" id="nombre" value="<?=htmlspecialchars($nombre);?>">
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">descripcion</label>
                <input type="text" class="form-control" name="descripcion" id="descripcion" value="<?=htmlspecialchars($descripcion);?>">
            </div>

            <button type="submit" class="btn btn-success">editar</button>

        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>