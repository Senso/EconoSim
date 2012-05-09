<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Template {

    public function show($view, $data) {
        $CI =& get_instance();
        
        $data['content'] = $this->load->view($view, $data, true);
		$this->load->view('body', $data);
    }
}

/* End of file Template.php */