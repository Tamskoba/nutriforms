<?php
session_start();
include_once "../serverlogin.php";

try {
    $file = fopen("../../logs/traces.txt", "a+");
    fwrite($file, PHP_EOL.$Now->format('Y-m-d H:i:s')." ---> initPOT.php". PHP_EOL);
    
    $nb = 9;
    
    $hasFormValues=FALSE;
    
    $connexion = new PDO("mysql:host=$serveur;dbname=$db",$login,$pwd);
    $connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    
    $text="";
    if(($_POST['id']>=0)){
        fwrite($file, "POST[id]=".$_POST['id'].PHP_EOL);
        $text = "SELECT * FROM potassium WHERE clientID = '".$_POST['id']."'";
    }else{
        fwrite($file, "SESSION[userid]=".$_SESSION['userid'].PHP_EOL);
        $text = "SELECT * FROM potassium WHERE clientID = '".$_SESSION['userid']."'";
    }
    
    fwrite($file, $text . PHP_EOL);
    
    $requete = $connexion->prepare($text);
    $requete->execute();
    
    $nbr = $requete->rowCount();
    fwrite($file, "Nombre de lignes =".$nbr. PHP_EOL);
    $results = array();
    if($nbr>0)
    {
        while($row = $requete->fetch())
        {
            for ($i = 1; $i <= $nb; $i++) {
                $vardyn = "p$i";
                $results[$vardyn] = $row[$vardyn];
            }
        }
        
        $hasFormValues=TRUE;
        $_SESSION["hasFormValues"] = TRUE;
    }
    
    echo json_encode($results);
    fwrite($file, "Les données ont été recupérées". PHP_EOL);
    
} catch (Exception $e) {
    echo "<br>Echec de la connexion : ". $e->getMessage()."<br>";
    fwrite($file, "Echec de la connexion : ". $e->getMessage(). PHP_EOL);
}

?>