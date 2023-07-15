<?php
session_start();
include_once "../serverlogin.php";

if(isset($_POST))
{
    try {
        
        $connexion = new PDO("mysql:host=$serveur;dbname=$db",$login,$pwd);
        $connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        
        $fn = $_POST['fn'];
        $nm = $_POST['nm'];
        $ml = $_POST['ml'];
        $ph = $_POST['ph'];
        $lv = $_POST['lv'];
        $id = $_POST['id'];
        
        /* update clients table */
        $text = "UPDATE clients SET firstname=:firstname, name=:name, email=:email, phone=:phone, level=:level ";
        $text .= "WHERE id=:id";
        
        $requete = $connexion->prepare($text);
        
        $requete->bindParam(':id', $id);
        $requete->bindParam(':firstname', $fn);
        $requete->bindParam(':name', $nm);
        $requete->bindParam(':email', $ml);
        $requete->bindParam(':phone', $ph);
        $requete->bindParam(':level', $lv);
        
        $requete->execute();
        
        echo "Les modifications ont été enregistrées.";
        
    } catch (Exception $e) {
        echo "<br>Echec de la connexion : ". $e->getMessage()."<br>";
    }
}
?>