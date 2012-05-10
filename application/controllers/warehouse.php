<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Warehouse extends CI_Controller {
    
	function __construct() {
		parent::__construct();

		$this->load->helper('url');
		$this->load->library('tank_auth');
		$this->load->model('Company_m');
        $this->load->model('Warehouse_m');
		
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		}
	}
    
    function index() {
        $user_id = $this->tank_auth->get_user_id();
        $c_id = $this->Company_m->get_company_by_user($user_id);
        $data['warehouse'] = $this->Warehouse_m->get_content_by_company($c_id);
        
        $this->template->show('warehouse', 'Warehouse', $data);
        
    }
}