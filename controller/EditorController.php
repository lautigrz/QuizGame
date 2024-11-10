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
            $pregunta_id = $_POST['pregunta_id'];
        }
        public function modificarPregunta()
        {
            $pregunta = $_POST['preguntaNombre'];
            $preguntaModificada = $_POST['preguntaModificada'];
            $opcion1 = $_POST['opciones'][0];
            $opcion2 = $_POST['opciones'][1];
            $opcion3 = $_POST['opciones'][2];
            $opcion4 = $_POST['opciones'][3];
            $correcta = $_POST['es_correcta'];
            $opcionCorrecta = '';
            switch ($correcta) {
                case 'opcion1':
                    $opcionCorrecta = $opcion1;
                    break;
                    case 'opcion2':
                        $opcionCorrecta = $opcion2;
                        break;
                        case 'opcion3':
                            $opcionCorrecta = $opcion3;
                            break;
                            case 'opcion4':
                                $opcionCorrecta = $opcion4;
                                break;

            }

            echo $pregunta;
            //$this->model->modificarPreguntaDB($pregunta, $opcion1, $opcion2, $opcion3, $opcion4, $opcionCorrecta);
        }

    public function setDatos(&$data){
        if(!empty($_SESSION['error'])){
            $data["error"] = $_SESSION['error'];
            unset( $_SESSION['error']);
        }if(!empty($_SESSION['user'])){
            $data["user"] = $_SESSION['user'];
        }if(!empty($_SESSION['editorPreguntas'])){

            $data = [

            "editorPreguntas" => $_SESSION['editorPreguntas'],

            "reportadas" => $this->model->obtenerPreguntasReportadas()



                ];
        }
    }

}