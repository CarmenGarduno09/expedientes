
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>index.php/proyecto/panel">Principal</a></li>
        <li><a href="<?php echo base_url();?>index.php/proyecto/expediente_abogado">Expedientes NNA</a></li>
        <li class="active">Valoración</li>
        </ol>
<center><h1>ALTA DE VALORACIÓN JURÍDICA</h1></center>
         
<div class="panel panel-primary">
  <div class="panel-heading">Información del NNA</div>
    <div class="panel-body">
       <form autocomplete="off" name="formulario" class="form" method="POST" action="<?php echo base_url()?>index.php/proyecto/valoracion_abogado/<?php echo $expediente['id_expediente'];?>">
      
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
                <label>Nombre del NNA: </label> <?php echo $expediente['nombres_nino'] ?> <?php echo $expediente['apellido_pnino'] ?> <?php echo $expediente['apellido_mnino'] ?><br>
              <label>No. Expediente: </label>  <?php echo $expediente['no_expediente'] ?> <br>
              <label>No. Carpeta: </label> <?php echo $expediente['no_carpeta']?><br>
              <label>Fecha de nacimiento: </label>  <?php $fecha_n=$expediente['fecha_nnino'];
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
    
      </div>
  </div>


        <center> <h2 class="page-header">VALORACIÓN DE INGRESO DEL NNA</h2> </center>
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
                  		<b>SI </b><input type="radio" name="registro" id="verificar" onclick="enable_fields();" value="SI" <?php if(set_value('registro')=='SI') echo "checked";?>><br>
                  		<b>NO </b><input type="radio" name="registro" id="no_registro" onclick="disable_fields();" value="NO"  <?php if(set_value('registro')=='NO') echo "checked";?>><br>
                          <b>Otro: </b> <input type="radio" name="registro" id="otro" onclick="enable_fields_otro();" value="OTRO"  <?php if(set_value('registro')=='OTRO') echo "checked";?>> 
                          <input type="text" class="form-control" disabled="disabled" name="registro_text" id="otro_text"    value="<?php echo set_value('registro_text');?>" palceholder="Otra opción"><br>
                  		<label for="numero_acta">No. de acta</label>
                  		<input type="text" id="numero_acta" name="numero_acta" class="form-control" disabled="disabled">
                  		<label for="lugar_r">Lugar de registro</label>
                  		<input type="text" id="lugar_r" name="lugar_r" class="form-control" disabled="disabled">
                  		<label for="curp">CURP</label>
                  		<input type="text" id="curp" name="curp" class="form-control" disabled="disabled">
                
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
                    <input type="radio" name="vive" id="si_registro1" onclick="disable_fields1()"  value="SI" <?php if(set_value('vive')=='SI') echo "checked";?>> SI <br>
                    <input type="radio" name="vive" id="no_registro1" onclick="disable_fields1()" value="NO" <?php if(set_value('vive')=='NO') echo "checked";?>> NO <br>
                     <input type="radio" name="vive" id="otro1"  onclick="enable_fields_otro1();" value="OTRO"  .> <b>Otro </b>
                          <input type="text" class="form-control" disabled="disabled" name="vive_text" id="otro_text1"   value="<?php echo set_value('vive_text');?>"  palceholder="Otra opción"><br>
                  		<br><?php echo form_error('vive');?>
                    <label>En caso de estar separado de su familia, la NNA ¿tiene permitida la convivencia o mantenimiento de relaciones personales con sus familiares? Salvo que la autoridad competente haya determinado lo contrario<span style="color: red" class="asterisco"> *</span></label><br>
                    <input type="radio" name="convivencia" id="si_registro2" value="SI" onclick="disable_fields2()" <?php if(set_value('convivencia')=='SI') echo "checked";?>> SI <br>
                    <input type="radio" name="convivencia" id="no_registro2" value="NO" onclick="disable_fields2()"<?php if(set_value('convivencia')=='NO') echo "checked";?>> NO <br>
                    <input type="radio" name="convivencia" id="otro2"  onclick="enable_fields_otro2();" value="OTRO"  <?php if(set_value('convivencia')=='OTRO') echo "checked";?>> <b>Otro </b>
                          <input type="text" class="form-control" disabled="disabled" name="convivencia_text" id="otro_text2"   value="<?php echo set_value('convivencia_text');?>"  palceholder="Otra opción"><br>
                  		 <br><?php echo form_error('convivencia');?>
                    <label>Es considerada la opinión de la NNA en la familia<span style="color: red" class="asterisco"> *</span></label><br>
                    <input type="radio" name="opinion" value="SI" id="si_registro3" onclick="disable_fields3()" <?php if(set_value('opinion')=='SI') echo "checked";?>> SI <br>
                    <input type="radio" name="opinion" value="NO" id="no_registro3" onclick="disable_fields3()" <?php if(set_value('opinion')=='NO') echo "checked";?>> NO <br>
                    <input type="radio" name="opinion" id="otro3"  onclick="enable_fields_otro3();" value="OTRO"  <?php if(set_value('opinion')=='OTRO') echo "checked";?>> <b>Otro </b>
                          <input type="text" class="form-control" disabled="disabled" name="opinion_text" id="otro_text3"   value="<?php echo set_value('opinion_text');?>"  palceholder="Otra opción"><br>
                  		  <br><?php echo form_error('opinion');?>

                    <label>¿La NNA ha sido separado de algún miembro de su familia?<span style="color: red" class="asterisco"> *</span></label><br>
                    <input type="radio" name="separado" value="SI" id="si_registro4" onclick="disable_fields4()" <?php if(set_value('separado')=='SI') echo "checked";?>> SI <br>
                    <input type="radio" name="separado" value="NO" id="no_registro4" onclick="disable_fields4()" <?php if(set_value('separado')=='NO') echo "checked";?>> NO <br>
                    <input type="radio" name="separado" id="otro4"  onclick="enable_fields_otro4()" value="OTRO"  <?php if(set_value('separado')=='OTRO') echo "checked";?>> <b>Otro </b>
                          <input type="text" class="form-control" disabled="disabled" name="separado_text" id="otro_text4"  value="<?php echo set_value('separado_text');?>" palceholder="Otra opción"><br>
                  		  <br><?php echo form_error('separado');?>

                    <label>¿El NNA cuenta con familia extensa o ampliada?<span style="color: red" class="asterisco"> *</span></label><br>
                    <input type="radio" name="fam_extensa" value="SI"  id="si_registro5" onclick="disable_fields5()" <?php if(set_value('fam_extensa')=='SI') echo "checked";?>> SI <br>
                    <input type="radio" name="fam_extensa" value="NO" id="no_registro5" onclick="disable_fields5()" <?php if(set_value('fam_extensa')=='NO') echo "checked";?>> NO <br>
                    <input type="radio" name="fam_extensa" id="otro5"  onclick="enable_fields_otro5();" value="OTRO"  <?php if(set_value('fam_extensa')=='OTRO') echo "checked";?>> <b>Otro </b>
                          <input type="text" class="form-control" disabled="disabled" name="fam_extensa_text" id="otro_text5"  value="<?php echo set_value('fam_extensa_text');?>"    palceholder="Otra opción"><br>
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
                   <input type="radio" name="derechos" value="SI"  id="si_registro6" onclick="disable_fields6()" <?php if(set_value('derechos')=='SI') echo "checked";?>> SI <br>
                    <input type="radio" name="derechos" value="NO" id="no_registro6" onclick="disable_fields6()" <?php if(set_value('derechos')=='NO') echo "checked";?>> NO <br>
                    <input type="radio" name="derechos" id="otro6"  onclick="enable_fields_otro6();" value="OTRO"  <?php if(set_value('derechos')=='OTRO') echo "checked";?>> <b>Otro </b>
                          <input type="text" class="form-control" disabled="disabled" name="derechos_text" id="otro_text6"  value="<?php echo set_value('derechos_text');?>"    palceholder="Otra opción"><br>
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
                    <input type="radio" name="discriminacion" value="SI"  id="si_registro7" onclick="disable_fields7()" <?php if(set_value('discriminacion')=='SI') echo "checked";?>> SI <br>
                    <input type="radio" name="discriminacion" value="NO" id="no_registro7" onclick="disable_fields7()" <?php if(set_value('discriminacion')=='NO') echo "checked";?>> NO <br>
                    <input type="radio" name="discriminacion" id="otro7"  onclick="enable_fields_otro7();" value="OTRO"  <?php if(set_value('discriminacion')=='OTRO') echo "checked";?>> <b>Otro </b>
                          <input type="text" class="form-control" disabled="disabled" name="discriminacion_text" id="otro_text7"  value="<?php echo set_value('discriminacion_text');?>"    palceholder="Otra opción"><br>
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
                    <input type="radio" name="vivienda" value="SI"  id="si_registro8" onclick="disable_fields8()" <?php if(set_value('vivienda')=='SI') echo "checked";?>> SI <br>
                    <input type="radio" name="vivienda" value="NO" id="no_registro8" onclick="disable_fields8()" <?php if(set_value('vivienda')=='NO') echo "checked";?>> NO <br>
                    <input type="radio" name="vivienda" id="otro8"  onclick="enable_fields_otro8();" value="OTRO"  <?php if(set_value('vivienda')=='OTRO') echo "checked";?>> <b>Otro </b>
                          <input type="text" class="form-control" disabled="disabled" name="vivienda_text" id="otro_text8"  value="<?php echo set_value('vivienda_text');?>"    palceholder="Otra opción"><br>
                  		  <br> <?php echo form_error('vivienda');?>
                    <label>La NNA cuenta con la protección y supervisión adecuadas por parte de un adulto responsable de su cuidado<span style="color: red" class="asterisco"> *</span></label><br>
                    <input type="radio" name="proteccion" value="SI"  id="si_registro9" onclick="disable_fields9()" <?php if(set_value('proteccion')=='SI') echo "checked";?>> SI <br>
                    <input type="radio" name="proteccion" value="NO" id="no_registro9" onclick="disable_fields9()" <?php if(set_value('proteccion')=='NO') echo "checked";?>> NO <br>
                    <input type="radio" name="proteccion" id="otro9"  onclick="enable_fields_otro9();" value="OTRO"  <?php if(set_value('proteccion')=='OTRO') echo "checked";?>> <b>Otro </b>
                          <input type="text" class="form-control" disabled="disabled" name="proteccion_text" id="otro_text9"  value="<?php echo set_value('proteccion_text');?>"    palceholder="Otra opción"><br>
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
                    <input type="radio" name="violencia" value="SI"  id="si_registro10" onclick="disable_fields10()" <?php if(set_value('violencia')=='SI') echo "checked";?>> SI <br>
                    <input type="radio" name="violencia" value="NO" id="no_registro10" onclick="disable_fields10()" <?php if(set_value('violencia')=='NO') echo "checked";?>> NO <br>
                    <input type="radio" name="violencia" id="otro10"  onclick="enable_fields_otro10();" value="OTRO"  <?php if(set_value('violencia')=='OTRO') echo "checked";?>> <b>Otro </b>
                          <input type="text" class="form-control" disabled="disabled" name="violencia_text" id="otro_text10"  value="<?php echo set_value('violencia_text');?>"    palceholder="Otra opción"><br>
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
               
                    <label>La NNA cuenta con servicio médico de seguro social o seguro popular<span style="color: red" class="asterisco"> *</span></label><br>
                    <input type="radio" name="servicio_med" value="SI"  id="si_registro11" onclick="disable_fields11()" <?php if(set_value('servicio_med')=='SI') echo "checked";?>> SI <br>
                    <input type="radio" name="servicio_med" value="NO" id="no_registro11" onclick="disable_fields11()" <?php if(set_value('servicio_med')=='NO') echo "checked";?>> NO <br>
                    <input type="radio" name="servicio_med" id="otro11"  onclick="enable_fields_otro11();" value="OTRO"  <?php if(set_value('servicio_med')=='OTRO') echo "checked";?>> <b>Otro </b>
                          <input type="text" class="form-control" disabled="disabled" name="servicio_med_text" id="otro_text11"  value="<?php echo set_value('servicio_med_text');?>"    palceholder="Otra opción"><br>
                  		  <br> <?php echo form_error('servicio_med');?>
                    <label>La NNA muestra una nutrición adecuada (Notoriamente visibles)<span style="color: red" class="asterisco"> *</span></label><br>
                    <input type="radio" name="nutricion" value="SI"  id="si_registro12" onclick="disable_fields12()" <?php if(set_value('nutricion')=='SI') echo "checked";?>> SI <br>
                    <input type="radio" name="nutricion" value="NO" id="no_registro12" onclick="disable_fields12()" <?php if(set_value('nutricion')=='NO') echo "checked";?>> NO <br>
                    <input type="radio" name="nutricion" id="otro12"  onclick="enable_fields_otro12();" value="OTRO"  <?php if(set_value('nutricion')=='OTRO') echo "checked";?>> <b>Otro </b>
                          <input type="text" class="form-control" disabled="disabled" name="nutricion_text" id="otro_text12"  value="<?php echo set_value('nutricion_text');?>"    palceholder="Otra opción"><br>
                  		  <br> <?php echo form_error('nutricion');?>
                    <label>La NNA asiste a revisión médica periódica<span style="color: red" class="asterisco"> *</span></label><br>
                    <input type="radio" name="revision" value="SI"  id="si_registro13" onclick="disable_fields13()" <?php if(set_value('revision')=='SI') echo "checked";?>> SI <br>
                    <input type="radio" name="revision" value="NO" id="no_registro13" onclick="disable_fields13()" <?php if(set_value('revision')=='NO') echo "checked";?>> NO <br>
                    <input type="radio" name="revision" id="otro13"  onclick="enable_fields_otro13();" value="OTRO"  <?php if(set_value('revision')=='OTRO') echo "checked";?>> <b>Otro </b>
                          <input type="text" class="form-control" disabled="disabled" name="revision_text" id="otro_text13"  value="<?php echo set_value('revision_text');?>"    palceholder="Otra opción"><br>
                  		  <br><?php echo form_error('revision');?>
                    <label>La NNA cuenta con cartilla de vacunación<span style="color: red" class="asterisco"> *</span></label><br>
                    <input type="radio" name="cartilla" value="SI"  id="si_registro14" onclick="disable_fields14()" <?php if(set_value('cartilla')=='SI') echo "checked";?>> SI <br>
                    <input type="radio" name="cartilla" value="NO" id="no_registro14" onclick="disable_fields14()" <?php if(set_value('cartilla')=='NO') echo "checked";?>> NO <br>
                    <input type="radio" name="cartilla" id="otro14"  onclick="enable_fields_otro14();" value="OTRO"  <?php if(set_value('cartilla')=='OTRO') echo "checked";?>> <b>Otro </b>
                          <input type="text" class="form-control" disabled="disabled" name="cartilla_text" id="otro_text14"  value="<?php echo set_value('cartilla_text');?>"    palceholder="Otra opción"><br>
                  		 <br><?php echo form_error('cartilla');?>
                    <label>En caso de que se le haya detectado alguna enfermedad a la NNA ¿Se le brinda el tratamiento adecuado?<span style="color: red" class="asterisco"> *</span></label><br>
                    <input type="radio" name="tratamiento" value="SI"  id="si_registro15" onclick="disable_fields15()" <?php if(set_value('tratamiento')=='SI') echo "checked";?>> SI <br>
                    <input type="radio" name="tratamiento" value="NO" id="no_registro15" onclick="disable_fields15()" <?php if(set_value('tratamiento')=='NO') echo "checked";?>> NO <br>
                    <input type="radio" name="tratamiento" id="otro15"  onclick="enable_fields_otro15();" value="OTRO"  <?php if(set_value('tratamiento')=='OTRO') echo "checked";?>> <b>Otro </b>
                          <input type="text" class="form-control" disabled="disabled" name="tratamiento_text" id="otro_text15"  value="<?php echo set_value('tratamiento_text');?>"    palceholder="Otra opción"><br>
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
                    <input type="radio" name="atencion_dis" value="SI"  id="si_registro16" onclick="disable_fields16()" <?php if(set_value('atencion_dis')=='SI') echo "checked";?>> SI <br>
                    <input type="radio" name="atencion_dis" value="NO" id="no_registro16" onclick="disable_fields16()" <?php if(set_value('atencion_dis')=='NO') echo "checked";?>> NO <br>
                    <input type="radio" name="atencion_dis" id="otro16"  onclick="enable_fields_otro16();" value="OTRO"  <?php if(set_value('atencion_dis')=='OTRO') echo "checked";?>> <b>Otro </b>
                          <input type="text" class="form-control" disabled="disabled" name="atencion_dis_text" id="otro_text16"  value="<?php echo set_value('atencion_dis_text');?>"    palceholder="Otra opción"><br>
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
                    <input type="radio" name="escuela" value="SI"  id="si_registro17" onclick="disable_fields17()" <?php if(set_value('escuela')=='SI') echo "checked";?>> SI <br>
                    <input type="radio" name="escuela" value="NO" id="no_registro17" onclick="disable_fields17()" <?php if(set_value('escuela')=='NO') echo "checked";?>> NO <br>
                    <input type="radio" name="escuela" id="otro17"  onclick="enable_fields_otro17();" value="OTRO"  <?php if(set_value('escuela')=='OTRO') echo "checked";?>> <b>Otro </b>
                          <input type="text" class="form-control" disabled="disabled" name="escuela_text" id="otro_text17"  value="<?php echo set_value('escuela_text');?>"    palceholder="Otra opción"><br>
                  		 <br> <?php echo form_error('escuela');?>
                    <label>La NNA asiste regularmente a la escuela<span style="color: red" class="asterisco"> *</span></label><br>
                    <input type="radio" name="asiste_reg" value="SI"  id="si_registro18" onclick="disable_fields18()" <?php if(set_value('asiste_reg')=='SI') echo "checked";?>> SI <br>
                    <input type="radio" name="asiste_reg" value="NO" id="no_registro18" onclick="disable_fields18()" <?php if(set_value('asiste_reg')=='NO') echo "checked";?>> NO <br>
                    <input type="radio" name="asiste_reg" id="otro18"  onclick="enable_fields_otro18();" value="OTRO"  <?php if(set_value('asiste_reg')=='OTRO') echo "checked";?>> <b>Otro </b>
                          <input type="text" class="form-control" disabled="disabled" name="asiste_reg_text" id="otro_text18"  value="<?php echo set_value('asiste_reg_text');?>"    palceholder="Otra opción"><br>
                  		 <br> <?php echo form_error('asiste_reg');?>
                    <label>La NNA duerme las horas adecuadas a su edad<span style="color: red" class="asterisco"> *</span></label><br>
                    <input type="radio" name="duerme" value="SI"  id="si_registro19" onclick="disable_fields19()" <?php if(set_value('duerme')=='SI') echo "checked";?>> SI <br>
                    <input type="radio" name="duerme" value="NO" id="no_registro19" onclick="disable_fields19()" <?php if(set_value('duerme')=='NO') echo "checked";?>> NO <br>
                    <input type="radio" name="duerme" id="otro19"  onclick="enable_fields_otro19();" value="OTRO"  <?php if(set_value('duerme')=='OTRO') echo "checked";?>> <b>Otro </b>
                          <input type="text" class="form-control" disabled="disabled" name="duerme_text" id="otro_text19"  value="<?php echo set_value('duerme_text');?>"    palceholder="Otra opción"><br>
                  		<br> <?php echo form_error('duerme');?>
                    <label>La NNA realiza actividades de esparcimiento como actividades culturales, deportivas o juego regularmente conforme a su edad<span style="color: red" class="asterisco"> *</span></label><br>
                    <input type="radio" name="act_espar" value="SI"  id="si_registro20" onclick="disable_fields20()" <?php if(set_value('act_espar')=='SI') echo "checked";?>> SI <br>
                    <input type="radio" name="act_espar" value="NO" id="no_registro20" onclick="disable_fields20()" <?php if(set_value('act_espar')=='NO') echo "checked";?>> NO <br>
                    <input type="radio" name="act_espar" id="otro20"  onclick="enable_fields_otro20();" value="OTRO"  <?php if(set_value('act_espar')=='OTRO') echo "checked";?>> <b>Otro </b>
                          <input type="text" class="form-control" disabled="disabled" name="act_espar_text" id="otro_text20"  value="<?php echo set_value('act_espar_text');?>"    palceholder="Otra opción"><br>
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
                    <input type="radio" name="intimidad" value="SI"  id="si_registro21" onclick="disable_fields21()" <?php if(set_value('intimidad')=='SI') echo "checked";?>> SI <br>
                    <input type="radio" name="intimidad" value="NO" id="no_registro21" onclick="disable_fields21()" <?php if(set_value('intimidad')=='NO') echo "checked";?>> NO <br>
                    <input type="radio" name="intimidad" id="otro21"  onclick="enable_fields_otro21();" value="OTRO"  <?php if(set_value('intimidad')=='OTRO') echo "checked";?>> <b>Otro </b>
                          <input type="text" class="form-control" disabled="disabled" name="intimidad_text" id="otro_text21"  value="<?php echo set_value('intimidad_text');?>"    palceholder="Otra opción"><br>
                  		 <br> <?php echo form_error('intimidad');?>
                    <label>¿El derecho de la NNA a que no se divulguen datos personales sin su consentimiento ha sido salvaguardado?<span style="color: red" class="asterisco"> *</span></label><br>
                    <input type="radio" name="privacidad" value="SI"  id="si_registro22" onclick="disable_fields22()" <?php if(set_value('privacidad')=='SI') echo "checked";?>> SI <br>
                    <input type="radio" name="privacidad" value="NO" id="no_registro22" onclick="disable_fields22()" <?php if(set_value('privacidad')=='NO') echo "checked";?>> NO <br>
                    <input type="radio" name="privacidad" id="otro22"  onclick="enable_fields_otro22();" value="OTRO"  <?php if(set_value('privacidad')=='OTRO') echo "checked";?>> <b>Otro </b>
                          <input type="text" class="form-control" disabled="disabled" name="privacidad_text" id="otro_text22"  value="<?php echo set_value('privacidad_text');?>"    palceholder="Otra opción"><br>
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
                    <input type="radio" name="accion" value="SI"  id="si_registro23" onclick="disable_fields23()" <?php if(set_value('accion')=='SI') echo "checked";?>> SI <br>
                    <input type="radio" name="accion" value="NO" id="no_registro23" onclick="disable_fields23()" <?php if(set_value('accion')=='NO') echo "checked";?>> NO <br>
                    <input type="radio" name="accion" id="otro23"  onclick="enable_fields_otro23();" value="OTRO"  <?php if(set_value('accion')=='OTRO') echo "checked";?>> <b>Otro </b>
                          <input type="text" class="form-control" disabled="disabled" name="accion_text" id="otro_text23"  value="<?php echo set_value('accion_text');?>"    palceholder="Otra opción"><br>
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
                    <input type="radio" name="opinion_n" value="SI"  id="si_registro24" onclick="disable_fields24()" <?php if(set_value('opinion_n')=='SI') echo "checked";?>> SI <br>
                    <input type="radio" name="opinion_n" value="NO" id="no_registro24" onclick="disable_fields24()" <?php if(set_value('opinion_n')=='NO') echo "checked";?>> NO <br>
                    <input type="radio" name="opinion_n" id="otro24"  onclick="enable_fields_otro24();" value="OTRO"  <?php if(set_value('opinion_n')=='OTRO') echo "checked";?>> <b>Otro </b>
                          <input type="text" class="form-control" disabled="disabled" name="opinion_n_text" id="otro_text24"  value="<?php echo set_value('opinion_n_text');?>"    palceholder="Otra opción"><br>
                           <br>  <?php echo form_error('opinion_n');?><br>
    
            </div>
        </div>
         <!-- Fin de Cuestionario 11 -->
         
         <div>
         <?php $fecha_time = date("Y/m/d");?>
            <input type="hidden" name="fecha" value="<?php echo $fecha_time; ?>" class="form-control" id="fecha_val">
         </div>
         <br>  <?php echo form_error('fecha');?><br>
         
       
     
         <?php $fecha_time = date("Y/m/d/");?>
         <input type="hidden" name="fk_expediente" value="<?php echo $expediente['id_expediente']?>">
        
         
         <!-- Plan de restituciony recomendaciones-->
         <!--Botón que habilita plan de restitucion -->
         <input type="hidden" id="id_expediente_niño" name="id_expediente_niño" value="<?php echo $expediente['id_expediente']?>">
         <center>
         <a class='btn btn-info btn-sm' href='javascript:void(0)' onclick="Plan('<?php echo $expediente['id_expediente']?>')"><i class='fas fa-pencil-alt'></i>Agregar plan de restitución</a>
         <br><br>
         </center>
         
           <!-- Panel plan de restitucion  -->
        <div class="panel panel-default" style="display:none;" id="plan_grl">
            <!-- Default panel contents -->
            <div class="panel-body">
            <div id="plan_usuario"><!--En este div se insertará la lista de las planes ya guardadas-->
                
                </div>
             
                  <div id="hidden_usr"><!--En este div va el id_del niño generado en un hidden-->
                    
                  </div>
                  <textarea placeholder="Escriba un campo del plan de restitución, y de clic en guardar." name="plan_tx" rows="3" cols="70" id="plan_tx" class="form-control" > </textarea><br>
                  <button class="btn btn-primary" type="button" id="guardar_plan">Guardar campo</button>
          
            </div>
        </div>
         
          <!--Botón que habilita Panel  recomendaciones -->
        <center>
        <a class='btn btn-info btn-sm' href='javascript:void(0)' onclick="Recomendaciones('<?php echo $expediente['id_expediente']?>')"><i class='fas fa-pencil-alt'></i>Agregar acuerdo de interarias</a>
         <br>
         </center>
          <!-- Panel  recomendaciones -->
        <div class="panel panel-default" style="display:none;" id="recomendaciones_grl">
            <!-- Default panel contents -->
            <div class="panel-body">
            <div id="recomendaciones_usuario"><!--En este div se insertará la lista de las recomendaciones ya guardadas-->
                
                </div>
                
                  <div id="hidden_usr"><!--En este div va el id_del niño generado en un hidden-->
                    
                  </div>
                  <textarea  placeholder="Escriba la recomendación y de clic en guardar." name="recomendacion_tx" rows="3" cols="70" id="recomendacion_tx" class="form-control" > </textarea><br>
                  <button class="btn btn-primary" type="button" id="guardar_recomendacion">Guardar acuerdo</button>
             
            </div>
        </div>

        <br>
         <!--Botón que habilita quien autoriza -->
         <center>
        <a class='btn btn-info btn-sm' href='javascript:void(0)' onclick="Autoriza('<?php echo $expediente['id_expediente']?>')"> <i class='fas fa-pencil-alt'></i>Autorizado por:</a>
         <br>
         </center>
          <!-- Panel  recomendaciones -->
        <div class="panel panel-default" style="display:none;" id="autoriza_grl">
            <!-- Default panel contents -->
            <div class="panel-body">
            <div id="autoriza_usuario"><!--En este div se insertará la lista de las personas ya guardadas-->
                
                </div>
                
                  <div id="hidden_usr"><!--En este div va el id_del niño generado en un hidden-->
                    
                  </div>
                  <textarea  placeholder="Escriba el nombre de una persona  y de clic en guardar." name="autoriza_tx" rows="3" cols="70" id="autoriza_tx" class="form-control" > </textarea><br>
                  <br>
                  <button class="btn btn-primary" type="button" id="guardar_autoriza">Guardar persona. </button>
             
            </div>
        </div>
 
         


         <center>
         <br>
         <button class="btn btn-success" name="formulario" type="submit">Guardar</button>
         </center>
     </form>
        
</div>

</body>
</html>
<script>

</script>