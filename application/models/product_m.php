<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Product_m extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
    function get_required_products($p_id) {
        $this->db->select('products_required');
        $this->db->where('output_prod', $p_id);
        $query = $this->db->get('production');
        if ($query->num_rows() == 1) {
            return $query->row();
        }
		return NULL;
    }
    
    function get_product_id_by_name($p_name) {
        $this->db->select('id');
        $this->db->where('name', $p_name);
        $query = $this->db->get('products');
        if ($query->num_rows() == 1) {
            return $query->row();
        }
		return NULL;       
    }
    
}