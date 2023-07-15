<?php
session_start();
include_once 'serverlogin.php';
$file = fopen("../logs/traces.txt", "a+");
fwrite($file, PHP_EOL.$Now->format('Y-m-d H:i:s')." ---> login.php".PHP_EOL);

// Message d'erreur à sauvegardez
//$errorMessage = "Ceci est un message d'erreur!";

// Chemin du fichier log où les erreurs doivent être sauvegardées
//$logFile = "logs/errors.txt";

// Enregistrement du message d'erreur dans le fichier log
//error_log($errorMessage, 3, $logFile);

if(isset($_POST))
{
    $_SESSION["username"] = "";
    $results["valid"] = "no";
    try {
        
        $connexion = new PDO("mysql:host=$serveur;dbname=$db",$login,$pwd);
        $connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        
        /*$requete = $connexion->prepare("INSERT INTO Clients(firstname,name,email,phone)
            VALUES (:prenom,:nom,:email,:telephone)");
        $requete->bindParam(':prenom', $prenom);
        $requete->bindParam(':nom', $nom);
        $requete->bindParam(':email', $mail);
        $requete->bindParam(':telephone', $phone);
        
        $prenom = $_POST["fn"];
        $nom = $_POST["nm"];
        $mail = $_POST["em"];
        $phone = $_POST["ph"];
        
        $requete->execute();
        
        //echo "<br>Insertion reussie à la base de données<br>";*/
        $login = $_POST['lg'];
        $pwd = $_POST['pw'];
        $requete = $connexion->prepare("SELECT * FROM clients WHERE email = '$login'");
        
        $text2 = "SELECT * FROM clients WHERE email = '$login'";
        fwrite($file, $text2 . PHP_EOL);
        
        $text2 = "Password = '$pwd'";
        fwrite($file, $text2 . PHP_EOL);
        
        $requete->execute();
    
    } catch (Exception $e) {
        echo "<br>Echec de la connexion : ". $e->getMessage()."<br>";
        fwrite($file, "Echec de la connexion : ". $e->getMessage(). PHP_EOL);
    }
    
    $nb = $requete->rowCount();
    fwrite($file, "Nombre de lignes =".$nb. PHP_EOL);
    
    if($nb>0)
    {
        $checkAllpwd = FALSE;
            
        while($row = $requete->fetch())
        {
            $results["firstname"] = $row['firstname'];
            $results["name"] = $row['name'];
            $results["email"] = $row['email'];
            $results["phone"] = $row['phone'];
            $results["clientID"] = $row['id'];
            $results["level"] = $row['level'];
            $hash = $row['pwd'];
            $results["valid"] = "yes";
            //$checkAllpwd = password_verify($pwd, $row['pwd']);
        }
        
        if (password_verify($pwd, $hash))
            $checkAllpwd = TRUE;
        
        fwrite($file, "Verification de l'ancien mot de passe =".$checkAllpwd. PHP_EOL);
        if ($checkAllpwd) {
            $_SESSION["username"] = $results["name"];
            $_SESSION["userid"] = $results["clientID"];
            $_SESSION["Data"]["username"] = $results["name"];
            $_SESSION["Data"]["userid"] = $results["clientID"];
            $_SESSION["Data"]["firstname"] = $results["firstname"];
            $_SESSION["Data"]["email"] = $results["email"];
            $_SESSION["Data"]["phone"] = $results["phone"];
            $_SESSION["Data"]["level"] = $results["level"];
            //fwrite($file, "L'ancien mot de passe est confirmé.". PHP_EOL);
        }else{
            $results['valid'] = "no";
            $results['errCode'] = 2;
            //echo json_encode($results);
            fwrite($file, "L'ancien mot de passe est erroné.". PHP_EOL);
        }
    }else{
        ob_start();
         var_dump($results);
         $result = ob_get_clean();
         fwrite($file, "results = ".$result. PHP_EOL);
        
        echo json_encode($results);
        fwrite($file, "Le login ou le mot de passe est incorrect". PHP_EOL);
    }
    
    echo json_encode($results);
    /*ob_start();
    var_dump($results);
     $result = ob_get_clean();    
    fwrite($file, "results = ".$result. PHP_EOL);*/
    
    fwrite($file, "Fin de la recupération des données". PHP_EOL);
}else{
    $_SESSION["error"] = "yes";
    fwrite($file, "Erreur dans le traitement du formulaire". PHP_EOL);
    exit();
}

?>