<?php


	class Main_mod extends CI_Model{

		/*
		*	Function for selecting user for login
		*	Who is using this function: main.php - login_users
		*/
		public function select_user($user_id, $user_password){

			$this->db->where("user_id",$user_id);
			$this->db->where("password", $user_password);
			$this->db->limit(1);
			$resutls = $this->db->get("users");

			return $resutls->row_array();
		}
		/*
		*	Function for selecting user on one comment
		*	Who is using this function: main.php - get_username_on_this_comment
		*/
		public function select_user_on_comment($id){
			$this->db->where("id", $id);
			$this->db->limit(1);
			$results = $this->db->get("users");

			return $results->row_array();
		}

		/*
		*	Function for selecting all event item
		*	Who is using this function: main.php - main_get_all_event()
		*/
		public function main_select_all_event($limit){

			$this->db->limit($limit);
			$results = $this->db->get('events');

			return $results->result_array();
			
		}//

		/*
		*	Function for selecting one event item
		*	Who is using this function: main.php - main_get_this_event()
		*/
		public function main_select_this_event($id){

			$this->db->where('id',$id);
			$results = $this->db->get('events');

			return $results->row_array();
		}//

		/*
		*	Function for counting all events items
		*	Who is using this function: main.php - main_get_number_of_events()
		*/
		public function count_all_events(){
			return $this->db->count_all_results('events');
		}//

		/*
		*	Function for selecting all article item
		*	Who is using this function: main.php - articles() and main_get_all_articles_content()
		*/
		public function select_all_articles(){
			$this->db->limit(13);
			$this->db->order_by('id', 'DESC');
			$results = $this->db->get("articles");

			return $results->result_array();
		}//


		/*
		*	Function for select one article item
		*	Who is using this function: main.php - main_get_this_article_content
		*/
		public function select_this_articles($id, $slug){


			$this->db->where('id = '.$id." and slug = '".$slug."'");
			$results = $this->db->get('articles');

			return $results->row_array();
		}//

		/*
		*	Function for searching articles
		*	Who is using this function: main.php - main_search_article
		*/
		public function select_search_article($title){
			$this->db->like('title', $title);
			$this->db->limit(6);
			$this->db->order_by('id', 'DESC');
			$results = $this->db->get('articles');

			return $results->result_array();
		}//

		/*
		*	Function for checking if article is exists (return 1 if exists else return 0)
		*	Who is using this function: main.php - main_is_article_exists
		*/
		public function select_is_article_exists($id, $slug){

			$this->db->where('id = '.$id." and slug = '".$slug."'");
			return $this->db->count_all_results('articles');
		}//

		/*
		*	Function for selecting related article on searching articles
		*	Who is using this function: main.php - main_get_all_related_articles
		*/
		public function select_all_related_articles($id){
			$this->db->where('sub_category_id',$id);
			$results = $this->db->get('articles');

			return $results->result_array();
		}//

		/*
		*	Function for selecting the article subcategory
		*	Who is using this function: main.php - main_get_article_sub_category
		*/
		public function select_article_subcategory($subcategory_id){
			$this->db->where('id',$subcategory_id);
			$results = $this->db->get('article_sub_category');

			return $results->row_array();
		}//

		/*
		*	Function for selecting the article category
		*	Who is using this function: main.php - main_get_article_category
		*/
		public function select_article_category($category_id){
			$this->db->where('id', $category_id);
			$results = $this->db->get('article_category');

			return $results->row_array();
		}//

		/*
		*	Function for selecting all subcategory of category
		*	Who is using this function: main.php - articles
		*/
		public function select_category_sub_categories($cat_id){
			$this->db->where('category_id', $cat_id);
			$results = $this->db->get('article_sub_category');

			return $results->result_array();
		}//

		/*
		*	Function for selecting the current about us item
		*	Who is using this function: main.php - main_get_about_us_content
		*/
		public function select_about_us_content(){
			$this->db->where('is_activated','TRUE');
			$results = $this->db->get('about_us');

			return $results->row_array();
		}//

		/*
		*	Function for selecting the current about us item
		*	Who is using this function: main.php - main_get_all_comment_on_this_article and main_insert_article_comment
		*/
		public function select_all_article_comments($article_id){
			$this->db->where("article_id",$article_id);
			$results = $this->db->get("article_comments");

			return $results->result_array();
		}//

		/*
		*	Function for inserting comments
		*	Who is using this function: main.php - main_insert_article_comment
		*/
		public function insert_article_comment($article_comment, $article_id, $user_id){
			$data = array(
					"comment" => $article_comment,
					"article_id" => $article_id,
					"user_id" => $user_id
				);

			$this->db->insert("article_comments", $data);
		}//
	}
?>