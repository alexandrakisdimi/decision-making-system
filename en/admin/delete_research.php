<?php
include_once "header.php";
include_once "../../dbcon.php";
?>

    <!----------------------CONTENT---------------------->
    
        
        <h2>Select the research you want to delete</h2>
        
        <form method="post" action="delete_researchdb.php" id="myForm">
        <?php
        $query = "SELECT * FROM research ORDER BY rname ASC";
        $result = mysqli_query($db_conx, $query);
            while ($row = mysqli_fetch_array($result)) {
                echo "<label><input type='checkbox' name='mode[]' value='" . $row['research_id'] . "'>" . $row['rname'] . "</label><br />";
            }
            ?>  
            <a href="#!" style="margin-top: 15px;" onclick="document.getElementById('myForm').submit();" class="button icon approve">Submit</a> 
        </form>  


<?php
include_once "footer.php";
?>

