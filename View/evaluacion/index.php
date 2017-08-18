
<p > 
<img src="images/grupoqpeq.jpg" align="left">

<?php
$nombre=$_SESSION["usu_nombre"];

echo "<h1 >Evaluador: $nombre</h2>";

?>
</p>

<p class='page-header'></p>

<table class="table table-striped">
    <thead>
        <tr style="background-color: #0440a0;color: white;">
             <th >Evaluación</th>
            <th >Usuario Evaluado</th>
             <th style="width:120px;">Realizado</th>
 <th style="width:120px;">Acciones</th>
        </tr>
    </thead>
    <tbody>
    <?php 
        $id_eva=$_SESSION["usu_codigo"];
  
        foreach($this->model->Listar($id_eva) as $r): ?>
        <tr>
       
           <input type="hidden" value='$r->relacion' name="relacion" />
            
            <td><?php echo $r->evaluacion; ?></td>
          
            <td><?php
                if($r->relacion==6){
                    echo "Autoevaluación";
                }else
                    
                echo $r->usu_nombre.''.$r->usu_apellidos; 
                ?></td>
            <td><?php
                $completado=($r->contador/$r->cantidad_permisos)*100;
                echo ceil($completado);
                  ?></td>
         
            
            <td>
          
                <?php $compe=$r->porcentaje+1;
                 if($completado!=100){
                     //Se envia el id del permiso
                 //   echo "<a class='btn btn-danger'href='?c=evaluacion&a=Crud&id=$r->id_permiso'>Realizar</a>";
                     if($r->demografico==1){
                          echo "<a class='btn btn-danger'href='?c=demografico_pregunta&a=Crud&id=$r->id_permiso'>Realizar</a>";
                     }else{
                            echo "<a class='btn btn-danger'href='?c=evaluacion&a=Crud&id=$r->id_permiso'>Realizar</a>";
                     }
                    
                      
                }else echo "Terminada"
          ?>      
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
