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
         function afficherCom($id) 
        {
           $requete = "select * from comments ";
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
            function recupereCom($idCom){
                $sql=" SELECT * FROM commentaires WHERE idCom ='$idCom'";
                $db= getConnexion();
                try{
                    $query=$db->prepare($sql);
                    $query->execute();
    
                    $commentaires=$query->fetch();
                    return $commentaires;
                }
                catch (Exception $e){
                    die('Erreur: '.$e->getMessage());
                }
            }
            
           
    
                function modifierCom($commentaires,$idCom){
                    try {
                        $pdo =getConnexion();
                        $query = $pdo->prepare(
                            'UPDATE commentaires SET 
                                text= :text, 
                                date_commentaire= :date_commentaire
                               
                            WHERE idCom= :idCom'
                        );
                        $query->execute([
                            'text' => $commentaires->getText(),
                            'date_commentaire' => $commentaires->getDate(),
                            'idCom' => $idCom
                        ]);
                        echo $query->rowCount() . " records UPDATED successfully <br>";
                    } catch (PDOException $e) {
                        $e->getMessage();
                    }
                }
            
                 function DeleteC($idCom) {
                    try {
                        $pdo = getConnexion();
                        $query = $pdo->prepare(
                            " DELETE FROM `commentaires` WHERE idCom = ' $idCom' " 
                        );
                        $query->execute([
                            'idCom' => $idCom
                        ]);
                    } catch (PDOException $e) {
                        $e->getMessage();
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
            
              public function RechercheComt($date_commentaire) {            
                    $sql = "SELECT * from `commentaires` where date_commentaire=:date_commentaire"; 
                    $db = config::getConnexion();
                    try {
                        $query = $db->prepare($sql);
                        $query->execute([
                            'date_commentaires' => $Art->getDate(),
                        ]); 
                        $result = $query->fetchAll(); 
                        return $result;
                    }
                    catch (PDOException $e) {
                        $e->getMessage();
                    }
                }
               
               
               
                public function TriCom(){
                    try{
                        $pdo=getConnexion();
                        $query=$pdo->prepare("SELECT * FROM commentaires ORDER BY date_commentaire desc");
                        $query->execute();
                        return $query->fetchAll();
                    }
                    catch (PDOException $e) {
                        $e->getMessage();
                    }
                }
    } 