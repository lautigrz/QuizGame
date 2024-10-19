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

    public function auth()
{
    $user = $_POST['email'];
    $pass = $_POST['password'];

    $usuario = $this->model->validate($user, $pass);
    var_dump($usuario);
    if ($usuario) {
        if($usuario[0]['estado'] == 1){
            $_SESSION['user'] = $usuario;
            header('Location: /quizgame/pokedex/list');
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
public function setDatosError(&$data){
    if(!empty($_SESSION['error'])){
        $data["error"] = $_SESSION['error'];
        unset( $_SESSION['error']);
    }
}
}