<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Restserver\Libraries\REST_Controller;

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class TipoController extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('TipoModel');
    }

    public function tipos_get()
    {
        $lista_tipos = $this->TipoModel->obtener_tipos_list();

        $datos = array(
            'lista_tipos' => $lista_tipos
        );

        $this->set_response($datos, REST_Controller::HTTP_OK);
    }

    public function tipo_get($id) {
        $tipo = $this->TipoModel->obtener_tipo($id);

        if ($tipo) {
            $this->response([
                'status' => true,
                'data' => $tipo[0]
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Tipo no encontrado'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function storeTipo_post()
    {
        $data = [
            'Id' => $this->input->post('id'),
            'Nombre' => $this->input->post('nombre'),
            'Descripcion' => $this->input->post('descripcion'),
        ];

        $result = $this->TipoModel->insert_tipo($data);

        if ($result) {
            $this->response([
                'status' => true,
                'message' => 'Nuevo tipo creado'
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Error al crear nuevo tipo'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function editTipo_put($id)
    {
        $data = [
            'Id' => $this->put('id'),
            'Nombre' => $this->put('nombre'),
            'Descripcion' => $this->put('descripcion'),
        ];

        $update_result = $this->TipoModel->update_tipo($id, $data);

        if ($update_result) {
            $this->response([
                'status' => true,
                'message' => 'Tipo modificado con éxito'
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Error al modificar tipo'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function deleteTipo_delete($id)
    {
        $result = $this->TipoModel->delete_tipo($id);
        if ($result) {
            $this->response([
                'status' => true,
                'message' => 'Tipo eliminado'
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Error al intentar eliminar tipo'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

}