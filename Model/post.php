<?php
    class post
    {
        private $id;
        public $title;
        public $contents;
		public $author;
		public $category;
		public $img;

    

        function __construct($id, $title, $contents, $img, $category,$author){
			$this->id=$id;
			$this->title=$title;
			$this->contents=$contents;
			$this->author =$author;
			$this->category = $category;
			$this->img=$img;

		}

        function setid(string $id){
			$this->id=$id;
		}
        function settitre(string $title){
			$this->title=$title;
		}
        function setcontent(string $contents){
			$this->contents=$contents;
        }
        function setauthor(string $author){
			$this->author=$author;
		}
		function setimg(string $img){
			$this->img=$img;
		}

        function getid(){
			return $this->id;
		}
        function gettitle(){
			return $this->title;
		}
        function getcontent(){
			return $this->contents;
		}
		function getauthor(){
			return $this->author;
		}
		function get_categ(){
			return $this->category;
		}
		function get_img(){
			return $this->img;
		}

        

		/**
		 * Get the value of prix
		 */ 
		

		/**
		 * Set the value of prix
		 *
		 * @return  self
		 */ 
		
    }
    

?>