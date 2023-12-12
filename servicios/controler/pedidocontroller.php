<?php
require_once("../modelo/pedidomodel.php");
$pedido = new Pedido();
$peticion = filter_input(INPUT_POST, 'peticion');
switch ($peticion){
    case 'R':
        try{
            $idusuario = filter_input(INPUT_POST,'idusuario');
            $idproducto = filter_input(INPUT_POST,'idproducto');
            $fecha = Date('Y-m-d H:i:s');
            $total = filter_input(INPUT_POST,'total');
            $datos = compact('idusuario','idproducto','fecha','total');
            $pedidos = $pedido-> altaPedido($datos);
        
        }catch(Exception $e){
            $pedidos = array('codigo'=>'99', 'mensaje'=>$e->getMessage());
        }
        echo json_encode($pedidos);
        break;
    case 'C':
        try{
            $idusuario = filter_input(INPUT_POST,'idusuario');
            $datos = compact('idusuario');
            $pedidos = $pedido-> consultaPedidosUsuario($datos);
        }catch(Exception $e){
            $pedidos = array('codigo'=>'99', 'mensaje'=>$e->getMessage());
        }
        echo json_encode($pedidos);
        break;
    case 'f':
        try{
            $valor = filter_input(INPUT_POST,'valor');
            $pedidos = $pedido-> filtroProducto($valor);
        }catch(Exception $e){
            $pedidos = array('codigo'=>'99', 'mensaje'=>$e->getMessage());
        }
        echo json_encode($pedidos);
        break;
    
}
