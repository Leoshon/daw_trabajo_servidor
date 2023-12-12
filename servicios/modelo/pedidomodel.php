<?php 

require_once("database.php");
class Pedido extends Database{
    public function consultaPedidosUsuario($datos){
        try{
                extract($datos);
                $sql = "SELECT usuarios.usuario,productos.nombreprod, pedido.fecha, pedido.total FROM pedido JOIN usuarios ON  pedido.idusuario = usuarios.id JOIN productos ON pedido.idprod = productos.idprod WHERE pedido.idusuario = $idusuario ORDER BY fecha DESC";
                $stmt = $this->conexion->prepare($sql);
                $stmt->execute();
                $resultado= $stmt->fetchAll(PDO::FETCH_ASSOC); 
                if($stmt->rowCount() != 0){
                   return array('codigo' => '00', 'mensaje' => $resultado);
                }else{
                    return array('codigo' => '01', 'mensaje' => 'No hay pedidos');   
                }
           
        }catch(PDOException $e){
            $resultado=$e->getMessage();
        }
    }
    public function altaPedido($datos){
        try{
            extract($datos);
            $sql = "INSERT INTO pedido ( idusuario,idprod, total, fecha ) VALUES ( :idusuario,:idproducto, :total,:fecha )";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':idusuario', $idusuario);
            $stmt->bindParam(':idproducto', $idproducto);
            $stmt->bindParam(':total', $total);
            $stmt->bindParam(':fecha', $fecha);
            $stmt->execute();
         if($stmt->rowCount() != 0){
               
               return array('codigo' => '00', 'mensaje' => "Pedido registrado correctamente");
            }else{
                return false;   
            } 
           
        }catch(PDOException $e){
            return array('codigo' => '99', 'mensaje' => $e->getMessage());
        }
    }
    public function filtroProducto($valor){
        try{
            if($valor == " "){
                $sql = "SELECT productos.nombreprod, pedido.total, pedido.fecha, usuarios.usuario FROM pedido  JOIN usuarios ON pedido.idusuario = usuarios.id JOIN productos ON pedido.idprod = productos.idprod ORDER BY pedido.fecha DESC" ;
            }else{
                $sql = "SELECT productos.nombreprod, pedido.total, pedido.fecha, usuarios.usuario FROM pedido  JOIN usuarios ON pedido.idusuario = usuarios.id JOIN productos ON pedido.idprod = productos.idprod WHERE productos.nombreprod LIKE '$valor%' ORDER BY pedido.fecha DESC";
            }
            
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute();
            $resultado= $stmt->fetchAll(PDO::FETCH_ASSOC);
            if($stmt->rowCount() != 0){
                return array('codigo' => '00', 'mensaje' => $resultado);
             }else{
                 return array('codigo' => '01', 'mensaje' => 'Producto no encontrado en pedidos');   
             }
            }catch(PDOException $e){
                return array('codigo' => '99', 'mensaje' => $e->getMessage());
            }
}
   
}
    