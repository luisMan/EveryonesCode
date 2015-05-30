<?php
session_start();  // as section start do this function
include_once('function.php');


$userstr = ' (Guest)';

if (isset($_SESSION['user']))
{
    $user     = $_SESSION['user'];
    $loggedin = TRUE;
    $userstr  = " ($user)";
}
else
{ $loggedin = FALSE;
   
}
?>


<!doctype html>
<!--[if lt IE 7]> <html class="ie6 oldie"> <![endif]-->
<!--[if IE 7]>    <html class="ie7 oldie"> <![endif]-->
<!--[if IE 8]>    <html class="ie8 oldie"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="">
<!--<![endif]-->
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Ecode</title>
<link href="Css/boilerplate.css" rel="stylesheet" type="text/css">
<link href="Css/Intro.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="http:////code.jquery.com/jquery-1.10.2.min.js"></script>

<!--[if lt IE 9]>
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<script src="Js/respond.min.js"></script>
<script src="Js/slide.js"></script>
</head>
<body>
	<div class="gridContainer clearfix"> 
              <div class="slide">
              <img src="images/5.png" alt="#" width="100%" height="700px" > </img>
              <img src="images/6.png" alt="#" width="100%" height="700px"> </img>
              <img src="images/7.png" alt="#" width="100%" height="700px"> </img>
              <img src="images/8.png" alt="#" width="100%" height="700px"> </img>
              <div class="nav">
                    <a id="logo" href="index.php" >Ecode</a>
                    <a id="logIn" href="signIn.php" >Login</a>
              </div>
               <div class="inner-nav">
                     <a id="logo" href="index.php" >Ecode</a>
                    <a id="logIn" href="signIn.php" >Login</a>
               </div>

               <div class="signUpButton">

                  <center><a href="signUp.php"><input type="button" id="singUp" value="Sign up"></input></a></center>
               </div>

              </div>
               <div class="content">
                 <center><div id="countDown"><div id="count">
                        <img class='imgs' src=" "></img>
                        <img class='imgs' src=" "></img>
                        <img class='imgs' src=" "></img>
                        <img class='imgs' src=" "></img>
                        <img class='imgs' src=" "></img>
                        <img class='imgs' src=" "></img>
                        <img class='imgs' src=" "></img>
                        <img class='imgs' src=" "></img>
                        <img class='imgs' src=" "></img>
                        <img class='imgs' src=" "></img>
      
                      </div></div></center>
             
                <div class="aboutE">
                <ul><li><div class="block">
               <center><img src="icon/cod.png"></img></center>
               <span> Everyone should have the opportunity to learn to code.
               Now everyone does has something in common. People all 
               over the world use our social network to learn and obtain
               job opportunity for all types of positions in the field.
               No matter what you are thinking, you can start right now with no 
               fee.
      </span></div></li>
      
      <li><div class="block">
               <center><img src="icon/ch.png"></img></center>
               <span>
               At Ecode, creating a porfolio is simple. Allow people
               to see what you are creating, it will encourage them 
               to follow you, add you and chat with you.
               </span>
      </div></li>
      <li><div class="block">
             <center><img src="icon/peo.png"></img></center>
             
            <span>Browse the thousands of amazing feeds on our social network to find your inspiration. Discover something new, contribute to a idea and join thousands of people who use Ecode every day. </span>
             
      </div></li></ul></div>
      
       <div class="socialBack">
       <!--<img src="icon/soc.png" width="80%" height="500px"  ></img>-->
        <div id="showIntroductory"><?php   $object->showIntroPost(); ?></div>
       </div>
       </div>

       <div class="codePlat">
            <center><span>Code from any platform</span></center>
            <center><table><th colspan="2"></th>
              <tbody><tr>
              <td><img src="images/android.png" width="200px" height="200px"></img></td>
              <td><img src="images/mac.png" width="200px" height="200px"></td>
            </tr></tbody></table>

       </div>
	

   <div class="footer">
      <center><ol>
        <li><a href="index.php">Ecode</a></li>
        <li>Team </li>
        <li>Privacy Policy</li>
      </ol></center>
      <center><span>&copy Ecode 2014</span></center>

   </div>
	</div>
    <script type="text/javascript" src="Js/button.js"></script>
    <script type="text/javaScript" src="js/programmingScript.js"></script>

</body>
</html>
