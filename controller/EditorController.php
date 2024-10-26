<?php 

class EditorController{
    private $model;
    private $presenter;
    public function __construct($model, $presenter){
        $this->model = $model;
        $this->presenter = $presenter;
    }
    public function mostrarEditorView()
    {
        $data = [];
        $this->setDatos($data);
        $this->presenter->show('editor', $data);
    }

          //---------------------------editor-----------------------------------------------
          public function alterarPregunta(){
            switch ($_POST['accion']){
                case 'deshabilitar':
                    $this->model->deshabilitarPregunta($_POST['pregunta']);
                    break;
                case 'activar':
                    $this->model->activarPregunta($_POST['pregunta']);
                        break;
                case 'desactivar':
                    $this->model->desactivarPregunta($_POST['pregunta']);
                    break;
                case 'modificar':
                    $this->model->modificarPregunta($_POST['pregunta'], $_POST['preguntaModificada'], $_POST['opciones'], $_POST['es_correcta']);
                    break;
    
            }
        }

    public function setDatos(&$data){
        if(!empty($_SESSION['error'])){
            $data["error"] = $_SESSION['error'];
            unset( $_SESSION['error']);
        }if(!empty($_SESSION['user'])){
            $data["user"] = $_SESSION['user'];
        }if(!empty($_SESSION['editorPreguntas'])){
            $data["editorPreguntas"] = $_SESSION['editorPreguntas'];
        }
    }

}