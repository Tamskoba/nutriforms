<?php
session_start();
include_once "../serverlogin.php";

try {
    $file = fopen("../../logs/traces.txt", "a+");
    fwrite($file, PHP_EOL.$Now->format('Y-m-d H:i:s')." ---> initUsers.php". PHP_EOL);
    
    $results = array();
    
    $connexion = new PDO("mysql:host=$serveur;dbname=$db",$login,$pwd);
    $connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    
    $text = "SELECT * FROM clients";
    if($_SESSION["Data"]["level"]>0)
        $text .= " WHERE level = 3";
    if($_SESSION["Data"]["level"]==4)
        $text .= " AND id >=9";
    
    fwrite($file, $text . PHP_EOL);
    $requete = $connexion->prepare($text);
    $requete->execute();
    
    $nb = $requete->rowCount();
    if($nb>0)
    {
        $i=0;
        while($row = $requete->fetch())
        {
            $results[$i]["firstname"] = $row['firstname'];
            $results[$i]["name"] = $row['name'];
            $results[$i]["login"] = $row['login'];
            $results[$i]["email"] = $row['email'];
            $results[$i]["phone"] = $row['phone'];
            $results[$i]["userid"] = $row['id'];
            $results[$i]["level"] = $row['level'];
            $i++;
        }
    }
    
    echo json_encode($results);
    fwrite($file, "Les données ont été recupérées". PHP_EOL);
    
} catch (Exception $e) {
    fwrite($file, "Echec de la connexion : ". $e->getMessage(). PHP_EOL);
    echo "<br>Echec de la connexion : ". $e->getMessage()."<br>";
}
?>