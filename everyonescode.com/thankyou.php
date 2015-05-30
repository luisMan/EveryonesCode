<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Confirmation</title>

    <!-- HTML5 shim/shiv for HTML5 section element backward compatibility. -->
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <!-- jQuery library reference. Latest is always referenced from jQuery's CDN. -->
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
   <style type="text/css">
   *{
     margin: 0 auto;
   }
    .wrapper
    {
        width: 100%;
        height: 600px;
        background-image: url('images/Thankyou.png');
        background-repeat: no-repeat;


    }
       nav
       {
        width: 100%;
        height: 100px;
        background-color: transparent;
       }

       #content
       {
         width:100%;
         margin: 0 auto;
       }
       #content #co
       {

           margin-left: 20%;
           float: left;
       }

       #co img{
        width: 100%;
        height: 50px;
        float: left;
       }
     a{
      text-align: left;
      float: center;
      text-decoration: none;
      color: black;
      font-size: 24px;
     
       }

     #confirm 
     { 
         position:absolute;
         width: 60%;
         margin-top: 100px;
          left:30%;
          top:50%;
        
     }
    
   </style>
   <script type="text/javascript">



   </script>
</head>
<body>
	<div class="wrapper">
       <nav>

       </nav>
       <div id="content">
	     <div id="quote">

       </div>

       <div id="confirm">
        <a href="#" >To confirm your registration please click in the link below</a>
        <br/>
        <a id="co" href=" "><img src="images/confirm.png"></img></a>
      </div>

       </div>
   <footer>

   </footer>
	</div>
</body>

</html>