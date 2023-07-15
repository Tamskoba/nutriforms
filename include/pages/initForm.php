<?php
if(session_status() === PHP_SESSION_NONE) session_start();
include_once "../serverlogin.php";

try {
    $file = fopen("../../logs/traces.txt", "a+");
    fwrite($file, PHP_EOL.$Now->format('Y-m-d H:i:s')." ---> initForm.php". PHP_EOL);
    
    $nb = 37;
    
    for ($i = 1; $i <= $nb; $i++) {
        $vardyn = "q$i";
        $$vardyn = 0;
    }

    $hasFormValues=FALSE;

    
    $connexion = new PDO("mysql:host=$serveur;dbname=$db",$login,$pwd);
    $connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
       
    $text="";
    if(isset($_POST['id'])){
        fwrite($file, "POST[id]=".$_POST['id'].PHP_EOL);
        $text = "SELECT * FROM candidose_digestive WHERE clientID = '".$_POST['id']."'";
    }else{
        fwrite($file, "SESSION[userid]=".$_SESSION['userid'].PHP_EOL);
        $text = "SELECT * FROM candidose_digestive WHERE clientID = '".$_SESSION['userid']."'";
    }
    
    fwrite($file, $text . PHP_EOL);

    $requete = $connexion->prepare($text);
    $requete->execute();
    
    $nbr = $requete->rowCount();
    fwrite($file, "Nombre de lignes =".$nbr. PHP_EOL);
    if($nbr>0)
    {
        while($row = $requete->fetch())
        {
            for ($i = 1; $i <= $nb; $i++) {
                $vardyn = "q$i";
                $$vardyn = $row[$vardyn];
            }
        }
        
        $hasFormValues=TRUE;
        $_SESSION["hasFormValues"] = TRUE;
        
        for ($i = 1; $i <= $nb; $i++) {
            $vardyn = "q$i";
            $_SESSION[$vardyn]= $$vardyn;
        }
    }
    
    /*ob_start();
    var_dump($_SESSION);
    $result = ob_get_clean();
    
    fwrite($file, "SESSION = ".$result. PHP_EOL);*/
    fwrite($file, "Les données ont été recupérées". PHP_EOL);
    
} catch (Exception $e) {
    echo "<br>Echec de la connexion : ". $e->getMessage()."<br>";
    fwrite($file, "Echec de la connexion : ". $e->getMessage(). PHP_EOL);
}



?>