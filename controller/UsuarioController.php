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
            $data["user"] = $_SESSION['user'];
        }if(!empty($_SESSION['editorPreguntas'])){
            $data["editorPreguntas"] = $_SESSION['editorPreguntas'];
        }
    }

}
  

   





