<?php
class Permisos {
    
    public static function verificarSesion() {
        if (!isset($_SESSION['user']) && $_SERVER['REQUEST_URI'] !== '/quizgame/login') {
            header('Location: /quizgame/login');
            exit();
        }
    }
    
}


