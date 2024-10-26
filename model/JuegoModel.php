<?php

class JuegoModel{

    private $database;

    public function __construct($database){
        $this->database = $database;
    }

    public function obtenerPregunta(){

           $pregunta = $this->pregunta();
           $opciones = $this->opciones($pregunta[0]['id']);
                    
                    $result = [
                     'id' => $pregunta[0]['id'],
                    'pregunta' => $pregunta[0]['pregunta'],
                    'opciones' => $opciones,
                    'color' => $pregunta[0]['color'],
                    'icono' => $pregunta[0]['icono']
                    ];
                    return $result;

    }

    public function obtenerPreguntasVistasPorElUsuario($id){

        $sql = "SELECT idPregunta FROM historico WHERE idUsuario = " . $id ." ";
        $preguntas = $this->database->query($sql);
        return $preguntas;
    } 
    
    public function guardarPreguntaVista($idUsuario,$idPregunta){
        $sql = "INSERT INTO historico (idUsuario,idPregunta) values ('". $idUsuario . "' , '". $idPregunta . "')";
        $this->database->query($sql);
    }

    private function opciones($id){
        
        $queryOpciones = "SELECT opcion
        FROM opciones
        WHERE preguntaID = " . $id . "
        ";

        $opciones = $this->database->query($queryOpciones);
        return $opciones;
    }

    private function pregunta(){
        $queryPregunta = "SELECT p.id, p.pregunta, c.color, c.icono
                    FROM preguntas p
                    JOIN categoria c on c.id = p.idCategoria
                    ORDER BY RAND()
                    LIMIT 1
                    "; 
                    $pregunta = $this->database->query($queryPregunta);
      return $pregunta;
    }

    public function verificar($preguntaID){

        $sql = "SELECT p.pregunta,o.opcion
        FROM opciones o
        JOIN preguntas p ON p.id = o.preguntaID
        JOIN respuesta r on r.opcionID = o.id
        WHERE r.preguntaID = " . $preguntaID . " ";

        $respuesta = $this->database->query($sql);

        return $respuesta;
    }

    public function guardarPartida($data){
        var_dump($data['fecha_partida']);
        $sql = "INSERT INTO partida (puntaje_obtenido,fecha_partida,idUsuario) values ('". $data['puntaje'] . "' , '". $data['fecha_partida'] . "' , '" . $data['user'] . "')";

        $this->database->query($sql);

        $this->actualizarPuntajeDeUsuario($data);
    }

    public function actualizarPuntajeDeUsuario($data){
        $sql = "UPDATE usuario 
        SET puntaje = puntaje + " . $data['puntaje'] . " 
        WHERE id = " . $data['user'];
        $this->database->query($sql);

    }

}