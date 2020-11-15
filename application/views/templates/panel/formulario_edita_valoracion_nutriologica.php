<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>index.php/proyecto/panel">Principal</a></li>
      <li><a href="<?php echo base_url();?>index.php/proyecto/expediente_pedagogia">Expedientes NNA</a></li>
      <li class="active">Edición de Valoración Nutriológica</li>
    </ol>

       <center> <h1 class="page-header">EDITA VALORACIÓN NUTRIOLÓGICA</h1> </center>

<div class="panel panel-primary">
      <div class="panel-heading">Información del NNA</div>
    <div class="panel-body">
       <form autocomplete="off" name="formulario" class="form" method="POST" action="<?php echo base_url()?>index.php/proyecto/valoracion_nutriologica/<?php echo $expediente['id_expediente'];?>">
      
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
        echo form_open('proyecto/editar_valoracion_nutri/'.$valoracion_nut['id_valnutricion'],$atributos);
        //var_dump($privilegio);
       ?>


<label for="Peso">Peso <span style="color: red" class="asterisco">*</span></label>
        <input  type="text" name="peso" value="<?php if(set_value('peso')) echo (set_value('peso'));else if(form_error('peso')){echo " ";}else{ echo $valoracion_nut['peso'];};?>" id="Peso" class="form-control" placeholder="Peso">
        <?php echo form_error('peso');?>
<br>
    <label for="Talla">Talla <span style="color: red" class="asterisco">*</span></label>
        <input  type="text" name="talla" value="<?php if(set_value('talla')) echo (set_value('talla'));else if(form_error('talla')){echo " ";}else{ echo $valoracion_nut['talla'];};?>" id="talla" class="form-control" placeholder="Talla">
        <?php echo form_error('talla');?>
<br>

    <label for="Pesoi">Peso ideal <span style="color: red" class="asterisco">*</span></label>
        <input  type="text" name="pesoi" value="<?php if(set_value('pesoi')) echo (set_value('pesoi'));else if(form_error('pesoi')){echo " ";}else{ echo $valoracion_nut['peso_ideal'];};?>" id="pesoi" class="form-control" placeholder="Peso ideal">
        <?php echo form_error('pesoi');?>

    </br>
    <label for="Diagnostico">Diagnostico nutricional <span style="color: red" class="asterisco">*</span></label>
        <input  type="text" name="diagnostico" value="<?php if(set_value('diagnostico')) echo (set_value('diagnostico'));else if(form_error('diagnostico')){echo " ";}else{ echo $valoracion_nut['diagnostico_nutricional'];};?>" id="Diagnostico" class="form-control" placeholder="Diagnostico">
        <?php echo form_error('diagnostico');?>
<br>

    <label for="Dieta">Dieta <span style="color: red" class="asterisco">*</span></label>
        <input  type="text" name="dieta" value="<?php if(set_value('dieta')) echo (set_value('dieta'));else if(form_error('dieta')){echo " ";}else{ echo $valoracion_nut['dieta'];};?>" id="Dieta" class="form-control" placeholder="Dieta">
        <?php echo form_error('dieta');?>
<br>
    <label for="Plan">Plan alimenticio <span style="color: red" class="asterisco">*</span></label>
        <input  type="text" name="plan" value="<?php if(set_value('plan')) echo (set_value('plan'));else if(form_error('plan')){echo " ";}else{ echo $valoracion_nut['plan_alimenticio'];};?>" id="Plan" class="form-control" placeholder="Plan alimenticio">
        <?php echo form_error('plan');?>
<br>

    <label for="Rasgos">Rasgos fisicos <span style="color: red" class="asterisco">*</span></label>
        <input  type="text" name="rasgos" value="<?php if(set_value('rasgos'))echo (set_value('rasgos'));else if(form_error('rasgos')){echo " ";}else{ echo $valoracion_nut['rasgos_fisicos'];} ;?>" id="Rasgos" class="form-control" placeholder="Rasgos fisicos">
        <?php echo form_error('rasgos');?>
<br>
    <label for="Comedor">Datos del comedor <span style="color: red" class="asterisco">*</span></label>
        <input  type="text" name="comedor" value="<?php if(set_value('comedor'))echo (set_value('comedor'));else if(form_error('comedor')){echo " ";}else{ echo $valoracion_nut['datos_comedor'];} ;?>" id="Comedor" class="form-control" placeholder="Datos del comedor">
        <?php echo form_error('comedor');?>
<br>

    <label for="Enfernedad">Enfermedad <span style="color: red" class="asterisco">*</span></label>
        <input  type="text" name="enfermedad" value="<?php if(set_value('enfermedad')) echo (set_value('enfermedad'));else if(form_error('enfermedad')){echo " ";}else{ echo $valoracion_nut['enfermedad'];};?>" id="Enfermedad" class="form-control" placeholder="Enfermedad">
        <?php echo form_error('enfermedad');?>
<br>

    <label for="Trato">Trato especial <span style="color: red" class="asterisco">*</span></label>
        <input  type="text" name="trato" value="<?php if(set_value('trato'))echo (set_value('trato'));else if(form_error('trato')){echo " ";}else{ echo $valoracion_nut['trato_especial'];} ;?>" id="Trato" class="form-control" placeholder="Trato especial">
        <?php echo form_error('trato');?>
<br>

      <input type="hidden" name="expediente" value="<?php echo $expediente['id_expediente']; ?>">
      <?php echo form_error('id_expediente');?>

      <input type="hidden" name="id_valnutricion" value="<?php echo $valoracion_nut['id_valnutricion']; ?>">
      <?php echo form_error('id_valnutricion');?>

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
