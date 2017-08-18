<?php
class demografico_pregunta
{
	//Atributo para conexión a SGBD
	private $pdo;

		//Atributos del objeto proveedor
    public $nit;
    public $razonS;
    public $dir;
   public $relacion;


	//Método de conexión a SGBD.
	public function __CONSTRUCT()
	{
		try
		{
			$this->pdo = Database::Conectar();
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}



    
	public function Obtener_Pregunta()
	{
 
    /**Cargando preguntas***/ 
        	try
		{
           
			$result = array();
			//Sentencia SQL para selección de datos.
			$stm = $this->pdo->prepare("SELECT id_demopregunta,nombre from v2_demografico_pregunta");
             
			//Ejecución de la sentencia SQL.
					$stm->execute();
			//fetchAll — Devuelve un array que contiene todas las filas del conjunto
			//de resultados
			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			//Obtener mensaje de error.
			die($e->getMessage());
		}
       /** Final Cargando preguntas***/ 
        
        
    
	}
    
	public function Obtener_Respuesta($id_demopregunta){
    /**Cargando preguntas***/ 
        	try
		{
           
			$result = array();
			//Sentencia SQL para selección de datos.
			$stm = $this->pdo->prepare("Select id_respuesta,respuesta from v2_respuesta where id_pregunta='".$id_demopregunta."'");
             
			//Ejecución de la sentencia SQL.
					$stm->execute();
			//fetchAll — Devuelve un array que contiene todas las filas del conjunto
			//de resultados
			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			//Obtener mensaje de error.
			die($e->getMessage());
		}
       /** Final Cargando preguntas***/ 
        
        
    
	}

}
