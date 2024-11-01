<?php

class RankingModel{

    private $database;

    public function __construct($database){
        $this->database = $database;
    }

    // public function obtenerRankingUsuarios() {
    //     // Consulta para obtener los 50 usuarios con mayor puntaje
    //     $queryUsuarios = "SELECT usuario, puntaje 
    //                       FROM usuario 
    //                       ORDER BY puntaje DESC 
    //                       LIMIT 50";
        
    //     // Ejecutar la consulta
    //     $usuarios = $this->database->query($queryUsuarios);
        
    //     // Iniciar un array para almacenar los resultados
    //     $rankingUsuarios = [];
        
    //     // Agregar el número de posición al resultado
    //     foreach ($usuarios as $index => $usuario) {
    //         $rankingUsuarios[] = [
    //             'posicion' => $index + 1, // El índice empieza en 0, por eso sumamos 1
    //             'usuario' => $usuario['usuario'],
    //             'puntaje' => $usuario['puntaje']
    //         ];
    //     }
    //     return $rankingUsuarios; // Devolver el array con el ranking
    // }

    public function obtenerRankingUsuarios() {
        // Consulta para obtener los 50 usuarios con mayor puntaje que no son administradores ni editores
        $queryUsuarios = "SELECT u.usuario, u.id, u.fotoPerfil, MAX(p.puntaje_obtenido) AS puntaje, p.fecha_partida AS fecha
                          FROM partida p
                          JOIN usuario u on u.id = p.idUsuario
                          GROUP BY u.id
                       ";
        
        // Ejecutar la consulta
        $usuarios = $this->database->query($queryUsuarios);
        
        // Iniciar un array para almacenar los resultados
        $rankingUsuarios = [];
        
        // Agregar el número de posición al resultado
        foreach ($usuarios as $index => $usuario) {
            $rankingUsuarios[] = [
                'posicion' => $index + 1, // El índice empieza en 0, por eso sumamos 1
                'usuario' => $usuario['usuario'],
                'puntaje' => $usuario['puntaje'],
                'fecha' => $usuario['fecha'],
                'fotoPerfil' => $usuario['fotoPerfil']
            ];
        }
        return $rankingUsuarios; // Devolver el array con el ranking
    }



}
?>
