<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mantenimiento</title>
    <link rel="stylesheet" href="../css/style.css" />
</head>

<body>
<header class="header">
    <div class="header-top">
      <img src="../img/tiendalogo.jpg" alt="logo" class="logo" width="50px" height="50px"/>
      <h1>Tienda Medac Sport</h1>
    </div>
    <nav>
      <a href="../index.php">Cerrar session</a>
    <a href="usuarios.php">Usuarios</a>
    <a href="productos.php">Productos</a>
    
      </nav>
  </header>
  <h2>Mantenimiento</h2>
  <form id="buscadorpro"class= "form">
    <label for="filtroproductos">Buscar Pedidos por producto:</label>
    <input type="text" name="buscar" id="filtroproductos" placeholder="Introduce nombre del producto o pulsa espacio para ver todos pedidos">
  </form>
   
    <div class="contenedor">
      <table class="tabla">
        <thead>
          <tr>
            <th>Nombre del producto</th>
            <th>Pagado €</th>
            <th>Fecha</th>
            <th>Usuario</th>
          </tr>
        </thead>
        <tbody id="tbody">
        </tbody>
      </table>
    </div>
<script src="../js/buscador.js"></script>
</body>

</html>