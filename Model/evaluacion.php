<?php
class evaluacion
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

	//Este método selecciona todas las tuplas de la tabla
	//proveedor en caso de error se muestra por pantalla.
	public function Listar($usu_identificacion)
	{
		try
		{
           
			$result = array();
			//Sentencia SQL para selección de datos.
			$stm = $this->pdo->prepare("SELECT v2_permiso.demografico,v2_permiso.id_permiso,tbl_usuario.usu_nombre, tbl_usuario.usu_apellidos ,v2_permiso.evaluado,v2_permiso.relacion,v2_permiso.fecha_final,v2_permiso.porcentaje, v2_permiso.evaluacion,v2_evaluacion.evaluacion,(SELECT COUNT(v2_permiso_competencia.id_percompetencia) FROM v2_permiso_competencia WHERE v2_permiso_competencia.completado=1 and id_permiso=v2_permiso.id_permiso) as contador,(SELECT COUNT(v2_permiso_competencia.id_percompetencia) FROM v2_permiso_competencia WHERE id_permiso=v2_permiso.id_permiso) as 'cantidad_permisos' FROM v2_permiso inner join v2_evaluacion on v2_evaluacion.id_evaluacion=v2_permiso.evaluacion inner join tbl_usuario on tbl_usuario.usu_codigo=v2_permiso.evaluado where v2_permiso.evaluador='".$usu_identificacion."'");
             
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
	}

    
    	//Este método selecciona todas las tuplas de la tabla
	//proveedor en caso de error se muestra por pantalla.
	public function Buscar_Usuario($usu_identificacion)
	{
		try
		{
           
			$result = array();
			//Sentencia SQL para selección de datos.
			$stm = $this->pdo->prepare("SELECT tbl_usuario.usu_nombre,tbl_usuario.usu_apellidos from tbl_usuario where tbl_usuario.usu_codigo=".$usu_identificacion."'");
             
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
	}

    
    	//Este método selecciona todas las tuplas de la tabla
	//proveedor en caso de error se muestra por pantalla.
	public function Obtener_Permisos($id_permiso)
	{
		try
		{
           
			$result = array();
			//Sentencia SQL para selección de datos.
			$stm = $this->pdo->prepare("SELECT * FROM v2_permiso inner join  `v2_permiso_competencia` ON v2_permiso.id_permiso=v2_permiso_competencia.id_permiso where v2_permiso.id_permiso='".$id_permiso."'");
             
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
		}	}
    //******************************************************/
	//Este método obtiene los datos del proveedor a partir del nit
	//utilizando SQL.
    
	public function Obtener_Pregunta($competencia,$nivel)
	{
 
    /**Cargando preguntas***/ 
        	try
		{
           
			$result = array();
			//Sentencia SQL para selección de datos.
			$stm = $this->pdo->prepare("SELECT * from v2_pregunta inner join v2_competencia on v2_competencia.id_competencia=v2_pregunta.id_competencia where v2_competencia.id_competencia='".$competencia."' and v2_pregunta.nivel='".$nivel."'");
             
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

	//Este método elimina la tupla proveedor dado un nit.
	public function Eliminar($nit)
	{
		try
		{
			//Sentencia SQL para eliminar una tupla utilizando
			//la clausula Where.
			$stm = $this->pdo
			            ->prepare("DELETE FROM proveedor WHERE nit = ?");

			$stm->execute(array($nit));
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	//Método que actualiza una tupla a partir de la clausula
	//Where y el nit del proveedor.
	public function Actualizar($data)
	{
		try
		{
			//Sentencia SQL para actualizar los datos.
			$sql = "UPDATE proveedor SET
						razonS          = ?,
						dir        = ?,
            tel        = ?
				    WHERE nit = ?";
			//Ejecución de la sentencia a partir de un arreglo.
			$this->pdo->prepare($sql)
			     ->execute(
				    array(
                        $data->razonS,
                        $data->dir,
                        $data->tel,
                        $data->nit
					)
				);
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	//Método que registra un nuevo proveedor a la tabla.
	public function Registrar(proveedor $data)
	{
		try
		{
			//Sentencia SQL.
			$sql = "INSERT INTO proveedor (nit,razonS,dir,tel)
		        VALUES (?, ?, ?, ?)";

			$this->pdo->prepare($sql)
		     ->execute(
				array(
                    $data->nit,
                    $data->razonS,
                    $data->dir,
                    $data->tel,
                )
			);
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}
}
