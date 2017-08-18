
<?php


if(!empty($_POST)){
    echo 'entro0';
	if(isset($_POST["usu_login"]) &&isset($_POST["usu_password"])){
		if($_POST["usu_login"]!=""&&$_POST["usu_password"]!=""){
			include "conexion.php";
			echo 'entro1';
			$user_id=null;
			$sql1= "select usu_codigo,usu_nombre,usu_apellidos,usu_login,usu_password from tbl_usuario where (usu_login=\"$_POST[usu_login]\") and usu_password=md5(\"$_POST[usu_password]\") ";
			$query = $con->query($sql1);
			while ($r=$query->fetch_array()) {
				$user_id=$r["usu_codigo"];
                $user_usu_nombre=$r["usu_nombre"];
				break;
			}
			if($user_id==null){
                echo 'lol';
				print "<script>alert(\"$user_id.\");window.location='../index.php';</script>";
			}else{
                echo 'entro3';
				session_start();
				$_SESSION["usu_codigo"]=$user_id;
               $_SESSION["usu_nombre"]=$user_usu_nombre;
				print "<script>window.location='?c=evaluacion&a=Crud&eva_codigo=<?php';</script>";		
             
			}
		}
	}
}else{ echo 'entro?';
     
     }



?>