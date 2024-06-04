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

}