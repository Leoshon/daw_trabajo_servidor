<?php
session_start();
if (isset($_SESSION['usuario'])) {
  session_destroy();
  header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
  <link rel="stylesheet" href="../css/style.css">
  <script src="../js/alta.js" defer></script>
</head>
<body>
<header class="header">
    <div class="header-top">
      <img src="../img/tiendalogo.jpg" alt="logo" class="logo" width="50px" height="50px"/>
      <h1>Tienda Medac Sport</h1>
    </div>
    <nav>
        <a href="../index.php">Volver al inicio</a>
      </nav>
  </header>
    <form id="formulario" name="formulario" class="form">
      <div class="form-control p-2 mt-2">
        <label for="usuario">Usuario *</label>
        <input type="text" name="usuario" id="usuario" class="form-control" />
      </div>
      <div class="form-control p-2 mt-2">
        <label for="correo">Correo *</label>
        <input type="email" name="correo" id="correo" class="form-control" />
      </div>
      <div class="form-control p-2 mt-2">
        <label for="pass">Contraseña *</label>
        <input type="password" name="pass" id="pass" class="form-control" />
      </div>
      <div class="form-control p-2 mt-2">
        <input type="button" value="Enviar" id="alta" name="alta " class="btn btn-info me-5" />
      </div>
    </form>
</body>
</html>