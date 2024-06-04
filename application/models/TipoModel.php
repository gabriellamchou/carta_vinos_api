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

}