	<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
		<ol class="breadcrumb">
		  <li><a href="<?php echo base_url();?>index.php/proyecto/panel">Principal</a></li>
		  <li><a href="<?php echo base_url();?>index.php/proyecto/vista_expediente_nino">Lista de Expedientes</a></li>
		  <li class="active">Edición de Asignación a Expediente</li>
		</ol>

        <center><h1 class="page-header">ASIGNACIÓN A EXPEDIENTE</h1></center>
          <div class="well well-sm">
                    <h2 align="center" ><p>Nombre del NNA: <?php echo $expediente['nombres_nino'] ?> <?php echo $expediente['apellido_pnino'] ?> <?php echo $expediente['apellido_mnino'] ?></p></h2>
                    <h3 align="center" ><p>No. Expediente:  <?php echo $expediente['no_expediente'] ?> </p></h3>
                    <h4 align="center"><p>No. Carpeta:  <?php echo $expediente['no_carpeta']?></p></h4>
           </div>
     
         <div class="panel panel-primary">
     <div class="panel-heading">Información del expediente </div>

    
 
     <div class="panel-body">

         <?php
        //echo validation_errors();
        $atributos = array('class'=>'form-horizontal');
        echo form_open('Proyecto/edita_expediente1/'.$expediente['id_expediente'],$atributos);
        //var_dump($privilegio);
       ?>
 			<label for="requis"><span style="color: orange" class="asterisco">Trabajadores que atenderan el expediente del niño</span> </label>
      <br>
       <label for="requis">Abogado: <span style="color: red" class="asterisco">*</span> </label>
  <select name="id_persona1" class="form-control">
<?php foreach ($inte1 as $e) {
?>
    <option value="<?=$e->id_persona;?>" <?php if($abogado['id_persona']==$e->id_persona){echo "selected";} ?> class="col-sm-2 control-label"><?=$e->nombres;?> <?=$e->apellido_p;?> <?=$e->apellido_m;?></option>
<?php 
}   
?>
    </select>
    <br>
       <label for="requis">Trabajador(a) social: <span style="color: red" class="asterisco">*</span> </label>
  <select name="id_persona2" class="form-control">
<?php foreach ($inte2 as $e) {
?>
    <option value="<?=$e->id_persona;?>" <?php if($trabajo_social['id_persona']==$e->id_persona){echo "selected";} ?>  class="col-sm-2 control-label"><?=$e->nombres;?> <?=$e->apellido_p;?> <?=$e->apellido_m;?></option>
<?php 
}   
?>
    </select>
    <br>
       <label for="requis">Psicologa: <span style="color: red" class="asterisco">*</span> </label>
  <select name="id_persona3" class="form-control">
<?php foreach ($inte3 as $e) {
?>
    <option value="<?=$e->id_persona;?>" <?php if($psicologo['id_persona']==$e->id_persona){echo "selected";} ?>  class="col-sm-2 control-label"><?=$e->nombres;?> <?=$e->apellido_p;?> <?=$e->apellido_m;?></option>
<?php 
}   
?>

 			<input type="hidden" name="id_expediente" value="<?php echo $expediente['id_expediente']; ?>">
 			<?php echo form_error('id_expediente');?>
   
      </div>
      </div>
 			<button type="submit" class="btn btn-success" name="formulario">Guardar</button>
   

        
 	</div>
  </div>
  </form>
</div>
