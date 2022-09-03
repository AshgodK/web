<?php
class cmnt {
public   $content;
public   $id_post;
private  $idCom;


    
    
    public function __construct($idCom,$content,$id_post){
        $this->content=$content;
        $this->idCom=$idCom;
        $this->id_post=$id_post;

    }


    //getters
    public function getIdcom(){
        return $this->idCom;
    }
    public function getcontent(){
        return $this->content;
    }
    
    public function getidpost(){
        return $this->id_post;
      
    }
     //setters
     public function setIdcom($idCom){
        $this->idCom = $idCom;   
    }
    public function setcontent($content){
        $this->content = $content;
    }

    public function setidpost($id_post){
        $this->id_post=$id_post;
    }
}
?>