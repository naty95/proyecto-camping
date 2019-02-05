<?php

class Venta_model extends CI_Model
{
    /**
     * Constructor de la clase
     *
     * @access  public
     */
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Retorna todas las ventas registradas
     *
     * @access  public
     * @param   No recibe
     * @return  array
     */
    public function get_ventas()
    {
        $this->db->select('ventas_cabecera.id, ventas_cabecera.fecha, usuario.nombre, usuario.apellido, ventas_cabecera.total_venta');
        $this->db->from('ventas_cabecera');
        $this->db->join('usuario', 'ventas_cabecera.usuario = usuario.id');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return false;
        }
    }
    public function get_compras($id)
    {
        $this->db->select('ventas_cabecera.id, ventas_cabecera.fecha, usuario.nombre, usuario.apellido, ventas_cabecera.total_venta');
        $this->db->from('ventas_cabecera');
        $this->db->join('usuario', 'ventas_cabecera.usuario = usuario.id');
        $this->db->where('ventas_cabecera.usuario', $id);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return false;
        }
    }
    /**
     * Retorna todos los detalles de una venta.
     *
     * @access  public
     * @param   No recibe
     * @return  array
     */
    public function get_detalle()
    {
        $id = $this->uri->segment(2);
        $this->db->select('productos.descripcion, ventas_detalle.cantidad, ventas_detalle.total');
        $this->db->from('ventas_detalle');
        $this->db->join('ventas_cabecera', 'ventas_detalle.ventas_id = ventas_cabecera.id');
        $this->db->join('productos', 'ventas_detalle.producto_id = productos.id');
        $this->db->where('ventas_detalle.ventas_id', $id);
        $query = $this->db->get();
        return $query;
    }
    /**
     * Retorna una sola venta.
     *
     * @access  public
     * @param   No recibe
     * @return  array
     */
    public function get_venta()
    {
        $id = $this->uri->segment(2);
        $this->db->select('ventas_cabecera.id, ventas_cabecera.fecha, usuario.nombre, usuario.apellido, ventas_cabecera.total_venta');
        $this->db->from('ventas_cabecera');
        $this->db->join('usuario', 'ventas_cabecera.usuario = usuario.id');
        $this->db->where('ventas_cabecera.id', $id);
        $query = $this->db->get();
        return $query;
    }
}
