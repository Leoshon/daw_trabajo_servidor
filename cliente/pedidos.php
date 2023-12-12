<?php

session_start();
include("../servicios/modelo/productomodel.php");
if (!isset($_SESSION['usuario'])) {
  header("Location: ../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../css/style.css" />
</head>

<body>
  <header class="header">
    <div class="header-top">
      <img src="../img/tiendalogo.jpg" alt="logo" class="logo" width="50px" height="50px" />
      <h1>Tienda Medac Sport</h1>
    </div>
    <nav>
      <a href="logout.php">Cerrar session</a>
      <a href="tienda.php">Tienda</a>
    </nav>
  </header>
  <h2>Registro pedidos de <?= $_SESSION['usuario']['usuario'] ?></h2>
  <div class="contenedor">
    <table id="pedido" class="tabla">
      <thead>
        <tr>
          <th>Usuario</th>
          <th>Producto</th>
          <th>Pagado €</th>
          <th>Fecha</th>
        </tr>
      </thead>
      <tbody id="tbody"></tbody>
    </table>

  </div>
  <script src="../js/registropedidos.js"></script>

</body>

</html>