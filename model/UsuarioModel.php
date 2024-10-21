<?php

class UsuarioModel
{
    private $database;
    private $mailer;
    public function __construct($database, $mailer)
    {
        $this->database = $database;
        $this->mailer = $mailer;
    }

    public function validate($user, $pass)
    {
        $sql = "SELECT *
                FROM usuario 
                WHERE email = '" . $user. "' 
                AND password = '" . $pass . "'";

        return $this->database->query($sql);
    }
    public function registrarUsuario($nombre, $apellido, $usuario, $genero, $email, $pass, $estadoCuenta, $token, $urlFotoPerfil, $fechaNacimiento){

            $sql = "INSERT INTO usuario(nombre, apellido, usuario, genero, email, password , estado, token, fotoPerfil, fechaNacimiento) VALUES ('" . $nombre . "', '" . $apellido . "', '" . $usuario . "', '" . $genero . "', '" . $email . "', '" . $pass . "', '" . $estadoCuenta . "', " . $token . " , '" . $urlFotoPerfil . "', " . $fechaNacimiento . ")";
            
            return $this->database->query($sql);
    }

    public function enviarCorreoVerificacion($mail, $nombre, $usuario){
        $codigoVerificacion = rand(100000, 999999);
       $this->guardarCodigoVerificacion($usuario, $codigoVerificacion);

        try{
            $this->mailer->setFrom('quizgame088@gmail.com', 'QuizGame');
            $this->mailer->addAddress("$mail");    
            $this->mailer->isHTML(true);                                  
            $this->mailer->Subject = "Hola," . $nombre . "!";
           $this->mailer->Body = '<html>
<head>
    <style>
        .button {
            background-color: #1c6d93;
            border: none;
            color: #fcfcfc;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 4px;
        }
            .link{
            color: blue;
            }
    </style>
</head>
<body>
    <h2>¡Verifique su cuenta!</h2>
    <p>Estimado/a ' . $usuario . ',</p>
    <p>Gracias por registrarse a QuizGame. Para poder activar su cuenta, necesitamos que haga clic en el botón a continuación para completar el proceso de verificación:</p>
    <a href="http://localhost/quizgame/usuario/auth/token=' . $codigoVerificacion . '&usuario=' . $usuario . '" class="button">Verificar Cuenta</a>
    <p>Si no puede hacer clic en el botón, copie y pegue el siguiente enlace en su navegador:</p>
    <p class="link"><a href="http://localhost/quizgame/usuario/auth/token=' . $codigoVerificacion . '&usuario=' . $usuario . '">http://localhost/quizgame/usuario/auth/token=' . $codigoVerificacion . '&usuario=' . $usuario . '</a></p>
    <p>¡Esperamos verle pronto!</p>
    <p>Atentamente,<br>El equipo de QuizGame</p>
</body>
</html>';
        $this->mailer->send();
        } catch (Exception $e) {
            echo "El mensaje no pudo ser enviado: {$this->mailer->ErrorInfo}";
        }

    }
    public function buscarUsuario($nombreUsuario) {
        return $this->database->query("SELECT * FROM `usuario` WHERE usuario = '$nombreUsuario'");
    }


    public function guardarCodigoVerificacion($username, $codigoVerificacion) {
        $usuarioResult = $this->buscarUsuario($username);
        
        if (isset($usuarioResult)) {
           
            $idUsuario = $usuarioResult[0]['id']; 
            $this->database->query("UPDATE usuario SET token = $codigoVerificacion WHERE id= '$idUsuario'");
        }
    }

    public function activarUsuario($user, $token){

        $usuarioResult = $this->buscarUsuario($user);

        if(isset($usuarioResult) && $usuarioResult[0]['token'] == $token){
            $id = $usuarioResult[0]['id'];
            $estado = 1;
            $this->database->query("UPDATE usuario SET estado = '$estado' WHERE id = '$id'");
        }
    }
}