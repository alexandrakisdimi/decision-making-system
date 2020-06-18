<?php
session_start();
if (isset($_SESSION['type']) && trim($_SESSION['type']) == 'user') {
    echo "<script>window.location='./en/user/user_main.php';</script>";
} else if (isset($_SESSION['type']) && trim($_SESSION['type']) == 'admin') {
    echo "<script> window.location='./en/admin/main.php';</script>";
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Harokopion University - Department of Informatics and Telematics</title>
        <link rel="shortcut icon" type="image/x-icon" href="./images/favicon.ico">
            <meta name="keywords" content="singular theme, free template, web design, clean, simple, professional, CSS, HTML" />
            <meta name="description" content="Singular Theme, free CSS template from templatemo.com" />
            <link href="../css/index.css" type="text/css" rel="stylesheet" /> 


            <script type="text/javascript" src="../js/jquery.min.js"></script> 
            <script type="text/javascript" src="../js/jquery.scrollTo-min.js"></script> 
            <script type="text/javascript" src="../js/jquery.localscroll-min.js"></script> 
            <script type="text/javascript" src="../js/init.js"></script> 

            <link rel="stylesheet" href="../css/slimbox2.css" type="text/css" media="screen" /> 
            <script type="text/JavaScript" src="../js/slimbox2.js"></script> 

            <!-- Timestamp: 1236819900 --> 
    </head> 
    <body> 

        <li style="float:right; margin-right: 20px; margin-top: 20px;" class="menu-item menu-item-language menu-item-language-current">
            <ul class="sub-menu submenu-languages">
                <a href="#!"> <img src="../images/Hopstarter-Flag-Borderless-United-Kingdom.ico" width="20" height="20"/> English </a>
                <a href="../index.php"> <img src="../images/Hopstarter-Flag-Borderless-Greece.ico" width="20" height="20"/> Ελληνικά </a>        
            </ul>
        </li>

        <div id="templatemo_header_wrapper">
            <div id="templatemo_header">
                <div id="site_title" align="center" ></div>
                <p id="intro_text">Online decision making system</p>
                <p id="intro_text">Descision Maker</p>
                <p id="intro_text"><a href="http://www.hua.gr/index.php/en/" target="_blank">Harokopion University</a> - <a href="http://www.dit.hua.gr/index.php/en/" target="_blank">Department of Informatics and Telematics</a></p> 
            </div>
        </div>

        <!--START ARTICLE-->
        <div id="templatemo_main_wrapper">
            <div id="templatemo_main_upline">

                <div id="templatemo_main">
                    <div id="content"> 
                        <div id="home" class="section">
                            <ul id="templatemo_menu">
                                <!--START ARTICLE-->
                                <li><a href="#login" class="login"><span>Login</span></a></li>
                                <li><a href="#about" class="about"><span>About</span></a></li>
                                <li class="no_margin_right"><a href="#contact" class="contact"><span>Contact</span></a></li>

                            </ul>
                        </div>
                        <!----------------------LOGIN----------------------------->            
                        <div class="section" id="login"> 
                            <div class="ribbon"></div>

                            <script>
                                function formCheck() {

                                    if ($('#username').val() == '') {
                                        alert("Please enter username");
                                        return;
                                    }
                                    if ($('#password').val() == '') {
                                        alert("Please enter password");
                                        return;
                                    }

                                    document.getElementById('myForm').submit();

                                }


                                function enterForm(e) {
                                    var key = e.keyCode || e.which;
                                    if (key == 13) {

                                        document.getElementById('myForm').submit()
                                    }
                                }

                            </script>            
                            <form id="myForm" method="post" action="login.php">          
                                <div  class="login2">
                                    <h1>Login</h1>
                                    <p>Enter Username and Password</p>
                                    <form method="post" action="login.php">
                                        <div class="input">
                                            <div class="blockinput">
                                                <input  onkeypress="enterForm(event);" type="mail" placeholder="Username" id="username" name="username" style="height:18px; line-height:18px;">
                                            </div>
                                            <div class="blockinput">
                                                <input  onkeypress="enterForm(event);" type="password" placeholder="Password" id="password" name="password" style="height:18px; line-height:18px;">
                                            </div>
                                        </div>
                                        <button type="button" onclick="formCheck();">Login</button>
                                    </form>
                                    </br> 
                                    <a href="register.php">Register</a>

                                </div>
                            </form>
                            <br/><br/><br/><br/><br/><br/>	
                            <a href="#home" class="home_btn">Home</a> 
                            <a href="#home" class="page_nav_btn previous">Home</a>
                            <a href="#about" class="page_nav_btn next">About</a>
                        </div> 

                        <!----------------------ABOUT----------------------------->            
                        <div class="section" id="about"> 
                            <h1>About</h1>
                            
                            Welcome to the Decision Maker. As a registered user you can participate in our University Researches. The goal of the
                            research is to create a solution for a decision making problem. We compare the alternatives one to the other, calculate
                            their rating, depending on you answers.
                            
                            <br/><br/>
                            This system uses the Analytic Hierarchy Process for the calulation of the results. The analytic hierarchy process (AHP) is a 
                            structured technique for organizing and analyzing complex decisions, based on mathematics and psychology. It was developed by 
                            Thomas L. Saaty in the 1970s and has been extensively studied and refined since then.It has particular application in group 
                            decision making,[1] and is used around the world in a wide variety of decision situations, in fields such as government, business, 
                            industry, healthcare, and education.
                            
                            <br/><br/>
                            The Decision Maker, of Harokopeion University, is the first online decision making system in Greece. Plenty of companies offer
                            software for calculating decisions but none of the can provide the same capabilities with the Decision Maker
                            
                            <br/><br/>
                            Help us with your participation to make complete the researches and feel free to feedback us on any occasion
                            

                            <a href="#home" class="home_btn">Home</a> 
                            <a href="#login" class="page_nav_btn previous">Login</a>
                            <a href="#contact" style="padding-right: 90px;" class="page_nav_btn next">Contact</a> 
                        </div> 


                        <!----------------------CONTACT----------------------------->            
                        <div class="section" id="contact"> 
                            <h1>Contact</h1> 
                            <div class="half right">

                                Harokopio University is located in Kallithea, at 70, El. Venizelou str., and the Department of Informatics & Telematics is located at 9, Omirou str., Tavros.

 


                                <ul id="social_links">
                                    <li><a href="https://www.facebook.com/groups/xarokopeioDIT/?fref=ts" target="_blank" class="facebook">Facebook</a></li>
                                    <li><a href="#" class="youtube" target="_blank">Youtube</a></li>
                                </ul>

                            </div>

                            <div class="half left">
                                <h4>Harokopeion University</h4>
                                <h5>Department of Informatics & Telematics</h5>
                                Omirou 9<br />
                                177 78, Tavros<br />
                                <strong>Telephone:</strong> +30 210 9549 280<br />
                                <strong>Fax:</strong> +30 210 9549 281<br />
                                <strong>Ε-mail:</strong> <a href="mailto:itsec@hua.gr">itsec@hua.gr</a><br />

                                <div class="clear h20"></div>
                                <div class="img_nom img_border"><span></span>
                                    <iframe width="350" height="150" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.gr/maps?t=m&amp;q=%CE%BF%CE%BC%CE%B7%CF%81%CE%BF%CF%85+9+%CF%84%CE%B1%CF%85%CF%81%CE%BF%CF%82&amp;ie=UTF8&amp;hq=&amp;hnear=%CE%9F%CE%BC%CE%AE%CF%81%CE%BF%CF%85+9,+%CE%A4%CE%B1%CF%8D%CF%81%CE%BF%CF%82+177+78&amp;ll=37.961997,23.701029&amp;spn=0.010151,0.029955&amp;z=14&amp;iwloc=A&amp;output=embed"></iframe><br /><small><a href="https://maps.google.gr/maps?t=m&amp;q=%CE%BF%CE%BC%CE%B7%CF%81%CE%BF%CF%85+9+%CF%84%CE%B1%CF%85%CF%81%CE%BF%CF%82&amp;ie=UTF8&amp;hq=&amp;hnear=%CE%9F%CE%BC%CE%AE%CF%81%CE%BF%CF%85+9,+%CE%A4%CE%B1%CF%8D%CF%81%CE%BF%CF%82+177+78&amp;ll=37.961997,23.701029&amp;spn=0.010151,0.029955&amp;z=14&amp;iwloc=A&amp;source=embed" style="color:#0000FF;text-align:left">Προβολή μεγαλύτερου χάρτη</a></small>
                                </div>
                                <a href="#home" class="home_btn">Home</a> 
                                <a href="#about" class="page_nav_btn previous">About</a>
                                <a href="#home" class="page_nav_btn next">Home</a>
                            </div> 
                        </div> 
                    </div>
                </div>
            </div>

            <!--END OF ARTICLE--->

            <div id="templatemo_footer_wrapper">

                <div id="templatemo_footer">
                    <p>Copyright © 2014 <a href="">Harokopeion University</a> - <a href="">Department of Informatics and TElematics</a> | Designed by <a href="https://www.facebook.com/dimitris.alexandrakis.73" target="_blank">Alexandrakis Dimitris</a></p>
                    <p>CSS by Templetemo Free CSS Teplates</p>
                </div>
            </div>

    </body> 
</html>