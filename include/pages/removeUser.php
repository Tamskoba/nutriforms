<?php
session_start();
include_once "../serverlogin.php";

if(isset($_POST))
{
    try {
        
        $connexion = new PDO("mysql:host=$serveur;dbname=$db",$login,$pwd);
        $connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        
        $id = $_POST['id'];
        
        /* delete client fromr table */
        $text = "DELETE FROM clients WHERE id=:id";
        
        $requete = $connexion->prepare($text);
        
        $requete->bindParam(':id', $id);
        
        $requete->execute();
        
        echo "Les modifications ont été enregistrées.";
        
    } catch (Exception $e) {
        echo "<br>Echec de la connexion : ". $e->getMessage()."<br>";
    }
}
?>