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

    public function mostrarUserView()
    {
        $data = [];
        $this->setDatos($data);
        $this->presenter->show('user', $data);
        
    }

  public function perfil(){
    if (isset($_GET['id'])) {
        $userId = $_GET['id'];
        $userData = $this->model->getUser($userId);

        if ($userData) {
            $data = [
                'userVist' => $userData, // Datos del usuario a ver
                'user' => $_SESSION['user'] // Datos del usuario logueado
            ];
            $this->presenter->show('user', $data);
        } 
    }
}


    private function crearArchivoConToken($token)
    {
        $archivo = fopen("token.txt", "a");
        fwrite($archivo," - " . $token);
        fclose($archivo);
    }
    public function setDatos(&$data){
        if(!empty($_SESSION['error'])){
            $data["error"] = $_SESSION['error'];
            unset( $_SESSION['error']);
        }if(!empty($_SESSION['user'])){
            $partidas = $this->model->partidasJugadas(68);

            $data = [
                "userVist" => $_SESSION['user'],
                "partidas" => $partidas
            ];

        }if(!empty($_SESSION['editorPreguntas'])){
            $data["editorPreguntas"] = $_SESSION['editorPreguntas'];
        }
    }
    
}
  

   





