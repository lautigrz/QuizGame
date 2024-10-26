<?php
include_once("helper/MysqlDatabase.php");
include_once("helper/MysqlObjectDatabase.php");
include_once("helper/IncludeFilePresenter.php");
include_once("helper/Router.php");
include_once("helper/MustachePresenter.php");
include_once("helper/SendEmail.php");
include_once("helper/ImagenUploader.php");
include_once("controller/UsuarioController.php");
include_once("controller/JuegoController.php");
include_once("controller/AuthController.php");
include_once("model/UsuarioModel.php");
include_once("model/JuegoModel.php");

include_once('vendor/mustache/src/Mustache/Autoloader.php');
class Configuration
{
    public function __construct()
    {
    }

    public function getUsuarioController(){

        return new UsuarioController($this->getUsuarioModel(), $this->getPresenter());
    }

    public function getJuegoController(){
        return new JuegoController($this->getJuegoModel(), $this->getPresenter());
    }

    public function getAuthController(){
        return new AuthController($this->getUsuarioModel(), $this->getPresenter(), $this->getSendEmail(), $this->getImagenUploader());
    }

    public function getJuegoModel(){
        return new JuegoModel($this->getDatabase());
    }
  
    private function getPresenter()
    {
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
        return new Router($this, "getAuthController", "login");
    }

    private function getUsuarioModel()
    {
        return new UsuarioModel($this->getDatabase());
    }
    public function getSendEmail(){
        return new SendEmail();
    }
    public function getImagenUploader(){
        return new ImagenUploader();
    }
}