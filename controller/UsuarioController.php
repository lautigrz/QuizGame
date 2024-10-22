<?php
class UsuarioController
{
    private $model;
    private $presenter;
    private $mailer;

    public function __construct($model, $presenter, $mailer)
    {
        $this->model = $model;
        $this->presenter = $presenter;
        $this->mailer = $mailer;
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
        $data = [];
        $this->setDatos($data);
        $this->presenter->show('lobby', $data);

    }

    public function mostrarRegisterView()
    {
        $data = [];
        $this->setDatos($data);
        $this->presenter->show('register', $data);
    }
    public function register() {
        try {
            $data = $_POST;
            $this->validateRegisterInput($data);
            
            $usuario = $this->registerUser($data);
    
            $this->sendVerificationEmail($data['email'], $data['nombre'], $data['usuario']);
            
            $_SESSION['error'] = 'Te hemos enviado un correo para verificar tu cuenta';
            header('Location: /quizgame/login');
            exit();
            
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            header('Location: /quizgame/usuario/mostrarRegisterView');
            exit();
        }
    }
    

    public function validateRegisterInput($data) {
        if ($data['password'] !== $data['repeatPassword']) {
            throw new Exception('Las contraseñas no coinciden');
        }
    }
    public function registerUser($data) {
        $usuarioExistente = $this->model->buscarUsuario($data['usuario']);
        if ($usuarioExistente) {
            throw new Exception('Usuario existente');
        }
        
        return $this->model->registrarUsuario($data);
    }
    
    public function sendVerificationEmail($email, $nombre, $usuario) {
        $token = $this->getVerificationToken($usuario);
        $this->mailer->sendVerificationEmail($email, $nombre, $usuario, $token);
    }

    public function cerrarSesion(){
        session_destroy();
        header('Location: /quizgame/login');
        exit();

    }
    private function crearArchivoConToken($token)
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
        $user = $_POST['user'];
        $pass = $_POST['password'];
    
        $usuario = $this->model->validate($user, $pass);
        if ($usuario) {
            if($usuario[0]['estado'] == 1){
                $_SESSION['user'] = $usuario[0];
                header('Location: /quizgame/usuario/mostrarLobbyView');
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

    private function getVerificationToken($usuario) {
        $usuarioData = $this->model->buscarUsuario($usuario);
        return $usuarioData[0]['token'] ?? null;
    }
  
    }


