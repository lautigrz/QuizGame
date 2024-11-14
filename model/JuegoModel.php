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
        $query = "";
        do{
        $sql = "SELECT p.id, c.color, c.icono, p.pregunta, d.veces_correctas, d.veces_vista
        FROM preguntas p 
        JOIN dificultad d ON d.idPregunta = p.id 
        JOIN categoria c ON c.id = p.idCategoria 
        WHERE d.idUsuario = " . $idUsuario . " AND p.estado = 1
        ORDER BY RAND() 
        LIMIT 1";

        $query = $this->database->query($sql);
            
        }while(!$this->porcentaje($query[0]['veces_correctas'], $query[0]['veces_vista']));

      return $query;
    }

    private function porcentaje($veces_correctas, $veces_vista){

        $calculo = (($veces_correctas / $veces_vista) * 100);

        if($calculo < 70){
            return true;
        }

        return false;

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
        
        $sql = "SELECT COUNT(*) FROM preguntas WHERE estado = 1";
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

    public function preguntaEntregada($idUsuario){
        $sql = "SELECT * FROM historico WHERE idUsuario = $idUsuario ORDER BY hora DESC LIMIT 1";

        return $this->database->query($sql);
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

        $sql = "SELECT id FROM partida WHERE idUsuario = " . $id . " AND estado = 1";

        $query = $this->database->query($sql);

        return $query;
    }

    public function actualizarPuntaje($id){

        $idPartida = $this->obtenerPartidaActivaDelUsuario($id);
   
        $sql = "UPDATE partida SET puntaje_obtenido = puntaje_obtenido + 1 , idUsuario = " . $id . "
        WHERE id = " . $idPartida[0]['id'] . " ";

        $this->database->query($sql); 
    }
    public function finalizarPartida($id){

        $idPartida = $this->obtenerPartidaActivaDelUsuario($id);
   
        #var_dump($idPartida);
        $sql = "UPDATE partida SET estado = 0 
        WHERE id = " . $idPartida[0]['id'] . " ";

        $this->database->query($sql);
        $this->actualizarPuntajeDeUsuario($id);
         
    }

    public function obtenerCantidadDePreguntasConDificultadVistasPorElUsuario($id){
      $sql = "SELECT d.veces_vista, d.veces_correctas
              FROM historico h
              JOIN dificultad d on d.idUsuario = h.idUsuario AND d.idPregunta = h.idPregunta
              WHERE h.idUsuario = " . $id . " ";

        
        $query = $this->database->query($sql);
        $contador = 0;
        foreach ($query as $fila) {
    
            $veces_correctas = $fila['veces_correctas'];
            $veces_vista = $fila['veces_vista'];
            
            if($this->porcentaje($veces_correctas,$veces_vista)){
            $contador++;
        }
    
        }
    
         return $contador;
    }

    public function obtenerCantidadDePreguntasConDificultadDelUsuario($id){
        $sql = "SELECT veces_correctas, veces_vista  FROM dificultad  WHERE idUsuario = " . $id . " ";
        $query = $this->database->query($sql);

        $contador = 0;

        foreach ($query as $fila) {
    
        $veces_correctas = $fila['veces_correctas'];
        $veces_vista = $fila['veces_vista'];
        
        if($this->porcentaje($veces_correctas,$veces_vista)){
        $contador++;
    }

    }

     return $contador;
}
    public function ultimaPartida($id){
    $sql = "SELECT puntaje_obtenido FROM partida WHERE idUsuario = $id ORDER BY fecha_partida DESC LIMIT 1";

    $puntaje = $this->database->query($sql);

    return $puntaje[0]['puntaje_obtenido'];
}

    private function actualizarPuntajeDeUsuario($id){
        $puntaje = $this->ultimaPartida($id);

        $sql = "UPDATE usuario 
        SET puntaje = puntaje + " . $puntaje . " 
        WHERE id = " . $id;
        $this->database->query($sql);

    }

  
    private function updateDificultad($idUsuario, $idPregunta, $sumaCorrecta){
        $sql = "UPDATE dificultad 
        SET veces_correctas = veces_correctas + " . $sumaCorrecta . ", 
            veces_vista = veces_vista + 1
        WHERE idUsuario = " . $idUsuario . " AND idPregunta = " . $idPregunta;

        $this->database->query($sql);

    }
    private function obtenerPreguntaDeDificultad($idUsuario, $idPregunta){

        $sql = "SELECT veces_correctas, veces_vista FROM dificultad WHERE idUsuario = " . $idUsuario ." AND idPregunta = " . $idPregunta . " ";

        $query = $this->database->query($sql);

        return $query;
    }
    private function guardarTemporalmente($idUsuario,$idPregunta){
        $sql = "INSERT INTO historico (idUsuario, idPregunta, hora) VALUES ('" . $idUsuario . "', '" . $idPregunta . "', '" . date('Y-m-d H:i:s') . "')";

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
                    WHERE p.estado = 1
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
        $this->estadoReportada();
    }
    
   /* public function estadoReportada()
    {
        $this->database->query('UPDATE preguntas SET estado =' . 0 . ' WHERE id = ' . $_SESSION['preguntas']['id']);
    }*/
}