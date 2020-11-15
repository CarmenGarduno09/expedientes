<!DOCTYPE html>
<html lang="en">
  <head>
  
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>DIF</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/startmin.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/all.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/docs.min.css" rel="stylesheet">
  
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href=".<?php echo base_url();?>assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url();?>assets/css/dashboard.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/dataTables/dataTables.responsive.css" rel="stylesheet">
    <link href="css/startmin.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>assets/css/metisMenu.min.css" rel="stylesheet">


    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="<?php echo base_url();?>assets/js/visitadomiciliaria.js"></script>
    <script src="<?php echo base_url();?>assets/js/informefamiliar.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/preguntas.js"></script>
    <script src="<?php echo base_url();?>assets/js/ie-emulation-modes-warning.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>static/js/librerias/jquery.js"></script>
    <script src="<?php echo base_url()?>static/js/librerias/jquery-ui.js"></script>
  <script src="<?php echo base_url()?>static/js/librerias/popper.min.js"></script>

  <script type="text/javascript" src="<?php echo base_url();?>static/js/modulos/ingresos.js"></script>

    <!--<script type="text/javascript" src="<?php echo base_url();?>static/js/modulos/egresos.js"></script>-->
    <!-- TABLAS UI-->
    <link rel="stylesheet" href="<?php echo base_url()?>static/plugins/tables/jquery.dataTables.css">
    <script src="<?php echo base_url()?>static/plugins/tables/jquery.dataTables.js"></script>
    <script src="<?php echo base_url()?>static/plugins/tables/jquery.dataTables.min.js"></script>

    <!-- Funcion de plan de restitución y recomendaciones-->
    
   <!-- <script  src="<?php echo base_url();?>assets/js/funciones_valoracion_abogado.js"></script>--> 
    <script  src="<?php echo base_url();?>assets/js/scripts_val_jur.js"></script> 
    <!-- <script  src="<?php echo base_url();?>assets/js/funciones_valoracion_juridica_js.js"></script> -->
     <!-- Funcion de plan de restitución y recomendaciones que se comparan en valoracion juridiaca-->
     <script type="text/javascript" src="<?php echo base_url();?>assets/js/comparar_val_jur.js"></script>
   <!-- Funcion de para agregar nuevo plan acuerdo de integrarias-->
  

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <!-- Estilo para imprimir-->

    <style type="text/css" media="print">
          <?php $encargado = $user['nombres'];?>   
          <?php $apellido_p = $user['apellido_p'];?>
          <?php $apellido_m = $user['apellido_m'];?>
          <?php $privilegio =$sesion['nombre_privilegio']; ?>

         #salto{
          page-break-after: always;
         }
        
          @page  
          {
              size: auto;   /* auto is the initial value */
              orphans:5;
              widows:4;
          }
           
          .noImprimir{ display:none }

          .firma::after{
            font-weight: negrita;
            color: navy;
            content: "______________________________ \A <?php echo $encargado. " ". $apellido_p. " ". $apellido_m;?> \A  <?php echo $privilegio ?>" ;
            white-space: pre; /* hace que /A de salto de línea */
          
          }

          .firmaProcurador::after{
            font-size: 10px;
            font-weight: negrita;
            color: navy;
            content: "EL SUSCRITO PROCURADOR DE PROTECCIÓN ESTATAL DE NIÑAS, NIÑOS Y ADOLESCENTES DEL SISTEMA PARA EL DESARROLLO INTEGRAL DE LA FAMILIA, LIC. ÓSCAR HERNÁNDEZ HERNÁNDEZ,\A HACE CONSTAR QUE LAS PRESENTES COPIAS CONCUERDAN FIEL Y LEGALMENTE CON SUS ORIGINALES O CON LAS COPIAS SIMPLES QUE OBRAN DENTRO DEL EXPEDIENTE, MISMAS QUE TUVE A LA VISTA, \A QUE LAS COTEJO Y COMPULSO, DEDUCIDAS DEL EXPEDIENTE DEL ******** DE LA COORDINACION DE ASISTENCIA JURIDICA A NIÑAS, NIÑOS Y ADOLESCENTES EN CENTROS ASISTENCIALES, LAS CUALES VAN \A EN (40) CUARENTA FOJAS UTILES, Y QUE SIRVE PARA LOS FINES Y EFECTOS LEGALES A QUE HAYA LUGAR.-ES DADA LA PRESENTE A LOS <?php echo date("j");?> DÍAS DEL MES <?php echo date("m");?> DEL AÑO <?php echo date("Y");?> .-CONSTE.-\A_____________________________________________________________________________________________________________________________________________________________________ \A ___________________________________________________________________________________________________________________________________________\A \A DE CONFORMIDAD CON EL ARTÍCULO 25 FRACCIÓN IV DE LA LEY DEL SISTEMAPARA EL DESARROLLO INTEGRAL DE LA FAMILIA DEL ESTADO DE QUERÉTARO.\A\A\A____________________________________________ \A LIC. ÓSCAR HERNÁNDEZ HERNÁNDEZ \A PROCURADOR DE PROTECCIÓN ESTATAL DE \A NIÑAS, NIÑOS Y ADOLESCENTES";
            white-space: pre; /* hace que /A de salto de línea */
          }

      </style>

 
    
    
  </head>

  <body >

    <nav class="navbar navbar-inverse navbar-fixed-top" class="noImprimir">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <img width="50" height="30" src="<?php echo base_url();?>assets/img/dif.png"></img>
          </button>
          <a class="navbar-brand" href="<?php echo base_url('index.php/proyecto');?>/index">CONTROL DE EXPEDIENTES</a>
         

        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><?php echo $sesion['nombre']." - ".$sesion['nombre_privilegio'];?></a></li>
            <li><a href="<?php echo base_url();?>index.php/proyecto/config_usuario">Configuración</a></li>
            <li><a href="<?php echo base_url();?>index.php/proyecto/salir">Salir</a></li>
          </ul>
        </div>
      </div>
    </nav>