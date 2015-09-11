<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Favorite extends CI_Controller {
	
	public function create()
	{
		$fave = array(
					"users_idusers" => $this->input->post('user_id'),
					"quotes_idquotes" => $this->input->post('quote_id')
			);
		$this->load->model('Users');
		$this->Users->add_fave($fave);
		redirect('/dashboard');
	}

	public function delete()
	{
		$this->load->model('Users');
		$this->Users->remove_fave($this->input->post('fave_id'));
		redirect('/dashboard');
	}
}