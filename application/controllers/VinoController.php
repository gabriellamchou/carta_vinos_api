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
            'Id' => $this->input->post('id'),
            'Nombre' => $this->input->post('nombre'),
            'Precio' => $this->input->post('precio'),
            'IdRegion' => $this->input->post('region'),
            'IdTipoVino' => $this->input->post('tipo'),
            'IdBodega' => $this->input->post('bodega'),
            'Anada' => $this->input->post('anada'),
            'Alergenos' => $this->input->post('alergenos'),
            'Graduacion' => $this->input->post('graduacion'),
            'BreveDescripcion' => $this->input->post('breveDescripcion'),
            'Capacidad' => $this->input->post('capacidad'),
            'Stock' => $this->input->post('stock')
        ];
        $result = $vino->insert_vino($data);

        if ($result > 0) {
            $this->response([
                'status' => true,
                'message' => 'Nuevo vino creado'
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Error al crear nuevo vino'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function editVino_put($id)
    {
        $vino = new VinoModel;
        $data = [
            'Id' => $this->put('id'),
            'Nombre' => $this->put('nombre'),
            'Precio' => $this->put('precio'),
            'IdRegion' => $this->put('region'),
            'IdTipoVino' => $this->put('tipo'),
            'IdBodega' => $this->put('bodega'),
            'Anada' => $this->put('anada'),
            'Alergenos' => $this->put('alergenos'),
            'Graduacion' => $this->put('graduacion'),
            'BreveDescripcion' => $this->put('breveDescripcion'),
            'Capacidad' => $this->put('capacidad'),
            'Stock' => $this->put('stock')
        ];
        $update_result = $vino->update_vino($id, $data);

        if ($update_result > 0) {
            $this->response([
                'status' => true,
                'message' => 'Vino modificado'
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Error al modificar vino'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function regiones_get()
    {
        $lista_regiones = $this->VinoModel->obtener_regiones_list();

        $datos = array(
            'lista_regiones' => $lista_regiones
        );

        $this->set_response($datos, REST_Controller::HTTP_OK);
    }

    public function deleteVino_delete($id)
    {
        $vino = new VinoModel;
        $result = $vino->delete_Vino($id);
        if ($result) {
            $this->response([
                'status' => true,
                'message' => 'Vino eliminado'
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Error al intentar eliminar el vino'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
