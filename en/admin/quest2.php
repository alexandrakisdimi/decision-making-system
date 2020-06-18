<!--HEADER-->

<?php
include_once "header.php";
include_once "../../dbcon.php";

//check if research is created
if (!isset($_SESSION['research_id'])) {
    echo "<script>window.location='create_research.php';</script>";
} else {
    $research_id = $_SESSION['research_id'];
}
//check if questionnaire is created
if (!isset($_SESSION['quest_id'])) {
    echo "<script> window.location='create_quest.php';</script>";
} else {
    $quest_id = $_SESSION['quest_id'];
}
?>

<!--Javascript-->

<script>
    function isNumber(evt, id) {

        //var flagatsi = 0;
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;

        if ((charCode < 48 || charCode > 57)) {

            if (charCode == 8 || charCode == 37 || charCode == 39) { //|| charCode == 127


                return true;
            } else {

                if (document.getElementById(id).value.toLowerCase().indexOf(".") == -1 && charCode == 46) {
                       
                    return true;

                } else {

                    return false;
                }
            }
        } else {

            if (charCode > 47 && charCode < 58) {
                /* alert("mpike 5");*/

                return true;
            }
            //myset(id);
            return false;
        }

    }
</script>

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
        
        var unit = document.getElementsByClassName("checkboxes1");
        for (var i=0; i<unit.length; i++ ){
            if(unit[i].checked){
                if(document.getElementById('unit_'+(i+1)).value == ''){
                    alert("Δεν έχετε εισάγει μονάδα μέτρησης για τον παράγοντα "+(i+1));
                    return false; // prevent default click action from happening!
                    e.preventDefault(); // same thing as above 
                } 
            }
        }
        
        var range = document.getElementsByClassName("checkboxes");
        for (var i=0; i<range.length; i++ ){
            if(range[i].checked){
                if((document.getElementById('from_'+(i+1)).value == '') || (document.getElementById('to_'+(i+1)).value == '') ){
                    alert("Δεν έχετε εισάγει σωστό εύρος τιμών για τον παράγοντα "+(i+1));
                    return false; // prevent default click action from happening!
                    e.preventDefault(); // same thing as above 
                }
            }
        }
        
        var all = document.getElementsByClassName("textBoxes");
        
        for (var i=0; i<all.length; i++ ){
            if(all[i].value==''){ alert("Δεν έχετε εισάγει το όνομα της χρονολογίας #"+(i+1));
                return false; // prevent default click action from happening!
                e.preventDefault(); // same thing as above
            }
            
        }
            
        document.getElementById('myForm').submit();
        
    }
</script>

<script>
    //enable and disable textfields
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


<form id="myForm" method="post" action="quest2db.php">
    <?php
    $_SESSION['quest_type'] = 2;
    $quest_type = 2;

    $count = 1;
    $sql = "SELECT * from quest2 where q_id=$quest_id  order by c_id";
    $result = mysqli_query($db_conx, $sql);
    while ($row = mysqli_fetch_array($result)) {
        $sql2 = "SELECT * from sub_criteria where sub_criteria_id=" . $row['c_id'];
        $result2 = mysqli_query($db_conx, $sql2);
        $row2 = mysqli_fetch_array($result2);
        echo "<b style='color:royalblue;'>" . $row2['sub_cr_name'] . "</b><br/>";
        echo "<label>Μονάδα μέτρησης : </label>\n";
        echo "<input type=\"checkbox\" class=\"checkboxes1\" value='" . $row2['sub_criteria_id'] . "' name=\"checkboxes_$count\" id=\"checkboxes_$count\" onclick=\"enableName(this, 'unit_$count');\"/>\n";
        echo "<input class=\"unit\"  onchange=\"enableBeforeUnload();\" onkeyup=\"enableBeforeUnload();\" style=\"width: 100px;\" name=\"unit_$count\" id=\"unit_$count\" type='text' disabled>\n";
        echo "<br/><label>Πεδίο ορισμού:</label>\n";
        echo "<input type=\"checkbox\" class=\"checkboxes\" value='" . $row2['sub_criteria_id'] . "' name=\"checkbox_$count\" id=\"checkbox_$count\" onclick=\"enableName(this, 'from_$count');enableName(this, 'to_$count');\"/>\n";
        echo "<label>Από: </label><input style=\"width:30px;\" type=\"text\" onkeypress=\"return isNumber(event , this.id);\" onchange=\"enableBeforeUnload();\" onkeyup=\"enableBeforeUnload();\" id=\"from_$count\"  name=\"from_$count\" disabled />\n";
        echo "<label>Έως: </label><input style=\"width:30px;\" type=\"text\" onkeypress=\"return isNumber(event , this.id);\" onchange=\"enableBeforeUnload();\" onkeyup=\"enableBeforeUnload();\" id=\"to_$count\"  name=\"to_$count\" disabled /><br/><br/>";
        $count++;
    }
    $count--;
    $_SESSION['counter'] = $count;
    ?>
    <h5>Οδηγίες για το πως ο χρήστης θα βαθμολογήσει τους παράγοντες (προαιρετικό):</h5>
    <textarea rows="4" cols="50" name="description" id="description"></textarea>
    <br/>
    <br />
    <h5>Εισάγετε την χρονολογία που επιθυμείτε</h5>
    <div  id="TextBoxesGroup">
        <div id="TextBoxDiv1">
            <label>Χρονολογία #1 : </label><input class="textBoxes" onchange="enableBeforeUnload();"
                                                  onkeyup="enableBeforeUnload();" style="margin-left: 27px; width: 100px;" name="textbox1" id="textbox1" type='text' id='textbox1'>

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