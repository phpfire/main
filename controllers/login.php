<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

    public function index()
    {
        $this->load->database();
        $this->load->library('session');
        $this->load->library('user');
        $this->load->library('auth');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->helper('form');
        
        if((int)$this->session->userdata('fire_uid') > 0){
             redirect('/dashboard', 'location'); //Already logged in?
        }
        
        /* Define the validation rules */
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]|max_length[250]|xss_clean');
    	$this->form_validation->set_rules('password', 'Password', 'required|min_length[5]|max_length[250]|xss_clean|callback__login_check');
        if ($this->form_validation->run() == FALSE)
        {
                $this->load->view('login');
        } else {
                redirect('/dashboard', 'location');
        }
	}
    
    public function _login_check()
    {
        $login_results = $this->auth->run($this->input->post('username'), $this->input->post('password'));
            if(!$login_results['success'])
            {
                //Failed.
                $this->form_validation->set_message('_login_check', $login_results['msg']);
                return FALSE;
            } else {
                return TRUE;
            }
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */