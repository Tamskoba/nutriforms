<?php
session_start();
include_once "../serverlogin.php";

if(isset($_POST))
{
    try {
        
        $file = fopen("../../logs/traces.txt", "a+");
        fwrite($file, PHP_EOL.$Now->format('Y-m-d H:i:s')." ---> submitForm.php". PHP_EOL);
        
        $connexion = new PDO("mysql:host=$serveur;dbname=$db",$login,$pwd);
        $connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        
        /*$requete = $connexion->prepare("INSERT INTO candidose_digestive(clientID,q1,q2,q3,q4,q5)
         VALUES (:id,:q1,:q2,:q3,:q4,:q5)");*/
        
        /*ob_start();
         var_dump($_POST);
         $result = ob_get_clean();
         
         fwrite($file, "POST = ".$result. PHP_EOL);*/ 
        
        /* ------------------------ update candidose table --------------------------------- */
        $text = "UPDATE candidose_digestive SET";
        $text2 = $text;
        
        $nb = 37;
        for ($i = 1; $i <= $nb; $i++) {
            $text .= " q".$i."=:q".$i;
            if($i==$nb)
                $text .=" ";
            else
                $text .=", ";
        }
        
        $text .= "WHERE clientID =:id";       
        //fwrite($file, $text . PHP_EOL);
        
         $requete = $connexion->prepare($text);         
         
         $requete->bindParam(':id', $id);
         
         for ($i = 1; $i <= $nb; $i++) {
             $vardyn = "q$i";
             $requete->bindParam(":q$i", $$vardyn);
         }
         
         $id = $_POST["id"];
         
         for ($i = 1; $i <= $nb; $i++) {
             $vardyn = "q$i";
             $$vardyn = $_POST["q$i"];
             
             $text2 .= " q".$i."=".$$vardyn;
             if($i==$nb)
                 $text2 .=" WHERE clientID =$id";
                 else
                     $text2 .=", ";
         }
         fwrite($file, $text2 . PHP_EOL);
         
         $requete->execute();
         
         for ($i = 1; $i <= $nb; $i++) {
             $vardyn = "q$i";
             $_SESSION["q$i"] = $$vardyn;
         }
         
         /* ------------------- update hormonal table ----------------------- */
         $text = "UPDATE hormonal SET";
         $text2 = $text;
         
         $nb = 78;
         for ($i = 1; $i <= $nb; $i++) {
             $text .= " h".$i."=:h".$i;
             if($i==$nb)
                 $text .=" ";
                 else
                     $text .=", ";
         }
         
         $text .= "WHERE clientID =:id";
         //fwrite($file, $text . PHP_EOL);
         
         $requete = $connexion->prepare($text);
         
         $requete->bindParam(':id', $id);
         
         for ($i = 1; $i <= $nb; $i++) {
             $vardyn = "h$i";
             $requete->bindParam(":h$i", $$vardyn);
         }

         for ($i = 1; $i <= $nb; $i++) {
             $vardyn = "h$i";
             $$vardyn = $_POST["h$i"];
             
             $text2 .= " h".$i."=".$$vardyn;
             if($i==$nb)
                 $text2 .=" WHERE clientID =$id";
                 else
                     $text2 .=", ";
         }
         fwrite($file, $text2 . PHP_EOL);
         
         $requete->execute();
         
         /* ----------- update snc table ---------------------- */
         $text = "UPDATE snc SET";
         $text2 = $text;
         
         $nb = 30;
         for ($i = 1; $i <= $nb; $i++) {
             $text .= " s".$i."=:s".$i;
             if($i==$nb)
                 $text .=" ";
                 else
                     $text .=", ";
         }
         
         $text .= "WHERE clientID =:id";
         //fwrite($file, $text . PHP_EOL);
         
         $requete = $connexion->prepare($text);
         
         $requete->bindParam(':id', $id);
         
         for ($i = 1; $i <= $nb; $i++) {
             $vardyn = "s$i";
             $requete->bindParam(":s$i", $$vardyn);
         }
         
         for ($i = 1; $i <= $nb; $i++) {
             $vardyn = "s$i";
             $$vardyn = $_POST["s$i"];
             
             $text2 .= " s".$i."=".$$vardyn;
             if($i==$nb)
                 $text2 .=" WHERE clientID =$id";
                 else
                     $text2 .=", ";
         }
         fwrite($file, $text2 . PHP_EOL);
         
         $requete->execute();

         /* ----------- update potassium table ---------------------- */
         /* --------------------------------------------------------- */
         $text = "UPDATE potassium SET";
         $text2 = $text;
         
         $nb = 9;
         for ($i = 1; $i <= $nb; $i++) {
             $text .= " p".$i."=:p".$i;
             if($i==$nb)
                 $text .=" ";
                 else
                     $text .=", ";
         }
         
         $text .= "WHERE clientID =:id";
         //fwrite($file, $text . PHP_EOL);
         
         $requete = $connexion->prepare($text);
         
         $requete->bindParam(':id', $id);
         
         for ($i = 1; $i <= $nb; $i++) {
             $vardyn = "p$i";
             $requete->bindParam(":p$i", $$vardyn);
         }
         
         for ($i = 1; $i <= $nb; $i++) {
             $vardyn = "p$i";
             $$vardyn = $_POST["p$i"];
             
             $text2 .= " p".$i."=".$$vardyn;
             if($i==$nb)
                 $text2 .=" WHERE clientID =$id";
                 else
                     $text2 .=", ";
         }
         fwrite($file, $text2 . PHP_EOL);
         
         $requete->execute();

         /* ----------- update vitamine D table ---------------------- */
         /* --------------------------------------------------------- */
         $text = "UPDATE vitamine_d SET";
         $text2 = $text;
         
         $nb = 9;
         for ($i = 1; $i <= $nb; $i++) {
             $text .= " d".$i."=:d".$i;
             if($i==$nb)
                 $text .=" ";
                 else
                     $text .=", ";
         }
         
         $text .= "WHERE clientID =:id";
         //fwrite($file, $text . PHP_EOL);
         
         $requete = $connexion->prepare($text);
         
         $requete->bindParam(':id', $id);
         
         for ($i = 1; $i <= $nb; $i++) {
             $vardyn = "d$i";
             $requete->bindParam(":d$i", $$vardyn);
         }
         
         for ($i = 1; $i <= $nb; $i++) {
             $vardyn = "d$i";
             $$vardyn = $_POST["d$i"];
             
             $text2 .= " d".$i."=".$$vardyn;
             if($i==$nb)
                 $text2 .=" WHERE clientID =$id";
                 else
                     $text2 .=", ";
         }
         fwrite($file, $text2 . PHP_EOL);
         
         $requete->execute();

         /* ----------- update anxiété table ---------------------- */
         /* --------------------------------------------------------- */
         $text = "UPDATE anxiete SET";
         $text2 = $text;
         
         $nb = 14;
         for ($i = 1; $i <= $nb; $i++) {
             $text .= " a".$i."=:a".$i;
             if($i==$nb)
                 $text .=" ";
                 else
                     $text .=", ";
         }
         
         $text .= "WHERE clientID =:id";
         //fwrite($file, $text . PHP_EOL);
         
         $requete = $connexion->prepare($text);
         
         $requete->bindParam(':id', $id);
         
         for ($i = 1; $i <= $nb; $i++) {
             $vardyn = "a$i";
             $requete->bindParam(":a$i", $$vardyn);
         }
         
         for ($i = 1; $i <= $nb; $i++) {
             $vardyn = "a$i";
             $$vardyn = $_POST["a$i"];
             
             $text2 .= " a".$i."=".$$vardyn;
             if($i==$nb)
                 $text2 .=" WHERE clientID =$id";
                 else
                     $text2 .=", ";
         }
         fwrite($file, $text2 . PHP_EOL);
         
         $requete->execute();

         /* ----------- update gaba table ---------------------- */
         /* --------------------------------------------------------- */
         $text = "UPDATE gaba SET";
         $text2 = $text;
         
         $nb = 30;
         for ($i = 1; $i <= $nb; $i++) {
             $text .= " g".$i."=:g".$i;
             if($i==$nb)
                 $text .=" ";
                 else
                     $text .=", ";
         }
          
         $text .= "WHERE clientID =:id";
         //fwrite($file, $text . PHP_EOL);
         
         $requete = $connexion->prepare($text);
         
         $requete->bindParam(':id', $id);
         
         for ($i = 1; $i <= $nb; $i++) {
             $vardyn = "g$i";
             $requete->bindParam(":g$i", $$vardyn);
         }
         
         for ($i = 1; $i <= $nb; $i++) {
             $vardyn = "g$i";
             $$vardyn = $_POST["g$i"];
             
             $text2 .= " g".$i."=".$$vardyn;
             if($i==$nb)
                 $text2 .=" WHERE clientID =$id";
                 else
                     $text2 .=", ";
         }
         fwrite($file, $text2 . PHP_EOL);
         
         $requete->execute();
 
         /* ----------- update lgs table ---------------------- */
         /* --------------------------------------------------------- */
         $text = "UPDATE lgs SET";
         $text2 = $text;
         
         $nb = 26;
         for ($i = 1; $i <= $nb; $i++) {
             $text .= " l".$i."=:l".$i;
             if($i==$nb)
                 $text .=" ";
                 else
                     $text .=", ";
         }
         
         $text .= "WHERE clientID =:id";
         //fwrite($file, $text . PHP_EOL);
         
         $requete = $connexion->prepare($text);
         
         $requete->bindParam(':id', $id);
         
         for ($i = 1; $i <= $nb; $i++) {
             $vardyn = "l$i";
             $requete->bindParam(":l$i", $$vardyn);
         }
         
         for ($i = 1; $i <= $nb; $i++) {
             $vardyn = "l$i";
             $$vardyn = $_POST["l$i"];
             
             $text2 .= " l".$i."=".$$vardyn;
             if($i==$nb)
                 $text2 .=" WHERE clientID =$id";
                 else
                     $text2 .=", ";
         }
         fwrite($file, $text2 . PHP_EOL);
         
         $requete->execute();
         
         /* ----------- update spasmophile table ---------------------- */
         /* --------------------------------------------------------- */
         $text = "UPDATE spasmophile SET";
         $text2 = $text;
         
         $nb = 13;
         for ($i = 1; $i <= $nb; $i++) {
             $text .= " m".$i."=:m".$i;
             if($i==$nb)
                 $text .=" ";
                 else
                     $text .=", ";
         }
         
         $text .= "WHERE clientID =:id";
         //fwrite($file, $text . PHP_EOL);
         
         $requete = $connexion->prepare($text);
         
         $requete->bindParam(':id', $id);
         
         for ($i = 1; $i <= $nb; $i++) {
             $vardyn = "m$i";
             $requete->bindParam(":m$i", $$vardyn);
         }
         
         for ($i = 1; $i <= $nb; $i++) {
             $vardyn = "m$i";
             $$vardyn = $_POST["m$i"];
             
             $text2 .= " m".$i."=".$$vardyn;
             if($i==$nb)
                 $text2 .=" WHERE clientID =$id";
                 else
                     $text2 .=", ";
         }
         fwrite($file, $text2 . PHP_EOL);
         
         $requete->execute();

         /* ------------- update sommeil table ---------------------- */
         /* --------------------------------------------------------- */
         $text = "UPDATE sommeil SET";
         $text2 = $text;
         
         $nb = 10;
         for ($i = 1; $i <= $nb; $i++) {
             $text .= " o".$i."=:o".$i;
             if($i==$nb)
                 $text .=" ";
                 else
                     $text .=", ";
         }
         
         $text .= "WHERE clientID =:id";
         //fwrite($file, $text . PHP_EOL);
         
         $requete = $connexion->prepare($text);
         
         $requete->bindParam(':id', $id);
         
         for ($i = 1; $i <= $nb; $i++) {
             $vardyn = "o$i";
             $requete->bindParam(":o$i", $$vardyn);
         }
         
         for ($i = 1; $i <= $nb; $i++) {
             $vardyn = "o$i";
             $$vardyn = $_POST["so$i"];
             
             $text2 .= " o".$i."=".$$vardyn;
             if($i==$nb)
                 $text2 .=" WHERE clientID =$id";
                 else
                     $text2 .=", ";
         }
         fwrite($file, $text2 . PHP_EOL);
         
         $requete->execute();

         /* ------------- update detox table ---------------------- */
         /* --------------------------------------------------------- */
         $text = "UPDATE detox SET";
         $text2 = $text;
         
         $nb = 83;
         for ($i = 1; $i <= $nb; $i++) {
             $text .= " x".$i."=:x".$i;
             if($i==$nb)
                 $text .=" ";
                 else
                     $text .=", ";
         }
         
         $text .= "WHERE clientID =:id";
         //fwrite($file, $text . PHP_EOL);
         
         $requete = $connexion->prepare($text);
         
         $requete->bindParam(':id', $id);
         
         for ($i = 1; $i <= $nb; $i++) {
             $vardyn = "x$i";
             $requete->bindParam(":x$i", $$vardyn);
         }
         
         for ($i = 1; $i <= $nb; $i++) {
             $vardyn = "x$i";
             $$vardyn = $_POST["x$i"];
             
             $text2 .= " x".$i."=".$$vardyn;
             if($i==$nb)
                 $text2 .=" WHERE clientID =$id";
                 else
                     $text2 .=", ";
         }
         fwrite($file, $text2 . PHP_EOL);
         
         $requete->execute();
         
         echo "Les modifications ont été enregistrée.";
         fwrite($file, "Les données ont été enregistrées". PHP_EOL);
         
    } catch (Exception $e) {
        echo "<br>Echec de la connexion : ". $e->getMessage()."<br>";
        fwrite($file, "Echec de la connexion : ". $e->getMessage(). PHP_EOL);
    }
}
?>