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

    public function obtener_uvas_list() {
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

}