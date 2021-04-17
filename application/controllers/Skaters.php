<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Skaters extends CI_Controller {
	public function __construct() {
		parent::__construct();
		
		$this->load->model('Skaters_model', 'skaters', TRUE);
	}

	public function index() {
		echo json_encode($this->skaters->getAll());
	}

	public function getById() {
		$id = $this->uri->segment(2);

		$skater = $this->skaters->getById($id);

		if(isset($skater)) {
			http_response_code(200);
			echo json_encode(
				$skater	
			);
		} else {
			http_response_code(404);
			echo json_encode(
				['message' => 'Skater not found']
			);
		}
	}

	public function create() {
		$this->load->library('form_validation');

		$this->form_validation->set_rules('name', 'name', 'required');
		$this->form_validation->set_rules('age', 'age', 'required');
		$this->form_validation->set_rules('base', 'base', 'required');

		if($this->form_validation->run()) {
			$data = $this->input->post();
			
			$this->skaters->insert($data);

			http_response_code(2001);
			echo json_encode($data);
		} else {
			http_response_code(400);
			echo json_encode(
				['message' => validation_errors()]
			);
		}
	}

	public function update() {
		$id = $this->uri->segment(3);
		$data = $this->input->post();

		$skaterUpdated = $this->skaters->update($id, $data);

		if(isset($skaterUpdated)) {
			http_response_code(200);
			echo json_encode(
				$skaterUpdated
			);
		} else {
			http_response_code(404);
			echo json_encode(
				['message' => 'Skater not found']
			);
		}
	}

	public function delete() {
		$id = $this->uri->segment(3);

		$skaterDeleted = $this->skaters->delete($id);

		if(isset($skaterDeleted)) {
			http_response_code(204);
			echo json_encode(
				['message' => 'Skater removed with success']
			);
		} else {
			http_response_code(404);
			echo json_encode(
				['message' => 'Error skater not found']
			);
		}
	}
}
