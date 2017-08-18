<h1 class="page-header">
    Prueba Piloto
</h1>
    <?php
  $relacion=0;
        $aux=0;
$contadorpermisos=0;
$permisopendiente=0;
           /*  foreach($this->model->Obtener_Permisos($id_permiso) as $p): 
$contadorpermisos++;
  
        $aux++; 
        if ($aux>0 && $p->completado==2 ){
           $permisopendiente++;
             $relacion=$p->relacion;
            $id_competencia=$p->id_competencia;
             $id_percompetencia=$p->id_percompetencia;
                $nivel_final=$p->nivel_final;
                 $nivel=$p->nivel_final;
            $nivelFinal=$p->nivel_final;
    }
        
    endforeach;

if($permisopendiente==0){
 print "<script>window.location='?c=evaluacion&a=Fin';</script>";  
}
         */    
        
        
        ?>
<ol class="breadcrumb">
  <li><a href="?c=evaluacion">Evaluaciones</a></li>
  <li class="active">Grupo Q</li>
    <li class="active">Demográfico</li>
</ol>

 <div class="container">
<div class="jumbotron">
     <h2 align="center"><strong>Preguntas Demográficas</strong>
                     </h2>
      
   <h3 align="center"> <strong>Evaluado:</strong> Patricia Margarita Marenco de Miranda</h3><br>
        <?php 
    echo "<h3 align='center''> " .$sesionNombre."</h3><br>";
    ?>               
      <h3>Antes de dar inicio a la evaluación necesitamos algunos datos informativos.</h3>
   

<br>Por ejemplo:
<br>
<br> 1.Cercanía con la persona evaluada.
<br><br>
<input type="radio" name="p1" value="1"><label>Poca relación</label><br/>
 <input type="radio" name="p1" value="2"><label>Relación laboral constante</label><br/>
 <input type="radio" name="p1" value="3" checked><label>Buena relación laboral</label><br/>
<br/>
      
        <h4> En el ejemplo anterior está marcado <strong>Buena relación laboral</strong> , porque considero que conozco muy bien  y tengo una muy buena relación a la persona evaluada</h4>
         <br>

    </div>
          
         </div>
    
<form method="post" action="">
  <?php 
    
  $contador=0;

        foreach($this->model->Obtener_Pregunta() as $r): ?>
   <?php
    if($contador==0)
    echo "<h3 align='center'> $r->competencia<h3><br/>";
  
    ?>
    
    
    <br>
        <h4><?php $contador++;

            echo $contador.". ".$r->nombre; ?></h4>
    

    
<?php 
 foreach($this->model->Obtener_Respuesta( $r->id_demopregunta) as $p): ?>
    <?php echo "<input type='radio' name='$r->id_demopregunta'value='1' required><label> $p->respuesta</label><br/>";?>
    <?php    endforeach; ?>
    <?php    endforeach; ?>
       <div align='center'> <input  class="btn btn-success" type="submit" name="submit" Value="Siguiente"></div>
 </form> 



<?php
//$sesionCodigo;
include 'dbconfig.php';

if (isset($_POST['submit']))
{ 
    //variables





     foreach($this->model->Obtener_Pregunta() as $r): 
 $id_respuesta=$_POST[$r->id_demopregunta];
 
   
 //   $query = "INSERT INTO v2_evaresultado (id_usuario,id_pregunta,id_respuesta,id_permiso) VALUES ('.$sesionCodigo.','.$r->id_pregunta.','.$id_respuesta.', 1')";
$query= "INSERT INTO `v2_evademografico_resultado` ( `id_usuario`, `id_pregunta`, `id_respuesta`, `id_permiso`) VALUES ('$sesionCodigo', '$r->id_demopregunta', '$id_respuesta', '$id_permiso')";
 mysql_query($query) or die(mysql_error());
    endforeach;
    
$query= "UPDATE `v2_permiso` SET demografico=2 where id_permiso='$id_permiso'";

 mysql_query($query) or die(mysql_error());

 
    

    

   if($competenciafinal==5){
     print "<script>window.location='?c=evaluacion&a=Fin';</script>";    
   }else
      print "<script>window.location='?c=evaluacion&a=Crud&id=$id_permiso';</script>"; 
   /*****/      
    /********/
   /* $id=0;
   $id_usuario=0;
 $radio = $_POST["p1"];
     $radio2 = $_POST["p2"];
     $radio3 = $_POST["p3"];
    $nota=0;
    $Nunca=0;
    $id_usuario=$_SESSION["id_usuario"];
   $promedio=($_POST["p1"]-1+$_POST["p2"]-1+$_POST["p3"]-1)*100/12;
 $query = "INSERT INTO demo_table_3 (id_usuario,r1,r2,r3,competencia,nivel) VALUES ('.$id_usuario.','.$radio.','.$radio2.','.$radio3.','.1.','.1.')";
 
 mysql_query($query) or die(mysql_error());
  
    
       print "<script>window.location='c2n3.php';</script>";  
*/
 		   
 }

?>
