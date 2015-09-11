<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('index');
	}

	public function create()
	{
		$this->load->model('Users');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', "Name", "required|alpha");
		$this->form_validation->set_rules('email', "Email Address", "required|valid_email|is_unique[users.email]");
		$this->form_validation->set_rules('alias', "Alias", "required|alpha");
		$this->form_validation->set_rules('password', "Password", "required|matches[confirm_password]|min_length[8]");
		$this->form_validation->set_rules('confirm_password', "Confirm Password", "required|min_length[8]");

		if($this->form_validation->run() === FALSE) {
			$this->session->set_flashdata('error_message', validation_errors());
			redirect('/');
		}

		$user_data = array('name' => $this->input->post('name'),
							 'alias' => $this->input->post('alias'),
							 'email' => $this->input->post('email'),
							 'dob' => $this->input->post('dob'),
							 'password' => $this->input->post('password')
							 );
		if($this->Users->create($user_data)) {
			$this->session->set_flashdata('success_message', 'User successfully registered!');
		}
		redirect('/');
	}

	public function show()
	{
		$this->load->model('Users');
		$results = $this->Users->show($this->session->userdata('user_info')['id']);
		$user_data = $this->Users->get_user($this->session->userdata('user_info')['id']);
		$favorites = $this->Users->get_faves($this->session->userdata('user_info')['id']);
		$data = array('results' => $results, 'user' => $user_data, 'favorites' => $favorites);
		$this->load->view('dashboard', $data);
	}

	public function add_quote()
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

	public function add_fave()
	{
		$fave = array(
					"users_idusers" => $this->input->post('user_id'),
					"quotes_idquotes" => $this->input->post('quote_id')
			);
		$this->load->model('Users');
		$this->Users->add_fave($fave);
		redirect('/dashboard');
	}

	public function delete_fave()
	{
		$this->load->model('Users');
		$this->Users->remove_fave($this->input->post('fave_id'));
		redirect('/dashboard');
	}

}