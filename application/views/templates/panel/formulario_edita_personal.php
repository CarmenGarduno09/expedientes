	<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
		<ol class="breadcrumb">
		  <li><a href="<?php echo base_url();?>index.php/proyecto/panel">Principal</a></li>
		  <li><a href="<?php echo base_url();?>index.php/proyecto/vista_empleados">Personal</a></li>
		  <li class="active">Edición de personal</li>
		</ol>

        <center><h1 class="page-header">EDICIÓN DE PERSONAL</h1></center>
         <?php
        //echo validation_errors();
        $atributos = array('class'=>'form-horizontal');
        echo form_open('proyecto/edita_personal/'.$persona['id_persona'],$atributos);
        //var_dump($privilegio);
       ?>
       		<label for="Nombres">Nombres <span class="asterisco">*</span> </label>
			<input type="text" class="form-control" name="nombrep" value="<?php if(set_value('nombrep')) echo set_value('nombrep'); else {if($persona) echo $persona['nombres'];}?>" id="Nombres" placeholder="Nombres">
			<?php echo form_error('nombrep');?>
 			</br>
           <label for="Nombres">Apellido paterno <span class="asterisco">*</span> </label>
			<input type="text" class="form-control" name="apellido_pp" value="<?php if(set_value('apellido_pp')) echo set_value('apellido_pp'); else {if($persona) echo $persona['apellido_p'];}?>" placeholder="Apellido paterno">
			<?php echo form_error('apellido_pp');?>
            <br>
 			<label for="Nombres">Apellido materno <span class="asterisco">*</span> </label>
			<input type="text" class="form-control" name="apellido_mp" value="<?php if(set_value('apellido_mp')) echo set_value('apellido_mp'); else {if($persona) echo $persona['apellido_m'];}?>" id="Nombres" placeholder="Apellido materno">
			<?php echo form_error('apellido_mp');?>
 			</br>
 			<label for="Nombres">Género <span class="asterisco">*</span> </label>
			<div class="radio">
			  		<label><input type="radio" name="generop" value="Masculino" <?php if($persona['genero']=='Masculino') echo "checked";?>>Masculino</label>
				</div>
				<div class="radio">
			  		<label><input type="radio" name="generop" value="Femenino" <?php if($persona['genero']=='Femenino') echo "checked";?>>Femenino</label>
				</div>
			<?php echo form_error('generop');?>
			<br>
 			<label for="Nombres">Correo eléctronico <span class="asterisco">*</span> </label>
			<input type="text" class="form-control" name="correop" value="<?php if(set_value('correop')) echo set_value('correop'); else {if($persona) echo $persona['correo'];}?>" id="Nombres" placeholder="Correo eléctronico">
			<?php echo form_error('correop');?>
 			<br>
           <label for="Nombres">Area <span class="asterisco">*</span> </label></br> 
			<select class="form-control" name="id_privilegio">
			<?php foreach ($areas as $a){ ?>
				<option value="<?php echo $a->id_privilegio;?>"
						<?php 
				if($persona['id_privilegio'] == $a->id_privilegio)
				echo "selected";?>
			><?=$a->nombre_privilegio;?>
			<?php } ?>
				</option>
			</select>
 			<br>
            <label for="Nombres">Agregar Centro asistencial <span class="asterisco">*</span> </label> </br> 
           
		   <div class="col-md-10">
			<select class="form-control" name="id_centro" id="id_centro">
				<?php foreach ($centrot as $a){ ?>
					<option value="<?php echo $a->id_centro;?>"
							<?php 
					if($persona['id_centro'] == $a->id_centro)
					echo "selected";?>
				><?=$a->nombre_centro;?>
				<?php } ?>
					</option>
				<br>
				</select>
		   </div>
		   <div class="col-md-2">
				<a  href='javascript:void(0)'  onclick="Agrega_cen('<?php echo $persona['id_persona']; ?>')" class="btn btn-success"><span class="glyphicon glyphicon-plus" ></span> Agregar</a><br>
				<br>
		   </div>
 				
 <label for="Nombres">Centros asistenciales a los que pertenece. </label></br> 
 <hr>
 <table class="table table-striped" id="table_centros">
  <thead>
 <tr>
    <th scope="col"> Centro de asistencia </th> 
    <th scope="col">Eliminar</th>    
 </tr>
  </thead>
<tbody>
   
	<?php foreach ($casas as $cas) {
    ?>
	 <tr>
    <td> <?php echo $cas->nombre_centro;?> </td> 
	<td id="nombre_centro"><a class="btn btn-danger"  href='javascript:void(0)'  onclick="elimina_cen('<?php echo $cas->id_persona_centro; ?>','<?php echo $persona['id_persona']; ?>')" >Eliminar<span class="glyphicon glyphicon-trash"></span></a></td>
	</tr>
	<?php 
	}   
	?> 
   
 
  </tbody>
</table>

 			<input type="hidden" name="id_persona" value="<?php echo $persona['id_persona']; ?>">
 			<?php echo form_error('id_persona');?>
 			<button type="submit" class="btn btn-primary" name="formulario">Guardar</button>
   	   </form>
 	</div>
  </div>
</div>

<script>
$(document).ready(function(e){
	
});
//funcion que trae las recomendaciones segun el id del niño
function Agrega_cen(id_persona) {
	var id_casa=$.trim($("#id_centro").val());
	
	
	$.ajax({
        type       : "POST",//forma de envio de datos
        url  : base_url+'Proyecto/inserta_casa_per',
		data:({id_per_txt:id_persona,id_cas_txt:id_casa}),//aquí se insertan los datos al controlador
		cache:false,//este es para que no jale datos de la caché
		dataType:"text", //el tipo de dato que devolverá puede ser tex o json
		success:OnSuccesAgregarCas,//funcion a donde se resiviran los datos
		error      : function() {//funció de error
			alert('Error: Error al insertar casas persona');
		}
	});
	function OnSuccesAgregarCas(data){
		var arr=data.split('|');//Separa la estring que regresa el ajax
		//alert(arr[0]);
        if (arr[0]==="OK") {
			//alert('casa insertada para user: ');//alerta de inserción
			//alert(id_persona);
			//se vuelve a hacer el ajax que trae los planes ya guardados
			$.ajax({
				type       : "POST",
                url  : base_url+'Proyecto/traer_casas_persona',				
				data:({id_per_txt:id_persona}),
				cache:false,
				dataType:"json",
				success:mostrarDatos,
				error      : function() {
					alert('Error: Error al traer los datos de las casas por persona, query');
				}
			});

			function mostrarDatos(data){
				alert("Centro agregado.");
				$("#table_centros").html('');
				$("#table_centros").empty();
				$("#table_centros").append('<thead><tr><th scope="col"> Centro de asistencia </th>  <th scope="col">Eliminar</th>  ');
				$(data).each(function(index,data){
					if (data.estado==="success"){ 
						$("#table_centros").append(' <tbody> <td>'+data.v2+'</td> <td id="nombre_centro"><a class="btn btn-danger" onclick="elimina_cen('+data.v3+','+data.v4+')">Eliminar<span class="glyphicon glyphicon-trash"></span></a></td></tr> </tbody>');
					}                
				});
				$("#table_centros").append(' </tr></thead>');
				$("#table_centros").trigger('create');
			}
		}else{
			alert('Error de inserción'); 
		}
	}
}

function elimina_cen(id_per_cen,id_persona){
 
	//alert("Estoy dentro de eimina_cen"+id_persona);
	$.ajax({
        type       : "POST",
        url  : base_url+'Proyecto/descarta_casa_usuario',
		data:({id_per_cen_txt:id_per_cen}),//datso que se envian
		cache:false,
		dataType:"text",//tipo de dato que devolverá en este caso es un text
		success:Descartarcp,
		error      : function() {
			alert('Error: Error al descartar');
		}
	});

	function Descartarcp(data){
	
		var arr=data.split('|');//Separa la estring que regresa el ajax
	
        if (arr[0]==="OK") {
			$.ajax({
				type       : "POST",
                url  : base_url+'Proyecto/traer_casas_persona',				
				data:({id_per_txt:id_persona}),
				cache:false,
				dataType:"json",
				success:mostrarDatosCP,
				error      : function() {
					alert('Error: Error al traer los datos de las casas por persona, query');
				}
			});

			function mostrarDatosCP(data){
				alert("Centro descartado");
				$("#table_centros").html('');
				$("#table_centros").empty();
				$("#table_centros").append('<thead><tr><th scope="col"> Centro de asistencia </th>  <th scope="col">Eliminar</th>  ');
				$(data).each(function(index,data){
					if (data.estado==="success"){ 
						$("#table_centros").append(' <tbody> <td>'+data.v2+'</td> <td id="nombre_centro"><a class="btn btn-danger" onclick="elimina_cen('+data.v3+','+data.v4+')">Eliminar<span class="glyphicon glyphicon-trash"></span></a></td></tr> </tbody>');
					}                
				});
				$("#table_centros").append(' </tr></thead>');
				$("#table_centros").trigger('create');
			}
		}else{
			alert('Error al traer los datos de las casas asigndas'); 
		}
	}
}
</script>
