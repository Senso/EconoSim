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
                $prod_id     = $product->output_prod;
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
		$p_id = $new_prod['choose_prod'];
        $b_id = $post['b_id'];

		$data['info'] = $this->Building_m->get_building_by_id($b_id);
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
        
        if ($post['prod_qty'] < 1) {
            $data['errors'] = "Invalid quantity selected.";
            $this->template->show('building_info', 'Building Info', $data);
        }
		
		$this->load->model('Product_m');
		$recipe = $this->Product_m->get_required_products($p_id);
		if (!$recipe) {
	        $data['errors'] = "Product details not found.";
            $this->template->show('building_info', 'Building Info', $data);		
		}
		
		$recipe_array = json_decode($recipe->products_required, $assoc = true);
		print_r($recipe_array);
        

        // Check inventory for source materials
    }
	
	function build() {
		$post = $this->input->post();
		if (!$post) {
			redirect('/');
		}
		
		$this->load->model('Company_m');
		
		$b_id = intval($post['building_type']);
		$user_id = $this->tank_auth->get_user_id();
		$price = $this->Building_m->get_building_price($b_id);
		$comp_info = $this->Company_m->get_company_by_user($user_id);
		$cash_on_hand = $comp_info->cash;
		
		if ((!$price) || (!$comp_info)) {
			// Either item ID or company ID is wrong
			redirect('/');
		}
		
		if (($price->price < 0.01) || ($cash_on_hand < 0.01)) {
			// Something is retarded with the money
			redirect('/');
		}
		
		if ($cash_on_hand - $price->price > 0.00) {
			// Let's do it!
			$new_cash_on_hand = $cash_on_hand - $price->price;
			$this->Company_m->update_cash($comp_info->id, $new_cash_on_hand);
			$this->Building_m->new_building($comp_info->id, $b_id, 'factory');
			
			$b_name = $this->Building_m->get_building_by_id($b_id);
			$data['comp_name'] = $comp_info->name;
			$data['b_name'] = $b_name->name;
			
			$this->template->show('build_success', 'Building Construction', $data);
		}
		
		// Check building price
		// Check if company has enough money
		// remove money, insert new building
	}
    
}