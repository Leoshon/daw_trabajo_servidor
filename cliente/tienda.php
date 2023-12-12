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
  <title>Tienda</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
  <link rel="stylesheet" href="../css/style.css" />
  <script src="../js/script.js" defer></script>
</head>
<body>
  <header class="header">
    <div class="header-top">
      <img src="../img/tiendalogo.jpg" alt="logo" class="logo" width="50px" height="50px" />
      <h1>Tienda Medac Sport</h1>
    </div>
    <nav>
      <a href="logout.php">Cerrar session</a>
      <a><button type="button" class="btn btn-warning" id="consultar">Consultar pedidos</button></a>
    </nav>
  </header>
  <div class="contenedor">
    <h2>Bienvenido <?= $_SESSION['usuario']['usuario']; ?></h2>
    <hr>
    <table id="table" class="table">
      <thead>
        <tr>
          <th scope="row">ID</th>
          <th scope="row">Producto</th>
          <th scope="row">Cantidad</th>
          <th scope="row">Acciones</th>
          <th scope="row">Total</th>
          <th></th>
        </tr>
      </thead>
      <tbody id="tbody"></tbody>
      <tfoot id="tfoot">
      </tfoot>
    </table>
    <h1>Productos</h1>
    <hr>
    <div class="row" id="cards"></div>
  </div>
  <template id="template-card">
    <div class="col-12 mb-2 col-md-4">
      <div class="card">
        <img src="" alt="imagen" class="card-img-top mt-1" width="200" height="280" />
        <div class="card-body">
          <h4></h4>
          <p></p>
          <button type="button" class="btn btn-dark">Comprar</button>
        </div>
      </div>
    </div>
  </template>
  <template id="template-items">
    <tr>
      <th scope="row"></th>
      <td>title</td>
      <td>cantidad</td>
      <td>
        <button type="button" class="btn btn-info btn-sm">+</button>
        <button type="button" class="btn btn-warning btn-sm">-</button>
      </td>
      <td><span></span> €</td>
      <td><button type="button" class="btn btn-success btn-sm">Comprar</button></td>
    </tr>
  </template>
  <template id="template-footer">
    <tr>
      <th scope="row" colspan="2">Total productos</th>
      <td>1</td>
      <td>
        <button type="button" id="vaciar" class="btn btn-danger btn-sm">Vaciar</button>
      </td>
      <td><span></span> €</td>
    </tr>
  </template>
</body>
</html>