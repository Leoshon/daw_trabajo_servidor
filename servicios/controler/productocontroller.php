<?php
require_once '../modelo/productomodel.php';
$producto = new Productos();

        try{
            $idproducto = filter_input(INPUT_POST,'idproducto');
            $datos = compact('idproducto');
            $productos = $producto->consultaTodosProductos($datos);
        }catch(Exception $e){
            $productos = array('codigo'=>'99', 'mensaje'=>$e->getMessage());
        }
        echo json_encode($productos);
