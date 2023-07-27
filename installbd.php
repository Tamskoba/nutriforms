<?php
error_reporting(E_ERROR);

if(isset($_POST))
{
	$username = "root";
	$servername = $_POST['host'];
	$password = "";
	$database = "form2";	
	
	try{
		$connexion = new PDO("mysql:host=$servername",$username,$password);
		echo "Connexion au serveur de base de données.<br>";
		
		$sql = "CREATE DATABASE $database";
		$requete = $connexion->prepare($sql);
		
		$requete->execute();
		echo "La base de données a été créée avec succès.<br>";
		
		// Utilisation de la base de données
		$connexion->query("use $database");
		echo "Selection de La base de données.<br>";
		
		$sql = "CREATE TABLE clients (
		  id int(10) UNSIGNED NOT NULL,
		  firstname varchar(50) DEFAULT NULL,
		  name varchar(50) DEFAULT NULL,
		  email varchar(50) DEFAULT NULL,
		  phone varchar(20) DEFAULT NULL,
		  login varchar(50) DEFAULT NULL,
		  pwd varchar(255) DEFAULT NULL,
		  level smallint(6) NOT NULL,
		  password_recovery_asked_date datetime DEFAULT NULL,
		  password_recovery_token varchar(50) DEFAULT NULL
		) ";
		
		$requete = $connexion->prepare($sql);
		
		$requete->execute();
		echo "La table clients a été créée avec succès.<br>";		
		
		
		$sql = "INSERT INTO clients (id, firstname, name, email, phone, login, pwd, level, password_recovery_asked_date, password_recovery_token) VALUES
(12, 'Jean', 'Dupont', 'dupont@gmail.com', '0612345678', NULL, '$2y$10$RUeBa033tqFWwrRqQOIg3.hrgOiuugFf6lN.34fL3m.kQiRWgHkoG', 4, NULL, NULL),
(14, 'Marie', 'Claire', 'claire@gmail.com', '0712345678', NULL, '$2y$10$RUeBa033tqFWwrRqQOIg3.hrgOiuugFf6lN.34fL3m.kQiRWgHkoG', 3, NULL, NULL)";

		$requete = $connexion->prepare($sql);
		
		$requete->execute();
		echo "La table clients a été mise à jour avec succès.<br>";
		
		$sql = "CREATE TABLE candidose_digestive (
		  clientID int(11) NOT NULL,
		  q1 int(11) NOT NULL,
		  q2 int(11) NOT NULL,
		  q3 int(11) NOT NULL,
		  q4 int(11) NOT NULL,
		  q5 int(11) NOT NULL,
		  q6 int(11) NOT NULL,
		  q7 int(11) NOT NULL,
		  q8 int(11) NOT NULL,
		  q9 int(11) NOT NULL,
		  q10 int(11) NOT NULL,
		  q11 int(11) NOT NULL,
		  q12 int(11) NOT NULL,
		  q13 int(11) NOT NULL,
		  q14 int(11) NOT NULL,
		  q15 int(11) NOT NULL,
		  q16 int(11) NOT NULL,
		  q17 int(11) NOT NULL,
		  q18 int(11) NOT NULL,
		  q19 int(11) NOT NULL,
		  q20 int(11) NOT NULL,
		  q21 int(11) NOT NULL,
		  q22 int(11) NOT NULL,
		  q23 int(11) NOT NULL,
		  q24 int(11) NOT NULL,
		  q25 int(11) NOT NULL,
		  q26 int(11) NOT NULL,
		  q27 int(11) NOT NULL,
		  q28 int(11) NOT NULL,
		  q29 int(11) NOT NULL,
		  q30 int(11) NOT NULL,
		  q31 int(11) NOT NULL,
		  q32 int(11) NOT NULL,
		  q33 int(11) NOT NULL,
		  q34 int(11) NOT NULL,
		  q35 int(11) NOT NULL,
		  q36 int(11) NOT NULL,
		  q37 int(11) NOT NULL
		)";
		
		$requete = $connexion->prepare($sql);
		
		$requete->execute();
		echo "La table candidose digestive a été créée avec succès.<br>";

		$sql = "INSERT INTO candidose_digestive (clientID, q1, q2, q3, q4, q5, q6, q7, q8, q9, q10, q11, q12, q13, q14, q15, q16, q17, q18, q19, q20, q21, q22, q23, q24, q25, q26, q27, q28, q29, q30, q31, q32, q33, q34, q35, q36, q37) VALUES
		(12, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
		(14, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0)";

		$requete = $connexion->prepare($sql);
		
		$requete->execute();
		echo "La table candidose digestive a été mise à jour avec avec succès.<br>";
		
		$sql= "CREATE TABLE hormonal (
		  clientID int(11) NOT NULL,
		  h1 int(11) NOT NULL,
		  h2 int(11) NOT NULL,
		  h3 int(11) NOT NULL,
		  h4 int(11) NOT NULL,
		  h5 int(11) NOT NULL,
		  h6 int(11) NOT NULL,
		  h7 int(11) NOT NULL,
		  h8 int(11) NOT NULL,
		  h9 int(11) NOT NULL,
		  h10 int(11) NOT NULL,
		  h11 int(11) NOT NULL,
		  h12 int(11) NOT NULL,
		  h13 int(11) NOT NULL,
		  h14 int(11) NOT NULL,
		  h15 int(11) NOT NULL,
		  h16 int(11) NOT NULL,
		  h17 int(11) NOT NULL,
		  h18 int(11) NOT NULL,
		  h19 int(11) NOT NULL,
		  h20 int(11) NOT NULL,
		  h21 int(11) NOT NULL,
		  h22 int(11) NOT NULL,
		  h23 int(11) NOT NULL,
		  h24 int(11) NOT NULL,
		  h25 int(11) NOT NULL,
		  h26 int(11) NOT NULL,
		  h27 int(11) NOT NULL,
		  h28 int(11) NOT NULL,
		  h29 int(11) NOT NULL,
		  h30 int(11) NOT NULL,
		  h31 int(11) NOT NULL,
		  h32 int(11) NOT NULL,
		  h33 int(11) NOT NULL,
		  h34 int(11) NOT NULL,
		  h35 int(11) NOT NULL,
		  h36 int(11) NOT NULL,
		  h37 int(11) NOT NULL,
		  h38 int(11) NOT NULL,
		  h39 int(11) NOT NULL,
		  h40 int(11) NOT NULL,
		  h41 int(11) NOT NULL,
		  h42 int(11) NOT NULL,
		  h43 int(11) NOT NULL,
		  h44 int(11) NOT NULL,
		  h45 int(11) NOT NULL,
		  h46 int(11) NOT NULL,
		  h47 int(11) NOT NULL,
		  h48 int(11) NOT NULL,
		  h49 int(11) NOT NULL,
		  h50 int(11) NOT NULL,
		  h51 int(11) NOT NULL,
		  h52 int(11) NOT NULL,
		  h53 int(11) NOT NULL,
		  h54 int(11) NOT NULL,
		  h55 int(11) NOT NULL,
		  h56 int(11) NOT NULL,
		  h57 int(11) NOT NULL,
		  h58 int(11) NOT NULL,
		  h59 int(11) NOT NULL,
		  h60 int(11) NOT NULL,
		  h61 int(11) NOT NULL,
		  h62 int(11) NOT NULL,
		  h63 int(11) NOT NULL,
		  h64 int(11) NOT NULL,
		  h65 int(11) NOT NULL,
		  h66 int(11) NOT NULL,
		  h67 int(11) NOT NULL,
		  h68 int(11) NOT NULL,
		  h69 int(11) NOT NULL,
		  h70 int(11) NOT NULL,
		  h71 int(11) NOT NULL,
		  h72 int(11) NOT NULL,
		  h73 int(11) NOT NULL,
		  h74 int(11) NOT NULL,
		  h75 int(11) NOT NULL,
		  h76 int(11) NOT NULL,
		  h77 int(11) NOT NULL,
		  h78 int(11) NOT NULL
		)";
		
		$requete = $connexion->prepare($sql);
		
		$requete->execute();
		echo "La table hormonal a été créée avec succès.<br>";

		$sql ="INSERT INTO hormonal (clientID, h1, h2, h3, h4, h5, h6, h7, h8, h9, h10, h11, h12, h13, h14, h15, h16, h17, h18, h19, h20, h21, h22, h23, h24, h25, h26, h27, h28, h29, h30, h31, h32, h33, h34, h35, h36, h37, h38, h39, h40, h41, h42, h43, h44, h45, h46, h47, h48, h49, h50, h51, h52, h53, h54, h55, h56, h57, h58, h59, h60, h61, h62, h63, h64, h65, h66, h67, h68, h69, h70, h71, h72, h73, h74, h75, h76, h77, h78) VALUES
		(12, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
		(14, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0)";
		
		$requete = $connexion->prepare($sql);
		
		$requete->execute();
		echo "La table hormonal a été mise à jour avec succès.<br>";				
		
    } catch (Exception $e) {
        echo "<br>Echec de la connexion : ". $e->getMessage()."<br>";
    }

	
	
	// Connexion au serveur MySQL
	/*$conn = new mysqli($servername, $username, $password);

	// Vérification de la connexion
	if ($conn->connect_error) {
		die("Échec de la connexion : " . $conn->connect_error);
	}

	// Création de la base de données
	$sql = "CREATE DATABASE nom_de_la_base_de_donnees";
	if ($conn->query($sql) === TRUE) {
		echo "La base de données a été créée avec succès.\n";
	} else {
		echo "Erreur lors de la création de la base de données : " . $conn->error . "\n";
	}

	// Utilisation de la base de données
	$conn->select_db("nom_de_la_base_de_donnees");

	// Création de la première table
	$sql = "CREATE TABLE table1 (
		id INT(11) AUTO_INCREMENT PRIMARY KEY,
		nom VARCHAR(50) NOT NULL,
		age INT(3) NOT NULL
	)";
	if ($conn->query($sql) === TRUE) {
		echo "La première table a été créée avec succès.\n";
	} else {
		echo "Erreur lors de la création de la première table : " . $conn->error . "\n";
	}

	// Création de la deuxième table
	$sql = "CREATE TABLE table2 (
		id INT(11) AUTO_INCREMENT PRIMARY KEY,
		email VARCHAR(100) NOT NULL,
		adresse VARCHAR(255) NOT NULL
	)";
	if ($conn->query($sql) === TRUE) {
		echo "La deuxième table a été créée avec succès.\n";
	} else {
		echo "Erreur lors de la création de la deuxième table : " . $conn->error . "\n";
	}

	// Création de la troisième table
	$sql = "CREATE TABLE table3 (
		id INT(11) AUTO_INCREMENT PRIMARY KEY,
		titre VARCHAR(100) NOT NULL,
		contenu TEXT
	)";
	if ($conn->query($sql) === TRUE) {
		echo "La troisième table a été créée avec succès.\n";
	} else {
		echo "Erreur lors de la création de la troisième table : " . $conn->error . "\n";
	}

	// Fermeture de la connexion
	$conn->close();
	*/
}
?>
