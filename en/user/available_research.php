
<?php
include_once "header.php";
include_once "../../dbcon.php";
?>

<h2>List of the researches that you can participate</h2>

<!----------------------CONTENT---------------------->
<?php
$date = date('Y/m/d H:i:s', strtotime('+1 hours'));
$query = "SELECT * FROM research_user where u_id=$user_id";
$result = mysqli_query($db_conx, $query);

function encrypt_url($string) {
            $key = "MAL_979805"; //key to encrypt and decrypts.
            $result = '';
            $test = [];
            for ($i = 0; $i < strlen($string); $i++) {
                $char = substr($string, $i, 1);
                $keychar = substr($key, ($i % strlen($key)) - 1, 1);
                $char = chr(ord($char) + ord($keychar));

                $test[$char] = ord($char) + ord($keychar);
                $result.=$char;
            }

            return urlencode(base64_encode($result));
        }

while ($row = mysqli_fetch_array($result)) {
    $sql = "SELECT * from research where research_id='" . $row['r_id'] . "' and end_date>='$date' and completed=0";
    $result1 = mysqli_query($db_conx, $sql);
    while ($row2 = mysqli_fetch_array($result1)) {
        
        echo '<ul>';
        echo '<a style="{color: royalblue;} :visited{color: royalblue;}" href="answer.php?research_id=' . encrypt_url($row2['research_id']) . '"><h3 style="color: royalblue"><li style="list-style: square;">' . $row2['rname'] . '</li></h3>';

        echo '</ul>';
    }
}
?>  

<?php
include_once "footer.php";
?>

