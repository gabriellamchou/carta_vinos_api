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

}