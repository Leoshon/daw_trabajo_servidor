<?php
session_start();
include("../servicios/modelo/productomodel.php");
include("validarDatos.php");
if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
}
if (isset($_POST['alta'])) {

    try {
        $mensajes = '';
        $producto = new Productos();
        $nombreprod = trim($_POST['nombreprod'], " ");
        $imagenprod = trim($_POST['imagenprod'], " ");
        $precio = $_POST['precio'];
        $mensajes = validarDatosProducto($nombreprod, $imagenprod, $precio);
        if ($mensajes != '') {
            throw new Exception($mensajes);
        }
        $datos = compact('nombreprod', 'imagenprod', 'precio');
        $resultado = $producto->altaProducto($datos);
        if ($resultado['codigo'] == '00') {
           $mensajes =$resultado['mensaje'];
           /*  header("Location: productos.php"); */
        } else {
            throw new Exception($resultado['mensaje']);
        }
    } catch (Exception $e) {
        $mensajes= $e->getMessage();
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
    <link rel="stylesheet" href="../css/style.css" />
</head>

<body>
    <header class="header">
        <div class="header-top">
            <img src="../img/tiendalogo.jpg" alt="logo" class="logo" width="50px" height="50px" />
            <h1>Tienda Medac Sport</h1>
        </div>
        <nav>
            <a href="productos.php">Volver</a>
        </nav>
    </header>
    <h2>Alta producto</h2>

    <div class="contenedor">
    <form action="#" method="post" class="form">
            <div class="form-control p-2 mt-2">
                <label for="nombreprod">Producto :</label>
                <input type="text" name="nombreprod" id="nombreprod"  class="form-control">
            </div>
            <div class="form-control p-2 mt-2">
                <label for="imagenprod">Titulo de imagen :</label>
                <input type="text" name="imagenprod" id="imagenprod" class="form-control">
            </div>
            <div class="form-control p-2 mt-2">
                <label for="precio">Precio :</label>
                <input type="number" name="precio" id="precio"  class="form-control">
            </div>
            <div class="form-control p-2 mt-2">
                <button type="submit"  name="alta" class=" btn btn-info me-5">Alta</button>
            </div>
            <h4><?=$mensajes ?? null;?></h4>
        </form>
    </div>
</body>
</html>