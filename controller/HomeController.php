<?php

class HomeController{
    private $presenter;
    private $model;
 
    public function __construct($model,$presenter){
        $this->presenter = $presenter;
        $this->model = $model;

    }

    public function ranking(){
        $data = [];
        
        $this->dataRanking($data);
    
        $this->presenter->show('ranking', $data);
    }


    public function dataRanking(&$data){
        $rank = $this->model->obtenerRankingUsuarios();

        $usuarioLogueado = $_SESSION['user']['usuario'];
      
      
        foreach ($rank as &$usuario) {
            $usuario['isUserLogged'] = ($usuario['usuario'] === $usuarioLogueado);
        }
        
        $data = [
            "ranking" => $rank,
            "user" => $_SESSION['user'],
        ];
    }

    public function lobby()
    {
        $data = [];
        $this->data($data);
        unset($_SESSION['preguntas_data'],$_SESSION['respuesta_incorrecta']);
     
        $this->presenter->show('lobby', $data);
    }

    public function data(&$data){

        $rank = $this->model->obtenerRankingUsuarios();
        $fecha = $this->model->ultimaPartida($this->idUsuario());

        $usuarioLogueado = $_SESSION['user']['usuario'];
        $newRank = $this->queAparezcaElUsuarioEnElRankingSinImportarLaPosicion($rank, $usuarioLogueado);
      
        foreach ($newRank as &$usuario) {
            $usuario['isUserLogged'] = ($usuario['usuario'] === $usuarioLogueado);
        }

        $data = [
            "ranking" => $newRank,
            "user" => $_SESSION['user'],
            "partida" => $this->model->verificarSiTieneUnaPartidaActiva($this->idUsuario()),
            "fecha" => $fecha,
            "notificaciones" => $this->model->notificaciones($this->idUsuario())
         
        ];

    }

    public function leer(){
        $id = $_GET['id'];

        $this->model->leer($id);
        header('Location: /quizgame/home/lobby');
        exit();
    }


    public function queAparezcaElUsuarioEnElRankingSinImportarLaPosicion($rank, $usuarioLogueado) {
        $newRank = [];
        $contador = 0;

    foreach ($rank as $ranking) {
     
        if ($contador < 5) {
            $newRank[] = $ranking; 
          
        } else if($ranking['usuario'] === $usuarioLogueado){
            $newRank[] = $ranking; 
        }
        $contador++; 
    }
    
        return $newRank; 
    }

    private function idUsuario(){
        return isset($_SESSION['user']) ? $_SESSION['user']['id'] : 0;
      }

}