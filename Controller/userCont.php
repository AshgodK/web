<?php

    require_once '../../config.php';
    require_once '../../model/user.php';


    Class userC {




     



        function modifieruser($newuser, $id){
			try {
				$db = config::getConnexion();
				$query = $db->prepare(
					'UPDATE user SET 
						nom = :nom, 
						prenom = :prenom,
                        sexe = :sexe,
						email = :email,
                        login = :login,
                        date_n=:date_n,
						password = :password
					WHERE id= :id'
				);
				$query->execute([
                    'nom'=>$newuser->nom,
                    'prenom'=>$newuser->prenom,
                    'sexe'=>$newuser->sexe,
                    'email'=>$newuser->email,
                    'login'=>$newuser->login,
                    'date_n'=>$newuser->date_n,
                    'password'=>$newuser->password,
                    'id'=>$id
				]);
			
			} catch (PDOException $th) {
				echo $th->getMessage() ;
                
			}
		}


        function recupMail($id){
            $db = config::getConnexion();
            $sql="SELECT email FROM user where id=$id";
           
            try{
            $liste=$db->query($sql);
            return $liste;
            }
            catch (Exception $e){
                die('Erreur: '.$e->getMessage());
            }
        }	
        function recuprole($id){
            $db = config::getConnexion();
            $sql="SELECT role FROM user where email=$id";
           
            try{
            $liste=$db->query($sql);
            return $liste;
            }
            catch (Exception $e){
                die('Erreur: '.$e->getMessage());
            }
        }	
          

        function connexionUser($email,$password)
		{
			$db = config::getConnexion();
			$sql = "SELECT * FROM user WHERE email='" . $email . "'and password= '". $password." ' " ;
			try
			{
				$query=$db->prepare($sql);
				$query->execute();
				$count=$query->rowCount();
				$result = $query->fetch(PDO::FETCH_OBJ);
				if($count==0)
				{
					$message="pseudo ou le mot de passe est incorrect";
				}
				else
				{
					$x=$query->fetch();
					$message=$x['email'];
					$_SESSION['nom'] = $result->nom ;
					$_SESSION['id'] = $result->id ;
					$_SESSION['prenom']=$result->prenom ;
					$_SESSION['email']=$result->email ;
                    $_SESSION['role']=$result->role;
					echo "$message";

				}
				

			}
			catch (Exception $e)
				{
					$message= " ".$e->getMessage();
				}

			return $message;
		}

        function recherche($idcategorie)
        {
            $sql="SELECT * from user where nom=$idcategorie";
            $db = config::getConnexion();
            try{
            $req=$db->query($sql);
            return $req;
            }
            catch (Exception $e){
                die('Erreur: '.$e->getMessage());
            }
        }
  




        function getuserbyID($id)
        {
            $requete = "select * from user where id=:id";
            $config = config::getConnexion();
            try {
                $querry = $config->prepare($requete);
                $querry->execute(
                    [
                        'id'=>$id
                    ]
                );
                $result = $querry->fetch();
                return $result ;
            } catch (PDOException $th) {
                 $th->getMessage();
            }
        }

        function ajouteruser($newuser)
        {
            $config = config::getConnexion();
            try {
                $querry = $config->prepare('
                INSERT INTO user
                (nom,prenom,sexe,email,login,date_n,password)
                VALUES
                (:nom,:prenom,:sexe,:email,:login,:date_n,:password)
                ');
                $querry->execute([
                    'nom'=>$newuser->nom,
                    'prenom'=>$newuser->prenom,
                    'sexe'=>$newuser->sexe,
                    'email'=>$newuser->email,
                    'login'=>$newuser->login,
                    'date_n'=>$newuser->date_n,
                    'password'=>$newuser->password
                ]);
            } catch (PDOException $th) {
                echo $th->getMessage();
            }
        }
       



        function supprimeruser($id)
        {
            $sql="DELETE FROM user WHERE id= :id";
			$db = config::getConnexion();
			$req=$db->prepare($sql);
			$req->bindValue(':id',$id);
			try{
				$req->execute();
			}
			catch (Exception $e){
				die('Erreur: '.$e->getMessage());
			}
        }
    }
    function afficherclients(){
			
        $sql="SELECT * FROM user";
        $db = config::getConnexion();
        try{
            $liste = $db->query($sql);
            return $liste;
        }
        catch (Exception $e){
            die('Erreur: '.$e->getMessage());
        }	
    }
    function trierNom()
    {
       $sql = "SELECT * from user ORDER BY nom ASC";
       $db = config::getConnexion();
       try {
           $req = $db->query($sql);
           return $req;
       } catch (Exception $e)
        {
           die('Erreur: ' . $e->getMessage());
       }
    }
   
  ?>