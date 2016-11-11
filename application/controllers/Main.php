<?php 

	class Main extends CI_Controller{

		public function index(){
			$data['page_flag'] = "home";
			$data['page_title'] = "Home - Programmers' Den";
			$data['carousel_item'] = $this->admin_mod->select_all_carousel();
			$this->load->view('layouts/header', $data);
			$this->load->view('pages/main/nav_header');
			$this->load->view('pages/main/body');
			$this->load->view('layouts/footer');
		}//

		private function json_output($array_to_display){
			$this->output->set_content_type('application/json')->set_output(json_encode($array_to_display));
		}//

		public function login_users(){

			$user_id = trim($this->input->post("user_id"));
			$user_password = trim($this->input->post("user_password"));

			$user_data = array(
					'user_id'=> $user_id,
					'user_password' => $user_password
				);

			$this->form_validation->set_data($user_data);
			$this->form_validation->set_rules("user_id", "User Id", "trim|required");
			$this->form_validation->set_rules("user_password", "User Password", "trim|required");

			if($this->form_validation->run() === FALSE){
				$this->json_output(validation_errors());
			}else{
				$results = $this->main_mod->select_user($user_data['user_id'], $user_data['user_password']);

				if(sizeof($results) != 0){
					
					$user_session_data = array(
							'user_id' => $results['id'],
							'username' => $results['username'],
							'logged_in' => TRUE
						);

					$this->session->set_userdata($user_session_data);

					$success = array(
							'logged_in' => TRUE
						);

					// output the $success on json
					$this->json_output($success);

				}else{
					echo "Login Failed";
				}
			}

		}//

		public function get_username_on_this_comment(){

			$id = trim($this->input->post("id"));

			$data = array(
					'id'=>$id
				);

			$this->form_validation->set_data($data);
			$this->form_validation->set_rules("id", "Id", "trim|required");

			if($this->form_validation->run() === FALSE){
				$this->json_output(validation_errors());
			}else{
				$results = $this->main_mod->select_user_on_comment($data['id']);

				echo $results['username'];
			}
		}//

		public function logout(){
			$this->session->sess_destroy();
			redirect('main');
		}//



		public function articles($id = FALSE, $slug = FALSE){

			//$data['is_reading_flag'] = TRUE;

			$data['page_flag'] = "articles"; // use to change the navbar (nav_header.php)
			$data['page_title'] = "Articles - Programmers' Den";

			if($id === FALSE || $slug === FALSE){
				show_404();
			}else{
				
				$_id = trim($this->security->xss_clean($id));
				$_slug = trim($this->security->xss_clean($slug));

				// Getting the content of selected article
				$this_article = $this->main_get_this_article_content($_id, $_slug);
				$data['articles'] = $this_article; // Articles

				// Getting the sub category of selected article
				$sub_category = $this->main_get_article_sub_category($this_article['sub_category_id']);
				$data['sub_category'] = $sub_category;// Sub category

				// Getting the category of selected article
				$category = $this->main_get_article_category($sub_category['category_id']);
				$data['category'] = $category; // Category

				/*
					Getting all articles belongs to selected article subcategory
				*/
				$related_articles = $this->main_get_all_related_articles($this_article['sub_category_id']);


				/*
					if related_articles is less than 8 items
					then we need other articles related on this article
				*/
				if( sizeof($related_articles) < 8){
					
					/*
						We need to get first all subcategory belongs to selected article category
					*/
					$cat_sub_category = $this->main_mod->select_category_sub_categories($category['id']);
					// length of subcategories
					$cat_sub_category_len = sizeof($cat_sub_category);


					for($i=0; $i < $cat_sub_category_len; $i++){

						/*
							we need to ensure that other related article is not already exists on $related_articles array
						*/
						if($cat_sub_category[$i]['id'] != $sub_category['id']){
						
							// Related articles like (same category)
							$other_related_articles = $this->main_get_all_related_articles($cat_sub_category[$i]['id']);

							$other_related_articles_len = sizeof($other_related_articles);

							/*
								Pushing other related category on related_articles array
							*/
							for($j=0; $j<$other_related_articles_len; $j++){
								array_push($related_articles, $other_related_articles[$j]);
							}
						}
						
					}

					/*
						if there is no related article at all
						then we need to select all articles
					*/
					if( sizeof($related_articles) == 1){
						$data['related_articles'] = $this->main_mod->select_all_articles();
					}else{
						$data['related_articles'] = $related_articles;
					}
					
				}else{
					$data['related_articles'] = $related_articles;
				}

				$this->load->view('layouts/header', $data);
				$this->load->view('pages/main/nav_header');
				$this->load->view('pages/main/articles');
				$this->load->view('layouts/footer');
				
			}
			
		}//

		public function main_get_all_events(){

			$limitNum = $this->main_get_event_limit_input();

			$main_all_events = $this->main_mod->main_select_all_event($limitNum);

			$this->json_output($main_all_events);
		}//

		public function main_get_this_event(){

			$event_id = $this->main_get_event_id_input();

			$main_this_event = $this->main_mod->main_select_this_event($event_id);

			$this->json_output($main_this_event);

		}//


		public function main_get_number_of_events(){
			echo $this->main_mod->count_all_events();
		}//

		private function main_get_event_limit_input(){

			$event_limit_num = trim($this->input->post('limit_num'));

			if(empty($event_limit_num)){
				return 4;// Default number of limit of event
			}else{
				$data = array(
		          "limit_num" => json_decode(json_encode($event_limit_num))
		        );

			    $this->form_validation->set_data($data);
				$this->form_validation->set_rules('limit_num', 'Event limit num', 'trim');


				if($this->form_validation->run() == FALSE){
			        echo json_encode("errors".validation_errors());
			    }else{
			    	return $data['limit_num'];
			    }
			}
		}//

		private function main_get_event_id_input(){

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


		public function main_get_all_articles_content(){

			$main_all_articles = $this->main_mod->select_all_articles();

			$this->json_output($main_all_articles);
		}//


		public function main_get_all_related_articles($title){

			$related_articles = $this->main_mod->select_all_related_articles($title);

			return $related_articles;
		}//

		public function main_get_article_sub_category($subcat_id){
			$sub_category = $this->main_mod->select_article_subcategory($subcat_id);

			return $sub_category;
		}//

		public function main_get_article_category($cat_id){
			$category = $this->main_mod->select_article_category($cat_id);

			return $category;
		}//

		public function main_get_this_article_content($id ,$slug){

			if( is_numeric($id) ){

				$id = trim($id);
				$slug = trim($slug,'1234567890');

				if( $this->main_is_article_exists($id, $slug) == 1 ){
					$results = $this->main_mod->select_this_articles($id, $slug);

					return $results;
				}else{
					show_404();
				}

			}else{
				show_404();
			}
		}//

		public function main_is_article_exists($id, $slug){

			$results = $this->main_mod->select_is_article_exists($id, $slug);

			return $results;
		}//

		public function main_get_about_us_content(){
			$results = $this->main_mod->select_about_us_content();

			$this->json_output($results);
		}//

		public function contact_us_send_message(){

			$admin_email = "raniel.garcia2596@gmail.com";
			$config['protocol'] = 'sendmail';
			$config['mailpath'] = '/usr/sbin/sendmail';
			$config['charset'] = 'iso-8859-1';
			$config['wordwrap'] = TRUE;
			$this->email->initialize($config);


			$sender_name = $this->input->post("sender_name");
			$sender_email = $this->input->post("sender_email");
			$sender_phone_no = $this->input->post("sender_phone_no");
			$subject = $this->input->post("subject");
			$message = $this->input->post("message");

			$data = array(
					"sender_name" => $sender_name,
					"sender_email" => $sender_email,
					"sender_phone_no" => $sender_phone_no,
					"subject" => $subject,
					"message" => $message
				);

			$this->form_validation->set_data($data);
			$this->form_validation->set_rules("sender_name", "Your Name", "trim|max_length[30]|min_length[5]|required");
			$this->form_validation->set_rules("sender_email", "Your Email", "trim|valid_email|max_length[40]|min_length[10]|required");
			$this->form_validation->set_rules("sender_phone_no", "Your Phone no.", "trim|numeric|exact_length[11]");
			$this->form_validation->set_rules("subject", "Subject", "trim|max_length[50]|min_length[5]|required");
			$this->form_validation->set_rules("message", "Message", "trim|min_length[30]|required");

			if($this->form_validation->run() == FALSE){
				echo json_output(validation_errors());
			}else{
				$this->email->from($data['sender_email'], $data['sender_name']);
				$this->email->to($admin_email);
				$this->email->subject($data['subject']);
				$this->email->message($data['message']);
				$this->email->send();

				echo "Successful";
			}
		}//

		public function main_search_article(){

			$search_input = trim($this->input->post("search_input"));

		
			$data = array(
					"search_input" => json_decode(json_encode($search_input))
				);

			
			$this->form_validation->set_data($data);
			$this->form_validation->set_rules("search_input", "Search Input", "trim");

			if($this->form_validation->run() === FALSE){
				$this->json_output(validation_errors());
			}else{
				$results = $this->main_mod->select_search_article($data['search_input']);
				$this->json_output($results);
			}
		}//

		public function main_get_all_comment_on_this_article(){

			$article_id_input = trim($this->input->post("article_id"));

			$data = array(
					"article_id" => json_decode(json_encode($article_id_input))
				);

			$this->form_validation->set_data($data);
			$this->form_validation->set_rules("article_id", "Article Id", "trim");

			if($this->form_validation->run() === FALSE){
				$ths->json_output(validation_errors());
			}else{
				$results = $this->main_mod->select_all_article_comments($data['article_id']);

				$this->json_output($results);
			}
		}//

		public function main_insert_article_comment(){

			$comment = trim($this->input->post("comment"));
			$user_id = trim($this->input->post("user_id"));
			$article_id = trim($this->input->post("article_id"));

			$data = array(
					'comment' => $comment,
					'user_id' => $user_id,
					'article_id' => $article_id
				);


			$this->form_validation->set_data($data);
			$this->form_validation->set_rules("comment", "Article Comment", "trim|min_length[10]|required");
			$this->form_validation->set_rules("user_id", "User id", "trim|required");
			$this->form_validation->set_rules("article_id", "Article id", "trim|required");


			if($this->form_validation->run() === FALSE){
				$this->json_output(validation_errors());
			}else{
				$this->main_mod->insert_article_comment($data['comment'], $data['article_id'], $data['user_id']);

				$this->json_output($this->main_mod->select_all_article_comments($data['article_id']));
			}
		}//

	}
?>