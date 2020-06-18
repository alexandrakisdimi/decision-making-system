<!--HEADER-->
<?php
include_once "header.php";

//unset previous research_id
if (isset($_SESSION['research_id'])) {
    unset($_SESSION['research_id']);
}
?>

<!--Javascript-->
<script >
//date pick
    $(function () {

        new JsDatePick({
            useMode: 2,
            target: "inputField",
            dateFormat: "%d-%m-%Y"

        });
    });


</script>

<script>
    //check if all fields are filled in
    function formCheck() {
        if ($('#research').val() == '') {
            alert("You have not entered a research name");
            return false; // prevent default click action from happening!
            e.preventDefault(); // same thing as above 
        }
        if ($('#research').val().length < 3) {
            alert("The research name cannot be less than 3 characters");
            return false; // prevent default click action from happening!
            e.preventDefault(); // same thing as above
        }
        if ($('#inputField').val() == '') {
            alert("Please select a date");
            return false; // prevent default click action from happening!
            e.preventDefault(); // same thing as above
        }

        //check if date picked is older than today
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth() + 1; //January is 0!

        var yyyy = today.getFullYear();
        if (dd < 10) {
            dd = '0' + dd
        }
        if (mm < 10) {
            mm = '0' + mm
        }
        var str = $('#inputField').val();
        var array = str.split('-');
        var a = array[0], b = array[1], c = array[2];

        if (yyyy > c) {
            alert("The date cannot be earlier than today's date");
            return false; // prevent default click action from happening!
            e.preventDefault(); // same thing as above
        }
        else if (yyyy == c) {
            if (mm > b) {
                alert("The date cannot be earlier than today's date");
                return false; // prevent default click action from happening!
                e.preventDefault(); // same thing as above
            }
            else if (mm == b) {
                if (dd > a) {
                    alert("The date cannot be earlier than today's date");
                    return false; // prevent default click action from happening!
                    e.preventDefault(); // same thing as above
                }
            }
        }


        if ($('#description').val() == '') {
            alert("Please insert research description");
            return false; // prevent default click action from happening!
            e.preventDefault(); // same thing as above 
        }
        if ($('#description').val().legnth < 10) {
            alert("The description cannot be less than 10 characters");
            return false; // prevent default click action from happening!
            e.preventDefault(); // same thing as above
        }

        document.getElementById('myForm').submit();

    }
</script>

<script type="text/javascript">
//alert message if admin tries to leave page or reload page after filling at least one textfield
    function enableBeforeUnload() {
        window.onbeforeunload = function (e) {
            return "Discard changes?";
        };
    }
    function disableBeforeUnload() {
        window.onbeforeunload = null;
        formCheck();
    }

</script>

<!--CONTENT-->
<h2>Create research <img src="../../images/information.png" title="In case of a mistake, please finish creating the entire research. You can modify the research in the Edit and Publish Research option."/></h2>
<h3>Please enter a name and a brief description for the research</h3>

<br />

<form method="post" id="myForm" action="create_researchdb.php">
    <table cellspacing="20">
        <tr>
            <td><label >Research Name : </label></td>
        </tr>

        <tr>
            <td><textarea rows="4" cols="50" name="research" id="research" onchange="enableBeforeUnload();"
                          onkeyup="enableBeforeUnload();" autofocus="autofocus" ></textarea></td>
        </tr>

        <tr>
            <td>
                <table>
                    <tr>
                        <td>
                            <label>Research end date : </label> 
                        </td>

                        <td>
                            <input onchange="enableBeforeUnload();" onkeyup="enableBeforeUnload();" type="text" name="inputField" size="12" id="inputField" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Research end time : </label> 
                        </td>
                        <td>
                            <input size="12" type="text" value="23:59" name="defaultEntry" id="defaultEntry" size="10">
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr>
            <td>
                <label >Research Description : </label>
            </td>
        </tr>

        <tr>
            <td>
                <textarea onchange="enableBeforeUnload();" onkeyup="enableBeforeUnload();" rows="10" cols="50" name="description" id="description"></textarea>
            </td>
        </tr>
    </table>

    <a href="#!" style="margin-left:280px;" class="button icon approve" onclick="disableBeforeUnload()" type="button" value='Submit'>Submit</a>
</form>

<br/><br/>

<!--FOOTER-->
<?php
include_once "footer.php";
?>