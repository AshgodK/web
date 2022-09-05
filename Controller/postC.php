<?php

    require_once '../../config.php';
    require_once '../../model/post.php';


    Class postC {

        function afficherpost()
        {
            $requete = "select * from posts where state=1";
            $db = config::getConnexion();
            try{
            $liste = $db->query($requete);
            return $liste;
        }
        catch (Exception $e){
            die('Erreur: '.$e->getMessage());
        }
            
        }
        function afficherpostA()
        {
            $requete = "select * from posts";
            $db = config::getConnexion();
            try{
            $liste = $db->query($requete);
            return $liste;
        }
        catch (Exception $e){
            die('Erreur: '.$e->getMessage());
        }
            
        }

        

function searchpost($search)
        {
            $requete = "select * from posts  WHERE (title LIKE '%$search%' or category LIKE '%$search%' or author LIKE '%$search%') and state=1 ";
            $config = config::getConnexion();
            try {
                $querry = $config->prepare($requete);
                $querry->execute();
                $result = $querry->fetchAll();
                return $result ;
            } catch (PDOException $th) {
                 $th->getMessage();
            }
        }

        function searchblog($name)
        {
            $sql= "SELECT * FROM posts WHERE category=:name";
            $db = config::getConnexion();
            $req=$db->prepare($sql);
            $req->bindValue(':name',$name);
            try{
                $req->execute();
            }
            catch (Exception $e){
                die('Erreur: '.$e->getMessage());
            }
        }

        function getpostbyID($post_id)
        {
            $requete = "select * from posts where post_id=:post_id";
            $config = config::getConnexion();
            try {
                $querry = $config->prepare($requete);
                $querry->execute(
                    [
                        'post_id'=>$post_id
                    ]
                );
                $result = $querry->fetch();
                return $result ;
            } catch (PDOException $th) {
                 $th->getMessage();
            }
        }
        

        

        function ajouterpost($post)
        {
            $config = config::getConnexion();
            try {
                $querry = $config->prepare('
                INSERT INTO posts
                (post_id, title, author, contents, category,img)
                VALUES
                (:title, :title, :author, :contents, :category, :img)
                ');
                $querry->execute([
                    'post_id'=>$post->getid(),
                    'title'=>$post->gettitle(),
                    'contents'=>$post->getcontent(),
                    'author'=>$post->getauthor(),
                    'category'=>$post->get_categ(),
                    'img'=>$post->get_img()
                ]);
            } catch (PDOException $th) {
                 $th->getMessage();
            }
        }
        function updatestate($id)
        {
            $sql= "UPDATE posts SET state=1 where post_id=:id";
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
        
        function modifierpost($post)
        {
            $config = config::getConnexion();
            try {
                $querry = $config->prepare('
                UPDATE posts SET
                title=:title,contents=:contents,author=:author,category=:category
                where post_id=:id');
                $querry->execute([
                    'id'=>$post->getid(),
                    'title'=>$post->gettitle(),
                    'contents'=>$post->getcontent(),
                    'author'=>$post->getauthor(),
                    'category'=>$post->get_categ()

                  
                ]);
            } catch (PDOException $th) {
                 $th->getMessage();
            }
        }



        function supprimerpost($id)
        {
            $sql="DELETE FROM posts WHERE post_id= :id";
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


        function triertitle()
    {
       $sql = "SELECT * from posts ORDER BY title ASC";
       $db = config::getConnexion();
       try {
           $req = $db->query($sql);
           return $req;
       } catch (Exception $e)
        {
           die('Erreur: ' . $e->getMessage());
       }
    }
    function trierid()
    {
       $sql = "SELECT * from posts ORDER BY category asc";
       $db = config::getConnexion();
       try {
           $req = $db->query($sql);
           return $req;
       } catch (Exception $e)
        {
           die('Erreur: ' . $e->getMessage());
       }
    }
    function countpost(){

            $sql="SELECT count(post_id) FROM posts " ;
            $db = config::getConnexion();
            try{
                $query = $db->query($sql);
                $query->execute();
                   $prog_number =$query->fetchColumn();
                return $prog_number;
            }
            catch(Exception $e){
                die('Erreur: '.$e->getMessage());
            }   
        }
    }
