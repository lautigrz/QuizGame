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
        var_dump(count($this->preguntasDeLaPartida()));
        echo "";
        var_dump($this->model->obtenerCantidadDePreguntasConDificultadDelUsuario($this->idUsuario()));
        echo "";
        var_dump($this->model->obtenerCantidadDePreguntasConDificultadVistasPorElUsuario($this->idUsuario()));
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
        $this->model->guardarPartida($this->idUsuario());
        $_SESSION['puntaje'] = 0;     
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
    if(count($this->preguntasDeLaPartida()) >= 2){

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
    

    if (!$this->preguntaDisponibleParaElUsuario($preguntas, $id)) {
  
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
        $pregunta = $_SESSION['preguntas']['id'];
        $respuesta = $_GET['respuesta'];
        $correcta = 0;
        $opcion = $this->obtenerRespuestaCorrecta($pregunta);
        if($respuesta == $opcion){
            $_SESSION['puntaje'] +=1;
            $correcta = 1;
        }else{
            $_SESSION['respuesta_incorrecta'] = true;
            $this->finalizarPartida();
         
        }
        $this->model->respuestaDelUsuario($this->idUsuario(), $pregunta, $correcta);
        header('Location: /quizgame/juego/partida');
        exit();
    }

    public function obtenerRespuestaCorrecta($id){
        $dt = $this->model->verificar($id);
        return $dt[0]['opcion'];
    }

    public function finalizarPartida(){

        $data = [
            "puntaje" => $_SESSION['puntaje'],
            "id" => $this->idUsuario()
        ];

        $this->model->actualizarPartida($data);
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
        header('Location: /quizgame/home/lobby');
    }

    private function preguntaActualDeLaPartida($pregunta){
        $_SESSION['preguntas'] = $pregunta;
    }

    private function idUsuario(){
      return $this->existeUsuario() ? $_SESSION['user']['id'] : null;
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
        return isset($_SESSION['preguntas_data']) ? $_SESSION['preguntas_data'] : []; // Retornar un array vacío en lugar de 0
    }
    



}