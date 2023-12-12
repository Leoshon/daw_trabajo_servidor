<?php
require_once("database.php");
class Usuario extends Database
{
    public function altaUsuario($datos)
    {
        try {
            $sql = $this->conexion->prepare('INSERT INTO usuario(nombre, pass) VALUES (:nombre, :pass)');
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':pass', $pass);
            $stmt->execute();
            $id = $this->conexion->lastInsertId();
            return array('codigo' => '00', 'mensaje' => "Usuario registrado correctamente con el id: $id");
        } catch (PDOException $e) {
            if ($e->errorInfo[1] == 1062) {
                throw new Exception("El usuario ya existe", 30);
            }
            throw new Exception((string)$e->getMessage(), (int)$e->getCode());
        } catch (Exception $e) {
            throw new Exception((string)$e->getMessage(), (int)$e->getCode());
        }
    }
    public function loginUsuario($datos)
    {
        try {
            extract($datos);
            $sql = "SELECT * FROM usuarios WHERE usuario = :nombre AND pass = :pass";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':pass', $pass);
            $stmt->execute();
            $respuesta = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($stmt->rowCount() != 0){
                return  array('codigo' => '00', 'mensaje' => $respuesta);
            } else {
                return array('codigo' => '99', 'mensaje' => "Usuario o contraseña incorrectos");
            }
        } catch (PDOException $e) {
            throw new Exception((string)$e->getMessage(), (int)$e->getCode());
        } catch (Exception $e) {
            throw new Exception((string)$e->getMessage(), (int)$e->getCode());
        }
    }
}
