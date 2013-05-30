<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Messages extends CI_Controller {

    public function index()
    {
        echo ("To be implemented");   
    }
    
    public function send_xhr()
    {
        // Essential libraries      
        $this->load->library('fire_boot');
        // ACL check
        $this->acl->check('send_message');
        
        $data['receiver'] = (int)$this->input->post('receiver');
        $data['subject'] = $this->input->post('subject');
        $data['body'] = $this->input->post('message');
        
        //Prep the data
        $err = "";
        if(!$data['receiver']){
            $err = "Unknown recipient!";
        }
        if(!$data['subject'] or strlen($data['subject']) == 0){
            $data['subject'] = "(No Subject)";
        }
        if(!$data['body'] or strlen($data['body']) == 0){
            $err = "Body message is missing!";
        }
        
        if(strlen($err) > 0){
            echo json_encode(array('success'=>false, 'msg' => $err));
        } else {
            //Perform insertion.
            $data['sender'] = $this->user->id;
            $data['seen'] = false;
            $this->db->insert('user_messages', $data); 
            echo json_encode(array('success'=>true));
        }
    }
    
}

//End of file: messages.php
//Location: application/controllers/messages.php