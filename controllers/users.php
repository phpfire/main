<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

    public function index()
	{
		// Essential libraries      
        $this->load->library('fire_boot');
        // ACL check
        $this->acl->check('view_users');
        $this->load->view('headers');
        $this->load->view('nav/top'); 
        $this->load->view('core/users');
        $this->load->view('core/users_list');
        $this->load->view('footer');
	}
    
    
    public function users_xhr()
    {
        
        // Essential libraries
        
        $this->load->library('fire_boot');
        // ACL check
        $this->acl->check('view_users');

        // Generate datatables json
        $this->load->library('datatables');
        $this->datatables
            ->select('id,username,email,name')
            ->from('users');
        $this->datatables->edit_column('username', '<a href="'.site_url('users/edit/').'/$1">$2</a>', 'id, username');
        $this->datatables->edit_column('id', '<div style="text-align: center;">$1</div>', 'id');
        $this->datatables->add_column('edit', '
            <a href="'.site_url('users/edit/').'/$1" class="tablectrl_small bGreyish" title="Edit"><span class="iconb" data-icon="&#xe1db;"></span> Edit User </a>
            <a href="'.site_url('users/delete/').'/$1" class="tablectrl_small bRed" title="Remove"><span class="iconb" data-icon="&#xe136;"></span> Delete User</a>
            <a href="'.site_url('users/acl/').'/$1" class="tablectrl_small bBlack" title="Options"><span class="iconb" data-icon="&#xe1f7;"></span> Access Control Rules </a>
            ','id');
        echo $this->datatables->generate();
    }
    
    public function edit($id=0)
    {
        // Essential libraries
        $this->load->library('fire_boot');
        // ACL check
        $this->acl->check('edit_users');
        //Get the target user ID.
        if(!is_numeric($id)){
            show_error('Missing or wrong user ID');
            exit();
        }
        
        $user = new User();
        if(!$user->load(array('id' => (int)$id))){
            show_error('No such user ID');
            exit();
        }
        
        $this->load->library('form_validation');
        if($this->input->post('username') != $user->username){
            //Add unique check.
            $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]|max_length[250]|xss_clean|is_unique[users.username]');
        } else {
            $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]|max_length[250]|xss_clean');
        }
        $this->form_validation->set_rules('full_name', 'Full Name', 'trim|required|min_length[3]|max_length[250]|xss_clean');
        $this->form_validation->set_rules('email', 'E-Mail', 'trim|required|valid_email|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'max_length[190]|xss_clean');
        $this->form_validation->set_error_delimiters('<div style="padding-left: 10px;"><span class="iconb" data-icon="&#xe05a;"></span>  ', '</div>');
        
        if ($this->form_validation->run() == FALSE){
            $this->load->view('headers');
            $this->load->view('nav/top'); 
            $this->load->view('core/users');
            $this->load->view('core/users_edit',array('user' => $user));
            $this->load->view('footer');
        } else {
            //Validation passed, commit the changes.
            $status = $this->input->post('status');
            if($status == "on"){
                $status = true;
            } else {
                $status = false;
            }
            
            $user->set_name($this->input->post('full_name'))
                ->set_username($this->input->post('username'))
                ->set_email($this->input->post('email'))
                ->set_status($status)
                ->set_password($this->input->post('password'))
                ->save();
            $this->session->set_flashdata('message', 'User successfully saved!');
            redirect('/users', 'location');
        }
        
    }
    
    public function add()
    {
        // Essential libraries
        $this->load->library('fire_boot');
        // ACL check
        $this->acl->check('edit_users');
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]|max_length[250]|xss_clean|is_unique[users.username]');
        $this->form_validation->set_rules('full_name', 'Full Name', 'trim|required|min_length[3]|max_length[250]|xss_clean');
        $this->form_validation->set_rules('email', 'E-Mail', 'trim|required|valid_email|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'required|max_length[190]|xss_clean');
        $this->form_validation->set_error_delimiters('<div style="padding-left: 10px;"><span class="iconb" data-icon="&#xe05a;"></span>  ', '</div>');
        
        //Perform form validation.
        if ($this->form_validation->run() == FALSE){
            $this->load->view('headers');
            $this->load->view('nav/top'); 
            $this->load->view('core/users');
            $this->load->view('core/users_add');
            $this->load->view('footer');
        } else {
            //Add new user
            $status = $this->input->post('status');
            if($status == "on"){
                $status = 1;
            } else {
                $status = 0;
            }
            $user = new User();
            $user->set_name($this->input->post('full_name'))
                 ->set_username($this->input->post('username'))
                 ->set_email($this->input->post('email'))
                 ->set_status($status)
                 ->set_password($this->input->post('password'));
            $new_id = $user->create();
            if((int)$new_id > 0){
                $this->session->set_flashdata('message', 'User successfully created!');
                redirect('/users/acl/'.$new_id, 'location');
            } else {
                show_error('Something went terribly wrong and the user could not be created.');
            }
        }
    }
    
    public function acl($id=0)
    {
         // Essential libraries
        $this->load->library('fire_boot');
        // ACL check
        $this->acl->check('edit_users');
        $this->load->library('form_validation');
        
        //Get the target user ID.
        if(!is_numeric($id)){
            show_error('Missing or wrong user ID');
            exit();
        }
        
        $user = new User();
        if(!$user->load(array('id' => (int)$id))){
            show_error('No such user ID');
            exit();
        }
        
        //Load the available ACLs list.
        $this->config->load('acl',TRUE);
        $available = $this->config->item('acl');
        $current = array();
        
        //Go through each of them and build the current user ACL list.
        foreach($available as $rule=>$desc){
            if($user->can($rule)){
                $current[$rule] = $desc;
                unset($available[$rule]);
            }
        }
        $this->form_validation->set_rules('task', 'task', 'required');
        if ($this->form_validation->run() == FALSE){
            $this->load->view('headers');
            $this->load->view('nav/top'); 
            $this->load->view('core/users');
            $this->load->view('core/users_acl',array('user'=>$user, 'available'=>$available,'current' => $current));
            $this->load->view('footer');
        } else {
            $ar = $this->input->post('allow_acl');
            //Remove all current acl rules for this user.
            $user->void_all_acl();
            //Insert new acls
            if(is_array($ar)){
                foreach($ar as $acl){
                    if(array_key_exists($acl, $available) OR array_key_exists($acl, $current)){
                        $user->add_acl_rule($acl);
                    }
                }
                //Commit batch acl update.
                $user->acl_batch_insert();
            }
            $this->session->set_flashdata('message', 'Permissions modified!');
            redirect('/users/', 'location');
        }
    }
    
    public function delete($id=0)
    {
        // Essential libraries
        $this->load->library('fire_boot');
        // ACL check
        $this->acl->check('edit_users');
        $this->load->library('form_validation');
        
        //Get the target user ID.
        if(!is_numeric($id)){
            show_error('Missing or wrong user ID');
            exit();
        }
        
        $user = new User();
        if(!$user->load(array('id' => (int)$id))){
            show_error('No such user ID');
            exit();
        }
        
        $this->form_validation->set_rules('task', 'task', 'required');
        if ($this->form_validation->run() == FALSE){
            $this->load->view('headers');
            $this->load->view('nav/top'); 
            $this->load->view('core/users');
            $this->load->view('core/users_delete',array('user'=>$user));
            $this->load->view('footer');
        } else {
            //Perform delete.
            $user->seppuku();
            $this->session->set_flashdata('message', 'User successfully removed!');
            redirect('/users/', 'location');
        }
     
    }
    
    
    
    
}

/* End of file users.php */
/* Location: ./application/controllers/users.php */