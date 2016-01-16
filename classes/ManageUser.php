<?php

class ManageUser {
	
	private $db = null;
	private $table = "user";
	
	function __construct(DataBase $db) {
		$this->db = $db;
	}
	
	function get($email) {
		$params = array();
		$params["email"] = $email;
		$this->db->select($this->table, "*", "email=:email", $params);
		$row = $this->db->getRow();
		$user = new User();
		$user->set($row);
		return $user;
	}
	
	function set(User $user) {
		$conditions = array();
		$conditions["email"] = $user->getEmail();
		return $this->db->update($this->table, $user->getArray(), $conditions);
	}
	
	function setEmail(User $user, $email) {
		$conditions = array();
		$conditions["email"] = $email;
		return $this->db->update($this->table, $user->getArray(), $conditions);
	}
	
	function insert(User $user) {
		return $this->db->insert($this->table, $user->getArray(), false);
	}
	
	function delete($ID) {
		$params = array();
		$params["email"] = $ID;
		return $this->db->delete($this->table, $params);
	}
	
	function getList($page = 1, $order="", $nrpp=Constant::NRPP) {
		$reg = ($page-1)*$nrpp;
		$this->db->select($this->table, "*", "1=1", array(), $order, "$reg, $nrpp");
		$r = array();
		while($row = $this->db->getRow()) {
			$user = new User();
			$user->set($row);
			$r[] = $user;
		}
		return $r;
	}
	
	function count($condition = "1=1", $params = array()){
		return $this->db->count($this->table, $condition, $params);
	}
	
}