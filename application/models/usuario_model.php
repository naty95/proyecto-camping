

<?php class Usuario_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();

    }

//Preparo los datos para guardar en la base, en caso de que pase la validacion
    public function add_user($data)
    {
        $this->db->insert('usuario', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    public function get_usuarios()
    {
        $query = $this->db->get_where("usuario", array('disable' => '0'));
        
        if($query->num_rows()>0) {
            return $query;
        } else {
            return FALSE;
        }
    }

    /**
     * Inserta todos los datos de un usuario
     *
     * @access  public
     * @param   array
     * @return  boolean
     */
    public function create_usuario($data)
    {
        $this->db->insert('usuario', $data);
    }

    /**
     * Retorna todos los datos de un usuario
     *
     * @access  public
     * @param   int($id)
     * @return  array
     */
    public function get_usuario($id)
    {

        $query = $this->db->get_where('usuario', array('id' => $id));

        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return false;
        }
    }
    /**
     * Actualiza los datos de un socio
     *
     * @access  public
     * @param   int($id), array($data)
     * @return  boolean
     */
    public function update_usuario($id, $data)
    {
        $this->db->where('id', $id);
        $query = $this->db->update('usuario', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * Actualiza el estado de un usuario.
     *
     * @access  public
     * @param   int($id), array($data)
     * @return  boolean
     */
    public function estado_usuario($id, $data)
    {
        $this->db->where('id', $id);
        $query = $this->db->update('usuario', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * Retorna todos los usuarios eliminados.
     *
     * @access  public
     * @param   No recibe
     * @return  array
     */
    public function not_active_usuarios()
    {
        $query = $this->db->get_where("usuario", array('disable' => '1'));
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return false;
        }
    }
}
