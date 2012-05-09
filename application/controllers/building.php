<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Building extends CI_Controller {
    
	function __construct() {
		parent::__construct();

		$this->load->helper('url');
        $this->load->helper('form');
		$this->load->library('tank_auth');
		$this->load->model('Building_m');
	}
    
	function info($b_id) {
        $user_id = $this->tank_auth->get_user_id();
        
		$data['info'] = $this->Building_m->get_building_by_id($b_id);
        
        $data['select'] = array();
        $prod = $this->Building_m->get_possible_production($b_id);
        if ($prod) {
            foreach ($prod as $key => $product) {
                //$prods_req = $product->products_required;
                $prod_id     = $product->id;
                $output_name = $product->name;
                
                data['select'][$prod_id] = $output_name;
            }
        }
        
        $this->template->show('building_info', 'Building Info', $data);
	}
    
    function production($b_id) {
        
    }
    
}