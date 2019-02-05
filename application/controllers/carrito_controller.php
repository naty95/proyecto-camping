 <?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Carrito_controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('carrito_model');
        $this->load->model('producto_model');
        $this->load->library('cart');
    }

    public function index()
    {
    }
    private function _veri_log()
    {
        if ($this->session->userdata('logged_in')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Muestra todos los productos en tabla
     */
    public function alquiler()
    {
        if ($this->_veri_log()) {

            $session_data   = $this->session->userdata('logged_in');
            $data['perfil'] = $session_data['perfil'];
            $data['nombre'] = $session_data['nombre'];

            $dat = array('productos' => $this->producto_model->get_productos());

            $this->load->view('partes/head_view', $data);
            $this->load->view('partes/navbar_view');

            if ($session_data) {
                $this->load->view('back/carritoparte_view');
            }

            $this->load->view('back/alquilerestodos_view', $dat);
            $this->load->view('partes/footer_view');
        } else {
            redirect('login', 'refresh');}
    }
    //Este método llama a la página Alquiler, con el carrito si está logueado
    /** public function alquiler()
    {
    $dat = array('productos' => $this->producto_model->get_productos());

    $data           = array('titulo' => 'alquiler');
    $session_data   = $this->session->userdata('logged_in');
    $data['perfil'] = $session_data['perfil'];
    $data['nombre'] = $session_data['nombre'];

    $this->load->view('partes/head_view', $data);
    $this->load->view('partes/navbar_view', $data);
    if ($session_data) {
    $this->load->view('back/alquilerestodos_view');
    }
    $this->load->view('partes/footer_view');
    }**/

    //Agrega elemento al carrito
    public function add()
    {
        // Genera array para insertar en el carrito
        $insert_data = array(
            'id'    => $this->input->post('id'),
            'name'  => $this->input->post('descripcion'),
            'price' => $this->input->post('precio_venta'),
            'qty'   => 1,
        );

        // Inserta elemento al carrito
        $this->cart->insert($insert_data);

        // Redirige a la misma página que se encuentra
        redirect('carrito', 'refresh');
    }

    //Elimina elemento del carrito o el carrito entero
    public function remove($rowid)
    {
        //Si $rowid es "all" destruye el carrito
        if ($rowid === "all") {
            $this->cart->destroy();
        } else //Sino destruye sola fila seleccionada
        {
            $data = array(
                'rowid' => $rowid,
                'qty'   => 0,
            );
            // Actualiza los datos
            $this->cart->update($data);
        }

        // Redirige a la misma página que se encuentra
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    //Actualiza el carrito que se muestra
    public function actualiza_carrito()
    {
        // Recibe los datos del carrito, calcula y actualiza
        $cart_info = $_POST['cart'];

        foreach ($cart_info as $id => $cart) {
            $rowid  = $cart['rowid'];
            $price  = $cart['price'];
            $amount = $price * $cart['qty'];
            $qty    = $cart['qty'];

            $data = array(
                'rowid'  => $rowid,
                'price'  => $price,
                'amount' => $amount,
                'qty'    => $qty,
            );

            $this->cart->update($data);
        }

        // Redirige a la misma página que se encuentra
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    //Muestra los detalles de la venta y confirma(función guarda_compra())
    public function muestra_compra()
    {
        $session_data     = $this->session->userdata('logged_in');
        $data['perfil']   = $session_data['perfil'];
        $data['nombre']   = $session_data['nombre'];
        $data['apellido'] = $session_data['apellido'];
        $data['email']    = $session_data['email'];

        $this->load->view('partes/head_view', $data);
        $this->load->view('partes/navbar_view', $data);
        $this->load->view('back/compra_view', $data);
        $this->load->view('partes/footer_view');
    }

    //Guarda los datos de la venta en la base de datos
    public function guarda_compra()
    {
        $session_data = $this->session->userdata('logged_in');
        $data['id']   = $session_data['id'];

        $total = $this->input->post('total_venta');

        $venta = array(
            'fecha'       => $this->input->post('name'),
            'usuario'     => $data['id'],
            'total_venta' => $total,
        );
        $venta_id = $this->carrito_model->insert_venta($venta);

        if ($cart = $this->cart->contents()) {
            foreach ($cart as $item) {
                $venta_detalle = array(
                    'ventas_id'   => $venta_id,
                    'producto_id' => $item['id'],
                    'cantidad'    => $item['qty'],
                    'precio'      => $item['price'],
                    'total'       => $item['subtotal'],
                );

                $cust_id = $this->carrito_model->insert_venta_detalle($venta_detalle);

            }
        }

        $data['perfil'] = $session_data['perfil'];
        $data['nombre'] = $session_data['nombre'];

        if (!$this->carrito_model->comprueba_fecha($venta['fecha'], $venta_detalle['producto_id'])) {
            $this->load->view('partes/head_view', $data);
            $this->load->view('partes/navbar_view', $data);
            $this->load->view('back/recibo_view');
            $this->load->view('partes/footer_view');
        } else {

            $this->load->view('partes/head_view', $data);
            $this->load->view('partes/navbar_view', $data);
            $this->load->view('back/compralista_view');
            $this->load->view('partes/footer_view');

            $final = $this->cart->destroy();}

    }

    public function recibo()
    {
        $this->load->view('partes/head_view');
        $this->load->view('partes/navbar_view');
        $this->load->view('back/recibo');
        $this->load->view('partes/footer_view');
    }

}
