<?php
	
	class Admin extends CI_Controller{

		public function index(){
			$data['page_title'] = "Admin - Login page";
			$this->load->view('layouts/header',$data);
			$this->load->view('pages/admin/login');
		}//

		private function json_output($array_to_display){
			$this->output->set_content_type('application/json')->set_output(json_encode($array_to_display));
		}

		public function dashboard(){

			$data['page_title'] = "Admin - Dashboard";
			$this->load->view('layouts/header',$data);
			$this->load->view('pages/admin/dashboard');
			$this->load->view('layouts/footer');

		}//

		public function login(){
			$username = trim($this->input->post('username'));
			$password = trim($this->input->post('password'));

			$data = array(
					"username" => json_decode(json_encode($username)),
					"password" => json_decode(json_encode($password))
				);

			$this->form_validation->set_data($data);
			$this->form_validation->set_rules("username", "Username", "trim|required|max_length[255]|min_length[5]");
			$this->form_validation->set_rules("password", "Password", "trim|required|max_length[255]|min_length[5]");

			if($this->form_validation->run() === FALSE){

				$error = array(
					'has_error' => TRUE,
					'error' => validation_errors()
					);

				$this->json_output($error);

				//$this->output->set_content_type('application/json')->set_output(json_encode($error));

			}else{
				$results = $this->is_user_exist($data['username'], $data['password']);
				
				if(sizeof($results) != 0){
						
					$admin_data = array(
							'admin_id' => $results['id'],
							'admin_username' => $results['username'],
							'logged_in' => TRUE
						);

					$this->session->set_userdata($admin_data);
					
					$success = array(
							'logged_in' => TRUE
						);

					$this->json_output($success);
					//$this->output->set_content_type('application/json')->set_output(json_encode($success));
				}else{
					$success = array(
							'logged_in' => FALSE
						);

					$this->json_output($success);
				}
			}
		}//

		public function is_user_exist($username, $password){

			$results = $this->admin_mod->select_user($username, $password);

			return $results;

		}//

		public function logout(){
			session_destroy();
			redirect('admin');
		}//

		private function display_this_array($array){
			echo "<pre>";
			print_r($array);
			echo "</pre>";
		}//

		// Carousel functions
		public function upload_carousel_img(){

			$config['upload_path'] = 'assets/img/upload_imgs/carousel';
			$config['allowed_types'] = 'jpeg|jpg|png';
			$config['max_size'] = 2048;
			$config['max_width'] = 1024;
			$config['max_height'] = 768;
			$config['file_ext_tolower'] = TRUE;
			$config['encrypt_name'] = TRUE;

			$results = $this->admin_mod->upload_this_file($config, 'carousel_upload_img');

			return $results;
		}//
		public function add_new_carousel_info(){

			$this->form_validation->set_rules('carousel_title', 'Carousel Title', 'trim|required|min_length[5]|max_length[50]');
			$this->form_validation->set_rules('carousel_description', 'Carousel Description', 'trim|required|min_length[5]|max_length[100]');

			if( $this->form_validation->run() === FALSE ){

				$error = array(
						'has_error' => TRUE,
						'error' => validation_errors(),
						);
				$this->json_output($error);
				//$this->output->set_content_type('application/json')->set_output(json_encode($error));

			}else{

				$carousel_title = $this->input->post('carousel_title');
				$carousel_description = $this->input->post('carousel_description');

				$results = $this->upload_carousel_img();

				if($results['is_upload_is_success'] === True){

					// File name of the uploaded image
					$img_file_name = $results['upload_data']['file_name'];

					$this->admin_mod->insert_carousel_info($carousel_title, $carousel_description, $img_file_name);

					echo $this->get_all_carousel();
				}else{

					$error = array(
						'has_error' => TRUE,
						'error' => $results['error']
						);

					$this->json_output($error);
					//$this->output->set_content_type('application/json')->set_output(json_encode($error));

				}
			}

		}//

		public function get_all_carousel(){

			$all_carousel = $this->admin_mod->select_all_carousel();

			$this->json_output($all_carousel);
			//$this->output->set_content_type('application/json')->set_output(json_encode($this->admin_mod->select_all_carousel()));
		}//

		// Function for Activating carousel item
		public function activate_this_carousel_item(){

			$carousel_id = $this->get_carousel_id_input();

			$this->admin_mod->activate_carousel($carousel_id);
			echo $this->get_all_carousel();

		}//

		// Function for Deactivating carousel item
		public function deactivate_this_carousel_item(){

			$carousel_id = $this->get_carousel_id_input();

			$this->admin_mod->deactivate_carousel($carousel_id);
			echo $this->get_all_carousel();
		}//

		// Function for Deleting Carousel item
		public function delete_this_carousel_item(){

			$carousel_id = $this->get_carousel_id_input();

			$this->admin_mod->delete_carousel($carousel_id);

			echo $this->get_all_carousel();

		}//

		public function update_this_carousel(){
			
			$carousel_id = trim($this->input->post('id'));
			$carousel_title = trim($this->input->post('title'));
			$carousel_description = trim($this->input->post('description'));

			$data = array(
					"id" => json_decode(json_encode($carousel_id)),
					"title" => json_decode(json_encode($carousel_title)),
					"description" => json_decode(json_encode($carousel_description))
				);

			$this->form_validation->set_data($data);
			$this->form_validation->set_rules("id", "Carousel Id", 'trim|required');
			$this->form_validation->set_rules('title', 'Carousel Title', 'trim|required|min_length[5]|max_length[50]');
			$this->form_validation->set_rules('description', 'Carousel Description', 'trim|required|min_length[5]|max_length[100]');

			if($this->form_validation->run() == FALSE){
				echo json_encode("errors".validation_errors());
			}else{
				$this->admin_mod->update_carousel($data['id'],$data['title'],$data['description']);
				echo $this->get_all_carousel();
			}
		}//

		private function get_carousel_id_input(){

			// We need to encode the input and then decode to get the true value
			$carousel_id = trim($this->input->post('id'));
			$data = array(
	          "carousel_id" => json_decode(json_encode($carousel_id))
	        );

			$this->form_validation->set_data($data);
			$this->form_validation->set_rules('carousel_id', 'Carousel Id', 'trim|required');


			if($this->form_validation->run() == FALSE){
		        echo json_encode("errors".validation_errors());
		    }else{
		    	return $data['carousel_id'];
		        echo $this->get_all_carousel();
		    }

		}//



		/*
		*
		*	Events functions
		*
		*/

		public function upload_event_img(){

			$config['upload_path'] = "assets/img/upload_imgs/event";
			$config['allowed_types'] = "gif|jpg|png|jpeg";
			$config['max_size'] = 2048;
			$config['max_width'] = 1024;
			$config['max_height'] = 768;
			$config['file_ext_tolower'] = TRUE;
			$config['encrypt_name'] = TRUE;

			$results = $this->admin_mod->upload_this_file($config, 'event_img');
			return $results;

		}//

		public function add_new_event(){

			
			// We need to encode the input and then decode to get the true value
			$event_title = trim($this->input->post('title'));
			$event_content = trim($this->input->post('content'));

			$data = array(
	          "title" => json_decode(json_encode($event_title)),
	          "content" => json_decode(json_encode($event_content))
	        );
			
			$this->form_validation->set_data($data);
			$this->form_validation->set_rules('title', 'Event Title', 'trim|required|min_length[5]|max_length[50]');
			$this->form_validation->set_rules('content', 'Content', 'trim|required|min_length[10]'); // make min_length equal to 200

			
			if($this->form_validation->run() == FALSE){


				$error = array(
					'has_error' => TRUE,
					'error' => validation_errors()
					);

				$this->json_output($error);
				//$this->output->set_content_type('application/json')->set_output(json_encode($error));

		    }else{

		    	$results = $this->upload_event_img();
				
				if($results['is_upload_is_success'] === True){

					$img_file_name = $results['upload_data']['file_name'];

		    		$this->admin_mod->insert_event_info($data['title'], $data['content'],$img_file_name);
		    		
		    		echo $this->get_all_event();
		    	}else{
		    		$error = array(
						'has_error' => TRUE,
						'error' => $results['error']
					);
		    		$this->json_output($error);
					//$this->output->set_content_type('application/json')->set_output(json_encode($error));
		    	}
		    }

		}//

		public function get_all_event(){

			$all_event = $this->admin_mod->select_all_event();

			$this->json_output($all_event);
			//$this->output->set_content_type('application/json')->set_output(json_encode($this->admin_mod->select_all_event()));
		}//

		public function get_this_event(){

			$event_id = $this->get_event_id_input();

			$this_event = $this->admin_mod->select_this_event($event_id);

			$this->json_output($this_event);
			//$this->output->set_content_type('application/json')->set_output(json_encode($this->admin_mod->select_this_event($event_id)));

		}//

		public function delete_this_event_item(){
			$event_id = $this->get_event_id_input();

			$this->admin_mod->delete_event($event_id);

			echo $this->get_all_event();
		}//

		private function get_event_id_input(){

			// We need to encode the input and then decode to get the true value
			$event_id = trim($this->input->post('id'));
			$data = array(
	          "event_id" => json_decode(json_encode($event_id))
	        );

			$this->form_validation->set_data($data);
			$this->form_validation->set_rules('event_id', 'Event Id', 'trim|required');


			if($this->form_validation->run() == FALSE){
		        echo json_encode("errors".validation_errors());
		    }else{
		    	return $data['event_id'];
		    }

		}//


		/*
		*
		*	Articles functions
		*
		*/

		public function add_new_category(){

			$new_category = trim($this->input->post('new_category'));
			$data = array(
					"category" => json_decode(json_encode($new_category))
				);

			$this->form_validation->set_data($data);
			$this->form_validation->set_rules("category", "New Category", "trim|min_length[5]|max_length[50]|required");

			if($this->form_validation->run() == FALSE){

				$error = array(
					'has_error' => TRUE,
					'error' => validation_errors()
					);

				$this->json_output($error);
				//$this->output->set_content_type('application/json')->set_output(json_encode($error));
			}else{

				$this->admin_mod->insert_new_category($data['category']);
				$this->get_all_categories(); // display all categories
			}

		}//

		public function delete_this_category_item(){

			$category_id = $this->get_category_id_input();

			$delete_results = $this->admin_mod->delete_category($category_id);

			if($delete_results){
				$this->get_all_categories();
			}
		}//

		public function delete_this_subcategory_item(){
			$sub_cat_id = $this->get_subcategory_id_input();

			$delete_results = $this->admin_mod->delete_subcategory($sub_cat_id);

			if($delete_results){
				$this->get_all_subcategories_for_table();
			}
		}

		public function edit_category(){

			$category_id = trim($this->input->post('cat_id'));
			$category_edit = trim($this->input->post('cat_edit'));

			$data = array(
	          "category_id" => json_decode(json_encode($category_id)),
	          "category_edit" => json_decode(json_encode($category_edit))
	        );

			$this->form_validation->set_data($data);
			$this->form_validation->set_rules('category_id', 'Category Id', 'trim|required');
			$this->form_validation->set_rules('category_edit', 'Category to Edit', 'trim|required|min_length[5]|max_length[255]');

			if($this->form_validation->run() == FALSE){

		        $error = array(
						'has_error' => TRUE,
						'error' => validation_errors()
					);

		        $this->json_output($error);
				//$this->output->set_content_type('application/json')->set_output(json_encode($error));

		    }else{
		    	$this->admin_mod->update_category($data['category_id'], $data['category_edit']);
		    	$this->get_all_categories();
		    }
		}

		public function edit_subcategory(){

			$subcategory_id = trim($this->input->post('subcat_id'));
			$subcategory_edit = trim($this->input->post('subcat_edit'));


			$data = array(
	          "subcategory_id" => json_decode(json_encode($subcategory_id)),
	          "subcategory_edit" => json_decode(json_encode($subcategory_edit))
	        );

			$this->form_validation->set_data($data);
			$this->form_validation->set_rules('subcategory_id', 'Subcategory Id', 'trim|required');
			$this->form_validation->set_rules('subcategory_edit', 'Subcategory to Edit', 'trim|required|min_length[5]|max_length[255]');

			if($this->form_validation->run() == FALSE){

		        $error = array(
						'has_error' => TRUE,
						'error' => validation_errors()
					);

		        $this->json_output($error);
				//$this->output->set_content_type('application/json')->set_output(json_encode($error));

		    }else{
		    	$this->admin_mod->update_subcategory($data['subcategory_id'], $data['subcategory_edit']);
		    	$this->get_all_subcategories_for_table();
		    }
		}

		private function get_category_id_input(){

			$category_id = trim($this->input->post('id'));

			$data = array(
	          "category_id" => json_decode(json_encode($category_id))
	        );

			$this->form_validation->set_data($data);
			$this->form_validation->set_rules('category_id', 'Category Id', 'trim|required');


			if($this->form_validation->run() == FALSE){

		        $error = array(
						'has_error' => TRUE,
						'error' => validation_errors()
					);

		        $this->json_output($error);
				//$this->output->set_content_type('application/json')->set_output(json_encode($error));

		    }else{
		    	return $data['category_id'];
		    }
		}

		private function get_subcategory_id_input(){
			$sub_cat_id = trim($this->input->post('id'));

			$data = array(
	          "subcategory_id" => json_decode(json_encode($sub_cat_id))
	        );

	        $this->form_validation->set_data($data);
			$this->form_validation->set_rules('subcategory_id', 'Subcategory Id', 'trim|required');

			if($this->form_validation->run() == FALSE){

		        $error = array(
						'has_error' => TRUE,
						'error' => validation_errors()
					);

		        $this->json_output($error);
				//$this->output->set_content_type('application/json')->set_output(json_encode($error));

		    }else{
		    	return $data['subcategory_id'];
		    }
		}

		public function get_all_categories(){

			$all_categories = $this->admin_mod->select_all_categories();
			$this->json_output($all_categories);
			//$this->output->set_content_type('application/json')->set_output(json_encode($this->admin_mod->select_all_categories()));
				
		}//

		public function get_all_subcategories_for_table(){
			$all_subcategories = $this->admin_mod->select_all_subcategories();

			$this->json_output($all_subcategories);

			//$this->output->set_content_type('application/json')->set_output(json_encode($this->admin_mod->select_all_subcategories()));
		}

		public function get_all_subcategories(){

			$category_id = trim($this->input->post('category_id'));

			$data = array(
					"category_id" => json_decode(json_encode($category_id))
				);
			$this->form_validation->set_data($data);
			$this->form_validation->set_rules("category_id", "Category Id", "trim|required");

			if($this->form_validation->run() == FALSE){

				$error = array(
						'has_error' => TRUE,
						'error' => validation_errors()
					);

				$this->json_output($error);
				//$this->output->set_content_type('application/json')->set_output(json_encode($error));
			}else{

				$all_subcategories_in_category = $this->admin_mod->select_all_subcategories($data['category_id']);

				$this->json_output($all_subcategories_in_category);

				//$this->output->set_content_type('application/json')->set_output(json_encode($this->admin_mod->select_all_subcategories($data['category_id'])));
			}
				
		}//




		public function add_new_subcategory(){
			$category_id = trim($this->input->post('category_id'));
			$new_subcategory = trim($this->input->post('new_subcategory'));

			$data = array(
					"category_id" => json_decode(json_encode($category_id)),
					"new_subcategory" => json_decode(json_encode($new_subcategory))
				);

			$this->form_validation->set_data($data);
			$this->form_validation->set_rules("category_id", "Category Id", "trim|required");
			$this->form_validation->set_rules("new_subcategory", "New Subcategory", "trim|required|max_length[50]|min_length[5]");

			if($this->form_validation->run() === FALSE){

				$error = array(
						'has_error' => TRUE,
						'error' => validation_errors()
					);

				$this->json_output($error);
				//$this->output->set_content_type('application/json')->set_output(json_encode($error));
			}else{

				$this->admin_mod->insert_new_subcategory($data['new_subcategory'],$data['category_id']);
				$this->get_all_subcategories_for_table();
				//echo "yes";
			}
		}//

		public function upload_article_img(){

			$config['upload_path'] = "assets/img/upload_imgs/article";
			$config['allowed_types'] = "gif|jpg|png|jpeg";
			$config['max_size'] = 2048;
			$config['max_width'] = 1024;
			$config['max_height'] = 768;
			$config['file_ext_tolower'] = TRUE;
			$config['encrypt_name'] = TRUE;

			$results = $this->admin_mod->upload_this_file($config, 'article_img');
			return $results;

		}//

		public function add_new_article(){

			$subcategory_id = trim($this->input->post('subcategory_id'));
			$article_title = trim($this->input->post('title'));
			$article_content = trim($this->input->post('content'));
				

			$data = array(
					'subcategory_id' => json_decode(json_encode($subcategory_id)),
					'title' => json_decode(json_encode($article_title)),
					'content' => json_decode(json_encode($article_content))
				);

			$this->form_validation->set_rules($data);
			$this->form_validation->set_rules("subcategory_id", "Subcategory", "trim|required");
			$this->form_validation->set_rules("title", "Title", "trim|required|min_length[5]|max_length[255]");
			$this->form_validation->set_rules("content", "Content", "trim|required|min_length[5]");
				
			if($this->form_validation->run() === FALSE){

				$error = array(
					'has_error' => TRUE,
					'error' => validation_errors()
				);
				$this->json_output($error);
				//$this->output->set_content_type('application/json')->set_output(json_encode($error));

			}else{
					
				$results = $this->upload_article_img();

				if($results['is_upload_is_success'] === TRUE){

					// File name of the uploaded image
					$img_file_name = $results['upload_data']['file_name'];
					$slug = url_title($data['title'],'underscore', TRUE);
					$admin_id = $this->session->userdata('admin_id');

					$this->admin_mod->insert_new_article($slug, $data['title'], $data['subcategory_id'], $data['content'], $img_file_name, $admin_id);

					$this->get_all_articles();
					//echo "YES";
				}else{
					$error = array(
						'has_error' => TRUE,
						'error' => $results['error']
						);
					$this->json_output($error);
					//$this->output->set_content_type('application/json')->set_output(json_encode($error));
				}
			}
		}// 

		public function get_article_category($id){// Article Category
			$results = $this->admin_mod->select_article_category($id);
			return $results;
		}//
		public function get_article_subcategory($id){ //Article SubCategory
			$results = $this->admin_mod->select_article_subcategory($id);
			return $results;
		}//

		public function get_article_author($id){
			$results = $this->admin_mod->select_article_author($id);
			return $results;
		}

		public function activate_this_article(){
			$article_id = $this->get_article_id_input();
			
			$this->admin_mod->activate_article($article_id);

			$this->get_all_articles();
		}

		public function deactivate_this_article(){
			$article_id = $this->get_article_id_input();

			$this->admin_mod->deactivate_article($article_id);
			
			$this->get_all_articles();
		}

		public function delete_this_article_item(){
			$article_id = $this->get_article_id_input();

			$this->admin_mod->delete_article($article_id);

			$this->get_all_articles();
		}

		private function get_article_id_input(){

			$article_id = trim($this->input->post('id'));

			$data = array(
	          "article_id" => json_decode(json_encode($article_id))
	        );

			$this->form_validation->set_data($data);
			$this->form_validation->set_rules('article_id', 'Article Id', 'trim|required');


			if($this->form_validation->run() == FALSE){

		        $error = array(
						'has_error' => TRUE,
						'error' => validation_errors()
					);
		        $this->json_output($error);
				//$this->output->set_content_type('application/json')->set_output(json_encode($error));

		    }else{
		    	return $data['article_id'];
		    }

		}

		public function get_all_articles(){

			$admin_id_session = $this->session->userdata('admin_id');

			$all_articles = $this->admin_mod->select_all_articles();

			$articles_len = sizeof($all_articles);

			for($i=0; $i < $articles_len; $i++){

				$author_result = $this->get_article_author($all_articles[$i]['admin_id']);

				if($author_result['id'] == $admin_id_session){
					array_push($all_articles[$i], "You");
				}else{
					array_push($all_articles[$i], $author_result['username']);
				}
					
				$sub_cat_result = $this->get_article_subcategory($all_articles[$i]['sub_category_id']);
				array_push($all_articles[$i], $sub_cat_result['subcategory']);

				$cat_result = $this->get_article_category($sub_cat_result['category_id']);
				array_push($all_articles[$i], $cat_result['category']);
			}

			//print_r($this->get_article_subcategory($results[0]['id']));
			//$this->display_this_array($results);

			$this->json_output($all_articles);// All articles

			//$this->output->set_content_type('application/json')->set_output(json_encode($results));
		}//

		public function get_all_about_us_content(){
			$about_us_contents = $this->admin_mod->select_all_about_us_content();

			$this->json_output($about_us_contents);
			//$this->output->set_content_type('application/json')->set_output(json_encode($about_us_contents));
		}

		public function delete_about_us_item(){

			$id = $this->get_about_us_id_input();

			$this->admin_mod->delete_about_us($id);
			$this->get_all_about_us_content();

		}

		public function get_about_us_id_input(){

			$id = trim($this->input->post('about_us_id'));

			$data = array(
					"about_us_id" => json_decode(json_encode($id))
				);

			$this->form_validation->set_data($data);
			$this->form_validation->set_rules("about_us_id", "About us id", "trim|required");

			if($this->form_validation->run() == FALSE){
				$error = array(
							'has_error' => TRUE,
							'error' => validation_errors()
						);
				$this->json_output($error);
				//$this->output->set_content_type('application/json')->set_output(json_encode($error));
			}else{
				return $data['about_us_id'];
			}

		}

		public function get_current_about_us_item(){ // just return the id
			$results = $this->admin_mod->select_current_activated_about_us();

			return $results['id'];
		}

		public function activate_about_us_item(){
			
			// get the id then activate the selected item
			$id = $this->get_about_us_id_input();
			
			// We must first do deactivating current about us item
			$this->deactivate_current_about_us_item();

			$this->admin_mod->activate_about_us($id);

			// display all about us
			$this->get_all_about_us_content();
		}

		public function deactivate_current_about_us_item(){
			$current_about_us_id = $this->get_current_about_us_item();
			$this->admin_mod->deactivate_about_us($current_about_us_id);
		}

		public function insert_new_about_us(){

			$admin_id = $this->session->userdata('admin_id');

			$content = trim($this->input->post('content'));

			$data = array(
		        "content" => json_decode(json_encode($content))
		    );

			$this->form_validation->set_data($data);
			$this->form_validation->set_rules('content', 'About us content', 'trim|required|min_length[5]');


			if($this->form_validation->run() == FALSE){

			    $error = array(
						'has_error' => TRUE,
						'error' => validation_errors()
					);

			    $this->json_output($error);
					//$this->output->set_content_type('application/json')->set_output(json_encode($error));

			}else{
			    	// Before we insert new item we must deactivate the current about us item
			    $this->deactivate_current_about_us_item();

			    $this->admin_mod->insert_new_about_us($data['content'], $admin_id);
			    	//echo "YEYEYESS";
				$this->get_all_about_us_content();
			}
		}
	}

?>