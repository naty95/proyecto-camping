<?php
class Panel_Controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Si existe sesión activa muestra la vista del panel general.
     * Si no hay sesión, redirige a la ruta panel
     */
    public function index()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data  = $this->session->userdata('logged_in');
            
            $dat['titulo'] = 'Logueado';
            $data['perfil'] = $session_data['perfil'];
            $data['nombre'] = $session_data['nombre'];

            $this->load->view('partes/head_view',$dat);
            $this->load->view('partes/navbar_view',$data);
            $this->load->view('front/panel_view');
            $this->load->view('partes/footer_view');
        } else {
                redirect('panel', 'refresh');
            //redirect('camping', 'refresh');
        }
    }

    /*
     * Función para cerrar la sesión activa.
     * Muestra la vista de login al cerrar sesión
     */
    public function logout()
    {
        $this->session->unset_userdata('logged_in');
        session_destroy();
        //Pagina que carga despues del logout
        redirect('camping');
    }

}
/* End of file login_controller.php */
/* Location: ./application/controllers/back/login_controller.php */
