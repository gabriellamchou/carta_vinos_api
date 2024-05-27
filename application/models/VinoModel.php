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
            v.IdTipoVino AS TipoId,
            t.Nombre AS TipoNombre,
            t.Descripcion AS TipoDescripcion,
            v.IdRegion AS RegionId,
            r.Nombre AS RegionNombre,
            r.Pais AS RegionPais,
            r.Descripcion AS RegionDescripcion,
            v.IdBodega AS BodegaId,
            b.Nombre AS BodegaNombre,
            b.Descripcion AS BodegaDescripcion,
            v.Anada,
            v.Alergenos,
            v.Graduacion,
            v.BreveDescripcion,
            v.Capacidad,
            v.Stock"
        );
        $this->db->from("vino AS v");
        $this->db->join("tipo AS t", "v.IdTipoVino = t.Id", "left");
        $this->db->join("region AS r", "v.IdRegion = r.Id", "left");
        $this->db->join("bodega AS b", "v.IdBodega = b.Id", "left");

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
            v.IdTipoVino AS TipoId, 
            t.nombre AS TipoNombre,
            t.descripcion AS TipoDescripcion,
            v.IdRegion AS RegionId,
            r.Nombre AS RegionNombre,
            r.Pais AS RegionPais,
            r.Descripcion AS RegionDescripcion,
            v.IdBodega AS BodegaId,
            b.Nombre AS BodegaNombre,
            b.Descripcion AS BodegaDescripcion,
            v.Anada,
            v.Alergenos,
            v.Graduacion,
            v.BreveDescripcion,
            v.Capacidad,
            v.Stock,
            i.ImagenPath"
        );
        $this->db->from("vino AS v");
        $this->db->where("v.Id", $id);
        $this->db->join("tipo AS t", "v.IdTipoVino = t.Id", "left");
        $this->db->join("region AS r", "v.IdRegion = r.Id", "left");
        $this->db->join("bodega AS b", "v.IdBodega = b.Id", "left");
        $this->db->join("imagen_vino AS i", "i.IdVino = v.Id", "left");

        $query = $this->db->get();

        $rows = $query->result_array();

        foreach ($rows as $row) {
            if (!isset($result[$row['Id']])) {
                $result[$row['Id']] = $row;
                $result[$row['Id']]['Imagenes'] = [];
            }
            if ($row['ImagenPath']) {
                $result[$row['Id']]['Imagenes'][] = $row['ImagenPath'];
            }
        }

        return array_values($result);
    }

    # Inserta un vino
    public function insert_vino($data)
    {
        return $this->db->insert('vino', $data);
    }

    # Edita un vino
    public function update_vino($id, $data) 
    {
        $this->db->where('id', $id);
        return $this->db->update('vino', $data);
    }

    # Devuelve la lista de todas las regiones
    public function obtener_regiones_list()
    {
        $this->db->select(
            "r.Id, 
            r.Nombre, 
            r.Pais,
            r.Descripcion"
        );
        $this->db->from("region AS r");
        // $this->db->join("tipo AS t", "v.IdTipoVino = t.Id");
        // $this->db->join("region AS r", "v.IdRegion = r.Id");
        // $this->db->join("bodega AS b", "v.IdBodega = b.Id");

        $query = $this->db->get();

        $rows = $query->result_array();

        return ($rows);
    }

    public function delete_vino($id) 
    {
        return $this->db->delete('vino', ['id' => $id]);
    }

}

?>