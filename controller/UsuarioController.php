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
    public function login()
    {
        $data = [];
        $this->setDatosError($data);
        $this->presenter->show('login', $data);
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
        $seRegistro = $this->model->registrarUsuario($nombre, $apellido, $usuario, $genero, $email, $pass, 0,0);
        $pass = $_POST['password'];
        if($seRegistro == true){
            $this->model->enviarCorreoVerificacion($email,$nombre,$usuario);
           # $this->presenter->show('validacionToken', "");
        
        }
    }


    private function crearArchivoConToken(int $token)
    {
        $archivo = fopen("token.txt", "a");
        fwrite($archivo," - " . $token);
        fclose($archivo);
    }

    public function auth()
    {
        if(isset($_GET['token']) && isset($_GET['usuario'])){
            $token = $_GET['token'];
            $usuario = $_GET['usuario'];
            $this->model->activarUsuario($usuario,$token);
            echo "activado";
        } else {  
        }
    }

}
