<?php

class HomeController{
    private $presenter;
    private $model;

    public function __construct($model,$presenter){
        $this->presenter = $presenter;
    }

    public function lobby()
    {
        $data = [];
        $this->setDatos($data);
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