<?php

    require_once '../../config.php';
    require_once '../../model/post.php';


    Class postC {

        function afficherpost()
        {
            $requete = "select * from posts";
            $config = config::getConnexion();
            try {
                $querry = $config->prepare($requete);
                $querry->execute();
                $result = $querry->fetchAll(PDO::FETCH_COLUMN, 1);
                $result = $querry->fetchAll();
                return $result ;
            } catch (PDOException $th) {
                 $th->getMessage();
            }
        }

        function afficherpostCateg($string)
        {
            $requete = "select * from posts where category=:categ";
            $config = config::getConnexion();
            try {
                $querry = $config->prepare($requete);
                $querry->execute(['categ'=>$string]);
                //$result = $querry->fetchAll(PDO::FETCH_COLUMN, 1);
                $result = $querry->fetchAll();
                return $result ;
            } catch (PDOException $th) {
                 $th->getMessage();
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

        function getpostbyTitle($title){
            $req = "select * from posts where title = :title";
            $config = config::getConnexion();
            try{
                $query = $config->prepare($req);
                $query->execute(['title'=>$title]);
                $result = $query->fetch();
                return $result;
            } catch(PDOException $th){
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
                    'category'=>$post->getcateg()

                  
                ]);
            } catch (PDOException $th) {
                 $th->getMessage();
            }
        }



        function supprimerpost($id)
        {
            $sql="DELETE FROM posts WHERE post_id= :id_user";
			$db = config::getConnexion();
			$req=$db->prepare($sql);
			$req->bindValue(':id_user',$id);
			try{
				$req->execute();
			}
			catch (Exception $e){
				die('Erreur: '.$e->getMessage());
			}
        }


        
    }
