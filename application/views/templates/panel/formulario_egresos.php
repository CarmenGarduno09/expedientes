<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url();?>index.php/proyecto/panel">Principal</a></li>
    <li><a href="<?php echo base_url();?>index.php/proyecto/expediente_incidencia">Expedientes</a></li>
    <li class="active">Egreso de NNA</a></li>
  </ol>
  <h1><center>EGRESO DE NNA</center></h1>
<div class="panel panel-primary">
      <div class="panel-heading">Información del NNA</div>
    <div class="panel-body">
       <form autocomplete="off" name="formulario" class="form" method="POST" action="<?php echo base_url()?>index.php/proyecto/formulario_ninos_egresos/<?php echo $expediente['id_expediente'];?>">
      
         <div class="col-md-6">
            <div class="well well-sm">
              <div class="panel-body" >
              <td><center><img src="<?=base_url();?>/uploadt/<?=$expediente['foto_nino'];?>" width='300' height='315'></center></td>
              <!--<td><img src="<?=base_url();?>/uploadt/<?=$dif->foto_nino;?>" width='60' height='60'></td>-->
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="well well-sm">
              <div class="panel-body" >
                <label>Nombre del NNA: </label> <?php echo $expediente['nombres_nino'] ?> <?php echo $expediente['apellido_pnino'] ?> <?php echo $expediente['apellido_mnino'] ?><br>
              <label>No. Expediente: </label>  <?php echo $expediente['no_expediente'] ?> <br>
              <label>No. Carpeta: </label> <?php echo $expediente['no_carpeta']?><br>
              <label>Fecha de nacimiento: </label>  <?php echo $expediente['fecha_nnino']?><br/>
                <label>Edad: </label> 
                <?php 
                 $nace =  $expediente['fecha_nnino'];
                 $fecha_actual = date("Y/m/d");
                 $edad =  $fecha_actual - $nace;
                 if($edad > 100) echo $expediente['edadcal']; 
                 else echo $edad;
                ?>
                <br/>
                <label>Género: </label> <?php echo $expediente['genero_nino']?> <br>
                <label>Lugar de nacimiento: </label>  <?php echo $expediente['lugar_nnino']?> <br>
                <label>Municipio de origen:  </label>  <?php echo $expediente['municipio_origen']?><br>
                <label>Fecha de ingreso: </label>  <?php echo $expediente['fecha_ingreso']?> <br/>
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
      <div class="panel-heading">Información del egreso del NNA</div>
    <div class="panel-body">
    <form autocomplete="off" name="formulario" class="form" method="POST" action="<?php echo base_url()?>index.php/proyecto/formulario_ninos_egresos/<?php echo $expediente['id_expediente'];?>">

        <label for="Nombres">Centro asistencial del que sale <span class="asterisco">*</span> </label></br> 
      <select class="form-control" name="id_centro">
      <?php foreach ($cent as $a){ ?>
        <option value="<?php echo $a->id_centro;?>"
            <?php 
        if($expediente_n['id_centro'] == $a->id_centro)
        echo "selected";?>
      ><?=$a->nombre_centro;?>
      <?php } ?>
        </option>
      </select>

    <br>

    <label>Fecha del egreso <span style="color: red" class="asterisco">*</span></label>
        <div class=input-group>  
        <div class=input-group-addon icon-ca><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span></div>
        <input type="date" name="fecha_egreso"
    step="1"
    min="1900-01-01"      
    max="2100-12-31" class="btn btn-default" style="color: gray;"
    placeholder="año-mes-dia" >
  <?php echo form_error('fecha_egreso');?>
        <span class="add-on"><i class="icon-calendar" id="cal"></i></span>
        </div>
        <br>
        <label for="Nombres">Motivos del egreso<span style="color: red" class="asterisco">*</span></label>
        <input  type="text" name="motivos_egreso" value="<?php echo set_value('motivos_egreso');?>" id="Nombres" class="form-control" placeholder="Motivos del egreso">
        <?php echo form_error('motivos_egreso');?>
      <br>
        <label for="Nombres">Coordinación encargada del tramite<span style="color: red" class="asterisco">*</span></label>
        <input  type="text" name="autoriza" value="<?php echo set_value('autoriza');?>" id="Nombres" class="form-control" placeholder="Nombre de la coordinación">
        <?php echo form_error('autoriza');?>
     <br>
     <label for="Nombres">Nombre de la persona o parentesco con la que se entrega <span style="color: red" class="asterisco">*</span></label>
        <input  type="text" name="responsable" value="<?php echo set_value('responsable');?>" id="Nombres" class="form-control" placeholder="Nombre de la persona o parentesco">
        <?php echo form_error('responsable');?>
         

      <input type="hidden" name="id_expediente" value="<?php echo $expediente['id_expediente']; ?>">
      <?php echo form_error('id_expediente');?>


      <!--<?php $fecha_time = date("Y/m/d/");?>
      <input type="hidden" name="fecha_actual" value="<?php echo $fecha_time; ?>">
      <?php echo form_error('fecha_actual');?>-->

    </div><!--panel body-->
 </div>

<button class="btn btn-success" name="formulario" type="submit">Guardar</button>

</form>
</div>
   </div><!--row--> 
</div>