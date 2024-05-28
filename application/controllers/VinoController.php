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
        $this->load->model('ImagenVinoModel');
    }

    public function vinos_get()
    {
        $lista_vinos = $this->VinoModel->obtener_vinos_list();

        $datos = array(
            'lista_vinos' => $lista_vinos
        );

        $this->set_response($datos, REST_Controller::HTTP_OK);
    }

    public function vino_get($id)
    {
        $vino = $this->VinoModel->obtener_vino($id);

        $this->set_response($vino, REST_Controller::HTTP_OK);
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
        $vino_id = $this->VinoModel->insert_vino($data);

        if ($vino_id) {
            $imagenes = $this->input->post('imagenes');

            foreach ($imagenes as $tipo => $url) {
                if (!empty($url)) {
                    $imagen_data = [
                        'IdVino' => $vino_id,
                        'Nombre' => $tipo,
                        'ImagenPath' => $url
                    ];
                    $this->ImagenVinoModel->insert_imagen($imagen_data);
                }
            }
            
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

        $imagenes = [
            'imgAnv' => $this->put('imagenes')['imgAnv'],
            'imgRev' => $this->put('imagenes')['imgRev'],
            'imgDet' => $this->put('imagenes')['imgDet']
        ];

        $update_result = $vino->update_vino($id, $data, $imagenes);

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
        $vino = new VinoModel;
        $result = $vino->delete_vino($id);
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
