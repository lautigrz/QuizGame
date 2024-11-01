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
            $sql = "INSERT INTO usuario (nombre, apellido, usuario, genero, email, password, estado, token, fotoPerfil) 
            VALUES ('" . $data['nombre'] . "', '" . $data['apellido'] . "', '" . $data['usuario'] . "', '" . $data['genero'] . "', '" . $data['email'] . "', '" . $data['password'] . "', 0, '" . $token . "', '" . $data['fotoPerfil'] . "')";
                
            return $this->database->query($sql);
    }

    public function enviarCorreoVerificacion($mail, $nombre, $usuario){
        
       $this->guardarToken($usuario, $codigoVerificacion);

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

    public function obtenerTodasLasPreguntas()
    {
        $sql = "SELECT p.pregunta, p.estado, c.descripcion AS categoria, c.color, GROUP_CONCAT(o.opcion ORDER BY o.id SEPARATOR ', ') AS opciones, MAX(CASE WHEN r.opcionID = o.id THEN o.opcion ELSE NULL END) AS es_correcta FROM preguntas p JOIN categoria c ON p.idCategoria = c.id JOIN opciones o ON p.id = o.preguntaID LEFT JOIN respuesta r ON r.preguntaID = p.id GROUP BY p.id, p.pregunta, p.estado, c.descripcion, c.color ORDER BY p.id;";
        return $this->database->query($sql);
    }

    private function buscarPregunta($pregunta)
    {
        $sql = "SELECT 1 FROM preguntas WHERE pregunta = '$pregunta'";
        return $this->database->query($sql);
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

    public function desactivarPregunta($pregunta)
    {
        //$sql = "UPDATE preguntas SET estado = 'desactiva' WHERE pregunta = '$pregunta'";
        //$this->database->query($sql);
    }
    public function activarPregunta($pregunta)
    {
        //$sql = "UPDATE preguntas SET estado = 'activa' WHERE pregunta = '$pregunta'";
        //$this->database->query($sql);
    }
    public function deshabilitarPregunta($pregunta)
    {
        /*$sql = "UPDATE preguntas SET estado = 'deshabilitada' WHERE pregunta = '$pregunta'";
        $this->database->query($sql);*/
    }
    public function modificarPregunta($pregunta, $preguntaModificada, $opciones, $es_correcta)
    {
        //$preguntaObtenida = $this->buscarPregunta($pregunta);

    }

}