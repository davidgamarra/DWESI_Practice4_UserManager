<?php

class User {
	
	private $email, $pass, $alias, $signindate, $image, $alive, $admin, $worker;
	
	/* 
	 email varchar(80) not null,
	 pass varchar(40) not null,
	 alias varchar(80) not null, //default email sin @...
	 signindate datetime not null default CURRENT_TIMESTAMP,
	 image varchar(40) not null default "no_image.jpg",
	 alive tinyint(1) unsigned not null default 0,
	 admin tinyint(1) unsigned not null default 0,
	 worker tinyint(1) unsigned not null default 0,
	*/
    
    function __construct($email = null, $pass = null, $alias = null, $signindate = null,
						 $image = null, $alive = null, $admin = null, $worker = null) {
        $this->email = $email;
		$this->pass = $pass === null ? $pass : sha1($pass);
		$this->alias = $alias;
		$this->signindate = $signindate;
		$this->image = $image;
		$this->alive = $alive;
		$this->admin = $admin;
		$this->worker = $worker;
    }
    
    function getEmail() {
        return $this->email;
    }
	
	function getPass() {
		return $this->pass;
	}
	
	function getAlias() {
		return $this->alias;
	}
	
	function getSignindate() {
		return $this->signindate;
	}
	
	function getImage() {
		return $this->image;
	}
	
	function getAlive() {
		return $this->alive;
	}
	
	function getAdmin() {
		return $this->admin;
	}
	
	function getWorker() {
		return $this->worker;
	}

    function setEmail($email) {
        $this->email = $email;
    }
	
	function setPass($pass) {
		$this->pass = sha1($pass);
	}
	
	function setAlias($alias) {
		$this->alias = $alias;
	}
	
	function setSignindate($signindate) {
		$this->signindate = $signindate;
	}
	
	function setImage($image) {
		$this->image = $image;
	}
	
	function setAlive($alive) {
		$this->alive = $alive;
	}
	
	function setAdmin($admin) {
		$this->admin = $admin;
	}
	
	function setWorker($worker) {
		$this->worker = $worker;
	}
	
	function getJson() {
		$r = '{';
		foreach($this as $key => $value) {
			$r .= '"' . $key . '":"' . $value . '",';
		}
		$r = substr($r, 0, -1);
		$r .= '}';
		return $r;
	}

	function set($values, $index=0) {
		$i = 0;
		foreach($this as $key => $value) {
			$this->$key = $values[$i+$index];
			$i++;
		}
	}
	
	function getArray($values=true) {
		$r = array();
		foreach($this as $key => $value) {
			if($values){
				$r[$key] = $value;
			} else {
				$r[$key] = null;
			}
		}
		return $r;
	}
	
	function read(){
		foreach($this as $key => $value) {
			$this->$key = Request::req($key);
		}
	}
	
}