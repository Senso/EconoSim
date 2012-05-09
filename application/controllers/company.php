<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Company extends CI_Controller {
    
	function __construct() {
		parent::__construct();

		$this->load->helper('url');
		$this->load->library('tank_auth');
		$this->load->model('Company_m');
	}
    
    function create() {
		$user_id = $this->tank_auth->get_user_id();
		$comps = $this->Company_m->get_company_by_user($user_id);
		if ($comps) {
			$data['error'] = 'You already have a company.';
		}
		else {
			$data['error'] = NULL;
			$this->load->helper('form');
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('company_name', 'Company Name', 'required');
			
			if ($this->form_validation->run()) {
				$c_name = $this->form_validation->set_value('company_name');
				$c_name = htmlspecialchars($c_name);
				$result = $this->Company_m->new_company($user_id, $c_name);
				redirect('/');
			}
		}
		
		$this->template->show('new_company', 'New Company', $data);
    }
	
	function info($c_id) {
		$data['info'] = $this->Company_m->get_company_by_id($c_id);
		if ($data['info']) {
			$this->load->model('users');
			$owner_info = $this->users->get_user_by_id($data['info']->owner, 1);
			$data['owner_info'] = $owner_info;
			
			$this->template->show('company_info', 'Company Info', $data);
		}
		else {
			// load error
		}
	}
	
	function buildings() {
		// List all owned buildings
		$user_id = $this->tank_auth->get_user_id();
		$comp = $this->Company_m->get_company_by_user($user_id);
		
		$data = $this->Company_m->get_buildings_by_company($comp->id);
				
		$this->template->show('company_buildings', 'Buildings', $data);
	}
    
}
    
    