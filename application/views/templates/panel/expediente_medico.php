<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
  <ol class="breadcrumb">
  <li><a href="<?php echo base_url();?>index.php/proyecto/panel">Principal</a></li>
  <li class="active">Expedientes NNA</li>
  </ol>
          <center><h1 style="background-color: white" border="2" class="page-header">EXPEDIENTES DE NNA</h1></center>
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
                <th> <center>No. Expediente</th>
                <th> <center>No. Carpeta</th>
                <th> <center>Centro asistencial</th>
                <th> <center>Nombre del NNA</th>
                <th> <center>Fecha nacimiento</th>
                <th> <center>Edad</th>
                <th> <center>Género</th>
                <th> <center>Fecha de ingreso</th>
                <th> <center>Delito</th>
                <th> <center>Motivos de ingreso</th>
                <th> <center>Valoración Medica</th>
                </center>
              </tr>
            </thead>
            <tbody>
              <?php
              //die(var_dump($expedientes)); 
              foreach ($expedientes_medico as $e){
              ?>
              <tr>
            <td ><?php echo $e->no_expediente;?></td>
              <td><?php echo $e->no_carpeta;?></td>
              <td><?php echo $e->nombre_centro;?></td>
                <!--<td class="<?php echo $etiqueta;?>"><?php echo $this->Modelo_proyecto->ver_centro($e->id_centro);?></td>-->
                <td><?php echo $e->nombres_nino;?> <?php echo $e->apellido_pnino;?> <?php echo $e->apellido_mnino;?></td>
                <td><?php $date_of_birth = $e->fecha_nnino;
                //var_dump($date_of_birth);
                $dia = substr($date_of_birth,8,2);
                $mes = substr($date_of_birth,5,2); 
                $anio = substr($date_of_birth,0,4);
                $fecha_birth = $dia."/".$mes."/".$anio;
                echo $fecha_birth;
                //var_dump($fecha); 
                ?></td>
                <td>
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
                </td>
                <td><?php echo $e->genero_nino;?></td>
                <td><?php $fecha_final = $e->fecha_ingreso;
                  //var_dump($fecha_final);
                  $dia = substr($fecha_final,8,2);
                  $mes = substr($fecha_final,5,2);
                  $anio = substr($fecha_final,0,4);
                  $fecha = $dia."/".$mes."/".$anio;
                  echo $fecha;
                  //var_dump($fecha);
                ?></td>
                <td><?php echo $e->delito;?></td>
                <td><?php echo $e->motivos_ingreso;?></td>
                <td><CENTER><a class="btn btn-primary" href="<?php echo base_url('index.php/proyecto/evaluacion_medico');?>/<?php echo $e->id_expediente;?>" role="button"><span class="glyphicon glyphicon-plus"></span></span></a></CENTER></td>
              </tr>
              <?php 
              }
              ?>
            </tbody>
          </table>


        </div>
      </div>
    </div>


   