<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Warehouse_m extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->table_name = 'warehouse';
    }
    
    function get_content_by_company($c_id) {
        $this->db->where('company', $c_id);
        $query = $this->db->get($this->table_name);
        if ($query->num_rows() > 0) {
            return $query->result();
        }
		return NULL;
    }
	
	function get_qty_per_product($c_id, $p_id) {
        $this->db->where('company', $c_id);
		$this->db->where('product', $p_id);
        $query = $this->db->get($this->table_name);
        if ($query->num_rows() > 0) {
            return $query->result();
        }
		return 0;
	}
    
}