<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <br><br>
        <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>index.php/proyecto/panel">Principal</a></li>
        <li><a href="<?php echo base_url();?>index.php/proyecto/expediente_abogado">Expedientes niños</a></li>
        <li class="active">Valoración</li>
        </ol>

<center><h1>Edición de valoración jurídica. </h1>  </center>
<div class="panel panel-primary">
  <div class="panel-heading">Información del niño</div>
    <div class="panel-body">
       <form autocomplete="off" name="formulario" class="form" method="POST" action="<?php echo base_url()?>index.php/proyecto/editar_valoracion_abogado/<?php echo $expediente['id_expediente'];?>">
      
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
              <label>Fecha de nacimiento: </label>  <?php echo $expediente['fecha_nnino']?><br/>
                <label>Edad:  <?php $fecha_time = date("Y/m/d/");
                $edad= $fecha_time = date("Y/m/d/") - $expediente['fecha_nnino']; echo " ".$edad . " años";
                ?></label> <br/>
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
                <label>Fecha de ingreso: </label>  <?php echo $expediente['fecha_ingreso']?> <br/>
                  <label>Hora de ingreso: </label>  <?php echo $expediente['hora_ingreso']?> <br/>
                  <label>Centro asistencial: </label>  <?php echo $expediente['nombre_centro']?> <br/>
                  <label>Motivos de ingreso: </label> <?php echo $expediente['motivos_ingreso']?><br/>
                  <label>Observaciones del ingreso </label> <?php echo $expediente['observaciones_ingreso']?>
              </div>
            </div>
          </div>
    
      </div>
  </div>


        
  <center> <h2 class="page-header">VALORACIÓN DE INGRESO DEL MENOR</h2> </center>
    <!-- <?php 
        $atributos= array('class'=>'form-horizontal');
       echo form_open('proyecto/valoracion_abogado/'.$expediente['id_expediente'],$atributos);?>-->
       <!--<form method="POST" action="<?php echo base_url()?>index.php/proyecto/valoracion_abogado" name="formulario">-->
       <div class="alert alert-warning" role="alert"><center>Todos los campos con asterisco son obligatorios</center></div>
       <!-- Cuestionario 0 -->
        <div class="panel panel-primary">
            <!-- Default panel contents -->
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-11">
                        Derecho a la identidad<span style="color: red" class="asterisco"> *</span>
                        <?php echo form_error('registro');?><?php echo form_error('acta');?></div>
                    <div class="col-md-1" id="boton" style="padding-top: 0px;">
                        <center>
                            <a href="javascript:void(0)" onclick="preguntas()"><button type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-chevron-down"></span></button></a>
                            
                        </center>
                        
                    </div>
                </div>
            </div>
            <div class="panel-body" style="display:none;" id="preguntas">
                
                      <label for="verificar">Está registrado en el registro civil:</label><br>
                  		<b>SI </b><input type="radio" name="registro" id="verificar" onclick="enable_fields();" value="SI" <?php if($valoracion_juridica['registro_civil']=='SI') echo "checked";?>><br>
                  		<b>NO </b><input type="radio" name="registro" id="no_registro" onclick="disable_fields();" value="NO"  <?php if($valoracion_juridica['registro_civil']=='NO') echo "checked";?>><br>
                          <b>Otro: </b> <input type="radio" name="registro" id="otro" onclick="enable_fields_otro();" value="OTRO"  <?php  if(($valoracion_juridica['registro_civil']!='SI') and ($valoracion_juridica['registro_civil']!='NO') ){ echo "checked";}?>> 
                          <input type="text" class="form-control" disabled="disabled" name="registro_text" id="otro_text"    value="<?php if(($valoracion_juridica['registro_civil']!='SI') and ($valoracion_juridica['registro_civil']!='NO') ){ echo $valoracion_juridica['registro_civil'];}?>" palceholder="Otra opción"><br>
                  		<label for="numero_acta">No. de acta</label>
                  		<input type="text" id="numero_acta" name="numero_acta" value="<?php  echo $valoracion_juridica['numero_acta'] ?>" class="form-control" disabled="disabled">
                  		<label for="lugar_r">Lugar de registro</label>
                  		<input type="text" id="lugar_r" name="lugar_r" value="<?php  echo $valoracion_juridica['lugar_r'] ?>" class="form-control" disabled="disabled">
                  		<label for="curp">CURP</label>
                  		<input type="text" id="curp" name="curp" class="form-control" value="<?php  echo $valoracion_juridica['curp'] ?>" disabled="disabled">
                
            </div>

        </div>
     
        
       
         <!-- Fin de Cuestionario 0 -->

         <!-- Cuestionario 1 -->
        <div class="panel panel-primary">
            <!-- Default panel contents -->
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-11">
                        Derecho a vivir en familia<span style="color: red" class="asterisco"> *</span><?php echo form_error('vive');?><?php echo form_error('convivencia');?><?php echo form_error('opinion');?><?php echo form_error('separado');?>
                        </div>
                       <div class="col-md-1" id="boton1" style="padding-top: 0px;">
                        <center>
                            <a href="javascript:void(0)" onclick="preguntas1()"><button type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-chevron-down"></span></button></a>
                            
                        </center>
                        
                    </div>
                </div>
            </div>
            <div class="panel-body" style="display:none;" id="preguntas1">
                
            <label>La NNA vive con su familia, salvo que la autoridad competente haya determinado lo contrario<span style="color: red" class="asterisco"> *</span></label><br>
                    <input type="radio" name="vive" id="si_registro1" onclick="disable_fields1()"  value="SI"<?php if($valoracion_juridica['vive_familia']=='SI') echo "checked";?>> SI <br>
                    <input type="radio" name="vive" id="no_registro1" onclick="disable_fields1()" value="NO" <?php if($valoracion_juridica['vive_familia']=='NO') echo "checked";?>> NO <br>
                     <input type="radio" name="vive" id="otro1"  onclick="enable_fields_otro1();" value="OTRO"  <?php if(($valoracion_juridica['vive_familia']!='SI') and ($valoracion_juridica['vive_familia']!='NO') ){ echo "checked";}?>> <b>Otro </b>
                          <input type="text" class="form-control" name="vive_text" id="otro_text1"   value="<?php if(set_value('vive_text')) echo set_value('vive_text'); else{if($valoracion_juridica) echo $valoracion_juridica['vive_familia'];}?>" <?php if(($valoracion_juridica['vive_familia']!='SI') and ($valoracion_juridica['vive_familia']!='NO') ){ echo "disbled='false'";}else{echo "disbled='true'";}?>  placeholder="Otra opción"><br>
                  		<br><?php echo form_error('vive');?>
                    <label>En caso de estar separado de su familia, la NNA ¿tiene permitida la convivencia o mantenimiento de relaciones personales con sus familiares? Salvo que la autoridad competente haya determinado lo contrario<span style="color: red" class="asterisco"> *</span></label><br>
                    <input type="radio" name="convivencia" id="si_registro2"  onclick="disable_fields2()" value="SI" <?php if($valoracion_juridica['convivencia_fam']=='SI') echo "checked";?>> SI <br>
                    <input type="radio" name="convivencia" id="no_registro2"  onclick="disable_fields2()" value="NO"<?php if($valoracion_juridica['convivencia_fam']=='NO') echo "checked";?>> NO <br>
                    <input type="radio" name="convivencia" id="otro2"  onclick="enable_fields_otro2();" value="OTRO"  <?php  if(($valoracion_juridica['convivencia_fam']!='SI') and ($valoracion_juridica['convivencia_fam']!='NO') ){ echo "checked";}?>> <b>Otro </b>
                          <input type="text" class="form-control" disabled="disabled" name="convivencia_text" id="otro_text2"   value="<?php if(set_value('convivencia_text')) echo set_value('convivencia_text'); else{if($valoracion_juridica) echo $valoracion_juridica['convivencia_fam'];}?>" <?php if(($valoracion_juridica['convivencia_fam']!='SI') and ($valoracion_juridica['convivencia_fam']!='NO') ){ echo "disbled='false'";}else{echo "disbled='true'";}?>  placeholder="Otra opción"><br>
                  		 <br><?php echo form_error('convivencia');?>
                    <label>Es considerada la opinión de la NNA en la familia<span style="color: red" class="asterisco"> *</span></label><br>
                    <input type="radio" name="opinion" value="SI" id="si_registro3" onclick="disable_fields3()" <?php if($valoracion_juridica['opinion']=='SI') echo "checked";?>> SI <br>
                    <input type="radio" name="opinion" value="NO" id="no_registro3" onclick="disable_fields3()" <?php if($valoracion_juridica['opinion']=='NO') echo "checked";?>> NO <br>
                    <input type="radio" name="opinion" id="otro3"  onclick="enable_fields_otro3();" value="OTRO"  <?php  if(($valoracion_juridica['opinion']!='SI') and ($valoracion_juridica['opinion']!='NO') ){ echo "checked";}?>> <b>Otro </b>
                          <input type="text" class="form-control" disabled="disabled" name="opinion_text" id="otro_text3"   value="<?php if(set_value('opinion_text')) echo set_value('opinion_text'); else{if($valoracion_juridica) echo $valoracion_juridica['opinion'];}?>" <?php if(($valoracion_juridica['opinion']!='SI') and ($valoracion_juridica['opinion']!='NO') ){ echo "disbled='false'";}else{echo "disbled='true'";}?>  placeholder="Otra opción"><br>
                  		  <br><?php echo form_error('opinion');?>

                    <label>¿La NNA ha sido separado de algún miembro de su familia?<span style="color: red" class="asterisco"> *</span></label><br>
                    <input type="radio" name="separado" value="SI" id="si_registro4" onclick="disable_fields4()" <?php if($valoracion_juridica['separado_miembro']=='SI') echo "checked";?>> SI <br>
                    <input type="radio" name="separado" value="NO" id="no_registro4" onclick="disable_fields4()" <?php if($valoracion_juridica['separado_miembro']=='NO') echo "checked";?>> NO <br>
                    <input type="radio" name="separado" id="otro4"  onclick="enable_fields_otro4()" value="OTRO"  <?php  if(($valoracion_juridica['separado_miembro']!='SI') and ($valoracion_juridica['separado_miembro']!='NO') ){ echo "checked";}?>> <b>Otro </b>
                          <input type="text" class="form-control" disabled="disabled" name="separado_text" id="otro_text4"  value="<?php if(set_value('separado_text')) echo set_value('separado_text'); else{if($valoracion_juridica) echo $valoracion_juridica['separado_miembro'];}?>" <?php if(($valoracion_juridica['separado_miembro']!='SI') and ($valoracion_juridica['separado_miembro']!='NO') ){ echo "disbled='false'";}else{echo "disbled='true'";}?>  placeholder="Otra opción"><br>
                  		  <br><?php echo form_error('separado');?>

                    <label>¿El NNA cuenta con familia extensa o ampliada?<span style="color: red" class="asterisco"> *</span></label><br>
                    <input type="radio" name="fam_extensa" value="SI"  id="si_registro5" onclick="disable_fields5()" <?php if($valoracion_juridica['fam_extensa']=='SI') echo "checked";?>> SI <br>
                    <input type="radio" name="fam_extensa" value="NO" id="no_registro5" onclick="disable_fields5()" <?php if($valoracion_juridica['fam_extensa']=='NO') echo "checked";?>> NO <br>
                    <input type="radio" name="fam_extensa" id="otro5"  onclick="enable_fields_otro5();" value="OTRO"  <?php  if(($valoracion_juridica['fam_extensa']!='SI') and ($valoracion_juridica['fam_extensa']!='NO') ){ echo "checked";}?>> <b>Otro </b>
                          <input type="text" class="form-control" disabled="disabled" name="fam_extensa_text" id="otro_text5"  value="<?php if(set_value('fam_extensa_text')) echo set_value('fam_extensa_text'); else{if($valoracion_juridica) echo $valoracion_juridica['fam_extensa'];}?>" <?php if(($valoracion_juridica['fam_extensa']!='SI') and ($valoracion_juridica['fam_extensa']!='NO') ){ echo "disbled='false'";}else{echo "disbled='true'";}?>  placeholder="Otra opción"><br>
                  		 <br><?php echo form_error('fam_extensa');?>
             

            </div>

        </div>
        
         <!-- Fin de Cuestionario 1 -->

         <!-- Cuestionario 2 -->
        <div class="panel panel-primary">
            <!-- Default panel contents -->
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-11">
                        A la igualdad sustantiva<span style="color: red" class="asterisco"> *</span> 
                        <?php echo form_error('derechos');?></div>
                    <div class="col-md-1" id="boton2" style="padding-top: 0px;">
                        <center>
                            <a href="javascript:void(0)" onclick="preguntas2()"><button type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-chevron-down"></span></button></a>
                            
                        </center>
                        
                    </div>
                </div>
            </div>
            <div class="panel-body" style="display:none;" id="preguntas2">
                
                    <label>Tienen derecho al acceso al mismo trato y oportunidades para el reconocimiento, goce o ejercicio de sus derechos<span style="color: red" class="asterisco"> *</span></label><br>
                   <input type="radio" name="derechos" value="SI"  id="si_registro6" onclick="disable_fields6()" <?php if($valoracion_juridica['derecho']=='SI') echo "checked";?>> SI <br>
                    <input type="radio" name="derechos" value="NO" id="no_registro6" onclick="disable_fields6()" <?php if($valoracion_juridica['derecho']=='NO') echo "checked";?>> NO <br>
                    <input type="radio" name="derechos" id="otro6"  onclick="enable_fields_otro6();" value="OTRO"   <?php  if(($valoracion_juridica['derecho']!='SI') and ($valoracion_juridica['derecho']!='NO') ){ echo "checked";}?>> <b>Otro </b>
                          <input type="text" class="form-control" disabled="disabled" name="derechos_text" id="otro_text6"  value="<?php if(set_value('derechos_text')) echo set_value('derechos_text'); else{if($valoracion_juridica) echo $valoracion_juridica['derecho'];}?>" <?php if(($valoracion_juridica['derecho']!='SI') and ($valoracion_juridica['derecho']!='NO') ){ echo "disbled='false'";}else{echo "disbled='true'";}?>  placeholder="Otra opción"><br>
                  		  <br> <?php echo form_error('derechos');?>
            </div>
        </div>
        
         <!-- Fin de Cuestionario 2 -->

         
         <!-- Cuestionario 3 -->
        <div class="panel panel-primary">
            <!-- Default panel contents -->
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-11">
                        Derecho a no ser discriminado<span style="color: red" class="asterisco"> *</span> 
                        <?php echo form_error('discriminacion');?></div>
                    <div class="col-md-1" id="boton3" style="padding-top: 0px;">
                        <center>
                            <a href="javascript:void(0)" onclick="preguntas3()"><button type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-chevron-down"></span></button></a>
                            
                        </center>
                        
                    </div>
                </div>
            </div>
            <div class="panel-body" style="display:none;" id="preguntas3">
              
                    <label>Ha sufrido discriminación en razón de su origen étnico, nacional o social, idioma o lengua, edad, género, preferencia sexual, estado civil, religión, opinión, condición económica, circunstancias de nacimiento, discapacidad o estado de salud o cualquiera otra condición atribuible a ellos mismos o a su madre, padre, tutor o persona que los tenga bajo guarda y custodia, o a otros miembros de la familia<span style="color: red" class="asterisco"> *</span></label><br>
                    <input type="radio" name="discriminacion" value="SI"  id="si_registro7" onclick="disable_fields7()" <?php if($valoracion_juridica['discriminacion']=='SI') echo "checked";?>> SI <br>
                    <input type="radio" name="discriminacion" value="NO" id="no_registro7" onclick="disable_fields7()" <?php if($valoracion_juridica['discriminacion']=='NO') echo "checked";?>> NO <br>
                    <input type="radio" name="discriminacion" id="otro7"  onclick="enable_fields_otro7();" value="OTRO"  <?php  if(($valoracion_juridica['discriminacion']!='SI') and ($valoracion_juridica['discriminacion']!='NO') ){ echo "checked";}?>> <b>Otro </b>
                          <input type="text" class="form-control" disabled="disabled" name="discriminacion_text" id="otro_text7"  value="<?php if(set_value('discriminacion_text')) echo set_value('discriminacion_text'); else{if($valoracion_juridica) echo $valoracion_juridica['discriminacion'];}?>" <?php if(($valoracion_juridica['discriminacion']!='SI') and ($valoracion_juridica['discriminacion']!='NO') ){ echo "disbled='false'";}else{echo "disbled='true'";}?>  placeholder="Otra opción"><br>
                  		   <br> <?php echo form_error('discriminacion');?>
               
            </div>
        </div>
        
         <!-- Fin de Cuestionario 3 -->

          <!-- Cuestionario 4 -->
        <div class="panel panel-primary">
            <!-- Default panel contents -->
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-11">
                        Derecho a vivir en condiciones de bienestar y a un sano desarrollo integral<span style="color: red" class="asterisco"> *</span>
                        <?php echo form_error('vivienda');?> <?php echo form_error('proteccion');?></div>
                    <div class="col-md-1" id="boton4" style="padding-top: 0px;">
                        <center>
                            <a href="javascript:void(0)" onclick="preguntas4()"><button type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-chevron-down"></span></button></a>
                            
                        </center>
                        
                    </div>
                </div>
            </div>
            <div class="panel-body" style="display:none;" id="preguntas4">
               
                    <label>La NNA vive en una vivienda adecuada para su desarrollo<span style="color: red" class="asterisco"> *</span></label><br>
                    <input type="radio" name="vivienda" value="SI"  id="si_registro8" onclick="disable_fields8()" <?php if($valoracion_juridica['vivienda']=='SI') echo "checked";?>> SI <br>
                    <input type="radio" name="vivienda" value="NO" id="no_registro8" onclick="disable_fields8()" <?php if($valoracion_juridica['vivienda']=='NO') echo "checked";?>> NO <br>
                    <input type="radio" name="vivienda" id="otro8"  onclick="enable_fields_otro8();" value="OTRO"  <?php  if(($valoracion_juridica['vivienda']!='SI') and ($valoracion_juridica['vivienda']!='NO') ){ echo "checked";}?>> <b>Otro </b>
                          <input type="text" class="form-control" disabled="disabled" name="vivienda_text" id="otro_text8"  value="<?php if(set_value('vivienda_text')) echo set_value('vivienda_text'); else{if($valoracion_juridica) echo $valoracion_juridica['vivienda'];}?>" <?php if(($valoracion_juridica['vivienda']!='SI') and ($valoracion_juridica['vivienda']!='NO') ){ echo "disbled='false'";}else{echo "disbled='true'";}?>  placeholder="Otra opción"><br>
                  		  <br> <?php echo form_error('vivienda');?>
                    <label>La NNA cuenta con la protección y supervisión adecuadas por parte de un adulto responsable de su cuidado<span style="color: red" class="asterisco"> *</span></label><br>
                    <input type="radio" name="proteccion" value="SI"  id="si_registro9" onclick="disable_fields9()" <?php if($valoracion_juridica['proteccion']=='SI') echo "checked";?>> SI <br>
                    <input type="radio" name="proteccion" value="NO" id="no_registro9" onclick="disable_fields9()" <?php if($valoracion_juridica['proteccion']=='NO') echo "checked";?>> NO <br>
                    <input type="radio" name="proteccion" id="otro9"  onclick="enable_fields_otro9();" value="OTRO"  <?php  if(($valoracion_juridica['proteccion']!='SI') and ($valoracion_juridica['proteccion']!='NO') ){ echo "checked";}?>> <b>Otro </b>
                          <input type="text" class="form-control" disabled="disabled" name="proteccion_text" id="otro_text9"  value="<?php if(set_value('proteccion_text')) echo set_value('proteccion_text'); else{if($valoracion_juridica) echo $valoracion_juridica['proteccion'];}?>" <?php if(($valoracion_juridica['proteccion']!='SI') and ($valoracion_juridica['proteccion']!='NO') ){ echo "disbled='false'";}else{echo "disbled='true'";}?>  placeholder="Otra opción"><br>
                  		  <br><?php echo form_error('proteccion');?>
           
            </div>
        </div>
         <!-- Fin de Cuestionario 4 -->

         <!-- Cuestionario 5 -->
        <div class="panel panel-primary">
            <!-- Default panel contents -->
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-11">
                        Derecho a una vida libre de violencia y a la integridad personal<span style="color: red" class="asterisco"> *</span>
                        <?php echo form_error('violencia');?></div>
                    <div class="col-md-1" id="boton5" style="padding-top:0px;">
                        <center>
                            <a href="javascript:void(0)" onclick="preguntas5()"><button type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-chevron-down"></span></button></a>
                            
                        </center>
                        
                    </div>
                </div>
            </div>
            <div class="panel-body" style="display:none;" id="preguntas5">
            
                    <label>La NNA no ha presenciado o no ha sido víctima de violencia física, verbal o psicológica, abandono, descuido, abuso físico o sexual<span style="color: red" class="asterisco"> *</span></label><br>
                    <input type="radio" name="violencia" value="SI"  id="si_registro10" onclick="disable_fields10()" <?php if($valoracion_juridica['violencia']=='SI') echo "checked";?>> SI <br>
                    <input type="radio" name="violencia" value="NO" id="no_registro10" onclick="disable_fields10()" <?php if($valoracion_juridica['violencia']=='NO') echo "checked";?>> NO <br>
                    <input type="radio" name="violencia" id="otro10"  onclick="enable_fields_otro10();" value="OTRO"  <?php  if(($valoracion_juridica['violencia']!='SI') and ($valoracion_juridica['violencia']!='NO') ){ echo "checked";}?>> <b>Otro </b>
                          <input type="text" class="form-control" disabled="disabled" name="violencia_text" id="otro_text10"  value="<?php if(set_value('violencia_text')) echo set_value('violencia_text'); else{if($valoracion_juridica) echo $valoracion_juridica['violencia'];}?>" <?php if(($valoracion_juridica['violencia']!='SI') and ($valoracion_juridica['violencia']!='NO') ){ echo "disbled='false'";}else{echo "disbled='true'";}?>  placeholder="Otra opción"><br>
                  		  <br> <?php echo form_error('violencia');?>
    
              
            </div>
        </div>
         <!-- Fin de Cuestionario 5 -->

         <!-- Cuestionario 6 -->
        <div class="panel panel-primary">
            <!-- Default panel contents -->
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-11">
                        Derecho a la protección de la salud y a la seguridad social<span style="color: red" class="asterisco"> *</span>
                        <?php echo form_error('servicio_med');?><?php echo form_error('nutricion');?><?php echo form_error('revision');?><?php echo form_error('cartilla');?><?php echo form_error('tratamiento');?></div>
                    <div class="col-md-1" id="boton6" style="padding-top:0px;">
                        <center>
                            <a href="javascript:void(0)" onclick="preguntas6()"><button type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-chevron-down"></span></button></a> 
                        </center>   
                    </div>
                </div>
            </div>
            <div class="panel-body" style="display:none;" id="preguntas6">
               
            <label>La NNA vive con su familia, salvo que la autoridad competente haya determinado lo contrario<span style="color: red" class="asterisco"> *</span></label><br>
                    <input type="radio" name="vive" id="si_registro1" onclick="disable_fields1()"  value="SI"<?php if($valoracion_juridica['vive_familia']=='SI') echo "checked";?>> SI <br>
                    <input type="radio" name="vive" id="no_registro1" onclick="disable_fields1()" value="NO" <?php if($valoracion_juridica['vive_familia']=='NO') echo "checked";?>> NO <br>
                     <input type="radio" name="vive" id="otro1"  onclick="enable_fields_otro1();" value="OTRO"  <?php if(($valoracion_juridica['vive_familia']!='SI') and ($valoracion_juridica['vive_familia']!='NO') ){ echo "checked";}?>> <b>Otro </b>
                          <input type="text" class="form-control" name="vive_text" id="otro_text1"   value="<?php if(set_value('vive_text')) echo set_value('vive_text'); else{if($valoracion_juridica) echo $valoracion_juridica['vive_familia'];}?>" <?php if(($valoracion_juridica['vive_familia']!='SI') and ($valoracion_juridica['vive_familia']!='NO') ){ echo "disbled='false'";}else{echo "disbled='true'";}?>  palceholder="Otra opción"><br>
                  		<br><?php echo form_error('vive');?>
                    <label>La NNA muestra una nutrición adecuada (Notoriamente visibles)<span style="color: red" class="asterisco"> *</span></label><br>
                    <input type="radio" name="nutricion" value="SI"  id="si_registro12" onclick="disable_fields12()" <?php if($valoracion_juridica['nutricion']=='SI') echo "checked";?>> SI <br>
                    <input type="radio" name="nutricion" value="NO" id="no_registro12" onclick="disable_fields12()" <?php if($valoracion_juridica['nutricion']=='NO') echo "checked";?>> NO <br>
                    <input type="radio" name="nutricion" id="otro12"  onclick="enable_fields_otro12();" value="OTRO"  <?php  if(($valoracion_juridica['nutricion']!='SI') and ($valoracion_juridica['nutricion']!='NO') ){ echo "checked";}?>> <b>Otro </b>
                          <input type="text" class="form-control" disabled="disabled" name="nutricion_text" id="otro_text12"  value="<?php if(set_value('nutricion_text')) echo set_value('nutricion_text'); else{if($valoracion_juridica) echo $valoracion_juridica['nutricion'];}?>" <?php if(($valoracion_juridica['nutricion']!='SI') and ($valoracion_juridica['nutricion']!='NO') ){ echo "disbled='false'";}else{echo "disbled='true'";}?>  placeholder="Otra opción"><br>
                  		  <br> <?php echo form_error('nutricion');?>
                    <label>La NNA asiste a revisión médica periódica<span style="color: red" class="asterisco"> *</span></label><br>
                    <input type="radio" name="revision" value="SI"  id="si_registro13" onclick="disable_fields13()" <?php if($valoracion_juridica['revision_med']=='SI') echo "checked";?>> SI <br>
                    <input type="radio" name="revision" value="NO" id="no_registro13" onclick="disable_fields13()" <?php if($valoracion_juridica['revision_med']=='NO') echo "checked";?>> NO <br>
                    <input type="radio" name="revision" id="otro13"  onclick="enable_fields_otro13();" value="OTRO"  <?php  if(($valoracion_juridica['revision_med']!='SI') and ($valoracion_juridica['revision_med']!='NO') ){ echo "checked";}?>> <b>Otro </b>
                          <input type="text" class="form-control" disabled="disabled" name="revision_text" id="otro_text13"  value="<?php if(set_value('revision_text')) echo set_value('revision_text'); else{if($valoracion_juridica) echo $valoracion_juridica['revision_med'];}?>" <?php if(($valoracion_juridica['revision_med']!='SI') and ($valoracion_juridica['revision_med']!='NO') ){ echo "disbled='false'";}else{echo "disbled='true'";}?>  placeholder="Otra opción"><br>
                  		  <br><?php echo form_error('revision');?>
                    <label>La NNA cuenta con cartilla de vacunación<span style="color: red" class="asterisco"> *</span></label><br>
                    <input type="radio" name="cartilla" value="SI"  id="si_registro14" onclick="disable_fields14()" <?php if($valoracion_juridica['cartilla']=='SI') echo "checked";?>> SI <br>
                    <input type="radio" name="cartilla" value="NO" id="no_registro14" onclick="disable_fields14()" <?php if($valoracion_juridica['cartilla']=='NO') echo "checked";?>> NO <br>
                    <input type="radio" name="cartilla" id="otro14"  onclick="enable_fields_otro14();" value="OTRO"  <?php  if(($valoracion_juridica['cartilla']!='SI') and ($valoracion_juridica['cartilla']!='NO') ){ echo "checked";}?>> <b>Otro </b>
                          <input type="text" class="form-control" disabled="disabled" name="cartilla_text" id="otro_text14"  value="<?php if(set_value('cartilla_text')) echo set_value('cartilla_text'); else{if($valoracion_juridica) echo $valoracion_juridica['cartilla'];}?>" <?php if(($valoracion_juridica['cartilla']!='SI') and ($valoracion_juridica['cartilla']!='NO') ){ echo "disbled='false'";}else{echo "disbled='true'";}?>  placeholder="Otra opción"><br>
                  		 <br><?php echo form_error('cartilla');?>
                    <label>En caso de que se le haya detectado alguna enfermedad a la NNA ¿Se le brinda el tratamiento adecuado?<span style="color: red" class="asterisco"> *</span></label><br>
                    <input type="radio" name="tratamiento" value="SI"  id="si_registro15" onclick="disable_fields15()" <?php if($valoracion_juridica['tratamiento_enf']=='SI') echo "checked";?>> SI <br>
                    <input type="radio" name="tratamiento" value="NO" id="no_registro15" onclick="disable_fields15()" <?php if($valoracion_juridica['tratamiento_enf']=='NO') echo "checked";?>> NO <br>
                    <input type="radio" name="tratamiento" id="otro15"  onclick="enable_fields_otro15();" value="OTRO"  <?php  if(($valoracion_juridica['tratamiento_enf']!='SI') and ($valoracion_juridica['tratamiento_enf']!='NO') ){ echo "checked";}?>> <b>Otro </b>
                          <input type="text" class="form-control" disabled="disabled" name="tratamiento_text" id="otro_text15"  value="<?php if(set_value('tratamiento_text')) echo set_value('tratamiento_text'); else{if($valoracion_juridica) echo $valoracion_juridica['tratamiento_enf'];}?>" <?php if(($valoracion_juridica['tratamiento_enf']!='SI') and ($valoracion_juridica['tratamiento_enf']!='NO') ){ echo "disbled='false'";}else{echo "disbled='true'";}?>  placeholder="Otra opción"><br>
                  		 <br><?php echo form_error('tratamiento');?>

    
            </div>
        </div>
         <!-- Fin de Cuestionario 6 -->

         <!-- Cuestionario 7 -->
        <div class="panel panel-primary">
            <!-- Default panel contents -->
            <div class="panel-heading">
                <div class="row">  
                    <div class="col-md-11">
                        Derecho a la inclusión de NNA con discapacidad<span style="color: red" class="asterisco"> *</span>
                        <?php echo form_error('atencion_dis');?></div>
                    <div class="col-md-1" id="boton7" style="padding-top:0px;">
                        <center>
                            <a href="javascript:void(0)" onclick="preguntas7()"><button type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-chevron-down"></span></button></a>
                            
                        </center>
                        
                    </div>
                </div>
            </div>
            <div class="panel-body" style="display:none;" id="preguntas7">
            
                    <label>En caso de vivir con alguna discapacidad y requerir atención médica y/o aditamento la NNA ¿La recibe?<span style="color: red" class="asterisco"> *</span></label><br>
                    <input type="radio" name="atencion_dis" value="SI"  id="si_registro16" onclick="disable_fields16()" <?php if($valoracion_juridica['atencion_discr']=='SI') echo "checked";?>> SI <br>
                    <input type="radio" name="atencion_dis" value="NO" id="no_registro16" onclick="disable_fields16()" <?php if($valoracion_juridica['atencion_discr']=='NO') echo "checked";?>> NO <br>
                    <input type="radio" name="atencion_dis" id="otro16"  onclick="enable_fields_otro16();" value="OTRO"  <?php  if(($valoracion_juridica['atencion_discr']!='SI') and ($valoracion_juridica['atencion_discr']!='NO') ){ echo "checked";}?>> <b>Otro </b>
                          <input type="text" class="form-control" disabled="disabled" name="atencion_dis_text" id="otro_text16"  value="<?php if(set_value('atencion_dis_text')) echo set_value('atencion_dis_text'); else{if($valoracion_juridica) echo $valoracion_juridica['atencion_discr'];}?>" <?php if(($valoracion_juridica['atencion_discr']!='SI') and ($valoracion_juridica['atencion_discr']!='NO') ){ echo "disbled='false'";}else{echo "disbled='true'";}?>  placeholder="Otra opción"><br>
                  		 <br> <?php echo form_error('atencion_dis');?>
    
           
            </div>
        </div>
         <!-- Fin de Cuestionario 7 -->

         
         <!-- Cuestionario 8 -->
        <div class="panel panel-primary">
            <!-- Default panel contents -->
            <div class="panel-heading">
                <div class="row">  
                    <div class="col-md-11">
                        Derecho a la educación<span style="color: red" class="asterisco"> *</span>
                        <?php echo form_error('escuela');?>  <?php echo form_error('asiste_reg');?><?php echo form_error('duerme');?> <?php echo form_error('act_espar');?>
                        </div>
                    <div class="col-md-1" id="boton8" style="padding-top:0px;">
                        <center>
                            <a href="javascript:void(0)" onclick="preguntas8()"><button type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-chevron-down"></span></button></a>
                            
                        </center>
                        
                    </div>
                </div>
            </div>
            <div class="panel-body" style="display:none;" id="preguntas8">
           
                    <label>La NNA se encuentra inscrito en la escuela<span style="color: red" class="asterisco"> *</span></label><br>
                    <input type="radio" name="escuela" value="SI"  id="si_registro17" onclick="disable_fields17()" <?php if($valoracion_juridica['inscrito_esc']=='SI') echo "checked";?>> SI <br>
                    <input type="radio" name="escuela" value="NO" id="no_registro17" onclick="disable_fields17()" <?php if($valoracion_juridica['inscrito_esc']=='NO') echo "checked";?>> NO <br>
                    <input type="radio" name="escuela" id="otro17"  onclick="enable_fields_otro17();" value="OTRO"  <?php  if(($valoracion_juridica['inscrito_esc']!='SI') and ($valoracion_juridica['inscrito_esc']!='NO') ){ echo "checked";}?>> <b>Otro </b>
                          <input type="text" class="form-control" disabled="disabled" name="escuela_text" id="otro_text17"  value="<?php  if(($valoracion_juridica['inscrito_esc']!='SI') and ($valoracion_juridica['inscrito_esc']!='NO') ){ echo $valoracion_juridica['inscrito_esc'];}?>"    palceholder="Otra opción"><br>
                  		 <br> <?php echo form_error('escuela');?>
                    <label>La NNA asiste regularmente a la escuela<span style="color: red" class="asterisco"> *</span></label><br>
                    <input type="radio" name="asiste_reg" value="SI"  id="si_registro18" onclick="disable_fields18()" <?php if($valoracion_juridica['asiste_reg']=='SI') echo "checked";?>> SI <br>
                    <input type="radio" name="asiste_reg" value="NO" id="no_registro18" onclick="disable_fields18()" <?php if($valoracion_juridica['asiste_reg']=='NO') echo "checked";?>> NO <br>
                    <input type="radio" name="asiste_reg" id="otro18"  onclick="enable_fields_otro18();" value="OTRO"  <?php  if(($valoracion_juridica['asiste_reg']!='SI') and ($valoracion_juridica['asiste_reg']!='NO') ){ echo "checked";}?>> <b>Otro </b>
                          <input type="text" class="form-control" disabled="disabled" name="asiste_reg_text" id="otro_text18"  value="<?php  if(($valoracion_juridica['asiste_reg']!='SI') and ($valoracion_juridica['asiste_reg']!='NO') ){ echo $valoracion_juridica['asiste_reg'];}?>"    palceholder="Otra opción"><br>
                  		 <br> <?php echo form_error('asiste_reg');?>
                    <label>La NNA duerme las horas adecuadas a su edad<span style="color: red" class="asterisco"> *</span></label><br>
                    <input type="radio" name="duerme" value="SI"  id="si_registro19" onclick="disable_fields19()" <?php if($valoracion_juridica['duerme']=='SI') echo "checked";?>> SI <br>
                    <input type="radio" name="duerme" value="NO" id="no_registro19" onclick="disable_fields19()" <?php if($valoracion_juridica['duerme']=='NO') echo "checked";?>> NO <br>
                    <input type="radio" name="duerme" id="otro19"  onclick="enable_fields_otro19();" value="OTRO"  <?php  if(($valoracion_juridica['duerme']!='SI') and ($valoracion_juridica['duerme']!='NO') ){ echo "checked";}?>> <b>Otro </b>
                          <input type="text" class="form-control" disabled="disabled" name="duerme_text" id="otro_text19"  value="<?php  if(($valoracion_juridica['duerme']!='SI') and ($valoracion_juridica['duerme']!='NO') ){ echo $valoracion_juridica['duerme'];}?>"    palceholder="Otra opción"><br>
                  		<br> <?php echo form_error('duerme');?>
                    <label>La NNA realiza actividades de esparcimiento como actividades culturales, deportivas o juego regularmente conforme a su edad<span style="color: red" class="asterisco"> *</span></label><br>
                    <input type="radio" name="act_espar" value="SI"  id="si_registro20" onclick="disable_fields20()" <?php if($valoracion_juridica['act_esparcimiento']=='SI') echo "checked";?>> SI <br>
                    <input type="radio" name="act_espar" value="NO" id="no_registro20" onclick="disable_fields20()" <?php if($valoracion_juridica['act_esparcimiento']=='NO') echo "checked";?>> NO <br>
                    <input type="radio" name="act_espar" id="otro20"  onclick="enable_fields_otro20();" value="OTRO"  <?php  if(($valoracion_juridica['act_esparcimiento']!='SI') and ($valoracion_juridica['act_esparcimiento']!='NO') ){ echo "checked";}?>> <b>Otro </b>
                          <input type="text" class="form-control" disabled="disabled" name="act_espar_text" id="otro_text20"  value="<?php  if(($valoracion_juridica['act_esparcimiento']!='SI') and ($valoracion_juridica['act_esparcimiento']!='NO') ){ echo $valoracion_juridica['act_esparcimiento'];}?>"    palceholder="Otra opción"><br>
                  		<br> <?php echo form_error('act_espar');?>
    
            </div>
        </div>
         <!-- Fin de Cuestionario 8 -->

         <!-- Cuestionario 9 -->
        <div class="panel panel-primary">
            <!-- Default panel contents -->
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-11">
                        Derecho a la intimidad<span style="color: red" class="asterisco"> *</span> 
                        <?php echo form_error('intimidad');?> <?php echo form_error('privacidad');?>
                        </div>
                    <div class="col-md-1" id="boton9" style="padding-top:0px;">  
                        <center>
                            <a href="javascript:void(0)" onclick="preguntas9()"><button type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-chevron-down"></span></button></a>
                            
                        </center>
                        
                    </div>
                </div>
            </div>
            <div class="panel-body" style="display:none;" id="preguntas9">
            
                    <label>La NNA goza de su derecho a la intimidad<span style="color: red" class="asterisco"> *</span></label><br>
                    <input type="radio" name="intimidad" value="SI"  id="si_registro21" onclick="disable_fields21()" <?php if($valoracion_juridica['intimidad']=='SI') echo "checked";?>> SI <br>
                    <input type="radio" name="intimidad" value="NO" id="no_registro21" onclick="disable_fields21()" <?php if($valoracion_juridica['intimidad']=='NO') echo "checked";?>> NO <br>
                    <input type="radio" name="intimidad" id="otro21"  onclick="enable_fields_otro21();" value="OTRO"  <?php  if(($valoracion_juridica['intimidad']!='SI') and ($valoracion_juridica['intimidad']!='NO') ){ echo "checked";}?>> <b>Otro </b>
                          <input type="text" class="form-control" disabled="disabled" name="intimidad_text" id="otro_text21"  value=" <?php  if(($valoracion_juridica['intimidad']!='SI') and ($valoracion_juridica['intimidad']!='NO') ){ echo $valoracion_juridica['intimidad'];}?>"    palceholder="Otra opción"><br>
                  		 <br> <?php echo form_error('intimidad');?>
                    <label>¿El derecho de la NNA a que no se divulguen datos personales sin su consentimiento ha sido salvaguardado?<span style="color: red" class="asterisco"> *</span></label><br>
                    <input type="radio" name="privacidad" value="SI"  id="si_registro22" onclick="disable_fields22()" <?php if($valoracion_juridica['privacidad']=='SI') echo "checked";?>> SI <br>
                    <input type="radio" name="privacidad" value="NO" id="no_registro22" onclick="disable_fields22()" <?php if($valoracion_juridica['privacidad']=='NO') echo "checked";?>> NO <br>
                    <input type="radio" name="privacidad" id="otro22"  onclick="enable_fields_otro22();" value="OTRO"  <?php  if(($valoracion_juridica['privacidad']!='SI') and ($valoracion_juridica['privacidad']!='NO') ){ echo "checked";}?>> <b>Otro </b>
                          <input type="text" class="form-control" disabled="disabled" name="privacidad_text" id="otro_text22"  value="<?php  if(($valoracion_juridica['privacidad']!='SI') and ($valoracion_juridica['privacidad']!='NO') ){ echo $valoracion_juridica['privacidad'];}?>"    palceholder="Otra opción"><br>
                  		 <br> <?php echo form_error('privacidad');?>
    
            </div>
        </div>
         <!-- Fin de Cuestionario 9-->


          <!-- Cuestionario 10 -->
        <div class="panel panel-primary">
            <!-- Default panel contents -->
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-11">
                        Acercarcamiento con familiares <span style="color: red" class="asterisco"> *</span> 
                        <?php echo form_error('intimidad');?> 
                        </div>
                    <div class="col-md-1" id="boton10" style="padding-top:0px;">  
                        <center>
                            <a href="javascript:void(0)" onclick="preguntas10()"><button type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-chevron-down"></span></button></a>
                            
                        </center>
                        
                    </div>
                </div>
            </div>
            <div class="panel-body" style="display:none;" id="preguntas10">
            
                    <label>¿Se ha realizado alguna acción?<span style="color: red" class="asterisco"> *</span></label><br>
                    <input type="radio" name="accion" value="SI"  id="si_registro23" onclick="disable_fields23()" <?php if($valoracion_juridica['accion']=='SI') echo "checked";?>> SI <br>
                    <input type="radio" name="accion" value="NO" id="no_registro23" onclick="disable_fields23()" <?php if($valoracion_juridica['accion']=='NO') echo "checked";?>> NO <br>
                    <input type="radio" name="accion" id="otro23"  onclick="enable_fields_otro23();" value="OTRO"  <?php  if(($valoracion_juridica['accion']!='SI') and ($valoracion_juridica['accion']!='NO') ){ echo "checked";}?>> <b>Otro </b>
                          <input type="text" class="form-control" disabled="disabled" name="accion_text" id="otro_text23"  value="<?php  if(($valoracion_juridica['accion']!='SI') and ($valoracion_juridica['accion']!='NO') ){ echo $valoracion_juridica['accion'];}?>"    palceholder="Otra opción"><br>
                         <br> <?php echo form_error('accion');?><br>
    
            </div>
        </div>
         <!-- Fin de Cuestionario 10 -->

          <!-- Cuestionario 11 -->
        <div class="panel panel-primary">
            <!-- Default panel contents -->
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-11">
                        Derecho a la participación. <span style="color: red" class="asterisco"> *</span> 
                        <?php echo form_error('opinion_n');?> 
                        </div>
                    <div class="col-md-1" id="boton11" style="padding-top:0px;">  
                        <center>
                            <a href="javascript:void(0)" onclick="preguntas11()"><button type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-chevron-down"></span></button></a>
                            
                        </center>
                        
                    </div>
                </div>
            </div>
            <div class="panel-body" style="display:none;" id="preguntas11">
            
                    <label>¿Se ha considerado la opinión del NNA?<span style="color: red" class="asterisco"> *</span></label><br>
                    <input type="radio" name="opinion_n" value="SI"  id="si_registro24" onclick="disable_fields24()" <?php if($valoracion_juridica['opinion_n']=='SI') echo "checked";?>> SI <br>
                    <input type="radio" name="opinion_n" value="NO" id="no_registro24" onclick="disable_fields24()" <?php if($valoracion_juridica['opinion_n']=='NO') echo "checked";?>> NO <br>
                    <input type="radio" name="opinion_n" id="otro24"  onclick="enable_fields_otro24();" value="OTRO"  <?php  if(($valoracion_juridica['opinion_n']!='SI') and ($valoracion_juridica['opinion_n']!='NO') ){ echo "checked";}?>> <b>Otro </b>
                          <input type="text" class="form-control" disabled="disabled" name="opinion_n_text" id="otro_text24"  value="<?php  if(($valoracion_juridica['opinion_n']!='SI') and ($valoracion_juridica['opinion_n']!='NO') ){ echo $valoracion_juridica['opinion_n'];}?>"    palceholder="Otra opción"><br>
                           <br>  <?php echo form_error('opinion_n');?><br>
    
            </div>
        </div>
         <!-- Fin de Cuestionario 11 -->
         
    
  
       
     
         <?php $fecha_time = date("Y/m/d/");?>
         <input type="hidden" name="fk_expediente" value="<?php echo $expediente['id_expediente']?>">

         
         <center>
         <br>
         <button class="btn btn-primary" name="formulario" type="submit">Guardar</button>
         </center>
     </form>
        
</div>

</body>
</html>
<script>

</script>