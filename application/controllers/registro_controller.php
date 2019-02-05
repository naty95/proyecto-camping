<?php

class registro_controller extends CI_Controller
{

    function__construct() {
        parent::_construct();
        $this->load_ > model('usuario_model');
    }

    function verificacion()

    $this->form_validation->set_rules('nombre', 'Nombre', 'required');
    $this->form_validation->set_rules('apellido', 'Apellido', 'required');
    $this->form_validation->set_rules('telefono', 'Telefono', 'required|numeric');
    $this->from_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique(usuario.usersname|');

    $this->from_validation->set_rules('cuidad', 'Ciudad', 'required')
    $this->from_validation->set_rules('pais', 'Pais', 'required')
    $this->form_validation->set_rules('password', 'Password', 'required');
//Mensaje del form_validation
    $this->form_validation->set_message('required', '<div class="alert alert-danger">El campo %s es obligatorio</div>');
    $this->form_validation->set_message('is_unique', '<div class="alert alert-danger">Ya existe el usuario</div>');
    $this->form_validation->set_message('numeric', '<div class="alert alert-danger">El campo %s debe contener un valor numérico</div>');

    $data = array(
        'nombre'   => $this->input->post('nombre', true),
        'apellido' => $this->input->post('apellido'true),
        'email'    => $this->input->post('email'true),
        'telefono' => $this->input->post('telefono'true),
        'cuidad'   => $this->input->post('cuidad'true),
        'pais'     => $this->input->post('pais'true),
        'password' => ($password),
        'perfil'   => '2',
    );

    $usuario = $this->usuario_model->add_user($data);
}
