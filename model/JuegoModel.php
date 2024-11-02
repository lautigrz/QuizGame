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

    public function preguntaConDifcultad($idUsuario){
        $pregunta = $this->preguntaConDificultadMediaYDificil($idUsuario);
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

    public function preguntaConDificultadMediaYDificil($idUsuario){
        $sql = "SELECT p.id, c.color, c.icono, p.pregunta, d.porcentaje_acierto 
        FROM preguntas p 
        JOIN dificultad d ON d.idPregunta = p.id 
        JOIN categoria c ON c.id = p.idCategoria 
        WHERE d.idUsuario = " . $idUsuario . " 
        AND d.porcentaje_acierto BETWEEN 0 AND 70  -- Cambié 70 AND 0 por 0 AND 70
        ORDER BY RAND() 
        LIMIT 1";

      $query = $this->database->query($sql);
      return $query;
    }
    public function obtenerPreguntasVistasPorElUsuario($id){

        $sql = "SELECT * FROM historico WHERE idUsuario = " . $id ." ";
        $preguntas = $this->database->query($sql);
        return $preguntas;
    } 
    public function obtenerCantidadDePreguntasVistasPorElUsuario($id){

        $sql = "SELECT COUNT(*) FROM historico WHERE idUsuario = " . $id ." ";
        $preguntas = $this->database->query($sql);
        return $preguntas;
    } 

    public function obtenerCantidadDePreguntas(){
        
        $sql = "SELECT COUNT(*) FROM preguntas";
        $preguntas = $this->database->query($sql);
        return $preguntas;
    }

    public function limpiarPreguntasVistas($id){
        $sql = "DELETE FROM historico WHERE idUsuario = " . $id . " ";
        $this->database->query($sql);

    }
    
    public function guardarPreguntaVista($idUsuario,$idPregunta){

        $this->registrarRespuestaUsuario($idUsuario, $idPregunta);
        $this->guardarTemporalmente($idUsuario,$idPregunta);
      
    }

    public function respuestaDelUsuario($idUsuario,$idPregunta, $sumaCorrecta){
        $query = $this->preguntaYaRegistradaParaUsuario($idUsuario,$idPregunta);

        if(!empty($query)){

            $this->updateDificultad($idUsuario,$idPregunta, $sumaCorrecta);
        }
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

    public function guardarPartida($id){
       
        $sql = "INSERT INTO partida (puntaje_obtenido, fecha_partida, idUsuario, estado) 
        VALUES ('0', '" . date('Y-m-d H:i:s') . "', '" . $id . "', '1')";

        $this->database->query($sql);

        
    }

    public function obtenerPartidaActivaDelUsuario($id){

        $sql = "SELECT id FROM partida WHERE idUsuario = " . $id . " AND estado = 1 ORDER BY id DESC LIMIT 1";

        $query = $this->database->query($sql);

        return $query;
    }

    public function actualizarPartida($data){

        $idPartida = $this->obtenerPartidaActivaDelUsuario($data['id']);
        var_dump($idPartida);

        $sql = "UPDATE partida SET puntaje_obtenido = " . $data['puntaje'] . ", idUsuario = " . $data['id'] . ", 
        estado = 0 
        WHERE id = " . $idPartida[0]['id'] . " ";

        
        $this->database->query($sql);
        $this->actualizarPuntajeDeUsuario($data);
         
    }

    public function obtenerCantidadDePreguntasConDificultadVistasPorElUsuario($id){
      $sql = "SELECT COUNT(*)
              FROM historico h
              JOIN dificultad d on d.idUsuario = h.idUsuario AND d.idPregunta = h.idPregunta
              WHERE h.idUsuario = " . $id . " AND d.porcentaje_acierto < 70";


        $query = $this->database->query($sql);

        return $query;
    }

    public function obtenerCantidadDePreguntasConDificultadDelUsuario($id){
        $sql = "SELECT COUNT(*) FROM dificultad  WHERE idUsuario = " . $id . " 
        AND porcentaje_acierto < 70";

        $query = $this->database->query($sql);

        return $query;
    }

    private function actualizarPuntajeDeUsuario($data){
        $sql = "UPDATE usuario 
        SET puntaje = puntaje + " . $data['puntaje'] . " 
        WHERE id = " . $data['id'];
        $this->database->query($sql);

    }

    private function updateDificultad($idUsuario, $idPregunta, $sumaCorrecta){
        $sql = "UPDATE dificultad 
        SET veces_correctas = veces_correctas + " . $sumaCorrecta . ", 
            veces_vista = veces_vista + 1 , 
            porcentaje_acierto = " . $this->porcentajeDeAcierto($idUsuario,$idPregunta,$sumaCorrecta) . " 
        WHERE idUsuario = " . $idUsuario . " AND idPregunta = " . $idPregunta;

        $this->database->query($sql);

    }

    private function porcentajeDeAcierto($idUsuario, $idPregunta, $sumaCorrecta){
        $pregunta = $this->obtenerPreguntaDeDificultad($idUsuario, $idPregunta);

        $resultado = (($pregunta[0]['veces_correctas'] + $sumaCorrecta) / ($pregunta[0]['veces_vista'] + 1)) * 100;

        return $resultado;
    }

    private function obtenerPreguntaDeDificultad($idUsuario, $idPregunta){

        $sql = "SELECT veces_correctas, veces_vista FROM dificultad WHERE idUsuario = " . $idUsuario ." AND idPregunta = " . $idPregunta . " ";

        $query = $this->database->query($sql);

        return $query;
    }
    private function guardarTemporalmente($idUsuario,$idPregunta){
        $sql = "INSERT INTO historico (idUsuario,idPregunta) values ('". $idUsuario . "' , '". $idPregunta . "')";
        $this->database->query($sql);
    }

    private function registrarRespuestaUsuario($idUsuario,$idPregunta){
         $registrada = $this->preguntaYaRegistradaParaUsuario($idUsuario, $idPregunta);

         if(empty($registrada)){
         $sql = "INSERT INTO dificultad (idUsuario,idPregunta,veces_correctas, veces_vista) values ('". $idUsuario . "' , '". $idPregunta . "', '". 0 . "' , '". 0 . "')";
        $this->database->query($sql);
         }

    }

    private function preguntaYaRegistradaParaUsuario($idUsuario, $idPregunta){

        $sql = "SELECT * FROM dificultad WHERE idUsuario = " . $idUsuario ." AND idPregunta = " . $idPregunta . " ";
        
       return $this->database->query($sql);
    }


    private function opciones($id){
        
        $queryOpciones = "SELECT opcion
        FROM opciones
        WHERE preguntaID = " .$id . " 
        ORDER BY RAND() ";    

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

    
    public function reportePregunta($data)
    {
        $sql = "INSERT INTO reporte(idPregunta, idUsuarioReporte, detalleReporte) VALUES (". $_SESSION['preguntas']['id'].", " . $_SESSION['user']['id'] . ", '" . $data['motivo'] . "')";
        $this->database->query($sql);
    }
}