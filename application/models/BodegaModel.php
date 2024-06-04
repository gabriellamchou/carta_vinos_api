<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class BodegaModel extends CI_Model
{

    private $db = null;

    function __construct()
    {
        parent::__construct();

        # Cargamos la conexión a la base de datos
        $this->db = $this->load->database('default', true);
    }

    public function obtener_bodegas_list() 
    {
        $this->db->select(
            "b.Id AS id,
            b.Nombre AS nombre,
            b.Descripcion AS descripcion"
        );

        $this->db->from("bodega AS b");

        $query = $this->db->get();

        $rows = $query->result_array();

        return $rows;
    }

    public function obtener_bodega($id) {
        $this->db->select(
            "b.Id AS id,
            b.Nombre AS nombre,
            b.Descripcion AS descripcion"
        );
        $this->db->from("bodega AS b");
        $this->db->where("b.Id", $id);

        $query = $this->db->get();

        $rows = $query->result_array();

        return $rows;
    }

}