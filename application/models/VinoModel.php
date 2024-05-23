<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class VinoModel extends CI_Model
{

    private $db = null;

    function __construct()
    {
        parent::__construct();

        # Cargamos la conexión a la base de datos
        $this->db = $this->load->database('default', true);
    }

    # Ejecuta consultas y devuelte los resultados en un array
    public function ExecuteArrayResults($sql)
    {
        // almacenamos en $query la query a la bd
        $query = $this->db->query($sql);
        // result_array() es un método de CI para devolver el resultado de una query como array. muy similar a result()
        // almacenamos en $rows el resultado de la query
        $rows = $query->result_array();
        // free_result() libera la memoria de los resultados almacenados del gestor de sentencia dado
        $query->free_result();

        return ($rows);
    }

    # Devuelve la lista de todos los vinos
    public function obtener_vinos_list($criterios = null)
    {
        $this->db->select(
            "v.Id, 
            v.Nombre, 
            v.Precio, 
            t.Nombre AS Tipo, 
            r.Nombre AS Region,
            b.Nombre AS Bodega,
            v.Anada,
            v.Alergenos,
            v.Graduacion,
            v.BreveDescripcion,
            v.Capacidad,
            v.Stock"
        );
        $this->db->from("vino AS v");
        $this->db->join("tipo AS t", "v.IdTipoVino = t.Id");
        $this->db->join("region AS r", "v.IdRegion = r.Id");
        $this->db->join("bodega AS b", "v.IdBodega = b.Id");

        if(!empty($criterios["vinoId"])) {
            $this->db->where("v.Id", $criterios["vinoId"]);
        }

        $query = $this->db->get();

        $rows = $query->result_array();

        return ($rows);
    }

    # Devuelve vino por id
    public function obtener_vino($id)
    {
        $this->db->select(
            "v.Id, 
            v.Nombre, 
            v.Precio, 
            t.Nombre AS Tipo, 
            r.Nombre AS Region,
            b.Nombre AS Bodega,
            v.Anada,
            v.Alergenos,
            v.Graduacion,
            v.BreveDescripcion,
            v.Capacidad,
            v.Stock"
        );
        $this->db->from("vino AS v");
        $this->db->where("v.Id", $id);
        $this->db->join("tipo AS t", "v.IdTipoVino = t.Id");
        $this->db->join("region AS r", "v.IdRegion = r.Id");
        $this->db->join("bodega AS b", "v.IdBodega = b.Id");

        $query = $this->db->get();

        $rows = $query->result();

        return ($rows);
    }

    public function insert_vino() {

    }

}

?>