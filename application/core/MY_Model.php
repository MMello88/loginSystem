<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model {
    public function  __construct()
	{
        parent::__construct();
    }
	
	protected function after_insert()
	{
		
	}
	
	public function insert()
	{
    	if ($this->db->insert('usuario', $_POST)) {
    		return $this->db->insert_id();
    	} else {
    		return ['code' => $this->db->error()['code'], 'message' => $this->db->error()['message']];
    	}
	}
	
	protected function before_insert()
	{
		
	}
}
