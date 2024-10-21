<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
include_once("helper/MysqlDatabase.php");
include_once("helper/MysqlObjectDatabase.php");
include_once("helper/IncludeFilePresenter.php");
include_once("helper/Router.php");
include_once("helper/MustachePresenter.php");

include_once("controller/UsuarioController.php");
include_once("model/UsuarioModel.php");

include_once('vendor/mustache/src/Mustache/Autoloader.php');
include_once('vendor/PHPMailer/src/Exception.php');
include_once('vendor/PHPMailer/src/PHPMailer.php');
include_once('vendor/PHPMailer/src/SMTP.php');


class Configuration
{
    public function __construct()
    {
    }

    public function getUsuarioController(){
        echo "<script>console.log('pasa por configuration/getUserController');</script>";

        $model = new UsuarioModel($this->getDatabase(), $this->getMailer());
        return new UsuarioController($model, $this->getPresenter());
    }


    private function getPresenter()
    {
        echo "<script>console.log('pasa por configuration/getPresenter');</script>";

        return new MustachePresenter("view");
    }


    private function getDatabase()
    {
        $config = parse_ini_file('configuration/config.ini');
        return new MysqlObjectDatabase(
            $config['host'],
            $config['port'],
            $config['user'],
            $config['password'],
            $config["database"]
        );
    }

    public function getRouter()
    {
        echo "<script>console.log('pasa por configuration/configuration/login');</script>";

        return new Router($this, "getUsuarioController", "login");

    }

    private function getUsuarioModel()
    {
        echo "<script>console.log('pasa por configuration/configuration/getDatabase');</script>";

        return new UsuarioModel($this->getDatabase(), $this->getMailer());
    }

    public function getMailer(){
        $config = parse_ini_file('configuration/config.ini');
        $mail = new PHPMailer(true);
        $mail->SMTPDebug = 0;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = $config['mailerhost'];                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = $config['mailerusername'];                     //SMTP username
        $mail->Password   = $config['mailerpassword'];                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = $config['mailerport'];

        return $mail;
    }
}