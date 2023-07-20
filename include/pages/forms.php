<?php
session_start();
$Now = new DateTime('now', new DateTimeZone('Europe/Paris'));
$file = fopen("../../logs/traces.txt", "a+");
fwrite($file, PHP_EOL.$Now->format('Y-m-d H:i:s')." ---> forms.php". PHP_EOL);

if(isset($_SESSION["hasFormValues"]) && $_SESSION["hasFormValues"]==TRUE){
    
    fwrite($file, "SESSION['hasFormValues'] = ".$_SESSION["hasFormValues"]. PHP_EOL);
    $nb = 37;
    for ($i = 1; $i <= $nb; $i++) {
        $vardyn = "q$i";
        $$vardyn = $_SESSION[$vardyn];
    }
    /*ob_start();
    var_dump($_SESSION);
    $result = ob_get_clean();
    
    fwrite($file, "SESSION 2 = ".$result. PHP_EOL);*/ 

} else{
    include_once 'initForm.php';
}

?>
<div class="row">
    <div class="col-12 formheader">
    	<div class="menuitem2" id="cd">Candidose</div>
    	<div class="menuitem2" id="qh">Hormonal</div>
<!--     	<div class="menuitem2" id="sn">SNC</div>
    	<div class="menuitem2" id="pt">Potassium</div>
    	<div class="menuitem2" id="vd">Vitamine D</div>
    	<div class="menuitem2" id="nx">Anxiété</div>
    	<div class="menuitem2" id="gb">GABA</div>
    	<div class="menuitem2" id="lg">LGS</div>
    	<div class="menuitem2" id="sp">Spasmophile</div>
    	<div class="menuitem2" id="so">Sommeil</div>
    	<div class="menuitem2" id="dt">Detox</div>
   		<div class="menuitem2" id="gl">Général</div>   -->  	    	    	    	    	    	    	    	    	    	
    </div>
</div>
<div id="formCD" name="quest"></div>
<div id="formHO" name="quest"></div>
<!-- <div id="formSNC" name="quest"></div>
<div id="formPOT" name="quest"></div>
<div id="formVITD" name="quest"></div>
<div id="formANX" name="quest"></div>
<div id="formGB" name="quest"></div>
<div id="formLGS" name="quest"></div>
<div id="formSPA" name="quest"></div>
<div id="formSOM" name="quest"></div>
<div id="formDTX" name="quest"></div>
<div id="formGRL" name="quest"></div> -->
<div class="row">
	<div class="col-11 formsubmit">
        <button id="formSubmit" type="button" class="btn btn-primary btn-lg float-end">Sauvegarder</button>
        <div id="loader" style="display:none">Sauvegarde en cours...</div>                  
        <div id="output"></div> 
	</div>
</div>
<script>
   $(document).ready(function(){
   		
   		function formCDDisplay(){
   		    var text = "";
        	text += "<div class='row'>";
            text += " 	<div class='col-11'>";
            text += "  		<table class='qtable'>";
            text += "        	<tr>";
            text += "      			<th class='table-primary' colspan='2'>";
            text += "        			<div class='col-8 float-start'>TERRAIN</div>";
            text += "        			<div id='colexpand' class='col-1 float-end'><i class='fa-solid fa-angles-down'></i></div>";
            text += "        		</th>";			
            text += "        	</tr>"; 
            text += "<?php                        
                        $text = "";
                        $titles = array(1=>"Avez-vous fréquement des infections (respiratoire, ORL, uro-génitale, cutanées...) ?",
                                           "Avez-vous pris un traitement antibiotique dans l'année ?",
                                           "Avez-vous pris un traitement antidépresseur ?",
                                           "Combien de cigarettes fumez-vous ?",
                                           "Prenez-vous un traitement contraceptif (pilule contraceptive, stérilet...) ?"
                                   );
                        
                        $nb = count($titles);
                        for ($i = 1; $i <= $nb; $i++) {
                            $text .= "<tr name='qtr1'>";
                            $text .= "  <td class='qtd'>".$titles[$i]."</td>";
                            $text .= "  <td class='qtd'>";
                            $text .= "      <select class='form-select' id='q".$i."' name='DG-resistance'>";
                            $text .= "          <option value='0'>Selection</option>";
                            $text .= "          <option value='1'>Absent</option>";
                            $text .= "          <option value='2'>Peu fréquent</option>";
                            $text .= "          <option value='3'>Peu génant</option>";
                            $text .= "          <option value='4'>Assez fréquent</option>";
                            $text .= "          <option value='5'>Assez génant</option>";
                            $text .= "          <option value='6'>Très fréquent/génant</option>";
                            $text .= "      </select>";
                            $text .= "  </td>";
                            $text .= "</tr>";
                        }
                        
                        if($_SESSION["Data"]["level"]<=1){
                            $text .= "<tr name='qtr1'>";
                            $text .= "<td class='table-info float-end fw-bold' colspan='2' id='qtt1'>Total&nbsp;&nbsp;".$q1+$q2+$q3+$q4+$q5."</td>";
                            $text .= "</tr>";
                        }
                        echo $text;
                    ?>";
            text += "       </table>";            
            text += "   </div>";
            text += "</div><br>";
            
        	text += "<div class='row'>";
            text += " 	<div class='col-11'>";
            text += "  		<table class='qtable'>";
            text += "        	<tr>";
            text += "      			<th class='table-primary' colspan='2'>";
            text += "        			<div class='col-8 float-start'>SYMPTÔMES</div>";
            text += "        			<div id='colexpand2' class='col-1 float-end'><i class='fa-solid fa-angles-down'></i></div>";
            text += "        		</th>";			
            text += "        	</tr>";
            text += "        	<tr>";
            text += "      			<th class='table-secondary' colspan='2'>";
            text += "        			<div class='col-8 float-start fw-normal'>SYMPTÔMES GENERAUX</div>";
            text += "        			<div id='colexpand3' class='col-1 float-end'><i class='fa-solid fa-angle-down'></i></div>";
            text += "        		</th>";			
            text += "        	</tr>";     
            text += "<?php                        
                        $text = "";

                        $titles = array(1=>"Consommez-vous du pain/féculents/sucreries ?",
                                           "Avez-vous envie de consommer de l'alcool? En consommez-vous ?",
                                           "Souffrez-vous de fatigue chronique ?",
                                           "Souffrez-vous d'insomnies ?",
                                           "Souffrez-vous de troubles de sommeil ?",
                                           "Avez-vous des problèmes de concentration ?",
                                           "Souffrez-vous d'anxiété ? Crise de panique ? Désorientation ?",
                                           "Souffrez-vous de vertiges ? Accouphènes ? Brouillards occulaires ?",
                                           "Constatez-vous de l'hyper emotivité ? Irritabilité ?"
                                   );
                        
                        $nb = count($titles);
                        $nb1 = 5;
                        for ($i = 1; $i <= $nb; $i++) {
                            $text .= "<tr name='qtr2'>";
                            $text .= "  <td class='qtd'>".$titles[$i]."</td>";
                            $text .= "  <td class='qtd'>";
                            $text .= "      <select class='form-select' id='q".$i+$nb1."' name='DG-resistance'>";
                            $text .= "          <option value='0'>Selection</option>";
                            $text .= "          <option value='1'>Absent</option>";
                            $text .= "          <option value='2'>Peu fréquent</option>";
                            $text .= "          <option value='3'>Peu génant</option>";
                            $text .= "          <option value='4'>Assez fréquent</option>";
                            $text .= "          <option value='5'>Assez génant</option>";
                            $text .= "          <option value='6'>Très fréquent/génant</option>";
                            $text .= "      </select>";
                            $text .= "  </td>";
                            $text .= "</tr>";
                        }

                        if($_SESSION["Data"]["level"]<=1){
                            $text .= "<tr name='qtr2'>";
                            $text .= "<td class='table-info float-end fw-bold' colspan='2' id='qtt2'>Total&nbsp;&nbsp;".$q6+$q7+$q8+$q9+$q10+$q11+$q12+$q13+$q14."</td>";
                            $text .= "</tr>";
                        }
                        echo $text;
                    ?>";
            text += "       </table>";            
            text += "   </div>";
            text += "</div><br>";            

        	text += "<div class='row'>";
            text += " 	<div class='col-11'>";
            text += "  		<table class='qtable'>";
            text += "        	<tr>";
            text += "      			<th class='table-secondary' colspan='2'>";
            text += "        			<div class='col-8 float-start fw-normal'>SYMPTÔMES DIGESTIFS</div>";
            text += "        			<div id='colexpand4' class='col-1 float-end'><i class='fa-solid fa-angle-down'></i></div>";
            text += "        		</th>";			
            text += "        	</tr>";            
            text += "<?php                        
                        $text = "";
                        $titles = array(1=>"Souffrez-vous de diarrhées ? Constipation ?",
                                           "Avez-vous des reflux gastro-oesophagien ?",
                                           "Souffrez-vous de mauvaise haleine ?",
                                           "Presentez-vous des douleurs abdominales ? Gènes digestives ?",
                                           "Avez-vous des carries dentaires ?",
                                           "Sougfrez-vous de brûlures de la langue et/ou des gencives ?",
                                           "Souffrez-vous de ballonements ? Aérophagie ?",
                                           "Souffrez-vous de brûlures digestives ?",
                                           "Avez-vous des hypersensibilités alimentaires ?"
                                   );
                        
                        $nb = count($titles);
                        $nb1 = 14;
                        for ($i = 1; $i <= $nb; $i++) {
                            $text .= "<tr name='qtr3'>";
                            $text .= "  <td class='qtd'>".$titles[$i]."</td>";
                            $text .= "  <td class='qtd'>";
                            $text .= "      <select class='form-select' id='q".$i+$nb1."' name='DG-resistance'>";
                            $text .= "          <option value='0'>Selection</option>";
                            $text .= "          <option value='1'>Absent</option>";
                            $text .= "          <option value='2'>Peu fréquent</option>";
                            $text .= "          <option value='3'>Peu génant</option>";
                            $text .= "          <option value='4'>Assez fréquent</option>";
                            $text .= "          <option value='5'>Assez génant</option>";
                            $text .= "          <option value='6'>Très fréquent/génant</option>";
                            $text .= "      </select>";
                            $text .= "  </td>";
                            $text .= "</tr>";
                        }
                        
                        if($_SESSION["Data"]["level"]<=1){
                            $text .= "<tr name='qtr3' colspan='2'>";
                            $text .= "<td class='table-info float-end fw-bold' colspan='2' id='qtt3'>Total&nbsp;&nbsp;".$q15+$q16+$q17+$q18+$q19+$q20+$q21+$q22+$q23."</td>";
                            $text .= "</tr>";
                        }
                        echo $text;
                    ?>";
            text += "       </table>";            
            text += "   </div>";
            text += "</div><br>";

        	text += "<div class='row'>";
            text += " 	<div class='col-11'>";
            text += "  		<table class='qtable'>";
            text += "        	<tr>";
            text += "      			<th class='table-secondary' colspan='2'>";
            text += "        			<div class='col-8 float-start fw-normal'>SYMPTÔMES CUTANES</div>";
            text += "        			<div id='colexpand5' class='col-1 float-end'><i class='fa-solid fa-angle-down'></i></div>";
            text += "        		</th>";			
            text += "        	</tr>";            
            text += "<?php                        
                        $text = "";
                        $titles = array(1=>"Avez-vous les ongles et/ou cheveux cassants ?",
                                           "Souffrez-vous d'éruptions cutanées (eczema, acné, dermatite, psoriasis...) ?"
                                   );
                        
                        $nb = count($titles);
                        $nb1 = 23;
                        for ($i = 1; $i <= $nb; $i++) {
                            $text .= "<tr name='qtr4'>";
                            $text .= "  <td class='qtd'>".$titles[$i]."</td>";
                            $text .= "  <td class='qtd'>";
                            $text .= "      <select class='form-select' id='q".$i+$nb1."' name='DG-resistance'>";
                            $text .= "          <option value='0'>Selection</option>";
                            $text .= "          <option value='1'>Absent</option>";
                            $text .= "          <option value='2'>Peu fréquent</option>";
                            $text .= "          <option value='3'>Peu génant</option>";
                            $text .= "          <option value='4'>Assez fréquent</option>";
                            $text .= "          <option value='5'>Assez génant</option>";
                            $text .= "          <option value='6'>Très fréquent/génant</option>";
                            $text .= "      </select>";
                            $text .= "  </td>";
                            $text .= "</tr>";
                        }
                        
                        if($_SESSION["Data"]["level"]<=1){
                            $text .= "<tr name='qtr4'>";
                            $text .= "<td class='table-info float-end fw-bold' colspan='2' id='qtt4'>Total&nbsp;&nbsp;".$q24+$q25."</td>";
                            $text .= "</tr>";
                        }
                        echo $text;
                    ?>";
            text += "       </table>";            
            text += "   </div>";
            text += "</div><br>";
                        
        	text += "<div class='row'>";
            text += " 	<div class='col-11'>";
            text += "  		<table class='qtable'>";
            text += "        	<tr>";
            text += "      			<th class='table-secondary' colspan='2'>";
            text += "        			<div class='col-8 float-start fw-normal'>SYMPTÔMES ORL</div>";
            text += "        			<div id='colexpand6' class='col-1 float-end'><i class='fa-solid fa-angle-down'></i></div>";
            text += "        		</th>";			
            text += "        	</tr>";            
            text += "<?php                        
                        $text = "";
                        $titles = array(1=>"Souffrez-vous de toux chronique ?",
                                           "Présentez-vous des éternuements et écoulements nasaux ?",
                                           "Souffrez-vous de rhinite ?",
                                           "Souffrez-vous de sinusite ?",
                                           "Subissez-vous du stress prémenstruel (femme) ?"
                                   );
                        
                        $nb = count($titles);
                        $nb1 = 25;
                        for ($i = 1; $i <= $nb; $i++) {
                            $text .= "<tr name='qtr5'>";
                            $text .= "  <td class='qtd'>".$titles[$i]."</td>";
                            $text .= "  <td class='qtd'>";
                            $text .= "      <select class='form-select' id='q".$i+$nb1."' name='DG-resistance'>";
                            $text .= "          <option value='0'>Selection</option>";
                            $text .= "          <option value='1'>Absent</option>";
                            $text .= "          <option value='2'>Peu fréquent</option>";
                            $text .= "          <option value='3'>Peu génant</option>";
                            $text .= "          <option value='4'>Assez fréquent</option>";
                            $text .= "          <option value='5'>Assez génant</option>";
                            $text .= "          <option value='6'>Très fréquent/génant</option>";
                            $text .= "      </select>";
                            $text .= "  </td>";
                            $text .= "</tr>";
                        }
                        
                        if($_SESSION["Data"]["level"]<=1){
                            $text .= "<tr name='qtr5'>";
                            $text .= "<td class='table-info float-end fw-bold' colspan='2' id='qtt5'>Total&nbsp;&nbsp;".$q26+$q27+$q28+$q29+$q30."</td>";
                            $text .= "</tr>";
                        }
                        echo $text;
                    ?>";
            text += "       </table>";            
            text += "   </div>";
            text += "</div><br>";
            
        	text += "<div class='row'>";
            text += " 	<div class='col-11'>";
            text += "  		<table class='qtable'>";
            text += "        	<tr>";
            text += "      			<th class='table-secondary' colspan='2'>";
            text += "        			<div class='col-8 float-start fw-normal'>SYMPTÔMES URO-GENITAUX</div>";
            text += "        			<div id='colexpand7' class='col-1 float-end'><i class='fa-solid fa-angle-down'></i></div>";
            text += "        		</th>";			
            text += "        	</tr>";            
            text += "<?php                        
                        $text = "";
                        $titles = array(1=>"Avez-vous des pertes blanches ?",
                                           "Souffrez-vous de douleurs pendant les rapports sexuels ?",
                                           "Présentez-vous des démangeaisons vulvo-vaginales ?<br>Des démangeaisons ou rougeurs localées ?",
                                           "Souffrez-vous de vaginite ? Cystite ? Prostatite ?",
                                           "Souffrez-vous de problèmes d'érection ? Baisse de libido ?",
                                           "Souffrez-vous de symptômes dysménhorhées (douleurs, règles abondantes, tension dans les seins) ?",
                                           "Souffrez-vous d'endométriose ?"                            
                        );
                        
                        $nb = count($titles);
                        $nb1 = 30;
                        for ($i = 1; $i <= $nb; $i++) {
                            $text .= "<tr name='qtr6'>";
                            $text .= "  <td class='qtd'>".$titles[$i]."</td>";
                            $text .= "  <td class='qtd'>";
                            $text .= "      <select class='form-select' id='q".$i+$nb1."' name='DG-resistance'>";
                            $text .= "          <option value='0'>Selection</option>";
                            $text .= "          <option value='1'>Absent</option>";
                            $text .= "          <option value='2'>Peu fréquent</option>";
                            $text .= "          <option value='3'>Peu génant</option>";
                            $text .= "          <option value='4'>Assez fréquent</option>";
                            $text .= "          <option value='5'>Assez génant</option>";
                            $text .= "          <option value='6'>Très fréquent/génant</option>";
                            $text .= "      </select>";
                            $text .= "  </td>";
                            $text .= "</tr>";
                        }
                        
                        if($_SESSION["Data"]["level"]<=1){
                            $text .= "<tr name='qtr6'>";
                            $text .= "<td class='table-info float-end fw-bold' colspan='2' id='qtt6'>Total&nbsp;&nbsp;".$q31+$q32+$q33+$q34+$q35+$q36+$q37."</td>";
                            $text .= "</tr>";
                        }
                        echo $text;
                    ?>";
            text += "       </table>";            
            text += "   </div>";
            text += "</div><br>";
            
            
            $('#formCD').append(text);
                                        		
   		} 

        var tt = 0, tt2=0, tt3=0, tt4=0, tt5=0, tt6=0;
        function total(){        	
           tt = parseInt($('#q1').find(":selected").val()) + parseInt($('#q2').find(":selected").val()) + parseInt($('#q3').find(":selected").val()) + parseInt($('#q4').find(":selected").val()) + parseInt($('#q5').find(":selected").val());
           $('#qtt1').text('Total	 '+tt);
           $("#output").hide();
        }

        function total2(){
           tt2 = parseInt($('#q6').find(":selected").val()) + parseInt($('#q7').find(":selected").val()) + parseInt($('#q8').find(":selected").val()) + parseInt($('#q9').find(":selected").val()) + parseInt($('#q10').find(":selected").val());
           tt2 = tt2 +  parseInt($('#q11').find(":selected").val()) + parseInt($('#q12').find(":selected").val()) + parseInt($('#q13').find(":selected").val()) + parseInt($('#q14').find(":selected").val());
           $('#qtt2').text('Total	 '+tt2);
           $("#output").hide(); 
        }
        
        function total3(){
           tt3 = parseInt($('#q15').find(":selected").val()) + parseInt($('#q16').find(":selected").val());
           tt3 = tt3 + parseInt($('#q17').find(":selected").val()) + parseInt($('#q18').find(":selected").val());
           tt3 = tt3 + parseInt($('#q19').find(":selected").val()) + parseInt($('#q20').find(":selected").val());
           tt3 = tt3 + parseInt($('#q21').find(":selected").val()) + parseInt($('#q22').find(":selected").val());
           tt3 = tt3 + parseInt($('#q23').find(":selected").val());
           $('#qtt3').text('Total	 '+tt3);
           $("#output").hide();
        }
        
        function total4(){
           tt4 = parseInt($('#q24').find(":selected").val()) + parseInt($('#q25').find(":selected").val());
           $('#qtt4').text('Total	 '+tt4);
           $("#output").hide();
        }
        
        function total5(){
           tt5 = parseInt($('#q26').find(":selected").val()) + parseInt($('#q27').find(":selected").val());
           tt5 = tt5 + parseInt($('#q28').find(":selected").val()) + parseInt($('#q29').find(":selected").val());
           tt5 = tt5 + parseInt($('#q30').find(":selected").val());           
           $('#qtt5').text('Total	 '+tt5);
           $("#output").hide();
        }
        
        function total6(){
           tt6 = parseInt($('#q31').find(":selected").val()) + parseInt($('#q32').find(":selected").val());
           tt6 = tt6 + parseInt($('#q33').find(":selected").val()) + parseInt($('#q34').find(":selected").val());
           tt6 = tt6 + parseInt($('#q35').find(":selected").val()) + parseInt($('#q36').find(":selected").val());
           tt6 = tt6 + parseInt($('#q37').find(":selected").val());           
           $('#qtt6').text('Total	 '+tt6);
           $("#output").hide();
        }
        
        function attachCDTotal(){
            <?php 
        		$nb = 37;
        		$text = "";
        		$j="";
        		for ($i = 1; $i <= $nb; $i++) {
        		    if($i==6) 
        		       $j=2;
        		    elseif($i==15)
        		       $j=3;
        		    elseif($i==24)
        		       $j=4;
        		    elseif($i==26)
        		       $j=5;
        		    elseif($i==31)
        		       $j=6;
        		    $text .= " $('#q".$i."').on('change', function(){total".$j."();});";
        		}
        		echo $text;
    		?>        
        }
        
        function initCandidoseForm(uid){
        	$.ajax({
                url:"include/pages/initCD.php",
                type:"POST",
                data:{
                	id:uid
                },
                beforeSend:function(){
                  $("#zoneloader").show();
                  $("#output").hide();               
                },
                success:function(data)
                {
    				setCandidoseForm(data);
                    $("#output").show();
                    $("#zoneloader").hide();					
                }
           });        
        }
        
        function setCandidoseForm(data){
         	var stringdata = JSON.parse(data);
         	var tab = "<table class='datas'>";
         	var i=1; 
			for(var x in stringdata)
			{
				if(i<=5){
					tab += "<tr name='qtr1'><td>"+x+"</td><td>"+stringdata[x]+"</td></tr>";
				}else if(i>5 && i<=14){
					tab += "<tr name='qtr2'><td>"+x+"</td><td>"+stringdata[x]+"</td></tr>";
				}else if(i>14 && i<=23){
					tab += "<tr name='qtr3'><td>"+x+"</td><td>"+stringdata[x]+"</td></tr>";					
				}else if(i>23 && i<=25){
					tab += "<tr name='qtr4'><td>"+x+"</td><td>"+stringdata[x]+"</td></tr>";
				}else if(i>25 && i<=30){
					tab += "<tr name='qtr5'><td>"+x+"</td><td>"+stringdata[x]+"</td></tr>";										
				}else{					
					tab += "<tr name='qtr6'><td>"+x+"</td><td>"+stringdata[x]+"</td></tr>";
				}
									
				$('#'+x).val(stringdata[x]);
    			i++;
			} 
			tab +="</table>";
			
			$('#jsonDataCandidose').html(tab);        
        }
        
        function attachRadioInputs(){
    		<?php 
        		$nb = 78;
        		$text = "";
        		for ($i = 1; $i <= $nb; $i++) {
        		    $text .= "$('input[type=radio][name=ho-radio-".$i."]').on('change', function() {";
        		    $text .= "    switch ($(this).val()) {";
        		    $text .= "        case '0':";
        		    $text .= "            $('#h".$i."').prop('disabled', true);";
        		    $text .= "            break;";
        		    $text .= "        case '1':";
        		    $text .= "            $('#h".$i."').prop('disabled', false);";
        		    $text .= "            break;";
        		    $text .= "     }";
        		    $text .= "}); ";
        		}
        		echo $text;
    		?>             
        } 
        
        function disableAllForms(){
			$('#qh').removeClass().addClass("menuitem_disabled2");
			$('#sn').removeClass().addClass("menuitem_disabled2");
			$('#pt').removeClass().addClass("menuitem_disabled2");
			$('#vd').removeClass().addClass("menuitem_disabled2");
			$('#nx').removeClass().addClass("menuitem_disabled2");
			$('#gb').removeClass().addClass("menuitem_disabled2");
			$('#lg').removeClass().addClass("menuitem_disabled2");
			$('#sp').removeClass().addClass("menuitem_disabled2");
			$('#so').removeClass().addClass("menuitem_disabled2");
			$('#dt').removeClass().addClass("menuitem_disabled2");
			$('#gl').removeClass().addClass("menuitem_disabled2");	        
        }
        
        function enableForm(idx){
			switch(idx){
				case 1:
					$('#cd').removeClass().addClass("menuitem2");
					$('#cd').click(function(){
                    	formsDisplay(1);
                    });
					break;

				case 2:
					$('#qh').removeClass().addClass("menuitem2");
                    $('#qh').click(function(){
                    	if(JSONUserId >=0)
                    		initHormonalForm(JSONUsers[JSONUserId]['userid']);        	
                    	formsDisplay(2);
                    	JSONUserId=-1;
                    });					
					break;	
										
				case 3:
					$('#sn').removeClass().addClass("menuitem2");
                    $('#sn').click(function(){
                    	if(JSONUserId >=0)
                    		initSNCForm(JSONUsers[JSONUserId]['userid']);        	
                    	formsDisplay(3);
                    	JSONUserId=-1;
                    });					
					break;	
					
				case 4:
					$('#pt').removeClass().addClass("menuitem2");
                    $('#pt').click(function(){
                    	if(JSONUserId >=0)
                    		initPOTForm(JSONUsers[JSONUserId]['userid']);        	
                    	formsDisplay(4);
                    	JSONUserId=-1;
                    });					
					break;
					
				case 5:
					$('#vd').removeClass().addClass("menuitem2");
                    $('#vd').click(function(){
                    	if(JSONUserId >=0)
                    		initVITDForm(JSONUsers[JSONUserId]['userid']);        	
                    	formsDisplay(5);
                    	JSONUserId=-1;
                    }); 
					break;
					
				case 6:
					$('#nx').removeClass().addClass("menuitem2");
                    $('#nx').click(function(){
                    	if(JSONUserId >=0)
                    		initANXForm(JSONUsers[JSONUserId]['userid']);        	
                    	formsDisplay(6);
                    	JSONUserId=-1;
                    });					
					break;
					
				case 7:
					$('#gb').removeClass().addClass("menuitem2");
                    $('#gb').click(function(){
                    	if(JSONUserId >=0)
                    		initGBForm(JSONUsers[JSONUserId]['userid']);        	
                    	formsDisplay(7);
                    	JSONUserId=-1;
                    });
					break;	
					
				case 8:
					$('#lg').removeClass().addClass("menuitem2");
                    $('#lg').click(function(){
                    	if(JSONUserId >=0)
                    		initLGSForm(JSONUsers[JSONUserId]['userid']);        	
                    	formsDisplay(8);
                    	JSONUserId=-1;
                    });
					break;
					
				case 9:
					$('#sp').removeClass().addClass("menuitem2");
                    $('#sp').click(function(){
                    	if(JSONUserId >=0)
                    		initSPAForm(JSONUsers[JSONUserId]['userid']);        	
                    	formsDisplay(9);
                    	JSONUserId=-1;
                    });
					break;
					
				case 10:
					$('#so').removeClass().addClass("menuitem2");
                    $('#so').click(function(){
                    	if(JSONUserId >=0)
                    		initSOMForm(JSONUsers[JSONUserId]['userid']);        	
                    	formsDisplay(10);
                    	JSONUserId=-1;
                    });
					break;	
					
				case 11:
					$('#dt').removeClass().addClass("menuitem2");
                    $('#dt').click(function(){
                    	if(JSONUserId >=0)
                    		initDTXForm(JSONUsers[JSONUserId]['userid']);        	
                    	formsDisplay(11);
                    	JSONUserId=-1;
                    });
					break;
					
				case 12:
					$('#gl').removeClass().addClass("menuitem2");
                    $('#gl').click(function(){
                    	if(JSONUserId >=0)
                    		initGRLForm(JSONUsers[JSONUserId]['userid']);        	
                    	formsDisplay(12);
                    	JSONUserId=-1;
                    }); 
					break;																									
			}       
        }  

        function formsDisplay(value){
        	$('div[name="quest"]').hide();

        	if(value == 1){
        		$("#formCD").show();
        		$("#jsonDataCandidose").show();
        		
        		$('#cd').removeClass().addClass("menuitem_active2");
        		
        		if(!$('#qh').hasClass('menuitem_disabled2'))        		
					$('#qh').removeClass().addClass("menuitem2");
					
        		if(!$('#sn').hasClass('menuitem_disabled2'))				
					$('#sn').removeClass().addClass("menuitem2");
					
        		if(!$('#pt').hasClass('menuitem_disabled2'))
					$('#pt').removeClass().addClass("menuitem2");
					
        		if(!$('#vd').hasClass('menuitem_disabled2'))					
					$('#vd').removeClass().addClass("menuitem2");
					
        		if(!$('#nx').hasClass('menuitem_disabled2'))					
					$('#nx').removeClass().addClass("menuitem2");
					
        		if(!$('#gb').hasClass('menuitem_disabled2'))					
					$('#gb').removeClass().addClass("menuitem2");
					
        		if(!$('#lg').hasClass('menuitem_disabled2'))					
					$('#lg').removeClass().addClass("menuitem2");
					
        		if(!$('#sp').hasClass('menuitem_disabled2'))					
					$('#sp').removeClass().addClass("menuitem2");
					
        		if(!$('#so').hasClass('menuitem_disabled2'))					
					$('#so').removeClass().addClass("menuitem2");
					
        		if(!$('#dt').hasClass('menuitem_disabled2'))					
					$('#dt').removeClass().addClass("menuitem2");
					
        		if(!$('#gl').hasClass('menuitem_disabled2'))					
					$('#gl').removeClass().addClass("menuitem2");																																								      		
																																								
        	}
        	
        	if(value == 2){
        		$("#formHO").show();
        		$("#jsonDataHormonal").show();
        		
        		if(!$('#cd').hasClass('menuitem_disabled2'))
        			$('#cd').removeClass().addClass("menuitem2");
        			
				$('#qh').removeClass().addClass("menuitem_active2");
				
        		if(!$('#sn').hasClass('menuitem_disabled2'))				
					$('#sn').removeClass().addClass("menuitem2");
					
        		if(!$('#pt').hasClass('menuitem_disabled2'))
					$('#pt').removeClass().addClass("menuitem2");
					
        		if(!$('#vd').hasClass('menuitem_disabled2'))					
					$('#vd').removeClass().addClass("menuitem2");
					
        		if(!$('#nx').hasClass('menuitem_disabled2'))					
					$('#nx').removeClass().addClass("menuitem2");
					
        		if(!$('#gb').hasClass('menuitem_disabled2'))					
					$('#gb').removeClass().addClass("menuitem2");
					
        		if(!$('#lg').hasClass('menuitem_disabled2'))					
					$('#lg').removeClass().addClass("menuitem2");
					
        		if(!$('#sp').hasClass('menuitem_disabled2'))					
					$('#sp').removeClass().addClass("menuitem2");
					
        		if(!$('#so').hasClass('menuitem_disabled2'))					
					$('#so').removeClass().addClass("menuitem2");
					
        		if(!$('#dt').hasClass('menuitem_disabled2'))					
					$('#dt').removeClass().addClass("menuitem2");
					
        		if(!$('#gl').hasClass('menuitem_disabled2'))					
					$('#gl').removeClass().addClass("menuitem2");																																								      		
        	}
        	
        	if(value == 3){
        		$("#formSNC").show();
        		$("#jsonDataSNC").show();
        		
        		if(!$('#cd').hasClass('menuitem_disabled2'))
        			$('#cd').removeClass().addClass("menuitem2");
        			
        		if(!$('#qh').hasClass('menuitem_disabled2'))        		
					$('#qh').removeClass().addClass("menuitem2");
					
				$('#sn').removeClass().addClass("menuitem_active2");
				
        		if(!$('#pt').hasClass('menuitem_disabled2'))
					$('#pt').removeClass().addClass("menuitem2");
					
        		if(!$('#vd').hasClass('menuitem_disabled2'))					
					$('#vd').removeClass().addClass("menuitem2");
					
        		if(!$('#nx').hasClass('menuitem_disabled2'))					
					$('#nx').removeClass().addClass("menuitem2");
					
        		if(!$('#gb').hasClass('menuitem_disabled2'))					
					$('#gb').removeClass().addClass("menuitem2");
					
        		if(!$('#lg').hasClass('menuitem_disabled2'))					
					$('#lg').removeClass().addClass("menuitem2");
					
        		if(!$('#sp').hasClass('menuitem_disabled2'))					
					$('#sp').removeClass().addClass("menuitem2");
					
        		if(!$('#so').hasClass('menuitem_disabled2'))					
					$('#so').removeClass().addClass("menuitem2");
					
        		if(!$('#dt').hasClass('menuitem_disabled2'))					
					$('#dt').removeClass().addClass("menuitem2");
					
        		if(!$('#gl').hasClass('menuitem_disabled2'))					
					$('#gl').removeClass().addClass("menuitem2");																																									      		
        	}
        	
        	if(value == 4){
        		$("#formPOT").show();
        		$("#jsonDataPOT").show();
        		
        		if(!$('#cd').hasClass('menuitem_disabled2'))
        			$('#cd').removeClass().addClass("menuitem2");
        			
        		if(!$('#qh').hasClass('menuitem_disabled2'))        		
					$('#qh').removeClass().addClass("menuitem2");
					
        		if(!$('#sn').hasClass('menuitem_disabled2'))				
					$('#sn').removeClass().addClass("menuitem2");
					
				$('#pt').removeClass().addClass("menuitem_active2");
				
        		if(!$('#vd').hasClass('menuitem_disabled2'))					
					$('#vd').removeClass().addClass("menuitem2");
					
        		if(!$('#nx').hasClass('menuitem_disabled2'))					
					$('#nx').removeClass().addClass("menuitem2");
					
        		if(!$('#gb').hasClass('menuitem_disabled2'))					
					$('#gb').removeClass().addClass("menuitem2");
					
        		if(!$('#lg').hasClass('menuitem_disabled2'))					
					$('#lg').removeClass().addClass("menuitem2");
					
        		if(!$('#sp').hasClass('menuitem_disabled2'))					
					$('#sp').removeClass().addClass("menuitem2");
					
        		if(!$('#so').hasClass('menuitem_disabled2'))					
					$('#so').removeClass().addClass("menuitem2");
					
        		if(!$('#dt').hasClass('menuitem_disabled2'))					
					$('#dt').removeClass().addClass("menuitem2");
					
        		if(!$('#gl').hasClass('menuitem_disabled2'))					
					$('#gl').removeClass().addClass("menuitem2");																																									      		
        	} 
        	
        	if(value == 5){
        		$("#formVITD").show();
        		$("#jsonDataVITD").show();
        		
        		if(!$('#cd').hasClass('menuitem_disabled2'))
        			$('#cd').removeClass().addClass("menuitem2");
        			
        		if(!$('#qh').hasClass('menuitem_disabled2'))        		
					$('#qh').removeClass().addClass("menuitem2");
					
        		if(!$('#sn').hasClass('menuitem_disabled2'))				
					$('#sn').removeClass().addClass("menuitem2");
					
        		if(!$('#pt').hasClass('menuitem_disabled2'))
					$('#pt').removeClass().addClass("menuitem2");
								
				$('#vd').removeClass().addClass("menuitem_active2");
				
        		if(!$('#nx').hasClass('menuitem_disabled2'))					
					$('#nx').removeClass().addClass("menuitem2");
					
        		if(!$('#gb').hasClass('menuitem_disabled2'))					
					$('#gb').removeClass().addClass("menuitem2");
					
        		if(!$('#lg').hasClass('menuitem_disabled2'))					
					$('#lg').removeClass().addClass("menuitem2");
					
        		if(!$('#sp').hasClass('menuitem_disabled2'))					
					$('#sp').removeClass().addClass("menuitem2");
					
        		if(!$('#so').hasClass('menuitem_disabled2'))					
					$('#so').removeClass().addClass("menuitem2");
					
        		if(!$('#dt').hasClass('menuitem_disabled2'))					
					$('#dt').removeClass().addClass("menuitem2");
					
        		if(!$('#gl').hasClass('menuitem_disabled2'))					
					$('#gl').removeClass().addClass("menuitem2");																																					      		
        	}
        	
         	if(value == 6){
        		$("#formANX").show();
        		$("#jsonDataANX").show();
        		
        		if(!$('#cd').hasClass('menuitem_disabled2'))
        			$('#cd').removeClass().addClass("menuitem2");
        			
        		if(!$('#qh').hasClass('menuitem_disabled2'))        		
					$('#qh').removeClass().addClass("menuitem2");
					
        		if(!$('#sn').hasClass('menuitem_disabled2'))				
					$('#sn').removeClass().addClass("menuitem2");
					
        		if(!$('#pt').hasClass('menuitem_disabled2'))
					$('#pt').removeClass().addClass("menuitem2");
					
        		if(!$('#vd').hasClass('menuitem_disabled2'))					
					$('#vd').removeClass().addClass("menuitem2");
													
				$('#nx').removeClass().addClass("menuitem_active2");
				
        		if(!$('#gb').hasClass('menuitem_disabled2'))					
					$('#gb').removeClass().addClass("menuitem2");
					
        		if(!$('#lg').hasClass('menuitem_disabled2'))					
					$('#lg').removeClass().addClass("menuitem2");
					
        		if(!$('#sp').hasClass('menuitem_disabled2'))					
					$('#sp').removeClass().addClass("menuitem2");
					
        		if(!$('#so').hasClass('menuitem_disabled2'))					
					$('#so').removeClass().addClass("menuitem2");
					
        		if(!$('#dt').hasClass('menuitem_disabled2'))					
					$('#dt').removeClass().addClass("menuitem2");
					
        		if(!$('#gl').hasClass('menuitem_disabled2'))					
					$('#gl').removeClass().addClass("menuitem2");																																	      		
        	}
        	
         	if(value == 7){
        		$("#formGB").show();
        		$("#jsonDataGB").show();
        		
        		if(!$('#cd').hasClass('menuitem_disabled2'))
        			$('#cd').removeClass().addClass("menuitem2");
        			
        		if(!$('#qh').hasClass('menuitem_disabled2'))        		
					$('#qh').removeClass().addClass("menuitem2");
					
        		if(!$('#sn').hasClass('menuitem_disabled2'))				
					$('#sn').removeClass().addClass("menuitem2");
					
        		if(!$('#pt').hasClass('menuitem_disabled2'))
					$('#pt').removeClass().addClass("menuitem2");
					
        		if(!$('#vd').hasClass('menuitem_disabled2'))					
					$('#vd').removeClass().addClass("menuitem2");
					
        		if(!$('#nx').hasClass('menuitem_disabled2'))					
					$('#nx').removeClass().addClass("menuitem2");
																	
				$('#gb').removeClass().addClass("menuitem_active2");
				
        		if(!$('#lg').hasClass('menuitem_disabled2'))					
					$('#lg').removeClass().addClass("menuitem2");
					
        		if(!$('#sp').hasClass('menuitem_disabled2'))					
					$('#sp').removeClass().addClass("menuitem2");
					
        		if(!$('#so').hasClass('menuitem_disabled2'))					
					$('#so').removeClass().addClass("menuitem2");
					
        		if(!$('#dt').hasClass('menuitem_disabled2'))					
					$('#dt').removeClass().addClass("menuitem2");
					
        		if(!$('#gl').hasClass('menuitem_disabled2'))					
					$('#gl').removeClass().addClass("menuitem2");																											      		
        	}
        	
         	if(value == 8){
        		$("#formLGS").show();
        		$("#jsonDataLGS").show();
        		
        		if(!$('#cd').hasClass('menuitem_disabled2'))
        			$('#cd').removeClass().addClass("menuitem2");
        			
        		if(!$('#qh').hasClass('menuitem_disabled2'))        		
					$('#qh').removeClass().addClass("menuitem2");
					
        		if(!$('#sn').hasClass('menuitem_disabled2'))				
					$('#sn').removeClass().addClass("menuitem2");
					
        		if(!$('#pt').hasClass('menuitem_disabled2'))
					$('#pt').removeClass().addClass("menuitem2");
					
        		if(!$('#vd').hasClass('menuitem_disabled2'))					
					$('#vd').removeClass().addClass("menuitem2");
					
        		if(!$('#nx').hasClass('menuitem_disabled2'))					
					$('#nx').removeClass().addClass("menuitem2");
					
        		if(!$('#gb').hasClass('menuitem_disabled2'))					
					$('#gb').removeClass().addClass("menuitem2");
																							
				$('#lg').removeClass().addClass("menuitem_active2");
				
        		if(!$('#sp').hasClass('menuitem_disabled2'))					
					$('#sp').removeClass().addClass("menuitem2");
					
        		if(!$('#so').hasClass('menuitem_disabled2'))					
					$('#so').removeClass().addClass("menuitem2");
					
        		if(!$('#dt').hasClass('menuitem_disabled2'))					
					$('#dt').removeClass().addClass("menuitem2");
					
        		if(!$('#gl').hasClass('menuitem_disabled2'))					
					$('#gl').removeClass().addClass("menuitem2");																							      		
        	}
        	
         	if(value == 9){
        		$("#formSPA").show();
        		$("#jsonDataSPA").show();
        		
        		if(!$('#cd').hasClass('menuitem_disabled2'))
        			$('#cd').removeClass().addClass("menuitem2");
        			
        		if(!$('#qh').hasClass('menuitem_disabled2'))        		
					$('#qh').removeClass().addClass("menuitem2");
					
        		if(!$('#sn').hasClass('menuitem_disabled2'))				
					$('#sn').removeClass().addClass("menuitem2");
					
        		if(!$('#pt').hasClass('menuitem_disabled2'))
					$('#pt').removeClass().addClass("menuitem2");
					
        		if(!$('#vd').hasClass('menuitem_disabled2'))					
					$('#vd').removeClass().addClass("menuitem2");
					
        		if(!$('#nx').hasClass('menuitem_disabled2'))					
					$('#nx').removeClass().addClass("menuitem2");
					
        		if(!$('#gb').hasClass('menuitem_disabled2'))					
					$('#gb').removeClass().addClass("menuitem2");
					
        		if(!$('#lg').hasClass('menuitem_disabled2'))					
					$('#lg').removeClass().addClass("menuitem2");
																												
				$('#sp').removeClass().addClass("menuitem_active2");
				
        		if(!$('#so').hasClass('menuitem_disabled2'))					
					$('#so').removeClass().addClass("menuitem2");
					
        		if(!$('#dt').hasClass('menuitem_disabled2'))					
					$('#dt').removeClass().addClass("menuitem2");
					
        		if(!$('#gl').hasClass('menuitem_disabled2'))					
					$('#gl').removeClass().addClass("menuitem2");																	      		
        	}
        	
         	if(value == 10){
        		$("#formSOM").show();
        		$("#jsonDataSOM").show();
        		
        		if(!$('#cd').hasClass('menuitem_disabled2'))
        			$('#cd').removeClass().addClass("menuitem2");
        			
        		if(!$('#qh').hasClass('menuitem_disabled2'))        		
					$('#qh').removeClass().addClass("menuitem2");
					
        		if(!$('#sn').hasClass('menuitem_disabled2'))				
					$('#sn').removeClass().addClass("menuitem2");
					
        		if(!$('#pt').hasClass('menuitem_disabled2'))
					$('#pt').removeClass().addClass("menuitem2");
					
        		if(!$('#vd').hasClass('menuitem_disabled2'))					
					$('#vd').removeClass().addClass("menuitem2");
					
        		if(!$('#nx').hasClass('menuitem_disabled2'))					
					$('#nx').removeClass().addClass("menuitem2");
					
        		if(!$('#gb').hasClass('menuitem_disabled2'))					
					$('#gb').removeClass().addClass("menuitem2");
					
        		if(!$('#lg').hasClass('menuitem_disabled2'))					
					$('#lg').removeClass().addClass("menuitem2");
																													
        		if(!$('#sp').hasClass('menuitem_disabled2'))					
					$('#sp').removeClass().addClass("menuitem2");
				
				$('#so').removeClass().addClass("menuitem_active2");
				
        		if(!$('#dt').hasClass('menuitem_disabled2'))					
					$('#dt').removeClass().addClass("menuitem2");
					
        		if(!$('#gl').hasClass('menuitem_disabled2'))					
					$('#gl').removeClass().addClass("menuitem2");										
			}        	
        	        	        	        	       	     
         	if(value == 11){
        		$("#formDTX").show();
        		$("#jsonDataDTX").show();
        		
        		if(!$('#cd').hasClass('menuitem_disabled2'))
        			$('#cd').removeClass().addClass("menuitem2");
        			
        		if(!$('#qh').hasClass('menuitem_disabled2'))        		
					$('#qh').removeClass().addClass("menuitem2");
					
        		if(!$('#sn').hasClass('menuitem_disabled2'))				
					$('#sn').removeClass().addClass("menuitem2");
					
        		if(!$('#pt').hasClass('menuitem_disabled2'))
					$('#pt').removeClass().addClass("menuitem2");
					
        		if(!$('#vd').hasClass('menuitem_disabled2'))					
					$('#vd').removeClass().addClass("menuitem2");
					
        		if(!$('#nx').hasClass('menuitem_disabled2'))					
					$('#nx').removeClass().addClass("menuitem2");
					
        		if(!$('#gb').hasClass('menuitem_disabled2'))					
					$('#gb').removeClass().addClass("menuitem2");
					
        		if(!$('#lg').hasClass('menuitem_disabled2'))					
					$('#lg').removeClass().addClass("menuitem2");
																													
        		if(!$('#sp').hasClass('menuitem_disabled2'))					
					$('#sp').removeClass().addClass("menuitem2");
					
        		if(!$('#so').hasClass('menuitem_disabled2'))					
					$('#so').removeClass().addClass("menuitem2");
				
				$('#dt').removeClass().addClass("menuitem_active2");
				
        		if(!$('#gl').hasClass('menuitem_disabled2'))					
					$('#gl').removeClass().addClass("menuitem2");									
			}
			
         	if(value == 12){
        		$("#formGRL").show();
        		$("#jsonDataGRL").show();
        		
        		if(!$('#cd').hasClass('menuitem_disabled2'))
        			$('#cd').removeClass().addClass("menuitem2");
        			
        		if(!$('#qh').hasClass('menuitem_disabled2'))        		
					$('#qh').removeClass().addClass("menuitem2");
					
        		if(!$('#sn').hasClass('menuitem_disabled2'))				
					$('#sn').removeClass().addClass("menuitem2");
					
        		if(!$('#pt').hasClass('menuitem_disabled2'))
					$('#pt').removeClass().addClass("menuitem2");
					
        		if(!$('#vd').hasClass('menuitem_disabled2'))					
					$('#vd').removeClass().addClass("menuitem2");
					
        		if(!$('#nx').hasClass('menuitem_disabled2'))					
					$('#nx').removeClass().addClass("menuitem2");
					
        		if(!$('#gb').hasClass('menuitem_disabled2'))					
					$('#gb').removeClass().addClass("menuitem2");
					
        		if(!$('#lg').hasClass('menuitem_disabled2'))					
					$('#lg').removeClass().addClass("menuitem2");
																													
        		if(!$('#sp').hasClass('menuitem_disabled2'))					
					$('#sp').removeClass().addClass("menuitem2");
					
        		if(!$('#so').hasClass('menuitem_disabled2'))					
					$('#so').removeClass().addClass("menuitem2");
					
        		if(!$('#dt').hasClass('menuitem_disabled2'))					
					$('#dt').removeClass().addClass("menuitem2");
					
				$('#gl').removeClass().addClass("menuitem_active2");										
			}			         	        	        	        	       	     
        	        	        	        	       	         	       	        	             
        }
     
        formCDDisplay();
        formsDisplay(1);
        attachCDTotal();
        initCandidoseForm(-1);
        
        disableAllForms();
        
        $('#cd').click(function(){
        	formsDisplay(1);
        });                                                              
        
               
        function allSelectDisable(value){
    		<?php 
        		$nb = 37;
        		$text = "";
        		for ($i = 1; $i <= $nb; $i++) {
        		    $text .= " $('#q".$i."').prop('disabled', value);";
        		}
        		echo $text;
    		?>      	       	        	        	        	
        }
        
        function allButtonsDisable(){
        	$('#formSubmit').removeClass().addClass("disablebtn");        	
        }
        
        function allButtonsEnable(){
        	$('#formSubmit').removeClass().addClass("sauve");              
        }
        
        $('#colexpand').click(function(){
        	$('tr[name="qtr1"]').toggle();
        });
        
        $('#colexpand2').click(function(){
        	$('tr[name="qtr2"]').toggle();
        	$('tr[name="qtr3"]').toggle();
        	$('tr[name="qtr4"]').toggle();
        	$('tr[name="qtr5"]').toggle(); 
        	$('tr[name="qtr6"]').toggle();         	       	        	        	
        });

        $('#colexpand3').click(function(){
        	$('tr[name="qtr2"]').toggle();
        });
        
        $('#colexpand4').click(function(){
        	$('tr[name="qtr3"]').toggle();
        });
        
        $('#colexpand5').click(function(){
        	$('tr[name="qtr4"]').toggle();
        });
        
        $('#colexpand6').click(function(){
        	$('tr[name="qtr5"]').toggle();
        });
        
        $('#colexpand7').click(function(){
        	$('tr[name="qtr6"]').toggle();
        });   
        
        function formHODisplay(){
        	var text="";
        	text += "<div class='row'>";
            text += " 	<div class='col-11'>";
            text += "  		<table class='qtable'>";
            text += "        	<tr>";
            text += "      			<th class='table-primary' colspan='2'>";
            text += "        			<div class='col-8 float-start'>Evaluation risque résistance à l’insuline, prédiabète, diabète</div>";
            text += "        			<div id='colexpand8' class='col-1 float-end'><i class='fa-solid fa-angles-down'></i></div>";
            text += "        		</th>";	           			
            text += "        	</tr>"; 
            text += "<?php                        
                        $text = "";
                        $titles = array(1=>"Vous sentez-vous affamé et tremblant 2-3 heures après un repas ?",
                                           "Si vous manquez un repas, vous sentez-vous irritable ou fatigué ?",
                                           "Avez-vous tendance à faire de la rétention d’eau après avoir mangé des aliments salés ?",
                                           "Êtes-vous fatigué quelques heures après avoir mangé ?",
                                           "Est-ce que quelqu’un dans votre famille proche a souffert de diabète ou d’hypoglycémie ?",
                                           "Un membre de votre famille a-t-il eu une maladie cardiaque, de l’obésité, le syndrome des ovaires polykystiques ou la goutte ?",
                                           "Avez-vous une pression artérielle élevée ?",
                                           "La majeure partie de votre excès de poids se trouve t’elle autour de votre abdomen ?",
                                           "Avez-vous tendance à prendre du poids rapidement ?",
                                           "Avez-vous des fringales fréquentes pour les aliments sucrés oules féculents ?",
                                           "Souffrez-vous de sautes d’humeur ?",
                                           "Êtes-vous généralement fatigué ou épuisé l'après-midi ou en début de soirée ?",
                                           "Trouvez-vous difficile de perdre du poids avec un régime pauvre en graisse ?", 
                                           "Prenez-vous des médicaments pour réduire le taux de cholestérol ?",
                                           "Êtes-vous en surpoids ?"
                                   );
                        
                        $nb = count($titles);
                        for ($i = 1; $i <= $nb; $i++) {
                            $text .= "<tr name='htr1'>";
                            $text .= "  <td class='qtd'>".$titles[$i]."</td>";
                            $text .= "  <td class='qtd'>";
                            $text .= "      <div class='form-check'>";
                            $text .= "          <div class='d-inline-block'><input type='radio' class='form-check-input' id='h".$i."non' name='ho-radio-".$i."' value='0'>";
                            $text .= "          <label for='h1no' class='form-check-label' name='ho-radio'>Non</label></div>";
                            $text .= "          <div class='d-inline-block ms-5'><input type='radio' class='form-check-input' id='h".$i."oui' name='ho-radio-".$i."' value='1'>";
                            $text .= "          <label for='h1no' class='form-check-label' name='ho-radio'>Oui</label></div>";
                            $text .= "      </div>";
                            $text .= "      <select class='form-select' id='h".$i."' name='HO-resistance'>";
                            $text .= "          <option value='2'>Selection</option>";
                            $text .= "          <option value='3'>Rarement (1 f/mois)</option>";
                            $text .= "          <option value='4'>Parfois (+1 f/mois)</option>";
                            $text .= "          <option value='5'>Souvent (+1 f/semaine)</option>";
                            $text .= "      </select>";
                            $text .= "  </td>";
                            $text .= "</tr>";
                        }
                        echo $text;
                    ?>";
            text += "       </table>";            
            text += "   </div>";
            text += "</div><br><br>";
            
            text += "<div class='row'>";
            text += " 	<div class='col-11'>";
            text += "  		<table class='qtable'>";
            text += "        	<tr>";
            text += "      			<th class='table-primary' colspan='2'>";
            text += "        			<div class='col-8 float-start'>Evaluation de la thyroîde</div>";
            text += "        			<div id='colexpand9' class='col-1 float-end'><i class='fa-solid fa-angles-down'></i></div>";
            text += "        		</th>";	            			
            text += "        	</tr>";
            text += "<?php                        
                        $text = "";
                        $titles = array(1=>"Etes-vous frileux ?",
                                           "Avez-vous des marbrures de peau ?",
                                           "La voix est rauque ?",
                                           "Prise de poids difficile à gérer ?",
                                           "Fatigué le matin ?",
                                           "Courbatures musculaires ?",
                                           "Avez-vous le bout des orteils froids ?",
                                           "Avez-vous le bout des doigts froids ?",
                                           "Êtes-vous constipé ?",
                                           "Est-ce que vous avez besoin de plusieurs “café” le matin pour être en forme ?",
                                           "Perdez vous vos cheveux ?",
                                           "Est-ce que les coudes, talons, tibia secs ?",
                                           "Oedèmes le matin ? (Yeux, orteils, doigts gonflés le matin)", 
                                           "Perte de cheveux ?",
                                           "Ongles fragiles ?",
                                           "Infection ORL à répétition ?",
                                           "Le cerveau fonctionne au ralenti ?",
                                           "Avez-vous une gastroparésie ? (lourdeur d’estomac après le repas ?)",
                                           "Bradypsychie : Cerveau qui fonctionne au ralenti",
                                           "Rigidité articulaires ? Vos articulations sont un peu rouillées le matin ?",
                                           "Migraine réfractaire à tout traitement ?",
                                           "Céphalées ? Maux de tête ?",
                                           "Cholestérol avec LDL élevé (Regardez votre dernière prise de sang) :",
                                           "Syndrome métabolique ? ( surpoids abdominal + cholestérol élevé + triglycérides élevés + glycémie élevée + tension artérielle > 13/8) si vous avez 3 de ses symptômes marquez OUI :",
                                           "Moral up and down ? (déprime)",
                                           "Température basse au réveil ? (Prenez votre température axillaire au niveau des aisselles et ajoutez 0,5 C°, faites-le avant de poser le pied à terre)"
                                   );
                        
                        $nb = count($titles);
                        $nb1 = 15;
                        for ($i = 1; $i <= $nb; $i++) {
                            $text .= "<tr name='htr2'>";
                            $text .= "  <td class='qtd'>".$titles[$i]."</td>";
                            $text .= "  <td class='qtd'>";
                            $text .= "      <div class='form-check'>";
                            $text .= "          <div class='d-inline-block'><input type='radio' class='form-check-input' id='h".$i+$nb1."non' name='ho-radio-".$i+$nb1."' value='0'>";
                            $text .= "          <label for='h1no' class='form-check-label' name='ho-radio'>Non</label></div>";
                            $text .= "          <div class='d-inline-block ms-5'><input type='radio' class='form-check-input' id='h".$i+$nb1."oui' name='ho-radio-".$i+$nb1."' value='1'>";
                            $text .= "          <label for='h1no' class='form-check-label' name='ho-radio'>Oui</label></div>";                            
                            $text .= "      </div>";
                            $text .= "      <select class='form-select' id='h".$i+$nb1."' name='HO-resistance'>";
                            $text .= "          <option value='2'>Selection</option>";
                            $text .= "          <option value='3'>Rarement (1 f/mois)</option>";
                            $text .= "          <option value='4'>Parfois (+1 f/mois)</option>";
                            $text .= "          <option value='5'>Souvent (+1 f/semaine)</option>";
                            $text .= "      </select>";
                            $text .= "  </td>";
                            $text .= "</tr>";
                        }
                        echo $text;
                    ?>";
            text += "       </table>";            
            text += "   </div>";
            text += "</div><br><br>";

            text += "<div class='row'>";
            text += " 	<div class='col-11'>";
            text += "  		<table class='qtable'>";
            text += "        	<tr>";
            text += "      			<th class='table-primary' colspan='2'>";
            text += "        			<div class='col-8 float-start'>Evaluation cortisol bas</div>";
            text += "        			<div id='colexpand10' class='col-1 float-end'><i class='fa-solid fa-angles-down'></i></div>";
            text += "        		</th>";            			
            text += "        	</tr>";
            text += "<?php                        
                        $text = "";
                        $titles = array(1=>"Peau hypersensible",
                                           "Fatigue extrême après le repas du midi",
                                           "Nervosité",
                                           "Confusion",
                                           "Compulsions au sucre/au sel",
                                           "Sursaute au moindre bruit/hyper réactif",
                                           "Faiblesse musculaire",
                                           "Manque d’air/essoufflement",
                                           "Vertiges/hypotension",
                                           "Étourdissement",
                                           "Mal de mer",
                                           "Endormissement malgré prise de café",
                                           "Sensation vertigineuse à chaque lever", 
                                           "Cernes sous les yeux",
                                           "Réveils la nuit pour plusieurs heures",
                                           "Difficulté à s’endormir",
                                           "Besoin d’uriner fréquemment",
                                           "Aggravation des allergies",
                                           "Maladroit (laisser tomber les choses, se cogner partout)",
                                           "Fréquence cardiaque élevée",
                                           "Sentiment de panique",
                                           "Épisodes d’hypoglycémie légers à sévères",
                                           "Incapacité à gérer le stress",
                                           "Très défensif",
                                           "Mains tremblantes",
                                           "Diarrhée",
                                           "Incapacité à se concentrer",
                                           "Nausées face au stress",
                                           "Hypersensibilité émotionnelle",
                                           "Sentiment paranoïaque vis à vis des autres",
                                           "Mal de tête, mal au cuir chevelu",
                                           "Douleurs dans tout le corps",
                                           "Palpitations",
                                           "Accès de rage",
                                           "Symptômes pseudo grippaux",
                                           "Incapacité à gérer les interactions avec les autres",
                                           "Récupération lente après un stress"
                                        );
                        
                        $nb = count($titles);
                        $nb1 = 41;
                        for ($i = 1; $i <= $nb; $i++) {
                            $text .= "<tr name='htr3'>";
                            $text .= "  <td class='qtd'>".$titles[$i]."</td>";
                            $text .= "  <td class='qtd'>";
                            $text .= "      <div class='form-check'>";
                            $text .= "          <div class='d-inline-block'><input type='radio' class='form-check-input' id='h".$i+$nb1."non' name='ho-radio-".$i+$nb1."' value='0'>";
                            $text .= "          <label for='h1no' class='form-check-label' name='ho-radio'>Non</label></div>";
                            $text .= "          <div class='d-inline-block ms-5'><input type='radio' class='form-check-input' id='h".$i+$nb1."oui' name='ho-radio-".$i+$nb1."' value='1'>";
                            $text .= "          <label for='h1no' class='form-check-label' name='ho-radio'>Oui</label></div>";
                            $text .= "      </div>";
                            $text .= "      <select class='form-select' id='h".$i+$nb1."' name='HO-resistance'>";
                            $text .= "          <option value='2'>Selection</option>";
                            $text .= "          <option value='3'>Rarement (1 f/mois)</option>";
                            $text .= "          <option value='4'>Parfois (+1 f/mois)</option>";
                            $text .= "          <option value='5'>Souvent (+1 f/semaine)</option>";
                            $text .= "      </select>";
                            $text .= "  </td>";
                            $text .= "</tr>";
                        }
                        echo $text;
                    ?>";
            text += "       </table>";            
            text += "   </div>";
            text += "</div>";
            
            $('#formHO').append(text);
            attachRadioInputs();

            
            $('#colexpand8').click(function(){
        		$('tr[name="htr1"]').toggle();
            }); 
            
            $('#colexpand9').click(function(){
        		$('tr[name="htr2"]').toggle();
            }); 
            
            $('#colexpand10').click(function(){
        		$('tr[name="htr3"]').toggle();
            });
                                    
            initHormonalForm(-1);
                                
        }
        
        function initHormonalForm(uid){
        	$.ajax({
                url:"include/pages/initHormonal.php",
                type:"POST",
                data:{
                	id:uid
                },
                beforeSend:function(){
                  $("#zoneloader").show();
                  $("#output").hide();               
                },
                success:function(data)
                {
    				setHormonalForm(data);
                    $("#output").show();
                    $("#zoneloader").hide();					
                }
           });
        }
        
        function setHormonalForm(data){
         	var stringdata = JSON.parse(data);
         	var tab = "<table class='datas'>";
         	var i=1; 
			for(var x in stringdata)
			{
				if(i<=15){
					tab += "<tr name='htr1'><td>"+x+"</td><td>"+stringdata[x]+"</td></tr>";
				}else if(i>15 && i<=41){
					tab += "<tr name='htr2'><td>"+x+"</td><td>"+stringdata[x]+"</td></tr>";
				}else{					
					tab += "<tr name='htr3'><td>"+x+"</td><td>"+stringdata[x]+"</td></tr>";
				}
									
				if(stringdata[x] == 0){
    				$('input:radio[name=ho-radio-'+i+'][value=0]').attr('checked', true);
    				$('#'+x).prop('disabled', true);
    			}else{
    				$('input:radio[name=ho-radio-'+i+'][value=1]').attr('checked', true);
    				$('#'+x).prop('disabled', false);
 					$('#'+x).val(stringdata[x]);
    			}
    			i++;
			} 
			tab +="</table>";
			
			$('#jsonDataHormonal').html(tab);
            enableForm(2);			
			sequencer.notify(sequencer.DATA_HORMONAL_LOADED);
			
			//formSNCDisplay(); 
        }
                                           
        formHODisplay();        
    	
    	/* ------------------------------------------------------------- */
    	/* ----------------- formulaire SNC ---------------------------- */
    	/* ------------------------------------------------------------- */
        
        function formSNCDisplay(){
        	var text="";
        	text += "<div class='row'>";
            text += " 	<div class='col-11'>";
            text += "  		<table class='qtable'>";
            text += "        	<tr>";
            text += "      			<th class='qheader'>";
            text += "        			<div class='col-8 qhleft'>Evaluation du Système Nerveux Central</div>";
            text += "        			<div id='colexpand11' class='col-1 qhright'></div>";
            text += "        		</th>";			
            text += "        	</tr>";
            text += "        	<tr>";
            text += "      			<th class='qheader2'>";
            text += "        			<div class='col-8 qhleft'>Les indolamines (Sérotonine + Mélatonine)</div>";
            text += "        			<div id='colexpand12' class='col-1 qhright'></div>";
            text += "        		</th>";			
            text += "        	</tr>";            
            text += "<?php                        
                        $text = "";
                        $titles = array(1=>"Irritabilité",
                                           "Insatisfait(e), impatient(e), sentiment d’être incompris(e)",
                                           "Intolérance aux contraintes / à la frustration",
                                           "Ne supporte pas le stress",
                                           "Sautes d’humeur (individu qui explose pour un oui ou un non)",
                                           "Agressivité",
                                           "Compulsions alimentaires notamment envie de sucré, grignotage entre les repas",
                                           "Tendance à la dépendance : tabac, alcool, café….",
                                           "Difficultés à trouver le sommeil, insomnies",
                                           "Dépression saisonnière (automne, fin hiver), manque de lumière affecte le moral"
                                   );
                        
                        $nb = count($titles);
                        for ($i = 1; $i <= $nb; $i++) {
                            $text .= "<tr name='str1'>";
                            $text .= "  <td class='qtd'>".$titles[$i]."</td>";
                            $text .= "  <td class='qtd'>";
                            $text .= "      <select id='s".$i."' name='HO-resistance'>";
                            $text .= "          <option value='0'>Selection</option>";
                            $text .= "          <option value='1'>Symptôme absent</option>";
                            $text .= "          <option value='2'>Symptôme modéré</option>";
                            $text .= "          <option value='3'>Symptôme gênant</option>";
                            $text .= "          <option value='4'>Symptôme très gênant</option>";
                            $text .= "      </select>";
                            $text .= "  </td>";
                            $text .= "</tr>";
                        }
                        
                        if($_SESSION["Data"]["level"]<=1){
                            $text .= "<tr name='str1'>";
                            $text .= "<td class='qtotal' colspan='2' id='stt1'>Total</td>";
                            $text .= "</tr>";
                        }
                        
                        echo $text;
                    ?>";
            text += "       </table>";            
            text += "   </div>";
            text += "</div><br><br>";

        	text += "<div class='row'>";
            text += " 	<div class='col-11'>";
            text += "  		<table class='qtable'>";
            text += "        	<tr>";
            text += "      			<th class='qheader2'>";
            text += "        			<div class='col-8 qhleft'>Les catécholamines (Dopamine + Noradrénaline + Adrénaline)</div>";
            text += "        			<div id='colexpand13' class='col-1 qhright'></div>";
            text += "        		</th>";			
            text += "        	</tr>"; 
            text += "<?php                        
                        $text = "";
                        $titles = array(1=>"Toujours fatigué(e)",
                                           "Troubles du sommeil",
                                           "Difficulté d’entreprendre, difficulté à prendre des décisions",
                                           "Difficulté à poursuivre une action, fonctionnement au ralenti",
                                           "Diminution de l’intérêt au travail, manque de motivation, difficultés à faire des projets",
                                           "Difficultés de concentration, de mémorisation, d’apprentissage",
                                           "Retrait (plus d’envie de voir ses amis…), repli sur soi même, perte du plaisir à faire les choses",
                                           "Sentiment d’être déprimé(e), douleur morale",
                                           "Sentiment de dévalorisation, manque de confiance en soi, baisse de la libido",
                                           "Impatience dans les jambes"
                                   );
                        
                        $nb = count($titles);
                        $nb1 = 10;
                        for ($i = 1; $i <= $nb; $i++) {
                            $text .= "<tr name='str2'>";
                            $text .= "  <td class='qtd'>".$titles[$i]."</td>";
                            $text .= "  <td class='qtd'>";
                            $text .= "      <select id='s".$i+$nb1."' name='HO-resistance'>";
                            $text .= "          <option value='0'>Selection</option>";
                            $text .= "          <option value='1'>Symptôme absent</option>";
                            $text .= "          <option value='2'>Symptôme modéré</option>";
                            $text .= "          <option value='3'>Symptôme gênant</option>";
                            $text .= "          <option value='4'>Symptôme très gênant</option>";
                            $text .= "      </select>";
                            $text .= "  </td>";
                            $text .= "</tr>";
                        }
                        
                        if($_SESSION["Data"]["level"]<=1){
                            $text .= "<tr name='str2'>";
                            $text .= "<td class='qtotal' colspan='2' id='stt2'>Total</td>";
                            $text .= "</tr>";
                        }
                        echo $text;
                    ?>";
            text += "       </table>";            
            text += "   </div>";
            text += "</div><br><br>"; 
                       
        	text += "<div class='row'>";
            text += " 	<div class='col-11'>";
            text += "  		<table class='qtable'>";
            text += "        	<tr>";
            text += "      			<th class='qheader2'>";
            text += "        			<div class='col-8 qhleft'>Le magnésium</div>";
            text += "        			<div id='colexpand14' class='col-1 qhright'></div>";
            text += "        		</th>";			
            text += "        	</tr>"; 
            text += "<?php                        
                        $text = "";
                        $titles = array(1=>"Contractions involontaires de la paupière (clonie palpébrale), d’autres muscles (bras, abdominaux, quadriceps)",
                                           "Crampes musculaires (mollets, doigts de pied, pieds, mains…), s’aggravant éventuellement pendant la grossesse",
                                           "Tensions musculaires, raideurs dans la nuque, les épaules et bas du dos",
                                           "Névralgie d’Arnold (douleur intense qui part du haut du cou et qui irradie dans la partie postérieure du crane), céphalées temporales avec impression d’avoir la tête dans un étau",
                                           "Douleurs intercostales (pointe thoracique qui contraint à respirer tout doucement, « pointe au cœur »)",
                                           "Hypersensibilité aux bruits et à la lumière",
                                           "Oppression respiratoire, palpitations",
                                           "Fourmillements des mains et des pieds (Paresthésies), extrémités froides et moites",
                                           "Hyperexcitabilité – émotivité – anxiété",
                                           "Rétention d’eau notamment en période prémenstruelle et pendant la grossesse"
                                   );
                        
                        $nb = count($titles);
                        $nb1 = 20;
                        for ($i = 1; $i <= $nb; $i++) {
                            $text .= "<tr name='str3'>";
                            $text .= "  <td class='qtd'>".$titles[$i]."</td>";
                            $text .= "  <td class='qtd'>";
                            $text .= "      <select id='s".$i+$nb1."' name='HO-resistance'>";
                            $text .= "          <option value='0'>Selection</option>";
                            $text .= "          <option value='1'>Symptôme absent</option>";
                            $text .= "          <option value='2'>Symptôme modéré</option>";
                            $text .= "          <option value='3'>Symptôme gênant</option>";
                            $text .= "          <option value='4'>Symptôme très gênant</option>";
                            $text .= "      </select>";
                            $text .= "  </td>";
                            $text .= "</tr>";
                        }
                        
                        if($_SESSION["Data"]["level"]<=1){
                            $text .= "<tr name='str3'>";
                            $text .= "<td class='qtotal' colspan='2' id='stt3'>Total</td>";
                            $text .= "</tr>";
                        }
                        echo $text;
                    ?>";
            text += "       </table>";            
            text += "   </div>";
            text += "</div>"
            $('#formSNC').append(text);

            $('#colexpand11').click(function(){
        		$('tr[name="str1"]').toggle();
         		$('tr[name="str2"]').toggle(); 
         		$('tr[name="str3"]').toggle();         		      		
            });
            
            $('#colexpand12').click(function(){
        		$('tr[name="str1"]').toggle();     		
            });
            
            $('#colexpand13').click(function(){
         		$('tr[name="str2"]').toggle();       		
            });

             $('#colexpand14').click(function(){
         		$('tr[name="str3"]').toggle();       		
            });
            
            initSNCForm(-1);
            attachSNCTotal();                           	 
        }
        
        function attachSNCTotal(){
            <?php 
        		$nb = 30;
        		$text = "";
        		$j="";
        		for ($i = 1; $i <= $nb; $i++) {
        		    if($i==11) 
        		       $j=2;
        		    elseif($i==21)
        		       $j=3;
        		   
        		    $text .= " $('#s".$i."').on('change', function(){stotal".$j."();});";
        		}
        		echo $text;
    		?>        
        }        

        var stt = 0, stt2=0, stt3=0 ;
        function stotal(){
           <?php
                $nb = 10;
                $text = "stt = ";
                for ($i = 1; $i <= $nb; $i++) {
                    $text .= "parseInt($('#s$i').find(':selected').val())  ";
                    if ($i<$nb)
                        $text .= "+";
                }
                $text .= "; ";
                echo $text;
           ?>
           $('#stt1').text('Total	 '+stt);
           $("#output").hide();
        }

        function stotal2(){
           <?php
                $nb = 20;
                $text = "stt2 = ";
                for ($i = 11; $i <= $nb; $i++) {
                    $text .= "parseInt($('#s$i').find(':selected').val())  ";
                    if ($i<$nb)
                        $text .= "+";
                }
                $text .= "; ";
                echo $text;
           ?>           
           $('#stt2').text('Total	 '+stt2);
           $("#output").hide(); 
        }
        
        function stotal3(){
           <?php
                $nb = 30;
                $text = "stt3 = ";
                for ($i = 21; $i <= $nb; $i++) {
                    $text .= "parseInt($('#s$i').find(':selected').val())  ";
                    if ($i<$nb)
                        $text .= "+";
                }
                $text .= "; ";
                echo $text;
           ?> 
           $('#stt3').text('Total	 '+stt3);
           $("#output").hide();
        }
               
        function initSNCForm(uid){
        	$.ajax({
                url:"include/pages/initSNC.php",
                type:"POST",
                data:{
                	id:uid
                },
                beforeSend:function(){
                  $("#zoneloader").show();
                  $("#output").hide();              
                },
                success:function(data)
                {
    				setSNCForm(data);
                    $("#output").show();
                    $("#zoneloader").hide();					
                }
           });
        }

        function setSNCForm(data){
         	var stringdata = JSON.parse(data);
         	var stt1 = stt2 = stt3 = 0;
         	var tab = "<table class='datas'>";
         	var i=1; 
			for(var x in stringdata)
			{
				if(i<=10){
					tab += "<tr name='str1'><td>"+x+"</td><td>"+stringdata[x]+"</td></tr>";
					stt1 = stt1 + parseInt(stringdata[x]);
				}else if(i>10 && i<=20){
					tab += "<tr name='str2'><td>"+x+"</td><td>"+stringdata[x]+"</td></tr>";
					stt2 = stt2 + parseInt(stringdata[x]);
				}else{					
					tab += "<tr name='str3'><td>"+x+"</td><td>"+stringdata[x]+"</td></tr>";
					stt3 = stt3 + parseInt(stringdata[x]);
				}
									
				$('#'+x).val(stringdata[x]);							
    			i++;
			}
			
			$('#stt1').text('Total	 '+stt1);
			$('#stt2').text('Total	 '+stt2);
			$('#stt3').text('Total	 '+stt3);
							 
			tab +="</table>";
			
			$('#jsonDataSNC').html(tab);
            enableForm(3);			
			
			sequencer.notify(sequencer.DATA_SNC);

        	formPOTDisplay();			
        }
               
        
        /* ------------------------------------------------------------------------------ */
        /* --------------------------- Formulaire Potassium ----------------------------- */ 
        /* ------------------------------------------------------------------------------ */   
        
        function formPOTDisplay(){
        	var text="";
        	text += "<div class='row'>";
            text += " 	<div class='col-11'>";
            text += "  		<table class='qtable'>";
            text += "        	<tr>";
            text += "      			<th class='qheader'>";
            text += "        			<div class='col-8 qhleft'>Evaluation du Potassium</div>";
            text += "        			<div id='colexpand15' class='col-1 qhright'></div>";
            text += "        		</th>";			
            text += "        	</tr>";            
            text += "<?php                        
                        $text = "";
                        $titles = array(1=>"Avez-vous souffert dernièrement d'une haute tension artérielle ?",
                                           "Avez-vous constaté une fatigue constante inhabituelle ?",
                                           "Avez-vous souvent la nausée ?",
                                           "Souffrez-vous régulièrement de crampes musculaires ?",
                                           "Ressentez-vous des fourmillements aux extremités (mains, pieds) ?",
                                           "Êtes-vous souvent ballonné ?",
                                           "Avez-vous des sauts d'humeur ?",
                                           "Votre transit est-il pertubé, plus lent (constipation) ?",
                                           "Allez-vous presque toutes les heures uriner ?"
                                   );
                        
                        $nb = count($titles);
                        for ($i = 1; $i <= $nb; $i++) {
                            $text .= "<tr name='ptr1'>";
                            $text .= "  <td class='qtd'>".$titles[$i]."</td>";
                            $text .= "  <td class='qtd'>";
                            $text .= "      <select id='p".$i."' name='HO-resistance'>";
                            $text .= "          <option value='0'>Non</option>";
                            $text .= "          <option value='1'>Oui</option>";
                            $text .= "      </select>";
                            $text .= "  </td>";
                            $text .= "</tr>";
                        }
                        
                        if($_SESSION["Data"]["level"]<=1){
                            $text .= "<tr name='ptr1'>";
                            $text .= "<td class='qtotal' colspan='2' id='ptt'>Total</td>";
                            $text .= "</tr>";
                        }
                        echo $text;
                    ?>";
            text += "       </table>";            
            text += "   </div>";
            text += "</div>";
            
            $('#formPOT').append(text);

            $('#colexpand15').click(function(){
        		$('tr[name="ptr1"]').toggle();      		      		
            });
            
            initPOTForm(-1);
            attachPOTTotal();
        } 
        
        function initPOTForm(uid){
        	$.ajax({
                url:"include/pages/initPOT.php",
                type:"POST",
                data:{
                	id:uid
                },
                beforeSend:function(){
                  $("#zoneloader").show();
                  $("#output").hide();         
                },
                success:function(data)
                {
    				setPOTForm(data);
                    $("#output").show();
                    $("#zoneloader").hide();					
                }
           });
        }

        function attachPOTTotal(){
            <?php 
        		$nb = 9;
        		$text = "";
        		for ($i = 1; $i <= $nb; $i++) {        		   
        		    $text .= " $('#p".$i."').on('change', function(){ptotal();});";
        		}
        		echo $text;
    		?>        
        }
        
        function ptotal(){
           <?php
                $nb = 9;
                $text = "var yes = no = 0; var ptt;";
                for ($i = 1; $i <= $nb; $i++) {
                    $text .= "ptt = parseInt($('#p$i').find(':selected').val());  ";
                    $text .= "if(ptt==1)"; 
                    $text .= "   yes++;";
                    $text .= "else ";
                    $text .= " no++;";                    
                }
                echo $text;
           ?> 
		   $('#ptt').text('Total	oui : '+yes+'      Non : '+no);	
           $("#output").hide();
        }        
        
        function setPOTForm(data){
         	var stringdata = JSON.parse(data);
         	var tab = "<table class='datas'>";
         	var yes = no = 0;
			for(var x in stringdata)
			{
				tab += "<tr name='ptr1'><td>"+x+"</td><td>"+stringdata[x]+"</td></tr>";	
				if(stringdata[x] == 1)
					yes++;
				else
					no++;							
				$('#'+x).val(stringdata[x]);
			} 
			$('#ptt').text('Total	oui : '+yes+'      Non : '+no);			
			tab +="</table>";
						
			$('#jsonDataPOT').html(tab);
            enableForm(4);
                   		
       		formVITDDisplay();    			
			
        }
                 

          
        /* ------------------------------------------------------------------------------ */
        /* --------------------------- Formulaire Vitamine D ----------------------------- */ 
        /* ------------------------------------------------------------------------------ */   
        
        function formVITDDisplay(){
        	var text="";
        	text += "<div class='row'>";
            text += " 	<div class='col-11'>";
            text += "  		<table class='qtable'>";
            text += "        	<tr>";
            text += "      			<th class='qheader'>";
            text += "        			<div class='col-8 qhleft'>Evaluation de la vitamine D</div>";
            text += "        			<div id='colexpand16' class='col-1 qhright'></div>";
            text += "        		</th>";			
            text += "        	</tr>";            
            text += "<?php                        
                        $text = "";
                        $titles = array(1=>"Passez-vous la majorité de votre journée à l'intérieur ?",
                                           "Vivez-vous dans une ville nuageuse, surtout en hiver ?",
                                           "Vous êtes-vous fracturé un os plus d'une fois dans votre vie ?",
                                           "Tombez-vous facilement malade (rhume, etats grippaux) ?",
                                           "Souffrez-vous d'une maladie auto-immune ?",
                                           "Souffrez-vous de dépression ou de déprime passagère ?",
                                           "Vous sentez-vous fatigué en permanence ?",
                                           "Avez-vous des troubles du sommeil (insomnies) ?",
                                           "Avez-vous des problèmes dentaires ?"
                                   );
                        
                        $nb = count($titles);
                        for ($i = 1; $i <= $nb; $i++) {
                            $text .= "<tr name='dtr1'>";
                            $text .= "  <td class='qtd'>".$titles[$i]."</td>";
                            $text .= "  <td class='qtd'>";
                            $text .= "      <select id='d".$i."' name='HO-resistance'>";
                            $text .= "          <option value='0'>Non</option>";
                            $text .= "          <option value='1'>Oui</option>";
                            $text .= "      </select>";
                            $text .= "  </td>";
                            $text .= "</tr>";
                        }
                        echo $text;
                    ?>";
            text += "       </table>";            
            text += "   </div>";
            text += "</div>";
            
            $('#formVITD').append(text);

            $('#colexpand16').click(function(){
        		$('tr[name="dtr1"]').toggle();      		      		
            });
            
            initVITDForm(-1);
        } 
        
        function initVITDForm(uid){
        	$.ajax({
                url:"include/pages/initVITD.php",
                type:"POST",
                data:{
                	id:uid
                },
                beforeSend:function(){
                  $("#zoneloader").show();
                  $("#output").hide();                
                },
                success:function(data)
                {
    				setVITDForm(data);
                    $("#output").show();
                    $("#zoneloader").hide();					
                }
           });
        }

        function setVITDForm(data){
         	var stringdata = JSON.parse(data);
         	var tab = "<table class='datas'>";
			for(var x in stringdata)
			{
				tab += "<tr name='dtr1'><td>"+x+"</td><td>"+stringdata[x]+"</td></tr>";									
				$('#'+x).val(stringdata[x]);
			} 
			tab +="</table>";			
			$('#jsonDataVITD').html(tab);
            enableForm(5);
            			
        	formANXDisplay();  			
        }
                
        
 
        /* ------------------------------------------------------------------------------ */
        /* --------------------------- Formulaire Anxiété ------------------------------- */ 
        /* ------------------------------------------------------------------------------ */   
        
        function formANXDisplay(){
        	var text="";
        	text += "<div class='row'>";
            text += " 	<div class='col-11'>";
            text += "  		<table class='qtable'>";
            text += "        	<tr>";
            text += "      			<th class='qheader' colspan='2'>";
            text += "        			<div class='col-8 qhleft'>Evaluation de l'anxiété</div>";
            text += "        			<div id='colexpand17' class='col-1 qhright'></div>";
            text += "        		</th>";			
            text += "        	</tr>";            
            text += "<?php                        
                        $text = "";
                        $titles = array(1=>"Je me sens tendu(e) ou enervé(e)",
                                           "Je prends plaisir aux mêmes choses qu'autrefois",
                                           "J'ai une sensation de peur comme si quelque chose d'horrible allait m'arriver",
                                           "Je ris facilement et vois le bon coté des choses",
                                           "Je me fais du soucis",
                                           "Je suis de bonne humeur",
                                           "Je peux rester tranquillement assis(e) à ne rien faire et me sentir décontracté(e)",
                                           "J'ai l'impression de fonctionner au ralenti",
                                           "j'éprouve des sensations de peur et j'ai l'estomac noué",                     
                                           "Je ne m'interesse plus à mon apparence",
                                           "J'ai la bougeotte et n'arrive pas à tenir en place",
                                           "Je me rejouis d'avance à l'idée de faire certaines choses",
                                           "J'épouvre des sensations soudaines de panique",
                                           "Je peux prendre plaisir à un bon livre ou à une bonne emission de radio ou de télévision"
                        );
                        $options = array(1=>array(1=>"Jamais","De temps en temps","Souvent","La plupart du temps"),
                                            array(1=>"Oui, tout autant","Pas autant","Un peu seulement","Presque plus"),
                                            array(1=>"Pas du tout","Un peu, mais cela ne m'inquiète pas","Oui, mais cela n'est pas trop grave","Oui, très nettement"),
                                            array(1=>"Autant que par le passé","Plus autant qu'avant","Vraiment moins qu'avant","Plus du tout"),
                                            array(1=>"Très occasionnellement","Occasionnellement","Assez souvent","Très souvent"),
                                            array(1=>"La plupart du temps","Assez souvent","Rarement","Jamais"),
                                            array(1=>"Oui quoi qu'il arrive", "Oui en general", "Rarement", "Jamais"),
                                            array(1=>"Jamais","Parfois","Très souvent","Presque toujours"),
                                            array(1=>"Jamais","Parfois","Très souvent","Très souvent"),                                           
                                            array(1=>"j'y prête autant d'attention que par le passé","Il se peut que je n'y fasse plus autant attention","Je n'y accorde pas autant d'attention que je devrais","Plus du tout"),
                                            array(1=>"Pas du tout","Pas tellement","Un peu","Oui, c'est tout à fait le cas"),
                                            array(1=>"Autant qu'avant", "Un peu moins qu'avant", "Bien moins qu'avant", "Presque jamais"),
                                            array(1=>"Jamais","Pas très souvent","Assez souvent","Vraiment très souvent"),
                                            array(1=>"Souvent","Parfois","Rarement","Très rarement")                           
                        );
                        
                        $nb = count($titles);
                        for ($i = 1; $i <= $nb; $i++) {
                            $listOptions = $options[$i];
                            $text .= "<tr name='atr1'>";
                            $text .= "  <td class='qtd'>".$titles[$i]."</td>";
                            $text .= "  <td class='qtd'>";
                            $text .= "      <select id='a".$i."' name='HO-resistance'>";
                            $text .= "          <option value='0'>Selection</option>";
                            foreach ($listOptions as $key => $txt)
                                $text .= "          <option value='$key'>$txt</option>";
                            $text .= "      </select>";
                            $text .= "  </td>";
                            $text .= "</tr>";
                        }
                        echo $text;
                    ?>";
            text += "       </table>";            
            text += "   </div>";
            text += "</div>";
            
            $('#formANX').append(text);

            $('#colexpand17').click(function(){
        		$('tr[name="atr1"]').toggle();      		      		
            });
            
            initANXForm(-1);
        } 
        
        function initANXForm(uid){
        	$.ajax({
                url:"include/pages/initANX.php",
                type:"POST",
                data:{
                	id:uid
                },
                beforeSend:function(){
                  $("#zoneloader").show();
                  $("#output").hide();
                },
                success:function(data)
                {
    				setANXForm(data);
                    $("#output").show();
                    $("#zoneloader").hide();					
                }
           });
        }

        function setANXForm(data){
         	var stringdata = JSON.parse(data);
         	var tab = "<table class='datas'>";
			for(var x in stringdata)
			{
				tab += "<tr name='atr1'><td>"+x+"</td><td>"+stringdata[x]+"</td></tr>";									
				$('#'+x).val(stringdata[x]);
			} 
			tab +="</table>";			
			$('#jsonDataANX').html(tab);
            enableForm(6);
			
        	formGBDisplay();			
        }
                
      
        
        /* ------------------------------------------------------------------------------ */
        /* --------------------------- Formulaire GABA ---------------------------------- */ 
        /* ------------------------------------------------------------------------------ */   
        
        function formGBDisplay(){
        	var text="";
        	text += "<div class='row'>";
            text += " 	<div class='col-11'>";
            text += "  		<table class='qtable'>";
            text += "        	<tr>";
            text += "      			<th class='qheader'>";
            text += "        			<div class='col-8 qhleft'>Profil GABA</div>";
            text += "        			<div id='colexpand18' class='col-1 qhright'></div>";
            text += "        		</th>";			
            text += "        	</tr>"; 
            text += "        	<tr name='gtr1'>";
            text += "      			<td class='qsubheader' colspan='2'>";
            text += "        			<div class='col-8 qhleft'>En ce moment,</div>";
            text += "        		</td>";			
            text += "        	</tr>";                       
            text += "<?php                        
                        $text = "";
                        $titles = array(1=>"Vous sentez-vous nerveux(se) et inquiet(e) ?",
                                           "Réussissez-vous à mémoriser les numéros de téléphone ?",
                                           "Avez-vous besoin de lire plusieurs fois un paragraphe ?",
                                           "Vous sentez-vous souvent nerveux(se) ?",
                                           "Vous aimez faire plusieurs choses à la fois, mais vous ne pouvez souvent pas decider quoi faire en premier ?",
                                           "Avez-vous tendance à être superactif(ve) ?"
                                   );
                        
                        $nb = count($titles);
                        for ($i = 1; $i <= $nb; $i++) {
                            $text .= "<tr name='gtr1'>";
                            $text .= "  <td class='qtd'>".$titles[$i]."</td>";
                            $text .= "  <td class='qtd'>";
                            $text .= "      <select id='g".$i."' name='HO-resistance'>";
                            $text .= "          <option value='-1'>Selection</option>";
                            $text .= "          <option value='0'>0</option>";
                            $text .= "          <option value='1'>1</option>";
                            $text .= "          <option value='2'>2</option>";
                            $text .= "          <option value='3'>3</option>";
                            $text .= "      </select>";
                            $text .= "  </td>";
                            $text .= "</tr>";
                        }
                        
                        if($_SESSION["Data"]["level"]<=1){
                            $text .= "<tr name='gtr1'>";
                            $text .= "<td class='qtotal' colspan='2' id='gtt1'>Total</td>";
                            $text .= "</tr>";
                        }
                        echo $text;
                    ?>";
            text += "       </table>";            
            text += "   </div>";
            text += "</div><br><br>";

        	text += "<div class='row'>";
            text += " 	<div class='col-11'>";
            text += "  		<table class='qtable'>";            
            text += "        	<tr>";
            text += "      			<th class='qheader'>";
            text += "        			<div class='col-8 qhleft'>Profil Dopaminergique</div>";
            text += "        			<div id='colexpand58' class='col-1 qhright'></div>";
            text += "        		</th>";			
            text += "        	<tr name='gtr2'>";
            text += "      			<td class='qsubheader' colspan='2'>";
            text += "        			<div class='col-8 qhleft'>En ce moment,</div>";
            text += "        		</td>";			
            text += "        	</tr>";               
            text += "<?php                        
                        $text = "";
                        $titles = array(1=>"je ressens une baisse de motivation ou une perte d’intérêt pour mes activités habituelles",
                                           "j’ai tendance à me replier sur moi-même, je ne veux voir personne",
                                           "j’ai des difficultés de concentration, des troubles de la mémoire",
                                           "je reporte au lendemain ce que j’ai à faire",
                                           "j’ai des troubles du sommeil",
                                           "je ressens une fatigue permanente non atténuée par le repos ou par le sommeil et sans même avoir fait d’efforts particuliers"
                                   );
                        
                        $nb = count($titles);
                        $nb1 = 6;
                        for ($i = 1; $i <= $nb; $i++) {
                            $text .= "<tr name='gtr2'>";
                            $text .= "  <td class='qtd'>".$titles[$i]."</td>";
                            $text .= "  <td class='qtd'>";
                            $text .= "      <select id='g".$i+$nb1."' name='HO-resistance'>";
                            $text .= "          <option value='-1'>Selection</option>";
                            $text .= "          <option value='0'>Jamais</option>";
                            $text .= "          <option value='1'>Rarement</option>";
                            $text .= "          <option value='2'>Parfois</option>";
                            $text .= "          <option value='3'>Souvent</option>";
                            $text .= "      </select>";
                            $text .= "  </td>";
                            $text .= "</tr>";
                        }
                        
                        if($_SESSION["Data"]["level"]<=1){
                            $text .= "<tr name='gtr2'>";
                            $text .= "<td class='qtotal' colspan='2' id='gtt2'>Total</td>";
                            $text .= "</tr>";
                        }
                        echo $text;
                    ?>"; 
            text += "       </table>";            
            text += "   </div>";
            text += "</div><br><br>";     

        	text += "<div class='row'>";
            text += " 	<div class='col-11'>";
            text += "  		<table class='qtable'>";            
            text += "        	<tr>";
            text += "      			<th class='qheader'>";
            text += "        			<div class='col-8 qhleft'>Profil Noradrénergique</div>";
            text += "        			<div id='colexpand59' class='col-1 qhright'></div>";
            text += "        		</th>";			
            text += "        	</tr>";
            text += "        	<tr name='gtr3'>";
            text += "      			<td class='qsubheader' colspan='2'>";
            text += "        			<div class='col-8 qhleft'>En ce moment,</div>";
            text += "        		</td>";			
            text += "        	</tr>";              
            text += "<?php                        
                        $text = "";
                        $titles = array(1=>"je manque d’énergie",
                                           "je me sens déprimé(e), je suis d’humeur triste, j’ai une sensibilité exacerbée",
                                           "je manque de confiance en moi, j’ai une mauvaise image de moi",
                                           "je ressens moins de plaisir pour des choses qui me faisaient plaisir auparavant",
                                           "j’ai une baisse de libido",
                                           "je ressens également une fatigue morale" 
                                   );
                        
                        $nb = count($titles);
                        $nb1 = 12;
                        for ($i = 1; $i <= $nb; $i++) {
                            $text .= "<tr name='gtr3'>";
                            $text .= "  <td class='qtd'>".$titles[$i]."</td>";
                            $text .= "  <td class='qtd'>";
                            $text .= "      <select id='g".$i+$nb1."' name='HO-resistance'>";
                            $text .= "          <option value='-1'>Selection</option>";
                            $text .= "          <option value='0'>Jamais</option>";
                            $text .= "          <option value='1'>Rarement</option>";
                            $text .= "          <option value='2'>Parfois</option>";
                            $text .= "          <option value='3'>Souvent</option>";
                            $text .= "      </select>";
                            $text .= "  </td>";
                            $text .= "</tr>";
                        }
                        
                        if($_SESSION["Data"]["level"]<=1){
                            $text .= "<tr name='gtr3'>";
                            $text .= "<td class='qtotal' colspan='2' id='gtt3'>Total</td>";
                            $text .= "</tr>";
                        }
                        echo $text;

                    ?>"; 
            text += "       </table>";            
            text += "   </div>";
            text += "</div><br><br>"; 

        	text += "<div class='row'>";
            text += " 	<div class='col-11'>";
            text += "  		<table class='qtable'>";            
            text += "        	<tr>";
            text += "      			<th class='qheader'>";
            text += "        			<div class='col-8 qhleft'>Profil Sérotoninergique</div>";
            text += "        			<div id='colexpand60' class='col-1 qhright'></div>";
            text += "        		</th>";			
            text += "        	</tr>";
            text += "        	<tr name='gtr4'>";
            text += "      			<td class='qsubheader' colspan='2'>";
            text += "        			<div class='col-8 qhleft'>En ce moment,</div>";
            text += "        		</td>";			
            text += "        	</tr>";                
            text += "<?php                        
                        $text = "";
                        $titles = array(1=>"je me sens irritable, impatient(e) ou agressif(ve)",
                                           "je suis d’humeur changeante",
                                           "je suis stressé(e), je me sens dépassé(e) par des soucis personnels ou professionnels",
                                           "je suis attiré(e) par le sucré toute la journée",
                                           "j’ai des comportements addictifs (sport intensif, tabac, grignotage, alcool...)",
                                           "j’ai des difficultés à trouver le sommeil ou à me rendormir" 
                                   );
                        
                        $nb = count($titles);
                        $nb1 = 18;
                        for ($i = 1; $i <= $nb; $i++) {
                            $text .= "<tr name='gtr4'>";
                            $text .= "  <td class='qtd'>".$titles[$i]."</td>";
                            $text .= "  <td class='qtd'>";
                            $text .= "      <select id='g".$i+$nb1."' name='HO-resistance'>";
                            $text .= "          <option value='-1'>Selection</option>";
                            $text .= "          <option value='0'>Jamais</option>";
                            $text .= "          <option value='1'>Rarement</option>";
                            $text .= "          <option value='2'>Parfois</option>";
                            $text .= "          <option value='3'>Souvent</option>";
                            $text .= "      </select>";
                            $text .= "  </td>";
                            $text .= "</tr>";
                        }
                        
                        if($_SESSION["Data"]["level"]<=1){
                            $text .= "<tr name='gtr4'>";
                            $text .= "<td class='qtotal' colspan='2' id='gtt4'>Total</td>";
                            $text .= "</tr>";
                        }
                        echo $text;
                    ?>"; 
            text += "       </table>";            
            text += "   </div>";
            text += "</div><br><br>"; 
 
        	text += "<div class='row'>";
            text += " 	<div class='col-11'>";
            text += "  		<table class='qtable'>";            
            text += "        	<tr>";
            text += "      			<th class='qheader'>";
            text += "        			<div class='col-8 qhleft'>Déficience en melatonine</div>";
            text += "        			<div id='colexpand61' class='col-1 qhright'></div>";
            text += "        		</th>";			
            text += "        	</tr>"; 
            text += "        	<tr name='gtr5'>";
            text += "      			<td class='qsubheader' colspan='2'>";
            text += "        			<div class='col-8 qhleft'>En ce moment,</div>";
            text += "        		</td>";			
            text += "        	</tr>";               
            text += "<?php                        
                        $text = "";
                        $titles = array(1=>"je me sens irritable, impatient(e) ou agressif(ve)",
                                           "je suis d’humeur changeante",
                                           "je suis stressé(e), je me sens dépassé(e) par des soucis personnels ou professionnels",
                                           "je suis attiré(e) par le sucré toute la journée",
                                           "j’ai des comportements addictifs (sport intensif, tabac, grignotage, alcool...)",
                                           "j’ai des difficultés à trouver le sommeil ou à me rendormir" 
                                   );
                        
                        $nb = count($titles);
                        $nb1 = 24;
                        for ($i = 1; $i <= $nb; $i++) {
                            $text .= "<tr name='gtr5'>";
                            $text .= "  <td class='qtd'>".$titles[$i]."</td>";
                            $text .= "  <td class='qtd'>";
                            $text .= "      <select id='g".$i+$nb1."' name='HO-resistance'>";
                            $text .= "          <option value='-1'>Selection</option>";
                            $text .= "          <option value='0'>Jamais</option>";
                            $text .= "          <option value='1'>Rarement</option>";
                            $text .= "          <option value='2'>Parfois</option>";
                            $text .= "          <option value='3'>Souvent</option>";
                            $text .= "      </select>";
                            $text .= "  </td>";
                            $text .= "</tr>";
                        }
                        
                        if($_SESSION["Data"]["level"]<=1){
                            $text .= "<tr name='gtr5'>";
                            $text .= "<td class='qtotal' colspan='2' id='gtt5'>Total</td>";
                            $text .= "</tr>";
                        }
                        echo $text;
                    ?>"; 
            text += "       </table>";            
            text += "   </div>";
            text += "</div>"; 
                                    
            $('#formGB').append(text);

            $('#colexpand18').click(function(){
        		$('tr[name="gtr1"]').toggle();      		      		
            });
            
            $('#colexpand57').click(function(){
        		$('tr[name="gtr2"]').toggle();
        		$('tr[name="gtr3"]').toggle();        		
        		$('tr[name="gtr4"]').toggle();        		
        		$('tr[name="gtr5"]').toggle();        		        		      		      		
            });
            
            $('#colexpand58').click(function(){
        		$('tr[name="gtr2"]').toggle();      		        		      		      		
            });
            
            $('#colexpand59').click(function(){
        		$('tr[name="gtr3"]').toggle();      		        		      		      		
            });
            
            $('#colexpand60').click(function(){
        		$('tr[name="gtr4"]').toggle();      		        		      		      		
            });
            
            $('#colexpand61').click(function(){
        		$('tr[name="gtr5"]').toggle();      		        		      		      		
            });                                                
            
            initGBForm(-1);
            attachGBTotal();
        } 
        
        function attachGBTotal(){
            <?php 
        		$nb = 30;
        		$text = "";
        		$j="";
        		for ($i = 1; $i <= $nb; $i++) {
        		    if($i==7) 
        		       $j=2;
        		    elseif($i==13)
        		       $j=3;
        		    elseif($i==19)
        		       $j=4;
        		    elseif($i==25)
        		       $j=5;
        		       
        		    $text .= " $('#g".$i."').on('change', function(){gtotal".$j."();});";
        		}
        		echo $text;
    		?>        
        }        

        var gtt1 = gtt2 = gtt3 = gtt4 = gtt5 = 0 ;
        function gtotal(){
           <?php
                $nb = 6;
                $text = " gtt1 = ";
                for ($i = 1; $i <= $nb; $i++) {
                    $text .= "(($('#g$i').find(':selected').val()==-1)?0:parseInt($('#g$i').find(':selected').val()))  ";
                    if ($i<$nb)
                        $text .= "+";
                }
                $text .= "; ";
                echo $text;
           ?>
           $('#gtt1').text('Total	 '+gtt1);
           $("#output").hide();
        }

        function gtotal2(){
           <?php
                $nb = 12;
                $text = "gtt2 = ";
                for ($i = 6; $i <= $nb; $i++) {
                    $text .= "(($('#g$i').find(':selected').val()==-1)?0:parseInt($('#g$i').find(':selected').val()))  ";
                    if ($i<$nb)
                        $text .= "+";
                }
                $text .= "; ";
                echo $text;
           ?>           
           $('#gtt2').text('Total	 '+gtt2);
           $("#output").hide(); 
        }
        
        function gtotal3(){
           <?php
                $nb = 18;
                $text = "gtt3 = ";
                for ($i = 12; $i <= $nb; $i++) {
                    $text .= "(($('#g$i').find(':selected').val()==-1)?0:parseInt($('#g$i').find(':selected').val()))  ";
                    if ($i<$nb)
                        $text .= "+";
                }
                $text .= "; ";
                echo $text;
           ?> 
           $('#gtt3').text('Total	 '+gtt3);
           $("#output").hide();
        }        

        function gtotal4(){
           <?php
                $nb = 24;
                $text = "gtt4 = ";
                for ($i = 18; $i <= $nb; $i++) {
                    $text .= "(($('#g$i').find(':selected').val()==-1)?0:parseInt($('#g$i').find(':selected').val()))  ";
                    if ($i<$nb)
                        $text .= "+";
                }
                $text .= "; ";
                echo $text;
           ?>           
           $('#gtt4').text('Total	 '+gtt4);
           $("#output").hide(); 
        }
        
        function gtotal5(){
           <?php
                $nb = 30;
                $text = "gtt5 = ";
                for ($i = 24; $i <= $nb; $i++) {
                    $text .= "(($('#g$i').find(':selected').val()==-1)?0:parseInt($('#g$i').find(':selected').val()))  ";
                    if ($i<$nb)
                        $text .= "+";
                }
                $text .= "; ";
                echo $text;
           ?> 
           $('#gtt5').text('Total	 '+gtt5);
           $("#output").hide();
        }
                
        function initGBForm(uid){
        	$.ajax({
                url:"include/pages/initGB.php",
                type:"POST",
                data:{
                	id:uid
                },
                beforeSend:function(){
                  $("#zoneloader").show();
                  $("#output").hide();
                },
                success:function(data)
                {
    				setGBForm(data);
                    $("#output").show();
                    $("#zoneloader").hide();					
                }
           });
        }

        function setGBForm(data){	
         	var stringdata = JSON.parse(data);
         	var gtt1 = gtt2 = gtt3 = gtt4 = gtt5 = 0;
         	var tab = "<table class='datas'>";
         	var i=1; 
			for(var x in stringdata)
			{
				if(i<=6){
					tab += "<tr name='gtr1'><td>"+x+"</td><td>"+stringdata[x]+"</td></tr>";
					gtt1 = gtt1 + ((stringdata[x]=='-1')?0:parseInt(stringdata[x]));
				}else if(i>6 && i<=12){
					tab += "<tr name='gtr2'><td>"+x+"</td><td>"+stringdata[x]+"</td></tr>";
					gtt2 = gtt2 + ((stringdata[x]=='-1')?0:parseInt(stringdata[x]));
				}else if(i>12 && i<=18){					
					tab += "<tr name='gtr3'><td>"+x+"</td><td>"+stringdata[x]+"</td></tr>";
					gtt3 = gtt3 + ((stringdata[x]=='-1')?0:parseInt(stringdata[x]));
				}else if(i>18 && i<=24){
					tab += "<tr name='gtr4'><td>"+x+"</td><td>"+stringdata[x]+"</td></tr>";
					gtt4 = gtt4 + ((stringdata[x]=='-1')?0:parseInt(stringdata[x]));
				}else{					
					tab += "<tr name='gtr5'><td>"+x+"</td><td>"+stringdata[x]+"</td></tr>";
					gtt5 = gtt5 + ((stringdata[x]=='-1')?0:parseInt(stringdata[x]));
				}
									
				$('#'+x).val(stringdata[x]);							
    			i++;
			}
			
			$('#gtt1').text('Total	 '+gtt1);
			$('#gtt2').text('Total	 '+gtt2);
			$('#gtt3').text('Total	 '+gtt3);
			$('#gtt4').text('Total	 '+gtt4);
			$('#gtt5').text('Total	 '+gtt5);			
							 
			tab +="</table>";			
						
			$('#jsonDataGB').html(tab);
            enableForm(7);
            			
        	formLGSDisplay();			
        }
                
        
 
        /* ------------------------------------------------------------------------------ */
        /* --------------------------- Formulaire LGS ----------------------------------- */ 
        /* ------------------------------------------------------------------------------ */   
        
        function formLGSDisplay(){
        	var text="";
        	text += "<div class='row'>";
            text += " 	<div class='col-11'>";
            text += "  		<table class='qtable'>";
            text += "        	<tr>";
            text += "      			<th class='qheader'>";
            text += "        			<div class='col-8 qhleft'>Evaluation du LGS</div>";
            text += "        			<div id='colexpand19' class='col-1 qhright'></div>";
            text += "        		</th>";			
            text += "        	</tr>";            
            text += "<?php                        
                        $text = "";
                        $titles = array(1=>array("A. Antécédents familiaux","Avez-vous un antécédent familial (père, mère ou frère, soeur) qui ait présenté une ou des infections suivantes :"),
                                           array("B. Antécédents personnels","Avez-vous un antécédent personnel parmi les infections suivantes :"),
                                           array("C. Actuellement êtes-vous sujet à une des pertubations suivantes :",""),
                                           array("D. Actuellement présentez-vous ?</b>","")
                        );
                        $options = array(1=>array("Allergie","Diabète","Maladie de Crohn","Maladie coeliaque","Rhumatisme inflammatoire","Psoriasis"),
                                            array("Allergie","Intolérance au lait","Eczéma","Urticaire","Asthme","Infection digestive"),
                                            array("Trouble digestif fréquent","Fatigue permamente","Troubles de l'humeur","Infections récidivantes","Problèmes de peau","Douleurs traînantes des articulations","Migraines récidivantes"),
                                            array("Une intolérance alimentaire","Une intolérance au gluten","Un rhumatisme inflammatoire","Un diabète","Une maladie digestive","De l'asthme","Une maladie de la peau")                          
                        );
                        
                        $nb = count($titles);
                        $j=1;
                        for ($i = 1; $i <= $nb; $i++) {
                            $listOptions = $options[$i];
                            $text .= "<tr name='ltr1'>";
                            $text .= "  <td class='qheader2'><div  class='qtd' style='display:block'>".$titles[$i][0]."</div></td></tr>";
                            
                            if($i<=2)
                                $text .= "<tr name='ltr1'><td class='nopadding'><div  class='qtd' style='display:block'>".$titles[$i][1]."</div></td></tr>";
                            
                            $text .= "<tr name='ltr1'>";
                            $text .= "  <td class='qtd'>";
                            
                            foreach ($listOptions as $key => $txt)
                                $text .= "  <div style='display:block;padding:5px;'><input id='l".$j++."' type='checkbox' name='LGS' value='$key'><label>$txt</label></div>";
                            $text .= "  </td>";
                            $text .= "</tr>";
                                                      
                            if($_SESSION["Data"]["level"]<=1){
                                $text .= "<tr name='ltr1'>";
                                $text .= "<td class='qtotal' colspan='2' id='ltt$i'>Total</td>";
                                $text .= "</tr>";
                            }
                        }
                        echo $text;
                    ?>";
            text += "			<tr name='ltr1'><td><div id='ltotal' style='float:right;'>Total global : </div></td></tr>";        
            text += "       </table>";            
            text += "   </div>";
            text += "</div>";
            
            $('#formLGS').append(text);

            $('#colexpand19').click(function(){
        		$('tr[name="ltr1"]').toggle();      		      		
            });
            
            attachLGSInputs();
            
            initLGSForm(-1);
        } 
        
        function initLGSForm(uid){
        	$.ajax({
                url:"include/pages/initLGS.php",
                type:"POST",
                data:{
                	id:uid
                },
                beforeSend:function(){
                  $("#zoneloader").show();
                  $("#output").hide();
                },
                success:function(data)
                {
    				setLGSForm(data);
                    $("#output").show();
                    $("#zoneloader").hide();					
                }
           });
        }

        function setLGSForm(data){
         	var stringdata = JSON.parse(data);
         	var tab = "<table class='datas'>";
         	var value=false;
			for(var x in stringdata)
			{
				tab += "<tr name='ltr1'><td>"+x+"</td><td>"+stringdata[x]+"</td></tr>";	
				if(stringdata[x]==1) value=true;
				else value = false;								
				$('#'+x).prop("checked", value);
			} 
			tab +="</table>";			
			$('#jsonDataLGS').html(tab);
			ltotal();
            enableForm(8);
            	
	        formSPADisplay();			
        }
        
        function ltotal(){
        	var total = ltt1 = ltt2 = ltt3 = ltt4 = 0;
        	for(var i=1;i<=26;i++){      		
        		if($('#l'+i).is(":checked")){
        			if(i<=6)
        				ltt1++;
        			else if(i>6 && i<=12)
        				ltt2++;
        			else if(i>12 && i<=19)
        				ltt3++;
        			else
        				ltt4++;      			        		
        		}
        	}
        	total = ltt1 + ltt2 + ltt3 + ltt4;
        	$('#ltt1').html("Total : "+ltt1);
        	$('#ltt2').html("Total : "+ltt2);
        	$('#ltt3').html("Total : "+ltt3);
        	$('#ltt4').html("Total : "+ltt4);        	       	        	
        	$('#ltotal').html("Total global : "+total);
        }
        
        function attachLGSInputs(){
    		<?php 
        		$nb = 26;
        		$text = "";
        		for ($i = 1; $i <= $nb; $i++) {
        		    $text .= "$('#l$i').on('change', function() {";
        		    $text .= "    ltotal()";
        		    $text .= "}); ";
        		}
        		echo $text;
    		?>             
        }         
                

                
        /* ------------------------------------------------------------------------------ */
        /* --------------------------- Formulaire Spasmophile --------------------------- */ 
        /* ------------------------------------------------------------------------------ */   
        
        function formSPADisplay(){
        	var text="";
        	text += "<div class='row'>";
            text += " 	<div class='col-11'>";
            text += "  		<table class='qtable'>";
            text += "        	<tr>";
            text += "      			<th class='qheader'>";
            text += "        			<div class='col-8 qhleft'>Evaluation de la spasmophile</div>";
            text += "        			<div id='colexpand20' class='col-1 qhright'></div>";
            text += "        		</th>";			
            text += "        	</tr>";
            text += "        	<tr>";
            text += "      			<th class='qheader2'>";
            text += "        			<div class='col-8 qhleft'>Première partie</div>";
            text += "        			<div id='colexpand21' class='col-1 qhright'></div>";
            text += "        		</th>";			
            text += "        	</tr>";
            text += "        	<tr name='mtr1'>";
            text += "      			<td colspan='2' class='nopadding'>";
            text += "        			<div class='qtd'>Avez-vous eu dans votre passé :</div>";
            text += "        		</td>";			
            text += "        	</tr>";                                      
            text += "<?php                        
                        $text = "";
                        $titles = array(1=>"Crampes fourmillements",
                                           "Boule dans la gorge, lagorge qui serre",
                                           "Crampes d'estomac",
                                           "Collites ballonnements",
                                           "Douleurs de règles",
                                           "Crispations des machoires",
                                           "Phosphènes, acouphènes",
                                           "Douleurs musculaires"
                                   );
                        
                        $nb = count($titles);
                        for ($i = 1; $i <= $nb; $i++) {
                            $text .= "<tr name='mtr1'>";
                            $text .= "  <td class='qtd'>".$titles[$i]."</td>";
                            $text .= "  <td class='qtd'>";
                            $text .= "      <select id='m".$i."' name='HO-resistance'>";
                            $text .= "          <option value='0'>Non</option>";
                            $text .= "          <option value='1'>Oui</option>";
                            $text .= "      </select>";
                            $text .= "  </td>";
                            $text .= "</tr>";
                        }
                        
                        if($_SESSION["Data"]["level"]<=1){
                            $text .= "<tr name='mtr1'>";
                            $text .= "<td class='qtotal' colspan='2' id='mtt1'>Total</td>";
                            $text .= "</tr>";
                        }
                        
                        echo $text;
                    ?>";
                    
            text += "       </table>";            
            text += "   </div>";
            text += "</div><br><br>";

        	text += "<div class='row'>";
            text += " 	<div class='col-11'>";
            text += "  		<table class='qtable'>";
            text += "        	<tr>";
            text += "      			<th class='qheader2'>";
            text += "        			<div class='col-8 qhleft'>Deuxième partie</div>";
            text += "        			<div id='colexpand22' class='col-1 qhright'></div>";
            text += "        		</th>";			
            text += "        	</tr>"; 
            text += "        	<tr name='mtr2'>";
            text += "      			<td colspan='2' class='nopadding'>";
            text += "        			<div class='qtd'>Avez-vous eu dans votre passé :</div>";
            text += "        		</td>";			
            text += "        	</tr>";                                      
            text += "<?php                        
                        $text = "";
                        $titles = array(1=>"Fatigue plus importante le matin que le soir",
                                           "Tachycardie, palpitations",
                                           "Oppression respiratoire",
                                           "Troubles du sommeil",
                                           "Hypersensibilité à l'environnement"
                                   );
                        
                        $nb = count($titles);
                        $nb1 = 8;
                        for ($i = 1; $i <= $nb; $i++) {
                            $text .= "<tr name='mtr2'>";
                            $text .= "  <td class='qtd'>".$titles[$i]."</td>";
                            $text .= "  <td class='qtd'>";
                            $text .= "      <select id='m".$i+$nb1."' name='HO-resistance'>";
                            $text .= "          <option value='0'>Non</option>";
                            $text .= "          <option value='1'>Oui</option>";
                            $text .= "      </select>";
                            $text .= "  </td>";
                            $text .= "</tr>";
                        }
                        
                        if($_SESSION["Data"]["level"]<=1){
                            $text .= "<tr name='mtr2'>";
                            $text .= "<td class='qtotal' colspan='2' id='mtt2'>Total</td>";
                            $text .= "</tr>";
                        }
                        
                        echo $text;
                    ?>";
                    
            text += "       </table>";            
            text += "   </div>";
            text += "</div>";     
                   
            $('#formSPA').append(text);

            $('#colexpand20').click(function(){
        		$('tr[name="mtr1"]').toggle();
        		$('tr[name="mtr2"]').toggle();        		      		      		
            });
            
            $('#colexpand21').click(function(){
        		$('tr[name="mtr1"]').toggle();      		      		      		
            });
            
            $('#colexpand22').click(function(){
        		$('tr[name="mtr2"]').toggle();        		      		      		
            });                        
            
            initSPAForm(-1);
            attachSPATotal();
        }
        
        function attachSPATotal(){
            <?php 
        		$nb = 13;
        		$text = "";
        		for ($i = 1; $i <= $nb; $i++) {
        		    if($i<=8)
        		        $text .= " $('#m".$i."').on('change', function(){sptotal1();});";
        		    else
        		        $text .= " $('#m".$i."').on('change', function(){sptotal2();});";
        		}
        		echo $text;
    		?>        
        }
        
        function sptotal1(){
           <?php
                $nb = 8;
                $text = "var yes = no = 0; var mtt;";
                for ($i = 1; $i <= $nb; $i++) {
                    $text .= "mtt = parseInt($('#m$i').find(':selected').val());  ";
                    $text .= "if(mtt==1)"; 
                    $text .= "   yes++;";
                    $text .= "else ";
                    $text .= " no++;";                    
                }
                echo $text;
           ?> 
		   $('#mtt1').text('Total	oui : '+yes+'      Non : '+no);	
           $("#output").hide();
        }
        
        function sptotal2(){
           <?php
                $nb = 13;
                $text = "var yes = no = 0; var mtt;";
                for ($i = 9; $i <= $nb; $i++) {
                    $text .= "mtt = parseInt($('#m$i').find(':selected').val());  ";
                    $text .= "if(mtt==1)"; 
                    $text .= "   yes++;";
                    $text .= "else ";
                    $text .= " no++;";                    
                }
                echo $text;
           ?> 
		   $('#mtt2').text('Total	oui : '+yes+'      Non : '+no);	
           $("#output").hide();
        }                 
        
        function initSPAForm(uid){
        	$.ajax({
                url:"include/pages/initSPA.php",
                type:"POST",
                data:{
                	id:uid
                },
                beforeSend:function(){
                  $("#zoneloader").show();
                  $("#output").hide();
                },
                success:function(data)
                {
    				setSPAForm(data);
                    $("#output").show();
                    $("#zoneloader").hide();					
                }
           });
        }

        function setSPAForm(data){
         	var stringdata = JSON.parse(data);
         	var yes1 = yes2 = no1 = no2 = 0;
         	var tab = "<table class='datas'>";
         	var i=1; 
			for(var x in stringdata)
			{
				if(i<=8){
					tab += "<tr name='mtr1'><td>"+x+"</td><td>"+stringdata[x]+"</td></tr>";
    				if(stringdata[x] == 1)
    					yes1++;
    				else
    					no1++;	
				}else{
					tab += "<tr name='mtr2'><td>"+x+"</td><td>"+stringdata[x]+"</td></tr>";
    				if(stringdata[x] == 1)
    					yes2++;
    				else
    					no2++;				
				}									
				$('#'+x).val(stringdata[x]);
				i++;
			} 
			
			$('#mtt1').text('Total	oui : '+yes1+'      Non : '+no1);
			$('#mtt2').text('Total	oui : '+yes2+'      Non : '+no2);						
			tab +="</table>";			
			$('#jsonDataSPA').html(tab);
            enableForm(9);
            			
			formSOMDisplay();
        }
                

        
        
        /* ------------------------------------------------------------------------------- */
        /* --------------------------- Formulaire Sommeil -------------------------------- */ 
        /* ------------------------------------------------------------------------------- */   
        
        function formSOMDisplay(){
        	var text="";
        	text += "<div class='row'>";
            text += " 	<div class='col-11'>";
            text += "  		<table class='qtable'>";
            text += "        	<tr>";
            text += "      			<th class='qheader'>";
            text += "        			<div class='col-8 qhleft'>Evaluation du sommeil</div>";
            text += "        			<div id='colexpand23' class='col-1 qhright'></div>";
            text += "        		</th>";			
            text += "        	</tr>";                          
            text += "<?php                        
                        $text = "";
                        $titles = array(1=>"Quand vient l'heure d'aller vous coucher, comment évaluez-vous votre fatigue ?",
                                           "Combien de temps vous faut-il pour vous endormir ?",
                                           "En général vous dormez :",
                                           "Combien de fois par semaine avez-vous le sentiment de mal dormir ?",
                                           "Dormez-vous profondement toute la nuit ?",
                                           "Rêvez-vous ?",
                                           "Comment vous sentez-vous quand le reveil sonne ?",
                                           "Combien de temps vous faut-il avant d'émerger ?",
                                           "Comment vous sentez-vous pendant la journée ?",                     
                                           "Vous faites une sieste :"
                        );
                        
                        $options = array(1=>array('r'=>"Vous n'avez pas vraiment sommeil mais vous essayer de dormir.",
                                                  'v'=>"Vous êtes fatigué, vos paupières sont lourdes et vous ressentez le besoin de vous allonger.",
                                                  'b'=>"Vous débordez d'énergie, pas question de dormir."),
                                            array('v'=>"Vous vous endormez presque immédiatement.",
                                                  'r'=>"Cela vous prend au moins 30 minutes.",
                                                  'b'=>"Vous avez l'impression que cela prend des heures."),
                                            array('b'=>"Moins de 4h30.",
                                                  'r'=>"Entre 4 heures et 7h30.",
                                                  'v'=>"Plus de 7h30."),
                                            array('v'=>"Jamais.",
                                                  'r'=>"Cela vous arrive 1 à 2 fois par semaine.",
                                                  'b'=>"Presque toutes les nuits."),
                                            array('v'=>"Oui, sans interruptions",
                                                  'r'=>"Vous vous réveillez de temps en temps mais arrivez facilement à retrouver le sommeil.",
                                                  'b'=>"Vous vous réveillez fréquement et peinez à vous rendormir."),
                                            array('b'=>"Jamais.",
                                                  'r'=>"Parfois, mais vous ne vous souvenez peu de vos rêves.",
                                                  'v'=>"Oui et arrivez avec précision à les raconter le lendemain."),
                                            array('v'=>"Vous n'avez pas besoin de reveil, vous vous réveillez spontanément tous les matins.", 
                                                  'r'=>"C'est difficile, vous avez besoin d'une dizaine de minutes avant de sortir du lit.",
                                                  'b'=>"Vous ressentez comme un mal-être : Vous n'avez pas de force pour vous lever."),
                                            array('v'=>"Moins de 10 minutes, vous êtes prêts à affronter la journée.",
                                                  'r'=>"Vous vous sentez mieux après le petit-déjeuner.",
                                                  'b'=>"Vous commencez seulement à être efficace vers midi."),
                                            array('v'=>"Hyperactif et débordant d'énergie",
                                                  'r'=>"Vous ressentez un pic de fatigue en début d'après-midi.",
                                                  'b'=>"Fatigué, irrité au point de somnoler dans le vouloir."),                                           
                                            array('v'=>"Tous les jours.",
                                                  'r'=>"Environ 3 fois par semaine",
                                                  'b'=>"Jamais.")                          
                        );
                        
                        $nb = count($titles);
                        $j=1;
                        for ($i = 1; $i <= $nb; $i++) {
                            $listOptions = $options[$i];
                            $text .= "<tr name='otr1'>";
                            $text .= "  <td class='qtd'><div class='qsubheader' style='display:block'>".$titles[$i]."</div>";
                            foreach ($listOptions as $key => $txt)
                                $text .= "  <div style='display:block;padding:5px;'><input id='so$i"."_".$j++."' type='radio' name='SOM$i' value='$key'><label>$txt</label></div>";
                            $j=1;
                            $text .= "<input id='so$i' type='hidden' value=''>";
                            $text .= "  </td>";
                            $text .= "</tr>";
                        }
                        echo $text;
                    ?>";                 
            text += "       </table>";            
            text += "   </div>";
            text += "</div>";   
                   
            $('#formSOM').append(text);

            $('#colexpand23').click(function(){
        		$('tr[name="otr1"]').toggle();       		      		      		
            });                        
            
            initSOMForm(-1);
            
            attachSOMInput();
        } 
        
        function attachSOMInput(){    		
        	$("input[type=radio][id^='so']").each(function() {
                $(this).click(function(){
                    var did = $(this).attr("id");
        			var id = did.split("_");
            		var value = $(this).val();
            		$('#'+id[0]).val(value);
                });
            });    		      	
        }
        
        function initSOMForm(uid){
        	$.ajax({
                url:"include/pages/initSOM.php",
                type:"POST",
                data:{
                	id:uid
                },
                beforeSend:function(){
                  $("#zoneloader").show();
                  $("#output").hide();
                },
                success:function(data)
                {
    				setSOMForm(data);
                    $("#output").show();
                    $("#zoneloader").hide();					
                }
           });
        }

        function setSOMForm(data){
         	var stringdata = JSON.parse(data);
         	var tab = "<table class='datas'>";
         	var i=1;
			for(var x in stringdata)
			{
				tab += "<tr name='otr1'><td>"+x+"</td><td>"+stringdata[x]+"</td></tr>";		
				for(var j=1;j<=3;j++){
					if($('#so'+i+'_'+j).val()==stringdata[x])
						$('#so'+i+'_'+j).attr('checked', true);
				}
				i++;
			} 
			tab +="</table>";			
			$('#jsonDataSOM').html(tab);
            enableForm(10);
            			
			formDTXDisplay();
        }
                

    	/* ------------------------------------------------------------- */
    	/* ----------------- formulaire DETOX -------------------------- */
    	/* ------------------------------------------------------------- */
        
        function formDTXDisplay(){
        	var text="";
        	text += "<div class='row'>";
            text += " 	<div class='col-11'>";
            text += "  		<table class='qtable'>";
            text += "        	<tr>";
            text += "      			<th class='qheader'>";
            text += "        			<div class='col-8 qhleft'>Evaluation de la Détoxication</div>";
            text += "        		</th>";			
            text += "        	</tr>";                    	
            text += "        	<tr>";
            text += "      			<td class='qtd'>";
            text += "        			<div class='col-8 qhleft'>Estimer chacun des symptômes suivants pour la période des 30 derniers jours.</div>";
            text += "        		</td>";			
            text += "        	</tr>";
            text += "       </table>";            
            text += "   </div>";
            text += "</div><br>";
                                	
        	text += "<div class='row'>";
            text += " 	<div class='col-11'>";
            text += "  		<table class='qtable'>";
            text += "        	<tr>";
            text += "      			<th class='qheader' colspan='2'>";
            text += "        			<div class='col-8 qhleft'>Les symptômes médicaux</div>";
            text += "        			<div id='colexpand24' class='col-1 qhright'></div>";
            text += "        		</th>";			
            text += "        	</tr>";
            text += "        	<tr>";
            text += "      			<th class='qheader2' colspan='2'>";
            text += "        			<div class='col-8 qhleft'>Tête</div>";
            text += "        			<div id='colexpand26' class='col-1 qhright'></div>";
            text += "        		</th>";			
            text += "        	</tr>";                       
            text += "<?php                        
                        $text = "";
                        $titles = array(1=>"Maux de tête",
                                           "Sensations d'évanoussement",
                                           "Vertiges",
                                           "Insomnies"
                                   );
                        
                        $nb = count($titles);
                        for ($i = 1; $i <= $nb; $i++) {
                            $text .= "<tr name='xtr1'>";
                            $text .= "  <td class='qtd'>".$titles[$i]."</td>";
                            $text .= "  <td class='qtd'>";
                            $text .= "      <select id='x".$i."' name='HO-resistance'>";
                            $text .= "          <option value='0'>Selection</option>";
                            $text .= "          <option value='1'>Jamais ou presque jamais</option>";
                            $text .= "          <option value='2'>De temps en temps, mais peu intense</option>";
                            $text .= "          <option value='3'>De temps en temps, mais intense</option>";
                            $text .= "          <option value='4'>Souvent mais peu intense</option>";
                            $text .= "          <option value='5'>Souvent et intense</option>";
                            $text .= "      </select>";
                            $text .= "  </td>";
                            $text .= "</tr>";
                        }
                        
                        if($_SESSION["Data"]["level"]<=1){
                            $text .= "<tr name='xtr1'>";
                            $text .= "<td class='qtotal' colspan='2' id='xtt1'>Total</td>";
                            $text .= "</tr>";
                        }
                        
                        echo $text;
                    ?>";
            text += "       </table>";            
            text += "   </div>";
            text += "</div><br>";

        	text += "<div class='row'>";
            text += " 	<div class='col-11'>";
            text += "  		<table class='qtable'>";
            text += "        	<tr>";
            text += "      			<th class='qheader2' colspan='2'>";
            text += "        			<div class='col-8 qhleft'>Peau</div>";
            text += "        			<div id='colexpand27' class='col-1 qhright'></div>";
            text += "        		</th>";			
            text += "        	</tr>"; 
            text += "<?php                        
                        $text = "";
                        $titles = array(1=>"Acné",
                                           "Plaques qui démangent, éruption, peau sèche",
                                           "Perte de cheveux",
                                           "Rougeurs, bouffées de chaleur",
                                           "Transpiration excessive"
                                   );
                        
                        $nb = count($titles);
                        $nb1 = 4;
                        for ($i = 1; $i <= $nb; $i++) {
                            $text .= "<tr name='xtr2'>";
                            $text .= "  <td class='qtd'>".$titles[$i]."</td>";
                            $text .= "  <td class='qtd'>";
                            $text .= "      <select id='x".$i+$nb1."' name='HO-resistance'>";
                            $text .= "          <option value='0'>Selection</option>";
                            $text .= "          <option value='1'>Jamais ou presque jamais</option>";
                            $text .= "          <option value='2'>De temps en temps, mais peu intense</option>";
                            $text .= "          <option value='3'>De temps en temps, mais intense</option>";
                            $text .= "          <option value='4'>Souvent mais peu intense</option>";
                            $text .= "          <option value='5'>Souvent et intense</option>";
                            $text .= "      </select>";
                            $text .= "  </td>";
                            $text .= "</tr>";
                        }
                        
                        if($_SESSION["Data"]["level"]<=1){
                            $text .= "<tr name='xtr2'>";
                            $text .= "<td class='qtotal' colspan='2' id='xtt2'>Total</td>";
                            $text .= "</tr>";
                        }
                        echo $text;
                    ?>";
            text += "       </table>";            
            text += "   </div>";
            text += "</div><br>"; 
                       
        	text += "<div class='row'>";
            text += " 	<div class='col-11'>";
            text += "  		<table class='qtable'>";
            text += "        	<tr>";
            text += "      			<th class='qheader2' colspan='2'>";
            text += "        			<div class='col-8 qhleft'>Poids</div>";
            text += "        			<div id='colexpand28' class='col-1 qhright'></div>";
            text += "        		</th>";			
            text += "        	</tr>"; 
            text += "<?php                        
                        $text = "";
                        $titles = array(1=>"Envie de manger ou de boire",
                                           "Attirance +++ pour certains aliments",
                                           "Poids excessif",
                                           "Compulsion alimentaire",
                                           "Rétention d’eau",
                                           "Poids insuffisant"
                                   );
                        
                        $nb = count($titles);
                        $nb1 = 9;
                        for ($i = 1; $i <= $nb; $i++) {
                            $text .= "<tr name='xtr3'>";
                            $text .= "  <td class='qtd'>".$titles[$i]."</td>";
                            $text .= "  <td class='qtd'>";
                            $text .= "      <select id='x".$i+$nb1."' name='HO-resistance'>";
                            $text .= "          <option value='0'>Selection</option>";
                            $text .= "          <option value='1'>Jamais ou presque jamais</option>";
                            $text .= "          <option value='2'>De temps en temps, mais peu intense</option>";
                            $text .= "          <option value='3'>De temps en temps, mais intense</option>";
                            $text .= "          <option value='4'>Souvent mais peu intense</option>";
                            $text .= "          <option value='5'>Souvent et intense</option>";
                            $text .= "      </select>";
                            $text .= "  </td>";
                            $text .= "</tr>";
                        }
                        if($_SESSION["Data"]["level"]<=1){
                            $text .= "<tr name='xtr3'>";
                            $text .= "<td class='qtotal' colspan='2' id='xtt3'>Total</td>";
                            $text .= "</tr>";
                        }
                        echo $text;
                    ?>";
            text += "       </table>";            
            text += "   </div>";
            text += "</div><br>";
            
        	text += "<div class='row'>";
            text += " 	<div class='col-11'>";
            text += "  		<table class='qtable'>";
            text += "        	<tr>";
            text += "      			<th class='qheader2' colspan='2'>";
            text += "        			<div class='col-8 qhleft'>Yeux</div>";
            text += "        			<div id='colexpand29' class='col-1 qhright'></div>";
            text += "        		</th>";			
            text += "        	</tr>"; 
            text += "<?php                        
                        $text = "";
                        $titles = array(1=>"Qui pleurent ou qui démangent",
                                           "Gonflés, paupières rouges ou « collantes »",
                                           "Poches ou cernes sous les yeux",
                                           "vue trouble ou en tunnel (n’inclut pas, de près ou de loin, les problèmes de malvoyance)"
                                   );
                        
                        $nb = count($titles);
                        $nb1 = 15;
                        for ($i = 1; $i <= $nb; $i++) {
                            $text .= "<tr name='xtr4'>";
                            $text .= "  <td class='qtd'>".$titles[$i]."</td>";
                            $text .= "  <td class='qtd'>";
                            $text .= "      <select id='x".$i+$nb1."' name='HO-resistance'>";
                            $text .= "          <option value='0'>Selection</option>";
                            $text .= "          <option value='1'>Jamais ou presque jamais</option>";
                            $text .= "          <option value='2'>De temps en temps, mais peu intense</option>";
                            $text .= "          <option value='3'>De temps en temps, mais intense</option>";
                            $text .= "          <option value='4'>Souvent mais peu intense</option>";
                            $text .= "          <option value='5'>Souvent et intense</option>";
                            $text .= "      </select>";
                            $text .= "  </td>";
                            $text .= "</tr>";
                        }
                        
                        if($_SESSION["Data"]["level"]<=1){
                            $text .= "<tr name='xtr4'>";
                            $text .= "<td class='qtotal' colspan='2' id='xtt4'>Total</td>";
                            $text .= "</tr>";
                        }
                        echo $text;
                    ?>";
            text += "       </table>";            
            text += "   </div>";
            text += "</div><br>"; 
                       
        	text += "<div class='row'>";
            text += " 	<div class='col-11'>";
            text += "  		<table class='qtable'>";
            text += "        	<tr>";
            text += "      			<th class='qheader2' colspan='2'>";
            text += "        			<div class='col-8 qhleft'>Coeur</div>";
            text += "        			<div id='colexpand30' class='col-1 qhright'></div>";
            text += "        		</th>";			
            text += "        	</tr>"; 
            text += "<?php                        
                        $text = "";
                        $titles = array(1=>"Pouls irrégulier / qui 'saute'",
                                           "Qui bat trop vite",
                                           "Douleur à la poitrine"
                                   );
                        
                        $nb = count($titles);
                        $nb1 = 19;
                        for ($i = 1; $i <= $nb; $i++) {
                            $text .= "<tr name='xtr5'>";
                            $text .= "  <td class='qtd'>".$titles[$i]."</td>";
                            $text .= "  <td class='qtd'>";
                            $text .= "      <select id='x".$i+$nb1."' name='HO-resistance'>";
                            $text .= "          <option value='0'>Selection</option>";
                            $text .= "          <option value='1'>Jamais ou presque jamais</option>";
                            $text .= "          <option value='2'>De temps en temps, mais peu intense</option>";
                            $text .= "          <option value='3'>De temps en temps, mais intense</option>";
                            $text .= "          <option value='4'>Souvent mais peu intense</option>";
                            $text .= "          <option value='5'>Souvent et intense</option>";
                            $text .= "      </select>";
                            $text .= "  </td>";
                            $text .= "</tr>";
                        }
                        
                        if($_SESSION["Data"]["level"]<=1){
                            $text .= "<tr name='xtr5'>";
                            $text .= "<td class='qtotal' colspan='2' id='xtt5'>Total</td>";
                            $text .= "</tr>";
                        }
                        echo $text;
                    ?>";
            text += "       </table>";            
            text += "   </div>";
            text += "</div><br>";

        	text += "<div class='row'>";
            text += " 	<div class='col-11'>";
            text += "  		<table class='qtable'>";
            text += "        	<tr>";
            text += "      			<th class='qheader2' colspan='2'>";
            text += "        			<div class='col-8 qhleft'>Energie / Activité</div>";
            text += "        			<div id='colexpand31' class='col-1 qhright'></div>";
            text += "        		</th>";			
            text += "        	</tr>"; 
            text += "<?php                        
                        $text = "";
                        $titles = array(1=>"Fatigue, mou /molle, lent(e)",
                                           "Apathie, léthargie",
                                           "Hyperactivité",
                                           "Agité, tourmenté"
                                   );
                        
                        $nb = count($titles);
                        $nb1 = 22;
                        for ($i = 1; $i <= $nb; $i++) {
                            $text .= "<tr name='xtr6'>";
                            $text .= "  <td class='qtd'>".$titles[$i]."</td>";
                            $text .= "  <td class='qtd'>";
                            $text .= "      <select id='x".$i+$nb1."' name='HO-resistance'>";
                            $text .= "          <option value='0'>Selection</option>";
                            $text .= "          <option value='1'>Jamais ou presque jamais</option>";
                            $text .= "          <option value='2'>De temps en temps, mais peu intense</option>";
                            $text .= "          <option value='3'>De temps en temps, mais intense</option>";
                            $text .= "          <option value='4'>Souvent mais peu intense</option>";
                            $text .= "          <option value='5'>Souvent et intense</option>";
                            $text .= "      </select>";
                            $text .= "  </td>";
                            $text .= "</tr>";
                        }
                        
                        if($_SESSION["Data"]["level"]<=1){
                            $text .= "<tr name='xtr6'>";
                            $text .= "<td class='qtotal' colspan='2' id='xtt6'>Total</td>";
                            $text .= "</tr>";
                        }
                        echo $text;
                    ?>";
            text += "       </table>";            
            text += "   </div>";
            text += "</div><br>"; 
                       
        	text += "<div class='row'>";
            text += " 	<div class='col-11'>";
            text += "  		<table class='qtable'>";
            text += "        	<tr>";
            text += "      			<th class='qheader2' colspan='2'>";
            text += "        			<div class='col-8 qhleft'>Oreilles</div>";
            text += "        			<div id='colexpand32' class='col-1 qhright'></div>";
            text += "        		</th>";			
            text += "        	</tr>"; 
            text += "<?php                        
                        $text = "";
                        $titles = array(1=>"Qui démangent",
                                           "Douleurs ou infections",
                                           "Ecoulement",
                                           "Compulsion alimentaire",
                                           "acouphènes (bruits dans les oreilles) ou diminution de l’audition"
                                   );
                        
                        $nb = count($titles);
                        $nb1 = 26;
                        for ($i = 1; $i <= $nb; $i++) {
                            $text .= "<tr name='xtr7'>";
                            $text .= "  <td class='qtd'>".$titles[$i]."</td>";
                            $text .= "  <td class='qtd'>";
                            $text .= "      <select id='x".$i+$nb1."' name='HO-resistance'>";
                            $text .= "          <option value='0'>Selection</option>";
                            $text .= "          <option value='1'>Jamais ou presque jamais</option>";
                            $text .= "          <option value='2'>De temps en temps, mais peu intense</option>";
                            $text .= "          <option value='3'>De temps en temps, mais intense</option>";
                            $text .= "          <option value='4'>Souvent mais peu intense</option>";
                            $text .= "          <option value='5'>Souvent et intense</option>";
                            $text .= "      </select>";
                            $text .= "  </td>";
                            $text .= "</tr>";
                        }
                        
                        if($_SESSION["Data"]["level"]<=1){
                            $text .= "<tr name='xtr7'>";
                            $text .= "<td class='qtotal' colspan='2' id='xtt7'>Total</td>";
                            $text .= "</tr>";
                        }
                        echo $text;
                    ?>";
            text += "       </table>";            
            text += "   </div>";
            text += "</div><br>";
            
        	text += "<div class='row'>";
            text += " 	<div class='col-11'>";
            text += "  		<table class='qtable'>";
            text += "        	<tr>";
            text += "      			<th class='qheader2' colspan='2'>";
            text += "        			<div class='col-8 qhleft'>Poumons</div>";
            text += "        			<div id='colexpand33' class='col-1 qhright'></div>";
            text += "        		</th>";			
            text += "        	</tr>"; 
            text += "<?php                        
                        $text = "";
                        $titles = array(1=>"Sifflements",
                                           "Asthme, bronchite",
                                           "Essoufflé",
                                           "Difficulté à respirer"
                                   );
                        
                        $nb = count($titles);
                        $nb1 = 31;
                        for ($i = 1; $i <= $nb; $i++) {
                            $text .= "<tr name='xtr8'>";
                            $text .= "  <td class='qtd'>".$titles[$i]."</td>";
                            $text .= "  <td class='qtd'>";
                            $text .= "      <select id='x".$i+$nb1."' name='HO-resistance'>";
                            $text .= "          <option value='0'>Selection</option>";
                            $text .= "          <option value='1'>Jamais ou presque jamais</option>";
                            $text .= "          <option value='2'>De temps en temps, mais peu intense</option>";
                            $text .= "          <option value='3'>De temps en temps, mais intense</option>";
                            $text .= "          <option value='4'>Souvent mais peu intense</option>";
                            $text .= "          <option value='5'>Souvent et intense</option>";
                            $text .= "      </select>";
                            $text .= "  </td>";
                            $text .= "</tr>";
                        }

                        if($_SESSION["Data"]["level"]<=1){
                            $text .= "<tr name='xtr8'>";
                            $text .= "<td class='qtotal' colspan='2' id='xtt8'>Total</td>";
                            $text .= "</tr>";
                        }
                        echo $text;
                    ?>";
            text += "       </table>";            
            text += "   </div>";
            text += "</div><br>"; 
                       
        	text += "<div class='row'>";
            text += " 	<div class='col-11'>";
            text += "  		<table class='qtable'>";
            text += "        	<tr>";
            text += "      			<th class='qheader2' colspan='2'>";
            text += "        			<div class='col-8 qhleft'>Cerveau</div>";
            text += "        			<div id='colexpand34' class='col-1 qhright'></div>";
            text += "        		</th>";			
            text += "        	</tr>"; 
            text += "<?php                        
                        $text = "";
                        $titles = array(1=>"Mauvaise mémoire",
                                           "Confusion, mauvaise compréhension",
                                           "Mauvaise concentration",
                                           "Mauvaise coordination physique",
                                           "Difficulté à prendre des décisions",
                                           "Bégaiement ou chercher ses mots",
                                           "Difficultés d’élocution",
                                           "Difficultés d’apprentissage"
                                   );
                        
                        $nb = count($titles);
                        $nb1 = 35;
                        for ($i = 1; $i <= $nb; $i++) {
                            $text .= "<tr name='xtr9'>";
                            $text .= "  <td class='qtd'>".$titles[$i]."</td>";
                            $text .= "  <td class='qtd'>";
                            $text .= "      <select id='x".$i+$nb1."' name='HO-resistance'>";
                            $text .= "          <option value='0'>Selection</option>";
                            $text .= "          <option value='1'>Jamais ou presque jamais</option>";
                            $text .= "          <option value='2'>De temps en temps, mais peu intense</option>";
                            $text .= "          <option value='3'>De temps en temps, mais intense</option>";
                            $text .= "          <option value='4'>Souvent mais peu intense</option>";
                            $text .= "          <option value='5'>Souvent et intense</option>";
                            $text .= "      </select>";
                            $text .= "  </td>";
                            $text .= "</tr>";
                        }
                        
                        if($_SESSION["Data"]["level"]<=1){
                            $text .= "<tr name='xtr9'>";
                            $text .= "<td class='qtotal' colspan='2' id='xtt9'>Total</td>";
                            $text .= "</tr>";
                        }
                        echo $text;
                    ?>";
            text += "       </table>";            
            text += "   </div>";
            text += "</div><br>";

        	text += "<div class='row'>";
            text += " 	<div class='col-11'>";
            text += "  		<table class='qtable'>";
            text += "        	<tr>";
            text += "      			<th class='qheader2' colspan='2'>";
            text += "        			<div class='col-8 qhleft'>Nez</div>";
            text += "        			<div id='colexpand35' class='col-1 qhright'></div>";
            text += "        		</th>";			
            text += "        	</tr>"; 
            text += "<?php                        
                        $text = "";
                        $titles = array(1=>"Bouché",
                                           "Problème de sinus",
                                           "Rhume de foins",
                                           "Crises d’éternuement",
                                           "Formation excessive de mucus"
                                   );
                        
                        $nb = count($titles);
                        $nb1 = 43;
                        for ($i = 1; $i <= $nb; $i++) {
                            $text .= "<tr name='xtr10'>";
                            $text .= "  <td class='qtd'>".$titles[$i]."</td>";
                            $text .= "  <td class='qtd'>";
                            $text .= "      <select id='x".$i+$nb1."' name='HO-resistance'>";
                            $text .= "          <option value='0'>Selection</option>";
                            $text .= "          <option value='1'>Jamais ou presque jamais</option>";
                            $text .= "          <option value='2'>De temps en temps, mais peu intense</option>";
                            $text .= "          <option value='3'>De temps en temps, mais intense</option>";
                            $text .= "          <option value='4'>Souvent mais peu intense</option>";
                            $text .= "          <option value='5'>Souvent et intense</option>";
                            $text .= "      </select>";
                            $text .= "  </td>";
                            $text .= "</tr>";
                        }
                        
                        if($_SESSION["Data"]["level"]<=1){
                            $text .= "<tr name='xtr10'>";
                            $text .= "<td class='qtotal' colspan='2' id='xtt10'>Total</td>";
                            $text .= "</tr>";
                        }
                        echo $text;
                    ?>";
            text += "       </table>";            
            text += "   </div>";
            text += "</div><br>"; 
                       
        	text += "<div class='row'>";
            text += " 	<div class='col-11'>";
            text += "  		<table class='qtable'>";
            text += "        	<tr>";
            text += "      			<th class='qheader2' colspan='2'>";
            text += "        			<div class='col-8 qhleft'>Tube digestif</div>";
            text += "        			<div id='colexpand36' class='col-1 qhright'></div>";
            text += "        		</th>";			
            text += "        	</tr>"; 
            text += "<?php                        
                        $text = "";
                        $titles = array(1=>"Nausée, vomissement",
                                           "Diarrhée",
                                           "Constipation",
                                           "Sensation de ballonnement",
                                           "Eructation, renvois, gaz",
                                           "Douleur d’estomac ou intestinale",
                                           "Brûlure d’estomac"
                                   );
                        
                        $nb = count($titles);
                        $nb1 = 48;
                        for ($i = 1; $i <= $nb; $i++) {
                            $text .= "<tr name='xtr11'>";
                            $text .= "  <td class='qtd'>".$titles[$i]."</td>";
                            $text .= "  <td class='qtd'>";
                            $text .= "      <select id='x".$i+$nb1."' name='HO-resistance'>";
                            $text .= "          <option value='0'>Selection</option>";
                            $text .= "          <option value='1'>Jamais ou presque jamais</option>";
                            $text .= "          <option value='2'>De temps en temps, mais peu intense</option>";
                            $text .= "          <option value='3'>De temps en temps, mais intense</option>";
                            $text .= "          <option value='4'>Souvent mais peu intense</option>";
                            $text .= "          <option value='5'>Souvent et intense</option>";
                            $text .= "      </select>";
                            $text .= "  </td>";
                            $text .= "</tr>";
                        }
                        
                        if($_SESSION["Data"]["level"]<=1){
                            $text .= "<tr name='xtr11'>";
                            $text .= "<td class='qtotal' colspan='2' id='xtt11'>Total</td>";
                            $text .= "</tr>";
                        }
                        echo $text;
                    ?>";
            text += "       </table>";            
            text += "   </div>";
            text += "</div><br>";

        	text += "<div class='row'>";
            text += " 	<div class='col-11'>";
            text += "  		<table class='qtable'>";
            text += "        	<tr>";
            text += "      			<th class='qheader2' colspan='2'>";
            text += "        			<div class='col-8 qhleft'>Emotions</div>";
            text += "        			<div id='colexpand37' class='col-1 qhright'></div>";
            text += "        		</th>";			
            text += "        	</tr>"; 
            text += "<?php                        
                        $text = "";
                        $titles = array(1=>"Humeur fluctuante",
                                           "Anxiété, peur, nervosité",
                                           "Colère, irritabilité, agressivité",
                                           "Dépression"
                                   );
                        
                        $nb = count($titles);
                        $nb1 = 55;
                        for ($i = 1; $i <= $nb; $i++) {
                            $text .= "<tr name='xtr12'>";
                            $text .= "  <td class='qtd'>".$titles[$i]."</td>";
                            $text .= "  <td class='qtd'>";
                            $text .= "      <select id='x".$i+$nb1."' name='HO-resistance'>";
                            $text .= "          <option value='0'>Selection</option>";
                            $text .= "          <option value='1'>Jamais ou presque jamais</option>";
                            $text .= "          <option value='2'>De temps en temps, mais peu intense</option>";
                            $text .= "          <option value='3'>De temps en temps, mais intense</option>";
                            $text .= "          <option value='4'>Souvent mais peu intense</option>";
                            $text .= "          <option value='5'>Souvent et intense</option>";
                            $text .= "      </select>";
                            $text .= "  </td>";
                            $text .= "</tr>";
                        }
                        
                        if($_SESSION["Data"]["level"]<=1){
                            $text .= "<tr name='xtr12'>";
                            $text .= "<td class='qtotal' colspan='2' id='xtt12'>Total</td>";
                            $text .= "</tr>";
                        }
                        echo $text;
                    ?>";
            text += "       </table>";            
            text += "   </div>";
            text += "</div><br>"; 
                       
        	text += "<div class='row'>";
            text += " 	<div class='col-11'>";
            text += "  		<table class='qtable'>";
            text += "        	<tr>";
            text += "      			<th class='qheader2' colspan='2'>";
            text += "        			<div class='col-8 qhleft'>Bouche / Gorge</div>";
            text += "        			<div id='colexpand38' class='col-1 qhright'></div>";
            text += "        		</th>";			
            text += "        	</tr>"; 
            text += "<?php                        
                        $text = "";
                        $titles = array(1=>"Toux chronique",
                                           "Besoin fréquent de se nettoyer la gorge",
                                           "Maux de gorge, voix enrouée, perte de voix",
                                           "Gonflement ou modification de couleur de la langue, des gencives ou des lèvres",
                                           "Aphtes"
                                   );
                        
                        $nb = count($titles);
                        $nb1 = 59;
                        for ($i = 1; $i <= $nb; $i++) {
                            $text .= "<tr name='xtr13'>";
                            $text .= "  <td class='qtd'>".$titles[$i]."</td>";
                            $text .= "  <td class='qtd'>";
                            $text .= "      <select id='x".$i+$nb1."' name='HO-resistance'>";
                            $text .= "          <option value='0'>Selection</option>";
                            $text .= "          <option value='1'>Jamais ou presque jamais</option>";
                            $text .= "          <option value='2'>De temps en temps, mais peu intense</option>";
                            $text .= "          <option value='3'>De temps en temps, mais intense</option>";
                            $text .= "          <option value='4'>Souvent mais peu intense</option>";
                            $text .= "          <option value='5'>Souvent et intense</option>";
                            $text .= "      </select>";
                            $text .= "  </td>";
                            $text .= "</tr>";
                        }
                        
                        if($_SESSION["Data"]["level"]<=1){
                            $text .= "<tr name='xtr13'>";
                            $text .= "<td class='qtotal' colspan='2' id='xtt13'>Total</td>";
                            $text .= "</tr>";
                        }
                        echo $text;
                    ?>";
            text += "       </table>";            
            text += "   </div>";
            text += "</div><br>";
            
        	text += "<div class='row'>";
            text += " 	<div class='col-11'>";
            text += "  		<table class='qtable'>";
            text += "        	<tr>";
            text += "      			<th class='qheader2' colspan='2'>";
            text += "        			<div class='col-8 qhleft'>Muscles / articulations</div>";
            text += "        			<div id='colexpand39' class='col-1 qhright'></div>";
            text += "        		</th>";			
            text += "        	</tr>"; 
            text += "<?php                        
                        $text = "";
                        $titles = array(1=>"Douleur dans les articulations",
                                           "Arthrite",
                                           "Raideur ou limitation de mouvement",
                                           "Douleur musculaire",
                                           "Sensation de faiblesse ou de fatigue"
                                   );
                        
                        $nb = count($titles);
                        $nb1 = 64;
                        for ($i = 1; $i <= $nb; $i++) {
                            $text .= "<tr name='xtr14'>";
                            $text .= "  <td class='qtd'>".$titles[$i]."</td>";
                            $text .= "  <td class='qtd'>";
                            $text .= "      <select id='x".$i+$nb1."' name='HO-resistance'>";
                            $text .= "          <option value='0'>Selection</option>";
                            $text .= "          <option value='1'>Jamais ou presque jamais</option>";
                            $text .= "          <option value='2'>De temps en temps, mais peu intense</option>";
                            $text .= "          <option value='3'>De temps en temps, mais intense</option>";
                            $text .= "          <option value='4'>Souvent mais peu intense</option>";
                            $text .= "          <option value='5'>Souvent et intense</option>";
                            $text .= "      </select>";
                            $text .= "  </td>";
                            $text .= "</tr>";
                        }
                        
                        if($_SESSION["Data"]["level"]<=1){
                            $text .= "<tr name='xtr14'>";
                            $text .= "<td class='qtotal' colspan='2' id='xtt14'>Total</td>";
                            $text .= "</tr>";
                        }
                        echo $text;
                    ?>";
            text += "       </table>";            
            text += "   </div>";
            text += "</div><br>"; 
                       
        	text += "<div class='row'>";
            text += " 	<div class='col-11'>";
            text += "  		<table class='qtable'>";
            text += "        	<tr>";
            text += "      			<th class='qheader2' colspan='2'>";
            text += "        			<div class='col-8 qhleft'>Autres</div>";
            text += "        			<div id='colexpand40' class='col-1 qhright'></div>";
            text += "        		</th>";			
            text += "        	</tr>"; 
            text += "<?php                        
                        $text = "";
                        $titles = array(1=>"Maladies fréquentes",
                                           "Mictions urinaires fréquentes et urgences mictionnelles",
                                           "Démangeaisons génitales ou pertes"
                                   );
                        
                        $nb = count($titles);
                        $nb1 = 69;
                        for ($i = 1; $i <= $nb; $i++) {
                            $text .= "<tr name='xtr15'>";
                            $text .= "  <td class='qtd'>".$titles[$i]."</td>";
                            $text .= "  <td class='qtd'>";
                            $text .= "      <select id='x".$i+$nb1."' name='HO-resistance'>";
                            $text .= "          <option value='0'>Selection</option>";
                            $text .= "          <option value='1'>Jamais ou presque jamais</option>";
                            $text .= "          <option value='2'>De temps en temps, mais peu intense</option>";
                            $text .= "          <option value='3'>De temps en temps, mais intense</option>";
                            $text .= "          <option value='4'>Souvent mais peu intense</option>";
                            $text .= "          <option value='5'>Souvent et intense</option>";
                            $text .= "      </select>";
                            $text .= "  </td>";
                            $text .= "</tr>";
                        }
                        
                        if($_SESSION["Data"]["level"]<=1){
                            $text .= "<tr name='xtr15'>";
                            $text .= "<td class='qtotal' colspan='2' id='xtt15'>Total</td>";
                            $text .= "</tr>";
                        }
                        echo $text;
                    ?>";
            text += "       </table>";            
            text += "   </div>";
            text += "</div><br><br>";
            
        	text += "<div class='row'>";
            text += " 	<div class='col-11'>";
            text += "  		<table class='qtable'>";
            text += "        	<tr>";
            text += "      			<th class='qheader'>";
            text += "        			<div class='col-8 qhleft'>Test de Tolérabilité aux Xénobiotiques</div>";
            text += "        			<div id='colexpand41' class='col-1 qhright'></div>";
            text += "        		</th>";			
            text += "        	</tr>";                   
            text += "<?php                        
                        $text = "";
                        $titles = array(1=>"Prenez-vous en ce moment des médicaments sur prescription ?",
                                           "Prenez-vous actuellement un ou plus des médicaments suivants ?",
                                           "Si vous avez pris ou prenez actuellement des médicaments sur prescription, lequel de ces scénarios représente le mieux votre réponse :",
                                           "Prenez-vous en ce moment ou avez-vous pris dans les 6 derniers mois régulièrement des produits à base de tabac ?",
                                           "Présentez-vous des réactions négatives importantes à la caféine ou aux produits contenant de la caféine ?",
                                           "Présentez-vous communément un « esprit brumeux », de la fatigue ou de la somnolence ?",
                                           "Manifestez-vous des symptômes lors d’une exposition à des parfums, gaz d’échappements ou odeurs fortes ?",
                                           "Vous sentez-vous malade après avoir consommé, même de faibles quantités, d’alcool ?",
                                           "Présentez-vous des antécédents personnels de",
                                           "Avez-vous des antécédents d’exposition significative à des produits chimiques dangereux tels que des herbicides, insecticides, pesticides, ou solvants organiques ?",
                                           "Présentez-vous des effets secondaires ou allergiques lorsque vous consommez des aliments contenant des sulfites tels que vin, fruits secs, … ?"
                                   );
                        
                        $options = array(1=>array("Oui",
                                                  "Non"),
                                            array("Anti-H2 (Cimetidine - Tagamet®)",
                                                  "Anti-douleur/antiinflammatoire (ex : Paracétamol)",
                                                  "Pilule / THM (ex : Estradiol)"),
                                            array("Effets secondaires, le(s) médicament(s) est (sont) efficace(s) à des doses plus faibles",
                                                  "Effets secondaires, le(s) médicament(s) est (sont) efficace(s) à la dose habituelle",
                                                  "Pas d’effets secondaires, le(s) médicament(s) n’est (ne sont) en général pas efficace(s)",
                                                  "Pas d’effets secondaires, le(s) médicament(s) est (sont) en général efficace(s)"),
                                            array("Oui",
                                                  "Non"),
                                            array("Oui",
                                                  "Non",
                                                  "Ne sait pas"),
                                            array("Oui",
                                                  "Non"),
                                            array("Oui",
                                                  "Non",
                                                  "Ne sait pas"),
                                            array("Oui",
                                                  "Non",
                                                  "Ne sait pas"),
                                            array("Sensibilités environnementales et/ou chimiques",
                                                  "Syndrome de fatigue chronique",
                                                  "Fibromyalgie",
                                                  "Symptômes de type Parkinson",
                                                  "Dépendance à l’alcool ou chimique",
                                                  "Asthme"),                           
                                            array("Oui",
                                                  "Non"),
                                            array("Oui",
                                                  "Non",
                                                  "Ne sait pas")
                                  );
                        
                        $nb = count($titles);
                        $nb1 = 72;
                        for ($i = 1; $i <= $nb; $i++) {
                            $j=1;
                            $listOptions = $options[$i];
                            $text .= "<tr name='xtr16'>";
                            $text .= "  <td class='qtd'><div class='qsubheader' style='display:block'>".$titles[$i]."</div>";
                            foreach ($listOptions as $key => $txt){
                                $opt = "";
                                if($i==1){
                                    if($j==1){
                                        $opt = "<div id='73opt' style='display:none;padding:5px;'>Si oui, combien en prenez-vous actuellement ?&nbsp;<input id='73optvalue' type='text' size='10' value='' onkeyup='kchange()'></div>";
                                    }   
                                    $text .= "  <div style='display:block;padding:5px;'><input id='x".$i+$nb1."_".$j++."' type='radio' name='DTX$i' value='$key' onchange='ichange(this.id)'><label>$txt</label></div>";
                                    $text .= $opt;
                                }elseif($i==2 || $i == 9)
                                    $text .= "  <div style='display:block;padding:5px;'><input id='x".$i+$nb1."_".$j++."' type='checkbox' name='DTX$i' value='$key' onchange='ichange(this.id)'><label>$txt</label></div>";
                                else    
                                    $text .= "  <div style='display:block;padding:5px;'><input id='x".$i+$nb1."_".$j++."' type='radio' name='DTX$i' value='$key' onchange='ichange(this.id)'><label>$txt</label></div>";
                            }
                            $text .= " <div style=''><input id='x".$i+$nb1."' type='hidden' value=''></div></td>";
                            $text .= "</tr>";
                        }
                        echo $text;
                    ?>";            
            text += "       </table>";            
            text += "   </div>";
            text += "</div>";
            
            
                                    
            $('#formDTX').append(text);

            $('#colexpand24').click(function(){
        		$('tr[name="xtr1"]').toggle();
         		$('tr[name="xtr2"]').toggle(); 
         		$('tr[name="xtr3"]').toggle(); 
         		$('tr[name="xtr4"]').toggle(); 
         		$('tr[name="xtr5"]').toggle();
        		$('tr[name="xtr6"]').toggle();
         		$('tr[name="xtr7"]').toggle(); 
         		$('tr[name="xtr8"]').toggle(); 
         		$('tr[name="xtr9"]').toggle(); 
         		$('tr[name="xtr10"]').toggle();
        		$('tr[name="xtr11"]').toggle();
         		$('tr[name="xtr12"]').toggle(); 
         		$('tr[name="xtr13"]').toggle(); 
         		$('tr[name="xtr14"]').toggle(); 
         		$('tr[name="xtr15"]').toggle();         		         		          		        		      		
            });
            
            $('#colexpand25').click(function(){
        		$('tr[name="xtr1"]').toggle();
         		$('tr[name="xtr2"]').toggle(); 
         		$('tr[name="xtr3"]').toggle(); 
         		$('tr[name="xtr4"]').toggle(); 
         		$('tr[name="xtr5"]').toggle();
        		$('tr[name="xtr6"]').toggle();
         		$('tr[name="xtr7"]').toggle(); 
         		$('tr[name="xtr8"]').toggle(); 
         		$('tr[name="xtr9"]').toggle(); 
         		$('tr[name="xtr10"]').toggle();
        		$('tr[name="xtr11"]').toggle();
         		$('tr[name="xtr12"]').toggle(); 
         		$('tr[name="xtr13"]').toggle(); 
         		$('tr[name="xtr14"]').toggle(); 
         		$('tr[name="xtr15"]').toggle();            		   		
            });
            
            $('#colexpand26').click(function(){
         		$('tr[name="xtr1"]').toggle();       		
            });

             $('#colexpand27').click(function(){
         		$('tr[name="xtr2"]').toggle();       		
            });
            
            $('#colexpand28').click(function(){
         		$('tr[name="xtr3"]').toggle();       		
            });

             $('#colexpand29').click(function(){
         		$('tr[name="xtr4"]').toggle();       		
            });            
            
            $('#colexpand30').click(function(){
         		$('tr[name="xtr5"]').toggle();       		
            });

             $('#colexpand31').click(function(){
         		$('tr[name="xtr6"]').toggle();       		
            });
            
            $('#colexpand32').click(function(){
         		$('tr[name="xtr7"]').toggle();       		
            });

             $('#colexpand33').click(function(){
         		$('tr[name="xtr8"]').toggle();       		
            }); 
            
            $('#colexpand34').click(function(){
         		$('tr[name="xtr9"]').toggle();       		
            });

             $('#colexpand35').click(function(){
         		$('tr[name="xtr10"]').toggle();       		
            });
            
            $('#colexpand36').click(function(){
         		$('tr[name="xtr11"]').toggle();       		
            });

             $('#colexpand37').click(function(){
         		$('tr[name="xtr12"]').toggle();       		
            });            
            
            $('#colexpand38').click(function(){
         		$('tr[name="xtr13"]').toggle();       		
            });

             $('#colexpand39').click(function(){
         		$('tr[name="xtr14"]').toggle();       		
            });
            
            $('#colexpand40').click(function(){
         		$('tr[name="xtr15"]').toggle();       		
            });
            
            $('#colexpand41').click(function(){
         		$('tr[name="xtr16"]').toggle();       		
            });            
            
            initDTXForm(-1);
            attachDTXTotal();                           	 
        }
        
        function initDTXForm(uid){
        	$.ajax({
                url:"include/pages/initDTX.php",
                type:"POST",
                data:{
                	id:uid
                },
                beforeSend:function(){
                  $("#zoneloader").show();
                  $("#output").hide();              
                },
                success:function(data)
                {
    				setDTXForm(data);
                    $("#output").show();
                    $("#zoneloader").hide();					
                }
           });
        }

        function attachDTXTotal(){
            <?php 
        		$nb = 72;
        		$text = "";
        		$j="";
        		for ($i = 1; $i <= $nb; $i++) {
        		    if($i==5) 
        		       $j=2;
        		    elseif($i==10)
        		       $j=3;
        		    elseif($i==16)
        		       $j=4;
        		    elseif($i==20)
        		       $j=5;
    		        elseif($i==23)
    		           $j=6;
    		        elseif($i==27)
    		           $j=7;
    		        elseif($i==32)
    		           $j=8;
		            elseif($i==36)
		               $j=9;
		            elseif($i==44)
		               $j=10;
		            elseif($i==49)
		               $j=11;
		            elseif($i==56)
		               $j=12;
		            elseif($i==60)
		               $j=13;
		            elseif($i==65)
		               $j=14;
		            elseif($i==70)
		               $j=15;
        		       
        		    $text .= " $('#x".$i."').on('change', function(){xtotal".$j."();});";
        		}
        		echo $text;
    		?>        
        }        

     	var xtt1 = xtt2 = xtt3 = xtt4 = xtt5 = xtt6 = xtt7 = xtt8 = 0;
     	var xtt9 = xtt10 = xtt11 = xtt12 = xtt13 = xtt14 = xtt15 = 0;
     	    
        function xtotal(){
           <?php
                $st=1;
                $fn=4;
                $text = " xtt1 = ";
                for ($i = $st; $i <= $fn; $i++) {
                    $text .= "parseInt($('#x$i').find(':selected').val()) ";
                    if ($i<$fn)
                        $text .= "+";
                }
                $text .= "; ";
                echo $text;
           ?>
           $('#xtt1').text('Total	 '+xtt1);
           $("#output").hide();
        }
        
        function xtotal2(){
           <?php
                $st=5;
                $fn=9;
                $text = " xtt2 = ";
                for ($i = $st; $i <= $fn; $i++) {
                    $text .= "parseInt($('#x$i').find(':selected').val()) ";
                    if ($i<$fn)
                        $text .= "+";
                }
                $text .= "; ";
                echo $text;
           ?>
           $('#xtt2').text('Total	 '+xtt2);
           $("#output").hide();
        }  
        
        function xtotal3(){
           <?php
                $st=10;
                $fn=15;
                $text = " xtt3 = ";
                for ($i =$st; $i <= $fn; $i++) {
                    $text .= "parseInt($('#x$i').find(':selected').val()) ";
                    if ($i<$fn)
                        $text .= "+";
                }
                $text .= "; ";
                echo $text;
           ?>
           $('#xtt3').text('Total	 '+xtt3);
           $("#output").hide();
        }
        
        function xtotal4(){
           <?php
                $st=16;
                $fn=19;
                $text = " xtt4 = ";
                for ($i =$st; $i <= $fn; $i++) {
                    $text .= "parseInt($('#x$i').find(':selected').val()) ";
                    if ($i<$fn)
                        $text .= "+";
                }
                $text .= "; ";
                echo $text;
           ?>
           $('#xtt4').text('Total	 '+xtt4);
           $("#output").hide();
        }
        
        function xtotal5(){
           <?php
                $st=20;
                $fn=22;
                $text = " xtt5 = ";
                for ($i =$st; $i <= $fn; $i++) {
                    $text .= "parseInt($('#x$i').find(':selected').val()) ";
                    if ($i<$fn)
                        $text .= "+";
                }
                $text .= "; ";
                echo $text;
           ?>
           $('#xtt5').text('Total	 '+xtt5);
           $("#output").hide();
        }
        
        function xtotal6(){
           <?php
                $st=23;
                $fn=26;
                $text = " xtt6 = ";
                for ($i =$st; $i <= $fn; $i++) {
                    $text .= "parseInt($('#x$i').find(':selected').val()) ";
                    if ($i<$fn)
                        $text .= "+";
                }
                $text .= "; ";
                echo $text;
           ?>
           $('#xtt6').text('Total	 '+xtt6);
           $("#output").hide();
        }
        
        function xtotal7(){
           <?php
                $st=27;
                $fn=31;
                $text = " xtt7 = ";
                for ($i =$st; $i <= $fn; $i++) {
                    $text .= "parseInt($('#x$i').find(':selected').val()) ";
                    if ($i<$fn)
                        $text .= "+";
                }
                $text .= "; ";
                echo $text;
           ?>
           $('#xtt7').text('Total	 '+xtt7);
           $("#output").hide();
        }                                               

        function xtotal8(){
           <?php
                $st=32;
                $fn=35;
                $text = " xtt8 = ";
                for ($i =$st; $i <= $fn; $i++) {
                    $text .= "parseInt($('#x$i').find(':selected').val()) ";
                    if ($i<$fn)
                        $text .= "+";
                }
                $text .= "; ";
                echo $text;
           ?>
           $('#xtt8').text('Total	 '+xtt8);
           $("#output").hide();
        }
        
        function xtotal9(){
           <?php
                $st=36;
                $fn=43;
                $text = " xtt9 = ";
                for ($i =$st; $i <= $fn; $i++) {
                    $text .= "parseInt($('#x$i').find(':selected').val()) ";
                    if ($i<$fn)
                        $text .= "+";
                }
                $text .= "; ";
                echo $text;
           ?>
           $('#xtt9').text('Total	 '+xtt9);
           $("#output").hide();
        }
        
        function xtotal10(){
           <?php
                $st=44;
                $fn=48;
                $text = " xtt10 = ";
                for ($i =$st; $i <= $fn; $i++) {
                    $text .= "parseInt($('#x$i').find(':selected').val()) ";
                    if ($i<$fn)
                        $text .= "+";
                }
                $text .= "; ";
                echo $text;
           ?>
           $('#xtt10').text('Total	 '+xtt10);
           $("#output").hide();
        }                

        function xtotal11(){
           <?php
                $st=49;
                $fn=55;
                $text = " xtt11 = ";
                for ($i =$st; $i <= $fn; $i++) {
                    $text .= "parseInt($('#x$i').find(':selected').val()) ";
                    if ($i<$fn)
                        $text .= "+";
                }
                $text .= "; ";
                echo $text;
           ?>
           $('#xtt11').text('Total	 '+xtt11);
           $("#output").hide();
        }
        
        function xtotal12(){
           <?php
                $st=56;
                $fn=59;
                $text = " xtt12 = ";
                for ($i =$st; $i <= $fn; $i++) {
                    $text .= "parseInt($('#x$i').find(':selected').val()) ";
                    if ($i<$fn)
                        $text .= "+";
                }
                $text .= "; ";
                echo $text;
           ?>
           $('#xtt12').text('Total	 '+xtt12);
           $("#output").hide();
        }        

        function xtotal13(){
           <?php
                $st=60;
                $fn=64;
                $text = " xtt13 = ";
                for ($i =$st; $i <= $fn; $i++) {
                    $text .= "parseInt($('#x$i').find(':selected').val()) ";
                    if ($i<$fn)
                        $text .= "+";
                }
                $text .= "; ";
                echo $text;
           ?>
           $('#xtt13').text('Total	 '+xtt13);
           $("#output").hide();
        }

        function xtotal14(){
           <?php
                $st=65;
                $fn=69;
                $text = " xtt14 = ";
                for ($i =$st; $i <= $fn; $i++) {
                    $text .= "parseInt($('#x$i').find(':selected').val()) ";
                    if ($i<$fn)
                        $text .= "+";
                }
                $text .= "; ";
                echo $text;
           ?>
           $('#xtt14').text('Total	 '+xtt14);
           $("#output").hide();
        }
        
        function xtotal15(){
           <?php
                $st=70;
                $fn=72;
                $text = " xtt15 = ";
                for ($i =$st; $i <= $fn; $i++) {
                    $text .= "parseInt($('#x$i').find(':selected').val()) ";
                    if ($i<$fn)
                        $text .= "+";
                }
                $text .= "; ";
                echo $text;
           ?>
           $('#xtt15').text('Total	 '+xtt15);
           $("#output").hide();
        }        
        
        function setDTXForm(data){
         	var stringdata = JSON.parse(data);
         	var xtt1 = xtt2 = xtt3 = xtt4 = xtt5 = xtt6 = xtt7 = xtt8 = 0;
         	var xtt9 = xtt10 = xtt11 = xtt12 = xtt13 = xtt14 = xtt15 = 0;         	
         	var tab = "<table class='datas'>";
         	var i=1; 
			for(var x in stringdata)
			{
				if(i<=4){
					tab += "<tr name='xtr1'><td>"+x+"</td><td>"+stringdata[x]+"</td></tr>";
					xtt1 = xtt1 + parseInt(stringdata[x]);
				}else if(i>4 && i<=9){
					tab += "<tr name='xtr2'><td>"+x+"</td><td>"+stringdata[x]+"</td></tr>";
					xtt2 = xtt2 + parseInt(stringdata[x]);
				}else if(i>9 && i<=15){
					tab += "<tr name='xtr3'><td>"+x+"</td><td>"+stringdata[x]+"</td></tr>";
					xtt3 = xtt3 + parseInt(stringdata[x]);					
				}else if(i>15 && i<=19){
					tab += "<tr name='xtr4'><td>"+x+"</td><td>"+stringdata[x]+"</td></tr>";
					xtt4 = xtt4 + parseInt(stringdata[x]);					
				}else if(i>19 && i<=22){
					tab += "<tr name='xtr5'><td>"+x+"</td><td>"+stringdata[x]+"</td></tr>";
					xtt5 = xtt5 + parseInt(stringdata[x]);	
				}else if(i>22 && i<=26){
					tab += "<tr name='xtr6'><td>"+x+"</td><td>"+stringdata[x]+"</td></tr>";
					xtt6 = xtt6 + parseInt(stringdata[x]);
				}else if(i>26 && i<=31){
					tab += "<tr name='xtr7'><td>"+x+"</td><td>"+stringdata[x]+"</td></tr>";
					xtt7 = xtt7 + parseInt(stringdata[x]);					
				}else if(i>31 && i<=35){
					tab += "<tr name='xtr8'><td>"+x+"</td><td>"+stringdata[x]+"</td></tr>";
					xtt8 = xtt8 + parseInt(stringdata[x]);					
				}else if(i>35 && i<=43){
					tab += "<tr name='xtr9'><td>"+x+"</td><td>"+stringdata[x]+"</td></tr>";
					xtt9 = xtt9 + parseInt(stringdata[x]);
				}else if(i>43 && i<=48){
					tab += "<tr name='xtr10'><td>"+x+"</td><td>"+stringdata[x]+"</td></tr>";
					xtt10 = xtt10 + parseInt(stringdata[x]);
				}else if(i>48 && i<=55){
					tab += "<tr name='xtr11'><td>"+x+"</td><td>"+stringdata[x]+"</td></tr>";
					xtt11 = xtt11 + parseInt(stringdata[x]);					
				}else if(i>55 && i<=59){
					tab += "<tr name='xtr12'><td>"+x+"</td><td>"+stringdata[x]+"</td></tr>";
					xtt12 = xtt12 + parseInt(stringdata[x]);					
				}else if(i>59 && i<=64){
					tab += "<tr name='xtr13'><td>"+x+"</td><td>"+stringdata[x]+"</td></tr>";
					xtt13 = xtt13 + parseInt(stringdata[x]);
				}else if(i>64 && i<=69){
					tab += "<tr name='xtr14'><td>"+x+"</td><td>"+stringdata[x]+"</td></tr>";
					xtt14 = xtt14 + parseInt(stringdata[x]);																				
				}else if(i>69 && i<=72){					
					tab += "<tr name='xtr15'><td>"+x+"</td><td>"+stringdata[x]+"</td></tr>";
					xtt15 = xtt15 + parseInt(stringdata[x]);
				}else{
					tab += "<tr name='xtr16'><td>"+x+"</td><td>"+stringdata[x]+"</td></tr>";
			
				}
									
				$('#'+x).val(stringdata[x]);

    			$('#xtt1').text('Total	 '+xtt1);
    			$('#xtt2').text('Total	 '+xtt2);
    			$('#xtt3').text('Total	 '+xtt3);
    			$('#xtt4').text('Total	 '+xtt4);
    			$('#xtt5').text('Total	 '+xtt5);
     			$('#xtt6').text('Total	 '+xtt6);
    			$('#xtt7').text('Total	 '+xtt7);
    			$('#xtt8').text('Total	 '+xtt8);
    			$('#xtt9').text('Total	 '+xtt9);
    			$('#xtt10').text('Total	 '+xtt10);
    			$('#xtt11').text('Total	 '+xtt11);
     			$('#xtt12').text('Total	 '+xtt12);
    			$('#xtt13').text('Total	 '+xtt13);
    			$('#xtt14').text('Total	 '+xtt14);
    			$('#xtt15').text('Total	 '+xtt15);
			   			
    								
				if(i==73){
					let values = stringdata[x].split("_");
					let n = values.length;
					$('#73optvalue').val(values[1]);					
    				for(var j=1;j<=2;j++){
    					if($('#x'+i+'_'+j).val()==values[0]){
    						$('#x'+i+'_'+j).attr('checked', true);
    						if(j==1)
    							$('#73opt').show();
    					}
    				}				
				}
				
				if(i==74){
					let values = stringdata[x].split("_");
					let n = values.length;
					for(let m = 0; m<=n; m++){					
        				for(var j=1;j<=3;j++){
        					if($('#x'+i+'_'+j).val()==values[m])
        						$('#x'+i+'_'+j).attr('checked', true);
        				}
    				}				
				}
				
				if(i==75){
    				for(var j=1;j<=4;j++){
    					if($('#x'+i+'_'+j).val()==stringdata[x]){
    						$('#x'+i+'_'+j).attr('checked', true);
    						break;
    					}
    				}				
				}
				
				if(i==76 || i== 78 || i==82){
    				for(var j=1;j<=2;j++){
    					if($('#x'+i+'_'+j).val()==stringdata[x]){
    						$('#x'+i+'_'+j).attr('checked', true);
    						break;
    					}
    				}				
				}
				
				if(i==77 || i== 79 || i == 80 || i== 83){
    				for(var j=1;j<=3;j++){
    					if($('#x'+i+'_'+j).val()==stringdata[x]){
    						$('#x'+i+'_'+j).attr('checked', true);
    						break;
    					}
    				}				
				}
				
				if(i==81){
					let values = stringdata[x].split("_");
					let n = values.length;
					for(let m = 0; m<=n; m++){					
        				for(var j=1;j<=6;j++){
        					if($('#x'+i+'_'+j).val()==values[m])
        						$('#x'+i+'_'+j).attr('checked', true);
        				}
    				}				
				}																				

    			i++;
    			
			} 
			tab +="</table>";
			
			$('#jsonDataDTX').html(tab);
            enableForm(11);
            			
			formGRLDisplay();		
        }
                       

    	/* ------------------------------------------------------------- */
    	/* ----------------- formulaire GENERAL ------------------------ */
    	/* ------------------------------------------------------------- */
        
        function formGRLDisplay(){
        	var text="";
        	text += "<div class='row'>";
            text += " 	<div class='col-11'>";
            text += "  		<table class='qtable tableMaxWidth'>";
            text += "        	<tr>";
            text += "      			<th class='qheader'>";
            text += "        			<div class='col-8 qhleft'>Evaluation Générale</div>";
            text += "        			<div id='colexpand42' class='col-1 qhright'></div>";
            text += "        		</th>";			
            text += "        	</tr>";
            text += "        	<tr>";
            text += "      			<th class='qheader2'>";
            text += "        			<div class='col-8 qhleft'>1. ALIMENTATION</div>";
            text += "        			<div id='colexpand43' class='col-1 qhright'></div>";
            text += "        		</th>";			
            text += "        	</tr>";
            text += "        	<tr>";
            text += "      			<th class='qheader3'>";
            text += "        			<div class='col-8 qhleft txtleft'>Consommation d'aliments par semaine</div>";
            text += "        			<div id='colexpand44' class='col-1 qhright'></div>";
            text += "        		</th>";			
            text += "        	</tr>";                       
            text += "<?php                        
                        $text = "";
                        $text .= "<tr name='ntr1'>";
                        $text .= "  <td class='qtd fheader' colspan='2' >";
                        $text .= "      AIDE AU CALCUL DES PORTIONS/ 1 portion équivaut à :<br><br>";
                        $text .= "      * <b>Proteines</b> : 150g à 200g  de viande ou de poisson = 2 oeufs<br>";
                        $text .= "      * <b>Produits laitiers</b> : 1 bol de lait = 1 yaourt = 1 part de fromage (environ 1/8 de camembert)<br>";
                        $text .= "      * <b>Produits céréaliers</b> : 1 bol de céréales = 1 tartine de pain = 1 part de tartre = 1 assiette de riz, pâte, semoule...<br>";
                        $text .= "      * <b>Fruits et légumes</b> : 1 fruit = 1 salade de fruits = 1 compote = 1 salade = 1 assiette de légumes<br>";
                        $text .= "      * <b>Sucreries et boissons sucrées</b> : 20cl de boisson sucrée = 1 barre chocolatée = 1 gâteau = 1 croissant = 5 bonbons<br>";
                        $text .= "      * <b>Eau</b> : 1 portion = 1 verre de 25cl<br><br>";
                        $text .= "      MODES DE CUISSON : Friture - Grillade - A la poêle - A l'eau - A la vapeur - Mijoté - Au micro-onde";
                        $text .= "  </td>";
                        $text .= "</tr>";
                        $text .= "<tr name='ntr1'>";
                        $text .= "  <td class='qtd' colspan='2' >";
                        $text .= "      * <b>Proteines</b><br>  ";
                        $text .= "                          <select id='pp' name='HO-resistance'>";
                                                                for ($i = 0; $i <= 20; $i++) {
                                                                    $text .= " <option value='$i'>$i</option>";
                                                                }
                        $text .= "                          </select>";
                        $text .= "      portion(s) de viande / poisson / oeuf - Mode de cuisson : ";
                        $text .= "                          <select id='pmdc' name='HO-resistance'>";
                        $text .= "                              <option value='0'>Friture</option>";
                        $text .= "                              <option value='1'>Grillade</option>";
                        $text .= "                              <option value='2'>A la poêle</option>";
                        $text .= "                              <option value='3'>A l'eau</option>";
                        $text .= "                              <option value='4'>A la vapeur</option>";
                        $text .= "                              <option value='3'>Mijoté</option>";
                        $text .= "                              <option value='4'>Au micro-onde</option>";
                        $text .= "                          </select><br><br>";
                        $text .= "      * <b>Produits laitiers</b><br>";
                        $text .= "                          <select id='pyl' name='HO-resistance'>";
                                                                    for ($i = 0; $i <= 20; $i++) {
                                                                        $text .= " <option value='$i'>$i</option>";
                                                                    }
                        $text .= "                          </select>";
                        $text .= "      portion(s) de yaourt et de lait ";
                        $text .= "<input type='checkbox' id='pyl1' value='0'><label>entier</label>&nbsp;&nbsp;&nbsp;";
                        $text .= "<input type='checkbox' id='pyl2' value='1'><label>semi écrémé</label>&nbsp;&nbsp;&nbsp;";
                        $text .= "<input type='checkbox' id='pyl3' value='2'><label>écrémé</label><br>";
                        $text .= "                          <select id='pf' name='HO-resistance'>";
                                                                    for ($i = 0; $i <= 20; $i++) {
                                                                        $text .= " <option value='$i'>$i</option>";
                                                                    }
                        $text .= "                          </select>";
                        $text .= "      portion(s) de fromage &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Quel(s) type(s) de fromages ";
                        $text .= "<input type='text' id='pft' value='' size='10'><br><br>";
                        $text .= "      * <b>Produits céréaliers</b><br>";
                        $text .= "                          <select id='ppc' name='HO-resistance'>";
                                                                    for ($i = 0; $i <= 20; $i++) {
                                                                        $text .= " <option value='$i'>$i</option>";
                                                                    }
                        $text .= "                          </select>";
                        $text .= "      portion(s) de pain et de céréales &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Quel(s) type(s) ";
                        $text .= "<input type='text' id='ppct' value='' size='10'><br>";
                        $text .= "                          <select id='pfs' name='HO-resistance'>";
                                                                    for ($i = 0; $i <= 20; $i++) {
                                                                        $text .= " <option value='$i'>$i</option>";
                                                                    }
                        $text .= "                          </select>";
                        $text .= "      portion(s) de féculents (pâtes, riz, pommes de terre, légumineuses)<br><br>";
                        $text .= "      * <b>Fruits et légumes</b><br>";
                        $text .= "                          <select id='pfl1' name='HO-resistance'>";
                                                                    for ($i = 0; $i <= 20; $i++) {
                                                                        $text .= " <option value='$i'>$i</option>";
                                                                    }
                        $text .= "                          </select>";
                        $text .= "      fruits &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ";
                        $text .= "                          <select id='pfl2' name='HO-resistance'>";
                                                                    for ($i = 0; $i <= 20; $i++) {
                                                                        $text .= " <option value='$i'>$i</option>";
                                                                    }
                        $text .= "                          </select>";
                        $text .= "      portion(s) de légumes cuits &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ";
                        $text .= "                          <select id='pfl3' name='HO-resistance'>";
                                                                    for ($i = 0; $i <= 20; $i++) {
                                                                        $text .= " <option value='$i'>$i</option>";
                                                                    }
                        $text .= "                          </select>";
                        $text .= "      portion(s) de crudités<br><br>";
                        $text .= "      * <b>Sucreries</b><br>";
                        $text .= "                          <select id='ps' name='HO-resistance'>";
                                                                    for ($i = 0; $i <= 20; $i++) {
                                                                        $text .= " <option value='$i'>$i</option>";
                                                                    }
                        $text .= "                          </select>";
                        $text .= "      portion(s) de sucreries (pâtisseries, viennoiseries, gâteaux, barres chocolatées...)<br><br>";
                        $text .= " Utilisez-vous des matières grasses pour la cuisson ?&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                        $text .= "<input type='checkbox' id='mg1' value='0'><label>Oui</label>&nbsp;&nbsp;&nbsp;";
                        $text .= "<input type='checkbox' id='mg2' value='1'><label>Non</label><br>";
                        $text .= "      Lesquelles ? ";
                        $text .= "<input type='text' id='mgt' value='' size='10'><br><br>";
                        $text .= " Utilisez-vous du sel ?&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                        $text .= "<input type='checkbox' id='s1' value='0'><label>pour la cuisson</label>&nbsp;&nbsp;&nbsp;";
                        $text .= "<input type='checkbox' id='s2' value='1'><label>dans votre assiette</label>&nbsp;&nbsp;&nbsp;";
                        $text .= "<input type='checkbox' id='s3' value='2'><label>je n'utilise pas de sel</label><br><br>";
                        $text .= "  </td>";
                        $text .= "</tr>";
                      
                        echo $text;
                    ?>";
            text += "       </table>";            
            text += "   </div>";
            text += "</div>";

        	text += "<div class='row'>";
            text += " 	<div class='col-11'>";
            text += "  		<table class='qtable'>";
            text += "        	<tr>";
            text += "      			<th class='qheader3' colspan='2'>";
            text += "        			<div class='col-8 qhleft txtleft'>Consommation de boisson (par jour)</div>";
            text += "        			<div id='colexpand47' class='col-1 qhright'></div>";
            text += "        		</th>";			
            text += "        	</tr>";                       
            text += "<?php                        
                        $text = "";
                        $titles = array(1=>"portions(s) d'eau",
                                           "portions(s) de soda et de jus de fruits",
                                           "portions(s) de vin et d'alcool",
                                           "portions(s) de café ou de thé"
                                   );
                        
                        $nb = count($titles);
                        for ($i = 1; $i <= $nb; $i++) {
                            $text .= "<tr name='btr1'><td>";
                            $text .= "   <select id='cbpj$i' name='HO-resistance'>";
                                            for ($j = 0; $j <= 20; $j++) {
                                                $text .= " <option value='$j'>$j</option>";
                                            }
                            $text .= "   </select>";
                            $text .= "  ".$titles[$i];
                            $text .= "&nbsp;&nbsp;&nbsp;&nbsp; </td><td>";
                            if($i == $nb) $text .= "Sucré ou non ?";
                            else $text .= "Quel(s) type(s) ?";
                            $text .=  " &nbsp;<input type='text' id='cbpj".$i."_text' value='' size='10'>";
                            $text .= "  </td>";
                            $text .= "</tr>";
                        }
                        echo $text;
                    ?>";            
            text += "       </table>";            
            text += "   </div>";
            text += "</div>";

        	text += "<div class='row'>";
            text += " 	<div class='col-11'>";
            text += "  		<table class='qtable tableMaxWidth'>";
            text += "        	<tr>";
            text += "      			<th class='qheader3'>";
            text += "        			<div class='col-8 qhleft'>Consommation d'aliments et de boissons (sur une journée type)</div>";
            text += "        			<div id='colexpand47' class='col-1 qhright'></div>";
            text += "        		</th>";			
            text += "        	</tr>";                       
            text += "<?php                        
                        $text = "";
                        $titlesV = array(1=>"Matin",
                                            "Midi",
                                            "Après-midi",
                                            "Soir",
                                            "En dehors des repas"
                                   );
 
                        $titlesH = array(1=>"",
                                            "Eau",
                                            "Proteines",
                                            "Produits laitiers",
                                            "Produits céréaliers",
                                            "Fruits et légumes",
                                            "Sucreries et boissons sucrées"
                                        );
                         
                        $nbv = count($titlesV);
                        $nbh = count($titlesH);
                                                
                        $text .= "<tr name='btr1'><td>";
                        $text .= "<table class='conso'>";
                        for ($i = 1; $i <= $nbv; $i++) {
                            $text .= "<tr>";
                            if($i==1) {
                                $text .= "<td></td>";
                                for ($j = 2; $j <= $nbh; $j++) {
                                    $text .= "<td  class='conso consobkg'>$titlesH[$j]</td>";
                                }
                            }else{
                                $text .= "<td  class='conso consobkg'>".$titlesV[$i]."</td>";
                                for ($j = 2; $j <= $nbh; $j++) {
                                    $text .= "<td class='conso'>";
                                    $text .= "   <select id='conso$i".'_'."$j.' name='HO-resistance'>";
                                    for ($h = 0; $h <= 10; $h++) {
                                        $text .= " <option value='$h'>$h</option>";
                                    }
                                    $text .= "</td>";
                                }
                            }
                            $text .= "</tr>";
                        }                       
                        $text .= "</table>";
                        $text .= "  </td>";
                        $text .= "</tr>";

                        echo $text;
                    ?>";            
            text += "       </table>";            
            text += "   </div>";
            text += "</div><br><br>";

        	text += "<div class='row'>";
            text += " 	<div class='col-11'>";
            text += "  		<table class='qtable tableMaxWidth'>";            
            text += "        	<tr>";
            text += "      			<th class='qheader2' colspan='2'>";
            text += "        			<div class='col-11 qhleft'>2. DIGESTION</div>";
            text += "        			<div id='colexpand45' class='col-1 qhright'></div>";
            text += "        		</th>";			
            text += "        	</tr>";
            text += "        	<tr>";
            text += "      			<th class='qheader3' colspan='2'>";
            text += "        			<div class='col-11 qhleft'>Antécédents familiaux et personnels<br>Est-ce que qu'un membre de votre famille (père, mère frère, soeur, grands-parents et vous-même y compris) souffre ou a souffert des affections suivantes ?</div>";
            text += "        			<div id='colexpand46' class='col-1 qhright'></div>";
            text += "        		</th>";			
            text += "        	</tr>";                       
            text += "<?php                        
                        $text = "";
                        $titles = array(1=>"Allergie",
                                           "Diabète",
                                           "Maladie coeliaque",
                                           "Maladie de Crohn",
                                           "Psoriasis",
                                           "Rhumatismes inflammatoires"
                                   );
                        
                        $nb = count($titles);
                        $text .= "<tr name='ntr2'><td colspan='2'>";
                        $text .= "<table name='ntr2'>";
                        $text .= "<th></th><th>Antécédents personnels</th><th>Antécédents familiaux</th>";
                        for ($i = 1; $i <= $nb; $i++) {
                            $text .= "  <tr>";
                            $text .= "  <td class='qtd'>".$titles[$i]."</td>";
                            $text .= "  <td><input type='checkbox' id='x".$i."_0' value='0'></td>";
                            $text .= "  <td><input type='checkbox' id='x".$i."_1' value='1'></td>";
                            $text .= "  </tr>";
                        }
                        $text .= "</td></tr>";
                        echo $text;
                    ?>";            
            text += "       </table>";            
            text += "   </div>";
            text += "</div><br>";

        	text += "<div class='row'>";
            text += " 	<div class='col-11'>";
            text += "  		<table class='qtable'>";
            text += "        	<tr>";
            text += "      			<th class='qheader3' colspan='2'>";
            text += "        			<div class='col-11 qhleft'>Fragilité digestive: Souffrez-vous de :</div>";
            text += "        			<div id='colexpand47' class='col-1 qhright'></div>";
            text += "        		</th>";			
            text += "        	</tr>";                       
            text += "<?php                        
                        $text = "";
                        $titles = array(1=>"Infections digestives",
                                           "Troubles digestifs fréquents",
                                           "Intolérence alimentaire (lait, gluten...)",
                                           "Fatigue permanente",
                                           "Troubles de l'humeur",
                                           "Migraines récidivantes",
                                           "Douleurs traînantes des articulations",
                                           "Asthme",
                                           "Eczéma",
                                           "Urticaire",
                                           "Autres problèmes de peau",
                                   );
                        
                        $nb = count($titles);
                        $nb1 = 6;
                        for ($i = 1; $i <= $nb; $i++) {
                            $text .= "<tr name='ntr3'>";
                            $text .= "  <td class='qtd'>".$titles[$i];
                            if($i==$nb) $text .= "&nbsp;:&nbsp;<input type='text' id='n".$i+$nb1."_text' value='' size='10'>";
                            $text .= "  </td>";
                            $text .= "  <td>";
                            $text .= "      <select id='n".$i+$nb1."' name='HO-resistance'>";
                            $text .= "          <option value='0'>Jamais</option>";
                            $text .= "          <option value='1'>Rarement</option>";
                            $text .= "          <option value='2'>Parfois</option>";
                            $text .= "          <option value='3'>Souvent</option>";
                            $text .= "      </select>";
                            $text .= "  </td>";
                            $text .= "</tr>";
                        }
                        echo $text;
                    ?>";            
            text += "       </table>";            
            text += "   </div>";
            text += "</div>";

        	text += "<div class='row'>";
            text += " 	<div class='col-11'>";
            text += "  		<table class='qtable'>";            
            text += "        	<tr>";
            text += "      			<th class='qheader2' colspan='2'>";
            text += "        			<div class='col-11 qhleft'>3. DETOXICATION</div>";
            text += "        			<div id='colexpand48' class='col-1 qhright'></div>";
            text += "        		</th>";			
            text += "        	</tr>";
            text += "        	<tr>";
            text += "      			<th class='qheader3' colspan='2'>";
            text += "        			<div class='col-11 qhleft'>Habitudes</div>";
            text += "        			<div id='colexpand49' class='col-1 qhright'></div>";
            text += "        		</th>";			
            text += "        	</tr>"; 
            text += "<?php                        
                        $text = "";
                        $titles = array(1=>"Consommez-vous des substances excitantes (café, thé, cigarettes, coca...) ?",
                                           "Consommez-vous du vin ?",
                                           "Consommez-vous de l’alcool (apéritif, digestif...) ?",
                                           "Consommez-vous des produits sucrés (bonbons, sodas, biscuits...) ?",
                                           "Consommez-vous des produits alimentaires industriels (chips, frites...) ?",
                                           "Utilisez-vous des matières grasses de cuisson ?",
                                           "Mangez-vous rapidement ?",
                                           "Avez-vous tendance à éviter tout effort physique (escaliers/ascenseur) ?"
                                   );
                        
                        $nb = count($titles);
                        $nb1 = 17;
                        for ($i = 1; $i <= $nb; $i++) {
                            $text .= "<tr name='ntr4'>";
                            $text .= "  <td class='qtd'>".$titles[$i]."</td>";
                            $text .= "  <td>";
                            $text .= "      <select id='n".$i+$nb1."' name='HO-resistance'>";
                            $text .= "          <option value='0'>Jamais</option>";
                            $text .= "          <option value='1'>Rarement</option>";
                            $text .= "          <option value='2'>Parfois</option>";
                            $text .= "          <option value='3'>Souvent</option>";
                            $text .= "      </select>";
                            $text .= "  </td>";
                            $text .= "</tr>";
                        }
                        echo $text;
                    ?>"; 
            text += "       </table>";            
            text += "   </div>";
            text += "</div>";     

        	text += "<div class='row'>";
            text += " 	<div class='col-11'>";
            text += "  		<table class='qtable'>";            
            text += "        	<tr>";
            text += "      			<th class='qheader3' colspan='2'>";
            text += "        			<div class='col-11 qhleft'>Environnement</div>";
            text += "        			<div id='colexpand50' class='col-1 qhright'></div>";
            text += "        		</th>";			
            text += "        	</tr>"; 
            text += "<?php                        
                        $text = "";
                        $titles = array(1=>"Êtes-vous exposé(e) à des produits toxiques sur votre lieu de travail ?",
                                           "Êtes-vous exposé(e) à un environnement pollué (transports, diesel, essence...) ?",
                                           "Buvez-vous l’eau du robinet ?",
                                           "Prenez-vous un traitement médicamenteux ?",
                                           "Prenez-vous un traitement hormonal (contraception...) ?"
                                   );
                        
                        $nb = count($titles);
                        $nb1 = 25;
                        for ($i = 1; $i <= $nb; $i++) {
                            $text .= "<tr name='ntr5'>";
                            $text .= "  <td class='qtd'>".$titles[$i]."</td>";
                            $text .= "  <td>";
                            $text .= "      <select id='n".$i+$nb1."' name='HO-resistance'>";
                            $text .= "          <option value='0'>Jamais</option>";
                            $text .= "          <option value='1'>Rarement</option>";
                            $text .= "          <option value='2'>Parfois</option>";
                            $text .= "          <option value='3'>Souvent</option>";
                            $text .= "      </select>";
                            $text .= "  </td>";
                            $text .= "</tr>";
                        }
                        echo $text;
                    ?>"; 
            text += "       </table>";            
            text += "   </div>";
            text += "</div>"; 

        	text += "<div class='row'>";
            text += " 	<div class='col-11'>";
            text += "  		<table class='qtable'>";            
            text += "        	<tr>";
            text += "      			<th class='qheader2' colspan='2'>";
            text += "        			<div class='col-11 qhleft'>4. TROUBLES GÉNÉRAUX</div>";
            text += "        			<div id='colexpand51' class='col-1 qhright'></div>";
            text += "        		</th>";			
            text += "        	</tr>";
            text += "        	<tr>";
            text += "      			<th class='qheader3' colspan='2'>";
            text += "        			<div class='col-11 qhleft'>Troubles digestifs</div>";
            text += "        			<div id='colexpand52' class='col-1 qhright'></div>";
            text += "        		</th>";			
            text += "        	</tr>"; 
            text += "<?php                        
                        $text = "";
                        $titles = array(1=>"j’ai des douleurs abdominales",
                                           "j’ai des remontées acides",
                                           "j’ai des brûlures d’estomac",
                                           "j’ai des nausées ou des vomissements",
                                           "j’ai des ballonnements ou des flatulences",
                                           "je souffre de diarrhées, de constipation ou d’une alternance diarrhées/constipation"
                                   );
                        
                        $nb = count($titles);
                        $nb1 = 30;
                        for ($i = 1; $i <= $nb; $i++) {
                            $text .= "<tr name='ntr6'>";
                            $text .= "  <td class='qtd'>".$titles[$i]."</td>";
                            $text .= "  <td>";
                            $text .= "      <select id='n".$i+$nb1."' name='HO-resistance'>";
                            $text .= "          <option value='0'>Jamais</option>";
                            $text .= "          <option value='1'>Rarement</option>";
                            $text .= "          <option value='2'>Parfois</option>";
                            $text .= "          <option value='3'>Souvent</option>";
                            $text .= "      </select>";
                            $text .= "  </td>";
                            $text .= "</tr>";
                        }
                        echo $text;
                    ?>"; 
            text += "       </table>";            
            text += "   </div>";
            text += "</div>";     

        	text += "<div class='row'>";
            text += " 	<div class='col-11'>";
            text += "  		<table class='qtable'>";            
            text += "        	<tr>";
            text += "      			<th class='qheader3' colspan='2'>";
            text += "        			<div class='col-11 qhleft'>Troubles cutanés</div>";
            text += "        			<div id='colexpand53' class='col-1 qhright'></div>";
            text += "        		</th>";			
            text += "        	</tr>"; 
            text += "<?php                        
                        $text = "";
                        $titles = array(1=>"J’ai la peau sèche",
                                           "Je fais régulièrement des crises d’eczéma",
                                           "J’ai de l’acné",
                                           "J’ai régulièrement des poussées d’herpès au niveau du visage",
                                           "Mes ongles sont cassants",
                                           "Je perds mes cheveux ou ils sont cassants" 
                                   );
                        
                        $nb = count($titles);
                        $nb1 = 36;
                        for ($i = 1; $i <= $nb; $i++) {
                            $text .= "<tr name='ntr7'>";
                            $text .= "  <td class='qtd'>".$titles[$i]."</td>";
                            $text .= "  <td>";
                            $text .= "      <select id='n".$i+$nb1."' name='HO-resistance'>";
                            $text .= "          <option value='0'>Jamais</option>";
                            $text .= "          <option value='1'>Rarement</option>";
                            $text .= "          <option value='2'>Parfois</option>";
                            $text .= "          <option value='3'>Souvent</option>";
                            $text .= "      </select>";
                            $text .= "  </td>";
                            $text .= "</tr>";
                        }
                        echo $text;
                    ?>"; 
            text += "       </table>";            
            text += "   </div>";
            text += "</div>"; 

        	text += "<div class='row'>";
            text += " 	<div class='col-11'>";
            text += "  		<table class='qtable'>";            
            text += "        	<tr>";
            text += "      			<th class='qheader3' colspan='2'>";
            text += "        			<div class='col-11 qhleft'>Troubles infectieux</div>";
            text += "        			<div id='colexpand54' class='col-1 qhright'></div>";
            text += "        		</th>";			
            text += "        	</tr>"; 
            text += "<?php                        
                        $text = "";
                        $titles = array(1=>"Je souffre régulièrement de maux de gorge, d’angines, de rhumes, de sinusites, d’otites",
                                           "Je souffre régulièrement de bronchites ou d’infections des poumons",
                                           "J’ai régulièrement des infections urinaires",
                                           "J’ai régulièrement des infections génitales",
                                           "J’ai régulièrement des infections digestives",
                                           "J’ai régulièrement des infections cutanées" 
                                   );
                        
                        $nb = count($titles);
                        $nb1 = 42;
                        for ($i = 1; $i <= $nb; $i++) {
                            $text .= "<tr name='ntr8'>";
                            $text .= "  <td class='qtd'>".$titles[$i]."</td>";
                            $text .= "  <td>";
                            $text .= "      <select id='n".$i+$nb1."' name='HO-resistance'>";
                            $text .= "          <option value='0'>Jamais</option>";
                            $text .= "          <option value='1'>Rarement</option>";
                            $text .= "          <option value='2'>Parfois</option>";
                            $text .= "          <option value='3'>Souvent</option>";
                            $text .= "      </select>";
                            $text .= "  </td>";
                            $text .= "</tr>";
                        }
                        echo $text;
                    ?>"; 
            text += "       </table>";            
            text += "   </div>";
            text += "</div>"; 

        	text += "<div class='row'>";
            text += " 	<div class='col-11'>";
            text += "  		<table class='qtable'>";            
            text += "        	<tr>";
            text += "      			<th class='qheader3' colspan='2'>";
            text += "        			<div class='col-11 qhleft'>Troubles circulatoires</div>";
            text += "        			<div id='colexpand55' class='col-1 qhright'></div>";
            text += "        		</th>";			
            text += "        	</tr>"; 
            text += "<?php                        
                        $text = "";
                        $titles = array(1=>"J’ai les jambes lourdes",
                                           "Je souffre régulièrement de bronchites ou d’infections des poumons",
                                           "Je fais de l’œdème (chevilles, mains, doigts...)",
                                           "J’ai souvent les extrémités froides",
                                           "J’ai des fourmillements aux extrémités",
                                           "J’ai des troubles avant les règles (seins tendus, douleurs, fatigue...)",
                                           "Je me sens irritable ou déprimée avant mes règles"
                                   );
                        
                        $nb = count($titles);
                        $nb1 = 48;
                        for ($i = 1; $i <= $nb; $i++) {
                            $text .= "<tr name='ntr9'>";
                            $text .= "  <td class='qtd'>".$titles[$i]."</td>";
                            $text .= "  <td>";
                            $text .= "      <select id='n".$i+$nb1."' name='HO-resistance'>";
                            $text .= "          <option value='0'>Jamais</option>";
                            $text .= "          <option value='1'>Rarement</option>";
                            $text .= "          <option value='2'>Parfois</option>";
                            $text .= "          <option value='3'>Souvent</option>";
                            $text .= "      </select>";
                            $text .= "  </td>";
                            $text .= "</tr>";
                        }
                        echo $text;
                    ?>"; 
            text += "       </table>";            
            text += "   </div>";
            text += "</div>";

        	text += "<div class='row'>";
            text += " 	<div class='col-11'>";
            text += "  		<table class='qtable'>";            
            text += "        	<tr>";
            text += "      			<th class='qheader3' colspan='2'>";
            text += "        			<div class='col-11 qhleft'>Troubles articulaires et osseux</div>";
            text += "        			<div id='colexpand56' class='col-1 qhright'></div>";
            text += "        		</th>";			
            text += "        	</tr>"; 
            text += "<?php                        
                        $text = "";
                        $titles = array(1=>"J’ai des douleurs au niveau du dos et/ou du cou",
                                           "J’ai des douleurs articulaires (poignets, coudes, épaules, chevilles, hanches, genoux)",
                                           "J’ai des douleurs musculaires ou au niveau des tendons",
                                           "Je me blesse facilement quand je fais du sport",
                                           "J’ai des douleurs rhumatismales",
                                           "Je souffre d’une maladie ou d’une gêne oculaire (cataracte, yeux secs...)"
                                   );
                        
                        $nb = count($titles);
                        $nb1 = 55;
                        for ($i = 1; $i <= $nb; $i++) {
                            $text .= "<tr name='ntr10'>";
                            $text .= "  <td class='qtd'>".$titles[$i]."</td>";
                            $text .= "  <td>";
                            $text .= "      <select id='n".$i+$nb1."' name='HO-resistance'>";
                            $text .= "          <option value='0'>Jamais</option>";
                            $text .= "          <option value='1'>Rarement</option>";
                            $text .= "          <option value='2'>Parfois</option>";
                            $text .= "          <option value='3'>Souvent</option>";
                            $text .= "      </select>";
                            $text .= "  </td>";
                            $text .= "</tr>";
                        }
                        echo $text;
                    ?>"; 
            text += "       </table>";            
            text += "   </div>";
            text += "</div>";
                                                                                                       
            $('#formGRL').append(text);
            enableForm(12);
        }


		$('#formSubmit').click(function(){
    		<?php 
        		$nb = 37;
        		$nb2 = 78;
        		$nb3 = 30;
        		$nb4 = 9;
        		$nb5 = 9;
        		$nb6 = 14;
        		$nb7 = 30;
        		$nb8 = 26;
        		$nb9 = 13;
        		$nb10 = 10;
        		$nb11 = 83;
        		
        		$text = "";
        		
        		for ($i = 1; $i <= $nb; $i++) {
        		    $text .= " sq".$i."= parseInt($('#q".$i."').find(':selected').val());";
        		}
        		
        		for ($i = 1; $i <= $nb2; $i++) {
        		    $text .= "if($('#h".$i."non').is(':checked')){";
        		    $text .= " sh".$i."= parseInt($('h".$i."non').val());";
        		    $text .= "} else {";
        		    $text .= " sh".$i."= parseInt($('#h".$i."').find(':selected').val());";
        		    $text .= "}";        		    
        		}
        		
        		for ($i = 1; $i <= $nb3; $i++) {
        		    $text .= " ss".$i."= parseInt($('#s".$i."').find(':selected').val());";
        		}
        		
        		for ($i = 1; $i <= $nb4; $i++) {
        		    $text .= " sp".$i."= parseInt($('#p".$i."').find(':selected').val());";
        		}
        		
        		for ($i = 1; $i <= $nb5; $i++) {
        		    $text .= " sd".$i."= parseInt($('#d".$i."').find(':selected').val());";
        		}
        		
        		for ($i = 1; $i <= $nb6; $i++) {
        		    $text .= " sa".$i."= parseInt($('#a".$i."').find(':selected').val());";
        		}
        		
        		for ($i = 1; $i <= $nb7; $i++) {
        		    $text .= " sg".$i."= parseInt($('#g".$i."').find(':selected').val());";
        		}
        		
        		for ($i = 1; $i <= $nb8; $i++) {
        		    $text .= "if($('#l$i').is(':checked')){";
        		    $text .= "    sl$i = 1;";
        		    $text .= "} else {";
        		    $text .= "    sl$i = 0;";
        		    $text .= "}";  
        		}

        		for ($i = 1; $i <= $nb9; $i++) {
        		    $text .= " sm".$i."= parseInt($('#m".$i."').find(':selected').val());";
        		}

        		for ($i = 1; $i <= $nb10; $i++) {
        		    $text .= " so".$i."= $('#so".$i."').val();";
        		}
        		
        		for ($i = 1; $i <= $nb11; $i++) {
            		$text .= " sx".$i."= $('#x".$i."').val();";
        		}
        		
        		echo $text;
    		?>
                      		   
           $.ajax({
            url:"include/pages/submitForm.php",
            type:"POST",
            data:{
            	id:currentUserIdData,
            	<?php 
                	$nb = 37;
                	$text = "";
                	for ($i = 1; $i <= $nb; $i++) {
                	    $text .= " q".$i.":sq".$i.", ";
                	}               	
                	
                	$nb2 = 78;
                	for ($i = 1; $i <= $nb2; $i++) {
                	    $text .= " h".$i.":sh".$i.", ";
                	}
                	
                	/* $nb3 = 30;
                	for ($i = 1; $i <= $nb3; $i++) {
                	    $text .= " s".$i.":ss".$i.", ";
                	}
                	
                	$nb4 = 9;
                	for ($i = 1; $i <= $nb4; $i++) {
                	    $text .= " p".$i.":sp".$i.", ";
                	}
                	
                	$nb5 = 9;
                	for ($i = 1; $i <= $nb5; $i++) {
                	    $text .= " d".$i.":sd".$i.", ";
                	}
                	
                	$nb6 = 14;
                	for ($i = 1; $i <= $nb6; $i++) {
                	    $text .= " a".$i.":sa".$i.", ";
                	}
                	
                	$nb7 = 30;
                	for ($i = 1; $i <= $nb7; $i++) {
                	    $text .= " g".$i.":sg".$i.", ";
                	}
                	
                	$nb8 = 26;
                	for ($i = 1; $i <= $nb8; $i++) {
                	    $text .= " l".$i.":sl".$i.", ";
                	}
                	
                	$nb9 = 13;
                	for ($i = 1; $i <= $nb9; $i++) {
                	    $text .= " m".$i.":sm".$i.", ";
                	}
                	
                	$nb10 = 10;
                	for ($i = 1; $i <= $nb10; $i++) {
                	    $text .= " so".$i.":so".$i.", ";
                	}
                	
                	$nb11 = 83;
                	for ($i = 1; $i <= $nb11; $i++) {
                	    $text .= " x".$i.":sx".$i.", "; 
                	}*/
                	
                	echo $text;                	
            	?>          	                	     	           	            	            	        	            	                	
            },
            beforeSend:function(){
              $("#loader").show();
              $("#output").hide();
              allSelectDisable(true);
              allButtonsDisable();
            },
            success:function(data)
            {
				$('#output').html(data);
                $("#loader").hide();
                $("#output").show();
                allSelectDisable(false);
                allButtonsEnable();							
            }
           });                          
    	});                                                   	
    });
</script>