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

}