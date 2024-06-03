<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class UvaModel extends CI_Model
{

    private $db = null;

    function __construct()
    {
        parent::__construct();

        # Cargamos la conexión a la base de datos
        $this->db = $this->load->database('default', true);
    }

    public function obtener_uvas_list() 
    {
        $this->db->select(
            "u.Id AS id,
            u.Nombre AS nombre,
            u.Descripcion AS descripcion"
        );
        
        $this->db->from("uva AS u");

        $query = $this->db->get();

        $rows = $query->result_array();

        return ($rows);
    }

    public function obtener_uva($id) 
    {
        $this->db->select(
            "u.Id AS id,
            u.Nombre AS nombre,
            u.Descripcion AS descripcion,
            u.Acidez AS acidez,
            u.Dulzor AS dulzor,
            u.Cuerpo AS cuerpo,
            u.Taninos AS taninos,
            u.Abv AS abv"
        );
        $this->db->from("uva AS u");
        $this->db->where("u.Id", $id);

        $query = $this->db->get();

        $rows = $query->result_array();

        return $rows;
    }

    public function insert_uva($data) 
    {
        return $this->db->insert('uva', $data);
    }

    public function update_uva($id, $data) 
    {
        $this->db->where('id', $id);
        return $this->db->update('uva', $data);
    }

    public function delete_uva($id) 
    {
        $this->db->trans_start();

        // Eliminamos las relaciones de la uva con uva_vino
        $this->db->where('IdUva', $id);
        $this->db->delete('uva_vino');

        // Eliminamos la uva en sí
        $this->db->where('Id', $id);
        $this->db->delete('uva');

        $this->db->trans_complete();

        return $this->db->trans_status();
    }

}