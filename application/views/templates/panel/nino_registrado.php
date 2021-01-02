
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
  <ol class="breadcrumb">
  <li><a href="<?php echo base_url();?>index.php/proyecto/panel">Principal</a></li>
    <li class="active">Alta de NNA</li>
  </ol>
  <br><br>

<div class="alert alert-info" role="alert">
<center><h2>EL número de carpeta ya esta registrado</h2></center>
</div>


     

</div>

<script>
        $(document).ready(function(e) {
        
            alert('El número de expediente fue dado de alta anteriormente');
            window.location.assign('vista_ninos_ts');//Redirecciona
     
        });
      </script>
 