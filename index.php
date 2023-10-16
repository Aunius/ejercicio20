<?php
include("conexion.php");

function registrosPrueba(){
    $conexion = connect();
    for($i = 0; $i<100; $i++){
        $stm=$conexion->prepare("INSERT INTO productos (nombre, precio) VALUES(?, ?)");
        $nombre = "Producto ".rand(0, 99999);
        $precio = rand(0, 99999);
        $stm->execute([$nombre, $precio]);
    }
}

function eliminarRegistros(){
    $conexion=connect();
    $stm=$conexion->prepare("DELETE FROM productos WHERE id % 2 <>0;");
    $stm->execute();
}


if( $_GET['insertar_registros_prueba'] ?? null ){
    registrosPrueba();
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}

if( $_GET['eliminar_registros_prueba'] ?? null ){
    eliminarRegistros();
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}

$conexion = connect();
$stm=$conexion->prepare("SELECT * FROM productos");
$stm->execute();
$productos=$stm->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <a class="btn btn-info" href="<?=$_SERVER['PHP_SELF'].'?insertar_registros_prueba=true'?>">Insertar registros de prueba</a>
            <a class="btn btn-info" href="<?=$_SERVER['PHP_SELF'].'?eliminar_registros_prueba=true'?>">Eliminar registros</a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-primary">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($productos as $producto){?>
                <tr class="">
                    <td scope="row"><?php echo $producto['id'];?></td>
                    <td><?php echo $producto['nombre'];?></td>
                    <td><?php echo $producto['precio'];?></td>
                    <td><button class="btn btn-info">Algo</button></td>
                </tr>
                <?php };?>
            </tbody>
        </table>
    </div>
    


    <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>
</html>