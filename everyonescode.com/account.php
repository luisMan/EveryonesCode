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
<html >
<!--<![endif]-->
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Ecode</title>
<script type="text/javascript" src="http:////code.jquery.com/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="js/JQ.js"></script>
<link href="styles/boilerplate.css" rel="stylesheet" type="text/css">
<link href="Css/social.css" rel="stylesheet" type="text/css">
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
        <?php $object->showProfile($user); ?>
        
   </div>
  <div id="numF">
     


  <?php

if (isset($_POST['textUpdate']))
{
    $text = $object->preventHacks($_POST['textUpdate']);
    $text = preg_replace('/\s\s+/', ' ', $text);
    $college = $object->preventHacks($_POST['college']);
    $college = preg_replace('/\s\s+/',' ',$college);
    $major = $object->preventHacks($_POST['major']);
    $major = preg_replace('/\s\s+/',' ',$major);
    $area   =  $object->preventHacks($_POST['area']);
    $area  = preg_replace('/\s\s+/',' ',$area);
    $mood = $object->preventHacks($_POST['mood']);
    $mood = preg_replace('/\s\s+/',' ',$mood);
    $relationship = $object->preventHacks($_POST['relationship']);
    $relationship = preg_replace('/\s\s+/',' ',$relationship);


    if (mysql_num_rows($object->executeSQL("SELECT * FROM profiles
        WHERE user='$user'"))){
         
         $object->executeSQL("UPDATE profiles SET text='$text' where user='$user'");
         $object->executeSQL("UPDATE profiles SET college='$college' where user='$user'");
         $object->executeSQL("UPDATE profiles SET major='$major' where user='$user'");
         $object->executeSQL("UPDATE profiles SET area='$area' where user='$user'");
         $object->executeSQL("UPDATE profiles SET mood='$mood' where user='$user'");
         $object->executeSQL("UPDATE profiles SET relationship='$relationship' where user='$user'");
    }else{ 
$object->executeSQL("INSERT INTO profiles VALUES('$user','$text','$college','$major','$area','$mood','$relationship',0)");}
}
else
{
    $result = $object->executeSQL("SELECT * FROM profiles WHERE user='$user'");
     $col = mysql_fetch_row($object->executeSQL("SELECT * FROM members WHERE user='$user'"));
    if (mysql_num_rows($result))
    {
        $row  = mysql_fetch_row($result);
        $text = stripslashes($row[1]);
        $college = stripslashes($row[2]);
        $major = stripslashes($row[3]);
        $area =   stripslashes($col[6]);
        $mood = stripslashes($row[5]);
        $relationship = stripslashes($row[6]);

    }
    else {$text = ""; $college=" "; $major=" ";  $mood=" "; $relationship=" "; $area=" ";}
}


$text = stripslashes(preg_replace('/\s\s+/', ' ', $text));
$college = stripslashes(preg_replace('/\s\s+/', ' ', $college));
$major = stripslashes(preg_replace('/\s\s+/', ' ', $major));
$area     = stripslashes(preg_replace('/\s\s+/',' ', $area));
$mood = stripslashes(preg_replace('/\s\s+/', ' ', $mood));
$relationship = stripslashes(preg_replace('/\s\s+/', ' ', $relationship));

    echo <<<_END
    <div class="profileUpdates">
    <table>
    <thead><th colspan='3'><h3>Your Profile Credentials</h3></th></thead>
    <tbody>
    <tr>
    <td>
       <form method='post' action='Account.php' enctype='multipart/form-data'>
      <h3 > About you:</h3>
    </td>
    <td>
       <textarea name='textUpdate' cols='40' rows='1'>$text</textarea>
    <td>
    </tr>
      <tr>
      <td>
          <h3> College:</h3>
      </td>
    <td>
       <textarea name='college' cols='40' rows='1'>$college</textarea>
    <td>
     </tr>
     <tr>
      <td>
          <h3> Major:</h3>
      </td>
    <td>
       <textarea name='major' cols='40' rows='1'>$major</textarea>
    <td>
     </tr>
     <tr>
      <td>
          <h3> Area of interest:</h3>
      </td>
    <td>
       <textarea name='area' cols='40' rows='1'>$area</textarea>
    <td>
     </tr>
    <tr>
      <td>
          <h3> Mood:</h3>
      </td>
    <td>
       <textarea name='mood' cols='40' rows='1'>$mood</textarea>
    <td>
     </tr>
     <tr>
      <td>
          <h3> RelationShip:</h3>
      </td>
    <td>
       <textarea name='relationship' cols='40' rows='1'>$relationship</textarea>
    <td>
     </tr>
     <tr>
      <td></td><td><input type='submit' value='Save Profile' /></form></td>
     </tr>
     </tbody>
     </table>
    </div>
_END;
?>
   </div>
   <script type="text/javaScript" src="js/programmingScript.js"></script>
   <div id="footer">
       <?php include_once('includes.php'); ?>
   </div>
</div>
</body>
</html>

