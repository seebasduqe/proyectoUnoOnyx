<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Familia por id</title>
</head>
<body>
    <h1> La Familia buscada es: </h1>
    <?php 
        foreach($familia as $item){
            echo $item->nombre;
        }
    ?>
</body>
</html>