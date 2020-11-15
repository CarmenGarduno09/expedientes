<?php
class Modelo_proyecto extends CI_Model{
	function __construct(){
		parent:: __construct();
		$this->load->database();
		$this->load->library('session');
		$this->load->helper('string');
		$this->load->library('upload');
		$this->load->helper('file');
		//$this->load->library('email');
		$this->load->helper('url');
		$this->load->helper('date');
		$this->load->helper('text');
	}

	function insertar_persona($data){
		$this->db->insert('persona',$data);
		return $this->db->insert_id();
	}

	function insertar_incidencia_expediente($data){
		$this->db->insert('expediente_incidencia',$data);
		return $this->db->insert_id();
	}

    function insertar_centro($data){
		$this->db->insert('centro_asistencia',$data);
		return $this->db->insert_id();
	}

    function insertar_expeinci($data){
		$this->db->insert('expediente_incidencia',$data);
		return $this->db->insert_id();
    }
    
    //valoración jurídica.
    function devuelve_expedientes_valoracion_juridica($bus,$id_persona){
       
        $data  = $this->datos_sesion();
    if (empty($bus)) {
    $this->db->select('ex.*, ce.*, ig.*, us.*, eq.*, pr.*');
    $this->db->from('expediente_nino ex');
    $this->db->join('centro_asistencia as ce','ce.id_centro = ex.id_centro');
    $this->db->join('ingreso_nino as ig','ig.id_ingreso = ex.id_ingreso');
    $this->db->join('equipos as eq','eq.fk_expediente = ex.id_expediente');
    $this->db->join('usuario as us','us.id_persona = eq.id_persona');
    $this->db->join('privilegio as pr','pr.id_privilegio = us.id_privilegio');
    $this->db->where('pr.id_privilegio', '3');
    $this->db->where('ex.estatus_val_jur', '1');
    $this->db->where('eq.id_persona', $id_persona);
    $this->db->order_by('fecha_ingreso DESC');

    
        }else{
    $this->db->select('ex.*, ce.*, ig.*, us.*, eq.*, pr.*');
    $this->db->from('expediente_nino ex');
    $this->db->join('centro_asistencia as ce','ce.id_centro = ex.id_centro');
    $this->db->join('ingreso_nino as ig','ig.id_ingreso = ex.id_ingreso');
    $this->db->join('equipos as eq','eq.fk_expediente = ex.id_expediente');
    $this->db->join('usuario as us','us.id_persona = eq.id_persona');
    $this->db->join('privilegio as pr','pr.id_privilegio = us.id_privilegio');
    $this->db->where('pr.id_privilegio', '3');
    $this->db->where('ex.estatus_val_jur', '1');
    $this->db->where('eq.id_persona', $id_persona);
    $this->db->order_by('fecha_ingreso DESC');


    $this->db->like('nombre_centro',$bus);
    $this->db->or_like('nombres_nino',$bus);
    $this->db->or_like('apellido_pnino',$bus);
    $this->db->or_like('apellido_mnino',$bus);
    $this->db->or_like('fecha_nnino',$bus);
    $this->db->or_like('fecha_ingreso',$bus);
    $this->db->or_like('genero_nino',$bus);
    $this->db->or_like('motivos_ingreso',$bus);
    $this->db->or_like('no_carpeta',$bus);
    $this->db->or_like('no_expediente',$bus);
    $this->db->group_by('ex.id_expediente');
    }
       $query=$this->db->get();
       return $query->result();

    }

    //Actualiza estatu de valoracion jurudica 
    function actualiza_estatus_val_jur($id_exp,$estatus){
        $this->db->where('id_expediente',$id_exp);
        $this->db->update('expediente_nino',$estatus);

    }
    function actualiza_estatus_vmedico($id_exp,$estatus){
        $this->db->where('id_expediente',$id_exp);
        $this->db->update('expediente_nino',$estatus);
    }


    //obtienee las recomendaciones de l menor recomendaciones 
    function datos_recomendacion($id_expediente){
        $this->db->select('*');
        $this->db->from('recomendaciones_adulto');
        $this->db->where('fk_expediente',$id_expediente);

        $query=$this->db->get();
        return $query->result();
    }

    //obtienee el plan de restitución del menor. 
    function datos_plan($id_expediente){
        $this->db->select('*');
        $this->db->from('plan_restitucion');
        $this->db->where('fk_expediente',$id_expediente);

        $query=$this->db->get();
        return $query->result();
    }

    //actualiza la valoracion juridica 
     function actualizar_valoracion_juridica($data,$id_exp){
        $this->db->where('fk_expediente', $id_exp);
		$this->db->update('valoracion_juridica', $data);
     }
     //actualiza la valoración médica 
     function actualiza_vmedico($data,$id_valmedica){
        $this->db->where('id_valmedica', $id_valmedica);
		$this->db->update('valoracion_medica',$data);
     }

	function insertar_equipo($data){
		$this->db->insert('equipos',$data);
		return $this->db->insert_id();
    }

      //Inserta la imagen en la carpeta
      function update_imagen($campo,$id_aspirante){
        if($_FILES [$campo]['name']){
            $nombre_imagen = $_FILES [$campo]['name'];
            echo $nombre_imagen;
            $config['upload_path'] = "uploadt/"; 
            $config['allowed_types'] = "gif|jpg|png|pdf";
            $config['max_size'] = "20000";         
           $config['max_width'] = "1024";               
           $config['max_height'] = "768";  
            $this->upload->initialize($config);
            if($this->upload->do_upload($campo)){
                return $nombre_imagen;
            }else{
                $this->session->set_flashdata('mensaje_error',$this->upload->display_errors());
                return false;
            }
        }else{
            return false;
        }
    }

    //Actualiza la imagen del menor 
    function actualiza_img_perfil($data,$id_ingreso){
        $this->db->where('id_ingreso',$id_ingreso);
        $this->db->update('ingreso_nino',$data);
    }

	function insertar_usuario($data){
		$this->db->insert('usuario',$data);
		return $this->db->insert_id();
	}

	function valida_usuario($data){
		$this->db->select('u.*, count(*) AS total, p.*, pe.*');
		$this->db->from('usuario u');
		$this->db->join('privilegio as p','p.id_privilegio = u.id_privilegio','left');
		$this->db->join('persona as pe','pe.id_persona = u.id_persona');
		$this->db->where('u.usuario',$data['usuario']);
		$this->db->where('u.contrasena',$data['contrasena']);
		$this->db->where('u.activo','1');
		$this->db->group_by('u.id_usuario');

		$query = $this->db->get();
		return $query->row_array();
	}


	//---- Privilegios
	function devuelve_privilegios(){
		$query = $this->db->get('privilegio');
		return $query->result();
	}

	function devuelve_casap(){
		$query = $this->db->get('centro_asistencia');
		return $query->result();
	}

	function devuelve_priv(){
		$this->db->select('*');
		$this->db->from('privilegio');  

		$query = $this->db->get();
		return $query->result();
	}

	function inserta_privilegio($data){
		$this->db->insert('privilegio',$data);
	}

	function insertar_pertenencia($data){
		$this->db->insert('pertenencias',$data);
		return $this->db->insert_id();
	}

	function insertar_valoracion_pedagoga($data){
		$this->db->insert('valoracion_pedagogica',$data);
		return $this->db->insert_id();
	}

	function insertar_valoracion_nutriologa($data){
		$this->db->insert('valoracion_nutriologica',$data);
		return $this->db->insert_id();
	}

	function insertar_valoracion_psicologia($data){
		$this->db->insert('valoracion_psicologica',$data);
		return $this->db->insert_id();
	}

	function inserta_equipo($data){
		$this->db->insert('equipo',$data);
	}

	function datos_privilegio($data){
		$this->db->select('*');
		$this->db->from('privilegio');
		$this->db->where('id_privilegio',$data);

		$query = $this->db->get();
		return $query->row_array();
	}

	function datos_ingreso2($data){
		$this->db->select('*');
		$this->db->from('ingreso_nino');
		$this->db->where('id_ingreso',$data);

		$query = $this->db->get();
		return $query->row_array();
	}

	function actualiza_privilegio($id_privilegio,$data){
		$this->db->where('id_privilegio', $id_privilegio);
		$this->db->update('privilegio', $data);
	}

    function trae_privilegios(){
        $this->db->select('*');
        $this->db->from('privilegio');
        $this->db->order_by('nombre_privilegio ASC');

        $query=$this->db->get();
        return $query->result();

    }

	//---- Manejo de sesiones
		function crear_sesion($data){
		if(!empty($data)){
			$sesion = array(
				   'nombre'  => $data['nombre'],
                   'privilegio'  => $data['privilegio'],
                   'id_privilegio'  => $data['id_privilegio'],
                   'id_usuario'  => $data['id_usuario'],
                   'id_persona'  => $data['id_persona'],
                   'logged_in' => TRUE
				);


			$this->session->set_userdata($sesion);
			return true;
		}else{
			return false;
		}
	    }

	function valida_sesion(){
		//die(var_dump($this->session->userdata('logged_in')));
		if(!$this->session->userdata('logged_in'))
			header('Location: index');
	}

	function destruye_sesion(){
		$this->session->sess_destroy();
		header('Location: index');
	}

	function datos_sesion(){
		$data = array(
			'nombre' => $this->session->userdata('nombre'),
			'id_usuario' => $this->session->userdata('id_usuario'),
			'nombre_privilegio' => $this->session->userdata('privilegio'),
			'id_privilegio' => $this->session->userdata('id_privilegio'),
			'id_persona' => $this->session->userdata('id_persona'),
			'logged_in' => $this->session->userdata('logged_in')
		);

		return $data;
	}

	function Estar_aqui(){
		$data = $this->datos_sesion();
		$actual = $this->uri->segment(2);
		$resultado = $this->cumpara_url($data,$actual);
		//die(var_dump($resultado));
		if($resultado->total==1){
			return true;
		}else{
			if($this->datos_session->logged_in==true)
				header('Location:'.base_url('index.php/proyecto/error').'');
			else
			header('Location:'.base_url('index.php').'');
		}

	}

	function cumpara_url($data,$actual){
		$this->db->select('s.*, count(*) AS total, p.*');
		$this->db->from('seccion s');
		$this->db->join('privilegio_seccion as p','p.id_seccion = s.id_seccion','left');
		$this->db->where('p.id_privilegio',$data['id_privilegio']);
		$this->db->where('p.menu','1');
		$this->db->where('s.url',$actual);
		$this->db->group_by('s.id_seccion');

		$query = $this->db->get();
		return $query->row();

	}

	//-- menu ----
	function datos_menu(){
		$data = $this->datos_sesion();
		$this->db->select('s.*, p.*');
		$this->db->from('seccion s');
		$this->db->join('privilegio_seccion as p','p.id_seccion = s.id_seccion','left');
		$this->db->where('p.id_privilegio',$data['id_privilegio']);
		$this->db->where('s.activo','1');
		$query = $this->db->get();
		return $query->result();
	}

	function devuelve_area(){
		$this->db->select('*');
		$this->db->from('privilegio');
		$this->db->where('privilegio.id_privilegio !=','1');

		$query = $this->db->get();
		return $query->result();
	}

	function devuelve_estatus(){
		$query = $this->db->get('estatus');
		return $query->result();
	}

	function devuelve_cambio_estadop(){
		$query = $this->db->get('estado_penal');
		return $query->result();
	}

	function devuelve_pertenecias(){
		$query = $this->db->get('pertenencias');
		return $query->result();
	}

	function devuelve_centro(){
        //$this->db->select('nombre_centro');
        //$this->db->from('centro_asistencia');
        //$this->db->order_by('nombre_centro ASC');
        $query=$this->db->get('centro_asistencia');
		return $query->result();
    }

	function devuelve_ab(){
		$this->db->select('p.*, u.*');
		$this->db->from('usuario u');
		$this->db->join('persona as p','p.id_persona = u.id_persona');

		//$this->db->join('equipos as e','e.integrante2 = p.id_persona');
		$this->db->where('p.id_privilegio','3');
		$this->db->where('p.activop','Activo');
		
		$query = $this->db->get();
		return $query->result();
	}
	

	function devuelve_ts(){
		$this->db->select('p.*, u.*');
		$this->db->from('usuario u');
		$this->db->join('persona as p','p.id_persona = u.id_persona');

		//$this->db->join('equipos as e','e.integrante2 = p.id_persona');
		$this->db->where('p.id_privilegio','2');
		$this->db->where('p.activop','Activo');
		
		$query = $this->db->get();
		return $query->result();
	}

	function devuelve_ps(){
	    $this->db->select('p.*, u.*');
		$this->db->from('usuario u');
		$this->db->join('persona as p','p.id_persona = u.id_persona');
		$this->db->where('p.id_privilegio','4');
		$this->db->where('p.activop','Activo');
		
		$query = $this->db->get();
		return $query->result();
    }

    //FUNCIONES QUE TRAEN LOS DATOS DE AJAX, DE LA PARTE DE ABOGADO
    //Acuerdo de integrarias (al principio eran recomendaciones por eso se quedo asi en el código)
    function obtener_recomendaciones($id_expediente){
        $this->db->select('*');
        $this->db->from('recomendaciones_adulto');
        $this->db->where('recomendaciones_adulto.fk_expediente',$id_expediente);
        $query=$this->db->get();
           return $query->result();
    }
    function insertar_recomendacion_db($data){
        $this->db->insert('recomendaciones_adulto',$data);
        return $this->db->insert_id();
    }

    function eliminar_recomendacion($data){
        $this->db->delete('recomendaciones_adulto',array('id_recomendacion' => $data));
        return true;
    }
    //Plan de restitución. 
    function obtener_plan($id_expediente){
        $this->db->select('*');
        $this->db->from('plan_restitucion');
        $this->db->where('plan_restitucion.fk_expediente',$id_expediente);
        $query=$this->db->get();
           return $query->result();
    }

    function insertar_plan_db($data){
        $this->db->insert('plan_restitucion',$data);
        return $this->db->insert_id();
    }
    
    function eliminar_plan($data){
        $this->db->delete('plan_restitucion',array('id_plan' => $data));
        return true;
    }

    //persona que autoriza
    function obtener_persona($id_expediente){
        $this->db->select('*');
        $this->db->from('autoriza');
        $this->db->where('autoriza.fk_expediente',$id_expediente);
        $query=$this->db->get();
           return $query->result();
    }

    function insertar_personaaut_db($data){
        $this->db->insert('autoriza',$data);
        return $this->db->insert_id();
    }

    function eliminar_persona($data){
        $this->db->delete('autoriza',array('id_autoriza' => $data));
        return true;
    }

    //nuevas recomendaciones 
    function obtener_nuevasrecomendaciones($id_exp,$fecha){
        $this->db->select('*');
        $this->db->from('recomendaciones_adulto');
        $this->db->where('fk_expediente',$id_exp);
        $this->db->where('fecha_val',$fecha);
        $query=$this->db->get();
           return $query->result();
    }

    //nuevos planes 
    function obtener_plannew($id_exp,$fecha){
        $this->db->select('*');
        $this->db->from('plan_restitucion');
        $this->db->where('fk_expediente',$id_exp);
        $this->db->where('fecha_val_p',$fecha);
        $query=$this->db->get();
           return $query->result();
    }

    //nuevas personas 
    function obtener_personanew($id_exp,$fecha){
        $this->db->select('*');
        $this->db->from('autoriza');
        $this->db->where('fk_expediente',$id_exp);
        $this->db->where('fecha',$fecha);
        $query=$this->db->get();
           return $query->result();
    }

    //Traer los datos apra comparar
    function obtener_traerplanes_com($id_exp,$mes,$anio){
        $this->db->select('*');
        $this->db->from('plan_restitucion');
        $this->db->where('fk_expediente',$id_exp);
        $this->db->where('MONTH(fecha_val_p)',$mes);
        $this->db->where('YEAR(fecha_val_p)',$anio); 
        $query=$this->db->get();
        return $query->result();
    }

    function obtener_traeracuerdos_com($id_exp,$mes,$anio){
        $this->db->select('*');
        $this->db->from('recomendaciones_adulto');
        $this->db->where('fk_expediente',$id_exp);
        $this->db->where('MONTH(fecha_val)',$mes);
        $this->db->where('YEAR(fecha_val)',$anio); 
        $query=$this->db->get();
        return $query->result();
    }

    function obtener_traerpersonas_com($id_exp,$mes,$anio){
        $this->db->select('*');
        $this->db->from('autoriza');
        $this->db->where('fk_expediente',$id_exp);
        $this->db->where('MONTH(fecha)',$mes);
        $this->db->where('YEAR(fecha)',$anio); 
        $query=$this->db->get();
        return $query->result();
    }
    
    
    function devuelve_num(){
	    $this->db->select('*');
		$this->db->from('num_equipo');
		
		$query = $this->db->get();
		return $query->result();
	}

function devuelve_ninos_vista($bus, $id_ingreso){
    $data  = $this->datos_sesion();
    if (empty($bus)) {
    $this->db->select('exp.*, ning.*, cen.*, est.*');
    $this->db->from('expediente_nino exp');
    $this->db->join('ingreso_nino as ning','ning.id_ingreso = exp.id_ingreso','left');
    $this->db->join('centro_asistencia as cen','cen.id_centro = exp.id_centro');
    $this->db->join('estado_penal as est','est.id_estadop = exp.id_estadop');
    $this->db->where('exp.id_incidencia_actual', '1');
    $this->db->order_by('fecha_ingreso DESC');      

    }else{
    $this->db->select('exp.*, ning.*, cen.*, est.*');
    $this->db->from('expediente_nino exp');
    $this->db->join('ingreso_nino as ning','ning.id_ingreso = exp.id_ingreso','left');
    $this->db->join('centro_asistencia as cen','cen.id_centro = exp.id_centro');
    $this->db->join('estado_penal as est','est.id_estadop = exp.id_estadop');
    $this->db->where('exp.id_incidencia_actual', '1');
    $this->db->order_by('fecha_ingreso DESC');  

        $this->db->like('nombres_nino',$bus);
        $this->db->or_like('apellido_pnino',$bus);    
        $this->db->or_like('apellido_mnino',$bus);
        $this->db->or_like('genero_nino',$bus);
        $this->db->or_like('lugar_nnino',$bus);
        $this->db->or_like('municipio_origen',$bus);
        $this->db->or_like('fecha_ingreso',$bus);
        $this->db->or_like('motivos_ingreso',$bus);
        $this->db->or_like('no_carpeta',$bus);
        $this->db->or_like('nombre_centro',$bus);
        $this->db->group_by('ning.id_ingreso');
        //$this->db->where('u.id_usuario', $id_usuario);
        }

       $query=$this->db->get();
       return $query->result();
    }
function insertar_familiar($data){
		$this->db->insert('familiares',$data);
		return $this->db->insert_id();
	}

function datos_actividad($id_ingreso){
		 
        $this->db->select('fam.*,nin.*');
        $this->db->from('familiares fam');
        $this->db->join('ingreso_nino as nin','fam.id_ingreso=nin.id_ingreso','inner');
      $this->db->where('nin.id_ingreso',$id_ingreso);
      $this->db->group_by('nin.id_ingreso');
//$this->db->where('nin.ingreso',$data['ingreso']);
        $query=$this->db->get();
        return $query->row_array();
        }

 function devuelve_equipos_vista($bus, $id_equipo){
        $data  = $this->datos_sesion();
        if (empty($bus)) {
        $this->db->select('p.*, u.*,e.*');
		$this->db->from('persona p');
		$this->db->join('usuario as u','p.id_persona = u.id_persona');

		$this->db->join('equipos as e','e.integrante1 = p.id_persona','e.integrante2 = p.id_persona','e.integrante3 = p.id_persona');
        //$this->db->where('p.id_persona',$id_equipo);

        }else{

      	$this->db->select('p.*, u.*,e.*');
		$this->db->from('persona p');
		$this->db->join('usuario as u','p.id_persona = u.id_persona');

		$this->db->join('equipos as e','e.integrante1 = p.id_persona','e.integrante2 = p.id_persona','e.integrante3 = p.id_persona');
		//$this->db->where('p.id_privilegio','3');
		//$this->db->where('p.id_privilegio','2');
		//$this->db->where('p.id_privilegio','4');
        $this->db->or_like('no_equipo',$bus);
        $this->db->or_like('nombres',$bus);  

        $this->db->or_like('apellido_p',$bus);  
        $this->db->or_like('apellido_m',$bus);
       
         $this->db->or_like('activof',$bus);
        $this->db->group_by('e.id_equipo');
        //$this->db->where('u.id_usuario', $id_usuario);
        }

       $query=$this->db->get();
       return $query->result();
    }


	function insertar_ingreso_nino($data){
		$this->db->insert('ingreso_nino',$data);
		return $this->db->insert_id();
	}

	function insertar_expediente($data){
		$this->db->insert('expediente_nino',$data);
		return $this->db->insert_id();
	}

	function actualizar_usu($data){
        $this->db->select('per.*, usu.*');
        $this->db->from('usuario as usu');
        $this->db->join('persona as per','usu.id_persona=per.id_persona');
        $this->db->where('id_usuario',$data);

        $query=$this->db->get();
        return $query->row_array();
    }
    function update_persona($id_persona,$data){

        $this->db->where('id_persona',$id_persona);
        $this->db->update('persona',$data);
        }
          
       function update_usuario($id_usuario,$data){
        $this->db->where('id_usuario',$id_usuario);
        $this->db->update('usuario',$data);        
        //$query=$this->db->get();
    }

            function update_area($id_privilegio,$data){
        $this->db->where('id_privilegio',$id_privilegio);
        $this->db->update('privilegio',$data);        
        //$query=$this->db->get();
    }
           function update_centro($id_centro,$data){
        $this->db->where('id_centro',$id_centro);
        $this->db->update('centro_asistencia',$data);        
        //$query=$this->db->get();
    }


function devuelve_empleados_vista($bus, $id_usuario){
  $data  = $this->datos_sesion();
  if (empty($bus)) {
    $this->db->select('u.*, p.*, pe.*, c.*');
    $this->db->from('persona pe');
	$this->db->join('privilegio as p','p.id_privilegio = pe.id_privilegio','left');
	$this->db->join('usuario as u','pe.id_persona = u.id_persona');
	$this->db->join('centro_asistencia as c','c.id_centro = pe.id_centro','left');
    $this->db->where('pe.id_privilegio !=', '1');
        }else{
    $this->db->select('u.*, p.*, pe.*, c.*');
	$this->db->from('persona pe');
	$this->db->join('privilegio as p','p.id_privilegio = pe.id_privilegio','left');
	$this->db->join('usuario as u','pe.id_persona = u.id_persona');
	$this->db->join('centro_asistencia as c','c.id_centro = pe.id_centro','left');
	$this->db->where('pe.id_privilegio !=', '1');

    $this->db->or_like('nombres',$bus);
    $this->db->or_like('apellido_p',$bus);    
    $this->db->or_like('apellido_m',$bus);
    $this->db->or_like('genero',$bus);
    $this->db->or_like('correo',$bus);
    $this->db->or_like('nombre_centro',$bus);
    $this->db->or_like('nombre_privilegio',$bus);
    $this->db->or_like('activop',$bus);
    $this->db->group_by('u.id_usuario');
        //$this->db->where('u.id_usuario', $id_usuario);
    }

      $query=$this->db->get();
      return $query->result();
  }

function devuelve_centros_vista($bus, $id_centro){
        $data  = $this->datos_sesion();
        if (empty($bus)) {
        $this->db->select('c.*');
		$this->db->from('centro_asistencia c');
        }else{
        $this->db->select('c.*');
		$this->db->from('centro_asistencia c');

        $this->db->or_like('nombre_centro',$bus);
        $this->db->or_like('ubicacion',$bus);
        }

       $query=$this->db->get();
       return $query->result();
    }

  
    //Expedientes
    function devuelve_expedientes_vistabase($bus, $id_expediente){
    $data  = $this->datos_sesion();
   
    if (empty($bus)) {
        $this->db->select('ex.*,ig.*, ep.*, ce.*, in.*, ex.id_expediente AS id_exp');
        //$this->db->select('ex.*, ig.*, ex.id_expediente AS id_exp');
        $this->db->from('expediente_nino ex');
        $this->db->join('centro_asistencia as ce','ce.id_centro = ex.id_centro');
        $this->db->join('ingreso_nino as ig','ig.id_ingreso = ex.id_ingreso');
        $this->db->join('estado_penal as ep','ex.id_estadop = ep.id_estadop');
        $this->db->join('incidencias as in','in.id_incidencia = ex.id_incidencia_actual');
        $this->db->where('ex.id_incidencia_actual', '1');
        $this->db->order_by('fecha_ingreso DESC');

        }else{
    $this->db->select('ex.*, pe.*, ce.*, ep.*, ig.*, eq.*, in.*, ex.id_expediente AS id_exp');
	$this->db->from('expediente_nino ex');
	$this->db->join('centro_asistencia as ce','ce.id_centro = ex.id_centro');
	$this->db->join('estado_penal as ep','ep.id_estadop = ex.id_estadop');
	$this->db->join('ingreso_nino as ig','ig.id_ingreso = ex.id_ingreso');
    $this->db->join('equipos as eq','eq.fk_expediente = ex.id_expediente');
    $this->db->join('incidencias as in','in.id_incidencia = ex.id_incidencia_actual');
    $this->db->join('persona as pe','pe.id_persona = eq.id_persona');
    $this->db->where('ex.id_incidencia_actual', '1');
    $this->db->order_by('fecha_ingreso DESC');

    $this->db->like('nombre_centro',$bus);
    $this->db->or_like('id_equipo',$bus);
    $this->db->or_like('nombre_estado',$bus);    
    $this->db->or_like('no_expediente',$bus);
    $this->db->or_like('nombre_incidencia',$bus);
    $this->db->or_like('nombres_nino',$bus);
    $this->db->or_like('apellido_pnino',$bus);
    $this->db->or_like('apellido_mnino',$bus);
    $this->db->or_like('fecha_nnino',$bus);
    $this->db->or_like('fecha_ingreso',$bus);
    $this->db->or_like('genero_nino',$bus);
    $this->db->or_like('motivos_ingreso',$bus);
    $this->db->or_like('no_carpeta',$bus);
    $this->db->group_by('ex.id_expediente');

    }

       $query=$this->db->get();
       //return $query->num_rows();
       return $query->result();
    }

    function devuelve_trabajadores($id_expediente){
        $this->db->select('eq.*, pe.*');
        $this->db->from('equipos  eq');
        $this->db->join('persona as pe','pe.id_persona=eq.id_persona');
        $this->db->where('fk_expediente', $id_expediente);

        $query= $this->db->get();
        return $query->result();
    }
   
    //Tabla original
    function devuelve_expedientes_vista($bus, $id_expediente){
        $data  = $this->datos_sesion();
        if (empty($bus)) {
        $this->db->select('ex.*, pe.*, ce.*, ep.*, ig.*, eq.*, in.*, ex.id_expediente AS id_exp');
        //$this->db->select('ex.*, ig.*, ex.id_expediente AS id_exp');
        $this->db->from('expediente_nino ex');
        $this->db->join('centro_asistencia as ce','ce.id_centro = ex.id_centro');
        $this->db->join('estado_penal as ep','ep.id_estadop = ex.id_estadop');
        $this->db->join('ingreso_nino as ig','ig.id_ingreso = ex.id_ingreso');
        $this->db->join('equipos as eq','eq.fk_expediente = ex.id_expediente');
        $this->db->join('incidencias as in','in.id_incidencia = ex.id_incidencia_actual');
         $this->db->join('persona as pe','pe.id_persona = eq.id_persona');
        $this->db->where('ex.id_incidencia_actual', '1');
        $this->db->where('ig.id_ingreso = ex.id_ingreso');
    
            }else{
        $this->db->select('ex.*, pe.*, ce.*, ep.*, ig.*, eq.*, in.*, ex.id_expediente AS id_exp');
        $this->db->from('expediente_nino ex');
        $this->db->join('centro_asistencia as ce','ce.id_centro = ex.id_centro');
        $this->db->join('estado_penal as ep','ep.id_estadop = ex.id_estadop');
        $this->db->join('ingreso_nino as ig','ig.id_ingreso = ex.id_ingreso');
        $this->db->join('equipos as eq','eq.fk_expediente = ex.id_expediente');
        $this->db->join('incidencias as in','in.id_incidencia = ex.id_incidencia_actual');
        $this->db->join('persona as pe','pe.id_persona = eq.id_persona');
        $this->db->where('ex.id_incidencia_actual', '1');
    
        $this->db->or_like('nombre_centro',$bus);
        $this->db->or_like('id_equipo',$bus);
        $this->db->or_like('nombre_estado',$bus);    
        $this->db->or_like('no_expediente',$bus);
        $this->db->or_like('nombre_incidencia',$bus);
        $this->db->or_like('nombres_nino',$bus);
        $this->db->or_like('apellido_pnino',$bus);
        $this->db->or_like('apellido_mnino',$bus);
        $this->db->or_like('fecha_nnino',$bus);
        $this->db->or_like('fecha_ingreso',$bus);
        $this->db->or_like('genero_nino',$bus);
        $this->db->or_like('motivos_ingreso',$bus);
        $this->db->or_like('no_carpeta',$bus);
        $this->db->group_by('ex.id_expediente');
    
        }
    
           $query=$this->db->get();
           return $query->result();
        }

    

    function devuelve_expedientes_vista2($bus, $id_expediente){
    $data  = $this->datos_sesion();
    if (empty($bus)) {
    $this->db->select('ex.*, ce.*, ig.*, in.*, ex.id_expediente AS id_exp');
	$this->db->from('expediente_nino ex');
	$this->db->join('centro_asistencia as ce','ce.id_centro = ex.id_centro');
	$this->db->join('ingreso_nino as ig','ig.id_ingreso = ex.id_ingreso');
    $this->db->join('incidencias as in','in.id_incidencia = ex.id_incidencia_actual');
    $this->db->where('id_incidencia_actual','1');
    $this->db->where('no_expediente',' ');
    $this->db->order_by('fecha_ingreso DESC');

        }else{
    $this->db->select('ex.*, ce.*, ig.*, in.*, ex.id_expediente AS id_exp');
	$this->db->from('expediente_nino ex');
	$this->db->join('centro_asistencia as ce','ce.id_centro = ex.id_centro');
	$this->db->join('ingreso_nino as ig','ig.id_ingreso = ex.id_ingreso');
    $this->db->join('incidencias as in','in.id_incidencia = ex.id_incidencia_actual');
    $this->db->where('id_incidencia_actual','1');
    $this->db->where('no_expediente',' ');
    $this->db->order_by('fecha_ingreso DESC');

    $this->db->or_like('nombre_centro',$bus);
    $this->db->or_like('nombre_incidencia',$bus);
    $this->db->or_like('nombres_nino',$bus);
    $this->db->or_like('apellido_pnino',$bus);
    $this->db->or_like('apellido_mnino',$bus);
    $this->db->or_like('fecha_nnino',$bus);
    $this->db->or_like('fecha_ingreso',$bus);
    $this->db->or_like('genero_nino',$bus);
    $this->db->or_like('motivos_ingreso',$bus);
    $this->db->or_like('no_carpeta',$bus);
    $this->db->group_by('ex.id_expediente');
    }
       $query=$this->db->get();
       return $query->result();
    }

    function devuelve_expedientes_para_evaluacion_medica($bus, $id_expediente){
    $data  = $this->datos_sesion();
    if (empty($bus)) {
    $this->db->select('ex.*, ce.*, ig.*');
	$this->db->from('expediente_nino ex');
	$this->db->join('centro_asistencia as ce','ce.id_centro = ex.id_centro');
	$this->db->join('ingreso_nino as ig','ig.id_ingreso = ex.id_ingreso');
    //$this->db->where('ex.id_incidencia_actual','1');
    $this->db->where('ex.estatus_val_med','0');
    $this->db->order_by('fecha_ingreso DESC');

        }else{
    $this->db->select('ex.*, ce.*, ig.*');
	$this->db->from('expediente_nino ex');
	$this->db->join('centro_asistencia as ce','ce.id_centro = ex.id_centro');
	$this->db->join('ingreso_nino as ig','ig.id_ingreso = ex.id_ingreso');
    //$this->db->where('ex.id_incidencia_actual','1');
    $this->db->where('ex.estatus_val_med','0');
    $this->db->order_by('fecha_ingreso DESC');

    $this->db->like('nombre_centro',$bus);
    $this->db->or_like('nombres_nino',$bus);
    $this->db->or_like('apellido_pnino',$bus);
    $this->db->or_like('apellido_mnino',$bus);
    $this->db->or_like('fecha_nnino',$bus);
    $this->db->or_like('fecha_ingreso',$bus);
    $this->db->or_like('genero_nino',$bus);
    $this->db->or_like('motivos_ingreso',$bus);
    $this->db->or_like('no_carpeta',$bus);
    $this->db->or_like('no_expediente',$bus);
    $this->db->group_by('ex.id_expediente');
    }
       $query=$this->db->get();
       return $query->result();
    }

   function  devuelve_expedientes_con_evaluacion_medica($bus,$id_expediente){
    $data  = $this->datos_sesion();
    if (empty($bus)) {
    $this->db->select('ex.*, ce.*, ig.*');
	$this->db->from('expediente_nino ex');
	$this->db->join('centro_asistencia as ce','ce.id_centro = ex.id_centro');
	$this->db->join('ingreso_nino as ig','ig.id_ingreso = ex.id_ingreso');
    //$this->db->where('ex.id_incidencia_actual','1');
    $this->db->where('ex.estatus_val_med','1');
    $this->db->order_by('fecha_ingreso DESC');

        }else{
    $this->db->select('ex.*, ce.*, ig.*');
	$this->db->from('expediente_nino ex');
	$this->db->join('centro_asistencia as ce','ce.id_centro = ex.id_centro');
	$this->db->join('ingreso_nino as ig','ig.id_ingreso = ex.id_ingreso');
    //$this->db->where('ex.id_incidencia_actual','1');
    $this->db->where('ex.estatus_val_med','1');
    $this->db->order_by('fecha_ingreso DESC');

    $this->db->like('nombre_centro',$bus);
    $this->db->or_like('nombres_nino',$bus);
    $this->db->or_like('apellido_pnino',$bus);
    $this->db->or_like('apellido_mnino',$bus);
    $this->db->or_like('fecha_nnino',$bus);
    $this->db->or_like('fecha_ingreso',$bus);
    $this->db->or_like('genero_nino',$bus);
    $this->db->or_like('motivos_ingreso',$bus);
    $this->db->or_like('no_carpeta',$bus);
    $this->db->or_like('no_expediente',$bus);
    $this->db->group_by('ex.id_expediente');
    }
       $query=$this->db->get();
       return $query->result();
   }


   function devuelve_expedientes_usuarios_exclusivos_psicologia($bus,$id_persona){
    $data  = $this->datos_sesion();
    if (empty($bus)) {
    $this->db->select('ex.*, ce.*, ig.*, us.*, eq.*, pr.*, pe.*');
	$this->db->from('expediente_nino ex');
	$this->db->join('centro_asistencia as ce','ce.id_centro = ex.id_centro');
	$this->db->join('ingreso_nino as ig','ig.id_ingreso = ex.id_ingreso');
	$this->db->join('equipos as eq','eq.fk_expediente = ex.id_expediente');
	$this->db->join('usuario as us','us.id_persona = eq.id_persona');
	$this->db->join('privilegio as pr','pr.id_privilegio = us.id_privilegio');
    $this->db->join('persona as pe','pe.id_persona = eq.id_persona');
    $this->db->where('pr.id_privilegio', '4');
    $this->db->where('ex.estatus_val_psi', '0');
    $this->db->where('eq.id_persona', $id_persona);
    $this->db->order_by('fecha_ingreso DESC');
    
        }else{
    $this->db->select('ex.*, ce.*, ig.*, us.*, eq.*, pr.*, pe.*');
	$this->db->from('expediente_nino ex');
	$this->db->join('centro_asistencia as ce','ce.id_centro = ex.id_centro');
	$this->db->join('ingreso_nino as ig','ig.id_ingreso = ex.id_ingreso');
	$this->db->join('equipos as eq','eq.fk_expediente = ex.id_expediente');
	$this->db->join('usuario as us','us.id_persona = eq.id_persona');
	$this->db->join('privilegio as pr','pr.id_privilegio = us.id_privilegio');
    $this->db->join('persona as pe','pe.id_persona = eq.id_persona');
    $this->db->where('pr.id_privilegio', '4');
    $this->db->where('ex.estatus_val_psi', '0');
    $this->db->where('eq.id_persona', $id_persona);
    $this->db->order_by('fecha_ingreso DESC');

    $this->db->like('nombre_centro',$bus);
    $this->db->or_like('nombres_nino',$bus);
    $this->db->or_like('apellido_pnino',$bus);
    $this->db->or_like('apellido_mnino',$bus);
    $this->db->or_like('fecha_nnino',$bus);
    $this->db->or_like('fecha_ingreso',$bus);
    $this->db->or_like('genero_nino',$bus);
    $this->db->or_like('motivos_ingreso',$bus);
    $this->db->or_like('no_carpeta',$bus);
    $this->db->or_like('no_expediente',$bus);
    $this->db->group_by('ex.id_expediente');
    }
       $query=$this->db->get();
       return $query->result();
    }
    
    function devuelve_expedientes_usuarios_exclusivos_abogado($bus,$id_persona){
    $data  = $this->datos_sesion();
    if (empty($bus)) {
    $this->db->select('ex.*, ce.*, ig.*, us.*, eq.*, pr.*');
	$this->db->from('expediente_nino ex');
	$this->db->join('centro_asistencia as ce','ce.id_centro = ex.id_centro');
	$this->db->join('ingreso_nino as ig','ig.id_ingreso = ex.id_ingreso');
	$this->db->join('equipos as eq','eq.fk_expediente = ex.id_expediente');
	$this->db->join('usuario as us','us.id_persona = eq.id_persona');
	$this->db->join('privilegio as pr','pr.id_privilegio = us.id_privilegio');
    $this->db->where('pr.id_privilegio', '3');
    $this->db->where('ex.estatus_val_jur', '0');
    $this->db->where('eq.id_persona', $id_persona);
    $this->db->order_by('fecha_ingreso DESC');

        }else{
    $this->db->select('ex.*, ce.*, ig.*, us.*, eq.*, pr.*');
	$this->db->from('expediente_nino ex');
	$this->db->join('centro_asistencia as ce','ce.id_centro = ex.id_centro');
	$this->db->join('ingreso_nino as ig','ig.id_ingreso = ex.id_ingreso');
	$this->db->join('equipos as eq','eq.fk_expediente = ex.id_expediente');
	$this->db->join('usuario as us','us.id_persona = eq.id_persona');
	$this->db->join('privilegio as pr','pr.id_privilegio = us.id_privilegio');
    $this->db->where('pr.id_privilegio', '3');
    $this->db->where('ex.estatus_val_jur', '0');
    $this->db->where('eq.id_persona', $id_persona);
    $this->db->order_by('fecha_ingreso DESC');

    $this->db->like('nombre_centro',$bus);
    $this->db->or_like('nombres_nino',$bus);
    $this->db->or_like('apellido_pnino',$bus);
    $this->db->or_like('apellido_mnino',$bus); 
    $this->db->or_like('fecha_nnino',$bus);
    $this->db->or_like('fecha_ingreso',$bus);
    $this->db->or_like('genero_nino',$bus);
    $this->db->or_like('motivos_ingreso',$bus);
    $this->db->or_like('no_carpeta',$bus);
    $this->db->or_like('no_expediente',$bus);
    $this->db->group_by('ex.id_expediente');
    }
       $query=$this->db->get();
       return $query->result();
    }


    function devuelve_expedientes_usuarios_exclusivos_trabajos($bus, $id_persona){
    $data  = $this->datos_sesion();
    if (empty($bus)) {
    $this->db->select('ex.*, ce.*, ig.*, us.*, eq.*, pr.*');
	$this->db->from('expediente_nino ex');
	$this->db->join('centro_asistencia as ce','ce.id_centro = ex.id_centro');
	$this->db->join('ingreso_nino as ig','ig.id_ingreso = ex.id_ingreso');
	$this->db->join('equipos as eq','eq.fk_expediente = ex.id_expediente');
	$this->db->join('usuario as us','us.id_persona = eq.id_persona');
	$this->db->join('privilegio as pr','pr.id_privilegio = us.id_privilegio');
    $this->db->where('pr.id_privilegio', '2');
    $this->db->where('ex.estatus_tra_soc', '0');
    $this->db->where('eq.id_persona', $id_persona);
    $this->db->order_by('fecha_ingreso DESC');

        }else{
    $this->db->select('ex.*, ce.*, ig.*, us.*, eq.*, pr.*');
	$this->db->from('expediente_nino ex');
	$this->db->join('centro_asistencia as ce','ce.id_centro = ex.id_centro');
	$this->db->join('ingreso_nino as ig','ig.id_ingreso = ex.id_ingreso');
	$this->db->join('equipos as eq','eq.fk_expediente = ex.id_expediente');
	$this->db->join('usuario as us','us.id_persona = eq.id_persona');
	$this->db->join('privilegio as pr','pr.id_privilegio = us.id_privilegio');
    $this->db->where('pr.id_privilegio', '2');
    $this->db->where('ex.estatus_tra_soc', '0');
    $this->db->where('eq.id_persona', $id_persona);
    $this->db->order_by('fecha_ingreso DESC');

    $this->db->or_like('nombre_centro',$bus);
    $this->db->or_like('nombres_nino',$bus);
    $this->db->or_like('apellido_pnino',$bus);
    $this->db->or_like('apellido_mnino',$bus);
    $this->db->or_like('fecha_nnino',$bus);
    $this->db->or_like('fecha_ingreso',$bus);
    $this->db->or_like('genero_nino',$bus);
    $this->db->or_like('motivos_ingreso',$bus);
    $this->db->or_like('no_carpeta',$bus);
    $this->db->or_like('no_expediente',$bus);
    $this->db->group_by('ex.id_expediente');
    }
       $query=$this->db->get();
       return $query->result();
    }

    function devuelve_expedientes_trabajo_social($bus, $id_persona){
        $data  = $this->datos_sesion();
        if (empty($bus)) {
        $this->db->select('ex.*, ce.*, ig.*, us.*, eq.*, pr.*');
        $this->db->from('expediente_nino ex');
        $this->db->join('centro_asistencia as ce','ce.id_centro = ex.id_centro');
        $this->db->join('ingreso_nino as ig','ig.id_ingreso = ex.id_ingreso');
        $this->db->join('equipos as eq','eq.fk_expediente = ex.id_expediente');
        $this->db->join('usuario as us','us.id_persona = eq.id_persona');
        $this->db->join('privilegio as pr','pr.id_privilegio = us.id_privilegio');
        $this->db->where('pr.id_privilegio', '2');
        $this->db->where('ex.estatus_tra_soc', '1');
        $this->db->where('eq.id_persona', $id_persona);
        $this->db->order_by('fecha_ingreso DESC');

            }else{
        $this->db->select('ex.*, ce.*, ig.*, us.*, eq.*, pr.*');
        $this->db->from('expediente_nino ex');
        $this->db->join('centro_asistencia as ce','ce.id_centro = ex.id_centro');
        $this->db->join('ingreso_nino as ig','ig.id_ingreso = ex.id_ingreso');
        $this->db->join('equipos as eq','eq.fk_expediente = ex.id_expediente');
        $this->db->join('usuario as us','us.id_persona = eq.id_persona');
        $this->db->join('privilegio as pr','pr.id_privilegio = us.id_privilegio');
        $this->db->where('pr.id_privilegio', '2');
        $this->db->where('ex.estatus_tra_soc', '1');
        $this->db->where('eq.id_persona', $id_persona);
        $this->db->order_by('fecha_ingreso DESC');
    
        $this->db->or_like('nombre_centro',$bus);
        $this->db->or_like('nombres_nino',$bus);
        $this->db->or_like('apellido_pnino',$bus);
        $this->db->or_like('apellido_mnino',$bus);
        $this->db->or_like('fecha_nnino',$bus);
        $this->db->or_like('fecha_ingreso',$bus);
        $this->db->or_like('genero_nino',$bus);
        $this->db->or_like('motivos_ingreso',$bus);
        $this->db->or_like('no_carpeta',$bus);
        $this->db->or_like('no_expediente',$bus);
        $this->db->group_by('ex.id_expediente');
        }
           $query=$this->db->get();
           return $query->result();
        }

    function ver_centro($id_centro){
    	 $this->db->select('*');
	  $this->db->from('centro_asistencia');
	    $this->db->where('id_centro',$id_centro);

	    return $this->db->get()->row()->nombre_centro;
		//return $query->result();
    }

    function ver_edad($id_ingreso){
      $this->db->select('fecha_nnino');
	  $this->db->from('ingreso_nino');
	  $this->db->where('id_ingreso',$id_ingreso);

      return $this->db->get()->row()->fecha_nnino;
      
    }

    function ver_montop($id_pension){
      $this->db->select('monto');
	  $this->db->from('pension');
	  $this->db->where('id_pension',$id_pension);

	  return $this->db->get()->row()->monto;
    }

    function ver_retiro($id_pension){
      $this->db->select('retiro');
	  $this->db->from('pension');
	  $this->db->where('id_pension',$id_pension);

	  return $this->db->get()->row()->retiro;
    }

    //Para ver el monto final
    function ver_montof($id_pension){
        $this->db->select('monto_final');
        $this->db->from('pension');
        $this->db->where('id_pension',$id_pension);
  
        return $this->db->get()->row()->monto_final;
    }
    //Para actualizar el monto final. 
    function actualiza_monto_final($data,$id_pension){
        $this->db->where('id_pension',$id_pension);
       $this->db->update('pension',$data);

    }

    function eliminar_pertenencia1($data){
        $this->db->delete('pertenencias',$data);
    }

    function eliminar_pertenencia($id_pertenencia){
		$this->db->delete('pertenencias', $id_pertenencia);
	}

	function devuelve_monto($id_pension){
    $this->db->select('*');
	$this->db->from('pension');
    $this->db->where('id_pension',$id_pension);

	$query = $this->db->get();
	return $query->row_array();	
    }

    function ver_expedientes2($id_expediente){
    $this->db->select('ex.*, ce.*, ig.*, in.*, ep.*');
	$this->db->from('expediente_nino ex');
	$this->db->join('centro_asistencia as ce','ce.id_centro = ex.id_centro');
	$this->db->join('ingreso_nino as ig','ig.id_ingreso = ex.id_ingreso');
    $this->db->join('incidencias as in','in.id_incidencia = ex.id_incidencia_actual');
    $this->db->join('estado_penal as ep','ep.id_estadop = ex.id_estadop');
    $this->db->where('ex.id_expediente',$id_expediente);

	$query = $this->db->get();
	return $query->row_array();	
    }

    function ver_expedientes($id_expediente){
    $this->db->select('ex.*, ce.*, ei.*, ig.*, in.*, ex.id_expediente AS id_exp');
	$this->db->from('expediente_nino ex');
	$this->db->join('centro_asistencia as ce','ce.id_centro = ex.id_centro');
	$this->db->join('ingreso_nino as ig','ig.id_ingreso = ex.id_ingreso');
    $this->db->join('expediente_incidencia as ei','ei.id_expediente = ex.id_expediente');
    $this->db->join('incidencias as in','in.id_incidencia = ei.id_incidencia');
    $this->db->where('ex.id_expediente',$id_expediente);

	$query = $this->db->get();
	return $query->row_array();	
    }

    function ver_monto($data){
    $this->db->select('*');
	$this->db->from('pension');
    $this->db->where('id_pension',$data);

	$query = $this->db->get();
	return $query->row_array();	
    }

    function registros_por_casa($id_centro){
    $this->db->select('*');
	$this->db->from('expediente_nino');
	$this->db->join('centro_asistencia','centro_asistencia.id_centro = expediente_nino.id_centro');
    //$this->db->where('ex.id_centro','ce.id_centro');
    $this->db->where('expediente_nino.id_centro', $id_centro);

    //SELECT * FROM expediente_nino INNER JOIN centro_asistencia ON centro_asistencia.id_centro = expediente_nino.id_centro WHERE expediente_nino.id_centro = 1

	$query = $this->db->get();
	return $query->row_array();	
    }

    function hermanos($no_carpeta){
    $this->db->select('ce.*, ex.*, in.*, ep.*, ig.*');
	$this->db->from('expediente_nino ex');
	$this->db->join('centro_asistencia as ce','ce.id_centro = ex.id_centro');
	$this->db->join('incidencias as in','in.id_incidencia = ex.id_incidencia_actual');
	$this->db->join('estado_penal as ep','ep.id_estadop = ex.id_estadop');
	$this->db->join('ingreso_nino as ig','ig.id_ingreso = ex.id_ingreso');
    $this->db->where('ig.no_carpeta', $no_carpeta);

	$query = $this->db->get();
	return $query->row_array();	
    }

    function ver_pertenecias2($id_ingreso){
      $this->db->select('pe.*, in.*, ex.*');
	  $this->db->from('pertenencias pe');
	  $this->db->join('ingreso_nino as in','in.id_ingreso = pe.id_ingreso','left');	
	  $this->db->join('expediente_nino as ex','in.id_ingreso = ex.id_ingreso','left');
	    $this->db->where('pe.id_ingreso',$id_ingreso);

	    $query = $this->db->get();
		return $query->result();
    }

    function ver_pertenencias($id_ingreso){
        $this->db->select('pe.*, in.*, ex.*');
	    $this->db->from('pertenencias pe');
	    $this->db->join('ingreso_nino as in','in.id_ingreso = pe.id_ingreso','left');	
	    $this->db->join('expediente_nino as ex','in.id_ingreso = ex.id_ingreso','left');
	    $this->db->where('pe.id_ingreso',$id_ingreso);

	    $query = $this->db->get();
		return $query->result();
    }

    function ver_familiar($id_ingreso){
	    $this->db->select('fa.*, in.*, ex.*');
	    $this->db->from('familiares fa');
	    $this->db->join('ingreso_nino as in','in.id_ingreso = fa.id_ingreso','left');	
	    $this->db->join('expediente_nino as ex','in.id_ingreso = ex.id_ingreso','left');
	    $this->db->where('fa.id_ingreso',$id_ingreso);

	    $query = $this->db->get();
		return $query->result();
    }

    function ver_pension($id_expediente){
		$this->db->select('pe.*,fa.*,ex.*,in.*');
		$this->db->from('pension pe');
		$this->db->join('expediente_nino as ex','pe.id_expediente = ex.id_expediente');
		$this->db->join('ingreso_nino as in','in.id_ingreso = ex.id_ingreso');
		$this->db->join('familiares as fa','fa.id_familiar = pe.id_familiar');
		$this->db->where('pe.id_expediente',$id_expediente);

		$query = $this->db->get();
		return $query->result();
    }

    function exp_casa($id_centro){
		$this->db->select('ce.*,ig.*,ex.*,in.*,ep.*');
		$this->db->from('expediente_nino ex');
		$this->db->join('centro_asistencia as ce','ce.id_centro = ex.id_centro');
		$this->db->join('ingreso_nino as ig','ig.id_ingreso = ex.id_ingreso');
		$this->db->join('incidencias as in','in.id_incidencia = ex.id_incidencia_actual');
		$this->db->join('estado_penal as ep','ep.id_estadop = ex.id_estadop');
		$this->db->where('ex.id_centro',$id_centro);
		$this->db->where('ex.id_incidencia_actual','1');

		$query = $this->db->get();
		return $query->result();
    }

    function exp_estado($id_estadop){
		$this->db->select('ce.*,ig.*,ex.*,in.*,ep.*');
		$this->db->from('expediente_nino ex');
		$this->db->join('centro_asistencia as ce','ce.id_centro = ex.id_centro');
		$this->db->join('ingreso_nino as ig','ig.id_ingreso = ex.id_ingreso');
		$this->db->join('incidencias as in','in.id_incidencia = ex.id_incidencia_actual');
		$this->db->join('estado_penal as ep','ep.id_estadop = ex.id_estadop');
		$this->db->where('ex.id_centro',$id_estadop);

		$query = $this->db->get();
		return $query->result();
    }

  function ver_valoracion_pedagogica($data){
  	$this->db->select('vp.*,ni.*,ex.*,ed.*');
	$this->db->from('valoracion_pedagogica vp');
	$this->db->join('expediente_nino as ex','ex.id_expediente = vp.fk_expediente');
	$this->db->join('niveles as ni','ni.id_nivel = vp.con_lectura');
	$this->db->join('educacion as ed','ed.id_educacion = vp.id_educacion');
    $this->db->where('id_expediente',$data);

	$query = $this->db->get();
	return $query->row_array();
   }

   function ver_valoracion_pedagogican($data){
    $this->db->select('vp.*,ni.*,ed.*');
    $this->db->from('valoracion_pedagogica as vp');
    $this->db->join('niveles as ni','ni.id_nivel = vp.con_lectura');
    $this->db->join('educacion as ed','ed.id_educacion = vp.id_educacion');
    $this->db->where('vp.id_valpedagogica',$data);

    $query = $this->db->get();
    return $query->row_array();
    }

   function ver_valoracion_pedagogicas($data){
    $this->db->select('vp.*,ni.*,ed.*');
    $this->db->from('valoracion_pedagogica vp');
    $this->db->join('expediente_nino as ex','ex.id_expediente = vp.fk_expediente');
    $this->db->join('niveles as ni','ni.id_nivel = vp.con_lectura');
    $this->db->join('educacion as ed','ed.id_educacion = vp.id_educacion');
    $this->db->where('vp.id_valpedagogica',$data);

    $query = $this->db->get();
    return $query->row_array();
    }

   function ver_valoracion_nutricional($data){
  	$this->db->select('vn.*,ex.*');
	$this->db->from('valoracion_nutriologica vn');
	$this->db->join('expediente_nino as ex','ex.id_expediente = vn.fk_expediente');
	$this->db->where('id_expediente',$data);

	$query = $this->db->get();
	return $query->row_array();
   }

   function ver_valoracion_psicologica($data){
  	$this->db->select('vps.*,ex.*');
	$this->db->from('valoracion_psicologica vps');
	$this->db->join('expediente_nino as ex','ex.id_expediente = vps.fk_expediente');
	$this->db->where('id_expediente',$data);

	$query = $this->db->get();
	return $query->row_array();
   }


   function ver_valoracion_pmenor($data){
  	$this->db->select('im.*,ex.*');
	$this->db->from('informe_menor im');
	$this->db->join('expediente_nino as ex','ex.id_expediente = im.fk_expediente');
	$this->db->where('id_expediente',$data);

	$query = $this->db->get();
	return $query->row_array();
   }

   function notas($data){
  	$this->db->select('no.*,ex.*');
	$this->db->from('notas no');
	$this->db->join('expediente_nino as ex','ex.id_expediente = no.fk_expediente');
	$this->db->where('id_expediente',$data);

	$query = $this->db->get();
	return $query->row_array();
   }

   function visita_dom($data){
  	$this->db->select('vd.*,ex.*');
	$this->db->from('informe_psfamiliar vd');
	$this->db->join('expediente_nino as ex','ex.id_expediente = vd.fk_expediente');
	$this->db->where('id_expediente',$data);

	$query = $this->db->get();
	return $query->row_array();
   }

   function ver_valoracion_trab_soc($data){
  	$this->db->select('vd.*,ex.*');
	$this->db->from('informe_visitad vd');
	$this->db->join('expediente_nino as ex','ex.id_expediente = vd.fk_expediente');
	$this->db->where('id_expediente',$data);

	$query = $this->db->get();
	return $query->row_array();
   }

   //Valoración jurpidica
   function ver_valoracion_juridica($data){
        $this->db->select('vj.*,ex.*');
        $this->db->from('valoracion_juridica vj');
        $this->db->join('expediente_nino as ex','ex.id_expediente = vj.fk_expediente');
        $this->db->where('id_expediente',$data);

        $query = $this->db->get();
        return $query->row_array();
   }

   function ver_valoracion_medica($data){
  	$this->db->select('vm.*,ex.*');
	$this->db->from('valoracion_medica vm');
	$this->db->join('expediente_nino as ex','ex.id_expediente = vm.fk_expediente');
	$this->db->where('id_valmedica',$data);

	$query = $this->db->get();
	return $query->row_array();
   }

   function de_ver_valoracion_medica($data,$idval){
    $this->db->select('vm.*,ex.*');
    $this->db->from('valoracion_medica vm');
    $this->db->join('expediente_nino as ex','ex.id_expediente = vm.fk_expediente');
    $this->db->where('id_expediente',$data);
    $this->db->where('id_valmedica',$idval);

    $query = $this->db->get();
    return $query->row_array();
    }


   function ver_trabajador_atiende($data){
  	$this->db->select('eq.*,ex.*,pe.*,pr.*');
	$this->db->from('equipos eq');
	$this->db->join('expediente_nino as ex','ex.id_expediente = eq.fk_expediente');
	$this->db->join('persona as pe','pe.id_persona = eq.id_persona');
    $this->db->join('privilegio as pr','pe.id_privilegio = pr.id_privilegio');
	$this->db->where('id_expediente',$data);

	$query = $this->db->get();
	return $query->result();
   }

   function ver_hermanos($id_ingreso){
   	$this->db->select('ex.*, ce.*, ig.*, in.*, ep.*');
	$this->db->from('expediente_nino ex');
	$this->db->join('centro_asistencia as ce','ce.id_centro = ex.id_centro');
	$this->db->join('ingreso_nino as ig','ig.id_ingreso = ex.id_ingreso');
    $this->db->join('incidencias as in','in.id_incidencia = ex.id_incidencia_actual');
    $this->db->join('estado_penal as ep','ep.id_estadop = ex.id_estadop');
    $this->db->where('in.no_carpeta','in.no_carpeta');   
    $this->db->where('ig.id_ingreso',$id_ingreso);
   }

    function ver_ingresos($id_ingreso){
	    $this->db->select('ce.*, ex.*, ig.*');
	$this->db->from('expediente_nino ex');
	$this->db->join('centro_asistencia as ce','ce.id_centro = ex.id_centro','left');
	$this->db->join('ingreso_nino as ig','ig.id_ingreso = ex.id_ingreso','left');
    $this->db->where('ig.id_ingreso',$id_ingreso);
    $this->db->group_by('ig.id_ingreso');
		
	$query = $this->db->get();
	return $query->row_array();	
    }

    function actualiza_estatus($id_persona,$data){
     $this->db->where('id_persona',$id_persona);
     $this->db->update('persona',$data);
    }

    function actualiza_monto($id_pension,$data){
     $this->db->where('id_pension',$id_pension);
     $this->db->update('pension',$data);
    }

    function actualiza_centro($id_centro,$data){
     $this->db->where('id_centro',$id_centro);
     $this->db->update('centro_asistencia',$data);
    }

    function actualiza_ingreso_nino($id_ingreso,$data){
     $this->db->where('id_ingreso',$id_ingreso);
     $this->db->update('ingreso_nino',$data);
    }

    function actualiza_personal($id_persona,$data){
     $this->db->where('id_persona',$id_persona);
     $this->db->update('persona',$data);
    }

    function actualiza_estado_procesal($id_expediente,$data){
       // echo $data['id_estadop'];
       // echo $id_expediente;
     $this->db->where('id_expediente',$id_expediente);
     $this->db->update('expediente_nino',$data);
    }

    function actualiza_incidencia_expediente($id_expediente,$data){
     $this->db->where('id_expediente',$id_expediente);
     $this->db->update('expediente_nino',$data);
    }

    function datos_ingreso($id_ingreso){
		$this->db->select('*');
		$this->db->from('ingreso_nino');
		$this->db->where('id_ingreso',$id_ingreso);

		$query = $this->db->get();
		return $query->row_array();
	}

	function get(){
		$this->db->select('nombre_incidencia, count(id_expediente) AS id_expediente');
		$this->db->from('expediente_nino');
        $this->db->join('incidencias','expediente_nino.id_incidencia_actual=incidencias.id_incidencia');

         $this->db->group_by('incidencias.nombre_incidencia');
		$query = $this->db->get();
					
		return $query->result();
	}
function get2(){
		$this->db->select('genero_nino, count(id_expediente) AS id_expediente');
		$this->db->from('expediente_nino');
        $this->db->join('ingreso_nino','expediente_nino.id_ingreso=ingreso_nino.id_ingreso');

         $this->db->group_by('ingreso_nino.genero_nino');
		$query = $this->db->get();
					
		return $query->result();
    }
    
	function get3(){
		$this->db->select('nombre_estado, count(id_expediente) AS id_expediente');
		$this->db->from('expediente_nino');
        $this->db->join('estado_penal','expediente_nino.id_estadop=estado_penal.id_estadop');

         $this->db->group_by('estado_penal.nombre_estado');
		$query = $this->db->get();
					
		return $query->result();
    }
    
    function get4(){
		$this->db->select('nombre_incidencia, count(id_expediente) AS id_expediente');
		$this->db->from('expediente_nino');
        $this->db->join('incidencias','expediente_nino.id_incidencia_actual=incidencias.id_incidencia');

         $this->db->group_by('incidencias.nombre_incidencia');
		$query = $this->db->get();
					
		return $query->result();
    }

    function get5(){
        $this->db->select('municipio_origen, count(id_ingreso) AS id_ingreso');
		$this->db->from('ingreso_nino');

         $this->db->group_by('municipio_origen');
		$query = $this->db->get();
					
		return $query->result();
    }

	function datos_niveles(){
		$query = $this->db->get('niveles');
		return $query->result();
	}

	function estadop(){
		$query = $this->db->get('estado_penal');
		return $query->result();
	}

	function casitas(){
		$query = $this->db->get('centro_asistencia');
		return $query->result();
	}

	function datos_casita($data){
	$this->db->select('c.*, ex.*');
	$this->db->from('expediente_nino ex');
    $this->db->join('centro_asistencia as c','c.id_centro = ex.id_centro');	

    $query = $this->db->get();
	return $query->row_array();
	}

	function datos_centro($data){
		$this->db->select('*');
		$this->db->from('centro_asistencia');
		$this->db->where('id_centro',$data);

		$query = $this->db->get();
		return $query->row_array();
	}

	function devuelve_privilegio($data){
	$this->db->select('p.*, pe.*');
	$this->db->from('persona pe');
    $this->db->join('privilegio as p','p.id_privilegio = pe.id_privilegio');	
    
    $query = $this->db->get();
	return $query->row_array();
	}

	function devuelve_centrosss($data){
	$query = $this->db->get('centro_asistencia');
	return $query->result();
	}

	function devuelve_procesal($data){
	$query = $this->db->get('estado_penal');
	return $query->result();
	}

	function devuelve_centro_tras($data){
	$query = $this->db->get('centro_asistencia');
	return $query->result();
	}

	function devuelve_centros_traslado(){
	$this->db->select('*');
	$this->db->from('centro_asistencia');

    $query = $this->db->get();
	return $query->row_array();	
	}

	function datos_personal($data){
		$this->db->select('ce.*,pr.*,pe.*');
		$this->db->from('persona pe');
		$this->db->join('centro_asistencia as ce','ce.id_centro = pe.id_centro');
		$this->db->join('privilegio as pr','pr.id_privilegio = pe.id_privilegio');
		$this->db->where('id_persona',$data);

		$query = $this->db->get();
		return $query->row_array();
	}

	function datos_exptras($data){
		$this->db->select('ce.*,ex.*');
		$this->db->from('expediente_nino ex');
		$this->db->join('centro_asistencia as ce','ce.id_centro = ex.id_centro');
		$this->db->where('id_expediente',$data);

		$query = $this->db->get();
		return $query->row_array();
	}

	function datos_expediente($data){
	$this->db->select('ex.*, ce.*, ep.*, ig.*, in.*');
	$this->db->from('expediente_nino ex');
	$this->db->join('centro_asistencia as ce','ce.id_centro = ex.id_centro');
	$this->db->join('estado_penal as ep','ep.id_estadop = ex.id_estadop');
	$this->db->join('ingreso_nino as ig','ig.id_ingreso = ex.id_ingreso');
    $this->db->join('incidencias as in','in.id_incidencia = ex.id_incidencia_actual');
	$this->db->where('id_expediente',$data);

		$query = $this->db->get();
		return $query->row_array();
	}

	function datos_personal1($data){
	  $this->db->select('c.*,p.*,pe.*');
	  $this->db->from('persona p');
	  $this->db->join('centro_asistencia as c','c.id_centro = pe.id_centro');
	  $this->db->join('privilegio as p','p.id_privilegio = pe.id_privilegio');
	  $this->db->where('id_persona',$data);

		$query = $this->db->get();
		return $query->row_array();
	}

	function datos_familiares($data){
		$this->db->select('*');
		$this->db->from('familiares');
		$this->db->where('id_familiar',$data);

		$query = $this->db->get();
		return $query->row_array();
	}

	function datos_innino($id_ingreso){
		$this->db->select('*');
		$this->db->from('ingreso_nino');
		$this->db->where('id_ingreso',$id_ingreso);

		$query = $this->db->get();
		return $query->row_array();
	}

	function datos_exnino($id_expediente){
		$this->db->select('*');
		$this->db->from('expediente_nino');
		$this->db->where('id_expediente',$id_expediente);

		$query = $this->db->get();
		return $query->row_array();
	}

	function datos_educacion(){
		$query = $this->db->get('educacion');
		return $query->result();
	}

	function devuelve_familiares($bus, $id_familiar){
    $data  = $this->datos_sesion();
    if (empty($bus)) {
        $this->db->select('fa.*, in.*');
	    $this->db->from('familiares fa');
	    $this->db->join('ingreso_nino as in','in.id_ingreso = fa.id_ingreso','left');
        $this->db->order_by('fecha_ingreso DESC'); 

    }else{

	    $this->db->select('fa.*, in.*');
	    $this->db->from('familiares fa');
        $this->db->join('ingreso_nino as in','in.id_ingreso = fa.id_ingreso','left');
        $this->db->order_by('fecha_ingreso DESC');

    $this->db->like('nombre_f',$bus);
    $this->db->or_like('apellido_pf',$bus);
    $this->db->or_like('apellido_mf',$bus);    
    $this->db->or_like('genero_f',$bus);
    $this->db->or_like('relacion',$bus);
    $this->db->or_like('nombres_nino',$bus);
    $this->db->or_like('apellido_pnino',$bus);
    $this->db->or_like('apellido_mnino',$bus);
    //$this->db->group_by('fa.id_ingreso');
    }

	    $query = $this->db->get();
		return $query->result();
   }

   function devuelve_pensiones($bus, $id_pension){
    $data  = $this->datos_sesion();
    if (empty($bus)) {
     $this->db->select('pe.*, ex.*, fa.*, in.*');
	 $this->db->from('pension pe');
     $this->db->join('familiares as fa','pe.id_familiar = fa.id_familiar','left');
     $this->db->join('expediente_nino as ex','ex.id_expediente = pe.id_expediente','left');
     $this->db->join('ingreso_nino as in','in.id_ingreso = ex.id_ingreso','left');

     }else{

	$this->db->select('pe.*, ex.*, fa.*, in.*');
	$this->db->from('pension pe');
    $this->db->join('familiares as fa','pe.id_familiar = fa.id_familiar','left');
    $this->db->join('expediente_nino as ex','ex.id_expediente = pe.id_expediente','left');
    $this->db->join('ingreso_nino as in','in.id_ingreso = ex.id_ingreso','left');
	
    $this->db->or_like('nombre_f',$bus);
    $this->db->or_like('apellido_pf',$bus);
    $this->db->or_like('apellido_mf',$bus);    
    $this->db->or_like('genero_f',$bus);
    $this->db->or_like('cuaderno',$bus);
    $this->db->or_like('nombres_nino',$bus);
    $this->db->or_like('apellido_pnino',$bus);
    $this->db->or_like('apellido_mnino',$bus);
    //$this->db->group_by('fa.id_ingreso');
    }

	    $query = $this->db->get();
		return $query->result();
   }


	function datos_equipo(){
		$this->db->select('*');
		$this->db->from('equipos');
		$query = $this->db->get();
		return $query->result();
    }

    function estatusp(){
		$query = $this->db->get('estatus');
		return $query->result();
    }

    function estado_procesal(){
		$query = $this->db->get('estado_penal');
		return $query->result();
    }

    function estado_procesalll($data){
	$this->db->select('ep.*, ex.*');
	$this->db->from('estado_penal ep');
    $this->db->join('expediente_nino as ex','ex.id_estadop = ep.id_estadop');

    $query = $this->db->get();
	return $query->row_array();	
	}

    function devuelve_centross($data){
	$this->db->select('c.*, ex.*');
	$this->db->from('centro_asistencia c');
    $this->db->join('expediente_nino as ex','c.id_centro = ex.id_centro');

    $query = $this->db->get();
	return $query->row_array();	
	}

	function datos_estadop_expediente($data){
		$this->db->select('ce.*,ig.*,ex.*,in.*,ep.*');
		$this->db->from('expediente_nino ex');
		$this->db->join('centro_asistencia as ce','ce.id_centro = ex.id_centro');
		$this->db->join('ingreso_nino as ig','ig.id_ingreso = ex.id_ingreso');
		$this->db->join('incidencias as in','in.id_incidencia = ex.id_incidencia_actual');
		$this->db->join('estado_penal as ep','ep.id_estadop = ex.id_estadop');
		$this->db->where('ex.id_expediente',$data);

		$query = $this->db->get();
		return $query->row_array();
	}

	function actualiza_expediente($id_expediente,$data){
		$this->db->where('id_expediente', $id_expediente);
		$this->db->update('expediente_nino', $data);
	}

    function inserta_num_equipo($id_expediente,$data){
        $this->db->where('id_expediente', $id_expediente);
		$this->db->update('expediente_nino', $data);
    }

	function actualiza_ingreso($id_ingreso,$data){
		$this->db->where('id_ingreso', $id_ingreso);
		$this->db->update('ingreso_nino', $data);
	}
	
	function actualiza_fam($id_familiar,$data){
		$this->db->where('id_familiar', $id_familiar);
		$this->db->update('familiares', $data);
	}

	function actualiza_expequ($id_persona,$data){
		$this->db->where('id_persona', $id_persona);
		$this->db->update('equipos', $data);
	}

	function insertar_pension($data){
		$this->db->insert('pension',$data);
		return $this->db->insert_id();
	}

	function actualiza_expediente1($id_expediente,$data){
		$this->db->where('id_expediente', $id_expediente);
		$this->db->update('expediente_equipo', $data);
	}

	function devuelve_busqueda_estado(){
      $data=$this->datos_sesion();
      $this->db->select('ingreso_nino.nombres_nino,ingreso_nino.apellido_pnino,ingreso_nino.apellido_mnino,ingreso_nino.genero_nino,ingreso_nino.fecha_ingreso,ingreso_nino.motivos_ingreso,centro_asistencia.nombre_centro,expediente_nino.no_expediente,incidencias.nombre_incidencia');
      $this->db->from('expediente_nino');
      $this->db->join('ingreso_nino','ingreso_nino.id_ingreso=expediente_nino.id_ingreso','left');
      $this->db->join('centro_asistencia','centro_asistencia.id_centro=expediente_nino.id_centro','left');
      $this->db->join('incidencias','incidencias.id_incidencia=expediente_nino.id_incidencia_actual','left');
  
      $query = $this->db->get();
      return $query->result();
    }

	function devuelve_ninos_ingresos(){
    $data=$this->datos_sesion();
    $this->db->select('ingreso_nino.nombres_nino,ingreso_nino.apellido_pnino,,ingreso_nino.municipio_origen,ingreso_nino.no_carpeta,ingreso_nino.apellido_mnino,ingreso_nino.genero_nino,ingreso_nino.fecha_ingreso,ingreso_nino.motivos_ingreso,centro_asistencia.nombre_centro,expediente_nino.no_expediente,incidencias.nombre_incidencia');
    $this->db->from('expediente_nino');
    $this->db->join('ingreso_nino','ingreso_nino.id_ingreso=expediente_nino.id_ingreso','left');
    $this->db->join('centro_asistencia','centro_asistencia.id_centro=expediente_nino.id_centro','left');
    $this->db->join('incidencias','incidencias.id_incidencia=expediente_nino.id_incidencia_actual','left');
    $this->db->where('expediente_nino.id_incidencia_actual', '1');
  
    $query = $this->db->get();
    return $query->result();
    }

    function devuelve_ninos_traslados(){
    $data=$this->datos_sesion();
    $this->db->select('ingreso_nino.apellido_pnino,ingreso_nino.nombres_nino,centro_asistencia.nombre_centro,ingreso_nino.no_carpeta,ingreso_nino.apellido_mnino,ingreso_nino.genero_nino,ingreso_nino.fecha_ingreso,ingreso_nino.motivos_ingreso,expediente_nino.no_expediente,incidencias.nombre_incidencia,expediente_incidencia.id_centro,expediente_incidencia.id_centroe,expediente_incidencia.motivos_traslado, expediente_incidencia.autoriza,expediente_incidencia.fecha_traslado');
    $this->db->from('expediente_nino');
    $this->db->join('ingreso_nino','ingreso_nino.id_ingreso=expediente_nino.id_ingreso','left');
    $this->db->join('incidencias','incidencias.id_incidencia=expediente_nino.id_incidencia_actual','left');
    $this->db->join('expediente_incidencia','expediente_incidencia.id_incidencia=expediente_nino.id_incidencia_actual','left');
    $this->db->join('centro_asistencia','centro_asistencia.id_centro=expediente_incidencia.id_centro','left');
    $this->db->where('expediente_nino.id_incidencia_actual', '4');
  
    $query = $this->db->get();
    return $query->result();
    }

    function devuelve_ninos_egresos(){
    $data=$this->datos_sesion();
    $this->db->select('centro_asistencia.nombre_centro,expediente_incidencia.autoriza,expediente_incidencia.motivos_egreso,expediente_incidencia.fecha_egreso,expediente_incidencia.persona_responsable,ingreso_nino.no_carpeta,ingreso_nino.nombres_nino,ingreso_nino.apellido_pnino,ingreso_nino.apellido_mnino,ingreso_nino.genero_nino,ingreso_nino.fecha_ingreso,ingreso_nino.motivos_ingreso,expediente_nino.no_expediente,incidencias.nombre_incidencia,expediente_incidencia.id_centro,expediente_incidencia.id_centroe,expediente_incidencia.motivos_egreso,');
    $this->db->from('expediente_nino');
    $this->db->join('ingreso_nino','ingreso_nino.id_ingreso=expediente_nino.id_ingreso','left');
    $this->db->join('centro_asistencia','centro_asistencia.id_centro=expediente_nino.id_centro','left');
    $this->db->join('incidencias','incidencias.id_incidencia=expediente_nino.id_incidencia_actual','left');
    $this->db->join('expediente_incidencia','expediente_incidencia.id_incidencia=expediente_nino.id_incidencia_actual','left');
    $this->db->where('expediente_nino.id_incidencia_actual', '2');
  
    $query = $this->db->get();
    return $query->result();
    }

    function devuelve_ninos_fugas(){
    $data=$this->datos_sesion();
    $this->db->select('centro_asistencia.nombre_centro,expediente_incidencia.autoriza,expediente_incidencia.fecha_fuga,ingreso_nino.no_carpeta,ingreso_nino.nombres_nino,ingreso_nino.apellido_pnino,ingreso_nino.apellido_mnino,ingreso_nino.genero_nino,ingreso_nino.fecha_ingreso,ingreso_nino.motivos_ingreso,expediente_nino.no_expediente,incidencias.nombre_incidencia,expediente_incidencia.id_centro,expediente_incidencia.id_centroe,expediente_incidencia.motivos_fuga,expediente_incidencia.localizado,expediente_incidencia.estancia_nino');
    $this->db->from('expediente_nino');
    $this->db->join('ingreso_nino','ingreso_nino.id_ingreso=expediente_nino.id_ingreso','left');
    $this->db->join('centro_asistencia','centro_asistencia.id_centro=expediente_nino.id_centro','left');
    $this->db->join('incidencias','incidencias.id_incidencia=expediente_nino.id_incidencia_actual','left');
    $this->db->join('expediente_incidencia','expediente_incidencia.id_incidencia=expediente_nino.id_incidencia_actual','left');
    $this->db->where('expediente_nino.id_incidencia_actual', '3');
  
    $query = $this->db->get();
    return $query->result();
    }

    function devuelve_expedientes_incidencias($bus,$id_expediente){
    $data=$this->datos_sesion();
    if (empty($bus)) {
    $this->db->select('expediente_nino.*, ingreso_nino.*, centro_asistencia.*, incidencias.*, estado_penal.*');
    $this->db->from('expediente_nino');
    $this->db->join('ingreso_nino','ingreso_nino.id_ingreso=expediente_nino.id_ingreso','left');
    $this->db->join('centro_asistencia','centro_asistencia.id_centro=expediente_nino.id_centro','left');
    $this->db->join('incidencias','incidencias.id_incidencia=expediente_nino.id_incidencia_actual','left');
    $this->db->join('estado_penal','estado_penal.id_estadop=expediente_nino.id_estadop','left');
    //$this->db->where('incidencias.id_incidencia','id_incidencia_actual');
    
    }else{
        $this->db->select('expediente_nino.*, ingreso_nino.*, centro_asistencia.*, incidencias.*, estado_penal.*');
        $this->db->from('expediente_nino');
        $this->db->join('ingreso_nino','ingreso_nino.id_ingreso=expediente_nino.id_ingreso','left');
        $this->db->join('centro_asistencia','centro_asistencia.id_centro=expediente_nino.id_centro','left');
        $this->db->join('incidencias','incidencias.id_incidencia=expediente_nino.id_incidencia_actual','left');
        $this->db->join('estado_penal','estado_penal.id_estadop=expediente_nino.id_estadop','left');

        $this->db->like('no_expediente',$bus);
        $this->db->or_like('no_carpeta',$bus);
        $this->db->or_like('nombre_centro',$bus);
        $this->db->or_like('nombres_nino',$bus);
        $this->db->or_like('fecha_nnino',$bus);
        $this->db->or_like('genero_nino',$bus);
        $this->db->or_like('fecha_ingreso',$bus);
        $this->db->or_like('motivos_ingreso',$bus);
        $this->db->or_like('nombre_estado',$bus);
        $this->db->or_like('nombre_incidencia',$bus);
    }
    $query = $this->db->get();
    return $query->result();
    }

    function devuelve_expedientes_egresostb(){
        $this->db->select('expediente_nino.*, ingreso_nino.*, centro_asistencia.*, incidencias.*, estado_penal.*, expediente_incidencia.*');
        $this->db->from('expediente_nino');
        $this->db->join('ingreso_nino','ingreso_nino.id_ingreso=expediente_nino.id_ingreso','left');
        $this->db->join('centro_asistencia','centro_asistencia.id_centro=expediente_nino.id_centro','left');
        $this->db->join('incidencias','incidencias.id_incidencia=expediente_nino.id_incidencia_actual','left');
        $this->db->join('estado_penal','estado_penal.id_estadop=expediente_nino.id_estadop','left');
        $this->db->join('expediente_incidencia','expediente_incidencia.id_incidencia=expediente_nino.id_incidencia_actual','left');
        $this->db->where('expediente_incidencia.id_incidencia','2');

        $query = $this->db->get();
		return $query->result();
    }

    function devuelve_expedientes_ingresostb(){
        $this->db->select('expediente_nino.*, ingreso_nino.*, centro_asistencia.*, incidencias.*, estado_penal.*, expediente_incidencia.*');
        $this->db->from('expediente_nino');
        $this->db->join('ingreso_nino','ingreso_nino.id_ingreso=expediente_nino.id_ingreso','left');
        $this->db->join('centro_asistencia','centro_asistencia.id_centro=expediente_nino.id_centro','left');
        $this->db->join('incidencias','incidencias.id_incidencia=expediente_nino.id_incidencia_actual','left');
        $this->db->join('estado_penal','estado_penal.id_estadop=expediente_nino.id_estadop','left');
        $this->db->join('expediente_incidencia','expediente_incidencia.id_incidencia=expediente_nino.id_incidencia_actual','left');
        $this->db->where('expediente_incidencia.id_incidencia','2');

        $query = $this->db->get();
		return $query->result();
    }

   function traer_num_equipo($id_num_equipo){
         $this->db->select('num_equipo');
          $this->db->from('num_equipo');
          $this->db->where('id_num_equipo',$id_num_equipo);
          $query = $this->db->get();
          return $query->result(); 

    }

    function devuelve_expedientes_fugas($bus, $id_expincidencia){
    $data  = $this->datos_sesion();
    if (empty($bus)) {
     $this->db->select('expediente_nino.*, ingreso_nino.*, centro_asistencia.*, incidencias.*, estado_penal.*, expediente_incidencia.*');
    $this->db->from('expediente_nino');
    $this->db->join('ingreso_nino','ingreso_nino.id_ingreso=expediente_nino.id_ingreso','left');
    $this->db->join('centro_asistencia','centro_asistencia.id_centro=expediente_nino.id_centro','left');
    $this->db->join('incidencias','incidencias.id_incidencia=expediente_nino.id_incidencia_actual','left');
    $this->db->join('estado_penal','estado_penal.id_estadop=expediente_nino.id_estadop','left');
    $this->db->join('expediente_incidencia','expediente_incidencia.id_incidencia=expediente_nino.id_incidencia_actual','left');
    $this->db->where('expediente_incidencia.id_incidencia','3');

     }else{

	$this->db->select('expediente_nino.*, ingreso_nino.*, centro_asistencia.*, incidencias.*, estado_penal.*, expediente_incidencia.*');
    $this->db->from('expediente_nino');
    $this->db->join('ingreso_nino','ingreso_nino.id_ingreso=expediente_nino.id_ingreso','left');
    $this->db->join('centro_asistencia','centro_asistencia.id_centro=expediente_nino.id_centro','left');
    $this->db->join('incidencias','incidencias.id_incidencia=expediente_nino.id_incidencia_actual','left');
    $this->db->join('estado_penal','estado_penal.id_estadop=expediente_nino.id_estadop','left');
    $this->db->join('expediente_incidencia','expediente_incidencia.id_incidencia=expediente_nino.id_incidencia_actual','left');
    $this->db->where('expediente_incidencia.id_incidencia','3');
    
    /*$this->db->or_like('no_expediente',$bus);
    $this->db->or_like('no_carpeta',$bus);
    $this->db->or_like('nombre_estado',$bus);    
    $this->db->or_like('nombre_centro',$bus);
    $this->db->or_like('fecha_ingreso',$bus);
    $this->db->or_like('nombres_nino',$bus);
    $this->db->or_like('apellido_pnino',$bus);
    $this->db->or_like('apellido_mnino',$bus);
    $this->db->or_like('motivos_ingreso',$bus);
    $this->db->or_like('fecha_fuga',$bus);
    $this->db->or_like('motivos_fuga',$bus);*/
    }

	    $query = $this->db->get();
		return $query->result();
   }

    function devuelve_expedientes_egresos(){
    $data=$this->datos_sesion();
    $this->db->select('expediente_nino.*, ingreso_nino.*, centro_asistencia.*, incidencias.*, estado_penal.*, expediente_incidencia.*');
    $this->db->from('expediente_nino');
    $this->db->join('ingreso_nino','ingreso_nino.id_ingreso=expediente_nino.id_ingreso','left');
    $this->db->join('centro_asistencia','centro_asistencia.id_centro=expediente_nino.id_centro','left');
    $this->db->join('incidencias','incidencias.id_incidencia=expediente_nino.id_incidencia_actual','left');
    $this->db->join('estado_penal','estado_penal.id_estadop=expediente_nino.id_estadop','left');
    $this->db->join('expediente_incidencia','expediente_incidencia.id_incidencia=expediente_nino.id_incidencia_actual','left');
    $this->db->where('expediente_nino.id_incidencia_actual','2');
    //$this->db->group_by('expediente_nino.id_incidencia_actual');
  
    $query = $this->db->get();
    return $query->result();
    }

    function egresos($desde_e, $hasta_e){
    $data=$this->datos_sesion();
    if ($desde_e == "" || $hasta_e == ""){
    	$query = $this->db->query("select ingreso_nino.nombres_nino, ingreso_nino.apellido_pnino, ingreso_nino.apellido_mnino, ingreso_nino.genero_nino, ingreso_nino.fecha_nnino, ingreso_nino.delito, ingreso_nino.motivos_ingreso, centro_asistencia.nombre_centro, estado_penal.nombre_estado, incidencias.nombre_incidencia, ingreso_nino.fecha_ingreso, ingreso_nino.no_carpeta, expediente_nino.no_expediente, expediente_incidencia.fecha_egreso, expediente_incidencia.motivos_egreso, expediente_incidencia.persona_responsable, expediente_incidencia.autoriza
            from expediente_nino inner join ingreso_nino on ingreso_nino.id_ingreso=expediente_nino.id_ingreso inner join centro_asistencia on centro_asistencia.id_centro=expediente_nino.id_centro inner join incidencias on incidencias.id_incidencia=expediente_nino.id_incidencia_actual inner join estado_penal on estado_penal.id_estadop=expediente_nino.id_estadop inner join expediente_incidencia on expediente_incidencia.id_incidencia=expediente_nino.id_incidencia_actual where id_incidencia_actual = 2");
    
    } else if ($desde_e != "" && $hasta_e != "") {
    	$query = $this->db->query("select ingreso_nino.nombres_nino, ingreso_nino.apellido_pnino, ingreso_nino.apellido_mnino, ingreso_nino.genero_nino, ingreso_nino.fecha_nnino, ingreso_nino.motivos_ingreso, centro_asistencia.nombre_centro, estado_penal.nombre_estado, incidencias.nombre_incidencia, ingreso_nino.fecha_ingreso, ingreso_nino.no_carpeta, expediente_nino.no_expediente, expediente_incidencia.fecha_egreso, expediente_incidencia.motivos_egreso, expediente_incidencia.persona_responsable, expediente_incidencia.autoriza
            from expediente_nino inner join ingreso_nino on ingreso_nino.id_ingreso=expediente_nino.id_ingreso inner join centro_asistencia on centro_asistencia.id_centro=expediente_nino.id_centro inner join incidencias on incidencias.id_incidencia=expediente_nino.id_incidencia_actual inner join estado_penal on estado_penal.id_estadop=expediente_nino.id_estadop inner join expediente_incidencia on expediente_incidencia.id_incidencia=expediente_nino.id_incidencia_actual where ingreso_nino.fecha_ingreso BETWEEN '".$desde_e."' AND '".$hasta_e."'  AND id_incidencia_actual = 2");
    }
		return ($query->num_rows()<= 0) ? NULL : $query->result();

    }

    function ingresos($desde, $hasta){
    $data=$this->datos_sesion();
   
    if ($desde == "" || $hasta == ""){
    	$query = $this->db->query("select ingreso_nino.nombres_nino, ingreso_nino.apellido_pnino, ingreso_nino.apellido_mnino, ingreso_nino.genero_nino, ingreso_nino.fecha_nnino, ingreso_nino.delito, ingreso_nino.motivos_ingreso, centro_asistencia.nombre_centro, estado_penal.nombre_estado, incidencias.nombre_incidencia, ingreso_nino.fecha_ingreso, ingreso_nino.no_carpeta, expediente_nino.no_expediente from expediente_nino inner join ingreso_nino on ingreso_nino.id_ingreso=expediente_nino.id_ingreso inner join centro_asistencia on centro_asistencia.id_centro=expediente_nino.id_centro inner join incidencias on incidencias.id_incidencia=expediente_nino.id_incidencia_actual inner join estado_penal on estado_penal.id_estadop=expediente_nino.id_estadop where id_incidencia_actual = 1");
    
    } else if ($desde != "" && $hasta != "") {
    	$query = $this->db->query("select ingreso_nino.nombres_nino, ingreso_nino.apellido_pnino, ingreso_nino.apellido_mnino, ingreso_nino.genero_nino, ingreso_nino.fecha_nnino, ingreso_nino.motivos_ingreso, centro_asistencia.nombre_centro, estado_penal.nombre_estado, incidencias.nombre_incidencia, ingreso_nino.fecha_ingreso, ingreso_nino.no_carpeta, expediente_nino.no_expediente from expediente_nino inner join ingreso_nino on ingreso_nino.id_ingreso=expediente_nino.id_ingreso inner join centro_asistencia on centro_asistencia.id_centro=expediente_nino.id_centro inner join incidencias on incidencias.id_incidencia=expediente_nino.id_incidencia_actual inner join estado_penal on estado_penal.id_estadop=expediente_nino.id_estadop where ingreso_nino.fecha_ingreso BETWEEN '".$desde."' AND '".$hasta."'  AND id_incidencia_actual = 1");
    }
		return ($query->num_rows()<= 0) ? NULL : $query->result();
    }

    function fugas($desde_e, $hasta_e){
        $data=$this->datos_sesion();
        if ($desde_e == "" || $hasta_e == ""){
            $query = $this->db->query("select ingreso_nino.nombres_nino, ingreso_nino.apellido_pnino, ingreso_nino.apellido_mnino, ingreso_nino.genero_nino, ingreso_nino.fecha_nnino, ingreso_nino.motivos_ingreso, centro_asistencia.nombre_centro, estado_penal.nombre_estado, incidencias.nombre_incidencia, ingreso_nino.fecha_ingreso, ingreso_nino.no_carpeta, expediente_nino.no_expediente, expediente_incidencia.fecha_egreso, expediente_incidencia.motivos_egreso, expediente_incidencia.persona_responsable, expediente_incidencia.autoriza, expediente_incidencia.fecha_fuga, expediente_incidencia.motivos_fuga, expediente_incidencia.localizado, expediente_incidencia.estancia_nino
                from expediente_nino inner join ingreso_nino on ingreso_nino.id_ingreso=expediente_nino.id_ingreso inner join centro_asistencia on centro_asistencia.id_centro=expediente_nino.id_centro inner join incidencias on incidencias.id_incidencia=expediente_nino.id_incidencia_actual inner join estado_penal on estado_penal.id_estadop=expediente_nino.id_estadop inner join expediente_incidencia on expediente_incidencia.id_incidencia=expediente_nino.id_incidencia_actual where id_incidencia_actual = 3");
        
        } else if ($desde_e != "" && $hasta_e != "") {
            $query = $this->db->query("select ingreso_nino.nombres_nino, ingreso_nino.apellido_pnino, ingreso_nino.apellido_mnino, ingreso_nino.genero_nino, ingreso_nino.fecha_nnino, ingreso_nino.motivos_ingreso, centro_asistencia.nombre_centro, estado_penal.nombre_estado, incidencias.nombre_incidencia, ingreso_nino.fecha_ingreso, ingreso_nino.no_carpeta, expediente_nino.no_expediente, expediente_incidencia.fecha_egreso, expediente_incidencia.motivos_egreso, expediente_incidencia.persona_responsable, expediente_incidencia.autoriza
                from expediente_nino inner join ingreso_nino on ingreso_nino.id_ingreso=expediente_nino.id_ingreso inner join centro_asistencia on centro_asistencia.id_centro=expediente_nino.id_centro inner join incidencias on incidencias.id_incidencia=expediente_nino.id_incidencia_actual inner join estado_penal on estado_penal.id_estadop=expediente_nino.id_estadop inner join expediente_incidencia on expediente_incidencia.id_incidencia=expediente_nino.id_incidencia_actual where ingreso_nino.fecha_ingreso BETWEEN '".$desde_e."' AND '".$hasta_e."'  AND id_incidencia_actual = 3");
        }
            return ($query->num_rows()<= 0) ? NULL : $query->result();
    
        }
    

    function secciones_en_privilegio($id_privilegio){
     $this->db->select('*');
     $this->db->from('privilegio_seccion');
     $this->db->where('id_privilegio',$id_privilegio);
     $query = $this->db->get();
      return $query->result_array(); 
    }

function devuelve_privilegios_seccion(){
  $this->db->select('count(*)')->from('privilegio_seccion AS ps')->where('ps.id_privilegio = p.id_privilegio');
  $total = $this->db->get_compiled_select();
  $this->db->select('p.*,('.$total.') AS total');
  $this->db->from('privilegio AS p');
  $query = $this->db->get();
  return $query->result();
}

function secciones_privilegio($id_privilegio){
  $this->db->select('ps.*,s.*');
$this->db->from('privilegio_seccion AS ps');
$this->db->join('seccion AS s','ps.id_seccion = s.id_seccion');
$this->db->where('ps.id_privilegio',$id_privilegio);
$query = $this->db->get();
  return $query->result(); 
}

function drop_secciones_faltantes($id_privilegio){
  $arreglo = $this->secciones_en_privilegio($id_privilegio);
  if(!empty($arreglo)){
foreach ($arreglo as $a) {
  $ignore[] = (int)$a['id_seccion'];
}
  }else{
    $ignore = 0;
  }
  //var_dump($ignore);
   $this->db->select('s.*');
$this->db->from('seccion AS s');
$this->db->where_not_in('s.id_seccion',$ignore);
$query = $this->db->get();
  return $query->result(); 

}

function inserta_privilegio_seccion($data){
  $this->db->insert('privilegio_seccion',$data);
}

function elimina_privilegio_seccion($data){
  $this->db->delete('privilegio_seccion',$data);
}

function devuelve_medico($id_expediente){
     $this->db->select('exp.*, ning.*');
		$this->db->from('expediente_nino exp');
		$this->db->join('ingreso_nino as ning','ning.id_ingreso = exp.id_ingreso','left');
		//$this->db->join('v_medico as med','med.id_medico = exp.id_medico');
        //$this->db->where('u.id_usuario', $id_usuario);   
    $this->db->where('exp.id_expediente',$id_expediente);
    $this->db->group_by('exp.id_expediente');
		
	$query = $this->db->get();
	return $query->row_array();	
    }

     function ver_ingreso(){
		$query = $this->db->get('ingreso_nino');
		return $query->result();
	}

        function devuelve_expedientes_medico($bus, $id_expediente){
    $data  = $this->datos_sesion();
    if (empty($bus)) {
    $this->db->select('ex.*, ig.*, med.*');
	$this->db->from('expediente_nino ex');
	$this->db->join('ingreso_nino as ig','ig.id_ingreso = ex.id_ingreso','left');
	$this->db->join('valoracion_medica as med','med.id_medico = ex.id_medico','left');
        }else{
    $this->db->select('ex.*, ig.*, med.*');
	$this->db->from('expediente_nino ex');
	$this->db->join('ingreso_nino as ig','ig.id_ingreso = ex.id_ingreso','left');
	$this->db->join('valoracion_medica as med','med.id_valmedica = ex.id_medico','left');
    $this->db->or_like('no_expediente',$bus);
    $this->db->or_like('nombres_nino',$bus);
    $this->db->or_like('apellido_pnino',$bus);
    $this->db->or_like('apellido_mnino',$bus);
    $this->db->or_like('genero_nino',$bus);
    $this->db->or_like('motivos_ingreso',$bus);
    $this->db->or_like('no_carpeta',$bus);
    $this->db->group_by('ex.id_expediente');
    }
       $query=$this->db->get();
       return $query->result();
    }

    	function insertar_vmedico($data){
		$this->db->insert('valoracion_medica',$data);
		return $this->db->insert_id();
	}

	function devuelve_ninos_vista11($bus, $id_ingreso){
        $data  = $this->datos_sesion();
        if (empty($bus)) {
         $this->db->select('exp.*, ning.*, cen.*');
		$this->db->from('expediente_nino exp');
		$this->db->join('ingreso_nino as ning','ning.id_ingreso = exp.id_ingreso','left');
		$this->db->join('centro_asistencia as cen','cen.id_centro = exp.id_centro');
        //$this->db->where('u.id_usuario', $id_usuario);
        }else{
     $this->db->select('exp.*, ning.*, cen.*');
		$this->db->from('expediente_nino exp');
		$this->db->join('ingreso_nino as ning','ning.id_ingreso = exp.id_ingreso','left');
		$this->db->join('centro_asistencia as cen','cen.id_centro = exp.id_centro');


        $this->db->or_like('nombres_nino',$bus);
        $this->db->or_like('apellido_pnino',$bus);    
        $this->db->or_like('apellido_mnino',$bus);
        $this->db->or_like('genero_nino',$bus);
        $this->db->or_like('nombre_centro',$bus);
        $this->db->or_like('lugar_nnino',$bus);
            $this->db->or_like('fecha_ingreso',$bus);
        $this->db->or_like('motivos_ingreso',$bus);
        $this->db->or_like('no_carpeta',$bus);
         $this->db->or_like('estado_ingreso',$bus);
        $this->db->group_by('ning.id_ingreso');
        //$this->db->where('u.id_usuario', $id_usuario);
        }

       $query=$this->db->get();
       return $query->result();
    }

    function devuelve_ninos_hermanos($carpeta, $id_expediente){
    $data=$this->datos_sesion();
    //var_dump($carpeta);
    //var_dump($id_expediente);
    //die();
    $this->db->select('i.*,e.*,c.*,ep.*');
    $this->db->from('expediente_nino as e');
    $this->db->join('ingreso_nino as i','i.id_ingreso=e.id_ingreso','left');
    $this->db->join('centro_asistencia as c','c.id_centro=e.id_centro','left');
    $this->db->join('estado_penal as ep','ep.id_estadop=e.id_estadop','left');
    $this->db->where('i.no_carpeta', $carpeta);
    $this->db->where('e.id_expediente !=', $id_expediente);
  
    $query = $this->db->get();
    return $query->result();
    }

    function devuelve_carpeta($id_ingreso){
    $data=$this->datos_sesion();
    $this->db->select('no_carpeta');
    $this->db->from('ingreso_nino');
    $this->db->where('id_ingreso', $id_ingreso);
  
    return $this->db->get()->row()->no_carpeta;
    }

    function devuelve_id_exp($id_expediente){
    $data=$this->datos_sesion();
    $this->db->select('id_expediente');
    $this->db->from('expediente_nino');
    $this->db->where('id_expediente', $id_expediente);
  
    return $this->db->get()->row()->id_expediente;
    }

    function devuelve_id_ing($id_ingreso){
    $data=$this->datos_sesion();
    $this->db->select('id_ingreso');
    $this->db->from('ingreso_nino');
    $this->db->where('id_ingreso', $id_ingreso);
  
    return $this->db->get()->row()->id_ingreso;
    }

	function devuelve_hermanos1(){
    $data=$this->datos_sesion();
    $this->db->select('ing.*,expn.*,cena.*');
    $this->db->from('expediente_nino as expn');
    $this->db->join('ingreso_nino as ing','ing.id_ingreso=expn.id_ingreso','left');
    $this->db->join('centro_asistencia as cena','cena.id_centro=expn.id_centro','left');
      $this->db->where('ex.id_expediente','AQE628U3333');
  
    $query = $this->db->get();
    return $query->result();
    }
	function devuelve_busqueda_estadop(){
      $data=$this->datos_sesion();
      $this->db->select('ingreso_nino.nombres_nino,ingreso_nino.apellido_pnino,ingreso_nino.apellido_mnino,ingreso_nino.genero_nino,ingreso_nino.fecha_ingreso,ingreso_nino.motivos_ingreso,centro_asistencia.nombre_centro,expediente_nino.no_expediente,estado_penal.nombre_estado');
      $this->db->from('expediente_nino');
      $this->db->join('ingreso_nino','ingreso_nino.id_ingreso=expediente_nino.id_ingreso','left');
      $this->db->join('centro_asistencia','centro_asistencia.id_centro=expediente_nino.id_centro','left');
      $this->db->join('estado_penal','estado_penal.id_estadop=expediente_nino.id_estadop','left');
  
      $query = $this->db->get();
      return $query->result();
    }

    function devuelve_ninos_juicio(){
    $data=$this->datos_sesion();
    $this->db->select('ingreso_nino.no_carpeta,ingreso_nino.hermanos,ingreso_nino.discapacidad,ingreso_nino.nombres_nino,ingreso_nino.apellido_pnino,ingreso_nino.apellido_mnino,ingreso_nino.genero_nino,ingreso_nino.fecha_ingreso,ingreso_nino.motivos_ingreso,ingreso_nino.fecha_nnino,centro_asistencia.nombre_centro,expediente_nino.no_expediente,estado_penal.nombre_estado');
    $this->db->from('expediente_nino');
    $this->db->join('ingreso_nino','ingreso_nino.id_ingreso=expediente_nino.id_ingreso','left');
    $this->db->join('centro_asistencia','centro_asistencia.id_centro=expediente_nino.id_centro','left');
    $this->db->join('estado_penal','estado_penal.id_estadop=expediente_nino.id_estadop','left');
    $this->db->where('expediente_nino.id_estadop', '1');
  
    $query = $this->db->get();
    return $query->result();
    }

       	function devuelve_ninos_resueltos(){
   $data  = $this->datos_sesion();
        if (empty($bus)) {
    $this->db->select('ingreso_nino.no_carpeta,ingreso_nino.hermanos,ingreso_nino.discapacidad,ingreso_nino.nombres_nino,ingreso_nino.apellido_pnino,ingreso_nino.apellido_mnino,ingreso_nino.genero_nino,ingreso_nino.fecha_ingreso,ingreso_nino.motivos_ingreso,centro_asistencia.nombre_centro,expediente_nino.no_expediente,estado_penal.nombre_estado');
    $this->db->from('expediente_nino');
    $this->db->join('ingreso_nino','ingreso_nino.id_ingreso=expediente_nino.id_ingreso','left');
    $this->db->join('centro_asistencia','centro_asistencia.id_centro=expediente_nino.id_centro','left');
  $this->db->join('estado_penal','estado_penal.id_estadop=expediente_nino.id_estadop','left');
    $this->db->where('expediente_nino.id_estadop', '4');
   
        }
    $query = $this->db->get();
    return $query->result();
    }


    	function devuelve_hermanos(){
    $data=$this->datos_sesion();
    $this->db->select('ingreso_nino.no_carpeta,ingreso_nino.hermanos,ingreso_nino.discapacidad,ingreso_nino.nombres_nino,ingreso_nino.apellido_pnino,ingreso_nino.apellido_mnino,ingreso_nino.genero_nino,ingreso_nino.fecha_ingreso,ingreso_nino.motivos_ingreso,centro_asistencia.nombre_centro,expediente_nino.no_expediente,estado_penal.nombre_estado');
    $this->db->from('expediente_nino');
    $this->db->join('ingreso_nino','ingreso_nino.id_ingreso=expediente_nino.id_ingreso','left');
    $this->db->join('centro_asistencia','centro_asistencia.id_centro=expediente_nino.id_centro','left');
    $this->db->join('estado_penal','estado_penal.id_estadop=expediente_nino.id_estadop','left');
    $this->db->where('expediente_nino.id_estadop', '1');
     $this->db->where('ingreso_nino.hermanos', 'Si');;
  
    $query = $this->db->get();
    return $query->result();
    }
    function devuelve_hermanos2(){
    $data=$this->datos_sesion();
    $this->db->select('ingreso_nino.no_carpeta,ingreso_nino.hermanos,ingreso_nino.discapacidad,ingreso_nino.nombres_nino,ingreso_nino.apellido_pnino,ingreso_nino.apellido_mnino,ingreso_nino.genero_nino,ingreso_nino.fecha_ingreso,ingreso_nino.motivos_ingreso,centro_asistencia.nombre_centro,expediente_nino.no_expediente,estado_penal.nombre_estado');
    $this->db->from('expediente_nino');
    $this->db->join('ingreso_nino','ingreso_nino.id_ingreso=expediente_nino.id_ingreso','left');
    $this->db->join('centro_asistencia','centro_asistencia.id_centro=expediente_nino.id_centro','left');
    $this->db->join('estado_penal','estado_penal.id_estadop=expediente_nino.id_estadop','left');
    $this->db->where('expediente_nino.id_estadop', '1');
     $this->db->where('ingreso_nino.hermanos', 'No');
     //$this->db->group_by('ingreso_nino.hermanos', 'No');
  
    $query = $this->db->get();
    return $query->result();
    }

       function devuelve_discapacidad1(){
    $data=$this->datos_sesion();
    $this->db->select('ingreso_nino.no_carpeta,ingreso_nino.hermanos,ingreso_nino.discapacidad,ingreso_nino.nombres_nino,ingreso_nino.apellido_pnino,ingreso_nino.apellido_mnino,ingreso_nino.genero_nino,ingreso_nino.fecha_ingreso,ingreso_nino.motivos_ingreso,centro_asistencia.nombre_centro,expediente_nino.no_expediente,estado_penal.nombre_estado');
    $this->db->from('expediente_nino');
    $this->db->join('ingreso_nino','ingreso_nino.id_ingreso=expediente_nino.id_ingreso','left');
    $this->db->join('centro_asistencia','centro_asistencia.id_centro=expediente_nino.id_centro','left');
    $this->db->join('estado_penal','estado_penal.id_estadop=expediente_nino.id_estadop','left');
    $this->db->where('expediente_nino.id_estadop', '1');
     $this->db->where('ingreso_nino.discapacidad', 'Si');
     //$this->db->group_by('ingreso_nino.hermanos', 'No');
  
    $query = $this->db->get();
    return $query->result();
    }
           function devuelve_discapacidad2(){
    $data=$this->datos_sesion();
    $this->db->select('ingreso_nino.no_carpeta,ingreso_nino.hermanos,ingreso_nino.discapacidad,ingreso_nino.nombres_nino,ingreso_nino.apellido_pnino,ingreso_nino.apellido_mnino,ingreso_nino.genero_nino,ingreso_nino.fecha_ingreso,ingreso_nino.motivos_ingreso,centro_asistencia.nombre_centro,expediente_nino.no_expediente,estado_penal.nombre_estado');
    $this->db->from('expediente_nino');
    $this->db->join('ingreso_nino','ingreso_nino.id_ingreso=expediente_nino.id_ingreso','left');
    $this->db->join('centro_asistencia','centro_asistencia.id_centro=expediente_nino.id_centro','left');
    $this->db->join('estado_penal','estado_penal.id_estadop=expediente_nino.id_estadop','left');
    $this->db->where('expediente_nino.id_estadop', '1');
     $this->db->where('ingreso_nino.discapacidad', 'No');
     //$this->db->group_by('ingreso_nino.hermanos', 'No');
  
    $query = $this->db->get();
    return $query->result();
    }
    
     function devuelve_opcion1(){
    $data=$this->datos_sesion();
    $this->db->select('ingreso_nino.no_carpeta,ingreso_nino.hermanos,ingreso_nino.discapacidad,ingreso_nino.nombres_nino,ingreso_nino.apellido_pnino,ingreso_nino.apellido_mnino,ingreso_nino.genero_nino,ingreso_nino.fecha_ingreso,ingreso_nino.motivos_ingreso,centro_asistencia.nombre_centro,expediente_nino.no_expediente,estado_penal.nombre_estado');
    $this->db->from('expediente_nino');
    $this->db->join('ingreso_nino','ingreso_nino.id_ingreso=expediente_nino.id_ingreso','left');
    $this->db->join('centro_asistencia','centro_asistencia.id_centro=expediente_nino.id_centro','left');
    $this->db->join('estado_penal','estado_penal.id_estadop=expediente_nino.id_estadop','left');
    $this->db->where('expediente_nino.id_estadop', '1');
     $this->db->where('ingreso_nino.hermanos', 'Si');
     $this->db->where('ingreso_nino.discapacidad', 'Si');
     
     //$this->db->group_by('ingreso_nino.hermanos', 'No');
  
    $query = $this->db->get();
    return $query->result();
    }
         function devuelve_opcion2(){
    $data=$this->datos_sesion();
    $this->db->select('ingreso_nino.no_carpeta,ingreso_nino.hermanos,ingreso_nino.discapacidad,ingreso_nino.nombres_nino,ingreso_nino.apellido_pnino,ingreso_nino.apellido_mnino,ingreso_nino.genero_nino,ingreso_nino.fecha_ingreso,ingreso_nino.motivos_ingreso,centro_asistencia.nombre_centro,expediente_nino.no_expediente,estado_penal.nombre_estado');
    $this->db->from('expediente_nino');
    $this->db->join('ingreso_nino','ingreso_nino.id_ingreso=expediente_nino.id_ingreso','left');
    $this->db->join('centro_asistencia','centro_asistencia.id_centro=expediente_nino.id_centro','left');
    $this->db->join('estado_penal','estado_penal.id_estadop=expediente_nino.id_estadop','left');
    $this->db->where('expediente_nino.id_estadop', '1');
    $this->db->where('ingreso_nino.hermanos', 'Si');
     $this->db->where('ingreso_nino.discapacidad', 'No');
      
     //$this->db->group_by('ingreso_nino.hermanos', 'No');
  
    $query = $this->db->get();
    return $query->result();
    }

    function devuelve_opcion3(){
    $data=$this->datos_sesion();
    $this->db->select('ingreso_nino.no_carpeta,ingreso_nino.hermanos,ingreso_nino.discapacidad,ingreso_nino.nombres_nino,ingreso_nino.apellido_pnino,ingreso_nino.apellido_mnino,ingreso_nino.genero_nino,ingreso_nino.fecha_ingreso,ingreso_nino.motivos_ingreso,centro_asistencia.nombre_centro,expediente_nino.no_expediente,estado_penal.nombre_estado');
    $this->db->from('expediente_nino');
    $this->db->join('ingreso_nino','ingreso_nino.id_ingreso=expediente_nino.id_ingreso','left');
    $this->db->join('centro_asistencia','centro_asistencia.id_centro=expediente_nino.id_centro','left');
    $this->db->join('estado_penal','estado_penal.id_estadop=expediente_nino.id_estadop','left');
    $this->db->where('expediente_nino.id_estadop', '1');
    $this->db->where('ingreso_nino.hermanos', 'No');
     $this->db->where('ingreso_nino.discapacidad', 'Si');
      
     //$this->db->group_by('ingreso_nino.hermanos', 'No');
  
    $query = $this->db->get();
    return $query->result();
    }

             function devuelve_opcion4(){
    $data=$this->datos_sesion();
    $this->db->select('ingreso_nino.no_carpeta,ingreso_nino.hermanos,ingreso_nino.discapacidad,ingreso_nino.nombres_nino,ingreso_nino.apellido_pnino,ingreso_nino.apellido_mnino,ingreso_nino.genero_nino,ingreso_nino.fecha_ingreso,ingreso_nino.motivos_ingreso,centro_asistencia.nombre_centro,expediente_nino.no_expediente,estado_penal.nombre_estado');
    $this->db->from('expediente_nino');
    $this->db->join('ingreso_nino','ingreso_nino.id_ingreso=expediente_nino.id_ingreso','left');
    $this->db->join('centro_asistencia','centro_asistencia.id_centro=expediente_nino.id_centro','left');
    $this->db->join('estado_penal','estado_penal.id_estadop=expediente_nino.id_estadop','left');
    $this->db->where('expediente_nino.id_estadop', '1');
    $this->db->where('ingreso_nino.hermanos', 'No');
     $this->db->where('ingreso_nino.discapacidad', 'No');
      
     //$this->db->group_by('ingreso_nino.hermanos', 'No');
  
    $query = $this->db->get();
    return $query->result();
    }
    
    function busca_ga($busca){
        $this->db->select('*');
        $this->db->from('ingreso_nino');
        $this->db->like('fecha_ingreso',$busca);
        $query = $this->db->get();
        return $query->result();

    }

    function tabla(){
      $this->db->select('*'); 
      $this->db->FROM('expediente_nino'); 
      $this->db->join('ingreso_nino','ingreso_nino.id_ingreso = expediente_nino.id_ingreso','left');	

      $query = $this->db->get();
		return $query->result();
    }

    function genero_femenino(){
      $this->db->select('ex.*, in.*, count(genero_nino) AS genero'); 
      $this->db->from('ingreso_nino in'); 
      $this->db->join('expediente_nino as ex','in.id_ingreso = ex.id_ingreso','left');
      $this->db->where('in.genero_nino' , 'Femenino');

      $query = $this->db->get();
      //echo $query;
      return $query->row_array();
	}

    function genero_masculino(){
      $this->db->select('ex.*,  in.*, count(genero_nino) AS genero'); 
      $this->db->from('ingreso_nino in'); 
      $this->db->join('expediente_nino as ex','in.id_ingreso = ex.id_ingreso','left');
      $this->db->where('in.genero_nino' , 'Masculino');

      $query = $this->db->get();
      return $query->row_array();
    }

    function estadistica_ingresos(){
        
        
        $this->db->select('en.*, count(id_expediente) AS id_expediente'); 
    	$this->db->from('expediente_nino as en'); 
    	$this->db->where('en.id_incidencia_actual' , '1' );

        $query = $this->db->get();
	    return $query->row_array();
    }

    function en_juicio(){
    	$this->db->select('en.*,COUNT(id_expediente) AS id_expediente'); 
    	$this->db->from('expediente_nino as en'); 
    	$this->db->where('en.id_estadop' , '1');

    	$query = $this->db->get();
	    return $query->row_array();	
    }

    function convenios_asistenciales(){
    	$this->db->select('en.*, count(id_expediente) AS id_expediente'); 
    	$this->db->from('expediente_nino as en'); 
    	$this->db->where('en.id_estadop' , '2');

    	$query = $this->db->get();
	    return $query->row_array();	
    }

	    function tramite_administrativo(){
    	$this->db->select('en.*,count(id_expediente) AS id_expediente'); 
    	$this->db->from('expediente_nino as en'); 
    	$this->db->where('en.id_estadop' , '3');

    	$query = $this->db->get();
	    return $query->row_array();	
    }

    function situacion_juridica_resuelta(){
    	$this->db->select('en.*,count(id_expediente) AS id_expediente'); 
    	$this->db->from('expediente_nino as en'); 
    	$this->db->where('en.id_estadop' , '4');

    	$query = $this->db->get();
	    return $query->row_array();	
    }

    function fugados_gr(){
    	$this->db->select('en.*,count(id_expediente) AS id_expediente'); 
    	$this->db->from('expediente_nino as en'); 
    	$this->db->where('en.id_estadop' , '5');

    	$query = $this->db->get();
	    return $query->row_array();	
    }

    function estadistica_egresos(){
        

    	$this->db->select('en.*,count(id_expediente) AS id_expediente'); 
    	$this->db->from('expediente_nino as en'); 
    	$this->db->where('en.id_incidencia_actual' , '2');

    	$query = $this->db->get();
	    return $query->row_array();	
    }

    function estadistica_fugados(){
      

    	$this->db->select('en.*, count(id_expediente) AS id_expediente'); 
    	$this->db->from('expediente_nino as en'); 
    	$this->db->where('en.id_incidencia_actual' , '3');

    	$query = $this->db->get();
	    return $query->row_array();	
    }

    function estadistica_trasladados(){
        $this->db->select('en.*, count(id_expediente) AS id_expediente'); 
    	$this->db->from('expediente_nino as en'); 
    	$this->db->where('id_incidencia_actual' , '4');

    	$query = $this->db->get();
	    return $query->row_array();
    }

    function devuelve_carpeta_hermanos(){
    $data=$this->datos_sesion();
    $this->db->select('ingreso_nino.no_carpeta,ingreso_nino.id_ingreso,ingreso_nino.hermanos,ingreso_nino.discapacidad,ingreso_nino.edad_nino,ingreso_nino.nombres_nino,ingreso_nino.apellido_pnino,ingreso_nino.apellido_mnino,ingreso_nino.genero_nino,ingreso_nino.fecha_ingreso,ingreso_nino.motivos_ingreso,centro_asistencia.nombre_centro,expediente_nino.no_expediente,estado_penal.nombre_estado');
    $this->db->from('expediente_nino');
    $this->db->join('ingreso_nino','ingreso_nino.id_ingreso=expediente_nino.id_ingreso','left');
    $this->db->join('centro_asistencia','centro_asistencia.id_centro=expediente_nino.id_centro','left');
    $this->db->join('estado_penal','estado_penal.id_estadop=expediente_nino.id_estadop','left');
    //$this->db->where('expediente_nino.id_expediente');
     $this->db->where('ingreso_nino.hermanos', 'Si');;
  
    $query = $this->db->get();
    return $query->result();
    }

    function devuelve_carpeta_hermanostodos(){
    $data=$this->datos_sesion();
    $this->db->select('ingreso_nino.no_carpeta,ingreso_nino.id_ingreso,ingreso_nino.hermanos,ingreso_nino.discapacidad,ingreso_nino.edad_nino,ingreso_nino.nombres_nino,ingreso_nino.apellido_pnino,ingreso_nino.apellido_mnino,ingreso_nino.genero_nino,ingreso_nino.fecha_ingreso,ingreso_nino.motivos_ingreso,centro_asistencia.nombre_centro,expediente_nino.no_expediente,estado_penal.nombre_estado');
    $this->db->from('expediente_nino');
    $this->db->join('ingreso_nino','ingreso_nino.id_ingreso=expediente_nino.id_ingreso','left');
    $this->db->join('centro_asistencia','centro_asistencia.id_centro=expediente_nino.id_centro','left');
    $this->db->join('estado_penal','estado_penal.id_estadop=expediente_nino.id_estadop','left');
    $this->db->where('ingreso_nino.no_carpeta','AQE628U3333');
     $this->db->where('ingreso_nino.hermanos', 'Si');
     
  
    $query = $this->db->get();
    return $query->result();
    }


     function devuelve_expedientes_tb($bus, $id_expediente){
    $data  = $this->datos_sesion();
    if (empty($bus)) {
    $this->db->select('ex.*, ce.*, ig.*');
	$this->db->from('expediente_nino ex');
	$this->db->join('centro_asistencia as ce','ce.id_centro = ex.id_centro');
	$this->db->join('ingreso_nino as ig','ig.id_ingreso = ex.id_ingreso');
        }else{
    $this->db->select('ex.*, ce.*, ig.*');
	$this->db->from('expediente_nino ex');
	$this->db->join('centro_asistencia as ce','ce.id_centro = ex.id_centro');
	$this->db->join('ingreso_nino as ig','ig.id_ingreso = ex.id_ingreso');

    $this->db->or_like('nombre_centro',$bus);
    $this->db->or_like('nombres_nino',$bus);
    $this->db->or_like('apellido_pnino',$bus);
    $this->db->or_like('apellido_mnino',$bus);
    $this->db->or_like('fecha_nnino',$bus);
    $this->db->or_like('fecha_ingreso',$bus);
    $this->db->or_like('genero_nino',$bus);
    $this->db->or_like('motivos_ingreso',$bus);
    $this->db->or_like('no_carpeta',$bus);
    $this->db->or_like('no_expediente',$bus);
    $this->db->group_by('ex.id_expediente');
    }
       $query=$this->db->get();
       return $query->result();
    }


	function insertar_visitad($data){
		$this->db->insert('informe_visitad',$data);
		return $this->db->insert_id();
	}

    function insertar_informefa($data){
		$this->db->insert('informe_psfamiliar',$data);
		return $this->db->insert_id();
	}

	function insertar_nota($data){
		$this->db->insert('notas',$data);
		return $this->db->insert_id();
	}

	function insertar_menor($data){
		$this->db->insert('informe_menor',$data);
		return $this->db->insert_id();
    }
    
    //valoración jurídica 
    function insertar_valoracion_juridica($data){
        $this->db->insert('valoracion_juridica',$data);
		return $this->db->insert_id();
    }

    //datos de personas 
    function datos_persona(){
        $data = $this->datos_sesion();
        $id_per = $data['id_persona'];
        $this->db->select('*');
        $this->db->from('persona');
        $this->db->where('id_persona',$id_per);
       
        $query=$this->db->get();
        return $query->row_array();
    }




    //MOSTRAR IMAGENES DE LA VISITA DOMICILIARIA

    function devuelve_datos_visitad($id_visitad){
        $this->db->select('v.*, a.*');
        $this->db->from('informe_visitad AS v');
        $this->db->join('archivo AS a', 'v.id_imagen=a.id_archivo');
        $this->db->where('v.id_visitad', $id_visitad);

        $query = $this->db->get();
        return $query->row_array();
    }

    function devuelve_archivos_edicion($id_visitad){
        $this->db->select('va.*, a.*');
        $this->db->from('visita_archivo AS va');
		$this->db->join('archivo as a','va.id_archivo = a.id_archivo');
        $this->db->where('va.id_visitad',$id_visitad);

        $query = $this->db->get();
		return $query->result();
    }

    function valida_archivo_thumbnail($ruta){
        $path = FCPATH."uploadt/";
		$servidor = base_url('uploadt/');
		if((file_exists($path.$ruta)===FALSE)or($ruta==null)){
			return $servidor."image_not_found.png";
		}else{
			return $servidor."/".$ruta;	
		}
    }

    function valida_archivo($ruta){
		$path = FCPATH."assets/img/";
		$servidor = base_url('assets/img/');
		if((file_exists($path.$ruta)===FALSE)or($ruta==null)){
			return $servidor."image_not_found.png";
		}else{
			return $servidor."/".$ruta;	
		}
	}
    
    function cargar_archivo($campo,$tipo_archivo){
        if($_FILES[$campo]['name']){
			switch($tipo_archivo){
				case 1:
					$config['upload_path'] = 'assets/img/';
					$config['allowed_types'] = 'jpg|png|gif';
				break;
			}
			$config['max_size'] = '5120';
			$config['file_name'] = random_string('alnum', 10);
			$extension = substr(strrchr($_FILES[$campo]['name'],'.'),1);
			$nombre_archivo = $config['file_name'].".".$extension;
			$this->upload->initialize($config);
			
			if($this->upload->do_upload($campo)){
				$this->resizeImage($nombre_archivo);
				return ($this->inserta_archivo($nombre_archivo,$_FILES[$campo]['name']));
			}else{
				$this->session->set_flashdata('mensaje_error',$this->upload->display_errors());
				return FALSE;
			}
		}ELSE{
			return FALSE;
		}
    }


    function resizeImage($filename){
		$source_path = FCPATH."assets/img/".$filename;
		$target_path = FCPATH."assets/img/thumbnail/".$filename;
		$config_manip = array(
			'image_library' => 'gd2',
			'source_image' => $source_path,
			'new_image' => $target_path,
			'maintain_ratio' => TRUE,
			'create_thumb' => TRUE,
			'thumb_marker' => '',
			'width' => 150,
			'height' => 150
		);
		$this->load->library('image_lib',$config_manip);
		if(!$this->image_lib->resize()){
			echo $this->image_lib->display_errors();
		}else{
			$this->image_lib->clear();
		}
	}

    function inserta_archivo($nombre_archivo){
		$this->db->set('nombre_archivo',$nombre_archivo);
        $this->db->insert('archivo');
        
		return $this->db->insert_id();
	}

    function inserta_archivo_visita($data){
        $this->db->insert('visita_archivo',$data);
        return $this->db->insert_id();
    }


    function elimina_archivo($id_archivo){
		$this->db->delete('visita_archivo',array('id_archivo' => $id_archivo));
		$this->db->delete('archivo',array('id_archivo' => $id_archivo));
		
	}
	
	function borra_archivo($archivo){
		unlink(FCPATH."assets/img/".$archivo['nombre_archivo']);
		unlink(FCPATH."assets/img/thumbnail/".$archivo['nombre_archivo']);
    }
    
    function devuelve_archivo($id_archivo){
		$this->db->select('*');
		$this->db->from('archivo');
		$this->db->where('id_archivo',$id_archivo);
		
		$query = $this->db->get();
		return $query->row_array();
	}

    function devuelve_valpsi($id_expediente){
        $this->db->select('*');
        $this->db->from('valoracion_psicologica');
        $this->db->where('fk_expediente',$id_expediente);

        $query = $this->db->get();
		return $query->result();
    }

    function devuelve_valnut($id_expediente){
        $this->db->select('*');
        $this->db->from('valoracion_nutriologica');
        $this->db->where('fk_expediente',$id_expediente);

        $query = $this->db->get();
		return $query->result();
    }


    function devuelve_valped($id_expediente){
        $this->db->select('*');
        $this->db->from('valoracion_pedagogica');
        $this->db->where('fk_expediente',$id_expediente);

        $query = $this->db->get();
		return $query->result();
    }


    function devuelve_valmed($id_expediente){
        $this->db->select('*');
        $this->db->from('valoracion_medica');
        $this->db->where('fk_expediente',$id_expediente);

        $query = $this->db->get();
		return $query->result();
    }

    function devuelve_informe($id_expediente){
        $this->db->select('*');
        $this->db->from('informe_menor');
        $this->db->where('fk_expediente',$id_expediente);

        $query = $this->db->get();
		return $query->result();
    }

    function devuelve_notas($id_expediente){
        $this->db->select('*');
        $this->db->from('notas');
        $this->db->where('fk_expediente',$id_expediente);

        $query = $this->db->get();
		return $query->result();
    }

    function devuelve_inf_familiar($id_expediente){
        $this->db->select('*');
        $this->db->from('informe_psfamiliar');
        $this->db->where('fk_expediente',$id_expediente);

        $query = $this->db->get();
		return $query->result();
    }

    function exp_cassa($id_centro){
		$this->db->select('ce.*,ig.*,ex.*,in.*,ep.*');
		$this->db->from('expediente_nino ex');
		$this->db->join('centro_asistencia as ce','ce.id_centro = ex.id_centro');
		$this->db->join('ingreso_nino as ig','ig.id_ingreso = ex.id_ingreso');
		$this->db->join('incidencias as in','in.id_incidencia = ex.id_incidencia_actual');
		$this->db->join('estado_penal as ep','ep.id_estadop = ex.id_estadop');
		$this->db->where('ex.id_centro',$id_centro);
		$this->db->where('ex.id_incidencia_actual','1');

		$query = $this->db->get();
		return $query->result();
    }

    function de_ver_valoracion_psicologica($id_expediente){
      $this->db->select('*');
      $this->db->from('valoracion_psicologica');
      $this->db->where('id_valpsicologia',$id_expediente);
  
      $query = $this->db->get();
      return $query->row_array();
     }

     function de_ver_valoracion_pmenor($id_expediente){
        $this->db->select('*');
        $this->db->from('informe_menor');
        $this->db->where('id_menor',$id_expediente);
    
        $query = $this->db->get();
        return $query->row_array();
       }

       function ver_notas($id_expediente){
        $this->db->select('*');
        $this->db->from('notas');
        $this->db->where('id_nota',$id_expediente);
    
        $query = $this->db->get();
        return $query->row_array();
       }

       function de_ver_valoracion_familiar($id_expediente){
        $this->db->select('*');
        $this->db->from('informe_psfamiliar');
        $this->db->where('id_infamiliar',$id_expediente);
    
        $query = $this->db->get();
        return $query->row_array();
       }

       function devuelve_expedientes_valoracion_psicologia($bus,$id_persona){
        $data  = $this->datos_sesion();
        if (empty($bus)) {
        $this->db->select('ex.*, ce.*, ig.*, us.*, eq.*, pr.*, pe.*');
        $this->db->from('expediente_nino ex');
        $this->db->join('centro_asistencia as ce','ce.id_centro = ex.id_centro');
        $this->db->join('ingreso_nino as ig','ig.id_ingreso = ex.id_ingreso');
        $this->db->join('equipos as eq','eq.fk_expediente = ex.id_expediente');
        $this->db->join('usuario as us','us.id_persona = eq.id_persona');
        $this->db->join('privilegio as pr','pr.id_privilegio = us.id_privilegio');
        $this->db->join('persona as pe','pe.id_persona = eq.id_persona');
        $this->db->where('pr.id_privilegio', '4');
        $this->db->where('ex.estatus_val_psi', '1');
        $this->db->where('eq.id_persona', $id_persona);
        $this->db->order_by('fecha_ingreso DESC');
        
            }else{
        $this->db->select('ex.*, ce.*, ig.*, us.*, eq.*, pr.*, pe.*');
        $this->db->from('expediente_nino ex');
        $this->db->join('centro_asistencia as ce','ce.id_centro = ex.id_centro');
        $this->db->join('ingreso_nino as ig','ig.id_ingreso = ex.id_ingreso');
        $this->db->join('equipos as eq','eq.fk_expediente = ex.id_expediente');
        $this->db->join('usuario as us','us.id_persona = eq.id_persona');
        $this->db->join('privilegio as pr','pr.id_privilegio = us.id_privilegio');
        $this->db->join('persona as pe','pe.id_persona = eq.id_persona');
        $this->db->where('pr.id_privilegio', '4');
        $this->db->where('ex.estatus_val_psi', '1');
        $this->db->where('eq.id_persona', $id_persona);
        $this->db->order_by('fecha_ingreso DESC');
    
        $this->db->or_like('nombre_centro',$bus);
        $this->db->or_like('nombres_nino',$bus);
        $this->db->or_like('apellido_pnino',$bus);
        $this->db->or_like('apellido_mnino',$bus);
        $this->db->or_like('fecha_nnino',$bus);
        $this->db->or_like('fecha_ingreso',$bus);
        $this->db->or_like('genero_nino',$bus);
        $this->db->or_like('motivos_ingreso',$bus);
        $this->db->or_like('no_carpeta',$bus);
        $this->db->or_like('no_expediente',$bus);
        $this->db->group_by('ex.id_expediente');
        } 
           $query=$this->db->get();
           return $query->result();
        }
        
        //Actualiza Estatu De Valoracion Psicologica
        function actualiza_estatus_val_psi($id_exp,$estatus){
        $this->db->where('id_expediente',$id_exp);
        $this->db->update('expediente_nino',$estatus);
        }

          //Actualizar estatus de trabajo social 
        function actualiza_estatus_tra_soc($id_exp,$estatus){
        $this->db->where('id_expediente',$id_exp);
        $this->db->update('expediente_nino',$estatus);

    }

         //Edita Valoración Psicológica
        function actualiza_valoracion_psicologia($data,$id_valpsicologia){
        $this->db->where('id_valpsicologia', $id_valpsicologia);
        $this->db->update('valoracion_psicologica', $data);
        }

        //Edita Informe Menor
        function actualiza_informe($data,$id_menor){
        $this->db->where('id_menor', $id_menor);
        $this->db->update('informe_menor', $data);
         }

        //Edita Notas
        function actualizar_nota($data,$id_nota){
        $this->db->where('id_nota', $id_nota);
        $this->db->update('notas', $data);
        }

        
        function actualiza_inf_fam($data,$id_infamiliar){
        $this->db->where('id_infamiliar', $id_infamiliar);
        $this->db->update('informe_psfamiliar', $data);
        }
        
        function de_ver_valoracion_visita($data){
         $this->db->select('vd.*,ex.*');
          $this->db->from('informe_visitad vd');
          $this->db->join('expediente_nino as ex','ex.id_expediente = vd.fk_expediente');
          $this->db->where('id_expediente',$data);
      
          $query = $this->db->get();
          return $query->row_array();
         }

         function de_ver_valoracion_nut($data){
            $this->db->select('vd.*,ex.*');
             $this->db->from('valoracion_nutriologica vd');
             $this->db->join('expediente_nino as ex','ex.id_expediente = vd.fk_expediente');
             $this->db->where('id_expediente',$data);
         
             $query = $this->db->get();
             return $query->row_array();
            }


        function del_ver_valoracion_nut($data){
            $this->db->select('vd.*,ex.*');
            $this->db->from('valoracion_nutriologica vd');
            $this->db->join('expediente_nino as ex','ex.id_expediente = vd.fk_expediente');
            $this->db->where('id_valnutricion',$data);
        
            $query = $this->db->get();
            return $query->row_array();
        }

         function actualizar_social($data,$id_visitad){
            $this->db->where('id_visitad', $id_visitad);
            $this->db->update('informe_visitad', $data);
         }

         function devuelve_expedientes_valoracion_nutriologica($bus,$id_expediente){
            $data  = $this->datos_sesion();
            if (empty($bus)) {
            $this->db->select('ex.*, ce.*, ig.*');
            $this->db->from('expediente_nino ex');
            $this->db->join('centro_asistencia as ce','ce.id_centro = ex.id_centro');
            $this->db->join('ingreso_nino as ig','ig.id_ingreso = ex.id_ingreso');
            $this->db->where('ex.estatus_val_nut', '0');
            $this->db->order_by('fecha_ingreso DESC');
        
                }else{
            $this->db->select('ex.*, ce.*, ig.*');
            $this->db->from('expediente_nino ex');
            $this->db->join('centro_asistencia as ce','ce.id_centro = ex.id_centro');
            $this->db->join('ingreso_nino as ig','ig.id_ingreso = ex.id_ingreso');
            $this->db->where('ex.estatus_val_nut', '0');
            $this->db->order_by('fecha_ingreso DESC');
          
        
            $this->db->like('nombre_centro',$bus);
            $this->db->or_like('nombres_nino',$bus);
            $this->db->or_like('apellido_pnino',$bus);
            $this->db->or_like('apellido_mnino',$bus);
            $this->db->or_like('fecha_nnino',$bus);
            $this->db->or_like('fecha_ingreso',$bus);
            $this->db->or_like('genero_nino',$bus);
            $this->db->or_like('motivos_ingreso',$bus);
            $this->db->or_like('no_carpeta',$bus);
            $this->db->or_like('no_expediente',$bus);
            $this->db->group_by('ex.id_expediente');
            }
               $query=$this->db->get();
               return $query->result();
         }

         function devuelve_expedientes_con_valoracion_nutriologica($bus,$id_expediente){
            $data  = $this->datos_sesion();
            if (empty($bus)) {
            $this->db->select('ex.*, ce.*, ig.*');
            $this->db->from('expediente_nino ex');
            $this->db->join('centro_asistencia as ce','ce.id_centro = ex.id_centro');
            $this->db->join('ingreso_nino as ig','ig.id_ingreso = ex.id_ingreso');
            $this->db->where('ex.estatus_val_nut', '1');
            $this->db->order_by('fecha_ingreso DESC');
        
                }else{
            $this->db->select('ex.*, ce.*, ig.*');
            $this->db->from('expediente_nino ex');
            $this->db->join('centro_asistencia as ce','ce.id_centro = ex.id_centro');
            $this->db->join('ingreso_nino as ig','ig.id_ingreso = ex.id_ingreso');
            $this->db->where('ex.estatus_val_nut', '1');
            $this->db->order_by('fecha_ingreso DESC');
          
        
            $this->db->like('nombre_centro',$bus);
            $this->db->or_like('nombres_nino',$bus);
            $this->db->or_like('apellido_pnino',$bus);
            $this->db->or_like('apellido_mnino',$bus);
            $this->db->or_like('fecha_nnino',$bus);
            $this->db->or_like('fecha_ingreso',$bus);
            $this->db->or_like('genero_nino',$bus);
            $this->db->or_like('motivos_ingreso',$bus);
            $this->db->or_like('no_carpeta',$bus);
            $this->db->or_like('no_expediente',$bus);
            $this->db->group_by('ex.id_expediente');
            }
           $query=$this->db->get();
           return $query->result();
    
        }

        function devuelve_expedientes_valoracion_pedagogica($bus,$id_expediente){
            $data  = $this->datos_sesion();
            if (empty($bus)) {
            $this->db->select('ex.*, ce.*, ig.*');
            $this->db->from('expediente_nino ex');
            $this->db->join('centro_asistencia as ce','ce.id_centro = ex.id_centro');
            $this->db->join('ingreso_nino as ig','ig.id_ingreso = ex.id_ingreso');
            $this->db->where('ex.estatus_val_ped', '0');
            $this->db->order_by('fecha_ingreso DESC');
        
                }else{
            $this->db->select('ex.*, ce.*, ig.*');
            $this->db->from('expediente_nino ex');
            $this->db->join('centro_asistencia as ce','ce.id_centro = ex.id_centro');
            $this->db->join('ingreso_nino as ig','ig.id_ingreso = ex.id_ingreso');
            $this->db->where('ex.estatus_val_ped', '0');
            $this->db->order_by('fecha_ingreso DESC');
          
        
            $this->db->like('nombre_centro',$bus);
            $this->db->or_like('nombres_nino',$bus);
            $this->db->or_like('apellido_pnino',$bus);
            $this->db->or_like('apellido_mnino',$bus);
            $this->db->or_like('fecha_nnino',$bus);
            $this->db->or_like('fecha_ingreso',$bus);
            $this->db->or_like('genero_nino',$bus);
            $this->db->or_like('motivos_ingreso',$bus);
            $this->db->or_like('no_carpeta',$bus);
            $this->db->or_like('no_expediente',$bus);
            $this->db->group_by('ex.id_expediente');
            }
               $query=$this->db->get();
               return $query->result();
         }

         function devuelve_expedientes_con_valoracion_pedagogica($bus,$id_expediente){
            $data  = $this->datos_sesion();
            if (empty($bus)) {
            $this->db->select('ex.*, ce.*, ig.*');
            $this->db->from('expediente_nino ex');
            $this->db->join('centro_asistencia as ce','ce.id_centro = ex.id_centro');
            $this->db->join('ingreso_nino as ig','ig.id_ingreso = ex.id_ingreso');
            $this->db->where('ex.estatus_val_ped', '1');
            $this->db->order_by('fecha_ingreso DESC');
        
                }else{
            $this->db->select('ex.*, ce.*, ig.*');
            $this->db->from('expediente_nino ex');
            $this->db->join('centro_asistencia as ce','ce.id_centro = ex.id_centro');
            $this->db->join('ingreso_nino as ig','ig.id_ingreso = ex.id_ingreso');
            $this->db->where('ex.estatus_val_ped', '1');
            $this->db->order_by('fecha_ingreso DESC');
          
        
            $this->db->like('nombre_centro',$bus);
            $this->db->or_like('nombres_nino',$bus);
            $this->db->or_like('apellido_pnino',$bus);
            $this->db->or_like('apellido_mnino',$bus);
            $this->db->or_like('fecha_nnino',$bus);
            $this->db->or_like('fecha_ingreso',$bus);
            $this->db->or_like('genero_nino',$bus);
            $this->db->or_like('motivos_ingreso',$bus);
            $this->db->or_like('no_carpeta',$bus);
            $this->db->or_like('no_expediente',$bus);
            $this->db->group_by('ex.id_expediente');
            }
           $query=$this->db->get();
           return $query->result();
    
        }

         //Actualiza Estatu De Valoracion Nut
        function actualiza_estatus_val_nut($id_exp,$estatus){
        $this->db->where('id_expediente',$id_exp);
        $this->db->update('expediente_nino',$estatus);
        }

         //Edición de Valoración Nutriologica
        function actualiza_valoracion_nutriologa($data,$id_valnutricion){
        $this->db->where('id_valnutricion', $id_valnutricion);
        $this->db->update('valoracion_nutriologica', $data);
        }

        //Actualiza Estatu De Valoracion Pedagogia
        function actualiza_estatus_val_ped($id_exp,$estatus){
        $this->db->where('id_expediente',$id_exp);
        $this->db->update('expediente_nino',$estatus);
        }

        //Edición de Valoración Pedagogica
        function actualiza_valoracion_pedagogica($data,$id_valpedagogica){
        $this->db->where('id_valpedagogica', $id_valpedagogica);
        $this->db->update('valoracion_pedagogica', $data);
        }
        
    
        
        


}//Cierra Clase
