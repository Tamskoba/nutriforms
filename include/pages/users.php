<?php
session_start();

?>
<div class="row">
    <div class="col-11 py-4">
		<h4 style="float:left;">Liste des utilisateurs</h4>&nbsp;&nbsp;
		<button id="aj" type="button" class="btn btn-primary">
			<i class="fa-solid fa-user-plus"></i>
			Ajouter
		</button>	    	   	
    </div>
</div>
<div class="row">
	<div id="users" class="col-11"></div>
</div>
<div class="row">
	<div id="user" class="col-11 modifuser pt-3">
		<table>
			<tr>
				<td><label>Prénom</label></td>
				<td><input type="text" id="ufirstname"></td>
			</tr>
			<tr>
				<td><label>Nom</label></td>
				<td><input type="text" id="uname"></td>
			</tr>
			<tr>
				<td><label>Email</label></td>
				<td><input type="text" id="uemail"></td>
			</tr>
			<tr>
				<td><label>Téléphone</label></td>
				<td><input type="text" id="uphone"></td>
			</tr>
			<?php
			     if($_SESSION["Data"]["level"]==0)
			     {
			         echo "<tr>";
    			     echo    "<td><label>Accès</label></td>";
    			     echo    "<td>";
        			 echo        "<select id='ulevel' name='level'>";
            		 echo	         "<option value='0'>Admin</option>";
            		 echo	         "<option value='1'>Expert</option>";
            		 echo	         "<option value='2'>Equipe</option>";
            		 echo	         "<option value='3'>Client</option>";
        			 echo        "</select>";
    			     echo    "</td>";
			         echo "</tr>"; 
			     }elseif($_SESSION["Data"]["level"]==4){
					echo "<tr>";
					echo    "<td><label>Accès</label></td>";
					echo    "<td>";
					echo        "<select id='ulevel' name='level'>";
					echo	         "<option value='3'>Client</option>";
					echo        "</select>";
					echo    "</td>";
					echo "</tr>"; 					
				 }


			?>
			<tr>
				<td colspan="2"><input type="hidden" id="userid"></td>
			</tr>
			<tr>
				<td class="float-end">
					<button id="ussubmit" type="button" class="btn btn-primary">
						<i class="fa-solid fa-user-pen"></i>
						Modifier
					</button>
				</td>
				<td class="float-end">
					<button id="usclose" type="button" class="btn btn-secondary">
						<i class="fa-solid fa-xmark"></i>
						Fermer
					</button>
				</td>
			</tr>  						    				    				    				   				    				
		</table>
        <div id="usloader" style="display:none">Sauvegarde en cours...</div>                  
        <div id="usoutput"></div>  	  	
	</div>
</div>
<div class="row">
	<div id="adduser" class="col-11 modifuser pt-3">
		<table>
			<tr>
				<td><label>Prénom</label></td>
				<td><input type="text" id="afirstname"></td>
			</tr>
			<tr>
				<td><label>Nom</label></td>
				<td><input type="text" id="aname"></td>
			</tr>
			<tr>
				<td><label>Email</label></td>
				<td><input type="text" id="aemail"></td>
			</tr>
			<tr>
				<td><label>Téléphone</label></td>
				<td><input type="text" id="aphone"></td>
			</tr>
			<?php 
			     if($_SESSION["Data"]["level"]==0)
			     {
			         echo "<tr>";
    			     echo    "<td><label>Accès</label></td>";
    			     echo    "<td>";
        			 echo        "<select id='alevel' name='level'>";
            		 echo	         "<option value='0'>Admin</option>";
            		 echo	         "<option value='1'>Expert</option>";
            		 echo	         "<option value='2'>Equipe</option>";
            		 echo	         "<option value='3'>Client</option>";
        			 echo        "</select>";
    			     echo    "</td>";
			         echo "</tr>"; 
			     }elseif($_SESSION["Data"]["level"]==1 || $_SESSION["Data"]["level"]==4){
			         echo "<tr>";
			         echo    "<td><label>Accès</label></td>";
			         echo    "<td>";
			         echo        "<select id='alevel' name='level'>";
			         echo	         "<option value='3'>Client</option>";
			         echo        "</select>";
			         echo    "</td>";
			         echo "</tr>"; 
			     }
			     
			?>
			<tr>
				<td class="float-end">
					<button id="asubmit" type="button" class="btn btn-primary">
						<i class="fa-solid fa-plus"></i>
						Ajouter
					</button>
				</td>
				<td class="float-end">
					<button id="aclose" type="button" class="btn btn-secondary">
						<i class="fa-solid fa-xmark"></i>
						Fermer
					</button>
				</td>				
			</tr> 					    				    				    				   				    				
		</table>
        <div id="aloader" style="display:none">Sauvegarde en cours...</div>                  
        <div id="aoutput"></div>  	  	
	</div>
</div>
<script>
$('#aj').click(function(){
	$("#adduser").show();
	$("#user").hide();	
});

$('#aclose').click(function(){
	$("#adduser").hide();
});

$('#usclose').click(function(){
	$("#user").hide();
});

$('#ussubmit').click(function(){
  $(this).removeClass().addClass("disableConnectBtn");             
  var fn = $('#ufirstname').val();
  var nm = $('#uname').val();
  var ml = $('#uemail').val();
  var ph = $('#uphone').val();
  var lv = $('#ulevel').val();
  var id = $('#userid').val();          

            
  $('#ufirstname').prop("disabled", true);
  $('#uname').prop("disabled", true);
  $('#uemail').prop("disabled", true);
  $('#uphone').prop("disabled", true);
  $('#ulevel').prop("disabled", true);                    
                  
  if(fn != '' && nm != '' && ml != '' && ph != '')
  {
   $.ajax({
    url:"include/pages/modifyUser.php",
    type:"POST",
    data:{
    	fn:fn,
    	nm:nm,
    	ml:ml,
    	ph:ph,
    	lv:lv,
    	id:id            	            	           	                	
    },
    beforeSend:function(){
      $("#usloader").show();
      $("#usoutput").hide();
    },
    success:function(data)
    {
		$('#ussubmit').removeClass().addClass("connectbtn");
        $('#ufirstname').prop("disabled", false);
        $('#uname').prop("disabled", false);
        $('#uemail').prop("disabled", false);
        $('#uphone').prop("disabled", false); 
          
        $("#usloader").hide();
        $('#usoutput').html(data);
        $("#usoutput").show();
        $('#usoutput').delay(5000).hide();
        $('#user').delay(6000).hide();

		refreshListUsers();							
    }
  });
 }
 else{
   alert("inserer vos identifiants!!");
 }
}); 

$('#asubmit').click(function(){
  $(this).removeClass().addClass("disableConnectBtn");             
  var fn = $('#afirstname').val();
  var nm = $('#aname').val();
  var ml = $('#aemail').val();
  var ph = $('#aphone').val();
  var lv = $('#alevel').val();   
       
  $('#afirstname').prop("disabled", true);
  $('#aname').prop("disabled", true);
  $('#aemail').prop("disabled", true);
  $('#aphone').prop("disabled", true);
  $('#alevel').prop("disabled", true);                    
                  
  if(fn != '' && nm != '' && ml != '' && ph != '')
  {
   $.ajax({
    url:"include/pages/addUser.php",
    type:"POST",
    data:{
    	fn:fn,
    	nm:nm,
    	ml:ml,
    	ph:ph,
    	lv:lv         	            	           	                	
    },
    beforeSend:function(){
      $("#aloader").show();
      $("#aoutput").hide();
    },
    success:function(data)
    {
		$('#asubmit').removeClass().addClass("connectbtn");
        $('#afirstname').prop("disabled", false);
        $('#aname').prop("disabled", false);
        $('#aemail').prop("disabled", false);
        $('#aphone').prop("disabled", false); 
          
        $("#aloader").hide();
        $('#aoutput').html(data);
        $("#aoutput").show();
        $('#aoutput').delay(5000).hide();
        $('#adduser').delay(6000).hide();

		refreshListUsers();							
    }
  });
 }
 else{
   alert("inserer vos identifiants!!");
 }
}); 
</script>