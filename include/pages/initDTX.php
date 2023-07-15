<?php
session_start();
include_once "../serverlogin.php";

try {
    $file = fopen("../../logs/traces.txt", "a+");
    fwrite($file, PHP_EOL.$Now->format('Y-m-d H:i:s')." ---> initDTX.php". PHP_EOL);
    
    $nb = 83;
    
    $hasFormValues=FALSE;
    
    $connexion = new PDO("mysql:host=$serveur;dbname=$db",$login,$pwd);
    $connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    
    $text="";
    if(($_POST['id']>=0)){
        fwrite($file, "POST[id]=".$_POST['id'].PHP_EOL);
        $text = "SELECT * FROM detox WHERE clientID = '".$_POST['id']."'";
    }else{
        fwrite($file, "SESSION[userid]=".$_SESSION['userid'].PHP_EOL);
        $text = "SELECT * FROM detox WHERE clientID = '".$_SESSION['userid']."'";
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
                $vardyn = "x$i";
                $results[$vardyn] = $row[$vardyn];
            }
        }
        
        $hasFormValues=TRUE;
        $_SESSION["hasFormValues"] = TRUE;
    }
    
    /*ob_start();
    var_dump($results);
    $result = ob_get_clean();
     
    fwrite($file, "resustat = ".$result. PHP_EOL);*/
     
    echo json_encode($results);
    fwrite($file, "Les données ont été recupérées". PHP_EOL);
    
} catch (Exception $e) {
    echo "<br>Echec de la connexion : ". $e->getMessage()."<br>";
    fwrite($file, "Echec de la connexion : ". $e->getMessage(). PHP_EOL);
}

?>