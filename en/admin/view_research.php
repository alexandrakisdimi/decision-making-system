
<?php
//Start session
session_start();

//Check whether the session variable SESS_MEMBER_ID is present or not
if(!isset($_SESSION['user']) || (trim($_SESSION['type']) == 'user')) {
echo "<meta charset='utf-8'>";
    $message = "You don't have permission to view this page, please login first";
    echo "<script type='text/javascript'>alert('$message'); window.location='../../index.php';</script>";
exit();
}
?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Harokopion University - Department of Informatics and Telematics</title>
<link rel="shortcut icon" type="image/x-icon" href="../../images/favicon.ico">
<meta name="keywords" content="singular theme, free template, web design, clean, simple, professional, CSS, HTML" />
<meta name="description" content="Singular Theme, free CSS template from templatemo.com" />
<link href="../../css/style.css" type="text/css" rel="stylesheet" /> 

<script type="text/javascript" src="../../js/jquery.min.js"></script> 
<script type="text/javascript" src="../../js/jquery.scrollTo-min.js"></script> 
<script type="text/javascript" src="../../js/jquery.localscroll-min.js"></script> 
<script type="text/javascript" src="../../js/init.js"></script> 


<link rel="stylesheet" href="../../css/slimbox2.css" type="text/css" media="screen" />
<link rel="stylesheet" href="../../css3-github-buttons-master/gh-buttons.css" type="text/css" media="screen" /> 
<script type="text/JavaScript" src="../../js/slimbox2.js"></script> 

<!-- Timestamp: 1236819900 --> 
</head> 
<body>

    <?php
    $page = basename($_SERVER['PHP_SELF']);

    echo '<li style="float:right; margin-right: 20px; margin-top: 20px;" class="menu-item menu-item-language menu-item-language-current">';
    echo '<ul class="sub-menu submenu-languages">';
    echo '<a href="../../en/admin/' . $page . '"> <img src="../../images/Hopstarter-Flag-Borderless-United-Kingdom.ico" width="10" height="10"/> English </a>';
    echo '<a href="#"> <img src="../../images/Hopstarter-Flag-Borderless-Greece.ico" width="10" height="10"/> Ελληνικά </a>';
    echo '</ul>';
    echo '</li>'
    ?>
    <script>
        $(function () {

            var $sidebar = $("#leftside"),
                    $window = $(window),
                    offset = $sidebar.offset(),
                    topPadding = 15;

            $window.scroll(function () {
                if ($window.scrollTop() > offset.top) {
                    $sidebar.stop().animate({
                        marginTop: $window.scrollTop() - offset.top + topPadding
                    });
                } else {
                    $sidebar.stop().animate({
                        marginTop: 0
                    });
                }
            });

        });
    </script>  

    <style>

        .thetable {

            margin:0px;padding:0px;
            width:800px;
            box-shadow: 0px 0px 0px #888888;
            border:0px solid #000000;

            -moz-border-radius-bottomleft:0px;
            -webkit-border-bottom-left-radius:0px;
            border-bottom-left-radius:0px;

            -moz-border-radius-bottomright:0px;
            -webkit-border-bottom-right-radius:0px;
            border-bottom-right-radius:0px;

            -moz-border-radius-topright:0px;
            -webkit-border-top-right-radius:0px;
            border-top-right-radius:0px;

            -moz-border-radius-topleft:0px;
            -webkit-border-top-left-radius:0px;
            border-top-left-radius:0px;
        }.thetable table{
            border-collapse: collapse;
            border-spacing: 0;
            width:100%;
            height:100%;
            margin:0px;padding:0px;
        }.thetable tr:last-child td:last-child {
            -moz-border-radius-bottomright:0px;
            -webkit-border-bottom-right-radius:0px;
            border-bottom-right-radius:0px;
        }
        .thetable table tr:first-child td:first-child {
            -moz-border-radius-topleft:0px;
            -webkit-border-top-left-radius:0px;
            border-top-left-radius:0px;

        }
        .thetable table tr:first-child td:last-child {
            -moz-border-radius-topright:0px;
            -webkit-border-top-right-radius:0px;
            border-top-right-radius:0px;
        }.thetable tr:last-child td:first-child{
            -moz-border-radius-bottomleft:0px;
            -webkit-border-bottom-left-radius:0px;
            border-bottom-left-radius:0px;
        }.thetable tr:hover td{

        }
        /*.thetable tr:nth-child(2n+3){ background-color:#d8d8d8; }*/
        .thetable tr:nth-child(even)    { background-color:#ffffff; }.thetable td{
            vertical-align:middle;
            border:1px solid #000000;
            border-width:0px 0px 0px 0px;
            text-align:center;
            padding:5px;
            font-size:10px;
            font-family:Arial;
            font-weight:normal;
            color:#000000;
        }.thetable tr:last-child td{
            border-width:0px 0px 0px 0px;
        }.thetable tr td:last-child{
            border-width:0px 0px 0px 0px;
        }.thetable tr:last-child td:last-child{
            border-width:0px 0px 0px 0px;
        }
        /*............................zaxos...................*/
        .thetable td:first-child{

            background-color:royalblue;
            border:0px solid #000000;
            text-align:center;
            border-width:0px 0px 0px 0px;
            font-size:14px;
            font-family:Arial;
            font-weight:bold;
            color:#ffffff;
        }
        .thetable tr:nth-child(2n+3) td:first-child{
            background-color:transparent;
            opacity: 0;
        }
        .thetable tr:nth-child(2n+3) td:nth-child(1n+0){
            background-color:royalblue;
            border:0px solid #000000;
            text-align:center;
            border-width:0px 0px 0px 0px;
            font-size:14px;
            font-family:Arial;
            font-weight:bold;
            color:#ffffff;
        }
        /*............................end.....................*/
        .thetable tr:first-child td:first-child{
            background-color:transparent;
            display: inline;
            opacity: 0;
        }
        .thetable tr:first-child td{
            background-color:royalblue;
            border:0px solid #000000;
            text-align:center;
            border-width:0px 0px 0px 0px;
            font-size:14px;
            font-family:Arial;
            font-weight:bold;
            color:#ffffff;
        }

        .thetable tr:first-child td:first-child{
            border-width:0px 0px 0px 0px;
        }
        .thetable tr:first-child td:last-child{
            border-width:0px 0px 0px 0px;
        }
    </style>



    <script>
        $(function () {

            var $sidebar = $("#sidebar"),
                    $window = $(window),
                    offset = $sidebar.offset(),
                    topPadding = 15;

            $window.scroll(function () {
                if ($window.scrollTop() > offset.top) {
                    $sidebar.stop().animate({
                        marginTop: $window.scrollTop() - offset.top + topPadding
                    });
                } else {
                    $sidebar.stop().animate({
                        marginTop: 0
                    });
                }
            });

        });
    </script>  

    <script>
        function hideDiv(id) {

            var elements = document.getElementsByClassName("section");
            for (i = 0; i < elements.length; i++) {
                elements[i].style.display = 'none';

            }

            document.getElementById(id).style.display = "block";

        }

    </script>

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

    $research_id = decrypt_url($_GET['research_id']);
    ?>

    <div id="templatemo_header_wrapper">
        <div id="templatemo_header">
            <div id="site_title" align="center"></div>
            <p id="intro_text"><a href="http://www.hua.gr/index.php/en/" target="_blank">Harokopion University</a> - <a href="http://www.dit.hua.gr/index.php/en/" target="_blank"> Department of Informatics and Telematics</a></p>
            <p id="intro_text">Online Decision Maker</p>
        </div>
    </div>

    <!--START ARTICLE--->    
    <div id="templatemo_main_wrapper">


        <div id="sidebar">
            <div class="navbox" style="margin-top:30px;">
                <ul class="nav">
                    <?php
                    include_once "../../dbcon.php";
                    $_SESSION['research_id'] = $research_id;
                    $sql = "SELECT * from quest where r_id=$research_id ORDER BY quest_id ASC";
                    $result = mysqli_query($db_conx, $sql);
                    while ($row = mysqli_fetch_array($result)) {
                        echo '<li><a href="#!" name="i' . $row['quest_id'] . '"  onclick="hideDiv(\'i' . $row['quest_id'] . '\');">' . $row['qname'] . '</a></li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
        <div id="templatemo_main_upline">
            <div id="templatemo_main" style="min-height: 600px;">

                <div id="content" style="overflow-x: scroll;">
                    <form id="myForm" method="POST" action="save_answers.php">
                        <?php
                        $sql2 = "SELECT * from quest where r_id=$research_id ORDER BY quest_id ASC";
                        $result34 = mysqli_query($db_conx, $sql2);
                        $counter = 0;
                        while ($row = mysqli_fetch_array($result34)) {
                            if ($row['type'] == 1) {
                                $count = 0;
                                $array = array();
                                $array_desc = array();
                                $array_id = array();
                                $array_t_c_id = array();
                                $array_t_c_name = array();
                                if ($row['sub'] == 0) {
                                    $query3 = "SELECT * from criteria where r_id=$research_id order by criterion_id ASC";
                                    $result3 = mysqli_query($db_conx, $query3);
                                    while ($row3 = mysqli_fetch_array($result3)) {
                                        array_push($array, $row3['c_name']);
                                        array_push($array_id, $row3['criterion_id']);
                                        array_push($array_desc, $row3['c_description']);
                                    }
                                } else if ($row['sub'] == 1) {
                                    $query3 = "SELECT * from sub_criteria where c_id = (SELECT criterion_id from criteria where criterion_id= (SELECT c_id from quest where quest_id=" . $row['quest_id'] . ")) order by sub_criteria_id";
                                    $result3 = mysqli_query($db_conx, $query3);
                                    while ($row3 = mysqli_fetch_array($result3)) {
                                        array_push($array, $row3['sub_cr_name']);
                                        array_push($array_id, $row3['sub_criteria_id']);
                                        array_push($array_desc, $row3['sub_cr_description']);
                                    }
                                } else if ($row['sub'] == 2) {
                                    $query3 = "SELECT * from sub_criteria where r_id=$research_id order by sub_criteria_id ASC";
                                    $result3 = mysqli_query($db_conx, $query3);
                                    while ($row3 = mysqli_fetch_array($result3)) {
                                        array_push($array_t_c_id, $row3['sub_criteria_id']);
                                        array_push($array_t_c_name, $row3['sub_cr_name']);
                                    }
                                    $query4 = "SELECT * from technology where r_id=$research_id order by t_id ASC";
                                    $result4 = mysqli_query($db_conx, $query4);
                                    while ($row4 = mysqli_fetch_array($result4)) {
                                        array_push($array, $row4['t_name']);
                                        array_push($array_id, $row4['t_id']);
                                        array_push($array_desc, $row4['t_description']);
                                    }
                                }

                                $num_rows = count($array);
                                $t_counter = count($array_t_c_id);
                                if ($counter > 0) {
                                    echo '<div class = "section" id = "i' . $row['quest_id'] . '" style="display:none;">';
                                    echo '<h3>' . $row['qname'] . '&nbsp<img title="' . $row['description'] . '" src="../../images/information.png"/></h3>';
                                } else {
                                    echo '<div class = "section" id = "i' . $row['quest_id'] . '" style="display:block;">';
                                    echo '<h3>' . $row['qname'] . '&nbsp<img title="' . $row['description'] . '" src="../../images/information.png"/></h3>';
                                }
                                if ($row['sub'] == 2) {

                                    for ($k = 0; $k < $t_counter; $k++) {
                                        $count = 0;
                                        if ($k != 0)
                                        {
                                            echo '<table id="par_' . $k . '" class="thetable" style="display:none;">';
                                            echo '<h4 id="title_' . $k . '" style="display:none; font-style: italic;">' . $array_t_c_name[$k] . '</h4>';
                                        }
                                        else
                                        {
                                            echo '<table id="par_' . $k . '" class="thetable" style="display:block;">';
                                            echo '<h4 id="title_' . $k . '" style="display:block; font-style: italic;">' . $array_t_c_name[$k] . '</h4>';
                                        }
                                        
                                        for ($j = $count; $j < $num_rows - 1; $j++) {

                                            echo '<tr>';
                                            echo '<td>';
                                            echo '</td>';
                                            for ($i = $count + 1; $i < $num_rows; $i++) {
                                                echo '<td>';
                                                echo '<label title="' . $array_desc[$i] . '">' . $array[$i] . '</label>';
                                                echo '</td>';
                                            }
                                            echo '</tr>';


                                            echo '<tr>';
                                            echo '<td>';
                                            echo '<label title="' . $array_desc[$j] . '">' . $array[$j] . '</label>';
                                            echo '</td>';
                                            for ($i = $j; $i < $num_rows - 1; $i++) {
                                                echo '<td>';
                                                $sql = "select * from technology_answers where q_id={$row['quest_id']} and u_id={$_SESSION['user']} and r_id={$research_id} and t1_id={$array_id[$j]} and t2_id={$array_id[$i + 1]} and f_id={$array_t_c_id[$k]}";
                                                $result_answers = mysqli_query($db_conx, $sql);
                                                if ($row_ansers = mysqli_fetch_array($result_answers)) {
                                                    echo '<input type="text" readonly style="text-align: center;" name="' . $row['quest_id'] . '|' . $array_id[$j] . '|' . $array_id[$i + 1] . '|' . $array_t_c_id[$k] . '" value="' . $row_ansers['value'] . '"/>';
                                                } else {
                                                    echo '<input type="text" readonly style="text-align: center;" name="' . $row['quest_id'] . '|' . $array_id[$j] . '|' . $array_id[$i + 1] . '|' . $array_t_c_id[$k] . '"/>';
                                                }
                                                echo '</td>';
                                            }

                                            echo '</tr>';
                                            $count++;
                                        }
                                        echo '</table>';
                                    }

                                    echo '<div><a href="#"  onclick="hideNextPrevious(-1)" class="button icon arrowleft" type="button" >Previous </a>';
                                    echo '<a href="#"  onclick="hideNextPrevious(1)" class="button icon arrowright" type="button">Next </a></div>';
                                    echo "</div>";
                                } else {

                                    echo '<table class="thetable">';
                                    for ($j = $count; $j < $num_rows - 1; $j++) {

                                        echo '<tr>';
                                        echo '<td>';
                                        echo '</td>';
                                        for ($i = $count + 1; $i < $num_rows; $i++) {
                                            echo '<td>';
                                            echo '<label title="' . $array_desc[$i] . '">' . $array[$i] . '</label>';
                                            echo '</td>';
                                        }
                                        echo '</tr>';


                                        echo '<tr>';
                                        echo '<td>';
                                        echo '<label title="' . $array_desc[$j] . '">' . $array[$j] . '</label>';
                                        echo '</td>';
                                        for ($i = $j; $i < $num_rows - 1; $i++) {
                                            echo '<td>';
                                            $sql = "select * from answers where q_id={$row['quest_id']} and u_id={$_SESSION['user']} and r_id={$research_id} and c_id1={$array_id[$j]} and c_id2={$array_id[$i + 1]} ";
                                            $result_answers = mysqli_query($db_conx, $sql);
                                            if ($row_ansers = mysqli_fetch_array($result_answers)) {
                                                echo '<input type="text" readonly style="text-align: center;" name="' . $row['quest_id'] . '|' . $array_id[$j] . '|' . $array_id[$i + 1] . '" value="' . $row_ansers['value'] . '"/>';
                                            } else {
                                                echo '<input type="text" readonly style="text-align: center;" name="' . $row['quest_id'] . '|' . $array_id[$j] . '|' . $array_id[$i + 1] . '"/>';
                                            }
                                            echo '</td>';
                                        }

                                        echo '</tr>';
                                        $count++;
                                    }
                                    echo '</table>';
                                    echo "</div>";
                                }
                                $counter++;
                            }
                        }
                        ?>
                        <a href="#"  onclick="document.getElementById('myForm').submit()" class="button icon approve" type="button" value='Υποβολή' id='addButton'>Save </a> 
                        <a href="available_quests.php" class="button icon remove" type="button" value='Υποβολή' id='addButton'>Cancel </a>
                    </form>
                    <script>
                        var viewtable = "par_0";
                            
                        function hideNextPrevious(pr) {
                            var res = viewtable.split("_"); 
                            if ( (parseInt(res[1])+pr) > 0 && (parseInt(res[1])+pr)< <?php echo $t_counter;?> )
                            {
                                elements = document.getElementById(viewtable).style.display = 'none';
                                elements = document.getElementById("title_"+res[1]).style.display = 'none';
                                viewtable = "par_"+(parseInt(res[1])+pr);
                                elements = document.getElementById("par_"+(parseInt(res[1])+pr)).style.display = 'block';
                                elements = document.getElementById("title_"+(parseInt(res[1])+pr)).style.display = 'block';
                            }
                            
                        }

                    </script>
                    <?php
                    include_once "footer.php";
                    ?>