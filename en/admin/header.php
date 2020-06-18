<?php
//Start session
session_start();
ob_start();
 
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

    
<link rel="stylesheet" type="text/css" media="all" href="jsDatePick_ltr.min.css" />
<script type="text/javascript" src="jsDatePick.min.1.3.js"></script>


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
            echo '<a href="#!"> <img src="../../images/Hopstarter-Flag-Borderless-United-Kingdom.ico" width="10" height="10"/> English </a>';
            echo '<a href="../../el/admin/'.$page.'"> <img src="../../images/Hopstarter-Flag-Borderless-Greece.ico" width="10" height="10"/> Ελληνικά </a>';
        echo '</ul>';
echo '</li>'
    ?>
    <script>    
$(function() {

    var $sidebar   = $("#sidebar"), 
        $window    = $(window),
        offset     = $sidebar.offset(),
        topPadding = 15;

    $window.scroll(function() {
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
    
<div id="templatemo_header_wrapper">
	<div id="templatemo_header">
    	<div id="site_title" align="center"></div>
        <p id="intro_text"><a href="http://www.hua.gr/index.php/en/" target="_blank">Harokopion University</a> - <a href="http://www.dit.hua.gr/index.php/en/" target="_blank"> Department of Informatics and Telematics</a></p>
        <p id="intro_text">Online Decision Maker</p>
    </div>
</div>
    
<!--START ARTICLE--->    
<div>     
<div id="templatemo_main_wrapper">
    <?php
        include_once "sidebar.php";
    ?>
    <div id="templatemo_main_upline">
        <div id="templatemo_main">
            <div id="content">
                <div class="section">
    
    
    
    