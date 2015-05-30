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
<title>SignUp</title>
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
                     <form method='post' action='signUp.php'
        name="member_form" id="member_form">
        
            <legend>Registration Information</legend>
            <div><label><?php echo '<div class="error" >'.$error.'</div>'; ?></label></div>
            <label for='username' class='fieldname'>Username:</label>
            <input class='inputs' type='text' maxlength='16' name='newuser' value='<?php echo "$newuser"; ?>'onBlur='checkUser(this)'/>
            <label  for='userPassword' class='fieldname'>Password:</label>
            <input class = 'inputs' type='password' maxlength='16' name='newpass' value='<?php echo "$newpass"; ?>' />
            <label class='fieldname' for="email" >Email Address:</label>
            <input class = 'inputs'  type='email' maxlength='30' name='newemail' value='<?php echo "$newemail"; ?>' />
            <label class='fieldname'>Name:</label>
            <input class = 'inputs'  type='text' maxlength='16' name='newname' value='<?php echo "$newname"; ?>' />
            <label class='fieldname'>Last:</label>
            <input class = 'inputs'  type='text' maxlength='16' name='newlast' value='<?php echo "$newlast"; ?>' />
            <label class='fieldname' for='carerr'>Place of Interest</label>
             <select class='inputs' name="interest" id='interest'>
                <option>Game Development</option>
                <option>Hacker</option>
                <option>Software developer</option>
                <option>Business</option>
                <option>Computer Engineer</option>
                <option>Computer Hardware</option>
                <option>Professor</option>
                <option>Computer Security</option>
                <option>I am not sure</option>
                <option>Student</option>
            </select>
            <br/>
            <!--<label class='fieldname' for='birthday'>Birthday:</label>
            <input type="date" class='inputs'>
            <div id="birth">
            <select name="month" id="month">
                <option>January</option>
                <option>February</option>
                <option>March</option>
                <option>April</option>
                <option>May</option>
                <option>June</option>
                <option>July</option>
                <option>August</option>
                <option>September</option>
                <option>October</option>
                <option>November</option>
                <option>December</option>
            </select>
            <select name="day" id="day">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
                <option>6</option>
                <option>7</option>
                <option>8</option>
                <option>9</option>
                <option>10</option>
                <option>11</option>
                <option>12</option>
                <option>13</option>
                <option>14</option>
                <option>15</option>
                <option>16</option>
                <option>17</option>
                <option>18</option>
                <option>19</option>
                <option>20</option>
                <option>21</option>
                <option>22</option>
                <option>23</option>
                <option>24</option>
                <option>25</option>
                <option>26</option>
                <option>27</option>
                <option>28</option>
                <option>29</option>
                <option>30</option>
                <option>31</option>
            </select>
             <select name="year" id="year">
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
               
            </select>
           </div>-->
             <div>
            <label class = 'fieldname' for"contact_by">Gender</label>
            <p>Male</p>
            <input name="contact_by" type="radio" value="male"   />
            <label class='fieldname'>-</label>
            <p>Female</p>
            <input name="contact_by" type="radio" value="female" />
            </div>
            <p class='fieldname'>by clicking sign up you agree to our <a href="#" style="color: blue">user policy</a> and use of cookies</p>
            <input class="signupButton" type='submit' value='Sign up' />
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
