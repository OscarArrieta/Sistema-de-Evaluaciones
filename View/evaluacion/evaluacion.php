<h1 class="page-header">
    Prueba Piloto
</h1>
    <?php
  $relacion=0;
        $aux=0;
$contadorpermisos=0;
$permisopendiente=0;
             foreach($this->model->Obtener_Permisos($id_permiso) as $p): 
$contadorpermisos++;
  
        $aux++; 
        if ($aux>0 && $p->completado==2 ){
           $permisopendiente++;
             $relacion=$p->relacion;
            $id_competencia=$p->id_competencia;
             $id_percompetencia=$p->id_percompetencia;
                $nivel_inicial=$p->nivel_inicial;
                $nivel_final=$p->nivel_final;
                 $nivel=$p->nivel_final;
            $nivelFinal=$p->nivel_final;
    }
        
    endforeach;

if($permisopendiente==0){
 print "<script>window.location='?c=evaluacion&a=Fin';</script>";  
}
             
       
        
        ?>
<ol class="breadcrumb">
  <li><a href="?c=evaluacion">Evaluaciones</a></li>
  <li class="active">Grupo Q</li>
    <li class="active"><?php 
        if($nivel==0){  echo ' Anti-competencia ';}else
        echo 'nivel '.$nivel; 
        
        ?></li>
</ol>

 <div class="container">
<div class="jumbotron">
         <?php

          echo "<h3 align='center''> " .$sesionNombre."</h3><br>"; 
    
        if($relacion==6){
             echo "<h3 align='center''> Autoevaluación</h3>
             
              <h4> Te invitamos a realizar tu autoevaluación, es esencial que tus respuestas sean honestas y objetivas, basadas en hechos concretos.
Es importante que consideres la frecuencia con la que muestras los comportamientos específicos con los que te autoevaluarás. </h4>
             "; 
        
        }else{
                     echo "<h3 align='center''> <strong>Evaluado:</strong> Patricia Margarita Marenco de Miranda</h3><br>
                     
                     <h4>Es esencial que tus respuestas sean honestas y objetivas, basadas en hechos concretos que has podido observar de la persona evaluada.

<br>La frecuencia con la que ha observado esos comportamientos es muy importante."; 
        }

?>
   
      
   

<br>Por ejemplo:
<br>
<br> 1.Encuentra mejores formas de hacer las cosas
<br><br>
<input type="radio" name="p1" value="1"><label> Nunca</label><br/>
 <input type="radio" name="p1" value="2"><label> Rara vez</label><br/>
 <input type="radio" name="p1" value="3"><label> A veces</label><br/>
 <input type="radio" name="p1" value="4" checked><label> Con frecuencia</label><br/>
 <input type="radio" name="p1" value="5"><label> Consistentemente</label><br/>
      
        
         <br>
    
        <?php 
        
        
        
    
        if($relacion==6){
        echo '<h4>En el ejemplo anterior la persona respondió frecuentemente, ya que considera que en el último tiempo en varias ocasiones ha encontrado mejores formas de hacer las cosas.
En la medida que analices la frecuencia con la que realizas el comportamiento evaluado, este ejercicio será más objetivo.</h4>';}
        else {
        echo '
         <br>En este ejemplo la respuesta ha sido <strong>"Con frecuencia"</strong>, ya que en muchas ocasiones se ha observado a la persona evaluada mejorar sus procesos o tareas.
        <br>
        <br>  Piensa cuantas veces has observado a la persona evaluada que busca mejorar las cosas que hace, ya que no es lo mismo que solo la hayas visto hacerlo una vez ó la has observado en varias ocasiones. En la medida que analices siempre la frecuencia del comportamiento de la persona, esta evaluación será mucho más objetiva.';}
        ?>
       
     


    
    </div>
          
         </div>
    
<form method="post" action="">
  <?php 
    
  $contador=0;

        foreach($this->model->Obtener_Pregunta($id_competencia, $nivel_final) as $r): ?>
   <?php
    if($contador==0)
    echo "<h3 align='center'> $r->competencia<h3><br/>";
  
    ?>
    
    
    <br>
        <h4><?php $contador++;

            echo $contador.". ".$r->pregunta; ?></h4>
    
  <?php
    
echo "<input type='radio' name='$r->id_pregunta'value='1' required><label> Nunca</label><br/>";
echo "<input type='radio' name='$r->id_pregunta'value='2' required><label> Rara vez</label><br/>";
    echo "<input type='radio' name='$r->id_pregunta'value='3' required><label>A veces</label><br/>";
    echo "<input type='radio' name='$r->id_pregunta'value='4' required><label> Con frecuencia</label><br/>";
    echo "<input type='radio' name='$r->id_pregunta'value='5' required><label> Consistentemente</label><br/>";
?>  
    


    <?php 

    
    endforeach; ?>
       <div align='center'> <input  class="btn btn-success" type="submit" name="submit" Value="Siguiente"></div>
 </form> 



<?php
//$sesionCodigo;
include 'dbconfig.php';

if (isset($_POST['submit']))
{ 
    //variables




$competenciafinal=1;
$nota=0;
    $Nunca=0;
 $puntos=0;
$promedio=0;
$contador=0;
$contadorNunca=0;
      $completado=1;
     foreach($this->model->Obtener_Pregunta($id_competencia,$nivel_final) as $r): 
 $id_respuesta=$_POST[$r->id_pregunta];
    $nota=$nota+$_POST[$r->id_pregunta]-1;
    if($_POST[$r->id_pregunta]==1){
        $contadorNunca++;
    }
    $contador++;
 //   $query = "INSERT INTO v2_evaresultado (id_usuario,id_pregunta,id_respuesta,id_permiso) VALUES ('.$sesionCodigo.','.$r->id_pregunta.','.$id_respuesta.', 1')";
$query= "INSERT INTO `v2_evaresultado` (`id_evaresultado`, `id_usuario`, `id_pregunta`, `id_respuesta`, `id_permiso`) VALUES (NULL, '$sesionCodigo', '$r->id_pregunta', '$id_respuesta', '$id_permiso')";
 mysql_query($query) or die(mysql_error());
    endforeach;
    $promedio=($nota*100)/($contador*4);

         if($nivel!=0 && $nivel!=5){
              /** Condiciones para que baje **/
    if($contadorNunca>1 || ($promedio<61 && $contadorNunca==1)){
           /** Si califica mal y no ha calificado o ya habia calificado mal **/
        if($nivel<=$nivel_inicial){$competenciafinal=$competencia;
                          $nivelFinal=$nivel-1;
                         $competenciafinal=$competencia;}
            $completado=2;
         /** Si Califica mal  y anteriormente habia subido **/
        if($nivel>$nivel_inicial){
              $competenciafinal=$competencia+1;
                     $nivelFinal=$nivel;
                                    $completado=1;
                     }
        
        
    
    }
                /** Condiciones para que suba **/
    if($promedio==100){
        if($nivel>=$nivel_inicial){$competenciafinal=$competencia;
                     $nivelFinal=$nivel+1;
                                    $completado=2;
                     }
       
    }
        }
    
    
    echo $nivelFinal."-".$completado;
       $query= "UPDATE `v2_permiso_competencia` SET `nivel_final` = $nivelFinal, completado=$completado WHERE `v2_permiso_competencia`.`id_percompetencia` = $id_percompetencia ";

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
