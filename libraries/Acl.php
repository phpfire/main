<?php

class Acl {
    
    private $system;
    
    public function __construct()
    {
        $this->system =& get_instance();
    }
    
    public function check($aco)
    {
        if(!$this->system->user->can($aco))
        {
            show_error('You do not have sufficient permissions to access this page',403);
            exit(0);
        }
        return TRUE;
    }
}