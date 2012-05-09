<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Market extends CI_Controller {
    
	function __construct() {
		parent::__construct();

		$this->load->helper('url');
		$this->load->library('tank_auth');
		$this->load->model('Market_m');
		
        if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		}
	}
	
	function index() {
		$data['listings'] = $this->Market_m->get_all_listings();
		$this->template->show('market', 'Market', $data);
	}
	
}