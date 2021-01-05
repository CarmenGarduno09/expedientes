  <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>index.php/proyecto/panel">Principal</a></li>
      <li><a href="<?php echo base_url();?>index.php/proyecto/expediente_pedagogia">Expedientes niños</a></li>
      <li class="active">Valoración</li>
    </ol>

       <center> <h1 class="page-header">VALORACIÓN PEDAGÓGICA</h1> </center>

<div class="panel panel-primary">
      <div class="panel-heading">Información del niño</div>
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
                <label>Nombre del niño: </label> <?php echo $expediente['nombres_nino'] ?> <?php echo $expediente['apellido_pnino'] ?> <?php echo $expediente['apellido_mnino'] ?><br>
              <label>No. Expediente: </label>  <?php echo $expediente['no_expediente'] ?> <br>
              <label>No. Carpeta: </label> <?php echo $expediente['no_carpeta']?><br>
              <label>Fecha de nacimiento: </label> <?php $fecha_n=$expediente['fecha_nnino'];
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
                // $edad =  $fecha_actual - $nace;
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
        echo form_open('proyecto/valoracion_pedagogica/'.$expediente['id_expediente'],$atributos);
        //var_dump($privilegio);
       ?>

<label for="Parentesco">Rango de edad: <span style="color: red" class="asterisco">*</span></label>
        <br>
        <div class="radio">
         <label><input type="radio" name="rango" value="0-3" <?php if(set_value('rango')=='0-3') echo "checked"; ?> id="rango"> 0 - 3 años</label>
       </div>
       <div class="radio"><label><input type="radio" name="rango" value="4-7" <?php if(set_value('rango')=='4-7') echo "checked"; ?> id="rango"> 4 - 7 años</label>
       </div>
        <div class="radio"><label><input type="radio" name="rango" value="8-11" <?php if(set_value('rango')=='8-11') echo "checked"; ?> id="rango">8 - 11 años</label>
       </div>
        <div class="radio"><label><input type="radio" name="rango" value="12-15" <?php if(set_value('rango')=='12-15') echo "checked"; ?> id="rango">12 - 15 años</label>
       </div>
        <div class="radio"><label><input type="radio" name="rango" value="16-18" <?php if(set_value('rango')=='16-18') echo "checked"; ?> id="rango"> 16 - 18 años</label>
       </div>
<br>
<label for="Estudios">Estudios <span style="color: red" class="asterisco">*</span></label>
        <input  type="text" name="estudios" value="<?php echo set_value('estudios');?>" id="Estudios" class="form-control" placeholder="Estudios">
        <?php echo form_error('estudios');?>
<br>
<label for="nombre">Desempeño en la lectura <span class="asterisco">*</span> </label>
    </br>
      <?php 
        foreach ($nivel as $l) {
      ?>
     <div>
          <input type="radio" class="form-control.radio " id="lectura" name="lectura" value="<?=$l->id_nivel;?>" <?php if(set_value('lectura')==$l->id_nivel) echo "checked";?>> <?=$l->nombre;?>
     </div>
      <?php }?>
      <?php echo form_error('lectura');?> 
    </br>
    <label for="Observaciones1">Observaciones <span style="color: red" class="asterisco">*</span></label>
        <input  type="text" name="observaciones1" value="<?php echo set_value('observaciones1');?>" id="Observaciones1" class="form-control" placeholder="Observaciones">
        <?php echo form_error('observaciones1');?>
<br>
<label for="nombre">Comprensión lectora <span class="asterisco">*</span> </label>
    </br>
      <?php 
        foreach ($nivel as $cl) {
      ?>
     <div>
          <input type="radio" class="form-control.radio " id="comp_lectura" name="comp_lectura" value="<?=$cl->id_nivel;?>" <?php if(set_value('comp_lectura')==$cl->id_nivel) echo "checked";?>> <?=$cl->nombre;?> 
     </div>
      <?php }?>
      <?php echo form_error('comp_lectura');?> 
    </br>
    <label for="Observaciones6">Observaciones <span style="color: red" class="asterisco">*</span></label>
        <input  type="text" name="observaciones6" value="<?php echo set_value('observaciones6');?>" id="Observaciones6" class="form-control" placeholder="Observaciones">
        <?php echo form_error('observaciones6');?>
<br>
<label for="nombre">Desempeño en transcripción <span class="asterisco">*</span> </label>
    </br>
      <?php 
        foreach ($nivel as $t) {
      ?>
     <div>
          <input type="radio" class="form-control.radio " id="transcripcion" name="transcripcion" value="<?=$t->id_nivel;?>" <?php if(set_value('transcripcion')==$t->id_nivel) echo "checked";?>> <?=$t->nombre;?>
     </div>
      <?php }?>
      <?php echo form_error('transcripcion');?> 
    </br>
    <label for="Observaciones2">Observaciones <span style="color: red" class="asterisco">*</span></label>
        <input  type="text" name="observaciones2" value="<?php echo set_value('observaciones2');?>" id="Observaciones2" class="form-control" placeholder="Observaciones">
        <?php echo form_error('observaciones2');?>
<br>
<label for="nombre">Desempeño matematico <span class="asterisco">*</span> </label>
    </br>
      <?php 
        foreach ($nivel as $m) {
      ?>
     <div>
          <input type="radio" class="form-control.radio " id="matematico" name="matematico" value="<?=$m->id_nivel;?>" <?php if(set_value('matematico')==$m->id_nivel) echo "checked";?>> <?=$m->nombre;?>
     </div>
      <?php }?>
      <?php echo form_error('matematico');?> 
    </br>
    <label for="Observaciones3">Observaciones <span style="color: red" class="asterisco">*</span></label>
        <input  type="text" name="observaciones3" value="<?php echo set_value('observaciones3');?>"  id="Observaciones3" class="form-control" placeholder="Observaciones">
        <?php echo form_error('observaciones3');?>
<br>
<label for="nombre">Desempeño en español <span class="asterisco">*</span> </label>
    </br>
      <?php 
        foreach ($nivel as $e) {
      ?>
     <div>
          <input type="radio" class="form-control.radio " id="espanol" name="espanol" value="<?=$e->id_nivel;?>" <?php if(set_value('espanol')==$e->id_nivel) echo "checked";?>> <?=$e->nombre;?>
     </div>
      <?php }?>
      <?php echo form_error('espanol');?> 
    </br>
    <label for="Observaciones4">Observaciones <span style="color: red" class="asterisco">*</span></label>
        <input  type="text" name="observaciones4" value="<?php echo set_value('observaciones4');?>" id="Observaciones4" class="form-control" placeholder="Observaciones">
        <?php echo form_error('observaciones4');?>
<br>
<label for="nombre">Desempeño en escritura/ortografia <span class="asterisco">*</span> </label>
    </br>
      <?php 
        foreach ($nivel as $o) {
      ?>
     <div>
          <input type="radio" class="form-control.radio " id="ortografico" name="ortografico" value="<?=$o->id_nivel;?>" <?php if(set_value('ortografico')==$o->id_nivel) echo "checked";?>> <?=$o->nombre;?>
     </div>
      <?php }?>
      <?php echo form_error('ortografico');?> 
    </br>
    <label for="Observaciones5">Observaciones <span style="color: red" class="asterisco">*</span></label>
        <input  type="text" name="observaciones5" value="<?php echo set_value('observaciones5');?>" id="Observaciones5" class="form-control" placeholder="Observaciones">
        <?php echo form_error('observaciones5');?>
<br>
<label for="nombre">Canalización de estudios <span class="asterisco">*</span> </label>
    </br>
      <?php 
        foreach ($estudios as $es) {
      ?>
     <div>
          <input type="radio" class="form-control.radio " id="canalizacion" name="canalizacion" value="<?=$es->id_educacion;?>" <?php if(set_value('canalizacion')==$es->id_educacion) echo "checked";?> > <?=$es->nombre_educacion;?>
     </div>
      <?php }?>
      <?php echo form_error('canalizacion');?> 

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
