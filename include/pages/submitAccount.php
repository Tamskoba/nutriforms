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
        $id = $_SESSION["Data"]["userid"];
        
        /* update clients table */
        $text = "UPDATE clients SET firstname=:firstname, name=:name, email=:email, phone=:phone ";      
        $text .= "WHERE id=:id";
        
        $requete = $connexion->prepare($text);
        
        $requete->bindParam(':id', $id);
        $requete->bindParam(':firstname', $fn);
        $requete->bindParam(':name', $nm);
        $requete->bindParam(':email', $ml);
        $requete->bindParam(':phone', $ph);
        
        $requete->execute();
        
        $_SESSION["Data"]["username"] = $nm;
        $_SESSION["Data"]["firstname"] = $fn;
        $_SESSION["Data"]["email"] = $ml;
        $_SESSION["Data"]["phone"] = $ph;
        
        
        echo json_encode($_SESSION["Data"]);
        
    } catch (Exception $e) {
        echo "<br>Echec de la connexion : ". $e->getMessage()."<br>";
    }
}
?>