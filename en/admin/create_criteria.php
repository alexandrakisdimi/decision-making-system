<!--HEADER-->
<?php
//check if admin has created a research
include_once "header.php";
if (!isset($_SESSION['research_id'])) {
    echo "<script>window.location='create_research.php';</script>";
}
?>

<!--Javascript-->
<script >

    var counter = 2;

    $(function () {
        //add a criteria and description
        $("#addButton").click(function () {

            var newTextBoxDiv = $(document.createElement('div'))
                    .attr("id", 'TextBoxDiv' + counter);

            newTextBoxDiv.after().html('<br /><label>Criterion #' + counter + ' : </label>' +
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
    //check if all textfields are filled in
    function formCheck() {

        var all = document.getElementsByClassName("textBoxes");
        var all2 = document.getElementsByClassName("description");

        for (var i = 0; i < all.length; i++) {
            if (all[i].value == '') {
                alert("Enter name for criterion #" + (i + 1));
                return false; // prevent default click action from happening!
                e.preventDefault(); // same thing as above
            }

        }

        for (var i = 0; i < all.length; i++) {
            if (all2[i].value == '') {
                alert("Enter description for criterion #" + (i + 1));
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
<h2>Create Criteria <img src="../../images/information.png" title="In case of wrong input, complete the research and then please visit the edit page"/></h2>
<h3>Enter the name of the criteria and a description</h3>

<form id="myForm" method="post" action="create_criteriadb.php">

    <div  id="TextBoxesGroup">
        <div id="TextBoxDiv1">
            <label>Criterion #1 : </label><input class="textBoxes" onchange="enableBeforeUnload();"
                                                onkeyup="enableBeforeUnload();" style="margin-left: 27px; width: 250px;" name="textbox1" id="textbox1" type='text' id='textbox1'>
            <br />
            <label >Description : </label><br /><textarea class="description" onchange="enableBeforeUnload();"
                                                        onkeyup="enableBeforeUnload();" rows="2" cols="50" value="" name="description1" id="description1"></textarea> 

        </div>
    </div>
    <a class="button icon add" style="margin-top: 10px;" id='addButton'>Add </a>
    <a class="button icon remove" id='removeButton'>Remove </a>
    <a href="#!" class="button icon approve" onclick="disableBeforeUnload();" type="button" value='Υποβολή' id='addButton'>Submit </a>

</form>

<br/><br/>

<!--FOOTER-->
<?php
include_once "footer.php";
?>