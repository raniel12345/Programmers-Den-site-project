<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Faculty_mod extends CI_Model{

		public function select_user($faculty_num_id, $password){

			$data = array(
					'faculty_number_id' => $faculty_num_id,
					'password' => $password
				);
			$this->db->where($data);
			$results = $this->db->get('faculty_accounts');
			return $results->row_array();
		}//
		
		public function select_faculty($faculty_num){
			$this->db->where("flty_number", $faculty_num);
			$this->db->limit(1);
			$results = $this->db->get("faculty");

			return $results->row_array();
		}

		public function insert_new_semester($semester_n_year){

			$data = array(
					"semester_n_year" => $semester_n_year
				);

			$this->db->insert("semesters", $data);

			return TRUE;
		}

		public function select_semester($semester_n_year = FALSE, $semester_id = FALSE){

			// This block of code use for checking if current semester is already on the database
			if($semester_n_year != FALSE){
				$this->db->where("semester_n_year", $semester_n_year);
				$this->db->limit(1);
				$results = $this->db->get('semesters');

				return $results->row_array();
			}
			
			// This block of code use for selecting semester of the group
			if($semester_id != FALSE){
				$this->db->where("id",$semester_id);
				$results = $this->db->get('semesters');
				return $results->row_array();
			}
		}

		public function select_all_semesters(){
			$results = $this->db->get("semesters");
			return $results->result_array();
		}

		public function select_group($group_title = FALSE, $group_id = FALSE){

			if($group_title != FALSE){
				$this->db->select('id');
				$this->db->where("title", $group_title);
				$this->db->limit(1);
				$results = $this->db->get("groups");

				return $results->row_array();
			}
			
			if($group_id != FALSE){
				$this->db->where("id", $group_id);
				$results = $this->db->get("groups");
				return $results->row_array();
			}

		}

		public function select_all_groups_per_sem_n_fac($sem_id,$faculty_id){

			$this->db->where("semester_id",$sem_id);
			$this->db->where("faculty_id",$faculty_id);
			$results = $this->db->get("groups");
			return $results->result_array();

		}

		public function insert_new_group($title, $faculty_id, $sem_id){
			$data = array(
					"title" => $title,
					"faculty_id" => $faculty_id,
					"semester_id" => $sem_id
				);

			$this->db->insert("groups",$data);

			return TRUE;
		}

		public function select_chapter($chap_title = FALSE, $group_id = FALSE, $chap_id = FALSE){

			// get the id of the chapter in this group
			// for checking if chapter title is already exists in one group
			if($chap_title != FALSE && $group_id != FALSE){
				$this->db->select("id");
				$this->db->where("chapter_title", $chap_title);
				$this->db->where("group_id", $group_id);
				$this->db->limit(1);
				$results = $this->db->get("group_chapters");

				return $results->row_array();
			}

			// get chapters data on one group
			if($chap_id != FALSE && $group_id != FALSE){
				$this->db->where("id",$chap_id);
				$this->db->where("group_id", $group_id);
				$this->db->limit(1);
				$results = $this->db->get("group_chapters");

				return $results->row_array();
			}

			// get all chapters in one group
			if($group_id != FALSE && $chap_title === FALSE && $chap_id === FALSE){
				$this->db->where("group_id", $group_id);
				$results = $this->db->get("group_chapters");

				return $results->result_array();
			}

		}

		public function insert_new_chapter_on_this_group($chap_title, $group_id){
			$data = array(
					"chapter_title" =>$chap_title,
					"group_id" => $group_id
				);

			$this->db->insert("group_chapters", $data);

			return TRUE;
		}

	}

?>