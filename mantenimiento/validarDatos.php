<?php
function validarDatosProducto($nombreprod, $imagenprod, $precio)
{
    $mensajes = '';
    if (empty($nombreprod) || empty($imagenprod) || empty($precio)) {
        $mensajes .= 'Los campos no pueden estar vacios<br>';
    }
    if ($precio == 0 || $precio < 0) {
        $mensajes .= 'El precio no puede ser 0 o negativo<br>';
    }
    return $mensajes;
}
function validarDatosUsuario($usuario,$roles,$correo){
    $mensajes = '';
    if (empty($usuario) || empty($roles) || empty($correo)) {
        $mensajes .= 'Los campos no pueden estar vacios<br>';
    }
    if($roles != 'administrador' && $roles != 'cliente'){
        $mensajes .= 'El rol debe ser administrador o cliente<br>';
    }
    return $mensajes;
}
?>