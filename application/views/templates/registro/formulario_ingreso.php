<br><br><br><br><br>

    <div class="col-md-6">
          <!--<h2>Crear una nueva cuenta</h2>-->
          
            <ul>
            <center><img width="500" height="300" src="<?php echo base_url();?>assets/img/dif.png"></img></center>
            </ul>
    </div>

    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-md-6">
          <h2>Ingresa tus datos: </h2>
           <?php
           $atributos = array('class' => 'form-horizontal');
           echo form_open('proyecto',$atributos)
            ?>
            <br>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Correo electrónico</label>
                <div class="col-sm-6 form-group ">
                  <input type="email" class="form-control" id="inputEmail3" name="usuario" placeholder="Email">
                  <?php echo form_error('usuario'); ?>
                </div>
              </div>
              <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Contraseña</label>
                <div class="form-inline">
                      <input type="password" class="form-control" id="password" name="contrasena" placeholder="Password">
                      <?php echo form_error('contrasena'); ?>
                          <button class="btn btn-success" type="button" onclick="mostrarContrasena()"> <span id="span"  class="glyphicon glyphicon-eye-open"></span></button>
                  </div>
                 <?php
                 if($error){
                 ?>
                  <div class="alert alert-danger alert-dismissible fade in" role=alert>
                    <button type=button class=close data-dismiss=alert aria-label=Close>
                      <span aria-hidden=true>&times;</span>
                        </button> <strong>Error:</strong> El usuario o contraseña no están registrados.
                  </div>
                 <?php
                  }
                 ?>
                
              </div>
              <?php
               // echo phpversion();
              ?>
         
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-5">
                <br>
                  <center><button type="submit" class="btn btn-success" name="formulario">Ingresar</button>
                </div>
              </div>
            </form>
        </div>
        
      </div>
      <hr>

      <script>
      //Funcion para mostrat y ocultar contraseña
        function mostrarContrasena(){
            var tipo = document.getElementById("password");
            //var span = document.getElementById("span");
            //alert(tipo);
            if(tipo.type == "password"){
                tipo.type = "text";
                document.getElementById("span").className = "glyphicon glyphicon-eye-close";
            }else{
                tipo.type = "password";
                document.getElementById("span").className = "glyphicon glyphicon-eye-open";
            }
        }
</script>
