<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Welcome extends CI_Controller
{

    //Creamos el constructor
    public function _construct()
    {
        parent::_construct();
    }
    public function index()
    {

        $data['titulo'] = 'camping';

        $session_data   = $this->session->userdata('logged_in');
        $data['perfil'] = $session_data['perfil'];
        $data['nombre'] = $session_data['nombre'];

        $this->load->view('partes/head_view', $data);
        $this->load->view('partes/navbar_view',$data);
        $this->load->view('front/camping');
        $this->load->view('partes/footer_view');

    }

    public function servicios()
    {

        $data['titulo'] = 'servicios';

        $session_data   = $this->session->userdata('logged_in');
        $data['perfil'] = $session_data['perfil'];
        $data['nombre'] = $session_data['nombre'];

        $this->load->view('partes/head_view',$data);
        $this->load->view('partes/navbar_view',$data);
        $this->load->view('front/servicios');
        $this->load->view('partes/footer_view');
    }

    public function reservas()
    {
        $data['titulo'] = 'reservas';

      
        $session_data   = $this->session->userdata('logged_in');
        $data['perfil'] = $session_data['perfil'];
        $data['nombre'] = $session_data['nombre'];

        $this->load->view('partes/head_view',$data);
        $this->load->view('partes/navbar_view',$data);
        $this->load->view('front/reservas');
        $this->load->view('partes/footer_view');
    }

    public function ubicacion()
    {

        $data['titulo'] = 'ubicacion';

        $session_data   = $this->session->userdata('logged_in');
        $data['perfil'] = $session_data['perfil'];
        $data['nombre'] = $session_data['nombre'];

    
        $this->load->view('partes/head_view',$data);
        $this->load->view('partes/navbar_view',$data);
        $this->load->view('front/ubicacion');
        $this->load->view('partes/footer_view');
    }
    public function registro()
    {

        $data['titulo'] = 'registro';
        
        $session_data   = $this->session->userdata('logged_in');
        $data['perfil'] = $session_data['perfil'];
        $data['nombre'] = $session_data['nombre'];

        $this->load->view('partes/head_view',$data);
        $this->load->view('partes/navbar_view',$data);
        $this->load->view('front/registro');
        $this->load->view('partes/footer_view');
    }
    public function consulta()
    {

        $data['titulo'] = 'consultas';
        
        $session_data   = $this->session->userdata('logged_in');
        $data['perfil'] = $session_data['perfil'];
        $data['nombre'] = $session_data['nombre'];

        $this->load->view('partes/head_view',$data);
        $this->load->view('partes/navbar_view',$data);
        $this->load->view('back/contacto');
        $this->load->view('partes/footer_view');
    }

/*public function panel()
    {
        $data['titulo'] = 'panel';

        $session_data = $this->session->userdata('logged_in');
         $data['perfil'] = $session_data['perfil'];
        $data['nombre'] = $session_data['nombre'];

        $this->load->view('partes/head_view',$data);
        $this->load->view('partes/navbar_view',$data);
        $this->load->view('front/panel');
        $this->load->view('partes/footer_view');
    }*/

    //Este método llama a la página del login
    public function login(){

        $data['titulo']='login';
        
        $session_data = $this->session->userdata('logged_in');
        $data['perfil'] = $session_data['perfil'];
        $data['nombre'] = $session_data['nombre'];

        $this->load->view('partes/head_view',$data);
        $this->load->view('partes/navbar_view',$data);
        $this->load->view('partes/login_view');
        $this->load->view('partes/footer_view');
    }
}
