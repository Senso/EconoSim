<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Company extends CI_Controller {
    
	function __construct() {
		parent::__construct();

		$this->load->helper('url');
		$this->load->library('tank_auth');
		$this->load->model('Company_model');
	}
    
    function create() {
        if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		}
		
		$user_id = $this->tank_auth->get_user_id();
		$comps = $this->Company_model->get_companies_by_user($user_id);
		if ($comps) {
			$data['error'] = 'You already have a company.';
			$this->load->view('new_company', $data);
		}
		else {
			$data['error'] = NULL;
			$this->load->helper('form');
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('company_name', 'Company Name', 'required');
			
			if ($this->form_validation->run() == FALSE) {
				
				$this->load->view('new_company', $data);
			}
			else {
				$c_name = $this->form_validation->set_value('company_name');
				$c_name = htmlspecialchars($c_name);
				$result = $this->Company_model->new_company($user_id, $c_name);
				//$data['creation'] = $result;
				print_r($result); die();
			}	
		}
    }
	
	function info($c_id) {
		$data['info'] = $this->Company_model->get_company_by_id($c_id);
		$this->load->view('company_info', $data);
	}
    
}
    
    