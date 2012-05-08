<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
    
	function __construct() {
		parent::__construct();

		$this->load->library('tank_auth');
		$this->load->model('Company_model');
		$this->load->model('users');
		
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		}
	}

	function info($user_id) {
		$data['user_info'] = $this->users->get_user_by_id($user_id, 1);
		if ($data['user_info']) {
			$data['comp_info'] = $this->Company_model->get_companies_by_user($data['user_info']->id);
		}
		
		$this->load->view('user_info', $data);
	}
}