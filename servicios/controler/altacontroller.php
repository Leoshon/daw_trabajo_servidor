<?php
require_once '../modelo/usuariomodel.php';
$usuario = new Usuarios();
try {
    $nombre = filter_input(INPUT_POST, 'nombre');
    $correo = filter_input(INPUT_POST, 'correo');
    $pass = md5(filter_input(INPUT_POST, 'clave'));
    $datos = compact('nombre', 'correo', 'pass');
    $usuarios = $usuario->altaUsuario($datos);
} catch (Exception $e) {
    $usuarios = array('codigo' => '99', 'mensaje' => $e->getMessage());
}
echo json_encode($usuarios);
