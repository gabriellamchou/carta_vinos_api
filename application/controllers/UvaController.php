<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Restserver\Libraries\REST_Controller;

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class UvaController extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('UvaModel');
    }

    public function uvas_get()
    {
        $lista_uvas = $this->UvaModel->obtener_uvas_list();

        $datos = array(
            'lista_uvas' => $lista_uvas
        );

        $this->set_response($datos, REST_Controller::HTTP_OK);
    }

    public function uva_get($id)
    {
        $uva = $this->UvaModel->obtener_uva($id);

        if ($uva) {
            $this->response([
                'status' => true,
                'data' => $uva[0]
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Uva no encontrada'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function storeUva_post() {
        $data = [
            'Id' => $this->input->post('id'),
            'Nombre' => $this->input->post('nombre'),
            'Descripcion' => $this->input->post('descripcion'),
            'Acidez' => $this->input->post('acidez'),
            'Dulzor' => $this->input->post('dulzor'),
            'Cuerpo' => $this->input->post('cuerpo'),
            'Taninos' => $this->input->post('taninos'),
            'Abv' => $this->input->post('abv')
        ];

        $result = $this->UvaModel->insert_uva($data);

        if ($result) {
            $this->response([
                'status' => true,
                'message' => 'Nueva uva creada'
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Error al crear nueva uva'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function editUva_put($id) {
        $data = [
            'Id' => $this->put('id'),
            'Nombre' => $this->put('nombre'),
            'Descripcion' => $this->put('descripcion'),
            'Acidez' => $this->put('acidez'),
            'Dulzor' => $this->put('dulzor'),
            'Cuerpo' => $this->put('cuerpo'),
            'Taninos' => $this->put('taninos'),
            'Abv' => $this->put('abv')
        ];

        $update_result = $this->UvaModel->update_uva($id, $data);

        if ($update_result) {
            $this->response([
                'status' => true,
                'message' => 'Uva modificada con éxito'
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Error al modificar uva'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function deleteUva_delete($id) {
        $result = $this->UvaModel->delete_uva($id);
        if ($result) {
            $this->response([
                'status' => true,
                'message' => 'Uva eliminada'
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Error al intentar eliminar uva'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

}