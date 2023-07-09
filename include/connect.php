<?php
    session_start();
?>

<html>
	<head>
		<title>Connexion</title>
		<script src="lib\global.js"></script>		
    	<script src="lib\jquery-3.6.3.js"></script>
    	<link href='css\style4.css' rel='stylesheet' type='text/css'/> 
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">  		
	</head>
    <body>
    	<div class="header">
        	<h1>Connexion</h1>
    	</div>
    	<div class="row">
    		<div class="col-12 divAlign" id="connectDiv">
            	<div id="formholder" class="centralholder">
        			<table>
        				<tr>
        					<td><label>Login</label></td>
        					<td><input type="text" id="login"></td>
        				</tr>
        				<tr>
        					<td><label>Mot de passe</label></td>
        					<td><input type="text" id="pwd"></td>
        				</tr>
        				<tr>
        					<td colspan="2">
        						<div id="submit" class="connectbtn">Se connecter</div>
        					</td>
        				</tr>
        				<tr>
        					<td colspan="2"><div id="forgot" class="forgotten">Mot de passe oublié ?</div></td>
        				</tr>
        				<tr>
        					<td colspan="2">
        						<div id="loader" style="display:none">Connexion en cours...</div>
        					</td>
        				</tr>
        				<tr>
        					<td colspan="2">
			                    <div id="output" class="outputtext"></div>  	
        					</td>
        				</tr>        				        				        				        				     				
        			</table>                                                                                        
            	</div>
        	</div>
        	
    		<div class="col-12 divAlign" id="forgotDiv" style="display: none">
            	<div id="forgotholder" class="centralholder">
        			<table>
        				<tr>
        					<th colspan='2'>
        						Taper votre email avez lequel vous êtes inscrit pour recevoir un nouveau mot de passe
        					</th>
        				</tr>
        				<tr>
        					<td><label>Email</label></td>
        					<td><input type="text" id="ml"></td>
        				</tr>
        				<tr>
        					<td colspan="2">
        						<div id="fsubmit" class="connectbtn">Recevoir un mot de passe</div>
        					</td>
        				</tr>
        				<tr>
        					<td colspan="2">
        						<div id="floader" style="display:none">Envoi en cours...</div>
        					</td>
        				</tr>    				        				     				
        			</table>                                      
                    <div id="foutput"></div>  	
            	</div>
        	</div>        	
    	</div>
    	
    	<script>
            $(document).ready(function(){
             $("#forgotDiv").hide();
            
            
             //$('#submit').delay(3000).show(0);
             $('#forgot').click(function(){
             	$("#forgotDiv").show();
                $("#connectDiv").hide();            	
             });
             
             function displayErrorMsg(idx){
             	$("#output").html(errorMessages[idx]);
             	$("#output").show();
             }
             
             function enableForm(){
				$("#submit").removeClass().addClass("connectbtn");
          		$("#forgot").show();     					
				$('#login').prop("disabled", false);
          		$('#pwd').prop("disabled", false);                 
             }
             
             function disableForm(){
                  $("#submit").removeClass().addClass("disableConnectBtn");  
                  $("#forgot").hide();                          
                  $('#login').prop("disabled", true);
                  $('#pwd').prop("disabled", true);                           
             }
             
             $('#submit').click(function(){                        
              var lg = $('#login').val();
              var pw = $('#pwd').val();
			  disableForm();
              $("#loader").show();
              $("#output").hide();
                           
              if(lg != '' && pw != '')
              {
               $.ajax({
                url:"include/login.php",
                type:"POST",
                data:{
                	lg:lg,
                	pw:pw                	
                },
                beforeSend:function(){
                  $("#loader").show();
                  $("#output").hide();
                },
                success:function(data)
                {
					enableForm();               
                    //alert("data " + data);
                    
                    try {
                        var client = JSON.parse(data);
                    } catch(e) {
						//client['valid'] = data['valid'];
                    }
                    //alert("client " + client);
                    

                    if((typeof(client)!="undefined") && (client['valid'] == 'yes'))
                    	window.location = "home.php";
                    else{
                    	$("#loader").hide();
               			displayErrorMsg(1);                   
                    }									
                }
               })
              }
              else
              {
               	displayErrorMsg(0);
				enableForm();
				$("#loader").hide();
              }
             });
             
             $('#fsubmit').click(function(){
                  $(this).removeClass().addClass("disableConnectBtn");             
                  var ml = $('#ml').val();
                  $('#ml').prop("disabled", true); 
                  
                  if(ml != '')
                  {
                       $.ajax({
                        url:"include/newpwd.php",
                        type:"POST",
                        data:{
                        	ml:ml                	
                        },
                        beforeSend:function(){
                          $("#floader").show();
                          $("#foutput").hide();
                        },
                        success:function(data)
                        {
        
        					$(this).removeClass().addClass("connectbtn");
                      		$('#ml').prop("disabled", false);     
                            $("#floader").hide();
                            $("#foutput").show();
                            alert(data);
                            var client = JSON.parse(data);								
                        }
                       })
                  }
                  else
                  {
                   	   alert("inserer votre email de connexion");
                  }                   
              });             
            });
        </script>
    </body>
</html>