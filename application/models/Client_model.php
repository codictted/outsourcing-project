<?php
	class Client_model extends CI_Model {


		function __construct() {

			parent::__construct();
			$this->load->database();
		}

		public function add_client($data) {

			$this->db->insert("client", $data);
		}

		public function get_client_list() {

			$this->db->select("client.*, business_nature.name");
			$this->db->from("client");
			$this->db->join("business_nature", "client.business_nature = business_nature.id");
			$this->db->where("client.status !=", 0);
			$this->db->order_by("acc_creation_date", "DESC");
			$query = $this->db->get();
			return $query->result();
		}

		public function get_details($id){

			$this->db->select("client.*, business_nature.name as bn");
			$this->db->from("client");
			$this->db->join("business_nature", "client.business_nature = business_nature.id");
			$this->db->where("client.id", $id);
			$query = $this->db->get();
			return $query->row();
		}

		public function update_client($id, $data) {

			$this->db->where("id", $id);
			$this->db->update("client", $data);
			return $this->db->affected_rows();
		}

		public function check_client($user, $pass) {

			$this->db->from("client");
			$this->db->where("acc_username", $user);
			$this->db->where("acc_password", $pass);
			$this->db->where("acc_status", 0);
			$query = $this->db->get();

			if($query->num_rows() > 0)
				return $query->row();
			else
				return FALSE;

		}

		public function add_order($data) {

			$this->db->insert("job_order", $data);
			$this->db->select_max("order_id");
			$this->db->from("job_order");
			$query = $this->db->get();
			return $query->result();
		}

		public function insert_jo_skill($data) {

			$this->db->insert("job_order_skill", $data);
		}

		public function insert_jo_benefit($data) {

			$this->db->insert("job_order_benefit", $data);
		}

		public function insert_jo_requirement($data) {

			$this->db->insert("job_order_req", $data);
		}

		public function get_client_order($id) {

			$this->db->select("job_order.*, job_position.name as jname");
			$this->db->from("job_order");
			$this->db->join("job_position", "job_order.job_id = job_position.id");
			$this->db->where("client_id", $id);
			$this->db->order_by("job_order.order_date", "DESC");
			$query = $this->db->get();	
			return $query->result();
		}

		public function get_joborder_details($id) {

			$this->db->select("job_order.*, job_position.name as jname, education.education as educ_name, course.name as course_name, client.comp_name as comp, client.full_name as full");
			$this->db->from("job_order");
			$this->db->join("job_position", "job_order.job_id = job_position.id", "left");
			$this->db->join("education", "job_order.education = education.id", "left");
			$this->db->join("course", "job_order.course = course.id", "left");
			$this->db->join("client", "job_order.client_id = client.id", "left");
			$this->db->where("order_id", $id);
			$query = $this->db->get();
			return $query->row();
		}

		public function get_job_order_skills($id) {

			$this->db->select("job_order_skill.*, skill.name as sk");
			$this->db->from("job_order_skill");
			$this->db->join("skill", "job_order_skill.skill = skill.id");
			$this->db->where("job_order_skill.job_order_id", $id);
			$query = $this->db->get();
			return $query->result();
		}

		public function get_job_order_benefits($id) {

			$this->db->select("job_order_benefit.*, benefits.name as ben");
			$this->db->from("job_order_benefit");
			$this->db->join("benefits", "job_order_benefit.benefit = benefits.id");
			$this->db->where("job_order_benefit.job_order_id", $id);
			$query = $this->db->get();
			return $query->result();
		}

		public function get_job_order_req($id) {

			$this->db->select("job_order_req.*, requirement.requirement as req");
			$this->db->from("job_order_req");
			$this->db->join("requirement", "job_order_req.requirement = requirement.id");
			$this->db->where("job_order_req.job_order_id", $id);
			$query = $this->db->get();
			return $query->result();
		}

		public function get_job_order_sched($id) {

			$this->db->from("job_order_sched");
			$this->db->where("job_order_id", $id);
			$query = $this->db->get();
			return $query->result();
		}

		public function get_all_job_orders() {

			$this->db->select("job_order.*, client.comp_name as comp, client.full_name as full,
								business_nature.name as bn, job_position.name as jname");
			$this->db->from("job_order");
			$this->db->join("client", "job_order.client_id = client.id");
			$this->db->join("business_nature", "client.business_nature = business_nature.id");
			$this->db->join("job_position", "job_order.job_id = job_position.id");
			$this->db->where("job_order.status !=", 4);
			$this->db->or_where("job_order.status !=", 5);
			$this->db->order_by("job_order.order_date", "DESC");
			$query = $this->db->get();
			return $query->result();
		}

		public function post_job_ad($data) {

			$this->db->insert("job_order_post", $data);
		}
	}
?>