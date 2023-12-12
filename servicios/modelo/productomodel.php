<?php
require_once("database.php");
class Productos extends Database
{
    public function consultaTodosProductos($datos)
    {
        try {
            extract($datos);
            if ($idproducto == 0) {
                $sql = "SELECT * FROM productos ORDER BY nombreprod ASC";
            } else {
                $sql = "SELECT * FROM productos WHERE idprod = $idproducto";
            }
            $stmt = $this->conexion->query($sql);
            if ($idproducto == 0) {
                $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $productos = $stmt->fetch(PDO::FETCH_ASSOC);
            }
            return array('codigo' => '00', 'mensaje' => $productos);
        } catch (PDOException $e) {

            return array('codigo' => '99', 'mensaje' => 'Error: ' . $e->getMessage());
        }
    }
    public function actualizarProductos($datos)
    {
        try {
            extract($datos);
            $sql = "UPDATE productos SET nombreprod = :nombreprod, imagenprod = :imagenprod, precio = :precio WHERE idprod = :idprod";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':idprod', $idproducto);
            $stmt->bindParam(':nombreprod', $nombreprod);
            $stmt->bindParam(':imagenprod', $imagenprod);
            $stmt->bindParam(':precio', $precio);
            $stmt->execute();
            if ($stmt->rowCount() != 0) {
                return array('codigo' => '00', 'mensaje' => '');
            } else {
                throw new Exception('Producto sin actualizar');
            }
        } catch (PDOException $e) {
            return array('codigo' => '99', 'mensaje' => 'Error: ' . $e->getMessage());
        }
    }
    public function bajaProductos($datos)
    {
        try {
            extract($datos);
            $sql = "DELETE FROM productos WHERE idprod = :idprod";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':idprod', $idproducto);
            $stmt->execute();
            if ($stmt->rowCount() != 0) {
                return array('codigo' => '00', 'mensaje' => 'Producto dado de baja correctamente');
            } else {
                throw new Exception('No se ha podido dar de baja el producto');
            }
        } catch (PDOException $e) {
            return array('codigo' => '99', 'mensaje' => 'Error: ' . $e->getMessage());
        }
    }
    public function altaProducto($datos){
        try{
            extract($datos);
            $sql = "INSERT INTO productos (nombreprod, imagenprod, precio) VALUES (:nombreprod, :imagenprod, :precio)";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':nombreprod', $nombreprod);
            $stmt->bindParam(':imagenprod', $imagenprod);
            $stmt->bindParam(':precio', $precio);
            $stmt->execute();
            $idproducto = $this->conexion->lastInsertId();
            return array('codigo' => '00', 'mensaje' => "Producto dado de alta correctamente con el id:  $idproducto");
         
        }catch(PDOException $e){
            throw new Exception((string)$e->getMessage(), (int)$e->getCode());
        }catch(Exception $e){
            throw new Exception((string)$e->getMessage(), (int)$e->getCode());
        }
    }
}
