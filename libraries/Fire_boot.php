<?php

class Fire_boot {
    
    private $system;
    
    public function __construct()
    {
        $this->system =& get_instance();
        $this->boot();
    }
    
    public function boot()
    {
        $this->system->load->database();
        $this->system->load->library('session');
        $this->system->load->library('user');
        $this->system->load->library('acl');
        $this->system->load->helper('url');
        
        //Load up the session data, if any.
        if((int)$this->system->session->userdata('fire_uid') > 0)
        {
            $this->system->user->load(array('id' => (int)$this->system->session->userdata('fire_uid')));
        }
        
        //Handle login screen.
        if($this->system->user->is_guest()){
            redirect(site_url('login'), 'location', 301);
            exit(0);
        }
        
        if(config_item('debug')){
            //Enable Profiling and debug messages.
            $this->system->config->set_item('log_threshold', 2);
            $this->system->output->enable_profiler(TRUE);
        }
    }
}