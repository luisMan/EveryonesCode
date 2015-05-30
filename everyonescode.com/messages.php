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


if (isset($_GET['view'])) {
    $view = $object->preventHacks($_GET['view']);
                              
}else{ $view = $user;}
                         
if (isset($_POST['msg']))
{
    $text = $object->preventHacks($_POST['msg']);

    if ($text != "")
    {

        $pm   = substr( $object->preventHacks($_POST['pm']),0,1);
        $time = time();
        $object->executeSQL("INSERT INTO messages VALUES(NULL, '$user',
            '$view', '$pm', $time, '$text')");
    }
}


if ($view != "")
{
    if ($view == $user) $name1 = $name2 = "Your";
    else
    {
        $name1 = "<a href='members.php?view=$view'>$view</a>'s";
        $name2 = "$view's";
    }

    echo "$name1 Messages";
    
    echo <<<_END
  <form method='post' action='messages.php?view=$view'>
Type here to leave a message:<br />
<textarea class='textAreas' name='msg' cols='70' rows='10'></textarea><br />
Public<input type='radio' name='pm' value='0' checked='checked' />
Private<input type='radio' name='pm' value='1' />
<input type='submit' value='Post Message' /></form>
_END;

    if (isset($_GET['erase']))
    {
        $erase = $object->preventHacks($_GET['erase']);
        $object->executeSQl("DELETE FROM messages WHERE id=$erase AND recip='$user'");
    }
    
    $query  = "SELECT * FROM messages WHERE recip='$view' ORDER BY time DESC";
    $result = $object->executeSQl($query);
    $num    = mysql_num_rows($result);
    
    for ($j = 0 ; $j < $num ; ++$j)
    {
        $row = mysql_fetch_row($result);

        if ($row[3] == 0 || $row[1] == $user || $row[2] == $user)
        {
            echo date('M jS \'y g:ia:', $row[4]);
            echo " <a href='messages.php?view=$row[1]'>$row[1]</a> ";

            if ($row[3] == 0)
                 echo "wrote: &quot;$row[5]&quot; ";
            else echo "whispered: <span class='whisper'>" .
                      "&quot;$row[5]&quot;</span> ";

            if ($row[2] == $user)
                echo "[<a href='messages.php?view=$view" .
                          "&erase=$row[0]'>erase</a>]";

        }
         echo "<br/>";
    }
}

if (!$num) echo "<br /><span class='info'>No messages yet</span><br /><br />";

echo "<br /><a class='UserContent' href='messages.php?view=$view'>Refresh messages</a>";

?>

   </div>
   <script type="text/javaScript" src="js/programmingScript.js"></script>
   <div id="footer">
       <?php include_once('includes.php'); ?>
   </div>
</div>
</body>
</html>

