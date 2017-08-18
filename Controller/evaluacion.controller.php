<?php
//Se incluye el modelo donde conectará el controlador.
require_once 'model/evaluacion.php';

class EvaluacionController{

    private $model;

    //Creación del modelo
    public function __CONSTRUCT(){
        $this->model = new evaluacion();
    }

    //Llamado plantilla principal
    public function Index(){
        
        session_start();
if(!isset($_SESSION["usu_codigo"]) || $_SESSION["usu_codigo"]==null){
	require_once 'view/login/index.php';
}else{

        require_once 'view/header.php';
        require_once 'view/evaluacion/index.php';
        require_once 'view/footer.php';
    }  
    }
    
        public function Fin(){
        
        session_start();

        require_once 'view/header.php';
        require_once 'view/evaluacion/final.php';
        require_once 'view/footer.php';
      
    }

    //Llamado a la vista proveedor-editar
    public function Crud(){
         $id_permiso=$_REQUEST['id'];
                session_start();
if(!isset($_SESSION["usu_codigo"]) || $_SESSION["usu_codigo"]==null){
	require_once 'view/login/index.php';
}else{
    
        $sesionNombre=$_SESSION["usu_nombre"];
    $sesionCodigo=$_SESSION["usu_codigo"];
        $id_permiso=$_REQUEST['id'];
      $permisos = new evaluacion();

        if(isset($_REQUEST['id'])){
          //  $permisos = $this->model->Obtener_Pregunta($_REQUEST['id']);
        }

    
    /*
      if(isset($_REQUEST['idProducto'])){
            $prod = $this->model->Obtener($_REQUEST['idProducto']);
        }*/
 
        //Llamado de las vistas.
        require_once 'view/header.php';
        require_once 'view/evaluacion/evaluacion.php';
        require_once 'view/footer.php';
  }
          }// fin de la funcion CRUD


    //Llamado a la vista proveedor-nuevo
    public function Nuevo(){
        $pvd = new evaluacion();

        //Llamado de las vistas.
        require_once 'view/header.php';
        require_once 'view/proveedor/proveedor-nuevo.php';
        require_once 'view/footer.php';
    }

    //Método que registrar al modelo un nuevo proveedor.
    public function Guardar(){
        $pvd = new evaluacion();

        //Captura de los datos del formulario (vista).
        $pvd->nit = $_REQUEST['nit'];
        $pvd->razonS = $_REQUEST['razonS'];
        $pvd->dir = $_REQUEST['dir'];
        $pvd->tel = $_REQUEST['tel'];

        //Registro al modelo proveedor.
        $this->model->Registrar($pvd);

        //header() es usado para enviar encabezados HTTP sin formato.
        //"Location:" No solamente envía el encabezado al navegador, sino que
        //también devuelve el código de status (302) REDIRECT al
        //navegador
        header('Location: index.php');
    }

    //Método que modifica el modelo de un proveedor.
    public function Editar(){
        $pvd = new evaluacion();

        $pvd->nit = $_REQUEST['nit'];
        $pvd->razonS = $_REQUEST['razonS'];
        $pvd->dir = $_REQUEST['dir'];
        $pvd->tel = $_REQUEST['tel'];

        $this->model->Actualizar($pvd);

        header('Location: index.php');
    }

    //Método que elimina la tupla proveedor con el nit dado.
    public function Eliminar(){
        $this->model->Eliminar($_REQUEST['nit']);
        header('Location: index.php');
    }
}
