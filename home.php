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
            
            $('#menu').click(function(){
            	$('#menulist').toggle();
            });
            
            displayZones(1);
            
/*             JSONData = <?php echo json_encode($_SESSION["Data"]);?>;
            currentUserIdData = JSONData["userid"];
            
            var tab = "<table class='datas'>"; 
			for(var x in JSONData)
			{
				tab += "<tr><td>"+x+"</td><td>"+JSONData[x]+"</td></tr>";
			} 
			tab +="</table>";
			$('#jsonDataClient').html(tab); */
                                
          }); 
  		</script>   		
	</head>
    <body>
		<nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
		<div class="container-fluid">
			<span class="navbar-brand">Votre espace personnel</span>

			<div class="collapse navbar-collapse" id="navbarColor01">
				<ul class="navbar-nav me-auto">

				</ul>
				<form class="d-flex">
					<?php echo $_SESSION["Data"]["firstname"]." ".$_SESSION["username"]; ?>&nbsp;&nbsp;  				
					<a href="include\deconnexion.php">Deconnexion</a> 
				</form>
			</div>
		</div>
		</nav>


    	<div class="row">
              <div id="zoneloader" class="col-12 loader">
    			 Chargement en cours...             	
              </div>
    	</div>    	    	
    	<div class="row">
<!--     	<div id="menulist" class="col-12 menuitems">
              <div class="menuitem" id="tb">Tableau de bord</div>
              <div class="menuitem" id="mc">Mon compte</div>
              <div class="menuitem" id="lf">Les formulaires</div>              
    		</div>
    		<div class="col-2 menuicon2">
    			<div class="menuicon">
    				<img id="menu" alt="icone" src="\img\menu.png"  
					 class="iconeimg">
    			</div>
    		</div>  -->   

 			<ul class="nav nav-tabs" role="tablist">
				<li class="nav-item" role="presentation">
					<span class="nav-link active" data-bs-toggle="tab" aria-selected="true" role="button" id="tb">Tableau de bord</span>
				</li>
				<li class="nav-item" role="presentation">
					<span class="nav-link " data-bs-toggle="tab"  aria-selected="false" tabindex="-1" role="button" id="mc">Mon compte</span>
				</li>
				<li class="nav-item" role="presentation">
					<span class="nav-link" data-bs-toggle="tab" aria-selected="false" tabindex="-1" role="button" id="lf">Les formulaires</span>
				</li>
			</ul>
			<div id="myTabContent" class="tab-content">
				<div class="tab-pane fade show active" id="zoneTab" role="tabpanel">
					<p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.</p>
				</div>
				<div class="tab-pane fade" id="zoneAcc" role="tabpanel">
					<p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit.</p>
				</div>
				<div class="tab-pane fade" id="zoneFor" role="tabpanel">
					<p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork.</p>
				</div>
			</div>				
    	</div>

    	<div class="row">
              <div id="jsonData" class="col-1 datas" style="display:none">
    			 <h3 class="datas">Datas</h3>
    			 <div id="accDatas" class="datas">
        			 <h4>Client</h4>
        			 <div id="jsonDataClient" name="Datas"></div>
        			 <h4>Utilisateurs</h4>
        			 <div id="jsonDataUsers" name="Datas"></div>        			 
    			 </div>
    			 <div id="lesFormsDatas" class="datas">
        			 <h4>Candidose</h4>     			 
        			 <div id="jsonDataCandidose" name="quest"></div>    			 
        			 <h4>Hormonal</h4>     			 
        			 <div id="jsonDataHormonal" name="quest"></div>
        			 <h4>SNC</h4>     			 
        			 <div id="jsonDataSNC" name="quest"></div> 
        			 <h4>Potassium</h4>     			 
        			 <div id="jsonDataPOT" name="quest"></div>
        			 <h4>Vitamine D</h4>     			 
        			 <div id="jsonDataVITD" name="quest"></div>
        			 <h4>Anxiété</h4>     			 
        			 <div id="jsonDataANX" name="quest"></div>
        			 <h4>GABA</h4>     			 
        			 <div id="jsonDataGB" name="quest"></div>       
        			 <h4>LGS</h4>     			 
        			 <div id="jsonDataLGS" name="quest"></div>
        			 <h4>Spasmosphile</h4>     			 
        			 <div id="jsonDataSPA" name="quest"></div>
        			 <h4>Sommeil</h4>     			 
        			 <div id="jsonDataSOM" name="quest"></div>
        			 <h4>Detox</h4>     			 
        			 <div id="jsonDataDTX" name="quest"></div>
        			 <h4>Général</h4>     			 
        			 <div id="jsonDataGRL" name="quest"></div>        			         			         			         			             			   			         			       			 
    			 </div>			     			      			    			          	
              </div>    	                           
    	</div>
    </body>
</html>