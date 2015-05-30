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
      <?php
            if (!$loggedin){die();}
            
            if (isset($_GET['view'])){ $view = $object->preventHacks($_GET['view']);}
            else  {                    $view = $user;}
            if ($view == $user)
            {
              $name1 = $name2 = "Your";
             $name3 =          "You are";
            }
            else
            {
              $name1 = "<a href='index.php?view=$view'>$view</a>'s";
              $name2 = "$view's";
              $name3 = "$view is";
            }
           
            /*picture attributes*/
                   if (isset($_FILES['image']['name']))
{
    $saveto = "membersBackground/$user.jpg";
    move_uploaded_file($_FILES['image']['tmp_name'], $saveto);
    $typeok = TRUE;
    
    switch($_FILES['image']['type'])
    {
        case "image/gif":   $src = imagecreatefromgif($saveto); break;
        case "image/jpeg":  // Both regular and progressive jpegs
        case "image/pjpeg": $src = imagecreatefromjpeg($saveto); break;
        case "image/png":   $src = imagecreatefrompng($saveto); break;
        default:            $typeok = FALSE; break;
    }
    
    if ($typeok)
    {
        list($w, $h) = getimagesize($saveto);

        $max = 850;
        $tw  = $w;
        $th  = $h;
        
        if ($w > $h && $max < $w)
        {
            $th = $max / $w * $h;
            $tw = $max;
        }
        elseif ($h > $w && $max < $h)
        {
            $tw = $max / $h * $w;
            $th = $max;
        }
        elseif ($max < $w)
        {
            $tw = $th = $max;
        }
        
        $tmp = imagecreatetruecolor($tw, $th);
        imagecopyresampled($tmp, $src, 0, 0, 0, 0, $tw, $th, $w, $h);
        imageconvolution($tmp, array(array(-1, -1, -1),
            array(-1, 16, -1), array(-1, -1, -1)), 8, 0);
        imagejpeg($tmp, $saveto);
        imagedestroy($tmp);
        imagedestroy($src);
    }

}

 //Second Image attribute
  if (isset($_FILES['profile']['name']))
{
    $saveto = "membersPhoto/$view.jpg";
    move_uploaded_file($_FILES['profile']['tmp_name'], $saveto);
    $typeok = TRUE;
    
    switch($_FILES['profile']['type'])
    {
        case "image/gif":   $src = imagecreatefromgif($saveto); break;
        case "image/jpeg":  // Both regular and progressive jpegs
        case "image/pjpeg": $src = imagecreatefromjpeg($saveto); break;
        case "image/png":   $src = imagecreatefrompng($saveto); break;
        default:            $typeok = FALSE; break;
    }
    
    if ($typeok)
    {
        list($w, $h) = getimagesize($saveto);

        $max = 430;
        $tw  = $w;
        $th  = $h;
        
        if ($w > $h && $max < $w)
        {
            $th = $max / $w * $h;
            $tw = $max;
        }
        elseif ($h > $w && $max < $h)
        {
            $tw = $max / $h * $w;
            $th = $max;
        }
        elseif ($max < $w)
        {
            $tw = $th = $max;
        }
        
        $tmp = imagecreatetruecolor($tw, $th);
        imagecopyresampled($tmp, $src, 0, 0, 0, 0, $tw, $th, $w, $h);
        imageconvolution($tmp, array(array(-1, -1, -1),
            array(-1, 16, -1), array(-1, -1, -1)), 8, 0);
        imagejpeg($tmp, $saveto);
        imagedestroy($tmp);
        imagedestroy($src);
    }
}
    /* end of user profiles */
        if(file_exists("membersBackground/$view.jpg")){
        $saveto = "membersBackground/$view.jpg";
        echo "<div class='gridIndex clearfix' style='background-image: url(".$saveto."); background-repeat: no-repat; background-size:100% 100%;'>";
        }else{
            echo "<div class='gridIndex'>";
        }
        ?>
 
  <div id="num1">
        <div class="fix"><?php $object->showProfile($view); ?></div>
   </div>
  <div id="num2">
         <center><span> Post </span></center>
       <?php $object->showUserPost($view); ?>
   </div>
   <script type="text/javaScript" src="js/programmingScript.js"></script>
   <div id="num3">
           <ul class="circle">
              <div class="perks">Setting</div>
              <a href="index.php"><div class="perks">Home</div></a>
              <a href="members.php"><div class="perks">Members</div></a>
         </ul>
   </div>
   <div id="footer">
       <?php include_once('includes.php'); ?>
   </div>
</div>
</body>
</html>