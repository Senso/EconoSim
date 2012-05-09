<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Building extends CI_Controller {
    
	function __construct() {
		parent::__construct();

		$this->load->helper('url');
		$this->load->library('tank_auth');
		$this->load->model('Company_m');
	}
    
	function info($b_id) {
		$data['info'] = $this->Building_m->get_building_by_id($b_id);
        $this->template->show('building_info', 'Building Info', $data);
	}
    
}