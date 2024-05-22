<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Restserver\Libraries\REST_Controller;
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Test extends REST_Controller {
    public function __construct() {
        parent::__construct();
    }

	public function index() {

    }

	public function prueba_get() {
		$output = [];
        // Obtener parametro mediante get
		$clienteId = $this->input->get('clienteId');
		
        $output['data'] = [
            'prueba1' => 'prueba1',
            'prueba2' => 'prueba2',
        ];		
		
		$this->set_response($output, REST_Controller::HTTP_OK);
	}

	public function prueba_post() {
        // Recibo los datos
		$data = json_decode(file_get_contents('php://input'));
		$clienteId = $data->clienteId;
		$this->set_response(['status' => true, 'message' => 'Cliente añadido correctamente'], REST_Controller::HTTP_OK);			
	}    
}

?>
