<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Building extends CI_Controller {
    
	function __construct() {
		parent::__construct();

		$this->load->helper('url');
        $this->load->helper('form');
		$this->load->library('tank_auth');
		$this->load->model('Building_m');
        
        if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		}
	}
    
	function info($b_id) {
        $user_id = $this->tank_auth->get_user_id();
        
		$data['info'] = $this->Building_m->get_building_by_id($b_id);
        $data['b_id'] = $b_id;
        
        // This builds the array of stuff this specific building can produce.
        $data['select'] = array();
        $prod = $this->Building_m->get_possible_production($b_id);
        if ($prod) {
            foreach ($prod as $key => $product) {
                $prod_id     = $product->id;
                $output_name = $product->name;
                
                $data['select'][$prod_id] = $output_name;
            }
        }
        
        $data['input_style'] = array(
            'name'        => 'prod_qty',
            'id'          => 'prod_qty',
            'value'       => '1',
            'maxlength'   => '10',
            'size'        => '10', 
        );
        
        $this->template->show('building_info', 'Building Info', $data);
	}
    
    function production() {
        $post = $this->input->post();
        if (!$post) {
            redirect('/');
        }
        
        $user_id = $this->tank_auth->get_user_id();
        
        $new_prod = $post;
        // Array ( [prod_qty] => 100 [choose_prod] => 2 )
        
        // Make sure the player owns that factory.
        $ownership  = $this->Building_m->get_building_owner($b_id);
        if ($ownership->owner != $user_id) {
            $data['errors'] = "You are not the owner of that building";
            $this->template->show('building_info', 'Building Info', $data);
        }
        
        // Make sure the building can produce that.
        $pos_prod = $this->Building_m->get_possible_production($b_id);
        if (!$pos_prod) {
            $data['errors'] = "This building cannot produce what you selected.";
            $this->template->show('building_info', 'Building Info', $data);
        }
        $can_produce = false;
        foreach ($pos_prod as $key => $product) {
            if ($product->id == $new_prod['choose_prod']) {
                $can_produce = true;
                break;
            }
        }
        if (!$can_produce) {
            $data['errors'] = "This building cannot produce what you selected.";
            $this->template->show('building_info', 'Building Info', $data);
        }
        
        
        
        // Check inventory for source materials
        
        
    }
    
}