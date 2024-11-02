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
        //$data = [];
        // $this->setDatos($data);
        // $this->presenter->show('user', $data);
        
            $usuario = $_GET['usuario'] ?? null;
        
            if ($usuario) {
                $userData = $this->model->buscarUsuario($usuario);
                if ($userData) {
                    $data = ['user' => $userData[0]]; // Asumiendo que `buscarUsuario` devuelve un array con la información del usuario
                    $this->presenter->show('user', $data);
                } else {
                    echo "Usuario no encontrado.";
                }
            } else {
                echo "Usuario no especificado.";
            }
        
    }

  public function perfil(){
    if (isset($_GET['id'])) {
        $userId = $_GET['id'];
        $partidas = $this->model->partidasJugadas($userId);
        $userData = $this->model->getUser($userId);

        if ($userData) {
            $data = [
                'userVist' => $userData,
                'user' => $_SESSION['user'],
                "partidas" => $partidas 
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
    private function idUsuario(){
        return $this->existeUsuario() ? $_SESSION['user']['id'] : null;
      }
      private function existeUsuario() {
        return isset($_SESSION['user']);
    }
      
    private function setDatos(&$data){
        if(!empty($_SESSION['error'])){
            $data["error"] = $_SESSION['error'];
            unset( $_SESSION['error']);
        }if(!empty($_SESSION['user'])){

            $partidas = $this->model->partidasJugadas($this->idUsuario());

            $data = [
                "user" => $_SESSION['user'],
                "userVist" =>$_SESSION['user'],
                "partidas" => $partidas
            ];

        }if(!empty($_SESSION['editorPreguntas'])){
            $data["editorPreguntas"] = $_SESSION['editorPreguntas'];
        }
    }
    
}
  

   





