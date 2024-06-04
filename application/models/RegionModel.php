<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class RegionModel extends CI_Model
{

    private $db = null;

    function __construct()
    {
        parent::__construct();

        # Cargamos la conexión a la base de datos
        $this->db = $this->load->database('default', true);
    }

    public function obtener_regiones_list() 
    {
        $this->db->select(
            "r.Id AS id,
            r.Nombre AS nombre,
            r.Pais AS pais,
            r.Descripcion AS descripcion"
        );

        $this->db->from("region AS r");

        $query = $this->db->get();

        $rows = $query->result_array();

        return $rows;
    }

    public function obtener_region($id) 
    {
        $this->db->select(
            "r.Id AS id,
            r.Nombre AS nombre,
            r.Pais AS pais,
            r.Descripcion AS descripcion"
        );
        $this->db->from("region AS r");
        $this->db->where("r.Id", $id);

        $query = $this->db->get();

        $rows = $query->result_array();

        return $rows;
    }

    public function insert_region($data) 
    {
        return $this->db->insert('region', $data);
    }

    public function update_region($id, $data) 
    {
        $this->db->where('id', $id);
        return $this->db->update('region', $data);
    }

    public function delete_region($id) 
    {
        $this->db->where('Id', $id);
        return $this->db->delete('region');
    }

}