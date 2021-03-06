﻿  <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>index.php/proyecto/panel">Principal</a></li>
      <li><a href="<?php echo base_url();?>index.php/proyecto/compa_valoracion">NNA con Valoraciones Psicológicas</a></li>
      <li class="active">Valoración</li>
    </ol>

       <center> <h1 class="page-header">VALORACIÓN DEL INGRESO DEL NNA</h1> </center>

<div class="panel panel-primary">
      <div class="panel-heading">Información del NNA</div>
    <div class="panel-body">
       <form autocomplete="off" name="formulario" class="form" method="POST" action="<?php echo base_url()?>index.php/proyecto/valoracion_pedagogica/<?php echo $expediente['id_expediente'];?>">
      
         <div class="col-md-6">
            <div class="well well-sm">
              <div class="panel-body" >
              <td><center><img src="<?=base_url();?>/uploadt/<?=$expediente['foto_nino'];?>" width='300' height='315'></center></td>
                <!--<?php echo $expediente['foto_nino']?>-->
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="well well-sm">
              <div class="panel-body" >
                <label>Nombre del NNA: </label> <?php echo $expediente['nombres_nino'] ?> <?php echo $expediente['apellido_pnino'] ?> <?php echo $expediente['apellido_mnino'] ?><br>
              <label>No. Expediente: </label>  <?php echo $expediente['no_expediente'] ?> <br>
              <label>No. Carpeta: </label> <?php echo $expediente['no_carpeta']?><br>
              <label>Fecha de nacimiento: </label>  <?php $fecha_n=$expediente['fecha_nnino'];
                //var_dump($fecha_n);
                $dia = substr($fecha_n,8,2);
                $mes = substr($fecha_n,5,2);
                $anio = substr($fecha_n,0,4);
                $fecha_en = $dia."/".$mes."/".$anio;
                echo $fecha_en;
                //var_dump($fecha_n);
                ?><br/>
                <label>Edad: </label> 
                <?php 
                 $fecha_naci =  $expediente['fecha_nnino'];
                 $fecha_actual = date("Y/m/d");
                 //$edad =  $fecha_actual - $nace;
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
                 if($edad > 100) echo $expediente['edadcal']; 
                 else echo $edad;
                ?>
                <br/>
                <label>Género: </label>  
                 <?php if(($expediente['genero_nino'])=="F"){
                  ?>
                  <span>Femenino</span>
                <?php
                }
                else{
                  ?>
                  <span>Masculino</span>
                  <?php 
                }?> <br/>
                <label>Lugar de nacimiento: </label>  <?php echo $expediente['lugar_nnino']?> <br>
                <label>Municipio de origen:  </label>  <?php echo $expediente['municipio_origen']?><br>
                <label>Fecha de ingreso: </label>  <?php $f_expe = $expediente['fecha_ingreso'];
                //var_dump($f_expe);
                $dia = substr($f_expe,8,2);
                $mes = substr($f_expe,5,2);
                $anio = substr($f_expe,0,4);
                $fecha_e = $dia."/".$mes."/".$anio;
                echo $fecha_e;
                //var_dump($fecha);
                ?> <br/>
                  <label>Hora de ingreso: </label>  <?php echo $expediente['hora_ingreso']?> <br/>
                  <label>Centro asistencial: </label>  <?php echo $expediente['nombre_centro']?> <br/>
                  <label>Motivos de ingreso: </label> <?php echo $expediente['motivos_ingreso']?><br/>
                  <label>Observaciones del ingreso </label> <?php echo $expediente['observaciones_ingreso']?>
              </div>
            </div>
          </div>
      </form>
       </div> 
        </div>

<div class="panel panel-primary">
      <div class="panel-heading">Información de la valoración</div>
    <div class="panel-body">

     <?php
        //echo validation_errors();
        $atributos = array('class'=>'form-horizontal');
        echo form_open('proyecto/valoracion_psicologica/'.$expediente['id_expediente'],$atributos);
        //var_dump($privilegio);
       ?>
    <label for="Observaciones6">Motivos del ingreso <span style="color: red" class="asterisco">*</span></label>
        <input  type="text" name="motivos" value="<?php echo set_value('motivos');?>" id="Observaciones6" class="form-control" placeholder="Motivos del ingreso ">
        <?php echo form_error('motivos');?>
    </br>
    <label for="Observaciones3">Fecha de la visita <span style="color: red" class="asterisco">*</span></label>
    <div class=input-group> 
    <div class=input-group-addon icon-ca><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span></div>
        <input  type="date" name="fecha_vis" value="<?php echo set_value('fecha_vis');?>" id="Observaciones3" class="form-control" placeholder="Fecha de la visita">
              </div>
        <?php echo form_error('fecha_vis');?>
<br>
    <label for="Observaciones4">Nombre del visitante <span style="color: red" class="asterisco">*</span></label>
        <input  type="text" name="nombre_vis" value="<?php echo set_value('nombre_vis');?>" id="Observaciones4" class="form-control" placeholder="Nombre del visitante">
        <?php echo form_error('nombre_vis');?>
    </br>
    <label for="Parentesco">Parentesco con el NNA:<span style="color: red" class="asterisco">*</span></label>
        <br>
        <div class="radio">
         <label><input type="radio" name="relacion" value="Padre/Madre" <?php if(set_value('relacion')=='Padre/Madre') echo "checked"; ?> id="relacion"> Padre/Madre</label>
       </div>
       <div class="radio"><label><input type="radio" name="relacion" value="Padrino/Madrina" <?php if(set_value('relacion')=='Padrino/Madrina') echo "checked"; ?> id="relacion"> Padrino/Madrina</label>
       </div>
        <div class="radio"><label><input type="radio" name="relacion" value="Tio(a)" <?php if(set_value('relacion')=='Tio(a)') echo "checked"; ?> id="relacion">Tio(a)</label>
       </div>
        <div class="radio"><label><input type="radio" name="relacion" value="Primo(a)" <?php if(set_value('relacion')=='Primo(a)') echo "checked"; ?> id="relacion">Primo(a) </label>
       </div>
        <div class="radio"><label><input type="radio" name="relacion" value="Otro" <?php if(set_value('relacion')=='Otro') echo "checked"; ?> id="relacion"> Otro</label>
       </div>
</br>
    <label for="Observaciones4">Antecedentes del caso <span style="color: red" class="asterisco">*</span></label>
        <input  type="text" name="antecedentes" value="<?php echo set_value('antecedentes');?>" id="Observaciones4" class="form-control" placeholder="Observaciones">
        <?php echo form_error('antecedentes');?>
    </br>
    <label for="Observaciones5">Actitud del NNA <span style="color: red" class="asterisco">*</span></label>
        <input  type="text" name="actitud" value="<?php echo set_value('actitud');?>" id="Observaciones5" class="form-control" placeholder="Antecedentes del caso">
        <?php echo form_error('actitud');?>
</br>
    <label for="Observaciones4">Dinamica de convivencias <span style="color: red" class="asterisco">*</span></label>
        <input  type="text" name="dinamica" value="<?php echo set_value('dinamica');?>" id="Observaciones4" class="form-control" placeholder="Dinamica de convivencias ">
        <?php echo form_error('dinamica');?>
    </br>
    <label for="Observaciones5">Recomendaciones <span style="color: red" class="asterisco">*</span></label>
        <input  type="text" name="recomendaciones" value="<?php echo set_value('recomendaciones');?>" id="Observaciones5" class="form-control" placeholder="Recomendaciones">
        <?php echo form_error('recomendaciones');?>


      <input type="hidden" name="expediente" value="<?php echo $expediente['id_expediente']; ?>">
      <?php echo form_error('id_expediente');?>


      <?php $fecha_time = date("Y/m/d/");?>
      <input type="hidden" name="fecha_actual" value="<?php echo $fecha_time; ?>">
      <?php echo form_error('fecha_actual');?>

        </div> 
        </div>
        <center>
          <button type="submit" class="btn btn-success" name="formulario">Guardar</button>
        </center>
  </div>
  </div>
</div>
