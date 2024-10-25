<?php

class JuegoController{

    private $model;
    private $presenter;

    public function __construct($model,$presenter){
        $this->model = $model;
        $this->presenter = $presenter;
    }

    public function preguntas(){
        $data = [];
        $this->setData($data);
        $this->presenter->show("juego",$data);

        
    }
    
    public function partida(){

        if($this->existeUsuario()){

            if(!$this->preguntasEnCurso()){
            $this->nuevaPartida();
            $this->preguntaAlazar();
        }else{
            $this->preguntaAlazar();
        }
        }
        header('Location: /quizgame/juego/preguntas');
        exit();
    }

    public function nuevaPartida(){
        $_SESSION['puntaje'] = 0;
        $_SESSION['fecha_partida'] = date('Y-m-d H:i:s');       
    }

public function preguntaAlazar() {
         $preguntaActual = "";

    if (!$this->hayRespuestaIncorrecta()) {
       
        $preguntaActual = $this->model->obtenerPregunta();

        if($this->guardarPreguntasDeLaPartida($preguntaActual)){

           $this->guardarPregunta($preguntaActual);
        
        }else{
            $this->partida();
        }
    }

    return $preguntaActual;
}

public function guardarPreguntasDeLaPartida($preguntas) {

    if (!isset($_SESSION['preguntas_data'])) {
        $_SESSION['preguntas_data'] = [];
    }

    if (!$this->verificarQueNoSeaPreguntaRepetida($preguntas['pregunta'])) {
     
        $_SESSION['preguntas_data'][] = ['pregunta' => $preguntas['pregunta']];
   
        return true;
    }
    return false;
}

    public function verificarQueNoSeaPreguntaRepetida($pregunta) {

    $hayRepetida = false;
    foreach ($_SESSION['preguntas_data'] as $preguntaExistente) {
        if ($preguntaExistente['pregunta'] === $pregunta) {
            $hayRepetida = true;
            break;
        }
        
    }
    return $hayRepetida;
}
    public function esCorrecta(){
        $pregunta = $_SESSION['preguntas']['id'];
        $respuesta = $_GET['respuesta'];

        $opcion = $this->obtenerRespuestaCorrecta($pregunta);
        if($respuesta == $opcion){
            $_SESSION['puntaje'] +=1;
            header('Location: /quizgame/juego/partida');
            exit();
        }else{
            $_SESSION['respuesta_incorrecta'] = true;
           # unset($_SESSION['preguntas_data']);
            $this->finalizarPartida();
            header('Location: /quizgame/juego/partida');
        exit();
        }
       
    }

    public function obtenerRespuestaCorrecta($id){
        $dt = $this->model->verificar($id);
        return $dt[0]['opcion'];
    }

    public function finalizarPartida(){

        $data = [
            "puntaje" => $_SESSION['puntaje'],
            "fecha" => $_SESSION['fecha_partida'],
            "user" => $_SESSION['user']['id']
        ];

        $this->model->guardarPartida($data);
    }

    public function setData(&$data){
        if(!empty($_SESSION['error'])){
            $data["error"] = $_SESSION['error'];
            unset( $_SESSION['error']);
        }if(!empty($_SESSION['preguntas'])){
            $data["preguntas"] = $_SESSION['preguntas'];
        }if(!empty( $_SESSION['respuesta_incorrecta'])){

            $id = $_SESSION['preguntas']['id'];
            $respuestaCorrecta = $this->obtenerRespuestaCorrecta($id);
            $data = [
                "preguntas" => $_SESSION['preguntas'],
                "respuesta_incorrecta" => $_SESSION['respuesta_incorrecta'],
                "puntaje" => $_SESSION['puntaje'],
                "respuesta" =>  $respuestaCorrecta

            ];
            unset($_SESSION['preguntas_data'],$_SESSION['respuesta_incorrecta']);
        }
    }

    public function reportePregunta()
    {
        $data = $_POST;
        $this->model->reportePregunta($data);
        header('Location: /quizgame/usuario/mostrarLobbyView');
    }

    private function guardarPregunta($pregunta){
        $_SESSION['preguntas'] = $pregunta;
    }
    private function hayRespuestaIncorrecta() {
        return isset($_SESSION['respuesta_incorrecta']);
    }
    private function existeUsuario() {
        return isset($_SESSION['user']);
    }
    private function preguntasEnCurso() {
        return isset($_SESSION['preguntas_data']);
    }



}