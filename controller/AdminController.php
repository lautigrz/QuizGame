
<?php

class AdminController {
    private $usuarioModel;
    private $presenter;
    private $adminModel;

    public function __construct($usuarioModel, $presenter, $adminModel) {
        $this->usuarioModel = $usuarioModel;
        $this->presenter = $presenter;
        $this->adminModel = $adminModel;
    }

    // public function mostrarAdminView() {
    //     $data = [
    //         'cantidad_jugadores' => $this->adminModel->obtenerCantidadJugadores(),
    //         'cantidad_usuarios_nuevos' => $this->adminModel->obtenerCantidadUsuariosNuevos('month'), // Ejemplo de filtro mensual
    //         'cantidad_preguntas_juego' => $this->adminModel->obtenerCantidadPreguntasEnJuego(),
    //         'cantidad_preguntas_creadas' => $this->adminModel->obtenerCantidadPreguntasCreadas(),
    //         'porcentaje_respuestas_correctas' => $this->adminModel->obtenerPorcentajeRespuestasCorrectas(),
    //         'cantidad_partidas_jugadas' => $this->adminModel->obtenerCantidadPartidasJugadas(),
    //         'usuarios_por_pais' => $this->adminModel->obtenerUsuariosPorPais(),
    //         'usuarios_por_sexo'  => $this->adminModel->obtenerUsuariosPorSexo(),
    //         'usuarios_por_edad' => $this->adminModel->obtenerUsuariosPorGrupoEdad(),
    //         
    //         "admin" => true,
    //     ];

    //     $this->presenter->show('admin', $data);
    // }

    public function mostrarAdminView() {
        $filtro = isset($_GET['filtro']) ? $_GET['filtro'] : 'month';

        // Obtiene los datos desde el modelo
        $cantidadJugadores = $this->adminModel->obtenerCantidadJugadores($filtro);
        $cantidadUsuariosNuevos = $this->adminModel->obtenerCantidadUsuariosNuevos($filtro); // Ejemplo de filtro mensual
        // $usuariosPorSexo = $this->adminModel->obtenerUsuariosPorSexo();
        $usuariosPorSexo = array_map(function($fila) {
            return [
                'sexo' => $fila['nombre'] ?? $fila['sexo'], 
                'cantidad' => $fila['cantidad']
            ];
        }, $this->adminModel->obtenerUsuariosPorSexo($filtro));
        $usuariosPorEdad = $this->adminModel->obtenerUsuariosPorGrupoEdad($filtro);
        var_dump($usuariosPorSexo); // Verifica qué datos se están obteniendo

        // Prepara los datos para la vista
        $data = [
            'cantidad_jugadores' => $cantidadJugadores,
            'cantidad_usuarios_nuevos' => $cantidadUsuariosNuevos,
            'cantidad_preguntas_juego' => $this->adminModel->obtenerCantidadPreguntasEnJuego(),
            'cantidad_preguntas_creadas' => $this->adminModel->obtenerCantidadPreguntasCreadas(),
            'porcentaje_respuestas_correctas' => $this->adminModel->obtenerPorcentajeRespuestasCorrectas(),
            'cantidad_partidas_jugadas' => $this->adminModel->obtenerCantidadPartidasJugadas($filtro),
            'usuarios_por_pais' => $this->adminModel->obtenerUsuariosPorPais($filtro),
            // Se codifican como JSON los datos que se utilizarán en los gráficos
            'usuarios_por_sexo' => json_encode($usuariosPorSexo),
            'usuarios_por_edad' => json_encode($usuariosPorEdad),
            'admin' => true,
        ];
    
        // Renderiza la vista
        $this->presenter->show('admin', $data);
    }

    // public function filtrar() {
    //     $filtro = $_GET['filter'] ?? 'year'; // Valor por defecto: 'month'
    
    //     $data = [
    //         'cantidad_jugadores' => $this->adminModel->obtenerCantidadJugadores($filtro),
    //         'cantidad_usuarios_nuevos' => $this->adminModel->obtenerCantidadUsuariosNuevos($filtro),
    //         'cantidad_preguntas_juego' => $this->adminModel->obtenerCantidadPreguntasEnJuego(),
    //         'cantidad_preguntas_creadas' => $this->adminModel->obtenerCantidadPreguntasCreadas(),
    //         'porcentaje_respuestas_correctas' => $this->adminModel->obtenerPorcentajeRespuestasCorrectas(),
    //         'cantidad_partidas_jugadas' => $this->adminModel->obtenerCantidadPartidasJugadas(),
    //         'usuarios_por_sexo' => json_encode($this->adminModel->obtenerUsuariosPorSexo($filtro)),
    //         'usuarios_por_edad' => json_encode($this->adminModel->obtenerUsuariosPorGrupoEdad($filtro)),
    //         'is_day' => $filtro === 'day',
    //         'is_month' => $filtro === 'month',
    //         'is_year' => $filtro === 'year',
    //     ];
    
    //     $this->presenter->show('admin', $data);
    // }
}