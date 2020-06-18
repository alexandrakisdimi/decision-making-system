<?php
include_once "header.php";
include_once "../../dbcon.php";
if (!isset($_SESSION['research_id']))
    echo "<script>window.location='create_research.php';</script>";
$research_id = $_SESSION['research_id'];
?>


<!----------------------CONTENT---------------------->

<h2 style="margin-top:15px;">Επεξεργαστείτε τα κριτήρια της έρευνας</h2>

<script >
    var counter = 2;

    $(function () {







        $("#addButton").click(function () {

            if (counter > 10) {
                alert("Only 10 textboxes allow");
                return false;
            }
            var newTextBoxDiv = $(document.createElement('div'))
                    .attr("id", 'TextBoxDiv' + counter);

            newTextBoxDiv.after().html('<br /><label>Παράγοντας #' + counter + ' : </label>' +
                    '<input type="text" onchange="enableBeforeUnload();"' +
                    'onkeyup="enableBeforeUnload();" class="textBoxes" name="textbox' + counter +
                    '" style="margin-left: 27px;  width: 250px;" id="textbox' + counter + '" value="" >' +
                    '<br />' +
                    '<label >Περιγραφή : </label><br /><textarea class="description" onchange="enableBeforeUnload();"' +
                    'onkeyup="enableBeforeUnload();" rows="2" cols="50" value="" name="description' + counter + '" id="description"></textarea> ');

            newTextBoxDiv.appendTo("#TextBoxesGroup");
            counter++;
        });


        $("#removeButton").click(function () {
            if (counter == 1) {
                alert("Δεν υπάρχουν άλλα πεδία για αφαίρεση");
                return false;
            }

            counter--;

            $("#TextBoxDiv" + counter).remove();

        });


        $("#getButtonValue").click(function () {

            var msg = '';
            for (i = 1; i < counter; i++) {
                msg += "\n Textbox #" + i + " : " + $('#textbox' + i).val();
            }
            alert(msg);
        });
    });
</script>

<script>
    function formCheck() {

        document.getElementById('myForm2').submit();

    }
    ;
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
    ;

</script>


<form id="myForm" method="post" action="edit_factorsdb.php">

    <?php
    $query = "SELECT * FROM criteria where r_id={$_SESSION['research_id']} and sub_criteria=2 ORDER BY criterion_id;";
    $result = mysqli_query($db_conx, $query);
    $count = 1;
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        $_SESSION['criterion_id'] = $row['criterion_id'];
        echo "<h3>Επεξεργαστείτε τους παράγοντες για το κριτήριο: <label style='color: red;'>" . $row['c_name'] . "</h3>";
        echo '<div id="TextBoxesGroup1">';
        $count = 1;
        $query2 = "SELECT * FROM sub_criteria where c_id=" . $row['criterion_id'] . " ORDER BY sub_criteria_id ASC";
        $result2 = mysqli_query($db_conx, $query2);
        while ($row2 = mysqli_fetch_array($result2)) {
            echo '<div id="TextBoxDivs' . $count . '"><br /><a href="delete_factors.php?sub_criteria_id=' . $row2['sub_criteria_id'] . '"><img style="height:14px; width=14px;" src="./img/1402551032_Erase.png"></a>&nbsp&nbsp&nbsp';
            echo '<label>Υποκριτήριο #' . $count . ' : </label><input value="' . $row2['sub_cr_name'] . '" style="margin-left: 27px; width: 250px;" name="textbox|' . $row2['sub_criteria_id'] . '" type="text" id="textbox' . $count . '">';
            echo '<br/><label >Περιγραφή : </label><br /><textarea value="" class="description|' . $row2['sub_criteria_id'] . '"  rows="2" cols="50" name="description|' . $row2['sub_criteria_id'] . '" id=\"description1\" >' . $row2['sub_cr_description'] . '</textarea>';
            echo '</div>';
            $count++;
        }
        echo '</div>';
    } else if (mysqli_num_rows($result) == 0) {
        echo "<script type='text/javascript'>window.location = 'edit_alternatives.php'</script>";
    }
    ?>
    <a href="#" style="margin-left:280px; margin-top: 10px;" class="button icon approve" onclick="document.getElementById('myForm').submit();" type="button" value='Αποθήκευση'>Αποθήκευση</a>

</form>

<form method="post" id="myForm2" action="edit_insert_factors.php">

    <?php
    $query = "SELECT * FROM criteria where r_id={$_SESSION['research_id']} and sub_criteria=2 ORDER BY criterion_id;";
    $result = mysqli_query($db_conx, $query);
    $count = 1;
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        echo "<h3>Εισάγετε παράγοντες για το κριτήριο: <br/><br/><label style='color: red;'>" . $row['c_name'] . "</h3>";
        echo '<div id="TextBoxesGroup">';
        $count = 1;

        echo '<div id="TextBoxDiv' . $count . '"><br />';
        echo '<label>Παράγοντας #' . $count . ' : </label><input class="textboxes" value="" onchange="enableBeforeUnload();"
                        onkeyup="enableBeforeUnload();" style="margin-left: 27px; width: 250px;" name="textbox' . $count . '" type="text" id="textbox' . $count . '">';
        $_SESSION['c_id'] = $row['criterion_id'];
        echo '<br /><label >Περιγραφή : </label><br /><textarea class="description" onchange="enableBeforeUnload();"
                        onkeyup="enableBeforeUnload();" rows="2" cols="50" value="" name="description1" id="description"></textarea>';
        echo '</div>';
        $count++;

        echo '</div>';
        echo '<script>counter=' . $count . '; var criterion_id=' . $row['criterion_id'] . '; </script>';
    }
    ?>  


    <a class="button icon add" style="margin-top: 10px;" id='addButton'>Προσθήκη</a>
    <a class="button icon remove" id='removeButton'>Αφαίρεση</a>

    <br/>

    <a href="#!" style="margin-left:280px;" class="button icon approve" onclick="disableBeforeUnload();" type="button" value='Υποβολή' id='addButton'>Υποβολή </a>
</form>

</br></br>

<?php
include_once "footer.php";
?>


