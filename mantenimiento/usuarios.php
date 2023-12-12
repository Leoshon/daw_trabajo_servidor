<?php
session_start();
include("../servicios/modelo/usuariomodel.php");
include("validarDatos.php");
if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
}
try {
    $usuario = new Usuarios();
    $id = 0;
    $usuarios = $usuario->consultaUsuarios($id);
    $mensajes = '';
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $usuarios = $usuario->consultaUsuarios($id);
    }
    if (isset($_POST['actualizar'])) {
        $id = $_POST['id'];
        $cliente = $_POST['usuario'];
        $roles = $_POST['roles'];
        $correo = $_POST['correo'];
        $mensajes = validarDatosUsuario($cliente, $roles, $correo);
        if ($mensajes != '') {
            throw new Exception($mensajes);
        }
        $datos = compact('id', 'cliente', 'roles', 'correo');
        $resultado = $usuario->actualizarUsuario($datos);
        if ($resultado['codigo'] == '00') {
            header("Location: usuarios.php");
        } else {
            throw new Exception($resultado['mensaje']);
        }
    }
    if (isset($_POST['baja'])) {
        $id = $_POST['id'];
        $datos = compact('id');
        $resultado = $usuario->bajaUsuario($datos);
        if ($resultado['codigo'] == '00') {
            header("Location: usuarios.php");
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
        </nav>
    </header>
    <h2>Clientes</h2>
    <div class="contenedor">
        <?php if (!isset($_GET['id'])) : ?>
            <table class="tabla">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Contraseña</th>
                        <th>Rol</th>
                        <th>Correo</th>
                        <th>Editar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $usuario) : ?>
                        <tr>
                            <td><?php echo $usuario['id']; ?></td>
                            <td><?php echo $usuario['usuario']; ?></td>
                            <td><?php echo $usuario['pass']; ?></td>
                            <td><?php echo $usuario['roles']; ?></td>
                            <td><?php echo $usuario['correo']; ?></td>
                            <td><a href="usuarios.php?id=<?php echo $usuario['id']; ?>">Editar</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <form action="#" method="post" class="form">
                <div class="form-control p-2 mt-2">
                    <input type="hidden" name="id" id="id" value="<?php echo $usuarios['id'] ?? null; ?>" class="form-control">
                    <label for="usuario">Usuario</label>
                    <input type="text" name="usuario" id="usuario" value="<?php echo $usuarios['usuario'] ?? null; ?>" class="form-control">
                </div>
                <div class="form-control p-2 mt-2">
                    <label for="roles">Rol</label>
                    <input type="text" name="roles" id="roles" value="<?php echo $usuarios['roles'] ?? null; ?>" class="form-control">
                </div>
                <div class="form-control p-2 mt-2">
                    <label for="correo">Correo</label>
                    <input type="email" name="correo" id="correo" value="<?php echo $usuarios['correo'] ?? null; ?>" class="form-control">
                </div>
                <div class="form-control p-2 mt-2">
                    <button type="submit" name="actualizar" class=" btn btn-info me-5">Actualizar</button>
                    <button type="submit" name="baja" class=" btn btn-danger me-5">Baja</button>
                    <a href="usuarios.php" class="btn btn-success">Volver</a>
                </div>
                <h4><?= $mensajes ?? null ?></h4>
            </form>
        <?php endif; ?>
    </div>
</body>

</html>