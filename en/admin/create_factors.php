<!--HEADER-->
<?php
include_once "header.php";
include_once "../../dbcon.php";

//check if a research is created
if (!isset($_SESSION['research_id'])){
    echo "<script>window.location='create_research.php';</script>";
}
else {
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

            newTextBoxDiv.after().html('<br /><label>Factor #' + counter + ' : </label>' +
                    '<input type="text" onchange="enableBeforeUnload();"' +
                    'onkeyup="enableBeforeUnload();" class="textBoxes" name="textbox' + counter +
                    '" style="margin-left: 27px;  width: 250px;" id="textbox' + counter + '" value="" >' +
                    '<br />' +
                    '<label >Description : </label><br /><textarea class="description" onchange="enableBeforeUnload();"' +
                    'onkeyup="enableBeforeUnload();" rows="2" cols="50" value="" name="description' + counter + '" id="description"></textarea> ');

            newTextBoxDiv.appendTo("#TextBoxesGroup");
            counter++;
        });

        //remove a name and description
        $("#removeButton").click(function () {
            if (counter == 1) {
                alert("No more fields to remove");
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
                alert("Enter name for factor #" + (i + 1));
                return false; // prevent default click action from happening!
                e.preventDefault(); // same thing as above
            }

        }

        for (var i = 0; i < all.length; i++) {
            if (all2[i].value == '') {
                alert("Enter description for factor #" + (i + 1));
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
<h2>Create factors <img src="../../images/information.png" title="In case of wrong input, please complete the research and then visit the edit page"/></h2>

<form method="post" id="myForm" action="create_factorsdb.php">

    <?php
    $query = "SELECT * FROM criteria where r_id={$_SESSION['research_id']} and sub_criteria=1 ORDER BY criterion_id;";
    $result = mysqli_query($db_conx, $query);
    $count = 1;
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        echo "<h3>Enter factors for criteria: <br/><br/><label style='color: red;'>" . $row['c_name'] . "</h3>";
        echo '<div id="TextBoxesGroup">';
        $count = 1;

        echo '<div id="TextBoxDiv' . $count . '"><br />';
        echo '<label>Factor #' . $count . ' : </label><input class="textboxes" value="" onchange="enableBeforeUnload();"
                        onkeyup="enableBeforeUnload();" style="margin-left: 27px; width: 250px;" name="textbox' . $count . '" type="text" id="textbox' . $count . '">';
        $_SESSION['c_id'] = $row['criterion_id'];
        echo '<br /><label >Description : </label><br /><textarea class="description" onchange="enableBeforeUnload();"
                        onkeyup="enableBeforeUnload();" rows="2" cols="50" value="" name="description1" id="description"></textarea>';
        echo '</div>';
        $count++;

        echo '</div>';
        echo '<script>counter=' . $count . '; var criterion_id=' . $row['criterion_id'] . '; </script>';
    } else if (mysqli_num_rows($result) == 0) {
        echo "<script type='text/javascript'>window.location = 'create_technology.php'</script>";
    }
    ?>  


    <a class="button icon add" style="margin-top: 10px;" id='addButton'>Add </a>
    <a class="button icon remove" id='removeButton'>Remove </a>

    <br/>

    <a href="#!" style="margin-left:280px;" class="button icon approve" onclick="disableBeforeUnload();" type="button" value='Submit' id='addButton'>Submit </a>
</form>

<br/><br/>

<!--FOOTER-->
<?php
include_once "footer.php";
?>