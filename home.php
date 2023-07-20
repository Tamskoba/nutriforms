<?php
    session_start();
    
    if((isset($_SESSION["error"]) && ($_SESSION["error"]=="yes"))||(!isset($_SESSION["username"]))){
        header("Location:index.php");
    }
?>
<html>
	<head>
		<title>Page d'accueil</title>
		<script src="lib\global.js"></script>
    	<script src="lib\jquery-3.6.3.js"></script>
    	<link href='css\style4.css' rel='stylesheet' type='text/css'/> 
    	<link href='css\bootstrap.min.css' rel='stylesheet' type='text/css'/> 		
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="https://kit.fontawesome.com/3c6b498a1b.js" crossorigin="anonymous"></script>
    	<script>
          $(document).ready(function(){
          
          $('#tb').click(function(){
            	displayZones(1);
            	if(dashboardLoaded==0){
            		$("#zoneloader").show();
            		$('#zoneTab').load("/include/pages/dashboard.php", function(){
            			$("#zoneloader").hide();           		
            		});
            		dashboardLoaded = 1;
            	}
            });
            
            $('#mc').click(function(){
            	displayZones(2);
            	if(accountLoaded == 0){
            		$("#zoneloader").show();
            		$('#zoneAcc').load("/include/pages/account.php", function(){
            			$("#zoneloader").hide();           		
            		});
            		accountLoaded = 1;
            	}
            });
            
            $('#lf').click(function(){
            	
            	displayZones(3);
            	if(formsLoaded == 0){
            		$("#zoneloader").show();
            		$('#zoneFor').load("/include/pages/forms.php", function(){
            			$("#zoneloader").hide();           		
            		});
            		formsLoaded = 1;
            	}
            });
            
            displayZones(1);

			JSONData = <?php echo json_encode($_SESSION["Data"]);?>;
            currentUserIdData = JSONData["userid"];
          }); 
  		</script>   		
	</head>
    <body>
		<nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
		<div class="container-fluid">
			<span class="navbar-brand fs-2">Votre espace personnel</span>

			<div class="collapse navbar-collapse" id="navbarColor01">
				<ul class="navbar-nav me-auto">
					<li>
						<button type="button" class="btn btn-primary" id="tb">
							<i class="fa-solid fa-table-columns"></i>
							Tableau de bord
						</button>
					</li>
					<li>
						<button type="button" class="btn btn-primary" id="mc">
							<i class="fa-solid fa-file-invoice"></i>
							Mon compte
						</button>
					</li>
					<li>
						<button type="button" class="btn btn-primary" id="lf">
							<i class="fa-solid fa-table-list"></i>
							Les formulaires
						</button>
					</li>

				</ul>
				<form class="d-flex mb-0">
					<i class="fas fa-user"></i>&nbsp;
					<?php echo $_SESSION["Data"]["firstname"]." ".$_SESSION["username"]; ?>&nbsp;&nbsp;&nbsp;&nbsp;
					<i class="fa-solid fa-person-walking-arrow-right text-light"></i>&nbsp;				
					<a class="nav-link text-light btn-danger" href="include\deconnexion.php">Deconnexion</a> 
				</form>
			</div>
		</div>
		</nav>
    	<div class="row">
              <div id="zoneloader" class="col-12 loader">
    			 Chargement en cours...             	
              </div>
    	</div>    	    	
    	<div class="row ">
			<div id="myTabContent" class="tab-content m-1">
				<div class="tab-pane fade show px-2 active" id="zoneTab" role="tabpanel">
					<p>Le tableau de bord</p>
				</div>
				<div class="tab-pane fade px-2" id="zoneAcc" role="tabpanel">
					<p>Le panneau de mon compte</p>
				</div>
				<div class="tab-pane fade px-2" id="zoneFor" role="tabpanel">
					<p>Les formulaires à completer</p>
				</div>
			</div>			
    	</div>
    </body>
</html>