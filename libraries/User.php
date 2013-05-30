<?php

class User {
    
    /* Public data */
    public $username = "Guest";
    public $id = 0;
    public $email = "guest@example.com";
    public $name = "Guest Account";
    public $active = 0;
    public $avatar_image = "";
    
    /* We want to restrict access to these. */
    protected $password = "";
    protected $acls = array();
    protected $temp_acl = array();
    protected $system;
    
    public function __construct()
    {
        $this->system =& get_instance();
    }
    
    public function load($args)
    {
        
        $q = $this->system->db->get_where('users',$args);
        if($q->num_rows() > 0){
            $row = $q->row();
            $this->username = $row->username;
            $this->id = $row->id;
            $this->email = $row->email;
            $this->name = $row->name;
            $this->active = $row->active;
            $this->avatar = $row->avatar;
        } else {
            return FALSE;
        }
        return $this;
    }
    
    public function is_guest()
    {
        return ( $this->id == 0 ? TRUE : FALSE);
    }
    
    public function is_logged_in()
    {
        return $this->is_guest();
    }
    
    public function can($aco)
    {
        //Guest users can't do much.
        if($this->id == 0)
        {
            return FALSE;
        }
        
        //Load the acl rules if not already done.
        if(count($this->acls) == 0)
        {
            $this->load_acl_rules();
        }
        
        if(array_key_exists($aco,$this->acls))
        {
            return (bool)$this->acls[$aco];
        } else {
            //By default we do not allow access.
            return FALSE;
        }   
    }
    
    protected function load_acl_rules()
    {
        $this->system->db->where('uid',$this->id);
        $this->system->db->select('aco,permission');
        $q = $this->system->db->get('acl');
        foreach($q->result_array() as $row)
        {
            $this->acls[$row['aco']] = (bool)$row['permission'];
        }
    }
    
    public function set_name($name){
        $this->name = $name;
        return $this;
    }
    
    public function set_username($username){
        $this->username = $username;
        return $this;
    }
    
    public function set_status($status){
        $this->active = (bool)$status;
        return $this;
    }
    
    public function set_email($email){
        $this->email = $email;
        return $this;
    }
    
    public function set_password($password){
        if($password != FALSE AND strlen($password) > 0){
            $this->system->load->library('encrypt');
            $this->password = $this->system->encrypt->encode($password);
        }
        return $this;
    }
    
    public function get_avatar(){
        if(strlen($this->avatar)>0){
            return $this->avatar;
        } else {
            return 'user.png';
        }
    }
    
    public function get_new_messages(){   
        //To be implemented.
        return 3;
    }
    
    public function save()
    {
        if(!$this->id){
            return FALSE;
        }
        
        $data = array(
               'username' => $this->username,
               'name' => $this->name,
               'email' => $this->email,
               'active' => $this->active
            );
        if(strlen($this->password) > 0){
            $data['password'] = $this->password;
        }

        $this->system->db->where('id', $this->id);
        $this->system->db->update('users', $data); 
    }
    
    public function create()
    {
        if($this->id > 0){
            //We can't call create on a loaded user.
            return false;
        }
        
        $data = array(
            'username' => $this->username,
            'name' => $this->name,
            'email' => $this->email,
            'active' => $this->active,
            'password' => $this->password
        );
        
        $this->system->db->insert('users',$data);
        return $this->system->db->insert_id();
    }
    
    public function void_all_acl()
    {
        if($this->id > 0){
            $this->system->db->where('uid', $this->id);
            $this->system->db->delete('acl');
            return $this;
        } else {
            return false;
        }
    }
    
    public function add_acl_rule($rule)
    {
        $this->temp_acl[] = $rule;
        return $this;
    }
    
    public function acl_batch_insert()
    {
        if(count($this->temp_acl) > 0)
        {
            $data = array();
            foreach($this->temp_acl as $acl)
            {
                $data[] = array(
                    'uid' => $this->id,
                    'aco' => $acl,
                    'permission' => 1);
            }
            $this->system->db->insert_batch('acl',$data);
        }
    }
    
    
    
    
    
}