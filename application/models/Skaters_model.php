<?php

class Skaters_Model extends CI_Model {
	protected $table = 'tbl_skaters';
	public $fields = ['id', 'name', 'age', 'base'];

	public function getAll() {
		return $this->db
			->get($this->table)
			->result_array();
	}

	public function getById($id) {
		$this->db->where('id', $id);

		return $this->db
			->get($this->table)
			->row();
	}

	public function insert($data) {
		if(count($data) >= 1) {
			$this->db->insert($this->table, $data);

			return true;
		} else {
			return false;
		}
	}

	public function update($id, $data) {
		if(count($data) >= 1) {
			$this->db->where('id', $id);
			$this->db->update(
				$this->table, 
				$data
			);

			return $data;
		} else {
			return false;
		}
	}

	public function delete($id) {
		try {
			$this->db->where('id', $id);
			$this->db->delete($this->table);

			return true;
		} catch(Execption $e) {
			return false;
		}
	}
}
