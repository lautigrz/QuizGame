<?php

class AdminModel {

    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    // 1. Obtener cantidad de jugadores
    public function obtenerCantidadJugadores() {
        $sql = "SELECT COUNT(*) as total FROM usuario WHERE admin = 0 AND editor = 0";
        $resultado = $this->database->query($sql);
        return $resultado[0]['total'];
    }

    // 2. Obtener cantidad de partidas jugadas
    public function obtenerCantidadPartidasJugadas() {
        $sql = "SELECT COUNT(*) as total FROM partida";
        $resultado = $this->database->query($sql);
        return $resultado[0]['total'];
    }

    // 3. Obtener cantidad de preguntas en el juego
    public function obtenerCantidadPreguntasEnJuego() {
        $sql = "SELECT COUNT(*) as total FROM preguntas WHERE estado = 'activa'";
        $resultado = $this->database->query($sql);
        return $resultado[0]['total'];
    }

    // 4. Obtener cantidad de preguntas creadas
    public function obtenerCantidadPreguntasCreadas() {
        $sql = "SELECT COUNT(*) as total FROM preguntas";
        $resultado = $this->database->query($sql);
        return $resultado[0]['total'];
    }

    // 5. Obtener cantidad de usuarios nuevos (filtrados por periodo)
    public function obtenerCantidadUsuariosNuevos($periodo) {
        $intervalo = $this->determinarIntervalo($periodo);
        $sql = "SELECT COUNT(*) as total FROM usuario WHERE estado = 1 AND DATE_FORMAT(created_at, '%Y-%m-%d') >= DATE_SUB(CURDATE(), INTERVAL $intervalo)";
        $resultado = $this->database->query($sql);
        return $resultado[0]['total'];
    }

    // 6. Obtener porcentaje de respuestas correctas
    public function obtenerPorcentajeRespuestasCorrectas() {
        $sql = "SELECT 
                    (SUM(CASE WHEN o.id = r.opcionID THEN 1 ELSE 0 END) / COUNT(*)) * 100 as porcentaje
                FROM respuesta r
                JOIN opciones o ON r.preguntaID = o.preguntaID";
        $resultado = $this->database->query($sql);
        return $resultado[0]['porcentaje'];
    }

    // 7. Obtener usuarios por país
    public function obtenerUsuariosPorPais() {
        $sql = "SELECT pais, COUNT(*) as total FROM usuario GROUP BY pais";
        return $this->database->query($sql);
    }

    // 8. Obtener usuarios por género
    public function obtenerUsuariosPorGenero() {
        $sql = "SELECT genero, COUNT(*) as total FROM usuario GROUP BY genero";
        return $this->database->query($sql);
    }

    // 9. Obtener usuarios por grupo de edad
    public function obtenerUsuariosPorGrupoEdad() {
        $sql = "SELECT 
                    SUM(CASE WHEN TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) < 18 THEN 1 ELSE 0 END) as menores,
                    SUM(CASE WHEN TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) >= 65 THEN 1 ELSE 0 END) as jubilados,
                    SUM(CASE WHEN TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) BETWEEN 18 AND 64 THEN 1 ELSE 0 END) as medio
                FROM usuario";
        return $this->database->query($sql);
    }

    // Método privado para determinar intervalo según el periodo
    private function determinarIntervalo($periodo) {
        switch ($periodo) {
            case 'day': return '1 DAY';
            case 'week': return '1 WEEK';
            case 'month': return '1 MONTH';
            case 'year': return '1 YEAR';
            default: return '1 DAY';
        }
    }

    public function obtenerUsuariosPorSexo() {
        $sql = "SELECT genero, COUNT(*) as total FROM usuario GROUP BY genero";
        return $this->database->query($sql);
    }
}
