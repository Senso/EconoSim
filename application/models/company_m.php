<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Company_m extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->table_name = 'companies';
    }
    
    function get_company_by_user($user_id) {
        $this->db->where('owner', $user_id);
        $query = $this->db->get($this->table_name);
        if ($query->num_rows() == 1) {
            return $query->row();
        }
		return NULL;
    }
	
    function get_company_by_id($c_id) {
        $this->db->where('id', $c_id);
        $query = $this->db->get($this->table_name);
        if ($query->num_rows() > 0) {
            return $query->row();
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
	
	function get_buildings_by_company($c_id) {
		$factories = NULL;
		$stores    = NULL;
		
		// Factories
		$this->db->where('company', $c_id);
        $query = $this->db->get('player_factories');
        if ($query->num_rows() > 0) {
            $factories = $query->result();
        }
		
		// Stores
		$this->db->where('company', $c_id);
        $query = $this->db->get('player_stores');
        if ($query->num_rows() > 0) {
            $stores = $query->result();
        }
		
		return array('factories' => $factories, 'stores' => $stores);
		
	}
}