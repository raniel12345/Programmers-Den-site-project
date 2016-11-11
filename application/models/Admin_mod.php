<?php
		
	class Admin_mod extends CI_Model{

		#
		# Carousel Functoins
		#
		
		/*
		*	Function for check if user is exists in database 
		*	Who is using this function: admin.php - is_user_exist()
		*/
		public function select_user($username, $password){

			$data = array(
					'username' => $username,
					'password' => $password
				);
			$this->db->where($data);
			$results = $this->db->get('admin');
			return $results->row_array();
		}//

		/*
		*	Function for inserting new carousel
		*	Who is using this function: admin.php - add_new_carousel_info()
		*/
		public function insert_carousel_info($title, $description, $img_name){
			$data = array(
				'title' => $title,
				'description' => $description,
				'img_name' => $img_name,
				'is_activated' => 'TRUE'
			);
			$this->db->insert('carousel', $data);
		}//


		/*
		*	Function for uploading files(images)
		*	Who is using this function: 
		*	admin.php - (upload_carousel_img,upload_event_img, upload_article_img);
		*/
		public function upload_this_file($config, $input_file_name){

			$this->upload->initialize($config);

			if( ! $this->upload->do_upload($input_file_name)){
				$results['is_upload_is_success'] = False;
				$results['error'] = $this->upload->display_errors();

				return $results;
			}else{
				$results['is_upload_is_success'] = True;
				$results['upload_data'] = $this->upload->data();
				
				return $results;
			}
		}//

		/*
		*	Function for selecting all carousel items
		*	Who is using this function: admin.php - get_all_carousel()
		*/
		public function select_all_carousel(){
			$results = $this->db->get('carousel');
			return $results->result_array();
		}//

		/*
		*	Function for activating carousel item
		*	Who is using this function: admin.php - activate_this_carousel_item()
		*/
		public function activate_carousel($id){
			$data = array(
					'is_activated' => 'TRUE'
			);
			$this->db->where('id',$id);
			$this->db->update('carousel',$data);
		}//

		/*
		*	Function for deactivating carousel item
		*	Who is using this function: admin.php - deactivate_this_carousel_item()
		*/
		public function deactivate_carousel($id){
			$data = array(
					'is_activated' => 'FALSE'
			);
			$this->db->where('id',$id);
			$this->db->update('carousel',$data);
		}//


/**/

		/*
		*	Function for Deleting carousel item
		*	Who is using this function: admin.php - delete_this_carousel_item()
		*/
		public function delete_carousel($id){
			$this->db->where('id',$id);
			$this->db->delete('carousel');
		}//

		/*
		*	Function for Updating carousel item
		*	Who is using this function: admin.php - update_this_carousel()
		*/
		public function update_carousel($id, $title, $description){
			$data = array(
					'title' => $title,
					'description' => $description
			);
			$this->db->where('id',$id);
			$this->db->update('carousel',$data);
		}//


		#
		# Events Functoins
		#

		/*
		*	Function for Inserting New event item
		*	Who is using this function: admin.php - add_new_event()
		*/
		public function insert_event_info($title, $description, $img_name){
			$data = array(
				'title' => $title,
				'description' => $description,
				'img_name' => $img_name,
				'is_activated' => 'TRUE' // Default value
			);

			$this->db->insert('events', $data);
		}//

		/*
		*	Function for selecting all event item
		*	Who is using this function: admin.php - get_all_event()
		*/
		public function select_all_event(){

			$results = $this->db->get('events');

			return $results->result_array();
			
		}//

		/*
		*	Function for selecting one event item
		*	Who is using this function: admin.php - get_this_event()
		*/
		public function select_this_event($id){

			$this->db->where('id',$id);
			$results = $this->db->get('events');

			return $results->row_array();
		}//

		/*
		*	Function for Deleting one event item
		*	Who is using this function: admin.php - delete_this_event_item()
		*/
		public function delete_event($id){
			$this->db->where('id',$id);
			$this->db->delete('events');
		}


		#
		# Articles Functoins
		#

		/*
		*	Function for inserting new category item
		*	Who is using this function: admin.php - add_new_category()
		*/
		public function insert_new_category($new_category){
			$data = array(
				'category' => $new_category
			);
			$this->db->insert('article_category', $data);
		}//


		/*
		*	Function for selecting all categories
		*	Who is using this function: admin.php - get_all_categories()
		*/
		public function select_all_categories(){
			
			$results = $this->db->get('article_category');

			return $results->result_array();
		}//

		/*
		*	Function for deleting one category
		*	Who is using this function: admin.php - delete_this_category_item()
		*/
		public function delete_category($id){

			$this->db->query("SET foreign_key_checks = 0;");
			$delete_res = $this->db->delete('article_category', array('id' => $id));
			$this->db->query("SET foreign_key_checks = 1;");

			if($delete_res){
				return TRUE;
			}
		}//

		/*
		*	Function for updating one category
		*	Who is using this function: admin.php - edit_category()
		*/
		public function update_category($id, $category){
			$data = array(
					'category' => $category
			);

			$this->db->where('id',$id);
			$this->db->update('article_category',$data);
		}//

		/*
		*	Function for deleting one subcategory
		*	Who is using this function: admin.php - delete_this_category_item()
		*/
		public function delete_subcategory($id){

			$this->db->query("SET foreign_key_checks = 0;");
			$delete_res = $this->db->delete('article_sub_category', array('id' => $id));
			$this->db->query("SET foreign_key_checks = 1;");

			if($delete_res){
				return TRUE;
			}
		}//

		/*
		*	Function for updating one subcategory
		*	Who is using this function: admin.php - edit_subcategory()
		*/
		public function update_subcategory($id, $subcategory){
			$data = array(
					'subcategory' => $subcategory
			);

			$this->db->where('id',$id);
			$this->db->update('article_sub_category',$data);
		}//


		/*
		*	Function for inserting new subcategory item
		*	Who is using this function: admin.php - add_new_subcategory()
		*/
		public function insert_new_subcategory($new_subcategory, $category_id){ // Insert New Subcategories
			$data = array(
					'subcategory' => $new_subcategory,
					'category_id' => $category_id
				);
			$this->db->insert('article_sub_category', $data);
		}//


		/*
		*	Function for selecting all subcategetories
		*	Who is using this function: admin.php - (get_all_subcategories_for_table, get_all_subcategories)
		*/
		public function select_all_subcategories($category_id = FALSE){ // All Subcategories
			
			if($category_id === FALSE){
				$results = $this->db->get('article_sub_category');

				return $results->result_array();
			}else{
				$this->db->where('category_id',$category_id);
				$results = $this->db->get('article_sub_category');

				return $results->result_array();
			}
		}//


		#
		#	Article Functions
		#

		/*
		*	Function for selecting article category
		*	Who is using this function: admin.php - get_article_category()
		*/
		public function select_article_category($id){
			$this->db->where('id', $id);
			$results = $this->db->get('article_category');

			return $results->row_array();
			
		}//

		/*
		*	Function for selecting article subcategory
		*	Who is using this function: admin.php - get_article_subcategory()
		*/
		public function select_article_subcategory($id){
			$this->db->where('id', $id);
			$results = $this->db->get('article_sub_category');

			return $results->row_array();
		}//

		/*
		*	Function for inserting new article
		*	Who is using this function: admin.php - add_new_article()
		*/
		public function insert_new_article($slug, $title, $cat_id, $content, $img_name, $admin_id){

			$data = array(
				'slug' => $slug,
				'title' => $title,
				'content' => $content,
				'image_name' => $img_name,
				'sub_category_id' => $cat_id,
				'admin_id' => $admin_id,
				'is_activated' => "TRUE",
			);
			$this->db->insert('articles', $data);
		}//

		/*
		*	Function for select all articles
		*	Who is using this function: admin.php - get_all_articles()
		*/
		public function select_all_articles(){ // Select All Articles
			$results = $this->db->get('articles');

			return $results->result_array();
		}//


		/*
		*	Function for activating one article
		*	Who is using this function: admin.php - activate_this_article()
		*/
		public function activate_article($id){
			$data = array(
					'is_activated' => 'TRUE'
			);
			$this->db->where('id',$id);
			$this->db->update('articles',$data);
		}//

		/*
		*	Function for deactivating one article
		*	Who is using this function: admin.php - deactivate_this_article()
		*/
		public function deactivate_article($id){
			$data = array(
					'is_activated' => 'FALSE'
			);
			$this->db->where('id',$id);
			$this->db->update('articles',$data);
		}//

		/*
		*	Function for deleting one article
		*	Who is using this function: admin.php - delete_this_article_item()
		*/
		public function delete_article($id){
			$this->db->where('id',$id);
			$this->db->delete('articles');
		}//

		/*
		*	Function for selecting article author
		*	Who is using this function: admin.php - get_article_author()
		*/
		public function select_article_author($author_id){
			$this->db->where('id', $author_id);
			$results = $this->db->get('admin');

			return $results->row_array();
		}//

		/*
		*	Function for inserting new about us content
		*	Who is using this function: admin.php - insert_new_about_us()
		*/
		public function insert_new_about_us($content,$admin_id){
			$data = array(
				'content' => $content,
				'admin_id' => $admin_id,
				'is_activated' => "TRUE"
			);
			$this->db->insert('about_us', $data);
		}

		/*
		*	Function for selecting all about us content
		*	Who is using this function: admin.php - get_all_about_us_content()
		*/
		public function select_all_about_us_content(){
			$results = $this->db->get('about_us');

			return $results->result_array();
		}

		/*
		*	Function for selecting current activated about us item
		*	Who is using this function: admin.php - get_current_about_us_item()
		*/
		public function select_current_activated_about_us(){

			$this->db->where("is_activated", "TRUE");	
			$results = $this->db->get('about_us');

			return $results->row_array();
		}

		/*
		*	Function for deactivating one about us item
		*	Who is using this function: admin.php - (insert_new_about_us(), )
		*/
		public function deactivate_about_us($id){
			$data = array(
					'is_activated' => 'FALSE'
			);
			$this->db->where('id',$id);
			$this->db->update('about_us',$data);
		}//

		/*
		*	Function for activating one about us item
		*	Who is using this function: admin.php - (insert_new_about_us(), )
		*/
		public function activate_about_us($id){
			$data = array(
					'is_activated' => 'TRUE'
			);
			$this->db->where('id',$id);
			$this->db->update('about_us',$data);
		}//

		/*
		*	Function for deleting one about us item
		*	Who is using this function: admin.php - delete_about_us_item()
		*/
		public function delete_about_us($id){
			$this->db->where('id',$id);
			$this->db->delete('about_us');
		}//

	}
?>