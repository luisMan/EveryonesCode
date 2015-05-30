


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict// EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns ="http://www.w3.org/1999/xhtml" xml: lang="en" lan="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
   <link rel="STYLESHEET" type="text/css" href="style/fg_membersite.css" />

 
		<title>Tutorials</title>
       
    <style type="text/css">
    *{
        margin: 0 auto;
        padding: 0;
    }


    #TutorialSection{
         width: 100%;
         height:100%;
        
    }
    #content{
        width: 90%;
        height: 100%;

        
    }
    #content div{
        display: inline-block;
       top: 0px;
    }
    #chapters a{
        display: inline-block;


    }
    #user{
      float: right;
    }
    #chapters{
        
        width: 390px;
        height: 900px;
        background-color:#A3C63A;

   
    }

    #videos{
        width: 67%;
        height:900px;
       background-color: transparent;

    }
     
   footer
 {
      position:fixed;
      bottom:0;
       width:100%;
       height: 45px;
       background-color: #214444;
       float:left;
 }

  #myNav {
       position:fixed;
       top:0;
       width:100%;
       height: 69px;
       background-color: #214444;
       margin-bottom: 2%;
       float:left;
} 
 #tutorial{
  margin-left: 1%;
 }

  
  #box{
    width: 390px;
    height: 40px;
    text-align: center;
    padding-top: 25px;

  }
   a{
    text-decoration: none;
    color: white;
      text-align: center;
    vertical-align: center;
  }
   a div:hover{
    /* For any browser that can't create a gradient  */
    background-color: #5C5858;
    /*//mozilla*/
    background: -moz-linear-gradient(top, #efefef, #FFF);
    /* Chrome/Safari     */
    background: -webkit-gradient(linear, left top, left bottom, from(#5C5858), to(#FFF));
    /*IE 6/7 */ filter:progid:DXImageTransform.Microsoft.Gradient(GradientType=0, StartColorStr='#5C5858',EndColorStr='#FFF');
    /*IE 8 */
    -ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#5C5858, endColorstr=#FFF)";
   }

  #footerTop{
  position: fixed;
  text-align: right;
  margin-left: 92%;
  }/*end part 1*/
 body{
    top: 0%;
      background-image: url('images/background.png');
 }

    </style>
 

    <!---Usin Ajax to output  my Video Frames-->
      <script>



    function createRequestObject() 
{
    var returnObj = false;
    
    if(window.XMLHttpRequest) {
        returnObj = new XMLHttpRequest();
    } else if(window.ActiveXObject) {
        try {
            returnObj = new ActiveXObject("Msxml2.XMLHTTP");
            } catch (e) {
            try {
            returnObj = new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch (e) {}
            }
            
    }
    return returnObj;
}
var http = createRequestObject();
var target;
// This is the function to call, give it the script file you want to run and
// the div you want it to output to.
function sendRequest(scriptFile, targetElement)
{   
    target = targetElement;
    try{
    http.open('get', scriptFile, true);
    }
    catch (e){
    document.getElementById(target).innerHTML = e;
    return;
    }
    http.onreadystatechange = handleResponse;
    http.send();    
}
function handleResponse()
{   
    if(http.readyState == 4) {      
    try{
        var strResponse = http.responseText;
        document.getElementById(target).innerHTML = strResponse;
        } catch (e){
        document.getElementById(target).innerHTML = e;
        }   
    }
}
</script>
<!-- end of the php script -->
</head>
<body>
    <div id="top" id="TutorialSection">
         <nav id="myNav">

          <div id="user">
		  
          
          </div>
        </div><!--Close user -->
		
		
         <div id="content">
       
         <div id="chapters">
                 <?php

           $chapter=array("hello"," "," ");
           $videos=array("java/hello.php","java/noDone.php");
                for($i=0; $i<=10; $i++)
                {
                    echo "<a href=javascript:sendRequest('$videos[0]?id=34','tutorial')><div id=box>".$chapter[0]."</div></a>";
                    
                    if($i==3){
                         echo "<a href=javascript:sendRequest('$videos[1]?id=34','tutorial')><div id=box>Not Finish</div></a>";
                         
                    }
                }
              

            ?>
            
         </div>
         <div id="videos">
              <div id="tutorial">

              </div>
         </div>
      
       </div>
     
 </div>
</body>
<footer>
      <div id="footerTop">
               <a class=' ' href="#top"><img src="images/top.png"></img></a>
             </div>
</footer>
</html>