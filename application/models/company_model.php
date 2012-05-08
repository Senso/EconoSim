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
            return $query->result();
        }
		return NULL;
    }
	
	function new_company($user_id, $c_name) {
		$data = array('name' => $c_name, 'owner' => $user_id);
		if ($this->db->insert($this->table_name, $data)) {
			return $this->db->insert_id();
		}
		return NULL;
	}
}