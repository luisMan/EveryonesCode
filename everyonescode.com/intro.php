<?php
session_start();  // as section start do this function
include_once('function.php');


if (isset($_SESSION['user']))
{
    $user     = $_SESSION['user'];
    $object->OnlineUser($user);
    $loggedin = TRUE;
    $userstr  = " ($user)";
}
else
{ $loggedin = FALSE;
//header("Location: index.php" );
}
?>


<!doctype html>
<!--[if lt IE 7]> <html class="ie6 oldie"> <![endif]-->
<!--[if IE 7]>    <html class="ie7 oldie"> <![endif]-->
<!--[if IE 8]>    <html class="ie8 oldie"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="">
<!--<![endif]-->
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Ecode</title>
<script type="text/javascript" src="http:////code.jquery.com/jquery-1.10.2.min.js"></script>
<style type="text/css"> @import "CSS/socialStyle.css"; </style>
</head>



<body>
	<div class = "Wrapper">	
	 <!--======================================================================-->
           <!-- THE NAV SECTION -->
           <div class="nav">
             <!--THE LOGO -->
             <div class="logo"><a href="ecode.php"><img src="icon/logo.png"></img></a></div>
             <!--THE SING-->
             <div class="signIn">
              <?php
              if(!$loggedin){
                 echo '<a href="signIn.php" >Login</a>';
                 echo '<a href="signUp.php" >Sign up</a>';
              }else{
                 echo '<label> Welcome <a href="index.php?view='.$user.'">'.$user.'</a></lable>';
              }
             
              ?>

            </div>

           </div>
      <!--======================================================================-->
           <!-- THE CONTENT SECTION -->

           <div class="content">
           	<!--THE TOP PANEL WILL INCLUDE FEED SLIDE SHOW OF MUST FAMOUS PROGRAMMERS AND THE GAME FEED FOR NEW UPCOMMING GAMES -->
           <div class="TopPanel"> 

                <div class="TopPanel_newFeed">
                  <div id="label">News Feed <a href="ecode.php">load....</a></div>
                   <?php $object->getLastTenPost();  ?>
                </div>
                <div class="TopPanel_slideShow">
                  <div id="label">Top 5 Famous Programmers</div>
                  <?php $object->getTopFiveProgrammers(); ?>
                  <div id="introduce"></div>
                 <script type="text/javaScript" src="js/introSlideShow.js"></script>
                </div>	
                <div class="TopPanel_newGames">
                 <div id="label">New Games <a href="games.php">load....</a></div>

                </div>	
              

           </div>


           <!-- THE BUTTOM PANEL WILL INCLUDE THE TOP 100 FAMOUS PROGRAMMERS
                 NEW UPCOMING VIDEO TUTORIALS TOP 100 MUST ANSWERED QUESTIONS-->
           <div class="BottomPanel"> 
                <div class="BottomPanel_topFamous">
                  <div id="label">List of famous <a href="famous.php">load....</a></div>
                 <?php $object->getLastTenFamous();?>
                </div>
                <div class="BottomPanel_videoTutorials">
                  <div id="label">Video tutorials</div>
              <a href="tutorial.php?Java=tutorial" id="Java" ><div class="perks">Java</div></a>
              <a href="tutorial.php?Cplus=tutorial" id="Cplus" ><div class="perks">C++</div></a>
              <a href="tutorial.php?Assembly=tutorial" id="Assembly" ><div class="perks">Assembly</div></a>
              <a href="tutorial.php?Csharp=tutorial" id="Csharp" ><div class="perks">C#</div></a>
              <a href="tutorial.php?Php=tutorial" id="Php"><div class="perks">Php</div></a>
              <a href="tutorial.php?HTML=tutorial" id="HTML" ><div class="perks">Html</div></a>
              <a href="tutorial.php?JavaScript=tutorial" id="JavaScript"><div class="perks">JavaScript</div></a>
                </div>	
                <div class="BottomPanel_topAnsweredQuestion">
                 <div id="label">Top 3 must answered questions</div>
                  <?php $object->getLastThreeAnsweredQ();?>
                </div>	
              

           </div>
           <!--===========================LAST POST ================================-->
           <div class="LastPost">
            <div id="label">Last post</div>
                <?php  $object->showIntroPost(); ?>
           </div>
        </div>
      <!--======================================================================-->
        <div class="footer">

        </div>
      <!--======================================================================-->
    </div>
    <script type="text/javascript" src="Js/button.js"></script>
    <script type="text/javaScript" src="js/programmingScript.js"></script>
</body>
</html>