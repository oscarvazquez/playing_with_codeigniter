<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Quote extends CI_Controller {
	public function create()
	{
		$quote = array(
						'author' => $this->input->post('author'),
						'quote' => $this->input->post('quote'),
						'users_idusers' => $this->session->userdata('user_info')['id']
					);
		$this->load->model('Users');
		$this->Users->add_quote($quote);
		redirect('/dashboard');
	}
}