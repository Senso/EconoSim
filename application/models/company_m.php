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
		$buildings = NULL;
		
		$query = sprintf("SELECT player_buildings.id,building_id,type,
			(select name from buildings where player_buildings.id = building_id) as name
			from player_buildings
			WHERE company = '%s'", mysql_real_escape_string($c_id));
		$result = $this->db->query($query);
        if ($result->num_rows() > 0) {
            $buildings = $result->result();
        }
		
		return $buildings;
	}
	
	function update_cash($c_id, $cash) {
		$this->db->where('id', $c_id);
		$this->db->update($this->table_name, array('cash' => $cash));
	}
}