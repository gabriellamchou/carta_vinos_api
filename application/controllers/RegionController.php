<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Restserver\Libraries\REST_Controller;

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class RegionController extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('RegionModel');
    }

    public function regiones_get() 
    {
        $lista_regiones = $this->RegionModel->obtener_regiones_list();

        $datos = array(
            'lista_regiones' => $lista_regiones
        );

        $this->set_response($datos, REST_Controller::HTTP_OK);
    }

    public function region_get($id) 
    {
        $region = $this->RegionModel->obtener_region($id);

        if ($region) {
            $this->response([
                'status' => true,
                'data' => $region[0]
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Región no encontrada'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function storeRegion_post() 
    {
        $data = [
            'Id' => $this->input->post('id'),
            'Nombre' => $this->input->post('nombre'),
            'Pais' => $this->input->post('pais'),
            'Descripcion' => $this->input->post('descripcion'),
        ];

        $result = $this->RegionModel->insert_region($data);
    }

}