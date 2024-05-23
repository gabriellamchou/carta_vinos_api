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

        // $datos = array(
        //     'lista_vinos' => $vino
        // );

        $this->set_response($vino, REST_Controller::HTTP_OK);
    }

    public function vino_post()
    {
        foreach ($_POST as $key => $value) {
            $datos[$key] = $value;
        }

        $this->set_response($datos, REST_Controller::HTTP_OK);
    }
}
