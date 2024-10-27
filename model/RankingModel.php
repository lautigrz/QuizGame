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
        $queryUsuarios = "SELECT usuario, puntaje 
                          FROM usuario 
                          WHERE admin = 0 AND editor = 0 
                          ORDER BY puntaje DESC 
                          LIMIT 50";
        
        // Ejecutar la consulta
        $usuarios = $this->database->query($queryUsuarios);
        
        // Iniciar un array para almacenar los resultados
        $rankingUsuarios = [];
        
        // Agregar el número de posición al resultado
        foreach ($usuarios as $index => $usuario) {
            $rankingUsuarios[] = [
                'posicion' => $index + 1, // El índice empieza en 0, por eso sumamos 1
                'usuario' => $usuario['usuario'],
                'puntaje' => $usuario['puntaje']
            ];
        }
        return $rankingUsuarios; // Devolver el array con el ranking
    }



}
?>
