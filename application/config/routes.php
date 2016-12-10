<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['faculty_login'] = 'faculty/login';
$route['faculty_dashboard'] = 'faculty/dashboard';
$route['add_new_group'] = 'faculty/add_new_group';
$route['get_all_semesters'] = 'faculty/get_all_semesters';
$route['get_all_groups_on_this_sem_n_fac'] = 'faculty/get_all_groups_on_this_sem_n_fac';
$route['get_this_group'] = 'faculty/get_this_group';
$route['get_semester_of_this_group'] = 'faculty/get_semester_of_this_group';
$route['add_new_chapter_on_this_group'] = 'faculty/add_new_chapter_on_this_group';
$route['get_all_chapters_on_this_group'] = 'faculty/get_all_chapters_on_this_group';
$route['get_this_chapter'] = 'faculty/get_this_chapter';

// Main routing
$route['insert_article_comment'] = 'main/main_insert_article_comment';
$route["get_username_on_this_comment"] = "main/get_username_on_this_comment";
$route['user_logout'] = 'main/logout';
$route['user_login'] = 'main/login_users';
$route['get_comment_on_this_article'] = 'main/main_get_all_comment_on_this_article';
$route['search_article'] = 'main/main_search_article';
$route['contact_us_send_message'] = 'main/contact_us_send_message';
$route['get_about_us'] = 'main/main_get_about_us_content';
$route['articles/(:num)/(:any)'] = 'main/articles/$1/$2';
$route['all_articles'] = 'main/main_get_all_articles_content';// Get all articles
//$route['article/(:num)/(:any)'] = 'main/main_get_this_article_content/$1/$2';// Get one article
$route['display_all_events'] = 'main/main_get_all_events';// Get all events
$route['display_this_event'] = 'main/main_get_this_event';// Get one event
$route['get_number_of_events'] = 'main/main_get_number_of_events';// Get how many event

// Admin routing
$route['activate_this_about_us_item'] = 'admin/activate_about_us_item'; // activating about us item
$route['remove_this_about_us_item'] = 'admin/delete_about_us_item'; // Deleting about us item
$route['get_all_about_us_content'] = 'admin/get_all_about_us_content';// Get all about us content
$route['insert_new_about_us_content'] = 'admin/insert_new_about_us'; // Inserting new about us content
$route['delete_this_article_item'] = 'admin/delete_this_article_item'; // Deleting article item
$route['deactivate_this_article_item'] = 'admin/deactivate_this_article'; // Deactivate article item
$route['activate_this_article_item'] = 'admin/activate_this_article'; // activate Article item 
$route['get_all_articles'] = 'admin/get_all_articles'; // get all articles
$route['add_new_article'] = 'admin/add_new_article';// add new article
$route['edit_this_subcategory_item'] = 'admin/edit_subcategory'; // Editing subcategory
$route['delete_this_subcategory_item'] = 'admin/delete_this_subcategory_item'; // Delete Subcategory
$route['get_all_subcategories_for_table'] = 'admin/get_all_subcategories_for_table'; // get subcategories for table
$route['get_all_subcategories'] = 'admin/get_all_subcategories'; // get all subcategories
$route['add_new_subcategory'] = 'admin/add_new_subcategory'; // add new subcategories
$route['edit_this_category_item'] = 'admin/edit_category'; // Edit Category
$route['delete_this_category_item'] = 'admin/delete_this_category_item'; // delete category item
$route['get_all_categories'] = 'admin/get_all_categories'; // get all categories
$route['add_new_category'] = 'admin/add_new_category'; // add new category
$route['get_this_event'] = 'admin/get_this_event'; // Get one event
$route['delete_this_event'] = 'admin/delete_this_event_item'; // Delete event
$route['get_all_event'] = 'admin/get_all_event'; // get all events
$route['add_new_event'] = 'admin/add_new_event'; // add new events
$route['get_all_carousel'] = 'admin/get_all_carousel'; // get all carousel
$route['edit_this_carousel'] = 'admin/update_this_carousel'; // edit carousel
$route['delete_this_carousel'] = 'admin/delete_this_carousel_item'; // delete carousel
$route['activate_this_carousel'] = 'admin/activate_this_carousel_item'; // activate carousel
$route['deactivate_this_carousel'] = 'admin/deactivate_this_carousel_item'; // deactivate carousel
$route['add_new_carousel'] = 'admin/add_new_carousel_info'; // add new carousel
$route['admin_login'] = 'admin/login'; // Admin login
$route['admin_logout'] = 'admin/logout'; // Admin logout
$route['admin_dashboard'] = 'admin/dashboard'; // Dashboard
$route['default_controller'] = 'main';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
