<?php
include_once "header.php";
include_once "../../dbcon.php";
?>

<script >

    $(function () {

        new JsDatePick({
            useMode: 2,
            target: "inputField",
            dateFormat: "%d-%m-%Y"

        });



    });


</script>

<script>
    function formCheck() {

        document.getElementById('myForm').submit();
    }
</script>

<script type="text/javascript">

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

<!----------------------CONTENT---------------------->

<h4 >Επεξεργασία έρευνας</h4>

<br />

<form id="myForm" method="post" action="edit_researchdb.php">

    <?php
    
    
    function decrypt_url($string) {
        $key = "MAL_979805"; //key to encrypt and decrypts.
        $result = '';
        $string = base64_decode(urldecode($string));
        for ($i = 0; $i < strlen($string); $i++) {
            $char = substr($string, $i, 1);
            $keychar = substr($key, ($i % strlen($key)) - 1, 1);
            $char = chr(ord($char) - ord($keychar));
            $result.=$char;
        }
        return $result;
    }
    $research_id = decrypt_url($_GET['research']);
    
    
    unset($_SESSION['research_id']);
    $_SESSION['research_id'] = $research_id;

    $query = "SELECT * FROM research where research_id = $research_id";
    $result = mysqli_query($db_conx, $query);
    if ($row = mysqli_fetch_array($result)) {
        echo '<label >Όνομα έρευνας : </label><br /><textarea rows="4" onchange="enableBeforeUnload();" onkeyup="enableBeforeUnload();" cols="50" name="research">' . $row['rname'] . '</textarea> ';

        $datetime = explode(" ", $row['end_date']);
        $newDate = date("d-m-Y", strtotime($datetime[0]));

        $time = explode(":", $datetime[1]);
        echo '<br/><br/><label>Ημερομηνία λήξης έρευνας : </label><input type="text" onchange="enableBeforeUnload();" onkeyup="enableBeforeUnload();" name="inputField" size="12" id="inputField" value="' . $newDate . '" /><br />';
        echo '<br /><label>Ώρα λήξης έρευνας : </label><input type="text" value="' . $time[0] . ':' . $time[1] . '" name="defaultEntry" id="defaultEntry" size="10"></p>';
        echo '<label >Περιγραφή έρευνας : </label><br /><textarea rows="4" onchange="enableBeforeUnload();" onkeyup="enableBeforeUnload();" cols="50" name="description">' . $row['description'] . '</textarea> ';
    } else {
        echo "<script>alert('Η έρευνα που ζητήσατε δεν υπάρχει'); window.location='edit_publish.php';</script>";
    }
    ?>
    <br />

    <br />
    


    <a href="#!" style="margin-left:280px;" class="button icon approve" onclick="disableBeforeUnload();" type="button" value='Αποθήκευση'>Αποθήκευση</a>
</form>
<?php
include_once "footer.php";
?>