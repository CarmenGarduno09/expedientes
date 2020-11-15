<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
  <ol class="breadcrumb">
  <li><a href="<?php echo base_url();?>index.php/proyecto/panel">Principal</a></li>
    <li class="active">Expedientes NNA</li>
  </ol>
          <center><h1 style="background-color: white" border="2" class="page-header">EXPEDIENTES DE LOS NNA</h1></center>
<br>

          <style>

        .round {
 background-color: #fff;
 width: auto;
 height: auto;
 margin: 0 auto 15px auto;
 padding: 5px;
 border: 1px solid #ccc;


 -moz-border-radius: 11px;
 -webkit-border-radius: 11px;
 border-radius: 11px;
 behavior: url(border-radius.htc);
    }
</style>

<html>

<head>
<TITLE>objetos redondeados</TITLE>

    <style>

        .round {
 background-color: #fff;
 width: auto;
 height: auto;
 margin: 0 auto 18px auto;
 padding: 7px;
 border: 2px solid #ccc;

 -moz-border-radius: 15px;
 -webkit-border-radius: 15px;
 border-radius: 15px;


 behavior: url(border-radius.htc);

    }


    .ph-center {
  height: 100px;
}
.ph-center::-webkit-input-placeholder {
  text-align: center;
}

    </style>

</head>

<body>

</body>

</html>

          <table class="table table-bordered" id="dataTables-example">
            
            <thead>
              <tr bgcolor="#FEF5E7" align="center">
                  <center>
                <th> <center>Integrantes</th>
                <th> <center>No. de Equipo</th>
                <th> <center>No. Expediente</th>
                <!--<th> <center>Edita Asignación</th>-->
                <th> <center>No. Carpeta</th>
                <th> <center>Centro asistencial</th>
                <th> <center>Nombre del NNA</th>
                <th> <center>Fecha nacimiento</th>
                <th> <center>Género</th>
                <th> <center>Edad</th>
                <th> <center>Fecha de ingreso</th>
                <th> <center>Delito</th>
                <th> <center>Motivos de ingreso</th>
                <th> <center>Estado procesal</th>
                <th><center>Ver</th>
                </center>
              </tr>
            </thead>
            <tbody>
           

<?php
             //die(var_dump($expedientes)); 
             foreach ($expedientes as $e){
             ?>
             <?php  
               if($e->nombre_estado=="En Juicio"){
                 $texto = "En Juicio";
                 $etiqueta = "success";
               }else{
                 if($e->nombre_estado=="Convenios Asistenciales"){
                 $texto = "Convenios Asistenciales";
                 $etiqueta = "danger";
               }else{
                 if($e->nombre_estado=="Trámite Administrativo"){
                 $texto = "Trámite Administrativo";
                 $etiqueta = "info";
               }else{
                 if($e->nombre_estado=="Situación Jurídica Resuelta"){
                 $texto = "Situación Jurídica Resuelta";
                 $etiqueta = "warning";
                 }else{
                  if($e->nombre_estado=="Reintegrado"){
                  $texto = "Reintegrado";
                  $etiqueta = "white";
                }else{
                  if($e->nombre_estado=="Adopción"){
                  $texto = "Adopción";
                  $etiqueta = "white";
                }else{
                  if($e->nombre_estado=="Mayoría de Edad"){
                  $texto = "Mayoría de Edad";
                  $etiqueta = "white";
               }else{
                 $texto = "Fugados";
                 $etiqueta ="white";
                 }  
                }
               }
             }
           }
          }
        }
             ?>
             <tr>
               <!-- td ver integrantes -->
              <!-- el js, es el de maury -->
              <td class="<?php echo $etiqueta;?>" id="equipoA">
            
                   
            <!-- Muestra integrantes en otra vista....
              <form method="post" action="vista_expediente_nino_integrantes">
             <center><button type="button submit" class="btn btn-info" name="integrantes" value="<?php echo $e->id_expediente;?>">Ver integrantes</button></center>
             </form>-->

             <center><button class="btn btn-success" type="button" onclick="mostrarTrab(<?php echo $e->id_expediente;?>)" data-toggle="modal" data-target="#exampleModalCenter">Ver:  <span  class="glyphicon glyphicon-eye-open" ></span></button>
        </td>   
               <td class="<?php echo $etiqueta;?>"><center>
               <input class="btn btn-warning" type="button" value="<?php echo $e->fk_num_equipo;?>">
              </center></td>
                <td class="<?php echo $etiqueta;?>"><?php echo $e->no_expediente;?></td><!--."-".$e->id_exp;-->
             <!-- <td class="<?php echo $etiqueta;?>"><center><a class="btn btn-success" href="<?php echo base_url('index.php/proyecto/edita_expediente1');?>/<?php echo $e->id_expediente;?>" role="button"><span class="glyphicon glyphicon-folder-open"></span></span></a></center></td> -->
               <td class="<?php echo $etiqueta;?>"><?php echo $e->no_carpeta;?></td>
              <td class="<?php echo $etiqueta;?>"><?php echo $e->nombre_centro;?></td>
               <!--<td class=""><?php echo $this->Modelo_proyecto->ver_centro($e->id_centro);?></td>-->
               <td class="<?php echo $etiqueta;?>"><?php echo $e->nombres_nino;?> <?php echo $e->apellido_pnino;?> <?php echo $e->apellido_mnino;?></td>
               <td class="<?php echo $etiqueta;?>"><?php $date_of_birth = $e->fecha_nnino;
                //var_dump($date_of_birth);
                $dia = substr($date_of_birth,8,2);
                $mes = substr($date_of_birth,5,2);
                $anio = substr($date_of_birth,0,4);
                $fecha_birth = $dia."/".$mes."/".$anio;
                echo $fecha_birth;
                //var_dump($fecha);
                ?></td>
               <td class="<?php echo $etiqueta;?>"><?php echo $e->genero_nino;?></td>
               <td class="<?php echo $etiqueta;?>"><CENTER>
               <?php 
               $fecha_naci = $this->Modelo_proyecto->ver_edad($e->id_ingreso);
               $fecha_nacinino = $fecha_naci;
               $fecha_actual = date("Y/m/d/");
               //$edad = $fecha_actual - $fecha_nacinino;
$diaN = substr($fecha_naci,8,9);
     $mesN = substr($fecha_naci,5,6);
      $anioN = substr($fecha_naci,0,3);

      //actual
      $diaA = substr($fecha_actual,8,9);
	  $mesA = substr($fecha_actual,5,6);
      $anioA = substr($fecha_actual,0,3);

      if ($diaA<=$mesN){
        if($diaA<$diaN){
            $edad = ($anioA-$anioN)-1; 
        }
        else{
            $edad=$anioA-$anioN;   
        }  
      }else{
        $edad=$anioA-$anioN; }
               if($edad > 100) echo $e->edadcal; 
               else echo $edad;
               ?>
               </CENTER></td>
               <td class="<?php echo $etiqueta;?>"><?php $fecha_final = $e->fecha_ingreso;
                  //var_dump($fecha_final);
                  $dia = substr($fecha_final,8,2);
                  $mes = substr($fecha_final,5,2);
                  $anio = substr($fecha_final,0,4);
                  $fecha = $dia."/".$mes."/".$anio;
                  echo $fecha;
                  //var_dump($fecha);
                ?></td>
               <td class="<?php echo $etiqueta;?>"><?php echo $e->delito;?></td>
               <td class="<?php echo $etiqueta;?>"><?php echo $e->motivos_ingreso;?></td>
               <td class="<?php echo $etiqueta;?>"><?php echo $e->nombre_estado;?></td>
              
               <!--<td class=""><a data-toggle="modal" data-target="#popup<?php echo $e->id_exp;?>"><span class="glyphicon glyphicon-pencil"></span></a>
 
 <div class="modal  fade" id="popup<?php echo $e->id_exp;?>" tabindex="-1" role="dialog" aria-labelledby="label" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">x</span><span class="sr-only">Cerrar</span></button>
         <h3 style="text-align: center" class="modal-title" id="label"><strong>CAMBIO DE ESTATUS</strong></h3>
       </div>
       <div class="modal-body">
         <p style="text-align: center">
         <center>  
         <form method="POST" action="lugar.php">
           <?php 
            foreach ($estado as $es) {
           ?>
           <div>
         <input align="" type="radio" class="form-control.radio" name="estatus<?php echo $e->id_exp;?>" <?php if($es->id_estadop == $e->id_estadop) echo "checked"?>><?=$es->nombre_estado?>
           </div>
           <?php }?>
           </center>
           <br>
           <center><a class="btn btn-warning" href="<?php echo base_url('index.php/proyecto/actualiza_incidencia_nino');?>" >Cambiar</a></center>
           <input type="text" name="id_expediente" value="<?php echo $e->id_exp; ?>"
           </form>
           /<?php echo $e->id_expediente;?>
         </p>
       </div>
     </div>
   </div>
 </div></td>-->
 <td class="<?php echo $etiqueta;?>"><center><a class="btn btn-primary" href="<?php echo base_url('index.php/proyecto/revisar_expedientes');?>/<?php echo $e->id_expediente;?>/<?php echo $e->id_ingreso;?>" role="button"><span class="glyphicon glyphicon-eye-open"></span></span></a></center></td>
             </tr>
             <?php 
             }
             ?>
              
       
          
          
           
            </tbody>
         
          </table>


        </div>
      </div>
    </div>

    <!-- Modal  ventana emergente-->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                   <center> <h2 class="modal-title" id="exampleModalLongTitle">Personal que atiende al menor: </h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body" id="modal-body">
                    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                  </div>
                </div>
              </div>
            </div>  

            <script>
      

    function mostrarTrab(id){
   
   /// alert(id);
    $.ajax({
        type:"POST",
        url  : base_url+'Proyecto/ver_trabajador',
        data:({id_tx:id}),
        cache:false,
        dataType:"json",
        success:mostrarPersonas,
        error:function(){
            alert('No se pudieron traer los datos');
        }
    });

    function mostrarPersonas(data){
        $("#modal-body").empty();
        $("#modal-body").append('<ul class="list-group list-group-flush">');
        $(data).each(function(index,data){
            if(data.estado=="success"){
                $("#modal-body").append('<ul class="list-group-item list-group-item-info">'+data.v4+'</ul><ul class="list-group"><ul class="list-group-item list-group-item-light">'+data.v1+' '+data.v2+' '+data.v3+' '+'</ul></ul>');

            }
        });
        $("#modal-body").append('</ul>');
        $("#modal-body").trigger('create');
    
    }
    
 }
 </script>



   