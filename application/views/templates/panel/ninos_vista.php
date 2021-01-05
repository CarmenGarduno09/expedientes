<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
  <ol class="breadcrumb">
  <li><a href="<?php echo base_url();?>index.php/proyecto/panel">Principal</a></li>
    <li class="active">Registros de NNA</li>
  </ol>

  <center><h1 style="background-color: white" border="2" class="page-header"> REGISTRO GENERAL DE LOS NNA </h1></center>

<br>
 <!--<a class="btn btn-primary" href="<?php echo base_url();?>index.php/proyecto/alta_ninos" role="button"><span class="glyphicon glyphicon-plus"></span> Agregar nuevo niño</a>-->

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
              <tr bgcolor="#F9E79F" align="center">
                  <center>
                <th>Nombre del NNA</th>
                <th>CURP</th>
                <th>Edad</th>
                <th>Capacidad diferente</th>
                <th>Municipio Origen</th>
                <th>Fecha ingreso</th>
                <th>Delito</th>
                <th>Motivos ingreso</th>
                <th>No. Expediente</th>
                <th>No. Carpeta</th>
                <th>Estado procesal</th>
                <th>Hermano</th>
                <th>Centro de Asistencia</th>
                <th>Editar Datos</th>
                <th>Agregar Familiar</th>
                <th>Agregar Pensión</th>
                
                
                </center>
              </tr>
            </thead>
            <tbody>
              <?php 
              foreach ($ninosdif as $dif){
              ?>
              <tr bgcolor="#FEF5E7">
                <td><?php echo $dif->nombres_nino;?> <?php echo $dif->apellido_pnino;?> <?php echo $dif->apellido_mnino;?></td>
                <td><?php echo $dif->curp;?></td>
                <td><center>
                <?php 
                $fecha_naci = $this->Modelo_proyecto->ver_edad($dif->id_ingreso);
                $fecha_nacinino = $fecha_naci;
                $fecha_actual = date("Y-m-d");
               // $edad = $fecha_actual - $fecha_nacinino;

                  
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
         
                 if($edad > 100) echo $dif->edadcal; 
                else echo $edad;
                ?>
                </center></td>
                <td><center><?php echo $dif->discapacidad;?></td>
                <td><?php echo $dif->municipio_origen;?></td>
                <td><?php $fecha_final = $dif->fecha_ingreso;
                  //var_dump($fecha_final);
                  $dia = substr($fecha_final,8,2);
                  $mes = substr($fecha_final,5,2);
                  $anio = substr($fecha_final,0,4);
                  $fecha = $dia."/".$mes."/".$anio;
                  echo $fecha;
                  //var_dump($fecha);
                ?></td>
                <td><?php echo $dif->delito;?></td>
                <td><?php echo $dif->motivos_ingreso;?></td>
                <td><?php echo $dif->no_expediente;?></td>
                <td><?php echo $dif->no_carpeta;?></td>
                <td><?php echo $dif->nombre_estado;?></td>
                <td><center><a href="<?php echo base_url('index.php/proyecto/ver_hermanos');?>/<?php echo $dif->id_ingreso;?>/<?php echo $dif->id_expediente;?>" role="button"><?php echo $dif->hermanos;?></a></td>
                <td><?php echo $dif->nombre_centro;?></td>

                <td><center><a class="btn btn-info"  href="<?php echo base_url('index.php/proyecto/edita_ingreso2');?>/<?php echo $dif->id_ingreso;?>" role="button"><span class="glyphicon glyphicon-pencil"></span> <span class="glyphicon glyphicon-user"></span></a></center></td>

               <td><a class="btn btn-success" href="<?php echo base_url('index.php/proyecto/edita_familiar');?>/<?php echo $dif->id_ingreso;?>" role="button"><span class="glyphicon glyphicon-plus"></span> <span class="glyphicon glyphicon-user"></span></a></td>

           <td><a class="btn btn-warning"  href="<?php echo base_url('index.php/proyecto/edita_pension');?>/<?php echo $dif->id_expediente;?>/<?php echo $dif->id_ingreso;?>" role="button"><span class="glyphicon glyphicon-plus"></span> <span class="glyphicon glyphicon-usd"></a></td>

        <!--<td><a class="btn btn-info"  href="<?php echo base_url('index.php/proyecto/edita_ingreso');?>/<?php echo $dif->id_ingreso;?>" role="button"><span class="glyphicon glyphicon-pencil"></span> <span class="glyphicon glyphicon-user"></span></a></td>-->
            
              </tr>
              <?php 
              }
              ?>
            </tbody>
          </table>



        </div>
      </div>
    </div>


   