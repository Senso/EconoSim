<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Template {
    
    function __construct() {
        $this->ci =& get_instance();
        
        $this->ci->load->model('Company_m');
    }

    public function show($view, $title, $data) {
        $data['logged_on'] = $this->ci->tank_auth->is_logged_in();
        
        $data['title'] = $title;
        
        $user_id = $this->ci->tank_auth->get_user_id();
        $comp_id = $this->ci->Company_m->get_company_by_user($user_id);
        
        if ($comp_id) {
            $data['comp_id'] = $comp_id->id;
        }
        else {
            $data['comp_id'] = 0;
        }
        
        $data['content'] = $this->ci->load->view($view, $data, true);
		$this->ci->load->view('body', $data);
    }
}

/* End of file Template.php */