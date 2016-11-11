<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Progden{

		protected $CI;

		// We'll use a constructor, as you can't directly call a function
        // from a property definition.
        public function __construct() {
            // Assign the CodeIgniter super-object
            $this->CI =& get_instance();
            
        }

		public function get_all_carousel(){
			$this->CI->load->model('admin_mod','',TRUE);
			return $this->CI->admin_mod->select_all_carousel();
		}
}

?>