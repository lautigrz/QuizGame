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
        #var_dump($this->model->obtenerTodasLasPreguntas());
        $this->presenter->show('editor', $data);
    }

          //---------------------------editor-----------------------------------------------
          public function alterarPregunta(){
            $pregunta_id = $_POST['pregunta'];

            $this->model->cambiarEstado($pregunta_id);
            header('Location: /quizgame/editor/mostrarEditorView');

        }
        public function modificarPregunta(){
    
            $correcta = $_POST['es_correcta'];
            $opciones = [];
             
            $respuesta = "";
            foreach($_POST['opciones'] as $index => $opcion){
                $opciones[] = $opcion;
                if($index == $correcta){
                    $respuesta = $opcion;
                }
            }
        

            $data = [

                "id" => $_POST['preguntaId'],
                "pregunta" => $_POST['preguntaModificada'],
                "opciones" => $opciones,
                "respuesta" => $respuesta
            ];
          
            $this->model->modificarPregunta($data);

            header('Location: /quizgame/editor/mostrarEditorView');
        
        }

    public function setDatos(&$data){
        if(!empty($_SESSION['error'])){
            $data["error"] = $_SESSION['error'];
            unset( $_SESSION['error']);
        }if(!empty($_SESSION['user'])){
            $data["user"] = $_SESSION['user'];
        }if(!empty($_SESSION['user'])){

            $data = [

            "editorPreguntas" => $this->model->obtenerTodasLasPreguntas(),
            "reportadas" => $this->model->obtenerPreguntasReportadas()

                ];
        }
    }

}