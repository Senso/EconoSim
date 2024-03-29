<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
		$this->load->library('tank_auth');
		$this->load->model('Company_m');
	}

	function index()
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		}
		else {
			$data['user_id'] = $this->tank_auth->get_user_id();
			$data['username'] = $this->tank_auth->get_username();
			$data['company'] = $this->Company_m->get_company_by_user($data['user_id']);
			
			$this->template->show('welcome', 'Landing Page', $data);
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */