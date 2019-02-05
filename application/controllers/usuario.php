<?php defined('BASEPATH') or exit('No direct script access allowed');

class Usuario extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Usuario_model');
    }
    private function _veri_log()
    {
        if ($this->session->userdata('logged_in')) {
            return true;
        } else {
            return false;
        }
    }

    /*muestrar todos los usuarios*/
    public function index()
    {

        if ($this->_veri_log()) {
            $data = array('titulo' => 'Usuarios');

            $session_data   = $this->session->userdata('logged_in');
            $data['perfil'] = $session_data['perfil'];
            $data['nombre'] = $session_data['nombre'];

            $dat = array('usuario' => $this->usuario_model->get_usuarios());

            $this->load->view('partes/head_view', $data);
            $this->load->view('partes/navbar_view');
            $this->load->view('back/usuarios_view');
            $this->load->view('partes/footer_view');
        } else {
            redirect('login', 'refresh');}
    }

    public function nuevo_usuario()
    {
        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
        $this->form_validation->set_rules('apellido', 'Apellido', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[usuario.email]');
        $this->form_validation->set_rules('telefono', 'Telefono', 'required|numeric');

        $this->form_validation->set_rules('ciudad', 'Ciudad', 'required');
        $this->form_validation->set_rules('pais', 'Pais', 'required');

        $this->form_validation->set_rules('password', 'Password', 'required');

        //Mensaje del form_validation
        $this->form_validation->set_message('required', '<div class="alert alert-danger">El campo %s es obligatorio</div>');

        $pass = $this->input->post('password', true);

        $data = array(
            'nombre'   => $this->input->post('nombre', true),
            'apellido' => $this->input->post('apellido', true),
            'email'    => $this->input->post('email', true),
            'telefono' => $this->input->post('telefono', true),
            'ciudad'   => $this->input->post('ciudad', true),
            'pais'     => $this->input->post('pais', true),
            'password' => base64_encode($pass)
        );

        if ($this->form_validation->run() == false) {

            $data = array('titulo' => 'Error de formulario');

            $this->load->view('partes/head_view', $data);
            $this->load->view('partes/footer_view');

        } else {

            $usuario = $this->Usuario_model->add_user($data);
            redirect('camping');
        }
    }

    public function activos()
    {
        $data = array('titulo' => 'usuarios');
        if ($this->_veri_log()) {
            $session_data  = $this->session->userdata('logged_in');
            $dat['nombre'] = $session_data['nombre'];
            $data          = array(
                'usuario' => $this->Usuario_model->get_usuarios());
            $this->load->view('partes/head_view', $dat);
            $this->load->view('back/usuarios_view', $data);
            $this->load->view('partes/footer_view');
        } else {
            redirect('ingreso', 'refresh');
        }

    }

    /**
     * Llama a la vista inse_usuario_views
     */
    public function form_insert()
    {
        if ($this->_veri_log()) {
            $session_data  = $this->session->userdata('logged_in');
            $dat['nombre'] = $session_data['nombre'];
            $this->load->view('partes/head_view', $dat);
            $this->load->view('back/inse_usuario_views');
            $this->load->view('partes/footer_view');
        } else {redirect('ingreso', 'refresh');}
    }

    /**
     * Función que llama al insertar datos
     * @access  public
     */
    public function insert_usuario()
    {
        //Validación del formulario
        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
        $this->form_validation->set_rules('apellido', 'Apellido', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[usuario.email]');
        $this->form_validation->set_rules('telefono', 'Telefono', 'required|numeric');

        $this->form_validation->set_rules('ciudad', 'Ciudad', 'required');
        $this->form_validation->set_rules('pais', 'Pais', 'required');

        $this->form_validation->set_rules('password', 'Password', 'required');

        //Mensaje del form_validation
        $this->form_validation->set_message('required', '<div class="alert alert-danger">El campo %s es obligatorio</div>');
        $this->form_validation->set_message('is_unique', '<div class="alert alert-danger">Ya existe el usuario</div>');
        $this->form_validation->set_message('numeric', '<div class="alert alert-danger">El campo %s debe contener un valor numérico</div>');

        if ($this->form_validation->run() == false) {
            if ($this->_veri_log()) {
                $session_data  = $this->session->userdata('logged_in');
                $dat['nombre'] = $session_data['nombre'];
                $this->load->view('partes/head_view', $dat);
                $this->load->view('back/inse_usuario_views');
                $this->load->view('partes/footer_view');
            }
        } else {
            $pass = $this->input->post('password', true);

            $data = array(
                'nombre'   => $this->input->post('nombre', true),
                'apellido' => $this->input->post('apellido', true),
                'email'    => $this->input->post('email', true),
                'telefono' => $this->input->post('telefono', true),
                'ciudad'   => $this->input->post('ciudad', true),
                'pais'     => $this->input->post('pais', true),
                'password' => $this->input->post('password', true),
            );

            $usuario = $this->Usuario_model->add_user($data);
            redirect('camping');
        }
    }

    /**
     * Elimina logicamente un usuario.
     */
    public function usuario_remove()
    {
        $id   = $this->uri->segment(2);
        $data = array(
            'disable' => '1',
        );
        $this->Usuario_model->estado_usuario($id, $data);
        redirect('datos', 'refresh');
    }

    /**
     * Usuarios eliminados logicamente
     */
    public function disabled_usuarios()
    {

        if ($this->_veri_log()) {
            $session_data  = $this->session->userdata('logged_in');
            $dat['nombre'] = $session_data['nombre'];

            if (!$this->Usuario_model->not_active_usuarios()) {
                redirect('datos', 'refresh');
            } else {
                $data = array(
                    'usuario' => $this->Usuario_model->not_active_usuarios(),
                );
                $this->load->view('partes/head_view', $dat);
                $this->load->view('back/usuario_d_views', array_merge($data, $dat));
                $this->load->view('partes/footer_view');
            }

        } else {
            redirect('ingreso', 'refresh');
        }
    }

    //Cambia el estado de un usuario, para que pase a estar activo.
    public function active_user()
    {
        $id   = $this->uri->segment(2);
        $data = array(
            'disable' => '0',
        );
        $this->Usuario_model->estado_usuario($id, $data);
        redirect('usuario_disabled', 'refresh');
    }

/**
 * Función edit que obtiene todos los datos del usuario referenciado por un id
 * y lo muestra en la vista back/edit_usuario_views con el parametro $data
 * @access  public
 */
    function edit(){
        $id = $this->uri->segment(2);
        $datos_usuarios = $this->Usuario_model->get_usuario($id);
        if ($datos_usuarios != FALSE) {
            foreach ($datos_usuarios->result() as $row) {
                $nombre   = $row->nombre;
                $apellido = $row->apellido;
                $email    = $row->email;
                $telefono = $row->telefono;
                $ciudad   = $row->ciudad;
                $pais     = $row->pais;
                $password = base64_decode($row->password);
            }
            $data = array('usuario' =>$datos_usuarios,
                'id'=>$id,
                'nombre'            => $nombre,
                'apellido'          => $apellido,
                'email'             => $email,
                'telefono'          => $telefono,
                'ciudad'            => $ciudad,
                'pais'              => $pais,
                'password'          => $password
                );
        } else {
            return FALSE;
        }   
        if($this->_veri_log())
        {
            $session_data = $this->session->userdata('logged_in');
            $dat['nombre'] = $session_data['nombre'];  
            $this->load->view('partes/head_view',$dat);
            $this->load->view('back/edit_usuario_view',$data);
            $this->load->view('partes/footer_view');
        }
    }

    /**
     * Función editar_usuario obtiene los datos de la vista back/edit_usuario_views
     * y ejecuta el metodo para actualizar los datos del usuario, si es correcto la actualización
     * Valido formulario
     * redirige a la ruta mis datos
     * @access  public
     */
    function editar_usuario(){
        //Validación del formulario
        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
        $this->form_validation->set_rules('apellido', 'Apellido', 'required');
        $this->form_validation->set_rules('telefono', 'Telefono', 'required|numeric');
        $this->form_validation->set_rules('ciudad', 'Ciudad', 'required');
        $id = $this->uri->segment(2);
        $current_username=$this->Usuario_model->get_usuario($id);
        foreach ($current_username->result() as $row) {
            if($row->email!=$this->input->post('email',true)){
                $this->form_validation->set_rules('email', 'Email', 'is_unique[usuario.email]');}}
                $this->form_validation->set_rules('password', 'Password', 'required');
                $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        //Mensaje del form_validation
                $this->form_validation->set_message('required','<div class="alert alert-danger">El campo %s es obligatorio</div>');
                $this->form_validation->set_message('is_unique','<div class="alert alert-danger">Ya existe el usuario</div>');
                $this->form_validation->set_message('valid_email','<div class="alert alert-danger">No es un email valido</div>');
                $this->form_validation->set_message('numeric','<div class="alert alert-danger">El campo %s debe contener un valor numérico</div>');         

                $id = $this->uri->segment(2);
                $pass = $this->input->post('password',true);
                $data = array(
                    'id'=>$id,
                    'nombre'=>$this->input->post('nombre',true),
                    'email'=>$this->input->post('email',true),
                    'apellido'=>$this->input->post('apellido',true),
                    'telefono'=>$this->input->post('telefono',true),
                    'ciudad'=>$this->input->post('ciudad',true),
                    'pais'=>$this->input->post('pais',true)
                    );

                if (!$this->form_validation->run())
                {
            //Si hay error en algun campo del formulario la clave permanece legible
                    $data['password'] = $pass;
                    $this->load->view('partes/head_view',$data);
                    $this->load->view('back/edit_usuario_view',$data);
                    $this->load->view('partes/footer_view');
                }else{
            //Si la validación del formulario es correcta la clave la encripta
                    $data['password']= base64_encode($pass);

                    $this->Usuario_model->update_usuario($id, $data);
                    redirect('datos', 'refresh');
                }
            }
}
