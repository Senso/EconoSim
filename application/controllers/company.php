<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Company extends CI_Controller {
    
	function __construct() {
		parent::__construct();

		$this->load->helper('url');
		$this->load->library('tank_auth');
		$this->load->model('Company_model');
	}
    
    function new_company($name) {
        if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		}
		else {
            $user_id = $this->tank_auth->get_user_id();
            $comps = $this->Company_model->get_companies_by_user($user_id);
            if ($comps) {
                $data['error'] = 'You already have a company.';
            }
            else {
                $data['error'] = NULL;
                
                $this->load->helper('form');
                $this->load->library('form_validation');
                
                $this->form_validation->set_rules('company_name', 'Company Name', 'required');
                
            }
            
            $this->load->view('new_company', $data);
            
        }
        
    }
    
    