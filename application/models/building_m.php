<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Building_m extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_building_by_id($b_id) {
        $this->db->where('id', $b_id);
        $query = $this->db->get($this->table_name);
        if ($query->num_rows() > 0) {
            return $query->row();
        }
		return NULL;
    }
	
	function new_building($c_id, $b_type) {

	}
}