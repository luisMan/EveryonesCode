<?php
session_start();  // as section start do this function
include_once('function.php');


$userstr = ' (Guest)';

if (isset($_SESSION['user']))
{
    $user     = $_SESSION['user'];
    $object->OnlineUser($user);
    $loggedin = TRUE;
    $userstr  = " ($user)";
}
else
{ $loggedin = FALSE;
header("Location: intro.php" );}
?>




<!doctype html>
<!--[if lt IE 7]> <html class="ie6 oldie"> <![endif]-->
<!--[if IE 7]>    <html class="ie7 oldie"> <![endif]-->
<!--[if IE 8]>    <html class="ie8 oldie"> <![endif]-->
<!--[if gt IE 8]><!-->
<html>
<!--<![endif]-->
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Ecode</title>
<script type="text/javascript" src="http:////code.jquery.com/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="js/JQ.js"></script>
<link href="styles/boilerplate.css" rel="stylesheet" type="text/css">
<!--[if lt IE 9]>
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<script src="js/respond.min.js"></script>
<link href="Css/social.css" rel="stylesheet" type="text/css">
<style type="text/css">@import 'profiles.css';</style>
</head>
<body>
<div id="nav">
    <?php  include_once('nav.php'); ?>
  </div>
<div class="gridIndex clearfix">
 
  <div id="num1">
      <div class="fix">
       <?php $object->showProfile($user); ?>
        <?php $object->postFeed($user); ?>
       </div>
   </div>
  <div id="num2">
         <?php $object->showPost($user); ?>
   </div>
   <script type="text/javaScript" src="js/programmingScript.js"></script>
   <div id="num3">
       <ul class="circle">
              <div class="perks">Setting</div>
              <a href="index.php"><div class="perks">Home</div></a>
              <a href="members.php"><div class="perks">Members</div></a>
              <a href="tutorial.php?Java=tutorial" id="Java" ><div class="perks">Java</div></a>
              <a href="tutorial.php?Cplus=tutorial" id="Cplus" ><div class="perks">C++</div></a>
              <a href="tutorial.php?Assembly=tutorial" id="Assembly" ><div class="perks">Assembly</div></a>
              <a href="tutorial.php?Csharp=tutorial" id="Csharp" ><div class="perks">C#</div></a>
              <a href="tutorial.php?Php=tutorial" id="Php"><div class="perks">Php</div></a>
              <a href="tutorial.php?HTML=tutorial" id="HTML" ><div class="perks">Html</div></a>
              <a href="tutorial.php?JavaScript=tutorial" id="JavaScript"><div class="perks">JavaScript</div></a>
      </ul>
   </div>
   <div id="footer">
       <?php include_once('includes.php'); ?>
   </div>
</div>
</body>
</html>