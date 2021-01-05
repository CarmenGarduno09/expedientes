<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
  <ol class="breadcrumb">
  <li><a href="<?php echo base_url();?>index.php/proyecto/panel">Principal</a></li>
    <li class="active">Personal</a></li>
  </ol>

 <center><h1 style="background-color: white" border="2" class="page-header">PERSONAL</h1></center>
<br>

 <a class="btn btn-primary" href="<?php echo base_url();?>index.php/proyecto/alta_empleados" role="button"><span class="glyphicon glyphicon-plus"></span> Agregar nuevo trabajador</a>
<br>
<br>

          <style>

        .round {
 background-color: #fff;
 width: auto;
 height: auto;
 margin: 0 auto 15px auto;
 padding: 5px;
 border: 1px solid #ccc;


 -moz-border-radius: 11px;
 -webkit-border-radius: 11px;
 border-radius: 11px;
 behavior: url(border-radius.htc);
    }
</style>

<html>

<head>
<TITLE>objetos redondeados</TITLE>

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

</head>

<body>

 <div id="formulario" >

    <table style="background-color:#F5F6CE;">

        <tr>
           
<div class="col-lg-6">
    <div class="input-group">
<form  class="form" method="post" action=""> 
 <input type="text" class="form-control" placeholder="Buscar trabajdores..." name="busqueda">
  
     <span class="input-group-btn">
       <button class=class="btn btn-ttc-circle" type="button"> <input type="image"  value="Guardar" src="<?php echo base_url();?>assets/imagenes/bucar2.png" height="27" width="27" /></button>
      </span>

 </form>
 </div>
</div>

        </tr>

<br>  


    </table>

 </div>

</body>

</html>



<br>  
<br>

          <table class="table table-bordered">
            
            <thead>
              <tr bgcolor="#F9E79F" align="center">
                  <center>
                <th>Nombre del trabajador</th>
                <th>Género</th>
                <th>Correo</th>
                <th>Área</th>
                <th>Centros de Asistencia</th>
                <th>Estatus</th>
                <th></th>
                <th>Edita Datos</th>
               
                </center>
              </tr>
            </thead>
            <tbody>
              <?php 
              foreach ($residentes as $res){
              ?>
              <?php 
                              if($res->activop=="Activo"){
                                $texto = "Activo";
                                $etiqueta = "success";
                              }else{
                                $texto = "Inactivo";
                                $etiqueta = "warning";
                              }
                            ?>
              <tr>
                <td class="<?php echo $etiqueta;?>"><?php echo $res->nombres;?> <?php echo $res->apellido_p;?> <?php echo $res->apellido_m;?></td>
                <td class="<?php echo $etiqueta;?>"><?php echo $res->genero;?></td>
                <td class="<?php echo $etiqueta;?>"><?php echo $res->correo;?></td>
                <td class="<?php echo $etiqueta;?>"><?php echo $res->nombre_privilegio;?></td>
                <td class="<?php echo $etiqueta;?>"> <a class="btn btn-info" type="button" onclick="mostrarcentros(<?php echo $res->id_persona;?>)" data-toggle="modal" data-target="#exampleModalCenter">Ver centros:  <span  class="glyphicon glyphicon-eye-open" ></a></td>
            
                <td class="<?php echo $etiqueta;?>"><?php echo $res->activop;?></td>
                <td class="<?php echo $etiqueta;?>"><a href="<?php echo base_url('index.php/proyecto/edita_estatus_personal');?>/<?php echo $res->id_persona;?>" role="button"><span class="glyphicon glyphicon-pencil"></span></a></td>
              
        
        <td class="<?php echo $etiqueta;?>"><a class="btn btn-success"  href="<?php echo base_url('index.php/proyecto/edita_personal');?>/<?php echo $res->id_persona;?>" role="button"><span class="glyphicon glyphicon-pencil"></span> Editar</a></td>
                 </tr>
              <?php 
              }
              ?>
            </tbody>
          </table>


        </div>
      </div>
    </div>

 <!-- Modal  ventana emergente-->
 <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                   <center> <h2 class="modal-title" id="exampleModalLongTitle">Centros asistenciales en los que trabaja: </h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body" id="modal-body">
                    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                  </div>
                </div>
              </div>
            </div> 

<script>
function mostrarcentros(id_persona){

  $.ajax({
				type       : "POST",
                url  : base_url+'Proyecto/traer_casas_persona',				
				data:({id_per_txt:id_persona}),
				cache:false,
				dataType:"json",
				success:mostrarCasas,
				error      : function() {
					alert('Error: Error al traer los datos de las casas por persona, query');
				}
      });
      function mostrarCasas(data){
       
        
         $("#modal-body").empty();
        $("#modal-body").append('<ul class="list-group list-group-flush">');
        $(data).each(function(index,data){
     
            if(data.estado=="success"){
             
                $("#modal-body").append('<ul class="list-group-item list-group-item-success">Nombre del centro: </ul><ul class="list-group"><ul class="list-group-item list-group-item-light">'+data.v2+'</ul></ul>');
              
            }
         
        });
        $("#modal-body").append('</ul>');
        $("#modal-body").trigger('create');
    
    }
}

</script>
   