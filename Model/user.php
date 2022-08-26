<?php
    class User
    {
		public $id;
        public $name;      
		public $email;
		public $role;
		public $password;

    

        function __construct($name, $id, $email ,$role,$password){
			$this->name=$name;
			$this->id=$id;
			$this->email=$email;
			$this->role= $role;
			$this->password=$password;
		}
	}
   
?>