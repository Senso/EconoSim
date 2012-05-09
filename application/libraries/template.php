<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Template {

    public function show($view, $title, $data) {
        $CI =& get_instance();
        
        $data['logged_on'] = $CI->tank_auth->is_logged_in();
        
        $data['title'] = $title;
        
        $user_id = $CI->tank_auth->get_user_id();
        $comp_id = $CI->Company_m->get_companies_by_user($user_id);
        
        if ($comp_id) {
            $data['comp_id'] = $comp_id[0]->id;
        }
        else {
            $data['comp_id'] = 0;
        }
        
        $data['content'] = $CI->load->view($view, $data, true);
		$CI->load->view('body', $data);
    }
}

/* End of file Template.php */