<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ImagenVinoModel extends CI_Model
{
    private $db = null;

    function __construct()
    {
        parent::__construct();

        # Cargamos la conexión a la base de datos
        $this->db = $this->load->database('default', true);
    }

    public function insert_imagen($data)
    {
        $this->db->insert('imagen_vino', $data);
    }
}

?>