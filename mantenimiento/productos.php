<?php
session_start();
include("../servicios/modelo/productomodel.php");
include("validarDatos.php");
if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
}

try {
    $idproducto = 0;
    $producto = new Productos();
    $datos = compact('idproducto');
    $mensajes = '';
    $productos = $producto->consultaTodosProductos($datos);
    if (isset($_GET['idproducto'])) {
        $idproducto = $_GET['idproducto'];
        $datos = compact('idproducto');
        $productos = $producto->consultaTodosProductos($datos);
    }
    if (isset($_POST['actualizar'])) {
        $idproducto = $_POST['idproducto'];
        $nombreprod = $_POST['nombreprod'];
        $imagenprod = $_POST['imagenprod'];
        $precio = $_POST['precio'];
        $mensajes = validarDatosProducto($nombreprod, $imagenprod, $precio);
        if($mensajes!=''){
            throw new Exception($mensajes);
        }
        $datos = compact('idproducto', 'nombreprod', 'imagenprod', 'precio');
        $resultado = $producto->actualizarProductos($datos);
        if ($resultado['codigo'] == '00') {
            header("Location: productos.php");
        } else {
            $mensajes.=$resultado['mensaje'];
        }
    }
    if (isset($_POST['baja'])) {
        $idproducto = $_POST['idproducto'];
        $datos = compact('idproducto');
        $resultado = $producto->bajaProductos($datos);
        if ($resultado['codigo'] == '00') {
            header("Location: productos.php");
        } else {
            throw new Exception($resultado['mensaje']);
        }
    }
} catch (Exception $e) {
   
    $mensajes = $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mantenimiento</title>
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
            <a href="mantenimiento.php">Inicio</a>
            <a href="altaproducto.php">Alta producto</a>
        </nav>
    </header>
    <h2>Productos</h2>

    <div class="contenedor">
        <?php if (!isset($_GET['idproducto'])) : ?>
            <table id='productos' class="tabla">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Producto</th>
                        <th>Titulo de imagen</th>
                        <th>Precio €</th>
                        <th>Editar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productos['mensaje'] as $producto) : ?>
                        <tr>
                            <td><?php echo $producto['idprod']; ?></td>
                            <td><?php echo $producto['nombreprod']; ?></td>
                            <td><?php echo $producto['imagenprod']; ?></td>
                            <td><?php echo $producto['precio']; ?></td>
                            <td><a href="productos.php?idproducto=<?php echo $producto['idprod']; ?>">Editar</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <form action="#" method="post" class="form">
                <div class="form-control p-2 mt-2">
                    <input type="hidden" name="idproducto" id="id" value="<?php echo $productos['mensaje']['idprod'] ?? null; ?>" class="form-control">
                    <label for="nombreprod">Producto :</label>
                    <input type="text" name="nombreprod" id="nombreprod" value="<?php echo $productos['mensaje']['nombreprod'] ?? null; ?>" class="form-control">
                </div>
                <div class="form-control p-2 mt-2">
                    <label for="imagenprod">Titulo de imagen :</label>
                    <input type="text" name="imagenprod" id="imagenprod" value="<?php echo $productos['mensaje']['imagenprod'] ?? null; ?>" class="form-control">
                </div>
                <div class="form-control p-2 mt-2">
                    <label for="precio">Precio :</label>
                    <input type="number" name="precio" id="precio" value="<?php echo $productos['mensaje']['precio'] ?? null; ?>" class="form-control">
                </div>
                <div class="form-control p-2 mt-2">
                    <button type="submit" name="actualizar" class=" btn btn-info me-5">Actualizar</button>
                    <button type="submit" name="baja" class=" btn btn-danger me-5">Borrar</button>
                    <a href="productos.php" class="btn btn-success">Cancelar</a>
                    
                </div>
                <h4><?=$mensajes ?? null?></h4>
            </form>
        <?php endif; ?>
    </div>

</body>

</html>