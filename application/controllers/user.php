<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
    
	function __construct() {
		parent::__construct();

		$this->load->library('tank_auth');
		$this->load->model('Company_m');
		$this->load->model('users');
		
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		}
	}

	function info($user_id) {
		$content_data['user_info'] = $this->users->get_user_by_id($user_id, 1);
		if ($content_data['user_info']) {
			$content_data['comp_info'] = $this->Company_m->get_companies_by_user($content_data['user_info']->id);
		
			$data['title'] = 'Player Info';
			$data['content'] = $this->load->view('user_info', $content_data, true);
			$this->load->view('body', $data);
		}
		else {
			// load error
		}
	}
}