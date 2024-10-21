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
        $this->setDatos($data);
        $this->presenter->show('login', $data);
    }

    public function mostrarUserView()
    {
        $data = [];
        $this->setDatos($data);
        $this->presenter->show('user', $data);
        
    }

    public function mostrarLobbyView()
    {
        $this->presenter->show('lobby', "");

    }

    public function mostrarRegisterView()
    {
        $this->presenter->show('register', "");
    }
    public function register(){

        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $usuario = $_POST['usuario'];
        $genero = $_POST['genero'];
        $email = $_POST['email'];
        $pass = $_POST['password'];

        $usurioExistente = $this->model->buscarUsuario($usuario);
        
        if($usuarioExistente){
            $_SESSION['error'] = "Usuario existente";
        }
        else{
            $seRegistro = $this->model->registrarUsuario($nombre, $apellido, $usuario, $genero, $email, $pass, 0,0);
            $this->model->enviarCorreoVerificacion($email,$nombre,$usuario);
            $_SESSION['error'] = "Te hemos enviado un correo para verificar tu cuenta";
            header('Location: /quizgame/login');
            exit();
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
            header('Location: /quizgame/login');
            exit();
        } else {  
        }
    }

    public function procesarUsuario(){
        $user = $_POST['email'];
        $pass = $_POST['password'];
    
        $usuario = $this->model->validate($user, $pass);
        if ($usuario) {
            if($usuario[0]['estado'] == 1){
                $_SESSION['user'] = $usuario[0];
                header('Location: /quizgame/usuario/mostrarUserView');
                exit();
            } else {
                $_SESSION['error'] = "Verifica tu bandeja de correo y verifica tu cuenta";
                header('Location: /quizgame/login');
                exit();
            }
        } else {
            $_SESSION['error'] = "Usuario o contraseña no encontrado";
            header('Location: /quizgame/login');
            exit();  
        }
    }
    
    public function setDatos(&$data){
        if(!empty($_SESSION['error'])){
            $data["error"] = $_SESSION['error'];
            unset( $_SESSION['error']);
        }if(!empty($_SESSION['user'])){
            $data["user"] = $_SESSION['user'];
        }
    }
  
    }


