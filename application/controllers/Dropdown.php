<?php
	class Dropdown extends CI_Controller {


		function __construct() {

			parent::__construct();
			$this->load->model("Dropdown_model");
		}

		public function get_skill_list($id) {

			$data = $this->Dropdown_model->get_skill_list($id);
			return json_encode($data)
		}

		public function get_benefit_list() {

			$data = $this->Dropdown_model->get_benefit();
			return json_encode($data);
		}
	} 
?>