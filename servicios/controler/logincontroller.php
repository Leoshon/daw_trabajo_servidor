<?php
require_once("../modelo/loginmodel.php");
session_start();
if(!isset($_SESSION['usuario'])){
    $_SESSION['usuario'] = null;
}
$cliente = new Usuario();

try{
    $nombre = filter_input(INPUT_POST,'usuario');
    $pass = md5(filter_input(INPUT_POST,'password'));
    $datos = compact('nombre','pass');
    $resultado = $cliente->loginUsuario($datos);
    if($resultado['codigo']=='00'){
        $_SESSION['usuario'] = $resultado['mensaje'];
    }


}catch(Exception $e){
    $resultado = array('codigo'=>'99', 'mensaje'=>$e->getMessage());
}
echo json_encode($resultado);
