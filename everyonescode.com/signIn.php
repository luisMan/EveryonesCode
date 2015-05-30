<?php
session_start();  // as section start do this function
include_once('function.php');


$userstr = ' (Guest)';

if (isset($_SESSION['user']))
{
    $user     = $_SESSION['user'];
    $loggedin = TRUE;
    $userstr  = " ($user)";
    header("LOCATION: intro.php");
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
<title>SignIn</title>
<link href="Css/boilerplate.css" rel="stylesheet" type="text/css">
<link href="Css/Intro.css" rel="stylesheet" type="text/css">
<link href="intro.html" rel="stylesheet" type="text/css">
<script type="text/javascript" src="http:////code.jquery.com/jquery-1.10.2.min.js"></script>

<!--[if lt IE 9]>
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<script src="Js/respond.min.js"></script>
<script src="Js/slide.js"></script>
</head>
<body>
  <?php include_once('sign_in.php');?>
	<div class="gridContainer clearfix"> 
        <div class="nav">
                    <a id="logo" href="index.php" >Ecode</a>
                    <a id="logIn" href="signIn.php" >Login</a>
              </div>
         <div class="signInBack">
                        
                  <div class="registration">
                      <form method='post' action='signIn.php'>
                     <center><legend>Log in Information</legend></center>
                      <?php echo '<div class="error">'.$error.'</div><br/>'; ?>
                      <span class='fieldname'>Username :</span>
                      <br/>
                      <input class = 'inputs' type='text' maxlength='16' name='user' value='<?php echo "$user"; ?>' />
                      <br/>
                      <span class='fieldname'>Password :</span>
                      <br/>
                      <input class = 'inputs' type='password'maxlength='16' name='pass' value='<?php echo "$pass"; ?>' />
                      <br/>
                      <input class="signupButton" type='submit' value='Login' />
                      </form>

                  </div>     

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
</body>
</html>
