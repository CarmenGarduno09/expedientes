<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
  <ol class="breadcrumb">
  <li><a href="<?php echo base_url();?>index.php/proyecto/panel">Principal</a></li>
  <li class="active">Valoraciones del Menor</li>
  </ol>
          <center><h1 style="background-color: white" border="2" class="page-header">VALORACIONES PEDAGÓGICAS</h1></center>
<br>


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

<table class="table table-bordered">
    <thead>
        <tr bgcolor="#FEF5E7" align="center">
            <center>
        <th> <center>No. Expediente</th>
        <th> <center>No. Carpeta</th>
        <th> <center>Centro asistencial</th>
        <th> <center>Nombre del niño</th>
        <th> <center>Fecha nacimiento</th>

        <th> <center>Edad</th>
        <th> <center>Género</th>
        <th> <center>Fecha de ingreso</th>
        <th> <center>Motivos de ingreso</th>
        <th> <center>Ver</th>
            </center>
        </tr>
    </thead>
        <tbody>
        <?php 
              foreach ($expedientes_pedagoga as $e){
              ?>
              <tr>
                 <td><?php echo $e->no_expediente;?></td>
                <td><?php echo $e->no_carpeta;?></td>
                <td><?php echo $e->nombre_centro;?></td>
                <td><?php echo $e->nombres_nino;?> <?php echo $e->apellido_pnino;?> <?php echo $e->apellido_mnino;?></td>
                <td><?php echo $e->fecha_nnino;?></td>
                <td>
                <?php 
                $fecha_naci = $this->Modelo_proyecto->ver_edad($e->id_ingreso);
                $fecha_nacinino = $fecha_naci;
                $fecha_actual = date("Y/m/d/");
                $edad = $fecha_actual - $fecha_nacinino;
                if($edad > 100) echo $e->edadcal; 
                else echo $edad;
                ?>
                </td>
                <td><?php echo $e->genero_nino;?></td>
                <td><?php echo $e->fecha_ingreso;?></td>
                <td><?php echo $e->motivos_ingreso;?></td>
                <td><center><a class="btn btn-primary"  href="<?php echo base_url('index.php/proyecto/mostrar_compa');?>/<?php echo $e->id_expediente;?>" role="button"><span  class="glyphicon glyphicon-eye-open"></span></a></center></td>
                 </tr>
              <?php 
              }
              ?>
        </tbody>
</table>