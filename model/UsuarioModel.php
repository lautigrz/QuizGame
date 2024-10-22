<?php

class UsuarioModel
{
    private $database;
 
    public function __construct($database)
    {
        $this->database = $database;
    }

    public function validate($user, $pass)
    {
        $sql = "SELECT *
                FROM usuario 
                WHERE email = '" . $user. "' 
                AND password = '" . $pass . "'";

        return $this->database->query($sql);
    }
    public function registrarUsuario($data){
            $token = rand(100000, 999999);
            $sql = "INSERT INTO usuario(nombre, apellido, usuario, genero, email, password , estado, token) VALUES ('" . $data['nombre'] . "', '" . $data['apellido'] . "', '" . $data['usuario']  . "', '" . $data['genero']  . "', '" . $data['email']  . "', '" . $data['password']  . "', '" . 0 . "', " . $token . ")";
            
            return $this->database->query($sql);
    }

    public function enviarCorreoVerificacion($mail, $nombre, $usuario){
        
       $this->guardarToken($usuario, $codigoVerificacion);

    }
    public function buscarUsuario($nombreUsuario) {
        return $this->database->query("SELECT * FROM `usuario` WHERE usuario = '$nombreUsuario'");
    }
    public function guardarToken($username, $codigoVerificacion) {
         $usuarioResult = $this->buscarUsuario($username);
        
        if (isset($usuarioResult)) {
            $idUsuario = $usuarioResult[0]['id']; 
            $this->database->query("UPDATE usuario SET token = $codigoVerificacion WHERE id= '$idUsuario'");
        }
    }

    public function activarUsuario($user, $token) {
        $usuarioResult = $this->buscarUsuario($user);
        
        if (!$usuarioResult || $usuarioResult[0]['token'] !== $token) {
            throw new Exception("Token inválido o usuario no encontrado.");
        }
        $this->cambiarEstado($usuarioResult[0]['id']);
    }
    
    private function cambiarEstado($id) {
        $estado = 1;
        $this->database->query("UPDATE usuario SET estado = '$estado' WHERE id = '$id'");
    }
    
}