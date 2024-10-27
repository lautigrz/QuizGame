<?php

class HomeController{
    private $presenter;
    private $model;
    private $rankingModel;
    public function __construct($model,$presenter,$rankingModel){
        $this->presenter = $presenter;
        $this->model = $model;
        $this->rankingModel = $rankingModel;
    }

    public function lobby()
    {
        $data = [];
        $this->setDatos($data);

        $data['ranking'] = $this->rankingModel->obtenerRankingUsuarios();
        $this->presenter->show('lobby', $data);
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