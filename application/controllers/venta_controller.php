<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Venta_controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('venta_model');
    }
    //Lista todas las cabeceras de ventas en caso de que el usuario este logueado, de lo contrario redirige al login
    public function mostrar()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data  = $this->session->userdata('logged_in');
            $dat['nombre'] = $session_data['nombre'];
            if (!$this->venta_model->get_ventas()) {
                $this->load->view('partes/head_view', $dat);
                $this->load->view('back/error_venta_views');
                $this->load->view('partes/footer_view');
            } else {
                $data = array(
                    'ventas' => $this->venta_model->get_ventas(),
                );
                $this->load->view('partes/head_view', $dat);
                $this->load->view('back/ventas_views', array_merge($dat, $data));
                $this->load->view('partes/footer_view');
            }
        } else {
            redirect('ingreso', 'refresh');
        }
    }
    //Lista el detalle de una venta.
    public function ver_detalle()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data  = $this->session->userdata('logged_in');
            $dat['nombre'] = $session_data['nombre'];
            $data          = array(
                'detalles' => $this->venta_model->get_detalle(),
                'venta'    => $this->venta_model->get_venta(),
            );
            $this->load->view('partes/head_view', $dat);
            $this->load->view('back/detalle_views', array_merge($dat, $data));
            $this->load->view('partes/footer_view');
        } else {
            redirect('ingreso', 'refresh');
        }
    }
    public function muestra_recibo()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data  = $this->session->userdata('logged_in');
            $dat['nombre'] = $session_data['nombre'];
            $data          = array(
                'detalles' => $this->venta_model->get_detalle(),
                'venta'    => $this->venta_model->get_venta(),
            );

            $this->load->view('partes/head_view', $dat);
            $this->load->view('back/detallerecibo_view', array_merge($dat, $data));
            $this->load->view('partes/footer_view');
        } else {
            redirect('ingreso', 'refresh');
        }
    }
    public function recibo()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data  = $this->session->userdata('logged_in');
            $dat['nombre'] = $session_data['nombre'];
            $dat['id']     = $session_data['id'];
            if (!$this->venta_model->get_compras($dat['id'])) {
                $this->load->view('partes/head_view', $dat);
                $this->load->view('back/error_venta_views');
                $this->load->view('partes/footer_view');
            } else {
                $data = array(
                    'ventas' => $this->venta_model->get_compras($dat['id']),
                );
                $this->load->view('partes/head_view', $dat);
                $this->load->view('back/recibo', array_merge($dat, $data));
                $this->load->view('partes/footer_view');
            }
        } else {
            redirect('ingreso', 'refresh');
        }
    }
}
/* End of file venta_controller.php */
/* Location: ./application/controllers/venta_controller.php */
