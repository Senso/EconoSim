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
		$comps = $this->Company_m->get_companies_by_user($user_id);
		if ($comps) {
			$content_data['error'] = 'You already have a company.';
		}
		else {
			//$content_data['error'] = NULL;
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
		
		$data['title'] = 'New Company';
		$data['content'] = $this->load->view('new_company', $content_data, true);
		$this->load->view('body', $data);
    }
	
	function info($c_id) {
		$content_data['info'] = $this->Company_m->get_company_by_id($c_id);
		if ($data['info']) {
			$this->load->model('users');
			$owner_info = $this->users->get_user_by_id($data['info']->owner, 1);
			$content_data['owner_info'] = $owner_info;
			
			$data['title'] = 'Company Info';
			$data['content'] = $this->load->view('company_info', $content_data, true);
			$this->load->view('body', $data);
		}
		else {
			// load error
		}
	}
    
}
    
    