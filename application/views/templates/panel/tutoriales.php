

<br><br><br><br><br>
<center><h1 style="background-color: white" border="2" class="page-header text-success">Videos tutoriales</h1></center>
    <div class="col-md-12">

           
        <div class="col-md-4">
        </div>
            <div class="col-md-4 well">
            <center>
                <label class="badge"> Seleccione un privilegio para mostrar. </label>
                <select name="select_video" id="id_video" class="form-control select2" style="width: 100%;" onchange="videos(this.value)">    <option value="">Seleccione: </option>
                                                
                                                <?php foreach ($privilegios as $p ){ 
                
                                                    ?> <option value="<?php echo $p->id_privilegio;?>"> <?php echo  $p->nombre_privilegio;?> </option>
                                            <?php
                                                }    
                                                ?>
                                            </select>
        </div>
    <div class="col-md-4">
      </div>
    </div>

 
      <hr>

      <div class="container">
      <!-- Example row of columns -->
       <div class="row">
            <div class="col-md-12 well" >
            <div class="panel-header" id="videos_p"> <p align="center" class=" bg-success text-success"><b>Video tutorial!</b> </p></div>
            
            </div>
       </div>
    </div>
<script>
    $(document).ready(function(e){
	
    });
    function videos(val){
        switch(val){
           
            case "1"://Asistencia jurídica
                $("#videos_p").empty();
                $("#videos_p").append('<div class="col-md-12">');
                $("#videos_p").append('<video width=1140  height=580 align="center" src="<?=base_url();?>assets/tutoriales/Asistenciajuridica.mp4" controls poster="<?=base_url();?>assets/tutoriales/privilegios_mini/1_as.png" >');
                
                $("#videos_p").append('</video>');
                $("#videos_p").trigger('create');
                break;
            case "2": //Trabajo social
                $("#videos_p").empty(); 
                $("#videos_p").append('<div class="col-md-12">');
                $("#videos_p").append('<video width=1140  height=580 align="center" src="<?=base_url();?>assets/tutoriales/Tutorial_Trabajo_Social.mp4" controls poster="<?=base_url();?>assets/tutoriales/privilegios_mini/2_ts.png" >');
                
                $("#videos_p").append('</video>');
                $("#videos_p").trigger('create');
                break;
            case "3"://Abogado
                $("#videos_p").empty(); 
                $("#videos_p").append('<div class="col-md-12">');
                $("#videos_p").append('<video width=1140  height=580 align="center" src="<?=base_url();?>assets/tutoriales/Abogado.mp4" controls poster="<?=base_url();?>assets/tutoriales/privilegios_mini/3_abgd.png" >');
                
                $("#videos_p").append('</video>');
                $("#videos_p").trigger('create');
                break;
            case "4"://Psicología
                $("#videos_p").empty();
                $("#videos_p").append('<div class="col-md-12">');
                $("#videos_p").append('<video width=1140  height=580 align="center" src="<?=base_url();?>assets/tutoriales/Tutorial_Psicología.mp4" controls poster="<?=base_url();?>assets/tutoriales/privilegios_mini/4_psicologia.png">');
                
                $("#videos_p").append('</video>');
                $("#videos_p").trigger('create');
                break;
            case "5"://Psicología
                $("#videos_p").empty();
                $("#videos_p").append('<div class="col-md-12">');
                $("#videos_p").append('<video width=1140  height=580 align="center" src="<?=base_url();?>assets/tutoriales/Medico.mp4" controls poster="<?=base_url();?>assets/tutoriales/privilegios_mini/5_medicina.png">');
                
                $("#videos_p").append('</video>');
                $("#videos_p").trigger('create');
                break;
            case "6"://Nutriología
                $("#videos_p").empty();
                $("#videos_p").append('<div class="col-md-12">');
                $("#videos_p").append('<video width=1140  height=580 align="center" src="<?=base_url();?>assets/tutoriales/Tutorial_Nitriología.mp4" controls poster="<?=base_url();?>assets/tutoriales/privilegios_mini/6_nutriologia.png">');
                
                $("#videos_p").append('</video>');
                $("#videos_p").trigger('create');
                break;
         case "7"://Pedagogía
                $("#videos_p").empty();
                $("#videos_p").append('<div class="col-md-12">');
                $("#videos_p").append('<video width=1140  height=580 align="center" src="<?=base_url();?>assets/tutoriales/Pedagogía.mp4"  controls poster="<?=base_url();?>assets/tutoriales/privilegios_mini/7_pedagpogia.png">');
                
                $("#videos_p").append('</video>');
                $("#videos_p").trigger('create');
                break;
         case "8"://Proetccion gral etc
                $("#videos_p").empty();
                $("#videos_p").append('<div class="col-md-12">');
                $("#videos_p").append('<video width=1140  height=580 align="center" src="<?=base_url();?>assets/tutoriales/Tutorial_Dirección_General.mp4" controls poster="<?=base_url();?>assets/tutoriales/privilegios_mini/8_otros.png">');
                
                $("#videos_p").append('</video>');
                $("#videos_p").trigger('create');
                break;
        case "9"://Proetccion gral etc
                $("#videos_p").empty();
                $("#videos_p").append('<div class="col-md-12">');
                $("#videos_p").append('<video width=1140  height=580 align="center" src="<?=base_url();?>assets/tutoriales/Tutorial_Dirección_General.mp4" controls poster="<?=base_url();?>assets/tutoriales/privilegios_mini/8_otros.png">');
                
                $("#videos_p").append('</video>');
                $("#videos_p").trigger('create');
                break;
         case "10"://Proetccion gral etc
                 $("#videos_p").empty();
                $("#videos_p").append('<div class="col-md-12">');
                $("#videos_p").append('<video width=1140  height=580 align="center" src="<?=base_url();?>assets/tutoriales/Tutorial_Dirección_General.mp4" controls poster="<?=base_url();?>assets/tutoriales/privilegios_mini/8_otros.png">');
                
                $("#videos_p").append('</video>');
                $("#videos_p").trigger('create');
                break;
        case "11"://Proetccion gral etc
                $("#videos_p").empty();
                $("#videos_p").append('<div class="col-md-12">');
                $("#videos_p").append('<video width=1140  height=580 align="center" src="<?=base_url();?>assets/tutoriales/Tutorial_Dirección_General.mp4" controls poster="<?=base_url();?>assets/tutoriales/privilegios_mini/8_otros.png">');
                
                $("#videos_p").append('</video>');
                $("#videos_p").trigger('create');
                break;
        case "12"://Proetccion gral etc
                $("#videos_p").empty();
                $("#videos_p").append('<div class="col-md-12">');
                $("#videos_p").append('<video width=1140  height=580 align="center" src="<?=base_url();?>assets/tutoriales/Tutorial_Dirección_General.mp4" controls poster="<?=base_url();?>assets/tutoriales/privilegios_mini/8_otros.png">');
                
                $("#videos_p").append('</video>');
                $("#videos_p").trigger('create');
                break;
       case "13"://Proetccion gral etc
               $("#videos_p").empty();
                $("#videos_p").append('<div class="col-md-12">');
                $("#videos_p").append('<video width=1140  height=580 align="center" src="<?=base_url();?>assets/tutoriales/Tutorial_Dirección_General.mp4" controls poster="<?=base_url();?>assets/tutoriales/privilegios_mini/8_otros.png">');
                
                $("#videos_p").append('</video>');
                $("#videos_p").trigger('create');
                break;
        
        }
    }
</script>