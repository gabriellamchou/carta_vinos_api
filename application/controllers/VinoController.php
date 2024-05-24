<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Restserver\Libraries\REST_Controller;

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class VinoController extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('VinoModel');
    }

    public function vinos_get()
    {

        $lista_vinos = $this->VinoModel->obtener_vinos_list();

        $datos = array(
            'lista_vinos' => $lista_vinos
        );

        $this->set_response($datos, REST_Controller::HTTP_OK);
    }

    public function vino_get()
    {

        $id = $this->uri->segment(2);

        $vino = $this->VinoModel->obtener_vino($id);

        $this->set_response($vino, REST_Controller::HTTP_OK);
    }

    public function storeVino_post()
    {
        $vino = new VinoModel;
        $data = [
            'id' => $this->input->post('id'),
            'nombre' => $this->input->post('nombre'),
            'precio' => $this->input->post('precio'),
            'alergenos' => $this->input->post('alergenos'),
            'graduacion' => $this->input->post('graduacion'),
            'breveDescripcion' => $this->input->post('breveDescripcion'),
            'capacidad' => $this->input->post('capacidad'),
            'stock' => $this->input->post('stock')
        ];
        $result = $vino->insert_vino($data);

        if ($result > 0) {
            $this->response([
                'status' => true,
                'message' => 'Nuevo vino creado'
            ], REST_Controller::HTTP_OK);
        } 
        else {
            $this->response([
                'status' => false,
                'message' => 'Error al crear nuevo vino'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
