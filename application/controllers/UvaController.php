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
                'message' => 'Vino no encontrado'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

}