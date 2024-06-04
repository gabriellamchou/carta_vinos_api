<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Restserver\Libraries\REST_Controller;

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class BodegaController extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('BodegaModel');
    }

    public function bodegas_get()
    {
        $lista_bodegas = $this->BodegaModel->obtener_bodegas_list();

        $datos = array(
            'lista_bodegas' => $lista_bodegas
        );

        $this->set_response($datos, REST_Controller::HTTP_OK);
    }

    public function bodega_get($id) {
        $bodega = $this->BodegaModel->obtener_bodega($id);

        if ($bodega) {
            $this->response([
                'status' => true,
                'data' => $bodega[0]
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Bodega no encontrada'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function storeBodega_post()
    {
        $data = [
            'Id' => $this->input->post('id'),
            'Nombre' => $this->input->post('nombre'),
            'Descripcion' => $this->input->post('descripcion'),
        ];

        $result = $this->BodegaModel->insert_bodega($data);

        if ($result) {
            $this->response([
                'status' => true,
                'message' => 'Nueva bodega creada'
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Error al crear nueva bodega'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function editBodega_put($id)
    {
        $data = [
            'Id' => $this->put('id'),
            'Nombre' => $this->put('nombre'),
            'Descripcion' => $this->put('descripcion'),
        ];

        $update_result = $this->BodegaModel->update_bodega($id, $data);

        if ($update_result) {
            $this->response([
                'status' => true,
                'message' => 'Bodega modificada con éxito'
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Error al modificar bodega'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function deleteBodega_delete($id)
    {
        $result = $this->BodegaModel->delete_bodega($id);
        if ($result) {
            $this->response([
                'status' => true,
                'message' => 'Bodega eliminada'
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Error al intentar eliminar bodega'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

}