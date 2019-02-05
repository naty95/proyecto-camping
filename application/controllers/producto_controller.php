<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Producto_controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('producto_model');
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
    public function index()
    {
        if ($this->_veri_log()) {
            $data = array('titulo' => 'Productos');

            $session_data   = $this->session->userdata('logged_in');
            $data['perfil'] = $session_data['perfil'];
            $data['nombre'] = $session_data['nombre'];

            $dat = array('productos' => $this->producto_model->get_productos());

            $this->load->view('partes/head_view', $data);
            $this->load->view('partes/navbar_view');
            $this->load->view('back/muestraproductos_view', $dat);
            $this->load->view('partes/footer_view');
        } else {
            redirect('login', 'refresh');}
    }

    /**
     * Muestra todos los alquikeres en tabla
     */
    public function muestra_alquileres()
    {
        if ($this->_veri_log()) {
            $data = array('titulo' => 'Alquileres');

            $session_data   = $this->session->userdata('logged_in');
            $data['perfil'] = $session_data['perfil'];
            $data['nombre'] = $session_data['nombre'];

            $dat = array('productos' => $this->producto_model->get_alquileres());

            $this->load->view('partes/head_view', $data);
            $this->load->view('partes/navbar_view', $data);
            $this->load->view('back/muestraalquileres_view', $dat);
            $this->load->view('partes/footer_view');
        } else {
            redirect('login', 'refresh');}
    }

    /**
     * Muestra formulario para agregar producto
     */
    public function form_agrega_producto() //Si se modifica, modificar (agrega_producto) tambien

    {
        if ($this->_veri_log()) {
            $data = array('titulo' => 'Agregar Producto');

            $session_data   = $this->session->userdata('logged_in');
            $data['perfil'] = $session_data['perfil'];
            $data['nombre'] = $session_data['nombre'];

            $this->load->view('partes/head_view', $data);
            $this->load->view('partes/navbar_view');
            $this->load->view('back/agregaproducto_view');
            $this->load->view('partes/footer_view');
        } else {
            redirect('login', 'refresh');}
    }

    /**
     * Verifica datos ingresados en el formulario para agregar producto
     */
    public function agrega_producto()
    {
        //Genero las reglas de validacion
        $this->form_validation->set_rules('descripcion', 'Descripcion', 'required|is_unique[productos.descripcion]');
        $this->form_validation->set_rules('filename', 'Imagen', 'required|callback__image_upload');

        $this->form_validation->set_rules('precio', 'Precio Costo', 'required|numeric');
        $this->form_validation->set_rules('disponibilidad', 'Disponibilidad', 'required|numeric');

        //Mensaje de error si no pasan las reglas
        $this->form_validation->set_message('required',
            '<div class="alert alert-danger">El campo %s es obligatorio</div>');

        $this->form_validation->set_message('is_unique',
            '<div class="alert alert-danger">El campo %s ya existe</div>');

        $this->form_validation->set_message('numeric',
            '<div class="alert alert-danger">El campo %s debe contener un valor numérico</div>');

        if (!$this->form_validation->run()) {
            $data = array('titulo' => 'Error de formulario');

            $session_data   = $this->session->userdata('logged_in');
            $data['perfil'] = $session_data['perfil'];
            $data['nombre'] = $session_data['nombre'];

            $this->load->view('partes/head_view', $data);
            $this->load->view('partes/navbar_view');
            $this->load->view('back/agregaproducto_view');
            $this->load->view('partes/footer_view');
        } else {
            $this->_image_upload();
        }
    }

    /**
     * Obtiene los datos del archivo imagen.
     * Permite archivos gif, jpg, png
     * Verifica si los datos son correcto en conjunto con la imagen y lo inserta en la tabla correspondiente
     * En la tabla guarda la URL de donde se encuentra la imagen.
     */
    public function _image_upload()
    {
        $this->load->library('upload');

        //Comprueba si hay un archivo cargado
        if (!empty($_FILES['filename']['name'])) {
            // Especifica la configuración para el archivo
            $config['upload_path']   = 'assets/img/productos/';
            $config['allowed_types'] = 'gif|jpg|JPEG|png';

            $config['max_size'] = '50000';

            // Inicializa la configuración para el archivo
            $this->upload->initialize($config);

            if ($this->upload->do_upload('filename')) {
                // Mueve archivo a la carpeta indicada en la variable $data
                $data = $this->upload->data();

                // Path donde guarda el archivo..
                $url = "assets/img/productos/" . $_FILES['filename']['name'];

                // Array de datos para insertar en productos
                $data = array(
                    'descripcion' => $this->input->post('descripcion', true),
                    'imagen'      => $url,
                    'precio'      => $this->input->post('precio', true),
                    'eliminado'   => 'NO',
                );

                $productos = $this->producto_model->add_producto($data);

                redirect('productos_todos', 'refresh');

                return true;
            } else {
                //Mensaje de error si no existe imagen correcta
                $imageerrors = '<div class="alert alert-danger">El campo %s es incorrecta, extención incorrecto o excede el tamaño permitido que es de: 2MB </div>'; //$this->upload->display_errors();
                $this->form_validation->set_message('_image_upload', $imageerrors);

                return false;
            }

        } else {
            //redirect('verifico_nuevoproducto');

        }
    }

    /**
     * Muestra para modificar un producto
     */
    public function muestra_modificar()
    {
        $id             = $this->uri->segment(2);
        $datos_producto = $this->producto_model->edit_producto($id);

        if ($datos_producto != false) {
            foreach ($datos_producto->result() as $row) {
                $descripcion = $row->descripcion;
                $imagen      = $row->imagen;
                $precio      = $row->precio;
            }

            $dat = array('producto' => $datos_producto,
                'id'                    => $id,
                'descripcion'           => $descripcion,
                'imagen'                => $imagen,
                'precio'                => $precio,
            );
        } else {
            return false;
        }
        if ($this->_veri_log()) {
            $data           = array('titulo' => 'Modificar Producto');
            $session_data   = $this->session->userdata('logged_in');
            $data['perfil'] = $session_data['perfil'];
            $data['nombre'] = $session_data['nombre'];

            $this->load->view('partes/head_view', $data);
            $this->load->view('partes/navbar_view');
            $this->load->view('back/modificaproducto_view', $dat);
            $this->load->view('partes/footer_view');
        } else {
            redirect('login', 'refresh');}
    }

    /**
     * Verifica datos para modificar un producto
     */
    public function modificar_producto($id)
    {
        //Validación del formulario
        $this->form_validation->set_rules('descripcion', 'Descripcion', 'required');
        $this->form_validation->set_rules('precio', 'Precio', 'required|numeric');

        //Mensaje del form_validation
        $this->form_validation->set_message('required', '<div class="alert alert-danger">El campo %s es obligatorio, al intentar modificar estaba vacio</div>');

        $this->form_validation->set_message('numeric', '<div class="alert alert-danger">El campo %s debe contener un valor numérico, al intentar modificar estaba vacio</div>');

        $id             = $this->uri->segment(2);
        $datos_producto = $this->producto_model->edit_producto($id);

        foreach ($datos_producto->result() as $row) {
            $imagen = $row->imagen;
        }

        $dat = array(
            'id'          => $id,
            'descripcion' => $this->input->post('descripcion', true),
            'imagen'      => $imagen,
            'precio'      => $this->input->post('precio', true),
        );

        if ($this->form_validation->run() == false) {
            $data           = array('titulo' => 'Error de formulario');
            $session_data   = $this->session->userdata('logged_in');
            $data['perfil'] = $session_data['perfil'];
            $data['nombre'] = $session_data['nombre'];

            $this->load->view('partes/head_view', $data);
            $this->load->view('partes/navbar_view');
            $this->load->view('back/modificaproducto_view', $dat);
            $this->load->view('partes/footer_view');
        } else {
            $this->_image_modif();
        }

    }

    /**
     * Obtiene los datos del archivo imagen.
     * Permite archivos gif, jpg, png
     * Verifica si los datos son correcto en conjunto con la imagen y lo inserta en la tabla correspondiente
     * Si el campo imagen se encuentra vacio asume que la imagen no fue moficado.
     * En la tabla guarda la URL de donde se encuentra la imagen.
     */

    public function _image_modif()
    {
        //Cargo la libreria para subir archivos
        $this->load->library('upload');

        // Obtengo el id del libro
        $id = $this->uri->segment(2);

        // Array de datos para obtener datos de libros sin la imagen
        $dat = array(
            'id'          => $id,
            'descripcion' => $this->input->post('descripcion', true),
            'precio'      => $this->input->post('precio', true),
        );

        // Si la iamgen esta vacia se asume que no se modifica
        if (!empty($_FILES['filename']['name'])) {
            // Especifica la configuración para el archivo
            $config['upload_path']   = 'assets/img/productos/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';

            $config['max_size'] = '50000';

            // Inicializa la configuración para el archivo
            $this->upload->initialize($config);

            if ($this->upload->do_upload('filename')) {
                // Mueve archivo a la carpeta indicada en la variable $data
                $data = $this->upload->data();

                // Path donde guarda el archivo..
                $url = "assets/img/productos/" . $_FILES['filename']['name'];

                // Agrego la imagen si se modifico.
                $dat['imagen'] = $url;

                // Actualiza datos del libro
                $this->producto_model->update_producto($id, $dat);
                redirect('productos_todos', 'refresh');
            } else {
                //Mensaje de error si no existe imagen correcta
                $imageerrors = '<div class="alert alert-danger">El campo %s es incorrecta, extención incorrecto o excede el tamaño permitido que es de: 2MB </div>';
                $this->form_validation->set_message('_image_modif', $imageerrors);
                return false;
            }
        } else {
            $this->producto_model->update_producto($id, $dat);
            redirect('productos_todos', 'refresh');
        }
    }

    /**
     * Obtiene los datos del producto a eliminar
     */
    public function eliminar_producto()
    {
        $id   = $this->uri->segment(2);
        $data = array(
            'eliminado' => 'SI',
        );

        $this->producto_model->estado_producto($id, $data);
        redirect('productos_todos', 'refresh');
    }

    /**
     * Obtiene los datos del producto a activar
     */
    public function activar_producto()
    {
        $id   = $this->uri->segment(2);
        $data = array(
            'eliminado' => 'NO',
        );

        $this->producto_model->estado_producto($id, $data);
        redirect('productos_todos', 'refresh');
    }

    /**
     * Productos eliminados logicamente
     */
    public function muestra_eliminados()
    {
        if ($this->_veri_log()) {
            $data           = array('titulo' => 'Productos eliminados');
            $session_data   = $this->session->userdata('logged_in');
            $data['perfil'] = $session_data['perfil'];
            $data['nombre'] = $session_data['nombre'];

            $dat = array(
                'productos' => $this->producto_model->not_active_productos(),
            );

            $this->load->view('partes/head_view', $data);
            $this->load->view('partes/navbar_view');
            $this->load->view('back/muestraeliminados_view', $dat);
            $this->load->view('partes/footer_view');
        } else {
            redirect('login', 'refresh');}
    }

}
/* End of file
 */
