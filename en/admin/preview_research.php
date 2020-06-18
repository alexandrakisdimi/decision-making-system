
<?php
include_once "header.php";
include_once "../../dbcon.php";
?>

<h2>Available researches to be answered</h2>

<!----------------------CONTENT---------------------->
<?php
$date = date('Y/m/d H:i:s', strtotime('+1 hours'));
$result = mysqli_query($db_conx, $query);
echo '<ul>';
    $sql = "SELECT * from research where end_date>='$date'";
    $result1 = mysqli_query($db_conx, $sql);
    $row2 = mysqli_fetch_array($result1);

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

    echo '<a style="{color: royalblue;} :visited{color: royalblue;}" href=view_research.php?research_id=' . encrypt_url($row2['research_id']). '><h3 style="color: royalblue"><li style="list-style: square;">' . $row2['rname'] . '</li></h3>';

echo '</ul>';
?>  

<?php
include_once "footer.php";
?>

