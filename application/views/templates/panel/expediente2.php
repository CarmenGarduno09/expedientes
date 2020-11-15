<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" >
  <div class="noImprimir">
   <ol class="breadcrumb" >
      <li><a href="<?php echo base_url();?>index.php/proyecto/panel">Principal</a></li>
      <li><a href="<?php echo base_url();?>index.php/proyecto/lista_exp">Lista de Expedientes</a></li>
      <li class="active">Expediente particular</li>
    </ol> 
  </div>
 
  <form autocomplete="off" name="formulario" class="form" method="POST" action="<?php echo base_url()?>index.php/proyecto/revision_expediente/<?php echo $expediente['id_expediente']; ?>/<?php echo $expediente['id_ingreso']; ?>">
        <div class="col-md-12"  id="seleccion" >
          <div class="well well-sm">
              <h1 align="center" ><?php echo $expediente['nombres_nino'] ?> <?php echo $expediente['apellido_pnino'] ?> <?php echo $expediente['apellido_mnino'] ?></h1>
              <h2 align="center" ><p>No. Expediente:  <?php echo $expediente['no_expediente'] ?> </p></h2>
              <h3 align="center"><p>No. Carpeta:  <?php echo $expediente['no_carpeta']?></p></h3>
          </div>
          <div class="col-md-6">
            <div class="well well-sm">
              <div class="panel-body" >
              <td><center><img src="<?=base_url();?>/uploadt/<?=$expediente['foto_nino'];?>" width='300' height='315'></center></td>
              <!--<td><img src="<?=base_url();?>/uploadt/<?=$dif->foto_nino;?>" width='60' height='60'></td>-->
              </div>
            </div>
          </div>
          <div class="col-md-6" id= "salto">
            <div class="well well-sm">
              <div class="panel-body" >
                <label>FECHA DE NACIMIENTO: </label> <?php $fecha_n=$expediente['fecha_nnino'];
                //var_dump($fecha_n);
                $dia = substr($fecha_n,8,2);
                $mes = substr($fecha_n,5,2);
                $anio = substr($fecha_n,0,4);
                $fecha_en = $dia."/".$mes."/".$anio;
                echo $fecha_en;
                //var_dump($fecha_n);
                ?><br/>
                <label>EDAD: </label>  <td>
                <?php 
                $id_ingreso = $this->Modelo_proyecto->devuelve_id_ing($this->uri->segment(4));
                $fecha_naci = $this->Modelo_proyecto->ver_edad($id_ingreso);
                $fecha_nacinino = $fecha_naci;
                $fecha_actual = date("Y/m/d/");
                //$edad = $fecha_actual - $fecha_nacinino;
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
                </td><br/>
                <label>GÉNERO: </label> <?php echo $expediente['genero_nino']?> 
                  <br/>
                <label>LUGAR DE NACIMIENTO: </label>  <?php echo $expediente['lugar_nnino']?> <br>
                <label>MUNICIPIO DE ORIGEN:  </label>  <?php echo $expediente['municipio_origen']?><br>
                <label>FECHA DE INGRESO: </label>  <?php $f_expe = $expediente['fecha_ingreso'];
                //var_dump($f_expe);
                $dia = substr($f_expe,8,2);
                $mes = substr($f_expe,5,2);
                $anio = substr($f_expe,0,4);
                $fecha_e = $dia."/".$mes."/".$anio;
                echo $fecha_e;
                //var_dump($fecha);
                ?> <br/>
                  <label>HORA INGRESO: </label>  <?php echo $expediente['hora_ingreso']?> <br/>
                  <label>CENTRO ASISTENCIAL: </label>  <?php echo $expediente['nombre_centro']?> <br/>
                  <label>ESTATUS: </label>  <?php echo $expediente['nombre_incidencia']?> <br/>
                  <label>ESTADO PROCESAL: </label>  <?php echo $expediente['nombre_estado']?> <br/>
                  <label>PERSONAL QUE ATIENDE: 
                  <table class="table table-bordered">
                        <thead>
                          <tr> 
                            <th>Área</th>
                            <th>Nombre de personal</th>
                          </tr>
                        </thead>
                      <tbody>
                        <?php
                        foreach ($personas_atiende as $pe) {
                        ?>
                          <tr>
                            <td><?php echo $pe->nombre_privilegio;?></td>
                            <td><?php echo $pe->nombres;?> <?php echo $pe->apellido_p;?> <?php echo $pe->apellido_m;?></td>
                            
                          </tr>
                        <?php
                        }
                         ?>
                      </tbody>
                    </table>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            
          </div>
          <div class="col-md-6" >
            <div class="well well-sm">
              <div class="panel-body" >
                 <label>MOTIVOS DE INGRESO </label><br/>
                  <p><?php echo $expediente['motivos_ingreso']?> </p><br/>
                  <label>OBSERVACIONES DEL INGRESO </label><br/>
                  <p><?php echo $expediente['observaciones_ingreso']?> </p>
                  
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="well well-sm">
              <div class="panel-body" >
                <h4 align="center"><b>PERTENENCIAS</b></h4><br>
                    <table class="table table-bordered">
                        <thead>
                          <tr> 
                            <th>Cantidad</th>
                            <th>Descripción</th>
                          </tr>
                        </thead>
                      <tbody>
                        <?php
                        foreach ($pertenencias as $pe) {

                        ?>
                          <tr>
                            <td><?php echo $pe->cantidad; ?></td>
                            <td><?php echo $pe->descripcion; ?></td>
                            
                          </tr>
                        <?php
                        }
                         ?>
                      </tbody>
                    </table>
              </div>
            </div>
          </div>

          <div class="col-md-12" id ="salto">
            <div class="well well-sm">
              <div class="panel-body" >
                <h4 align="center"><b>HERMANOS</b></h4><br>
                    <table class="table table-bordered" align="center" id="tableH">
                        <thead>
                          <tr> 
                            <th>No. Expediente</th>
                            <th>No. Carpeta</th>
                            <th>Estado Procesal</th>
                            <th>Nombre del niño</th>
                            <th>Género</th>
                            <th>Fecha nacimiento</th>
                            <th>Edad</th>
                            <th>Motivos de ingreso</th>
                            <th>Fecha de ingreso</th>
                          </tr>
                        </thead>
                      <tbody>
                        <?php
                        foreach ($hermanos as $h) {
                        ?>
                          <tr>
                          <td><?php echo $h->no_expediente; ?></td>
                          <td><?php echo $h->no_carpeta; ?></td>
                          <td><?php echo $h->nombre_estado; ?></td>
                          <td><?php echo $h->nombres_nino; ?> <?php echo $h->apellido_pnino; ?> <?php echo $h->apellido_mnino; ?></td>
                          <td><?php echo $h->genero_nino; ?></td>
                          <td><?php $date_brothers = $h->fecha_nnino;
                          //var_dump($date_brothers);
                          $dia = substr($date_brothers,8,2);
                          $mes = substr($date_brothers,5,2);
                          $anio = substr($date_brothers,0,4);
                          $fecha_h = $dia."/".$mes."/".$anio;
                          echo $fecha_h;
                          //var_dump($fecha);
                          ?></td>
                          <td><center>
                           <?php 
                           $fecha_naci = $this->Modelo_proyecto->ver_edad($h->id_ingreso);
                           $fecha_nacinino = $fecha_naci;
                           $fecha_actual = date("Y/m/d/");
                           $edad = $fecha_actual - $fecha_nacinino;
                           if($edad > 100) echo "0"; 
                           else echo $edad;
                           ?>
                          </td>
                          <td><?php echo $h->motivos_ingreso; ?></td>
                          <td><?php $fecha_final = $h->fecha_ingreso;
                            //var_dump($fecha_final);
                            $dia = substr($fecha_final,8,2);
                            $mes = substr($fecha_final,5,2);
                            $anio = substr($fecha_final,0,4);
                            $fecha = $dia."/".$mes."/".$anio;
                            echo $fecha;
                            //var_dump($fecha);
                          ?>
                          </td>
                          </tr>
                        <?php
                        }
                         ?>
                      </tbody>
                    </table>
              </div>
            </div>
          </div>
          
          <div class="col-md-12" id="salto">
            <div class="well well-sm">
              <div class="panel-body" >
                <h4 align="center"><b>VALORACIONES</b></h4><br>
                    <label>VALORACIÓN MEDICA </label><br/>
                  <p>
                  Condición inicial: <?php if($valoracion_medi['condicion']){echo $valoracion_medi['condicion'];}else{echo "La valoración no ha sido realizada";}?><br>
                  Descripción inicial de salud: <?php if($valoracion_medi['des_ini']){echo $valoracion_medi['des_ini'];}else{echo "La valoración no ha sido realizada";}?><br>
                  Peso: <?php if($valoracion_medi['peso']){echo $valoracion_medi['peso'];}else{echo "La valoración no ha sido realizada";}?><br>
                  Talla: <?php if($valoracion_medi['talla']){echo $valoracion_medi['talla'];}else{echo "La valoración no ha sido realizada";}?><br>
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
                  <label>VALORACIÓN NUTRIOLÓGICA </label><br/>
                  <p>Peso: <?php if($valoracion_nutri['peso']){echo $valoracion_nutri['peso'];}else{echo "La valoración no ha sido realizada";}?><br>
                  Talla: <?php  if($valoracion_nutri['talla']){echo $valoracion_nutri['talla'];}else{echo "La valoración no ha sido realizada";}?><br>
                  Peso ideal: <?php if($valoracion_nutri['peso_ideal']){echo $valoracion_nutri['peso_ideal'];}else{echo "La valoración no ha sido realizada";}?><br>
                  Diagnostico nutricional: <?php if($valoracion_nutri['diagnostico_nutricional']){echo $valoracion_nutri['diagnostico_nutricional'];}else{echo "La valoración no ha sido realizada";}?><br>
                  Dieta: <?php if($valoracion_nutri['dieta']){echo $valoracion_nutri['dieta'];}else{echo "La valoración no ha sido realizada";}?><br>
                  Plan alimenticio: <?php if($valoracion_nutri['plan_alimenticio']){echo $valoracion_nutri['plan_alimenticio'];}else{echo "La valoración no ha sido realizada";}?><br>
                  Rasgos fisicos: <?php if($valoracion_nutri['rasgos_fisicos']){echo $valoracion_nutri['rasgos_fisicos'];}else{echo "La valoración no ha sido realizada";}?><br>
                  Datos del comedor: <?php if($valoracion_nutri['datos_comedor']){echo $valoracion_nutri['datos_comedor'];}else{echo "La valoración no ha sido realizada";}?><br>
                  ¿Se presenta alguna enfermedad? <?php if($valoracion_nutri['enfermedad']){echo $valoracion_nutri['enfermedad'];}else{echo "La valoración no ha sido realizada";}?><br>
                  Trato especial: <?php if($valoracion_nutri['trato_especial']){echo $valoracion_nutri['trato_especial'];}else{echo "La valoración no ha sido realizada";}?><br>
                  </p>
                  <label>VALORACIÓN ESCOLAR </label><br/>
                  <p>Escolaridad: <?php if($valoracion_peda['nivel_estudios']){echo $valoracion_peda['nivel_estudios'];}else{ echo "La valoración no ha sido realizada";}?> <br>
                  Lectura: <?php if($valoracion_peda['nombre']){echo $valoracion_peda['nombre'];}else{ echo "La valoración no ha sido realizada";}?><br>
                  Observaciones: <?php if($valoracion_peda['obs_lectoras']){echo $valoracion_peda['obs_lectoras'];}else{ echo "La valoración no ha sido realizada";}?><br>
                  Comprensión lectora: <?php if($valoracion_peda['nombre']){echo $valoracion_peda['nombre'];}else{ echo "La valoración no ha sido realizada";}?> <br>
                  Observaciones: <?php if( $valoracion_peda['obs_comp_lectora']){echo $valoracion_peda['obs_comp_lectora'];}else{ echo "La valoración no ha sido realizada";}?><br>
                  Transcripción: <?php if($valoracion_peda['nombre']){echo $valoracion_peda['nombre'];}else{ echo "La valoración no ha sido realizada";}?> <br>
                  Observaciones: <?php if($valoracion_peda['obs_transcripcion']){echo $valoracion_peda['obs_transcripcion'];}else{ echo "La valoración no ha sido realizada";}?><br>
                  Matemáticas: <?php if($valoracion_peda['nombre']){echo $valoracion_peda['nombre'];}else{ echo "La valoración no ha sido realizada";}?> <br>
                  Observaciones: <?php if($valoracion_peda['obs_matematicas']){echo $valoracion_peda['obs_matematicas'];}else{ echo "La valoración no ha sido realizada";}?><br>
                  Español: <?php if($valoracion_peda['nombre']){echo $valoracion_peda['nombre'];}else{ echo "La valoración no ha sido realizada";}?> <br>
                  Observaciones: <?php if($valoracion_peda['obs_espanol']){echo $valoracion_peda['obs_espanol'];}else{ echo "La valoración no ha sido realizada";}?><br>
                  Escritura: <?php if($valoracion_peda['nombre']){echo $valoracion_peda['nombre'];}else{ echo "La valoración no ha sido realizada";}?> <br>
                  Observaciones: <?php if($valoracion_peda['obs_escritura']){echo $valoracion_peda['obs_escritura'];}else{ echo "La valoración no ha sido realizada";}?><br>  
                  Canaliza de nivel: <?php if($valoracion_peda['nombre_educacion']){echo $valoracion_peda['nombre_educacion'];}else{ echo "La valoración no ha sido realizada";}?></p>
                  <label>VALORACIONES PSICOLÓGICAS </label><br/>
                  <label>Valoración del ingreso del menor</label>
                  <p>
                  Motivos de ingreso: <?php if($valoracion_psico['motivos_ing']){echo $valoracion_psico['motivos_ing'];}else{ echo "La valoración no ha sido realizada";}?><br>
                  Nombre del visitante: <?php if($valoracion_psico['nombre_visitante']){echo $valoracion_psico['nombre_visitante'];}else{ echo "La valoración no ha sido realizada";}?><br>
                  Parentesco: <?php if($valoracion_psico['parentesco']){echo $valoracion_psico['parentesco'];}else{ echo "La valoración no ha sido realizada";}?><br>
                  Antecedentes: <?php if($valoracion_psico['antecedentes']){echo $valoracion_psico['antecedentes'];}else{ echo "La valoración no ha sido realizada";}?><br>
                  Actitud del niño: <?php if($valoracion_psico['actitud_nino']){echo $valoracion_psico['actitud_nino'];}else{ echo "La valoración no ha sido realizada";}?><br>
                  Dinamica de convivencias: <?php if($valoracion_psico['dinamica_convivencias']){echo $valoracion_psico['dinamica_convivencias'];}else{ echo "La valoración no ha sido realizada";}?><br>
                  Recomendaciones: <?php if($valoracion_psico['recomendaciones']){echo $valoracion_psico['recomendaciones'];}else{ echo "La valoración no ha sido realizada";}?>
                  </p>
                  <label>Valoración psicológica del menor</label>
                  <p>
                  Familiograma: <?php if($valoracion_pmenor['familiograma']){echo $valoracion_pmenor['familiograma'];}else{ echo "La valoración no ha sido realizada";}?><br>
                  Antecedentes: <?php if($valoracion_pmenor['antec_m']){echo $valoracion_pmenor['antec_m'];}else{ echo "La valoración no ha sido realizada";}?><br>
                  Instrumentos: <?php if($valoracion_pmenor['instrumentos']){echo $valoracion_pmenor['instrumentos'];}else{ echo "La valoración no ha sido realizada";}?><br>
                  Resultados: <?php if($valoracion_pmenor['resul']){echo $valoracion_pmenor['resul'];}else{ echo "La valoración no ha sido realizada";}?><br>
                  Impresión del menor: <?php if($valoracion_pmenor['impresion']){echo $valoracion_pmenor['impresion'];}else{ echo "La valoración no ha sido realizada";}?><br>
                  Recomendaciones: <?php if($valoracion_pmenor['recomen']){echo $valoracion_pmenor['recomen'];}else{ echo "La valoración no ha sido realizada";}?>
                  </p>
                  <label>Notas psicológicas</label>
                  <p>
                  Comentarios: <?php if($notas['coment']){echo $notas['coment'];}else{ echo "Las notas psicológicas no han sido realizadas";}?><br>
                  Actividad: <?php if($notas['actividad']){echo $notas['actividad'];}else{ echo "Las notas psicológicas no han sido realizadas";}?>
                  </p>
                  <label>Valoración psicológica del familiar</label>
                  <p>
                  Nombre del familiar: <?php if($visita['nombre_cp']){echo $visita['nombre_cp'];}else{ echo "La valoración no ha sido realizada";}?><br>
                  Parentesco: <?php if($visita['parent_m']){echo $visita['parent_m'];}else{ echo "La valoración no ha sido realizada";}?><br>
                  Escolaridad: <?php if($visita['escolaridad']){echo $visita['escolaridad'];}else{ echo "La valoración no ha sido realizada";}?><br>
                  Estado civil: <?php if($visita['ecivil']){echo $visita['ecivil'];}else{ echo "La valoración no ha sido realizada";}?><br>
                  No. Hijos: <?php if($visita['n_hijos']){echo $visita['n_hijos'];}else{ echo "La valoración no ha sido realizada";}?><br>
                  Ocupación: <?php if($visita['ocupacione']){echo $visita['ocupacione'];}else{ echo "La valoración no ha sido realizada";}?><br>
                  Dirección: <?php if($visita['direccione']){echo $visita['direccione'];}else{ echo "La valoración no ha sido realizada";}?><br>
                  Antecedentes: <?php if($visita['ant']){echo $visita['ant'];}else{ echo "La valoración no ha sido realizada";}?><br>
                  Conclusiones: <?php if($visita['conclu']){echo $visita['conclu'];}else{ echo "La valoración no ha sido realizada";}?><br>
                  Recomendaciones: <?php if($visita['rec']){echo $visita['rec'];}else{ echo "La valoración no ha sido realizada";}?>
                  </p>
                  <label>VALORACIÓN JURÍDICA </label>
                  <p>   
                  <p>Derecho a la identidad</p><br>
                  Está registrado en el registro Civil:     <?php if($valoracion_juridica['registro_civil']){echo $valoracion_juridica['registro_civil'];}else{echo "La valoración no ha sido realizada";}?><br>
                   No. de acta:     <?php if($valoracion_juridica['numero_acta']){echo $valoracion_juridica['numero_acta'];}else{echo "La valoración no ha sido realizada";}?><br>
                   lugar de registro:     <?php if($valoracion_juridica['lugar_r']){echo $valoracion_juridica['lugar_r'];}else{echo "La valoración no ha sido realizada";}?><br>
                   
                   CURP:    <?php if($valoracion_juridica['curp']){echo $valoracion_juridica['curp'];}else{echo "La valoración no ha sido realizada";}?><br>
                   


                  <br>
                 <b>Derecho a vivir en familia</b><br>
                  Vive con su familia, salvo que la autoridad competente haya determinado lo contrario:   <?php if($valoracion_juridica['vive_familia']){echo $valoracion_juridica['vive_familia'];}else{echo "La valoración no ha sido realizada";}?><br>
                  En caso de estar separado de su familia,  ¿tiene permitida la convivencia o mantenimiento de relaciones personales con sus familiares? Salvo que la autoridad competente haya determinado lo contrario: <?php if($valoracion_juridica['convivencia_fam']){echo $valoracion_juridica['convivencia_fam'];}else{echo "La valoración no ha sido realizada";}?> <br>
                  Es considerada su opinión en la familia:<?php if($valoracion_juridica['opinion']){echo $valoracion_juridica['opinion'];}else{echo "La valoración no ha sido realizada";}?><br>
                  ¿Ha sido separado de algún miembro de su familia?: <?php if($valoracion_juridica['separado_miembro']){echo $valoracion_juridica['separado_miembro'];}else{echo "La valoración no ha sido realizada";}?><br><br><br>

                  <b>Derecho a la igualdad sustantiva</b><br>
                   Tienen derecho al acceso al mismo trato y oportunidades para el reconocimiento, goce o ejercicio de sus derechos:  <?php if($valoracion_juridica['derecho']){echo $valoracion_juridica['derecho'];}else{echo "La valoración no ha sido realizada";}?> <br>
                  
                   <br><b>Derecho a no ser discriminado</b><br>
                   No ha sufrido discriminación: <?php if($valoracion_juridica['discriminacion']){echo $valoracion_juridica['discriminacion'];}else{echo "La valoración no ha sido realizada";}?><br><br>

                  <b> Derecho a vivir en condiciones de bienestar y a un sano desarrollo integral</b><br>
                   Vive en una vivienda adecuada para su desarrollo: <?php if($valoracion_juridica['vivienda']){echo $valoracion_juridica['vivienda'];}else{echo "La valoración no ha sido realizada";}?><br> <br>
                   Cuenta con la protección y supervisión adecuadas por parte de un adulto responsable de su cuidado:  <?php if($valoracion_juridica['proteccion']){echo $valoracion_juridica['proteccion'];}else{echo "La valoración no ha sido realizada";}?><br>
                  
                   <br><b>Derecho a una vida libre de violencia y a la integridad personal</b><br>
                   Ha presenciado o ha sido víctima de violencia física, verbal o psicológica:  <?php if($valoracion_juridica['violencia']){echo $valoracion_juridica['violencia'];}else{echo "La valoración no ha sido realizada";}?> <br>
                   
                   <br><b> Derecho a la protección de la salud y a la seguridad social:</b> <br>
                   Cuenta con servicio médico de seguro social o seguro popular: <?php if($valoracion_juridica['servicio_med']){echo $valoracion_juridica['servicio_med'];}else{echo "La valoración no ha sido realizada";}?><br>
                   Muestra una nutrición adecuada (Notoriamente visibles): <?php if($valoracion_juridica['nutricion']){echo $valoracion_juridica['nutricion'];}else{echo "La valoración no ha sido realizada";}?><br><br>
                   Asiste a revisión médica periódica:<?php if($valoracion_juridica['revision_med']){echo $valoracion_juridica['revision_med'];}else{echo "La valoración no ha sido realizada";}?><br> <br>
                   Cuenta con cartilla de vacunación: <?php if($valoracion_juridica['cartilla']){echo $valoracion_juridica['cartilla'];}else{echo "La valoración no ha sido realizada";}?><br><br>
                   En caso de que se le haya detectado alguna enfermedad, ¿Se le brinda el tratamiento adecuado?: <?php echo $valoracion_juridica['tratamiento_enf']?> <?php if($valoracion_juridica['tratamiento_enf']){echo $valoracion_juridica['tratamiento_enf'];}else{echo "La valoración no ha sido realizada";}?> <br>

                   <br> <b>Derecho a la inclusión de NNA con discapacidad </b><br>
                   En caso de vivir con alguna discapacidad y requerir atención médica y/o aditamento la NNA ¿La recibe?:   <?php if($valoracion_juridica['atencion_discr']){echo $valoracion_juridica['atencion_discr'];}else{echo "La valoración no ha sido realizada";}?><br>

                   <br> <b>Derecho a la educación</b>  <br>
                  <b> Se encuentra inscrito en la escuela: </b> <?php if($valoracion_juridica['inscrito_esc']){echo $valoracion_juridica['inscrito_esc'];}else{echo "La valoración no ha sido realizada";}?><br>
                   <b>Asiste regularmente a la escuela:</b>  <?php if($valoracion_juridica['asiste_reg']){echo $valoracion_juridica['asiste_reg'];}else{echo "La valoración no ha sido realizada";}?><br>
                  <b> Duerme las horas adecuadas a su edad:  </b><?php if($valoracion_juridica['duerme']){echo $valoracion_juridica['duerme'];}else{echo "La valoración no ha sido realizada";}?><br>
                 <b>  Realiza actividades de esparcimiento:</b><?php if($valoracion_juridica['act_esparcimiento']){echo $valoracion_juridica['act_esparcimiento'];}else{echo "La valoración no ha sido realizada";}?> <br>

                   <br> <b>Derecho a la intimidad</b> <br>
                   Goza de su derecho a la intimidad: <?php if($valoracion_juridica['intimidad']){echo $valoracion_juridica['intimidad'];}else{echo "La valoración no ha sido realizada";}?><br> <br>
                   ¿El derecho a que no se divulguen datos personales sin su consentimiento ha sido salvaguardado?: <?php if($valoracion_juridica['privacidad']){echo $valoracion_juridica['privacidad'];}else{echo "La valoración no ha sido realizada";}?><br>
       
                  <br><b> ¿Se ha considerado la opinión del NNA? </b> <br>
                  <?php if($valoracion_juridica['opinion_n']){echo $valoracion_juridica['opinion_n'];}else{echo "La valoración no ha sido realizada";}?><br>
                  <br><b>  Acercarcamiento con familiares </b> <br>
                  ¿Se ha tenido acercamiento con el familiar?
                  <?php if($valoracion_juridica['accion']){echo $valoracion_juridica['accion'];}else{echo "La valoración no ha sido realizada";}?><br>
                  <br><label>Plan de restitución. </label> <br>
                  <?php
                        foreach ($plan as $p) {
                            echo "- ".$p->descripcion. "    --fecha: ".$p->fecha_val_p;
                        ?>
                  <br>
                  <?php 
                        }
                   ?>  
                 
                 <br> <label>Acuerdo de integrarías. </label><br>
                 <?php
                        foreach ($recomendaciones as $r) {
                            echo "- ".$r->recomendacion. "  -- fecha: ".$r->fecha_val;
                        ?>
                  <br>
                  <?php 
                        }
                   ?>

                  </p><br>
                  <label>VALORACIÓN DE TRABAJO SOCIAL </label><br/>
                  <label>Visita domiciliaria</label>
                  <p>
                  Encargado de realizar la valoración: <?php if($estudio_s['nombre_r']){ echo $estudio_s['nombre_r'];} else { echo "La valoración no ha sido realizada";}?><br>
                  Nombre del Entrevistado: <?php if($estudio_s['nombre_e']){ echo $estudio_s['nombre_e'];}else { echo "La valoración no ha sido realizada";}?><br>
                  Pariente: <?php if($estudio_s['pariente']){echo $estudio_s['pariente'];}else {echo "La valoración no ha sido realizada";} ?><br>
                  Edad: <?php if($estudio_s['edad']){echo $estudio_s['edad'];}else{echo "La valoración no ha sido realizada";}?><br>
                  Domicilio: <?php if($estudio_s['domicilio']){echo $estudio_s['domicilio'];}else{echo "La valoración no ha sido realizada";}?><br>
                  Antecedentes del caso: <?php if( $estudio_s['antec_caso']){echo $estudio_s['antec_caso'];}else{echo "La valoración no ha sido realizada";} ?><br>
                  Escolaridad: <?php if($estudio_s['escol']){echo $estudio_s['escol'];}else{echo "La valoración no ha sido realizada";}?><br>
                  Ocupación: <?php if($estudio_s['ocupacion']){echo $estudio_s['ocupacion'];}else{echo "La valoración no ha sido realizada";} ?><br>
                  Enfermedades: <?php if($estudio_s['p_enfer']){echo $estudio_s['p_enfer'];}else{echo "La valoración no ha sido realizada";} ?><br>
                  Antecedentes penales:<?php if($estudio_s['antec_penal']){ echo $estudio_s['antec_penal'];}else{echo "La valoración no ha sido realizada";}?><br>
                  Adicciones: <?php if($estudio_s['adiccion']){echo $estudio_s['adiccion'];}else{echo "La valoración no ha sido realizada";}?><br>
                  Materiales: <?php if($estudio_s['materiales']){echo $estudio_s['materiales'];}else{echo "La valoración no ha sido realizada";}?><br>
                  Diágnostico: <?php if($estudio_s['diagnostico']){ echo $estudio_s['diagnostico'];}else{echo "La valoración no ha sido realizada";}?>
                  </p>
                  <label>Estudio socieconómico</label>
                  <p>
                  Situación económica: <?php if($estudio_s['situacion_e']){ echo $estudio_s['situacion_e'];}else{echo "El estudio no ha sido realizado";}?><br>
                  Gastos en agua: <?php if($estudio_s['agua']){echo '$'.$estudio_s['agua'];}else{echo "El estudio no ha sido realizado";}?><br>
                  Gastos en luz: <?php if($estudio_s['luz']){echo '$'.$estudio_s['luz'];}else{echo "El estudio no ha sido realizado";}?><br>
                  Gastos en alimentos: <?php if($estudio_s['alimentos']){echo '$'.$estudio_s['alimentos'];}else{echo "El estudio no ha sido realizado";}?><br>
                  Gastos en transporte: <?php if($estudio_s['transporte']){echo '$'.$estudio_s['transporte'];}else{echo "El estudio no ha sido realizado";}?><br>
                  Gastos en telefono: <?php if($estudio_s['tel']){echo '$'.$estudio_s['tel'];}else{echo "El estudio no ha sido realizado";}?><br>
                  Gastos médicos: <?php if($estudio_s['g_medicos']){echo '$'.$estudio_s['g_medicos'];}else{echo "El estudio no ha sido realizado";}?><br>
                  Total ingreso: <?php if($estudio_s['tot_i']){echo '$'.$estudio_s['tot_i'];}else{echo "El estudio no ha sido realizado";}?><br>  
                  Total egreso: <?php if($estudio_s['tot_e']){echo '$'.$estudio_s['tot_e'];}else{echo "El estudio no ha sido realizado";}?><br>
                  Bienes: <?php if( $estudio_s['bienes_i']){echo $estudio_s['bienes_i'];}else{echo "El estudio no ha sido realizado";}?><br>
                  Nivel: <?php if($estudio_s['nivel_s']){echo $estudio_s['nivel_s'];}else{echo "El estudio no ha sido realizado";}?><br>  
                  Clase: <?php if( $estudio_s['clase']){echo $estudio_s['clase'];}else{echo "El estudio no ha sido realizado";}?><br>                  
                  </p>
                  <label>Observación General de la Visita</label> 
                  <p>
                  <?php if( $estudio_s['observacion_ge']){echo $estudio_s['observacion_ge'];}else{echo "El estudio no ha sido realizado";}?><br>
                  </p>
                        <div class="row">
                <!-- APERTURA -->
               
				<?php 
				 if($imagenes_visitad){
					$contador  = 0;
					$cierre = true;
					foreach ($imagenes_visitad as $i){
						if($contador==0){
							echo '<div class="row">';
							$cierre = true;
						}
          ?> 
                   <div class="col-md-4">
                   <div class="thumbnail">
                     <img src="<?php echo $this->Modelo_proyecto->valida_archivo($i->nombre_archivo); ?>" class="img-thumbnail">
                     <div class="caption">
                       <center>
                       <p><a href="" class="btn btn-danger" role="button"><span class="glyphicon glyphicon-trash"></span> Eliminar</a></p>
                      </center>
                       </div>
                   </div>
                  </div>    
				<?php 
				$contador ++;
				if($contador == 3){
					echo "</div>";
					$contador = 0;
					$cierre = false;
						}
					}
					if($cierre){
						echo "</div>";
					}
				 }
				?>
      </div>       
                  </p>




                  <p></p>
              </div>
            </div>
          </div>

           <div class="col-md-12">
            <div class="well well-sm">
              <div class="panel-body" >
                <h4 align="center"><b>FAMILIARES</h4><br>
                    <table class="table table-bordered" align="center">
                        <thead>
                          <tr> 
                            <th>Nombre familiar</th>
                            <th>Género</th>
                            <th>Fecha nacimiento</th>
                            <th>Parentesco</th>
                          </tr>
                        </thead>
                      <tbody>
                        <?php
                        foreach ($familiar as $f) {

                        ?>
                          <tr>
                            <td><?php echo $f->nombre_f; ?> <?php echo $f->apellido_pf; ?> <?php echo $f->apellido_mf; ?></td>
                            <td><?php echo $f->genero_f; ?></td>
                            <td><?php $naf_fecha = $f->fecha_naf;
                            //var_dump($naf_fecha);
                            $dia = substr($naf_fecha,8,2);
                            $mes = substr($naf_fecha,5,2);
                            $anio = substr($naf_fecha,0,4);
                            $fecha_fa = $dia."/".$mes."/".$anio;
                            echo $fecha_fa;
                            //var_dump($fecha_fa);
                            ?></td>
                            <td><?php echo $f->relacion; ?></td>
                          </tr>
                        <?php
                        }
                         ?>
                      </tbody>
                    </table>
              </div>
            </div>
          </div>

           <div class="col-md-12">
            <div class="well well-sm">
              <div class="panel-body" >
                <h4 align="center"><b>PENSIONES</b></h4><br>
                    <table class="table table-bordered">
                        <thead>
                          <tr> 
                            <th>Cuaderno</th>
                            <th>Familiar</th>
                            <th>Fecha de deposito</th>
                            <th>Monto inicial</th>
                            <th>Monto retirado</th>
                            <th>Monto final</th>
                          </tr>
                        </thead>
                      <tbody>
                        <?php
                        foreach ($pensiones as $p) {
 
                        ?>
                          <tr>
                            <td><?php echo $p->cuaderno; ?></td>
                            <td><?php echo $p->nombre_f; ?> <?php echo $p->apellido_pf; ?> <?php echo $p->apellido_mf; ?></td>
                            <td><?php $date_pen=$p->fecha_pension; 
                            //var_dump($date_pen);
                            $dia = substr($date_pen,8,2);
                            $mes = substr($date_pen,5,2);
                            $anio = substr($date_pen,0,4);
                            $fecha_pen = $dia."/".$mes."/".$anio;
                            echo $fecha_pen;
                            //var_dump($fecha_pen);
                            ?> </td>
                            <td><center>$<?php echo $p->monto; ?> </td>
                            <td><center>$
                            
                            
                            <?php 
                            $r=$p->retiro;
                            $m=$p->monto_final;
                            if(($r)>($m)){
                                 echo 0;
                            }else{
                              echo $p->retiro;
                            } ?>
                            
                            
                             </td>
                            <td><center>$
                            <?php 
                            echo $p->monto_final;
                            ?>
                            </td>
                          </tr>
                        <?php
                        }
                         ?>
                      </tbody>
                    </table>


              </div>
            </div>
          </div>
        </div>
        
       
      </form>
     
</div>