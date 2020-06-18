<?php
include_once "header.php";

include_once "../../dbcon.php";
if(!isset($_SESSION['research_id'])){
    echo "<script>window.location='create_research.php';</script>";
}
else{
    $research_id=$_SESSION['research_id'];
}

if(!isset($_SESSION['quest_id'])){
    echo "<script> window.location='create_quest.php';</script>";
}
else {
    $quest_id=$_SESSION['quest_id'];
}
?>


<script >
 
 var counter = 2;
 
$(function(){
    
    
       
 
    $("#addButton").click(function () {
 
	if(counter>10){
				alert("Only 10 textboxes allow");
				return false;
		}   
	 
		var newTextBoxDiv = $(document.createElement('div'))
			 .attr("id", 'TextBoxDiv' + counter);
	 
		newTextBoxDiv.after().html('<br /><label>Χρονολογία #'+ counter + ' : </label>' +
			  '<input type="text" onchange="enableBeforeUnload();"'+
                          'onkeyup="enableBeforeUnload();" class="textBoxes" name="textbox' + counter + 
			  '" style="margin-left: 27px;  width: 100px;" id="textbox' + counter + '" value="" >');
	 
		newTextBoxDiv.appendTo("#TextBoxesGroup");
	 
	 
		counter++;
     });
	 
     $("#removeButton").click(function () {
		if(counter==1){
			  alert("Δεν υπάρχουν άλλα πεδία για αφαίρεση");
			  return false;
		   }   
	 
		counter--;
	 
			$("#TextBoxDiv" + counter).remove();
 
     }); 
 
 
 
 
  });
</script>

<script>
function formCheck(){
        
        var all = document.getElementsByClassName("textBoxes");
        
        if ($('#description').val() == '') {
                    alert("Δεν έχετε εισάγει οδηγίες για τα χαρακτηριστικά");
                    return false;
                    e.preventDefault();
                }
                
        if ($('#description').val().length < 10) {
            alert("Οι οδηγίες πρέπει να έχουν τουλάχιστον 10 χαρακτήρες");
            return false;
            e.preventDefault();
        }
        
        
        for (var i=0; i<all.length; i++ ){
           if(all[i].value==''){ alert("Δεν έχετε εισάγει το όνομα του χαρακτηριστικού #"+(i+1));
               return false; // prevent default click action from happening!
                e.preventDefault(); // same thing as above
            }
            
        }
            
        document.getElementById('myForm').submit();
        
    }
</script>

<script>
    function enableName(ctrl, txtId) {
if (ctrl.checked)
    $('#' + txtId).removeAttr('disabled');
else
    $('#' + txtId).attr('disabled', 'disabled');
}
</script>

<script type="text/javascript">

       function enableBeforeUnload() {
    window.onbeforeunload = function (e) {
        return "You have made some changes which you might want to save.";
    };
}
function disableBeforeUnload() {
    window.onbeforeunload = null;
    formCheck();
}

</script>


<!----------------------CONTENT---------------------->
    
<h2>Εισάγετε το χαρακτηριστικό με το οποίο θα βαθμολογηθούν οι <br/><br/>παράγοντες του ερωτηματολογίου</h2>
    <h3>Έχετε επιλέξει τους παράγοντες:<br/></h3>
    <i>*Η μονάδα μέτρησης και το πεδίο ορισμού είναι προαιρετικό για κάθε παράγοντα</i>
    
    
    <form id="myForm" method="post" action="quest_criteriadb.php">
        <?php 
        $_SESSION['quest_type']=2;
        $quest_type = 2;//$_SESSION['quest_type'];
        
            $count=1;
            $sql = "SELECT * from quest2 where q_id=$quest_id  order by c_id";
            $result = mysqli_query($db_conx, $sql);
            while ($row =  mysqli_fetch_array($result)){
                $sql2 = "SELECT * from sub_criteria where sub_criteria_id=".$row['c_id'];
                $result2 = mysqli_query($db_conx, $sql2);
                $row2 =  mysqli_fetch_array($result2);
                echo "<b style='color:royalblue;'>".$row2['sub_cr_name']."</b><br/>";
                echo "<label>Μονάδα μέτρησης : </label>\n";
                echo "<input type=\"checkbox\" class=\"checkboxes1\" name=\"checkboxes$count\" id=\"checkboex$count\" onclick=\"enableName(this, 'unit$count');\"/>\n"; 
                echo "<input class=\"unit\" onchange=\"enableBeforeUnload();\" onkeyup=\"enableBeforeUnload();\" style=\"width: 100px;\" name=\"unit$count\" id=\"unit$count\" type='text' disabled>\n";
                echo "<br/><label>Πεδίο ορισμού:</label>\n"; 
                echo "<input type=\"checkbox\" class=\"checkboxes\" name=\"checkbox$count\" id=\"checkbox$count\" onclick=\"enableName(this, 'from$count');enableName(this, 'to$count');\"/>\n"; 
                echo "<label>Από: </label><input style=\"width:30px;\" type=\"text\" id=\"from$count\"  name=\"from$count\" disabled />\n"; 
                echo "<label>Έως: </label><input style=\"width:30px;\" type=\"text\" id=\"to$count\"  name=\"to$count\" disabled /><br/><br/>";
                $count++;
            } 
        
    ?>
    <h5>Οδηγίες για το πως ο χρήστης θα βαθμολογήσει τους παράγοντες:</h5>
    <textarea rows="4" cols="50" name="description" id="description"></textarea>
    <br/>
    <br />
    <h5>Εισάγετε την χρονολογία που επιθυμείτε</h5>
    <div  id="TextBoxesGroup">
	<div id="TextBoxDiv1">
	    <label>Χρονολογία #1 : </label><input class="textBoxes" onchange="enableBeforeUnload();"
              onkeyup="enableBeforeUnload();" style="margin-left: 27px; width: 100px;" name="textbox1" id="textbox1" type='text' id='textbox1'>
            <!--<label>Μονάδα μέτρησης : </label>
            <input class="unit" onchange="enableBeforeUnload();" onkeyup="enableBeforeUnload();" style="margin-left: 34.5px; width: 100px;" name="unit1" id="unit1" type='text'>
            <br/><br/>
            <label>Πεδίο ορισμού:</label>
             <input type="checkbox" class="checkboxes" name="checkbox1" id="checkbox1" onclick="enableName(this, 'from1');enableName(this, 'to1');"/>
             <label>Από: </label><input style="width:30px;" type="text" id="from1"  name="from1" disabled />
             <label>Έως: </label><input style="width:30px;" type="text" id="to1"  name="to1" disabled />
            -->
        </div>
    </div>
    
    <a class="button icon add" style="margin-top: 10px;" id='addButton'>Προσθήκη</a>
    <a class="button icon remove" id='removeButton'>Αφαίρεση</a>
    <br/>
	
	<a href="#!" style="margin-left:280px;" class="button icon approve" onclick="disableBeforeUnload();" type="button" value='Υποβολή' id='addButton'>Υποβολή </a>
    </form>
    


<?php
include_once "footer.php";
?>