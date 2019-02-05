

<?php class Consultas_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Retorna todas las consultas registradas
     *
     * @access  public
     * @param   No recibe
     * @return  array
     */
    public function get_consultas()
    {
        $query = $this->db->get("consultas");

        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return false;
        }
    }
    /**
     * Crea una consulta en la base de datos con los datos que recibe
     *
     * @access  public
     * @param   Datos de los campos de la consulta
     * @return  array
     */
    public function create_consulta($data)
    {
        $this->db->insert('consultas', $data);
    }
}
