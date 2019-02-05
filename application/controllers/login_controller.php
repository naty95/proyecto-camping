<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login_controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
    }

    public function index()
    {

        //Reglas de validación
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('password', 'Contraseña', 'trim|required|callback__valid_login');

        //Mensajes en caso de error
        $this->form_validation->set_message('required', 'el campo %s es requerido');
        $this->form_validation->set_message('_valid_login', 'El usuario o contraseña son incorrectos');
        $this->form_validation->set_message('is_unique', 'El campo %s ya existe');

        //Forma en que muestra los mensajes de error
        $this->form_validation->set_error_delimiters('<ul><li>', '</li></ul>');

        if ($this->form_validation->run() == false) {
            //En caso de que falle la validacion vuelve a cargar la pagina de Login
            $data = array('titulo' => 'Error de datos');

            $this->load->view('partes/head_view', $data);
            $this->load->view('partes/navbar_view');
            $this->load->view('partes/login_view');
            $this->load->view('partes/footer_view');
        } else {

            //Pagina que carga despues de loguearse
            //redirect(current_url()); ---> Vuelve a la pagina que estaba antes de loguearse
            redirect('camping');
        }
    }

    public function _valid_login($password)
    {
        //Se validaron los campos exitosamente. Se valida con la base de datos
        $email = $this->input->post('email');

        //Consulta a la base
        $result = $this->login_model->validacion_usuario($email, $password);

        if ($result) {
            //Si el resultado es correcto lo asigna a la variable session
            $sess_array = array();

            foreach ($result as $row) {
                $sess_array = array('id' => $row->id,
                    'nombre'                 => $row->nombre,
                    'apellido'               => $row->apellido,
                    'email'                  => $row->email,
                    'telefono'               => $row->telefono,
                    'ciudad'                 => $row->ciudad,
                    'pais'                   => $row->pais,
                    'perfil'                 => $row->perfil,
                    'password'               => $row->password);
                $this->session->set_userdata('logged_in', $sess_array);
            }
            return true;
        } else //Sino devuelve que los datos no coinciden
        {
            $this->form_validation->set_message('check_database', '<div class="alert alert-danger">Usuario o Contraseña invalido</div>');
            return false;
        }
    }

}
