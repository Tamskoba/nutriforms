<?php
session_start();
include 'config.php';
include_once '..'.$DP.'serverlogin.php';
$file = fopen("../../logs/traces.txt", "a+");

fwrite($file, "---> addUser.php". PHP_EOL);
if(isset($_POST))
{
    try {
        
        $connexion = new PDO("mysql:host=$serveur;dbname=$db",$login,$pwd);
        $connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        
        /*$requete = $connexion->prepare("INSERT INTO candidose_digestive(clientID,q1,q2,q3,q4,q5)
         VALUES (:id,:q1,:q2,:q3,:q4,:q5)");*/
        
        $fn = $_POST['fn'];
        $nm = $_POST['nm'];
        $ml = $_POST['ml'];
        $ph = $_POST['ph'];
        $lv = $_POST['lv'];
        
        $pwd = password_hash("yaounde", PASSWORD_DEFAULT);
        
        /* insert in clients */
        $text = "INSERT INTO clients (firstname, name, email, phone, level, pwd)
         VALUES (:fn,:nm,:ml,:ph,:lv,:pwd)";
        
        fwrite($file, "INSERT INTO clients (firstname, name, email, phone, level, pwd) VALUES ($fn,$nm,$ml,$ph,$lv,$pwd)". PHP_EOL);
        $requete = $connexion->prepare($text);
        
        $requete->bindParam(':fn', $fn);
        $requete->bindParam(':nm', $nm);
        $requete->bindParam(':ml', $ml);
        $requete->bindParam(':ph', $ph);
        $requete->bindParam(':lv', $lv);
        $requete->bindParam(':pwd', $pwd);
        
        $requete->execute();
        
        $text = "SELECT * FROM clients WHERE email=:ml";   
        fwrite($file, "SELECT * FROM clients WHERE email=$ml". PHP_EOL);
        
        $requete = $connexion->prepare($text);
        $requete->bindParam(':ml', $ml);
        $requete->execute();
        
        $row = $requete->fetch();
        $id = $row['id'];
        
        /* insert in candidose_digestive*/
        $text = "INSERT INTO candidose_digestive (clientID) VALUES (:id)";
        fwrite($file, "INSERT INTO candidose_digestive (clientID) VALUES ($id)". PHP_EOL);
        
        $requete = $connexion->prepare($text);        
        $requete->bindParam(':id', $id);
        $requete->execute();
        
        /* insert in hormonal*/
        $text = "INSERT INTO hormonal (clientID) VALUES (:id)";
        fwrite($file, "INSERT INTO hormonal (clientID) VALUES ($id)". PHP_EOL);
        
        $requete = $connexion->prepare($text);
        $requete->bindParam(':id', $id);
        $requete->execute();
        
        echo "Les modifications ont été enregistrées.";
        fwrite($file, "Les modifications ont été enregistrées.". PHP_EOL);

    } catch (Exception $e) {
        echo "<br>Echec de la connexion : ". $e->getMessage()."<br>";
        fwrite($file, "Echec de la connexion : ". $e->getMessage(). PHP_EOL);
    }
}
?>