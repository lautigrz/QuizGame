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
    
    public function obtenerPreguntas(){
        $this->preguntaAlazar();
        header('Location: /quizgame/juego/preguntas');
        exit();
    }

public function preguntaAlazar() {
         $preguntaActual = "";

    if (!$this->hayRespuestaIncorrecta()) {
       
        $preguntaActual = $this->model->obtenerPregunta();

        if($this->guardarPreguntasDeLaPartida($preguntaActual)){

           $this->guardarPregunta($preguntaActual);
        
        }else{
            $this->obtenerPreguntas();
        }
    }

    return $preguntaActual;
}

public function guardarPreguntasDeLaPartida($preguntas) {

    if (!isset($_SESSION['preguntas_total'])) {
        $_SESSION['preguntas_total'] = [];
    }

    if (!$this->verificarQueNoSeaPreguntaRepetida($preguntas['pregunta'])) {
     
        $_SESSION['preguntas_total'][] = ['pregunta' => $preguntas['pregunta']];
   
        return true;
    }
    return false;
}

    public function verificarQueNoSeaPreguntaRepetida($pregunta) {

    $hayRepetida = false;
    foreach ($_SESSION['preguntas_total'] as $preguntaExistente) {
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

        $dt = $this->model->verificar($pregunta);
        if($respuesta == $dt[0]['opcion']){
            header('Location: /quizgame/juego/obtenerPreguntas');
            exit();
        }else{
            $_SESSION['respuesta_incorrecta'] = true;
            unset($_SESSION['preguntas_total']);
            header('Location: /quizgame/juego/obtenerPreguntas');
        exit();
        }
       
    }

    public function setData(&$data){
        if(!empty($_SESSION['error'])){
            $data["error"] = $_SESSION['error'];
            unset( $_SESSION['error']);
        }if(!empty($_SESSION['preguntas'])){
            $data["preguntas"] = $_SESSION['preguntas'];
          
        }if(!empty( $_SESSION['respuesta_incorrecta'])){
            $data['respuesta_incorrecta'] =  $_SESSION['respuesta_incorrecta'];
            unset($_SESSION['respuesta_incorrecta']);
        }
    }

    private function guardarPregunta($pregunta){
        $_SESSION['preguntas'] = $pregunta;
    }
    private function hayRespuestaIncorrecta() {
        return isset($_SESSION['respuesta_incorrecta']);
    }

}