<?php

class Users extends CI_Model {

	function get_user($id)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('users.idusers', $id);
		return $this->db->get()->row_array();
	}

	function show($user_id)
	{
		return $this->db->query("SELECT * FROM (`quotes`) WHERE `idquotes` NOT IN (SELECT `quotes_idquotes` FROM `favorites` WHERE `users_idusers` = ?)", $user_id)->result_array();
	}

	function get_user_by_email($email)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('users.email', $email);
		return $this->db->get()->row_array();
	}

	function create($user)
	{
		return $this->db->insert('users', $user);
	}

	function add_quote($quote)
	{
		return $this->db->insert('quotes', $quote);
	}

	function add_fave($fave)
	{
		return $this->db->insert('favorites', $fave);
	}

	function get_faves($user)
	{
		$this->db->select("*");
		$this->db->from('users');
		$this->db->join('favorites', 'users.idusers = favorites.users_idusers');
		$this->db->join('quotes', 'quotes.idquotes = favorites.quotes_idquotes');
		$this->db->where('favorites.users_idusers', $user);
		return $this->db->get()->result_array();
	}

	function remove_fave($fave)
	{
		$this->db->where('idfavorites', $fave);
		return $this->db->delete('favorites');
	}

}
?>