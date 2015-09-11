<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Session extends CI_Controller {
	public function create()
	{
		$this->load->model('Users');
		$user = $this->Users->get_user_by_email($this->input->post('email'));
		if(!$user) {
			$this->session->set_flashdata('login_fail_message', 'Unregistered user!');
			redirect('/');
		}
		else if($user['password'] != $this->input->post('password')) {
			$this->session->set_flashdata('login_fail_message', 'Wrong password!');
			redirect('/');
		}
		else {
			$user_info = array(
							  'email' => $user['email'],
							  'id' => $user['idusers']);
			$this->session->set_userdata('user_info', $user_info);
			redirect('/dashboard');
		}		
	}
	public function destroy()
	{
		$this->session->sess_destroy();
		redirect('/');
	}
}