<?php

class UsuarioController
{

    private $model;
    private $presenter;

    public function __construct($model, $presenter)
    {
        $this->model = $model;
        $this->presenter = $presenter;
    }

    public function auth()
    {
        $user = $_POST['username'];
        $pass = $_POST['password'];

        $validation = $this->model->validate($user, $pass);

        if ($validation) {
            $_SESSION['user'] = $user;
        }

        header('location: /pokedex');
        exit();
    }

    public function mostrarRegisterView()
    {
        $this->presenter->show('register', "");
    }
    public function mostrarValidacionView()
    {
        $this->presenter->show('validacionToken', "");
    }
    public function register(){

        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $usuario = $_POST['usuario'];
        $genero = $_POST['genero'];
        $email = $_POST['email'];
        $pass = $_POST['password'];
        $token = rand(100000, 999999);

        $this->model->registrarUsuario($nombre, $apellido, $usuario, $genero, $email, $pass, 0, $token);
        $this->crearArchivoConToken($token);



        $this->presenter->show('validacionToken', "");
        exit();
    }


    private function crearArchivoConToken(int $token)
    {
        $archivo = fopen("token.txt", "a");
        fwrite($archivo," - " . $token);
        fclose($archivo);
    }
    public function validarToken(){

        $token = $_GET['token'];
        if ($token === $_SESSION['token']) {
            echo "Cuenta verificada";
            return $this->presenter->show('login', "");
        }

    }

}