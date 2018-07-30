<?php
setcookie("nickname", $_POST["nickname"], time() + 365*24*3600, null, null, false, true); // On écrit un cookie

    //Récupérer user_agent
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    //Récupérer l'IP
    function get_ip() {
        // IP si internet partagé
        if (isset($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        }
        // IP derrière un proxy
        elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        // Sinon : IP normale
        else {
            return (isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '');
        }
    }
    $ip = get_ip();
// Connexion à la base de données

try{
   $bdd = new PDO('mysql:host=localhost;dbname=tp_chat;charset=utf8','root','');
}

catch(Exception $e){
        die('Erreur : '.$e->getMessage());
}

// Insertion du message à l'aide d'une requête préparée

$req = $bdd->prepare('INSERT INTO tp_chat.mini_chat (pseudo, message, date,IP, user) VALUES(?, ?, NOW(), ?, ?)');

$req->execute(array($_POST['nickname'], $_POST['message'], $ip, $user_agent));


// Redirection du visiteur vers la page du minichat

header('Location: index.php');



?>