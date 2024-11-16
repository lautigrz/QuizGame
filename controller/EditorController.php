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
            $pregunta_id = $_POST['pregunta'];

            $usuario = $_POST['usuario'];
            $tipo = $_POST['tipo'];
            $comentario = $_POST['comentario'];
            $accion = $_POST['accion'];
            $id = $_POST['idUsuario'];

            if($accion == 'aprobada'){
            $this->model->cambiarEstadoPregunta($pregunta_id);
            }

            $this->notificarAUsuario($usuario,$tipo,$comentario, $accion,$id);
            header('Location: /quizgame/editor/mostrarEditorView');

        }

        public function sugerencia(){
            $pregunta_id = $_POST['pregunta'];

            $usuario = $_POST['usuario'];
            $tipo = $_POST['tipo'];
            $comentario = $_POST['comentario'];
            $accion = $_POST['accion'];
            $id = $_POST['idUsuario'];

            if($accion == 'aprobada'){
            $this->model->cambiarEstadoPregunta($pregunta_id);
            }

            $this->notificarAUsuario($usuario,$tipo,$comentario, $accion,$id);
            header('Location: /quizgame/editor/mostrarEditorView');
        }

        public function eliminarPregunta(){
            $pregunta_id = $_POST['pregunta'];
            $this->model->eliminarPregunta($pregunta_id);
           
            
            header('Location: /quizgame/editor/mostrarEditorView');
            exit();
        }
      

        public function verificacion(){
            $pregunta_id = $_POST['pregunta'];
            $accion = $_POST['accion'];
            
            $usuario = $_POST['usuario'];
            $tipo = $_POST['tipo'];

            $comentario = $_POST['comentario'];
            $accion = $_POST['accion'];

            $id = $_POST['idUsuario'];

            if($accion == 'aprobado' || $accion == 'aprobada' ){
                $this->model->cambiarEstadoPregunta($pregunta_id);
            }else if($tipo == 'Sugerencia' && $accion == 'rechazada'){
                $this->model->rechazarPregunta($pregunta_id);
            }else{
                $this->model->eliminarReporte($pregunta_id);
            }

            $this->notificarAUsuario($usuario,$tipo,$comentario,$accion,$id);
            
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
                "categoria" => $_POST['categoria'],
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
             "user" => $_SESSION['user'],
             "editor" => true,
            "editorPreguntas" => $this->model->obtenerTodasLasPreguntas(),
            "reportadas" => $this->model->obtenerPreguntasReportadas(),
             "sugeridas" => $this->model->preguntasPendientes()       
                ];
        }
    }

    private function notificarAUsuario($usuario,$tipo,$comentario, $accion, $id){
        $mensaje = $comentario;
        if(empty($comentario)){
            $mensaje = "Hola ". $usuario ." tu ". $tipo . " fue " . $accion . " ";
        }

        $this->model->notificar($id,$mensaje,$tipo);
    }

}