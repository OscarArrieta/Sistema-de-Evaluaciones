<?php
//Se incluye el modelo donde conectará el controlador.
require_once 'model/login.php';

class LoginController{

    private $model;

    //Creación del modelo
    public function __CONSTRUCT(){
        $this->model = new login();
    }

    //Llamado plantilla principal
    public function Index(){
   session_start();
session_destroy();
        require_once 'view/login/index.php';
       
    }
    
     public function login(){
      $login = new login();
         if(empty($_POST)){ require_once 'view/login/index.php';}
         else{
   
	if(isset($_POST["usu_login"]) &&isset($_POST["usu_password"])){
		if($_POST["usu_login"]!="" && $_POST["usu_password"]!=""){

            try
		{
		$login = $this->model->Obtener($_POST["usu_login"],$_POST["usu_password"]);
		} catch (Exception $e)
		{
		require_once 'view/login/index.php';	
		}
            
      
            if(isset($login->usu_login)){
          unset($_POST['usu_login']);
                unset($_POST['usu_password']);
          	session_start();
				$_SESSION["usu_codigo"]=$login->usu_codigo;
               $_SESSION["usu_nombre"]=$login->usu_nombre.' '.$login->usu_apellidos;
          
          
        print "<script>window.location='?c=evaluacion&a=index';</script>";	  
      }else{require_once 'view/login/index.php';}
      
		}
	}
                 
}       
    }
    
    

    //Llamado a la vista proveedor-editar
    public function Crud(){
        $pvd = new login();

        
        
        
        
        
        //Se obtienen los datos del proveedor a editar.
        if(isset($_REQUEST['pere_codigo'])){
            $pvd = $this->model->Obtener($_REQUEST['usu_login']);
            
            
        }

        //Llamado de las vistas.
        require_once 'view/header.php';
        require_once 'view/proveedor/proveedor-editar.php';
        require_once 'view/footer.php';
  }

    //Llamado a la vista proveedor-nuevo
    public function Nuevo(){
        $pvd = new proveedor();

        //Llamado de las vistas.
        require_once 'view/header.php';
        require_once 'view/proveedor/proveedor-nuevo.php';
        require_once 'view/footer.php';
    }

    //Método que registrar al modelo un nuevo proveedor.
    public function Guardar(){
        $pvd = new proveedor();

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

    //Método que modifica el modelo.
    public function Editar(){
        $pvd = new proveedor();

        $pvd->nit = $_REQUEST['nit'];
        $pvd->razonS = $_REQUEST['razonS'];
        $pvd->dir = $_REQUEST['dir'];
        $pvd->tel = $_REQUEST['tel'];

        $this->model->Actualizar($pvd);

        header('Location: index.php');
    }


}
