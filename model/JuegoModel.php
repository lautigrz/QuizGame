<?php

class JuegoModel{

    private $database;

    public function __construct($database){
        $this->database = $database;
    }

    public function obtenerPregunta(){

                    $queryPregunta = "SELECT id, pregunta
                    FROM preguntas
                    ORDER BY RAND()
                    LIMIT 1
                    "; 
                    $pregunta = $this->database->query($queryPregunta);

                    $queryOpciones = "SELECT opcion
                    FROM opciones
                    WHERE preguntaID = " . $pregunta[0]['id'] . "
                    ";
 
                    $opciones = $this->database->query($queryOpciones);
       
                    $result = [
                     'id' => $pregunta[0]['id'],
                    'pregunta' => $pregunta[0]['pregunta'],
                    'opciones' => $opciones
                    ];
                    return $result;

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


}