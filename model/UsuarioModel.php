<?php

class UsuarioModel
{
    private $database;
 
    public function __construct($database)
    {
        $this->database = $database;
    }

    public function validate($user, $pass)
    {
        $sql = "SELECT *
                FROM usuario 
                WHERE usuario = '" . $user. "' 
                AND password = '" . $pass . "'";

        return $this->database->query($sql);
    }
    public function registrarUsuario($data){
            $token = rand(100000, 999999);
            $sql = "INSERT INTO usuario (nombre, apellido, usuario, genero, email, password, estado, token, fotoPerfil, ciudad, pais) 
            VALUES ('" . $data['nombre'] . "', '" . $data['apellido'] . "', '" . $data['usuario'] . "', '" . $data['genero'] . "', '" . $data['email'] . "', '" . $data['password'] . "', 0, '" . $token . "', '" . $data['fotoPerfil'] . "', '" . $data['ciudad'] . "', '" . $data['pais'] . "')";
            
            return $this->database->query($sql);
    }

    public function enviarCorreoVerificacion($mail, $nombre, $usuario){
        
       $this->guardarToken($usuario, $codigoVerificacion);

    }

    public function partidasJugadas($id){
        $sql = "SELECT COUNT(*) AS total FROM partida WHERE idUsuario = ". $id . "";
        $query = $this->database->query($sql);
        return $query[0]['total'];
    }

    public function ultimaPartida($id){
        $sql = "SELECT fecha_partida FROM partida WHERE idUsuario = $id ORDER BY fecha_partida DESC LIMIT 1";


        $query = $this->database->query($sql);

        $query1 = isset($query[0]['fecha_partida']) ? $query[0]['fecha_partida'] : "";
        return $query1;
    }
    public function buscarUsuario($nombreUsuario) {
        return $this->database->query("SELECT * FROM `usuario` WHERE usuario = '$nombreUsuario'");
    }
    public function guardarToken($username, $codigoVerificacion) {
         $usuarioResult = $this->buscarUsuario($username);
        
        if (isset($usuarioResult)) {
            $idUsuario = $usuarioResult[0]['id']; 
            $this->database->query("UPDATE usuario SET token = $codigoVerificacion WHERE id= '$idUsuario'");
        }
    }

    public function activarUsuario($user, $token) {
        $usuarioResult = $this->buscarUsuario($user);
        
        if (!$usuarioResult || $usuarioResult[0]['token'] !== $token) {
            throw new Exception("Token inválido o usuario no encontrado.");
        }
        $this->cambiarEstado($usuarioResult[0]['id']);
    }

    public function puntajeTotal($id){
        $sql = "SELECT puntaje FROM usuario WHERE id = " . $id . " ";

        return $this->query($sql);
    }

    public function obtenerTodasLasPreguntas()
    {
        $sql = "SELECT p.pregunta, p.estado, c.descripcion AS categoria, c.color, 
       GROUP_CONCAT(o.opcion ORDER BY o.id SEPARATOR ', ') AS opciones, 
       MAX(CASE WHEN r.opcionID = o.id THEN o.opcion ELSE NULL END) AS es_correcta 
FROM preguntas p JOIN categoria c ON p.idCategoria = c.id 
    JOIN opciones o ON p.id = o.preguntaID 
    LEFT JOIN respuesta r ON r.preguntaID = p.id 
GROUP BY p.id, p.pregunta, p.estado, c.descripcion, c.color ORDER BY p.id;";
        return $this->database->query($sql);
    }

    public function getUser($id){
        $sql = "SELECT * FROM usuario WHERE id = " . $id ." ";

        return $this->database->query($sql);
    }
    public function obtenerRankingUsuarios() {
     
        $queryUsuarios = "SELECT u.usuario, u.id, u.fotoPerfil, MAX(p.puntaje_obtenido) AS puntaje, p.fecha_partida AS fecha
                          FROM partida p
                          JOIN usuario u ON u.id = p.idUsuario
                          GROUP BY u.id
                          ORDER BY puntaje DESC, p.fecha_partida DESC
                       ";
        
      
        $usuarios = $this->database->query($queryUsuarios);
        
       
        $rankingUsuarios = [];
        
        
        foreach ($usuarios as $index => $usuario) {
            $rankingUsuarios[] = [
                'posicion' => $index + 1,
                'usuario' => $usuario['usuario'],
                'id' => $usuario['id'],
                'puntaje' => $usuario['puntaje'],
                'fecha' => $usuario['fecha'],
                'fotoPerfil' => $usuario['fotoPerfil']
            ];
        }
        return $rankingUsuarios; 
    }


    private function insertarOpcionesPorPregunta($pregunta, $opciones)
    {

    }
    private function borrarTodoRelacionadoPreguntaParaInsertarLaModificada($pregunta_id)
    {
        /*-- 1. Eliminar respuestas relacionadas con la pregunta
        DELETE FROM respuesta WHERE pregunta_id = :'.$pregunta_id.';

        -- 2. Eliminar opciones relacionadas con la pregunta
        DELETE FROM opciones WHERE pregunta_id = :'.$pregunta_id.';

        -- 3. Eliminar la pregunta
        DELETE FROM preguntas WHERE id = :'.$pregunta_id.';
        */
    }
    private function cambiarEstado($id) {
        $estado = 1;
        $this->database->query("UPDATE usuario SET estado = '$estado' WHERE id = '$id'");
    }

    //------------------------------------editor----------------------------------------------

    public function cambiarEstadoPregunta($pregunta_id, $estado)
    {
        switch ($estado){
            case 'pendiente':
                $this->database->query("UPDATE pregunta SET estado = ". 'pendiente' . "WHERE id = '$pregunta_id'");
                break;
            case 'aprobada':
                $this->database->query("UPDATE pregunta SET estado = ". 'aprobada' . "WHERE id = '$pregunta_id'");
                break;
            case 'rechazada':
                $this->database->query("UPDATE pregunta SET estado = ". 'rechazada' . "WHERE id = '$pregunta_id'");
                break;
            case 'desactivada':
                $this->database->query("UPDATE pregunta SET estado = ". 'desactivada' . "WHERE id = '$pregunta_id'");
                break;
        }
    }
    private function modificarPreguntaDB($pregunta, $opcion1, $opcion2, $opcion3, $opcion4, $opcionCorrecta)
    {
        $sql = "UPDATE preguntas SET pregunta = $pregunta";
    }
    public function obtenerPreguntasReportadas()
    {
        $sql="SELECT r.id, u.usuario, p.pregunta, r.detalleReporte, p.estado from reporte r
JOIN preguntas p ON p.id = r.idPregunta
JOIN usuario u ON u.id = r.idUsuarioReporte
WHERE p.estado LIKE 0";
        return $this->database->query($sql);
    }
}