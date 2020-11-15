<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
  <ol class="breadcrumb">
  <li><a href="<?php echo base_url();?>index.php/proyecto/panel">Principal</a></li>
    <li class="active">Registros de NNA</li>
  </ol>

  <center><h1 style="background-color: white" border="2" class="page-header"> REGISTROS DE TODOS LOS NNA </h1></center>

<br>
 <a class="btn btn-primary" href="<?php echo base_url();?>index.php/proyecto/alta_ninos" role="button"><span class="glyphicon glyphicon-plus"></span> Agregar Nuevo NNA</a>
<br>
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
              <tr bgcolor="#F9E79F" align="center">
                  <center>
                <th><center>Foto</th>
                <th><center>Nombre del NNA</th>
                <th><center>Genéro</th>
                <th><center>Edad</th>
                <th><center>Lugar de Nacimiento</th>
                <th><center>Municipio Origen</th>
                <th><center>Fecha de ingreso</th>
                <th><center>Delito</th>
                <th><center>Motivos ingreso</th>
                <th><center>No. Carpeta</th>
                <th><center>Centro de Asistencia</th>
                <th><center>Editar Datos</th>
                <th><center>Editar Foto</th>
                </center>
              </tr>
            </thead>
            <tbody>
              <?php 
              foreach ($ninosdif as $dif){
              ?>
              <tr bgcolor="#FEF5E7">
                <td><img src="<?php echo $this->Modelo_proyecto->valida_archivo_thumbnail($dif->foto_nino);?>" width='60' height='60'></td>

                
                <td><?php echo $dif->nombres_nino;?> <?php echo $dif->apellido_pnino;?> <?php echo $dif->apellido_mnino;?></td>
                <td><?php echo $dif->genero_nino;?></td>
                <td><center>
                <?php 
                $fecha_naci = $this->Modelo_proyecto->ver_edad($dif->id_ingreso);
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
                if($edad > 100) echo $dif->edadcal; 
                else echo $edad;
                ?> 
                </center></td>
                <td><?php echo $dif->lugar_nnino;?></td>
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
                <td><?php echo $dif->no_carpeta;?></td>
                <td><?php echo $dif->nombre_centro;?></td>

        
                <td><center><a class="btn btn-info"  href="<?php echo base_url('index.php/proyecto/edita_ingreso');?>/<?php echo $dif->id_ingreso;?>" role="button"><span class="glyphicon glyphicon-pencil"></span> <span class="glyphicon glyphicon-user"></span></a></center></td>
                <td><center><a class="btn btn-success"  href="<?php echo base_url('index.php/proyecto/edita_foto');?>/<?php echo $dif->id_expediente;?>/<?php echo $dif->id_ingreso;?>" role="button"><span class="glyphicon glyphicon-pencil"></span> <span class="glyphicon glyphicon-picture"></span></a></center></td>
                
                <!--<td><center><a class="btn btn-info"  href="<?php echo base_url('index.php/proyecto/edita_ingreso');?>/<?php echo $dif->id_ingreso;?>" role="button"><span class="glyphicon glyphicon-pencil"></span> <span class="glyphicon glyphicon-user"></span></a></center></td>-->
         </tr>
              <?php 
              }
              ?>
            </tbody>
          </table>

<!--<input type="hidden" name="usuario" class="form-control" value="<?php echo $sesion['id_persona'];?>">-->


        </div>
      </div>
    </div>


   