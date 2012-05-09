<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Market_m extends CI_Model {

    function __construct() {
        parent::__construct();
		$this->table_name = 'market';
    }

    function get_all_listings() {
        $query = $this->db->get($this->table_name);
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
}