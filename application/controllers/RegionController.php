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

        if ($result) {
            $this->response([
                'status' => true,
                'message' => 'Nueva región creada'
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Error al crear nueva región'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function editRegion_put($id)
    {
        $data = [
            'Id' => $this->put('id'),
            'Nombre' => $this->put('nombre'),
            'Pais' => $this->put('pais'),
            'Descripcion' => $this->put('descripcion'),
        ];

        $update_result = $this->RegionModel->update_region($id, $data);

        if ($update_result) {
            $this->response([
                'status' => true,
                'message' => 'Región modificada con éxito'
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Error al modificar región'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function deleteRegion_delete($id)
    {
        $result = $this->RegionModel->delete_region($id);
        if ($result) {
            $this->response([
                'status' => true,
                'message' => 'Región eliminada'
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Error al intentar eliminar región'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
