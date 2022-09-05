<?php
    require_once '../../config.php';
    require_once '../../model/comment.php';

    class commentC{
        function affichercmnt()
        {
            $requete = "select * from comments";
            $db = config::getConnexion();
            try{
            $liste = $db->query($requete);
            return $liste;
        }
        catch (Exception $e){
            die('Erreur: '.$e->getMessage());
        }
            
        }
         
        function searchcom($idc)
        {
            $requete = "select * from comments where id_post='$idc' ";
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
          function ajouterCom($cmnt)
          {
            $config = config::getConnexion();
            try {
                $querry = $config->prepare('
                INSERT INTO comments
                (id_com, content, id_post)
                VALUES
                (:content, :content, :id_post)
                ');
                $querry->execute([
                    'id_com'=>$cmnt->getIdcom(),
                    'content'=>$cmnt->getcontent(),
                    'id_post'=>$cmnt->getidpost()
                    
                ]);
            } catch (PDOException $th) {
                 $th->getMessage();
            }
        }
            
            
           
    
                
            
                 function supprimercom($id)
        {
            $sql="DELETE FROM comments WHERE id_com= :id";
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
            public  function getComById($id_com) {
                     $requete = "select * from comments where id_com=:id_com";
            $config = config::getConnexion();
            try {
                $querry = $config->prepare($requete);
                $querry->execute(
                    [
                        'id_com'=>$id_com
                    ]
                );
                $result = $querry->fetch();
                return $result ;
            } catch (PDOException $th) {
                 $th->getMessage();
            }
                }
            
              
    } 