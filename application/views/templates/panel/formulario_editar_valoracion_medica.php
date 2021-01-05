<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url();?>index.php/proyecto/expediente_medico">Expedientesn</a></li>
    <li class="active">Valoraión medica</li>
  </ol>

<!--<h2>Formulario de registro</h2>-->
<center><h2>Edición de valoración médica</h2></center>
<div class="panel panel-primary">
      <div class="panel-heading">Información del niño</div>
    <div class="panel-body">
       <form autocomplete="off" name="formulario" class="form" method="POST" action="<?php echo base_url()?>index.php/proyecto/editar_evaluacion_medico/<?php echo $expediente['id_expediente'];?>">
      
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
                ?>  <br/>
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
      <div class="panel-heading">Información médica del niño</div>

      
     <?php
        //echo validation_errors();
        $atributos = array('class'=>'form-horizontal');
        echo form_open('proyecto/editar_evaluacion_medico/'.$valoracion_medi['id_valmedica'],$atributos);
        //var_dump($privilegio);
       ?>

    <div class="panel-body">
    <form autocomplete="off" name="formulario" class="form" method="POST" action="<?php echo base_url()?>index.php/proyecto/editar_evaluacion_medico/<?php echo $expediente['id_expediente']; ?>/<?php echo $expediente['id_ingreso']; ?>">
     <h5> <b style="color: black;">
   <label for="condicion">Condición inicial: <span style="color:red" class="asterisco">*</span></label>
          <div class="radio">
            <label><input type="radio" name="condicion" value="Buena" <?php if($valoracion_medi['condicion']=='Buena') echo "checked";?>>Buena</label>
        </div>
        <div class="radio">
            <label><input type="radio" name="condicion" value="Regular" <?php if($valoracion_medi['condicion']=='Regular') echo "checked";?>>Regular</label>
        </div>
        <div class="radio">
            <label><input type="radio" name="condicion" value="Mala" <?php if($valoracion_medi['condicion']=='Mala') echo "checked";?>>Mala</label>
        </div>
      <?php echo form_error('condicion'); ?>
  
       <br>
        <label for="des_ini">Descripción inicial de salud a su ingreso: <span style="color: red" class="asterisco">*</span> </label> 
      <input type="text" class="form-control" name="des_ini" value="<?php echo $valoracion_medi['des_ini'];?>" id="descripcion" placeholder="Descripción inicial">
      <?php echo form_error('des_ini');?>
      <br>

         <label for="peso">Somatometría: <span style="color: red" class="asterisco">*</span> </label>
      <input type="text" class="form-control" name="peso" value="<?php echo $valoracion_medi['peso'];?>" id="peso" placeholder="Ingrese su peso">
      <?php echo form_error('peso');?>
      <br>
      <label for="cabeza">Cabeza: <span style="color: red" class="asterisco">*</span> </label>
      <input type="text" class="form-control" name="cabeza" value="<?php echo $valoracion_medi['cabeza'];?>" id="cabeza" placeholder="Descripción de la cabeza">
      <?php echo form_error('cabeza');?>
      <br>
        <label for="ojos">Ojos: <span style="color: red" class="asterisco">*</span> </label>
      <input type="text" class="form-control" name="ojos" value="<?php echo $valoracion_medi['ojos'];?>" id="ojos" placeholder="Descripción de los ojos">
      <?php echo form_error('ojos');?>
      <br>
   
      <br>
        <label for="nariz">Nariz: <span style="color: red" class="asterisco">*</span> </label>
      <input type="text" class="form-control" name="nariz" value="<?php echo $valoracion_medi['nariz'];?>" id="nariz" placeholder="Descripción de la nariz">
      <?php echo form_error('nariz');?>
      <br>
        <label for="boca">Boca: <span style="color: red" class="asterisco">*</span> </label>
      <input type="text" class="form-control" name="boca" value="<?php echo $valoracion_medi['boca'];?>" id="boca" placeholder="Descripción de la boca">
      <?php echo form_error('boca');?>
      <br>
        <label for="cuello">Cuello: <span style="color: red" class="asterisco">*</span> </label>
      <input type="text" class="form-control" name="cuello" value="<?php echo $valoracion_medi['cuello'];?>" id="cuello" placeholder="Descripción del cuello">
      <?php echo form_error('cuello');?>
      <br>
        <label for="torax">Torax: <span style="color: red" class="asterisco">*</span> </label>
      <input type="text" class="form-control" name="torax" value="<?php echo $valoracion_medi['torax'];?>" id="torax" placeholder="Descripción del torax">
      <?php echo form_error('torax');?>
      <br>
        <label for="abdomen">Abdomen: <span style="color: red" class="asterisco">*</span> </label>
      <input type="text" class="form-control" name="abdomen" value="<?php echo $valoracion_medi['abdomen'];?>" id="abdomen" placeholder="Descripción del abdomen">
      <?php echo form_error('abdomen');?>
      <br>
        <label for="genitales">Genitales: <span style="color: red" class="asterisco">*</span> </label>
      <input type="text" class="form-control" name="genitales" value="<?php echo $valoracion_medi['genitales'];?>" id="genitales" placeholder="Descripción de los genitales">
      <?php echo form_error('genitales');?>
      <br>
        <label for="columna">Columna: <span style="color: red" class="asterisco">*</span> </label>
      <input type="text" class="form-control" name="columna" value="<?php echo $valoracion_medi['columna'];?>" id="columna" placeholder="columna">
      <?php echo form_error('columna');?>
      <br>
        <label for="extremidades">Extremidades: <span style="color: red" class="asterisco">*</span> </label>
      <input type="text" class="form-control" name="extremidades" value="<?php echo $valoracion_medi['extremidades'];?>" id="extremidades" placeholder="Descripción de sus extremidades">
      <?php echo form_error('extremidades');?>
      <br>
        <label for="tez">Tés: <span style="color: red" class="asterisco">*</span> </label>
      <input type="text" class="form-control" name="tes" value="<?php echo $valoracion_medi['tes'];?>" id="tes" placeholder="Descripción de su tés">
      <?php echo form_error('tes');?>
      <br>
       
      </select>

      <input type="hidden" name="expediente" value="<?php echo $expediente['id_expediente']; ?>">
      <?php echo form_error('id_expediente');?>

      <input type="hidden" name="id_valmedica" value="<?php echo $valoracion_medi['id_valmedica']; ?>">
      <?php echo form_error('id_valmedica');?>

      <?php $fecha_time = date("Y/m/d/");?>
      <input type="hidden" name="fecha_actual" value="<?php echo $fecha_time; ?>">
      <?php echo form_error('fecha_actual');?>

    </div><!--panel body-->
 </div>
 <center>
<button class="btn btn-success" name="formulario" type="submit">Actualizar</button>
</center>
</form>

</div>
   </div><!--row-->
</div>
</body>
</html>