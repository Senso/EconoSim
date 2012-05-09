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
			$content_data['user_id'] = $this->tank_auth->get_user_id();
			$content_data['username'] = $this->tank_auth->get_username();
			$content_data['company'] = $this->Company_m->get_companies_by_user($data['user_id']);
			
			$data['title'] = 'Landing Page';
			$data['content'] = $this->load->view('welcome', $content_data, true);

			$this->load->view('body', $data);
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */