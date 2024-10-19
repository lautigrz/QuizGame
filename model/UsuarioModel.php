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
        $sql = "'SELECT 1 
                FROM usuario 
                WHERE username = '" . $user. "' 
                AND password = '" . $pass . "'";

        $usuario = $this->database->query($sql);

        return sizeof($usuario) == 1;
    }
    public function registrarUsuario($nombre, $apellido, $usuario, $genero, $email, $pass, $estadoCuenta, $token){

            $sql = "INSERT INTO usuario  (nombre, apellido, usuario, genero, email, password, estado, token) VALUES ('" . $nombre . "', '" . $apellido . "', '" . $usuario . "', '" . $genero . "', '" . $email . "', '" . $pass . "', '" . $estadoCuenta . "', " . $token . ")";
            if (true) {
                return true;
            }
            return false;

    }




}