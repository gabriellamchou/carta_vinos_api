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

        // Convertir imágenes a data URLs
        foreach ($lista_vinos as &$vino) {
            foreach ($vino['Imagenes'] as $key => $image) {
                if ($image) {
                    $vino['Imagenes'][$key] = 'data:image/jpeg;base64,' . base64_encode($image);
                }
            }
        }

        $datos = array(
            'lista_vinos' => $lista_vinos
        );

        $this->set_response($datos, REST_Controller::HTTP_OK);
    }

    public function vino_get($id)
    {
        $vino = $this->VinoModel->obtener_vino($id);

        if ($vino) {
            // Convertir imágenes a data URLs
            foreach ($vino[0]['Imagenes'] as $key => $image) {
                if ($image) {
                    $vino[0]['Imagenes'][$key] = 'data:image/jpeg;base64,' . base64_encode($image);
                }
            }

            $this->response([
                'status' => true,
                'data' => $vino[0]
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Vino no encontrado'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function storeVino_post()
    {
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

        $imagenes = [];
        if (!empty($_FILES['imagenes'])) {
            foreach ($_FILES['imagenes']['name'] as $key => $name) {
                if ($_FILES['imagenes']['error'][$key] === UPLOAD_ERR_OK) {
                    $tmp_name = $_FILES['imagenes']['tmp_name'][$key];
                    $image_data = file_get_contents($tmp_name);
                    $imagenes[$key] = $image_data;
                }
            }
        }

        $uvas = $this->input->post('uvas');

        $result = $this->VinoModel->insert_vino($data, $imagenes, $uvas);

        if ($result) {
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

    public function editVino_post($id)
    {
        $data = [
            'Id' => $this->post('id'),
            'Nombre' => $this->post('nombre'),
            'Precio' => $this->post('precio'),
            'IdRegion' => $this->post('region'),
            'IdTipoVino' => $this->post('tipo'),
            'IdBodega' => $this->post('bodega'),
            'Anada' => $this->post('anada'),
            'Alergenos' => $this->post('alergenos'),
            'Graduacion' => $this->post('graduacion'),
            'BreveDescripcion' => $this->post('breveDescripcion'),
            'Capacidad' => $this->post('capacidad'),
            'Stock' => $this->post('stock')
        ];

        $imagenes = [];
        if (!empty($_FILES['imagenes'])) {
            foreach ($_FILES['imagenes']['name'] as $key => $name) {
                if ($_FILES['imagenes']['error'][$key] === UPLOAD_ERR_OK) {
                    $tmp_name = $_FILES['imagenes']['tmp_name'][$key];
                    $image_data = file_get_contents($tmp_name);
                    $imagenes[$key] = $image_data;
                }
            }
        }

        $uvas = $this->post('uvas');

        $update_result = $this->VinoModel->update_vino($id, $data, $imagenes, $uvas);

        if ($update_result) {
            $this->response([
                'status' => true,
                'message' => 'Vino modificado con éxito'
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Error al modificar vino'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function deleteVino_delete($id)
    {
        $result = $this->VinoModel->delete_vino($id);
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
