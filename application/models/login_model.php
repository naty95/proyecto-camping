<?php
class Login_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function validacion_usuario($email, $password)
    {
        $query = $this->db->get_where('usuario', array('email'=>$email,'password'=>base64_encode($password)), 1);

       if($query->num_rows() == 1)
        {
            return $query->result();
        }
        else
        {
            return false;
        }
    }

}
