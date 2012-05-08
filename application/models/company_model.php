<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Company_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->table_name = 'companies';
    }
    
    function get_companies_by_user($user_id) {
        $this->db->where('owner', $user_id);
        $query = $this->db->get($this->table_name);
        if ($query->num_rows() > 0) {
            return $query->rows();
        }
		return NULL;
    }
	
	function new_company() {
		
	}
}