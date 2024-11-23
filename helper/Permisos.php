<?php
class Permisos {
    
    public static function verificarSesion() {
        
        if (!isset($_SESSION['user']) && $_SERVER['REQUEST_URI'] !== '/quizgame/auth/login' && $_SERVER['REQUEST_URI'] !== '/quizgame/auth/registrar') {
            header('Location: /quizgame/auth/login');
            exit();
        }
    }
    
}


