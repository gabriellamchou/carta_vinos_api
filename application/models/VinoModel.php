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
    // public function obtener_vinos_list()
    // {
    //     $sql = "SELECT 
    //                 v.Id, 
    //                 v.Nombre, 
    //                 v.Precio, 
    //                 t.Nombre AS Tipo , 
    //                 r.Nombre AS Region,
    //                 b.Nombre AS Bodega,
    //                 v.Anada,
    //                 v.Alergenos,
    //                 v.Graduacion,
    //                 v.BreveDescripcion,
    //                 v.Capacidad,
    //                 v.Stock,
    //                 i.ImagenPath AS Imagen
    //             FROM vino AS v
    //             INNER JOIN 
    //             tipo AS t ON v.IdTipoVino = t.Id
    //             INNER JOIN 
    //             region AS r ON v.IdRegion = r.Id
    //             INNER JOIN 
    //             bodega AS b ON v.IdBodega = b.Id
    //             INNER JOIN 
    //             (SELECT 
    //                 imagen_vino AS i 
    //                 FROM imagen_vino
    //                 ORDER BY i.Id
    //                 LIMIT 1)";
    //     $rows = $this->ExecuteArrayResults($sql);
    //     return ($rows);
    // }

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

}

?>