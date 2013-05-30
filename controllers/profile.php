<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller {

    public function index()
    {
		// Essential libraries      
        $this->load->library('fire_boot');
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('full_name', 'Full Name', 'trim|required|min_length[3]|max_length[250]|xss_clean');
        $this->form_validation->set_rules('email', 'E-Mail', 'trim|required|valid_email|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'max_length[190]|xss_clean');
        $this->form_validation->set_error_delimiters('<div style="padding-left: 10px;"><span class="iconb" data-icon="&#xe05a;"></span>  ', '</div>');
        
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('headers');
            $this->load->view('nav/top'); 
            $this->load->view('core/profile');
            $this->load->view('core/profile_edit');
            $this->load->view('footer'); 
        } else 
        {
            $this->user->set_name($this->input->post('full_name'))
                ->set_email($this->input->post('email'))
                ->set_password($this->input->post('password'))
                ->save();
            $this->session->set_flashdata('message', 'Details successfully saved!');
            redirect('/profile', 'location');
        }
	}
    
    public function avatar()
    {
        // Essential libraries      
        $this->load->library('fire_boot');
        $this->load->library('form_validation');
        
        //Upload config
        $config['upload_path'] = './images/avatars/';
    	$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
        $config['encrypt_name'] = TRUE;
        //Load upload lib
        $this->load->library('upload', $config);
        
        
        if (!$this->upload->do_upload())
    	{
            $this->load->view('headers');
            $this->load->view('nav/top'); 
            $this->load->view('core/profile');
            $this->load->view('core/profile_edit',array('upload_error' => $this->upload->display_errors()));
            $this->load->view('footer'); 
		} else {
    	    //Clear current avatar
            $this->user->clear_avatar();
            //Resize uploaded file
            $new_avatar = $this->upload->data();
            $uconfig['image_library'] = 'gd2';
            $uconfig['source_image'] = './images/avatars/'.$new_avatar['file_name'];
            $uconfig['width'] = 70;
            $uconfig['height'] = 70;
            $this->load->library('image_lib', $uconfig); 
            if(!$this->image_lib->resize())
            {
                $this->load->view('headers');
                $this->load->view('nav/top'); 
                $this->load->view('core/profile');
                $this->load->view('core/profile_edit',array('upload_error' =>  $this->image_lib->display_errors()));
                $this->load->view('footer');
            } 
            else
            {
                $this->user->set_avatar($new_avatar['file_name']);
                $this->session->set_flashdata('message', 'Avatar successfully saved!');
                redirect('/profile', 'location');
            }   
		}
		
    }
    
    public function remove_avatar_xhr()
    {
        // Essential libraries      
        $this->load->library('fire_boot');
        $this->user->clear_avatar();
        echo json_encode(array('success' => TRUE));
    }
    
    
}

//End of file profile.php
//Location: application/controllers/profile.php