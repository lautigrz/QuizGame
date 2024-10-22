<?php
class Permisos {
    
    public static function verificarSesion() {
        if (empty($_SESSION['user'])) {
            header('Location: /quizgame/login');
            exit();
        }
    }
}


