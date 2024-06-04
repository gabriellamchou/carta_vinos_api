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

}