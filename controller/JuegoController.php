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
            $this->preguntaAlazar();
            header('Location: /quizgame/juego/preguntas');
            exit();
    
    }

    public function empezarPartida(){
        if($this->existeUsuario() && $this->verificarQueNoHayaPartidaAciva()){
           
            $this->nuevaPartida();

            $this->partida();
        }
        header('Location: /quizgame/home/lobby');
        exit();
    }

    public function nuevaPartida(){
        unset($_SESSION['preguntas_data']);
        $this->model->guardarPartida($this->idUsuario());
           
    }

    public function preguntaAlazar() {

    if (!$this->hayRespuestaIncorrecta()) {
       
        $preguntaActual = $this->obtenerPreguntas();

        if($this->guardarPreguntasDeLaPartidaEnCurso($preguntaActual)){

           $this->preguntaActualDeLaPartida($preguntaActual);
        
        }else{
            $this->partida();
        }
    }

}

public function obtenerPreguntas(){
    $pregunta = "";
    if(count($this->preguntasDeLaPartida()) >= 10){

    $pregunta = $this->model->preguntaConDifcultad($this->idUsuario());
    
        if($this->yaVioTodasLasPreguntasConDificultad()){

            $pregunta = $this->model->obtenerPregunta();
        }
    }else{

     $pregunta = $this->model->obtenerPregunta();
    }
    return $pregunta;
}

public function yaVioTodasLasPreguntasConDificultad(){

    $cantidad = $this->model->obtenerCantidadDePreguntasConDificultadDelUsuario($this->idUsuario());
    $total = $this->model->obtenerCantidadDePreguntasConDificultadVistasPorElUsuario($this->idUsuario());

    if($cantidad === $total){
        return true;
    }

    return false;
}

public function guardarPreguntasDeLaPartidaEnCurso($preguntas) {

    if (!isset($_SESSION['preguntas_data'])) {
        $_SESSION['preguntas_data'] = [];
    }
        $id = $this->idUsuario();
    

    if (!$this->preguntaDisponibleParaElUsuario($preguntas, $id) && $preguntas['id'] != $_SESSION['preguntas']['id']) {
  
        $_SESSION['preguntas_data'][] = ['pregunta' => $preguntas['pregunta']];
        $this->model->guardarPreguntaVista($id,$preguntas['id']);
        return true;
    }
    return false;
}   
    public function preguntaDisponibleParaElUsuario($pregunta, $id){

    $preguntas = $this->model->obtenerPreguntasVistasPorElUsuario($id);

    foreach ($preguntas as $preg) {
        if ($preg['idPregunta'] === $pregunta['id']) {
            $this->verificarSiYaVioTodasLasPreguntas();
            return true;
        }
    }


    return false;
}

    public function verificarSiYaVioTodasLasPreguntas(){

        $totalVista = $this->model->obtenerCantidadDePreguntasVistasPorElUsuario($this->idUsuario());
        $preguntasTotales = $this->model->obtenerCantidadDePreguntas();
        
        if ($preguntasTotales === $totalVista) {
            $this->model->limpiarPreguntasVistas($this->idUsuario());
        }
        
    }
    public function esCorrecta(){

        $pregunta = $this->model->preguntaEntregada($this->idUsuario());
        $respuesta = $_POST['respuesta'];
        $hora_entrega = $pregunta[0]['hora']; 

        $tiempo_respuesta = $this->tiempo($hora_entrega);
        
        $correcta = 0;
        $opcion = $this->obtenerRespuestaCorrecta($pregunta[0]['idPregunta']);
        if($respuesta == $opcion && $tiempo_respuesta < 12){

            $this->model->actualizarPuntaje($this->idUsuario());
            $correcta = 1;

        }else{
            $_SESSION['respuesta_incorrecta'] = true;
            $this->model->finalizarPartida($this->idUsuario());
        }
        $this->model->respuestaDelUsuario($this->idUsuario(), $pregunta[0]['idPregunta'], $correcta);
        header('Location: /quizgame/juego/partida');
        exit();
    }

    public function obtenerRespuestaCorrecta($id){
        $dt = $this->model->verificar($id);
        return $dt[0]['opcion'];
    }

    public function finalizarPartida(){
        $this->model->finalizarPartida($this->idUsuario());
        header('Location: /quizgame/home/lobby');
        exit();
    }

 
    

    public function reportePregunta()
    {
        $data = $_POST;
        $this->model->reportePregunta($data);
        header('Location: /quizgame/home/lobby');
    }



    private function setData(&$data){
        if(!empty($_SESSION['error'])){
            $data["error"] = $_SESSION['error'];
            unset( $_SESSION['error']);
        }if(!empty($_SESSION['preguntas'])){        
            $data = [ 
                "preguntas" =>  $_SESSION['preguntas'],
                "puntaje" => $this->model->ultimaPartida($this->idUsuario())
        ];
        }if(!empty( $_SESSION['respuesta_incorrecta'])){

            $id = $_SESSION['preguntas']['id'];
            $respuestaCorrecta = $this->obtenerRespuestaCorrecta($id);
            $data = [
                "preguntas" => $_SESSION['preguntas'],
                "respuesta_incorrecta" => $_SESSION['respuesta_incorrecta'],
                "puntaje" => $this->model->ultimaPartida($this->idUsuario()),
                "respuesta" => $respuestaCorrecta

            ];
          
        }
    }
    
    private function tiempo($hora_entrega){
        $timestamp_entrega = strtotime($hora_entrega);
        return $tiempo_respuesta = time() - $timestamp_entrega;
    }

    private function preguntaActualDeLaPartida($pregunta){
        $_SESSION['preguntas'] = $pregunta;
    }

    private function idUsuario(){
      return $this->existeUsuario() ? $_SESSION['user']['id'] : null;
    }

    private function verificarQueNoHayaPartidaAciva() {
        $query = $this->model->verificarSiTieneUnaPartidaActiva($this->idUsuario());
        return empty($query); 
    }
    
    
    private function existeUsuario() {
        return isset($_SESSION['user']);
    }
    private function hayRespuestaIncorrecta() {
        return isset($_SESSION['respuesta_incorrecta']);
    }
    private function preguntasEnCurso() {
        return isset($_SESSION['preguntas_data']);
    }
    private function preguntasDeLaPartida() {
        return isset($_SESSION['preguntas_data']) ? $_SESSION['preguntas_data'] : [];
    }

}