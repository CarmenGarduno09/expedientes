<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<center><h3 style="background-color: white" border="2" class="page-header">VALORACIÓN PSICOLÓGICA DEL NNA</h3></center>
<div class="col-md-4">
            <div class="well well-sm">
              <div class="panel-body" >
              <td><center><img src="<?=base_url();?>/uploadt/<?=$expediente['foto_nino'];?>" width='165' height='180'></center></td>
              <!--<td><img src="<?=base_url();?>/uploadt/<?=$dif->foto_nino;?>" width='60' height='60'></td>-->
              </div>
            </div>
</div>
<div class="col-md-8">
    <div class="well well-sm">
        <h1 align="center" ><p>Nombre del NNA: <?php echo $expediente['nombres_nino'] ?> <?php echo $expediente['apellido_pnino'] ?> <?php echo $expediente['apellido_mnino'] ?></p></h1>
        <h2 align="center" ><p>No. Expediente:  <?php echo $expediente['no_expediente'] ?> </p></h2>
        <h3 align="center"><p>No. Carpeta:  <?php echo $expediente['no_carpeta']?></p></h3>
    </div>
</div>

<div class="col-md-12">
<div class="well well-sm">
<label>Valoración psicológica del NNA</label>
    <p>
    Fecha de Valoración: <?php $f_pmenor=$valoracion_pmenor['fecha_im'];
     //var_dump($f_pmenor);
     $dia = substr($f_pmenor,8,2);
     $mes = substr($f_pmenor,5,2); 
     $anio = substr($f_pmenor,0,4);
     $f_pm = $dia."/".$mes."/".$anio;
     echo $f_pm;
     //var_dump($f_pm); 
    ?><br>    
    Familiograma: <?php echo $valoracion_pmenor['familiograma']?><br>
    Antecedentes: <?php echo $valoracion_pmenor['antec_m']?><br>
    Instrumentos: <?php echo $valoracion_pmenor['instrumentos']?><br>
    Resultados: <?php echo $valoracion_pmenor['resul']?><br>
    Impresión del menor: <?php echo $valoracion_pmenor['impresion']?><br>
    Recomendaciones: <?php echo $valoracion_pmenor['recomen']?>
    </p>
</div>


<center>
  <div class="noImprimir">
      <button  type="button" class="btn btn-success"  onclick="window.print()"><span  class="glyphicon glyphicon-print"></span> Imprimir</button>
  </div>

<!-- Div vacio para cragra la firma en css -->
<div>
   <br>
   <span  class="firma"> </span>
</div>
</center>
</div>