<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		// Essential libraries
        $this->load->library('fire_boot');
        
        $this->load->view('welcome_message');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */