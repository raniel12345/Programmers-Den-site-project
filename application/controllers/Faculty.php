<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Faculty extends CI_Controller{

		public function index(){
			$data['page_title'] = "Faculty login page";
			$this->load->view('layouts/header',$data);
			$this->load->view('pages/faculty/login');
		}

		public function dashboard(){
			$data['page_title'] = "Home";
			$this->load->view('layouts/header',$data);
			$this->load->view("pages/faculty/dashboard");
			$this->load->view('layouts/footer');
		}

		private function json_output($array_to_display){
			$this->output->set_content_type('application/json')->set_output(json_encode($array_to_display));
		}

		public function login(){
			$faculty_num = trim($this->input->post('faculty_num'));
			$password = trim($this->input->post('password'));

			$data = array(
					"faculty_num" => $faculty_num,
					"password" => $password
				);

			$this->form_validation->set_data($data);
			$this->form_validation->set_rules("faculty_num", "Faculty Number", "trim|required|max_length[255]|min_length[5]");
			$this->form_validation->set_rules("password", "Password", "trim|required|max_length[255]|min_length[5]");

			if($this->form_validation->run() === FALSE){

				$error = array(
					'has_error' => TRUE,
					'error' => validation_errors()
					);

				$this->json_output($error);

			}else{
				$faculty_id_results = $this->faculty_mod->select_faculty($data['faculty_num']);

				$results = $this->is_user_exist($faculty_id_results['id'], $data['password']);
				

				if(sizeof($results) != 0){
						
					$admin_data = array(
							'faculty_id' => $results['id'],
							'faculty_num' => $faculty_id_results['flty_number'],
							'faculty_username' => $results['faculty_name'],
							'faculty_logged_in' => TRUE
						);

					$this->session->set_userdata($admin_data);
					
					$success = array(
							'logged_in' => TRUE
						);

					$this->json_output($success);
				
				}else{
					/*$success = array(
							'logged_in' => FALSE
						);

					$this->json_output($success);*/

					echo "Login Failed";
				}
			}
		}


		public function is_user_exist($faculty_num, $password){

			$results = $this->faculty_mod->select_user($faculty_num, $password);
			return $results;

		}//

		public function logout(){
			session_destroy();
			redirect('faculty');
		}//

		public function add_new_semester(){

			$current_semester = get_current_semester();

			// check if this current semester is already exits in database
			// if exists the get the semester id
			// else insert the new semester and then select the id
			if($this->is_semester_exists($current_semester)){
				$results = $this->faculty_mod->select_semester($current_semester);

				return $results['id'];
				//echo $results['id'] ." Already Exists";
			}else{
				if($this->faculty_mod->insert_new_semester($current_semester)){
					$results = $this->faculty_mod->select_semester($current_semester);

					return $results['id'];
					//echo $results['id'] . " New semester";
				}else{
					//echo "Failed to insert new semester";
					return FALSE;
				}
			}
		}

		private function is_semester_exists($semester_n_year){
			$results = $this->faculty_mod->select_semester($semester_n_year);

			if(sizeof($results) > 0){
				return TRUE;
			}else{
				return FALSE;
			}
		}

		public function is_group_exists($group_title){
			$results = $this->faculty_mod->select_group($group_title);

			if(sizeof($results) > 0)
				return TRUE;
			else
				return FALSE;
		}

		public function add_new_group(){
			$group_title = trim($this->input->post('group_title'));
			$faculty_id = trim($this->input->post('faculty_id'));

			$data = array(
					"group_title" => $group_title,
					"faculty_id" => $faculty_id
				);

			$this->form_validation->set_data($data);
			$this->form_validation->set_rules("group_title", "Group Title", "required|min_length[10]|max_length[255]|trim");
			$this->form_validation->set_rules("faculty_id", "Faculty Id", "required|trim");

			if($this->form_validation->run() === FALSE){
				$error = array(
					'has_error' => "TRUE",
					'error' => validation_errors()
					);

				$this->json_output($error);
			}else{

				$current_semester_id = $this->add_new_semester();// get the current semester id
				//echo $this->is_group_exists($data['group_title']);

				if($this->is_group_exists($data['group_title'])){
					
					$error = array(
						'has_error' => "TRUE",
						'error' => "Invalid Group Title, Already Exists! : ". $data['group_title']
						);

					$this->json_output($error);

					//echo "Invalid Group Title, Already Exists! :". $data['group_title'];
					
				}else{
					if($this->faculty_mod->insert_new_group($data['group_title'], $data['faculty_id'], $current_semester_id)){
		
						echo "Successully added the new group : ".$data['group_title'];
					}else{

						echo "Failed to add the new group : ".$data['group_title'];
					}
				}

			}

		}

		public function get_all_semesters(){
			$results = $this->faculty_mod->select_all_semesters();

			$this->json_output($results);
		}

		public function get_semester_of_this_group(){

			$sem_id = trim($this->input->post("sem_id"));

			$data = array(
					"sem_id"=>$sem_id
				);

			$this->form_validation->set_data($data);
			$this->form_validation->set_rules("sem_id", "Semester id", "trim|required");


			if($this->form_validation->run() === FALSE){
				$error = array(
					'has_error' => "TRUE",
					'error' => validation_errors()
					);

				$this->json_output($error);
			}else{
				$results = $this->faculty_mod->select_semester(FALSE,$sem_id);
				echo $results['semester_n_year'];
			}

				
		}

		public function get_all_groups_on_this_sem_n_fac(){

			$sem_id = trim($this->input->post("semester_id"));
			$faculty_id = trim($this->input->post("faculty_id"));

			$data = array(
					"sem_id"=>$sem_id,
					"faculty_id"=>$faculty_id
				);

			$this->form_validation->set_data($data);
			$this->form_validation->set_rules("sem_id", "Semester id", "trim|required");
			$this->form_validation->set_rules("faculty_id", "Faculty id", "trim|required");

			if($this->form_validation->run() === FALSE){
				$error = array(
					'has_error' => "TRUE",
					'error' => validation_errors()
					);

				$this->json_output($error);
			}else{
				$results = $this->faculty_mod->select_all_groups_per_sem_n_fac($data['sem_id'], $data['faculty_id']);

				$this->json_output($results);
			}

				
		}


		// Viewing one group
		public function get_this_group(){
			$group_id = trim($this->input->post("group_id"));

			$data = array(
					"group_id"=>$group_id
				);

			$this->form_validation->set_data($data);
			$this->form_validation->set_rules("group_id", "Group Id", "trim|required");

			if($this->form_validation->run() === FALSE){
				$error = array(
					'has_error' => "TRUE",
					'error' => validation_errors()
					);

				$this->json_output($error);
			}else{
				$results = $this->faculty_mod->select_group(FALSE, $data['group_id']);

				$this->json_output($results);
			}
		}


		public function add_new_chapter_on_this_group(){
			$chap_title = trim($this->input->post('chapter_title'));
			$grp_id = trim($this->input->post('group_id'));

			$data = array(
					"chapter_title"=> $chap_title,
					"group_id"=> $grp_id
				);

			$this->form_validation->set_data($data);
			$this->form_validation->set_rules("chapter_title", "Chapter Title", "trim|required|max_length[255]|min_length[10]");
			$this->form_validation->set_rules("group_id", "Group Id", "trim|required");

			if($this->form_validation->run() === FALSE){
				$error = array(
					'has_error' => "TRUE",
					'error' => validation_errors()
					);

				$this->json_output($error);
			}else{
				$is_chap_exits = $this->is_chapter_title_exists($data['chapter_title'], $data['group_id']);

				if($is_chap_exits){
					echo "The chapter [ ". $data['chapter_title'] . " ] is already exists, Please check all chapters in this group";
				}else{
					$results = $this->faculty_mod->insert_new_chapter_on_this_group($data['chapter_title'], $data['group_id']);
					if($results){
						echo "Successully added the new chapter : ".$chap_title;
					}else{
						echo "Can't add new chapter";
					}
				}
			}	

		}

		private function is_chapter_title_exists($chap_title = FALSE, $group_id = FALSE){

			if($chap_title != FALSE && $group_id != FALSE){
				$results = $this->faculty_mod->select_chapter($chap_title, $group_id , FALSE);

				if(sizeof($results) > 0)
					return TRUE;
				else
					return FALSE;

			}
				
		}

		public function get_all_chapters_on_this_group(){

			$group_id = trim($this->input->post("group_id"));

			$data = array(
					"group_id"=>$group_id
				);

			$this->form_validation->set_data($data);
			$this->form_validation->set_rules("group_id", "Group Id", "trim|required");

			if($this->form_validation->run() === FALSE){
				$error = array(
					'has_error' => "TRUE",
					'error' => validation_errors()
					);

				$this->json_output($error);
			}else{
				$results = $this->faculty_mod->select_chapter(FALSE, $data['group_id'], FALSE);

				$this->json_output($results);
			}

		}

		public function get_this_chapter(){

			$chap_id = trim($this->input->post("chap_id"));
			$group_id = trim($this->input->post("group_id"));

			$data = array(
					"chap_id"=>$chap_id,
					"group_id"=>$group_id
				);

			$this->form_validation->set_data($data);
			$this->form_validation->set_rules("chap_id", "Chapter Id", "trim|required");
			$this->form_validation->set_rules("group_id", "Group Id", "trim|required");

			if($this->form_validation->run() === FALSE){
				$error = array(
					'has_error' => "TRUE",
					'error' => validation_errors()
					);

				$this->json_output($error);
			}else{
				$results = $this->faculty_mod->select_chapter(FALSE, $data['group_id'], $data['chap_id']);

				$this->json_output($results);
			}
		}

	}

?>