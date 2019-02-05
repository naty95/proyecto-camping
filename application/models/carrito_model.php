<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Carrito_model extends CI_Model
{

    /*
     * Constructor de la clase
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function insert_venta($data)
    {
        $this->db->insert('ventas_cabecera', $data);
        $id = $this->db->insert_id();
        return (isset($id)) ? $id : false;
    }

    public function insert_venta_detalle($data)
    {
        $this->db->insert('ventas_detalle', $data);
    }

    public function comprueba_fecha($fecha, $id)
    {
        $this->db->select('ventas_detalle.*');
        $this->db->from('ventas_detalle');
        $this->db->join('productos', 'ventas_detalle.producto_id = productos.id');
        $this->db->join('ventas_cabecera', 'ventas_detalle.ventas_id = ventas_cabecera.id');
        $this->db->where('ventas_detalle.producto_id', $id);
        $this->db->where('ventas_cabecera.fecha', $fecha);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

}
