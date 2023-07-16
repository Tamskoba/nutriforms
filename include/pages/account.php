<?php
session_start();

?>
<div class="row">

    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item" role="presentation">
            <span class="nav-link active" data-bs-toggle="tab" aria-selected="true" role="button" id="co">
                <i class="fas fa-user"></i>
                Coordonnées
            </span>
        </li>
        <li class="nav-item" role="presentation">
            <span class="nav-link " data-bs-toggle="tab"  aria-selected="false" tabindex="-1" role="button" id="pw">
                <i class="fa-solid fa-key"></i>
                Mot de passe
            </span>
        </li>
        <li class="nav-item" role="presentation">
            <span class="nav-link" data-bs-toggle="tab" aria-selected="false" tabindex="-1" role="button" id="cl">
                <i class="fa-solid fa-users"></i>
                Utilisateurs
            </span>
        </li>
    </ul>
    <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade show px-2 active" id="mydata" role="tabpanel">
            <div id="accForm">
    			<table>
    				<tr>
    					<td><label>Prénom</label></td>
    					<td><input type="text" id="firstname"></td>
    				</tr>
    				<tr>
    					<td><label>Nom</label></td>
    					<td><input type="text" id="name"></td>
    				</tr>
    				<tr>
    					<td><label>Email</label></td>
    					<td><input type="text" id="email"></td>
    				</tr>
    				<tr>
    					<td><label>Téléphone</label></td>
    					<td><input type="text" id="phone"></td>
    				</tr>  
    				<tr>
    					<td colspan="2" class="float-end">
                            <button id="mysubmit" type="button" class="btn btn-primary">Modifier</button>
                        </td>
    				</tr>                        				    				    				   				    				
    			</table>                                   
                <div id="myloader" style="display:none">Sauvegarde en cours...</div>                  
                <div id="myoutput"></div>  	
        	</div>
        </div>
        <div class="tab-pane fade px-2" id="mypwd" role="tabpanel">
            <div id="pwdForm">
    			<table>
    				<tr>
    					<td><label>Ancien mot de passe</label></td>
    					<td><input type="password" id="apwd"></td>
    				</tr>
    				<tr>
    					<td><label>Nouveau mot de passe</label></td>
    					<td><input type="password" id="npwd"></td>
    				</tr>
    				<tr>
    					<td><label>Confirmer le nouveau mot de passe</label></td>
    					<td><input type="password" id="cpwd"></td>
    				</tr>
                    <tr>
    					<td colspan="2" class="float-end">
                            <button id="pwsubmit" type="button" class="btn btn-secondary disabled">Modifier</button>
                        </td>
    				</tr>    				    				    				   				    				
    			</table>                                   
                <div id="pwloader" style="display:none">Sauvegarde en cours...</div>                  
                <div id="pwoutput"></div>          	
        	</div>
        </div>
        <div class="tab-pane fade px-2" id="myusers" role="tabpanel">
            <div id="usersForm">
        	</div>
        </div>
    </div>	


<!--     <div class="col-11 formheader">
    	<div class="menuitem2" id="co">Coordonnées</div>
    	<div class="menuitem2" id="pw">Mot de passe</div>
    	<?php 
    	if($_SESSION["Data"]["level"]<=1)
    	    echo "<div class='menuitem2' id='cl'>Clients</div>"; 
    	?>   	    	   	
    </div> -->
</div>
<!-- <div id="mydata">
    <div class="row">
    	<div class="col-11">
        	<div id="accForm">
    			<table>
    				<tr>
    					<td><label>Prénom</label></td>
    					<td><input type="text" id="firstname"></td>
    				</tr>
    				<tr>
    					<td><label>Nom</label></td>
    					<td><input type="text" id="name"></td>
    				</tr>
    				<tr>
    					<td><label>Email</label></td>
    					<td><input type="text" id="email"></td>
    				</tr>
    				<tr>
    					<td><label>Téléphone</label></td>
    					<td><input type="text" id="phone"></td>
    				</tr>    				    				    				   				    				
    			</table>                                   
                <div id="mysubmit" class="connectbtn">Modifier</div>
                <div id="myloader" style="display:none">Sauvegarde en cours...</div>                  
                <div id="myoutput"></div>  	
        	</div>   		
    	</div>
    </div>
</div>
<div id="mypwd">
    <div class="row">
    	<div class="col-11">
        	<div id="pwdForm">
    			<table>
    				<tr>
    					<td><label>Ancien mot de passe</label></td>
    					<td><input type="password" id="apwd"></td>
    				</tr>
    				<tr>
    					<td><label>Nouveau mot de passe</label></td>
    					<td><input type="password" id="npwd"></td>
    				</tr>
    				<tr>
    					<td><label>Confirmer le nouveau mot de passe</label></td>
    					<td><input type="password" id="cpwd"></td>
    				</tr>   				    				    				   				    				
    			</table>                                   
                <div id="pwsubmit" class="connectbtn">Modifier</div>
                <div id="pwloader" style="display:none">Sauvegarde en cours...</div>                  
                <div id="pwoutput"></div>          	
        	</div>
        </div>
    </div>    	
</div>
<div id="myusers">
    <div class="row">
    	<div class="col-11">
        	<div id="usersForm" >
        	</div>
        </div>
    </div>
</div>     -->    	
<script>
	$(document).ready(function(){
		var JSONData = <?php echo json_encode($_SESSION["Data"]);?>; 
		
		var errMsg = ["inserer vos identifiants!!",
					   "Le nouveau mot de passe n'est pas identique!",
					   "L'ancien mot de passe n'est pas correct!"
				     ];
		
		$('#firstname').val(JSONData['firstname']);
		$('#name').val(JSONData['username']);
		$('#email').val(JSONData['email']);
		$('#phone').val(JSONData['phone']);		
		
		function displayAccDiv(val){
        	switch(val){
        		case 1:
        			$('#mydata').show();
        			$('#mypwd').hide();
        			$('#myusers').hide();
        			$('#co').addClass("active");
        			$('#pw').removeClass("active");
        			$('#cl').removeClass("active");
                    $('#mydata').addClass("show active");
                    $('#mypwd').removeClass("show active");
                    $('#myusers').removeClass("show active");	        			
        			break;
        		case 2:
        			$('#mydata').hide();
        			$('#mypwd').show();
        			$('#myusers').hide();
        			$('#co').removeClass("active");
        			$('#pw').addClass("active");
        			$('#cl').removeClass("active");
                    $('#mydata').removeClass("show active");
                    $('#mypwd').addClass("show active");
                    $('#myusers').removeClass("show active");	                    	          			
        			break;
        		case 3:
        			$('#mydata').hide();
        			$('#mypwd').hide();
        			$('#myusers').show();
        			$('#co').removeClass("active");
        			$('#pw').removeClass("active");
        			$('#cl').addClass("active");
                    $('#mydata').removeClass("show active");
                    $('#mypwd').removeClass("show active");
                    $('#myusers').addClass("show active");	                    	        			
        			break;            			
        	}
        }
        
        displayAccDiv(1);
        
      	var usersLoaded = 0;
      	
        $('#co').click(function(){
        	displayAccDiv(1);
        });
        
        $('#pw').click(function(){
        	displayAccDiv(2);
        });
        
        $('#cl').click(function(){
        	
        	displayAccDiv(3);
        	if(usersLoaded == 0){
        		$("#zoneloader").show();
        		$('#usersForm').load("/include/pages/users.php", function(){
        			$.ajax({
                        url:"include/pages/initUsers.php",
                        type:"POST",
                        data:{},
                        beforeSend:function(){
			                $("#zoneloader").show();    
                        },
                        success:function(data)
                        {
                            JSONUsers = JSON.parse(data);
                            updateUsersDiv(JSONUsers);	
                            updateUsersDataPanel(JSONUsers);	
                            $("#zoneloader").hide();  							
                        }
                    })        			
         		
            	});
        		usersLoaded = 1;
        	}
        });
        
         $('#mysubmit').click(function(){
          $(this).removeClass().addClass("disableConnectBtn");             
          var fn = $('#firstname').val();
          var nm = $('#name').val();
          var ml = $('#email').val();
          var ph = $('#phone').val();
                    
          $('#firstname').prop("disabled", true);
          $('#name').prop("disabled", true);
          $('#email').prop("disabled", true);
          $('#phone').prop("disabled", true);          
                          
          if(fn != '' && nm != '' && ml != '' && ph != '')
          {
           $.ajax({
            url:"include/pages/submitAccount.php",
            type:"POST",
            data:{
            	fn:fn,
            	nm:nm,
            	ml:ml,
            	ph:ph            	           	                	
            },
            beforeSend:function(){
              $("#myloader").show();
              $("#myoutput").hide();
            },
            success:function(data)
            {
    			$('#mysubmit').removeClass().addClass("connectbtn");
                $('#firstname').prop("disabled", false);
                $('#name').prop("disabled", false);
                $('#email').prop("disabled", false);
                $('#phone').prop("disabled", false);   
                $("#myloader").hide();
                $('#myoutput').html("Les modifications ont été enregistrées.")
                $("#myoutput").show();
                var client = JSON.parse(data);	
                updateClientDataPanel(client);								
            }
           })
          }
          else
          {
                $('#myoutput').html(errMsg[0]);
                $("#myoutput").show();				
          }
         });
         
         
         
         $('#pwsubmit').click(function(){
          $(this).removeClass().addClass("disableConnectBtn");             
          var apwd = $('#apwd').val();
          var npwd = $('#npwd').val();
          var cpwd = $('#cpwd').val();
                    
          $('#apwd').prop("disabled", true);
          $('#npwd').prop("disabled", true);
          $('#cpwd').prop("disabled", true);        
                          
          if(apwd != '' && npwd != '' && cpwd != '')
          {
          	   if(npwd == cpwd)
          	   {
                   $.ajax({
                        url:"include/pages/submitPWD.php",
                        type:"POST",
                        data:{
                        	ap:apwd,
                        	np:npwd,
                        	cp:cpwd           	           	                	
                        },
                        beforeSend:function(){
                          $("#pwloader").show();
                          $("#pwoutput").hide();
                        },
                        success:function(data)
                        {
                			$('#pwsubmit').removeClass().addClass("connectbtn");
                            $('#apwd').prop("disabled", false);
                            $('#npwd').prop("disabled", false);
                            $('#cpwd').prop("disabled", false);
                            
                            $('#apwd').val('');
                            $('#npwd').val('');
                            $('#cpwd').val('');                            
                            
                            var msg = JSON.parse(data);	
                            if(msg['err']==0){
                                $('#pwoutput').html("Les modifications ont été enregistrées.")
                            }else{
                    			$('#pwoutput').html(errMsg[2]);                            
                            }
                            $("#pwloader").hide();
                            $("#pwoutput").show();	
					
                        }
                    });           	   
          	   }
          	   else
          	   {
                    $('#pwoutput').html(errMsg[1]);
                    $("#pwoutput").show();	          	   		
          	   		$('#pwsubmit').removeClass().addClass("connectbtn");
  	   		        $("#pwloader").hide();
                    $('#apwd').prop("disabled", false);
                    $('#npwd').prop("disabled", false);
                    $('#cpwd').prop("disabled", false);  	   		        
          	   }
              }
              else
              {
                    $('#pwoutput').html(errMsg[0]);
                    $("#pwoutput").show();	               		
          	   		$('#pwsubmit').removeClass().addClass("connectbtn");
  	   		        $("#pwloader").hide();
                    $('#apwd').prop("disabled", false);
                    $('#npwd').prop("disabled", false);
                    $('#cpwd').prop("disabled", false);  	   		        
              }
         });         

        function updateClientDataPanel(JSONData){           
            var tab = "<table class='datas'>"; 
			for(var x in JSONData)
			{
				tab += "<tr><td>"+x+"</td><td>"+JSONData[x]+"</td></tr>";
			} 
			tab +="</table>";
			$('#jsonDataClient').html(tab);        
        
        }   
        	        	
	});        
</script>    	