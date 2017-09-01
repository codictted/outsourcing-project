<?php

	class Query_model extends CI_Model {


		public function get_client() {

			$this->db->select("client.*, business_nature.name");
			$this->db->from("client");
			$this->db->join("business_nature", "client.business_nature = business_nature.id");
			$this->db->where("client.status !=", 0);
			$query = $this->db->get();
			return $query->result();
		}

		public function get_staff() {
			$this->db->select("staff.*, applicant.*, staff.status as staff_stat, job_position.name as jname");
			$this->db->from("staff");
			$this->db->join("applicant", "staff.applicant_id = applicant.id");	
			$this->db->join("job_position", "applicant.job_id = job_position.id");
			//$this->db->where(['staff.status' => $status, 'job_id' => $job_position]);
			$query = $this->db->get();
			return $query->result();
		}

		public function get_all() {

			$this->db->select("applicant.*, job_position.name as jname");
			$this->db->from("applicant");
			$this->db->join("job_position", "applicant.job_id = job_position.id");
			$query = $this->db->get();
			return $query->result();
		}

		public function get_job_position() {

			$query = $this->db->get("job_position");
			return $query->result();
		}

		public function get_business_nature() {

			$query = $this->db->get("business_nature");
			return $query->result();
		}


		public function getStaffRecords($status, $client, $job_position) {
			$this->db->select("applicant.*, job_position.name as jname");
			$this->db->from("applicant");		
			$this->db->join("job_position", "applicant.job_id = job_position.id");
			$this->db->where(['applicant.status' => $status, 'job_id' => $job_position]);
			$query = $this->db->get();
			return $query->result();
		}

		public function filter_by_client ($filter = null){
			$this->db->select("client.*, business_nature.name");
			$this->db->from("client");
			$this->db->join("business_nature", "client.business_nature = business_nature.id");
			
			
			if ($filter['status'] != null)
			{		
				$this->db->where(['client.status' => $filter['status']]);
				
				if ($filter['business_nature'] != null)
				{
					$this->db->where(['business_nature' => $filter['business_nature']]);	

					if($filter['acc_creation_date_from'] != null || $filter['acc_creation_date_to'] != null)
					{
						$this->db->where('acc_creation_date >=' , $filter['acc_creation_date_from']);
						$this->db->where('acc_creation_date <=' , $filter['acc_creation_date_to']);
					}
					
				}
				else
				{
					
					if($filter['acc_creation_date_from'] != null || $filter['acc_creation_date_to'] != null)
					{
						$this->db->where('acc_creation_date >=' , $filter['acc_creation_date_from']);
						$this->db->where('acc_creation_date <=' , $filter['acc_creation_date_to']);
					}
				}
				

			}
			else 
			{
				if ($filter['business_nature'] != null)
				{
					$this->db->where(['business_nature' => $filter['business_nature']]);	

					if($filter['acc_creation_date_from'] != null || $filter['acc_creation_date_to'] != null)
					{
						$this->db->where('acc_creation_date >=' , $filter['acc_creation_date_from']);
						$this->db->where('acc_creation_date <=' , $filter['acc_creation_date_to']);
					}
					
				}
				else
				{
					
					if($filter['acc_creation_date_from'] != null || $filter['acc_creation_date_to'] != null)
					{
						$this->db->where('acc_creation_date >=' , $filter['acc_creation_date_from']);
						$this->db->where('acc_creation_date <=' , $filter['acc_creation_date_to']);
					}
				}
			}

			$query = $this->db->get();
			return $query->result();
		}
		
		public function filter_by_applicant ($filter = null){
			$this->db->select("applicant.*, job_position.name as jname");
			$this->db->from("applicant");
			$this->db->join("job_position", "applicant.job_id = job_position.id");


			if ($filter['status'] != null)
			{		
				$this->db->where(['applicant.status' => $filter['status']]);

				if ($filter['job_position'] != null)
				{
					$this->db->where(['job_id' => $filter['job_position']]);	

					if($filter['application_date_from'] != null || $filter['application_date_to'] != null)
					{
						$this->db->where('application_date >=' , $filter['application_date_from']);
						$this->db->where('application_date <=' , $filter['application_date_to']);
					}
				}
				else
				{
					if($filter['application_date_from'] != null || $filter['application_date_to'] != null)
					{
						$this->db->where('application_date >=' , $filter['application_date_from']);
						$this->db->where('application_date <=' , $filter['application_date_to']);	
					}
				}

			}
			else 
			{	
				if ($filter['job_position'] != null)
				{
					$this->db->where(['job_id' => $filter['job_position']]);	

					if($filter['application_date_from'] != null || $filter['application_date_to'] != null)
					{
						$this->db->where('application_date >=' , $filter['application_date_from']);
						$this->db->where('application_date <=' , $filter['application_date_to']);	
					}
					
				}
				else
				{
					if($filter['application_date_from'] != null || $filter['application_date_to'] != null)
					{
						$this->db->where('application_date >=' , $filter['application_date_from']);
						$this->db->where('application_date <=' , $filter['application_date_to']);	
					}
				}
			}
        	


		    $query = $this->db->get()->result();


		    return $query;

		}


		public function filter_by_staff ($filter = null){
			$this->db->select("staff.*, applicant.*, client.*, job_position.name as jname");
			$this->db->from("staff");
			$this->db->join("applicant", "staff.applicant_id = applicant.id");	
			$this->db->join("job_position", "applicant.job_id = job_position.id");
			$this->db->join("client", "staff.client_id = client.id");


			if ($filter['status'] != null)
			{		
				$this->db->where(['staff.status' => $filter['status']]);
				if ($filter['client'] != null)
				{	
					$this->db->where(['client_id' => $filter['client']]);
					if ($filter['job_position'] != null)
					{
						$this->db->where(['job_id' => $filter['job_position']]);	

						if($filter['deployment_date_from'] != null || $filter['deployment_date_to'] != null)
						{
							$this->db->where('deployment_date >=' , $filter['deployment_date_from']);
							$this->db->where('deployment_date <=' , $filter['deployment_date_to']);
						}
					}
					else
					{
						if($filter['deployment_date_from'] != null || $filter['deployment_date_to'] != null)
						{
							$this->db->where('deployment_date >=' , $filter['deployment_date_from']);
							$this->db->where('deployment_date <=' , $filter['deployment_date_to']);	
						}
					}
				}
				else
				{
					
					if ($filter['job_position'] != null)
					{
						$this->db->where(['job_id' => $filter['job_position']]);	

						if($filter['deployment_date_from'] != null || $filter['deployment_date_to'] != null)
						{
							$this->db->where('deployment_date >=' , $filter['deployment_date_from']);
							$this->db->where('deployment_date <=' , $filter['deployment_date_to']);
						}
					}
					else
					{
						if($filter['deployment_date_from'] != null || $filter['deployment_date_to'] != null)
						{
							$this->db->where('deployment_date >=' , $filter['deployment_date_from']);
							$this->db->where('deployment_date <=' , $filter['deployment_date_to']);	
						}
					}

				}

			}
			else 
			{	
				if ($filter['client'] != null)
				{	
					$this->db->where(['client_id' => $filter['client']]);
					if ($filter['job_position'] != null)
					{
						$this->db->where(['job_id' => $filter['job_position']]);	

						if($filter['deployment_date_from'] != null || $filter['deployment_date_to'] != null)
						{
							$this->db->where('deployment_date >=' , $filter['deployment_date_from']);
							$this->db->where('deployment_date <=' , $filter['deployment_date_to']);	
						}
						
					}
					else
					{
						if($filter['deployment_date_from'] != null || $filter['deployment_date_to'] != null)
						{
							$this->db->where('deployment_date >=' , $filter['deployment_date_from']);
							$this->db->where('deployment_date <=' , $filter['deployment_date_to']);	
						}
					}
				}
				else
				{
					if ($filter['job_position'] != null)
					{
						$this->db->where(['job_id' => $filter['job_position']]);	

						if($filter['deployment_date_from'] != null || $filter['deployment_date_to'] != null)
						{
							$this->db->where('deployment_date >=' , $filter['deployment_date_from']);
							$this->db->where('deployment_date <=' , $filter['deployment_date_to']);	
						}
						
					}
					else
					{
						if($filter['deployment_date_from'] != null || $filter['deployment_date_to'] != null)
						{
							$this->db->where('deployment_date >=' , $filter['deployment_date_from']);
							$this->db->where('deployment_date <=' , $filter['deployment_date_to']);	
						}
					}
				}
			}
        	


		    $query = $this->db->get()->result();


		    return $query;

		}
		

		// public function get_staff() {

		// 	$query = $this->db->get("staff");
		// 	return $query->result();
		// }
	}
?>