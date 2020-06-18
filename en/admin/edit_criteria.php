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



            var newTextBoxDiv = $(document.createElement('div'))
                    .attr("id", 'TextBoxDiv' + counter);

            newTextBoxDiv.after().html('<br /><label>Κριτήριο #' + counter + ' : </label>' +
                    '<input type="text" onchange="enableBeforeUnload();"' +
                    'onkeyup="enableBeforeUnload();" class="textBoxes" name="textbox' + counter +
                    '" style="margin-left: 27px;  width: 250px;" id="textbox' + counter + '" >' +
                    '<br />' +
                    '<label >Περιγραφή : </label><br /><textarea class="description" onchange="enableBeforeUnload();"' +
                    'onkeyup="enableBeforeUnload();" rows="2" cols="50" name="description' + counter + '" id="description' + counter + '"></textarea> ');

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

</head><body>

    <form id="myForm" method="post" action="edit_criteriadb.php">

        <div id="TextBoxesGroup1">
            <?php
            $update = "update criteria set sub_criteria=2 where r_id=$research_id";
            if (!mysqli_query($db_conx, $update)) {
                mysqli_rollback($db_conx);
                $_SESSION['error'] = 'all ok';
                echo "<meta charset='utf-8'>";
                $message = "Η ενημέρωση των κριτηρίων απέτυχε. Error: 1";
                //echo "<script type='text/javascript'>alert('$message'); history.go(-1);</script>";
                die('Error: 1' . mysqli_error($db_conx));
            }


            $count = 1;
            $query = "SELECT * FROM criteria where r_id = $research_id ORDER BY criterion_id ASC";
            $result = mysqli_query($db_conx, $query);
            while ($row = mysqli_fetch_array($result)) {
                echo '<div id="TextBoxDivs' . $count . '"><br /><a title="Delete" href="delete_criteria.php?criteria_id=' . $row['criterion_id'] . '"><img style="height:14px; width=14px;" src="./img/1402551032_Erase.png"></a>&nbsp&nbsp&nbsp';
                echo '<label>Κριτήριο #' . $count . ' : </label><input value="' . $row['c_name'] . '" style="margin-left: 27px; width: 250px;" name="textbox|' . $row['criterion_id'] . '" type="text" id="textbox' . $count . '">';

                echo '<br/><label >Περιγραφή : </label><br /><textarea value="" class="description" rows="2" cols="50" name="description|' . $row['criterion_id'] . '" id="description1" >' . $row['c_description'] . '</textarea>';

                echo '</div>';
                $count++;
            }
            echo '<script>count=' . $count . '; </script>';
            ?>
        </div>

        <br />
        <br/>
        <a href="#" style="margin-left:280px;" class="button icon approve" onclick="document.getElementById('myForm').submit();" type="button" value='Υποβολή'>Αποθήκευση </a>
    </form>

    <h3>Εισάγετε κριτήρια</h3>
    <form id="myForm2" method="post" action="edit_insert_criteria.php">

        <div  id="TextBoxesGroup">
            <div id="TextBoxDiv1">
                <label>Κριτήριο #1 : </label><input class="textBoxes" onchange="enableBeforeUnload();"
                                                    onkeyup="enableBeforeUnload();" style="margin-left: 27px; width: 250px;" name="textbox1" id="textbox1" type='text' id='textbox1'>
                <br />
                <label >Περιγραφή : </label><br /><textarea class="description" onchange="enableBeforeUnload();"
                                                            onkeyup="enableBeforeUnload();" rows="2" cols="50" value="" name="description1" id="description1"></textarea> 

            </div>
        </div>
        <a class="button icon add" style="margin-top: 10px;" id='addButton'>Προσθήκη</a>
        <a class="button icon remove" id='removeButton'>Αφαίρεση</a>
        <a href="#!" class="button icon arrowright" onclick="disableBeforeUnload();" type="button" value='Υποβολή'>Επόμενο </a>

    </form>

    </br></br>

    <?php
    include_once "footer.php";
    ?>


