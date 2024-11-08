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
        $fecha = $this->model->ultimaPartida($_SESSION['user']['id']);

        $usuarioLogueado = $_SESSION['user']['usuario'];
        $newRank = $this->queAparezcaElUsuarioEnElRankingSinImportarLaPosicion($rank, $usuarioLogueado);
      
        foreach ($newRank as &$usuario) {
            $usuario['isUserLogged'] = ($usuario['usuario'] === $usuarioLogueado);
        }

        $data = [
            "ranking" => $newRank,
            "user" => $_SESSION['user'],
            "fecha" => $fecha
        ];

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
    

}