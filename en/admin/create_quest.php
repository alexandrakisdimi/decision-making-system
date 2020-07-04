<!--HEADER-->
<?php
include_once "header.php";
include_once "../../dbcon.php";
//if (!isset($_SESSION['research_id']))
//    echo "<script>window.location='create_research.php';</script>";
//else {
//    $research_id = $_SESSION['research_id'];
//}
$research_id=98;
?>

<!--SIDEBAR-->
<?php
include_once "sidebar.php";
?>

<!--Javascript-->
<script>
    function formCheck() {
        //check if all textfields are filled in
        if ($('#quest').val() == '') {
            alert("Enter questionnaire name");
            return false;
            e.preventDefault();
        }

        if ($('#quest').val().length < 3) {
            alert("Questionnaire name cannot be less than 3 characters");
            return false;
            e.preventDefault();
        }

        if ($('#description').val() == '') {
            alert("Enter questionnaire description");
            return false;
            e.preventDefault();
        }
        if ($('#description').val().length < 10) {
            alert("Qusetionnaire description cannot be less than 10 characters");
            return false;
            e.preventDefault();
        }

        if ($('input[name=quest_type]:checked').length <= 0) {
            alert("Select type of questionnaire");
            return false;
            e.preventDefault();
        }

        if ($('input[name=c_id]:checked').length <= 0) {
            alert("Please select a criterion");
            return false;
            e.preventDefault();
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

<h2 style="margin-top:15px;">Create a questionnaire <img src="../../images/information.png" title="In case of wrong input, please complete the research and then visit the edit page"/></h2> 
<h3>Enter a name for the questionnaire, a description and select the type of the questionnaire</h3>



<br />

<div>
    <form method="post" id="myForm" action="create_questdb.php">
        <div>
            <label >Questionnaire name: </label><br /><textarea rows="4" cols="50" onchange="enableBeforeUnload();"
                                                                    onkeyup="enableBeforeUnload();" name="quest" id="quest"></textarea> 
            <br />
        </div>

        <br/>
        <div>
            <label>Type:</label>
            <br/>
            <input type="radio" name="quest_type" value=2 id="quest_type">Factor Pairwise comparison by date</input>
            <br/>
            <input type="radio" name="quest_type" value=3 id="quest_type">Factor Pairwise comparison with other factors</input>
        </div>
        <br/><br/>
        <label >Questionnaire Description : </label><br /><textarea onchange="enableBeforeUnload();"
                                                                    onkeyup="enableBeforeUnload();" rows="10" cols="50" name="description" id="description"></textarea> 
        <br/>
        <br/>

        <h3>Choose the criterion that you want the questionnaire to be created</h3>

        <?php
        $query1 = "SELECT * from criteria where r_id=$research_id ORDER BY criterion_id ASC";
        $result1 = mysqli_query($db_conx, $query1);

        echo "<table cellspacing=\"12\">";
        echo "<tr>";
        echo "<td style='width:auto; min-width:300px;'>Criterion: </td>";
        echo "</tr>";
        while ($row = mysqli_fetch_array($result1)) {
            echo "<tr>";
            echo "<td><input id='check' type='radio' name='c_id'  value='" . $row['criterion_id'] . "'>" . $row['c_name'] . "</input></td>";
            echo "</tr>";
        }
        echo "</table>";

        echo '</form>';
        ?>


        <a href="#!" class="button icon arrowright" onclick="disableBeforeUnload();" type="button" value='Submit' id='addButton2'>Next</a>
    </form>

    <a href="unset.php" class="button icon approve" title="Complete Research" type="button" value='Submit' id='addButton2'>Complete Research</a>
</div>


<br/><br/>

<!--FOOTER-->
<?php 
include_once "footer.php"; 
?>

