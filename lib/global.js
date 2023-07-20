/* current user data */
var JSONData = "";

/* all users data*/
var JSONUsers = "";

var formsLoaded = 0;
var accountLoaded = 0;
var dashboardLoaded = 0;

var JSONUserId = -1;

var currentUserIdData = -1;

const DOM_LOADED = 0 

let sequencer = new Object();

sequencer.DOM_LOADED = 0;
sequencer.DATA_HORMONAL_LOADING = 0;
sequencer.DATA_HORMONAL_LOADED = 0;		
sequencer.DATA_SNC = 0;	

sequencer.notify = function(evt){
	this.evt =1;
};

var errorMessages = new Array("Inserer vos identifiants de connexion.",
							  "Le login ou le mot de passe est incorrect.",
							  "Inserer votre email de connexion."
							 );


function displayZones(val){
	//$('div[name="datas"]').hide();
	switch(val){
		case 1:
			$('#zoneTab').show();
			$('#zoneAcc').hide();
			$('#zoneFor').hide();
			$('#tb').addClass("active");
			$('#mc').removeClass("active");
			$('#lf').removeClass("active");
			$('#zoneTab').addClass("show active");
			$('#zoneAcc').removeClass("show active");
			$('#zoneFor').removeClass("show active");			
/* 			$('#accDatas').hide();
			$('#lesFormsDatas').hide();	 */											
			break;
		case 2:
			$('#zoneTab').hide();
			$('#zoneAcc').show();
			$('#zoneFor').hide();
			$('#tb').removeClass("active");
			$('#mc').addClass("active");
			$('#lf').removeClass("active");
			$('#zoneTab').removeClass("show active");
			$('#zoneAcc').addClass("show active");
			$('#zoneFor').removeClass("show active");					
/* 			$('#accDatas').show();
			$('#lesFormsDatas').hide();	 */							
			break;
		case 3:
			$('#zoneTab').hide();
			$('#zoneAcc').hide();
			$('#zoneFor').show();
			$('#tb').removeClass("active");
			$('#mc').removeClass("active");
			$('#lf').addClass("active");
			$('#zoneTab').removeClass("show active");
			$('#zoneAcc').removeClass("show active");
			$('#zoneFor').addClass("show active");		
/* 			$('#accDatas').hide();
			$('#lesFormsDatas').show();		 */								
			break;            			
	}
}

function updateUsersDataPanel(clients){
	var tab = "";
    var JSONData = "";
    for (let i = 0; i < clients.length; i++) {
	     JSONData = clients[i];
	            	
	     tab += "<table class='datas'>"; 
	     for(var x in JSONData)
	     {
	    	tab += "<tr><td>"+x+"</td><td>"+JSONData[x]+"</td></tr>";
	     } 
	     tab +="</table><br>";            
    }
 
	$('#jsonDataUsers').html(tab);           	
}

function updateUsersDiv(users){
	var tab = "<table class='datas2'>";
	var droits = ["admin","expert","equipe","client"];
	tab += "<tr><th>Prenom</th><th>Nom</th><th>Email</th><th>Telephone</th><th>Accès</th>";
	if(JSONData["level"] == 0 || JSONData["level"] == 4)
		tab += "<th colspan='2'>Actions</th>";
	if(JSONData["level"] <= 3)
	tab += "<th>Formulaires</th></tr>";	

    var user = "";
     
    for (let i = 0; i < users.length; i++) {
    	user = users[i];
    	tab += "<tr>";
    	tab += "<td>"+user["firstname"]+"</td>";
    	tab += "<td>"+user["name"]+"</td>";
    	tab += "<td>"+user["email"]+"</td>";
    	tab += "<td>"+user["phone"]+"</td>";
    	tab += "<td>"+droits[user["level"]]+"</td>";
		if(JSONData["level"] == 0 || JSONData["level"] == 4)
    		tab += "<td><div id='m_"+i+"' class='btn btn-primary'><i class='fa-solid fa-user-pen' title='Modifier'></i></div></td><td><div id='d_"+i+"' class='btn btn-danger' title='Supprimer'><i class='fa-solid fa-user-xmark'></i></div></td>";            	            	
		if(JSONData["level"] <= 3)
			tab += "<td><div id='v_"+i+"' class='btn btn-info' title='Voir'><i class='fa-solid fa-chalkboard-user'></i></div></td></tr>";           
    }
	tab +="</table>";
	$('#users').html(tab);
	
	$('*[id*=m_]:visible').each(function() {
		var mid = $(this).attr("id");
		var id = mid.split("_");
        $(this).click(function(){
        	modify(id[1]);
        });
    });
    
	$('*[id*=d_]:visible').each(function() {
		var did = $(this).attr("id");
		var id = did.split("_");
        $(this).click(function(){
        	remove(id[1]);
        });
    });

	$('*[id*=v_]:visible').each(function() {
		var did = $(this).attr("id");
		var id = did.split("_");
        $(this).click(function(){
        	voir(id[1]);
        });
    });                                    	
}   
 
 function refreshListUsers(){
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
 } 

function modify(id){
	var user = JSONUsers[id];
	$("#user").show();
	$("#adduser").hide();
	$('#ufirstname').val(user['firstname']);
	$('#uname').val(user['name']);
	$('#uemail').val(user['email']);
	$('#uphone').val(user['phone']);
	$('#ulevel').val(user['level']);    		
	$('#userid').val(user['userid']);	    			
}

function remove(id){
	var cnf = confirm("Want to delete?");
	if(cnf){
		var userid = JSONUsers[id]['userid'];
		$.ajax({
            url:"include/pages/removeUser.php",
            type:"POST",
            data:{
				id:userid
			},
            beforeSend:function(){
                $("#zoneloader").show();    
            },
            success:function(data)
            {
				refreshListUsers();	
                $("#zoneloader").hide();  							
            }
        });        				
	}      
} 

function voir(id){
	var userid = JSONUsers[id]['userid'];
	JSONUserId = id;
	currentUserIdData = userid;
	
	$.ajax({
        url:"include/pages/initForm.php",
        type:"POST",
        data:{
			id:userid
		},
        beforeSend:function(){
			formsLoaded = 0;
			displayZones(3);
            $("#zoneloader").show();    
        },
        success:function(data)
        { 
    		$('#zoneFor').load("/include/pages/forms.php", function(){
    			$("#zoneloader").hide();           		
    		});
    		formsLoaded = 1;
            $("#zoneloader").hide();  							
        }
    });	
}

function kchange(){
	let value = '1'+'_'+$('#73optvalue').val();
	$('#x73').val(value);
}


function ichange(id){
	var gId = id.split("_");
	var text = "";
	switch(gId[0]){
		
		case 'x73':
        	if ($('#x73_1').is(':checked')){
				let value = '1'+'_'+$('#73optvalue').val();
        		$('#x73').val(value);
				$('#73opt').show();	
			}else{
        		$('#x73').val(0);
				$('#73opt').hide();					
			}
			break;
			
		case 'x74':
            for(i=1,j=1; i<=3;i++){
            	var key = "";
            	if($('#x74_'+i).is(':checked')){
            		key = $('#x74_'+i).val();
            		if(j>1)
            		  text += '_'; 
            		text += key; 
					j++;           		
            	}    	
            }
        	$('#x74').val(text);
			break;	
			
		case 'x75':
            for(i=1; i<=4;i++){
            	var key = "";
            	if($('#x75_'+i).is(':checked')){
            		key = $('#x75_'+i).val();
		        	$('#x75').val(key);
					break;               		
            	}    	
            }
			break;
			
		case 'x76':
        	if ($('#x76_1').is(':checked'))
        		$('#x76').val(1);
        	else
        		$('#x76').val(0);
			break;
			
		case 'x77':
            for(i=1; i<=3;i++){
            	var key = "";
            	if($('#x77_'+i).is(':checked')){
            		key = $('#x77_'+i).val();
		        	$('#x77').val(key);
					break;               		
            	}    	
            }
			break;
			
		case 'x78':
        	if ($('#x78_1').is(':checked'))
        		$('#x78').val(1);
        	else
        		$('#x78').val(0);
			break;
			
		case 'x79':
            for(i=1; i<=3;i++){
            	var key = "";
            	if($('#x79_'+i).is(':checked')){
            		key = $('#x79_'+i).val();
		        	$('#x79').val(key);
					break;               		
            	}    	
            }
			break;			
			
		case 'x80':
            for(i=1; i<=3;i++){
            	var key = "";
            	if($('#x80_'+i).is(':checked')){
            		key = $('#x80_'+i).val();
		        	$('#x80').val(key);
					break;               		
            	}    	
            }
			break;				

		case 'x81':
            for(i=1,j=1; i<=6;i++){
            	var key = "";
            	if($('#x81_'+i).is(':checked')){
            		key = $('#x81_'+i).val();
            		if(j>1)
            		  text += '_'; 
            		text += key; 
					j++;           		
            	}    	
            }
        	$('#x81').val(text);
			break;

		case 'x82':
        	if ($('#x82_1').is(':checked'))
        		$('#x82').val(1);
        	else
        		$('#x82').val(0);
			break;
			
		case 'x83':
            for(i=1; i<=3;i++){
            	var key = "";
            	if($('#x83_'+i).is(':checked')){
            		key = $('#x83_'+i).val();
		        	$('#x83').val(key);
					break;               		
            	}    	
            }
			break;
									
	}
}