

<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Consulta_controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Consultas_model');
    }

    //Metodo por defecto, guarda la consulta en la base de datos
    public function index()
    {
        $this->load->model('Consultas_model');
        $data = array(
            'nombre'  => $this->input->post('name', true),
            'email'   => $this->input->post('email', true),
            'mensaje' => $this->input->post('msj', true),
        );
        $datos_consultas = $this->Consultas_model->create_consulta($data);
        redirect('camping', 'refresh');
    }
    //lista todas las consultas registradas en la base de datos
    public function mostrar()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data  = $this->session->userdata('logged_in');
            $dat['nombre'] = $session_data['nombre'];
            if (!$this->Consultas_model->get_consultas()) {
                $this->load->view('partes/back/head_views', $dat);
                $this->load->view('back/error_consulta_views');
                $this->load->view('partes/back/footer_views');
            } else {
                $data = array(
                    'consultas' => $this->Consultas_model->get_consultas(),
                );
                $this->load->view('partes/head_view', $dat);
                $this->load->view('back/consultas_view', array_merge($dat, $data));
                $this->load->view('partes/footer_view');
            }
        } else {
            redirect('ingreso', 'refresh');
        }
    }
    //Carga la vista de contacto y hace visible el mensaje "Su consulta ha sido enviado correctamente."
    public function sended_msj()
    {
        $data = array('titulo' => 'Contacto',
            'inicio'               => '',
            'comer'                => '',
            'contacto'             => 'active',
            'somos'                => '',
            'catalogo'             => '',
            'vision'               => 'visible',
        );
        $this->load->view('partes/head_view', $data);
        $this->load->view('back/contacto');
        $this->load->view('partes/footer_view');
    }
}
