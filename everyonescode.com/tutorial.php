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
<html class="">
<!--<![endif]-->
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Ecode</title>
<script type="text/javascript" src="http:////code.jquery.com/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="js/JQ.js"></script>
<link href="styles/boilerplate.css" rel="stylesheet" type="text/css">
<link href="Css/social.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/ajax.js"></script>
<style type="text/css">@import 'profiles.css';</style>
<!--[if lt IE 9]>
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<script src="js/respond.min.js"></script>
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
         <!--tutorial div comming in this section -->
         <?php $object->getTutorialVid($user); ?>
   </div>
   <script type="text/javaScript" src="js/programmingScript.js"></script>
   <div id="numT">
          <!-- call to my php file that extract the info according to topic -->
          <?php  $object->InsertOutline($user);?>
         <?php $object->printTutorialOutline($user); ?>

   </div>
   <div id="footer">
       <?php include_once('includes.php'); ?>
   </div>
</div>
</body>
</html>