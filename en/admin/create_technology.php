<!--HEADER-->
<?php
include_once "header.php";
//check if a research is created
if (!isset($_SESSION['research_id'])) {
    echo "<script>window.location='create_research.php';</script>";
} else {
    $research_id = $_SESSION['research_id'];
}
?>


<!--Javascript-->
<script >

    var counter = 2;

    $(function () {
        //add a factor and description
        $("#addButton").click(function () {

            if (counter > 10) {
                alert("Only 10 textboxes allow");
                return false;
            }

            var newTextBoxDiv = $(document.createElement('div'))
                    .attr("id", 'TextBoxDiv' + counter);

            newTextBoxDiv.after().html('<br /><label>Technology #' + counter + ' : </label>' +
                    '<input type="text" onchange="enableBeforeUnload();"' +
                    'onkeyup="enableBeforeUnload();" class="textBoxes" name="textbox' + counter +
                    '" style="margin-left: 27px;  width: 250px;" id="textbox' + counter + '" value="" >' +
                    '<br />' +
                    '<label >Description : </label><br /><textarea class="description" onchange="enableBeforeUnload();"' +
                    'onkeyup="enableBeforeUnload();" rows="2" cols="50" value="" name="description' + counter + '" id="description' + counter + '"></textarea> ');

            newTextBoxDiv.appendTo("#TextBoxesGroup");


            counter++;
        });

        //remove a name and description
        $("#removeButton").click(function () {
            if (counter == 1) {
                alert("No more fields to remove!");
                return false;
            }

            counter--;

            $("#TextBoxDiv" + counter).remove();

        });




    });
</script>

<script>
    function formCheck() {
        //check if all textfields are filled in
        var all = document.getElementsByClassName("textBoxes");
        var all2 = document.getElementsByClassName("description");

        for (var i = 0; i < all.length; i++) {
            if (all[i].value == '') {
                alert("Enter name for Technology #" + (i + 1));
                return false; // prevent default click action from happening!
                e.preventDefault(); // same thing as above
            }

        }

        for (var i = 0; i < all.length; i++) {
            if (all2[i].value == '') {
                alert("Enter description for Technology #" + (i + 1));
                return false; // prevent default click action from happening!
                e.preventDefault(); // same thing as above
            }
        }

        document.getElementById('myForm').submit();

    }
</script>

<script type="text/javascript">
//alert message if admin tries to leave page or reload page after filling at least one textfield
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

<!--CONTENT-->
<h2>Create technologies to evaluate <img src="../../images/information.png" title="In case of wrong input, please complete the research and then visit the edit page"/></h2>

    <?php
include_once "../../dbcon.php";

$sql = "SELECT * from research where research_id = $research_id";
$result = mysqli_query($db_conx, $sql);
if (mysqli_num_rows($result) == 0) {
    $message = "No research found!!";
    echo $sql;
    echo "<script type='text/javascript'>alert('$message'); window.location = 'create_research.php';</script>";
    die('Error: ' . mysqli_error($db_conx));
} else if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_array($result);
    echo "<h3>Enter technologies for the following research: <br/><br/><label style='color: red;'>" . $row['rname'] . "</h3>"; 
}
?>

<br/>

<form id="myForm" method="post" action="create_technologydb.php">

    <div  id="TextBoxesGroup">
        <div id="TextBoxDiv1">
            <label>Technology #1 : </label><input class="textBoxes" onchange="enableBeforeUnload();"
                                                   onkeyup="enableBeforeUnload();" style="margin-left: 27px; width: 250px;" name="textbox1" id="textbox1" type='text' id='textbox1'>
            <br />
            <label >Description : </label><br /><textarea class="description" onchange="enableBeforeUnload();"
                                                        onkeyup="enableBeforeUnload();" rows="2" cols="50" value="" name="description1" id="description1"></textarea> 

        </div>
    </div>
    <a class="button icon add" style="margin-top: 10px;" id='addButton'>Add </a>
    <a class="button icon remove" id='removeButton'>Remove </a>
    <a href="#!" class="button icon approve" onclick="disableBeforeUnload();" type="button" value='Submit' id='addButton'>Submit </a>

    <br/>


</form>

</br></br>

<!--FOOTER-->
<?php
include_once "footer.php";
?>
