<?php
class Auth {
    
    private $system;
    
    public function __construct()
    {
        $this->system =& get_instance();
    }
    
    public function run($user,$pass)
    {
        $this->system->load->database();
        $this->system->load->library('session');
        $this->system->load->library('encrypt');
        
        $this->system->db->where('username',$user);
        $this->system->db->where('active',TRUE);
        $q = $this->system->db->get('users');
        
        if($q->num_rows() > 0)
        {
            $u = $q->row_array();
            //Password check
            if($this->system->encrypt->decode($u['password']) != $pass)
            {
                //Wrong password
                log_message('debug', 'Authorisation failed due to wrong password.');
                return array('success' => false, 'msg' => 'Authorisation failed!');
            } else {
                //Process correct login.
                $this->system->session->set_userdata('fire_uid',$u['id']);
                return array('success' => true);
            }
        }
        log_message('debug', 'Authorisation failed due to non-existent username.');
        return array('success' => false, 'msg' => 'Authorisation failed!');
    }
}