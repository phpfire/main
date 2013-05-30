<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Dashboard extends CI_Controller {

    public function index()
	{
		// Essential libraries
        $this->load->library('fire_boot');
        
        $this->load->view('headers');
        $this->load->view('nav/top'); 
        $this->load->view('core/dashboard');
        $this->load->view('footer');
	}
}


/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */