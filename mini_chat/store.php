<div id="refresh">
<?php
// Connexion à la base de données
        try{
            $bdd = new PDO('mysql:host=localhost;dbname=tp_chat;charset=utf8','root','');
            }

        catch(Exception $e){
            die('Erreur : '.$e->getMessage());
                            }
        // Récupération des 10 derniers messages

        $reponse = $bdd->query('SELECT pseudo, message,date, IP, user FROM tp_chat.mini_chat ORDER BY ID DESC LIMIT 0, 10');

    
        // Vérifions si la requête a fonctionné
        if(!$reponse) {
        // terminer le programme avec l'erreur d'affichée
            // http://php.net/manual/fr/pdo.errorinfo.php
            print_r($bdd->errorInfo()); 
        }
        // Affichage de chaque message (toutes les données sont protégées par htmlspecialchars)

        while ($donnees = $reponse->fetch()){
            echo '<p><strong>' . htmlspecialchars($donnees['pseudo']) . '</strong> : ' . htmlspecialchars($donnees['message']) ." ". '<p><span class="badge badge-secondary">'. $donnees['date'] . '</span></p> ';
            ;
        
        }
        $reponse->closeCursor();
        ?>
        </div>