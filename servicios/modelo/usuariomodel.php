<?php
require_once("database.php");
class Usuarios extends Database{
    public function consultaUsuarios($idusuario){
        try{
            
            if($idusuario==0){
                $sql="SELECT * FROM usuarios ORDER BY usuario ASC";
            }else{
                $sql="SELECT * FROM usuarios WHERE id = $idusuario";
            }
            $stmt=$this->conexion->query($sql);
            if($idusuario==0){
                $tablausuarios=$stmt->fetchAll(PDO::FETCH_ASSOC);
            }else{
                $tablausuarios=$stmt->fetch(PDO::FETCH_ASSOC);
            }
            return $tablausuarios;
           
        }catch(PDOException $e){
           
            return array('codigo'=>'99','mensaje'=>'Error: '.$e->getMessage());
        }

    }
    public function actualizarUsuario($datos){
        try{
            extract($datos);
            $sql = "UPDATE usuarios SET usuario = :usuario, roles = :roles, correo=:correo WHERE id = :id";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':usuario', $cliente);
            $stmt->bindParam(':roles', $roles);
            $stmt->bindParam(':correo', $correo);
            $stmt->execute();
            if($stmt->rowCount() != 0){
                return array('codigo'=>'00','mensaje'=>'');
            }else{
                throw new Exception('Usuario sin modificar',30);
            }
        }catch(PDOException $e){
            throw new Exception((string)$e->getMessage(), (int)$e->getCode());
        }
    }
    public function bajaUsuario($datos){
        try{
            extract($datos);
            $sql = "DELETE FROM usuarios WHERE id = :id";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            if($stmt->rowCount() != 0){
                return array('codigo'=>'00','mensaje'=>'Usuario dado de baja correctamente');
            }else{
                throw new Exception('No se ha podido dar de baja el usuario',30);
            }
        }catch(PDOException $e){
         
            throw new Exception((string)$e->getMessage(), (int)$e->getCode());
        }
    }
    public function altaUsuario($datos){
        try{
            extract($datos);
            $sql = "INSERT INTO usuarios (usuario, pass, correo) VALUES (:usuario, :pass, :correo)";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':usuario', $nombre);
            $stmt->bindParam(':pass', $pass);
            $stmt->bindParam(':correo', $correo);
            $stmt->execute();
            return array('codigo'=>'00','mensaje'=>'Usuario dado de alta correctamente');
        }catch(PDOException $e){
            if($e->errorInfo[1]==1062){
                throw new Exception('Password ya existe', 99);
            }
            throw new Exception((string)$e->getMessage(), (int)$e->getCode());
        }catch(Exception $e){
            throw new Exception((string)$e->getMessage(), (int)$e->getCode());
        }
    }
}
