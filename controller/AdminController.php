
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

    public function mostrarAdminView() {
        $data = [
            'cantidad_jugadores' => $this->adminModel->obtenerCantidadJugadores(),
            'cantidad_usuarios_nuevos' => $this->adminModel->obtenerCantidadUsuariosNuevos('month'), // Ejemplo de filtro mensual
            'cantidad_preguntas_juego' => $this->adminModel->obtenerCantidadPreguntasEnJuego(),
            'cantidad_preguntas_creadas' => $this->adminModel->obtenerCantidadPreguntasCreadas(),
            'porcentaje_respuestas_correctas' => $this->adminModel->obtenerPorcentajeRespuestasCorrectas(),
            'cantidad_partidas_jugadas' => $this->adminModel->obtenerCantidadPartidasJugadas(),
            'usuarios_por_pais' => $this->adminModel->obtenerUsuariosPorPais(),
            'usuarios_por_sexo' => $this->adminModel->obtenerUsuariosPorSexo(),
            'usuarios_por_edad' => $this->adminModel->obtenerUsuariosPorGrupoEdad(),
        ];

        $this->presenter->show('admin', $data);
    }
}