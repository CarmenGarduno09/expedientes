<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" >
  <div class="noImprimir">
   <ol class="breadcrumb" >
      <li><a href="<?php echo base_url();?>index.php/proyecto/panel">Principal</a></li>
      <li><a href="<?php echo base_url();?>index.php/proyecto/vista_expediente_nino">Lista de Expedientes</a></li>
      <li class="active">Expediente particular</li>
    </ol> 
  </div>
 

  <div class="col-md-12">
    <div class="well well-sm">
        <h1 align="center" ><p>Nombre del NNA: <?php echo $expediente['nombres_nino'] ?> <?php echo $expediente['apellido_pnino'] ?> <?php echo $expediente['apellido_mnino'] ?></p></h1>
        <h2 align="center" ><p>No. Expediente:  <?php echo $expediente['no_expediente'] ?> </p></h2>
        <h3 align="center"><p>No. Carpeta:  <?php echo $expediente['no_carpeta']?></p></h3>
    </div>
</div>
          
          <div class="col-md-12" id="salto">
            <div class="well well-sm">
              <div class="panel-body" >
                <h4 align="center"><b>VALORACIONES</b></h4><br>
                    <label>VALORACIÓN MEDICA </label><br/>
                  <p>
                  Fecha de la Valoración: <?php $medicina=$valoracion_medi['fecha_valmed'];
                  //var_dump($medicina);
                  $dia = substr($medicina,8,2);
                  $mes = substr($medicina,5,2); 
                  $anio = substr($medicina,0,4);
                  $fecha_med = $dia."/".$mes."/".$anio;
                  echo $fecha_med;
                  //var_dump($fecha_med); 
                  ?><br>
                  Condición inicial: <?php if($valoracion_medi['condicion']){echo $valoracion_medi['condicion'];}else{echo "La valoración no ha sido realizada";}?><br>
                  Descripción inicial de salud: <?php if($valoracion_medi['des_ini']){echo $valoracion_medi['des_ini'];}else{echo "La valoración no ha sido realizada";}?><br>
                  Somatometría: <?php if($valoracion_medi['peso']){echo $valoracion_medi['peso'];}else{echo "La valoración no ha sido realizada";}?><br>
                  Descripción de cabeza: <?php if($valoracion_medi['cabeza']){echo $valoracion_medi['cabeza'];}else{echo "La valoración no ha sido realizada";}?><br>
                  Descripción de ojos: <?php if($valoracion_medi['ojos']){echo $valoracion_medi['ojos'];}else{echo "La valoración no ha sido realizada";}?><br>
                  Descripción de nariz: <?php if( $valoracion_medi['nariz']){echo $valoracion_medi['nariz'];}else{echo "La valoración no ha sido realizada";}?><br>
                  Descripción de boca: <?php if($valoracion_medi['boca']){echo $valoracion_medi['boca'];}else{echo "La valoración no ha sido realizada";}?><br>
                  Descripción de cuello: <?php if($valoracion_medi['cuello']){echo $valoracion_medi['cuello'];}else{echo "La valoración no ha sido realizada";}?><br>
                  Descripción de torax: <?php if($valoracion_medi['torax']){echo $valoracion_medi['torax'];}else{echo "La valoración no ha sido realizada";}?><br>
                  Descripción de abdomen: <?php if($valoracion_medi['abdomen']){echo $valoracion_medi['abdomen'];}else{echo "La valoración no ha sido realizada";}?><br>
                  Descripción de genitales: <?php if($valoracion_medi['genitales']){echo $valoracion_medi['genitales'];}else{echo "La valoración no ha sido realizada";}?><br>
                  Descripción de columna: <?php if($valoracion_medi['columna']){echo $valoracion_medi['columna'];}else{echo "La valoración no ha sido realizada";}?><br>
                  Descripción de extremidades: <?php if($valoracion_medi['extremidades']){echo $valoracion_medi['extremidades'];}else{echo "La valoración no ha sido realizada";}?><br>
                  Descripción de tés: <?php if($valoracion_medi['tes']){echo $valoracion_medi['tes'];}else{echo "La valoración no ha sido realizada";}?><br>
                  </p>
                  



                 
              </div>
            </div>
         

        
       
      
      <center>
  <div class="noImprimir">
      <button  type="button " class="btn btn-success"  onclick="window.print()">Imprimir <span class="glyphicon glyphicon-print"></span></button>
  </div>

<!-- Div vacio para cragra la firma en css -->
<div>
   <br>
   <br>
   <br>
   <br>
   <br>
   <span  class="firma"> </span>
</div>


</center>
</div>
</div>