<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Producto_model extends CI_Model
{

    /**
     * Constructor de la clase
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Retorna todos los productos
     */
    public function get_productos()
    {
        $query = $this->db->get_where('productos', array('eliminado' => 'NO'));

        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return false;
        }
    }

    /**
     * Retorna todos los alquileres
     */
    public function get_alquileres()
    {
        $query = $this->db->get_where('productos', array('eliminado' => 'NO'));

        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return false;
        }
    }

    /**
     * Inserta un producto
     */
    public function add_producto($data)
    {
        $this->db->insert('productos', $data);
    }

    /**
     * Retorna todos los datos de un producto
     */
    public function edit_producto($id)
    {

        $query = $this->db->get_where('productos', array('id' => $id), 1);

        if ($query->num_rows() == 1) {
            return $query;
        } else {
            return false;
        }
    }

    /**
     * Actualiza los datos de un producto
     */
    public function update_producto($id, $data)
    {
        $this->db->where('id', $id);
        $query = $this->db->update('productos', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Eliminación y activación logica de un producto
     */
    public function estado_producto($id, $data)
    {
        $this->db->where('id', $id);
        $query = $this->db->update('productos', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Retorna todos los productos inactivos
     */
    public function not_active_productos()
    {
        $query = $this->db->get_where('productos', array('eliminado' => 'SI'));
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return false;
        }
    }
}
