<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class TipoModel extends CI_Model
{

    private $db = null;

    function __construct()
    {
        parent::__construct();

        # Cargamos la conexión a la base de datos
        $this->db = $this->load->database('default', true);
    }

    public function obtener_tipos_list() 
    {
        $this->db->select(
            "t.Id AS id,
            t.Nombre AS nombre,
            t.Descripcion AS descripcion"
        );

        $this->db->from("tipo AS t");

        $query = $this->db->get();

        $rows = $query->result_array();

        return $rows;
    }

    public function obtener_tipo($id) {
        $this->db->select(
            "t.Id AS id,
            t.Nombre AS nombre,
            t.Descripcion AS descripcion"
        );
        $this->db->from("tipo AS t");
        $this->db->where("t.Id", $id);

        $query = $this->db->get();

        $rows = $query->result_array();

        return $rows;
    }

    public function insert_tipo($data) 
    {
        return $this->db->insert('tipo', $data);
    }

    public function update_tipo($id, $data) 
    {
        $this->db->where('id', $id);
        return $this->db->update('tipo', $data);
    }

    public function delete_tipo($id) 
    {
        $this->db->where('Id', $id);
        return $this->db->delete('tipo');
    }

}