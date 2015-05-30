<?php
  /**The must amazing class in php that will work with my social network
  /*Author: Luis Manon 
  /*Before copying my ideas I should get email to ask for permissions at LuisMan1989@gmail.com
  **/
  include_once('private.php');

  class EProgram
  {
       public $host, $dbname, $user, $password;
       public $languages;

       public function __construct($Ehost, $EdbName,$Euser,$Epass)
       {  
              $this->host =$Ehost;
              $this->dbname = $EdbName;
              $this->user = $Euser;
              $this->password = $Epass;
              $this->languages = "Empty";
              
              
       }
        public function  __destruct()
       {
               //print "Execution of memory clean Code injected Successful";

       }

       function Connect()
       {
         return mysql_connect($this->host,$this->user,$this->password) or die(mysql_error());
       }
       function selectDB()
       {
         return mysql_select_db($this->dbname) or die(mysql_error());
       }

       function preventHacks($var)
       {
            $var = strip_tags($var);
            $var = htmlentities($var);
            $var = stripslashes($var);
            return mysql_real_escape_string($var);
           
       }

       function DestroySection($user)
       {
          if (session_id() != "" || isset($_COOKIE[session_name()]))
              setcookie(session_name(), '', time()-2592000, '/');

       }

       function setLanguage($lang)
       {
           $this->languages =  $lang;
       }
       function getLanguage()
       {
         return $this->languages;
       }

       function executeSQL($query)
       {
          $result = mysql_query($query) or die(mysql_error());
          return $result;
       }

       function createTable($TableName, $query)
       { 
           $this->executeSQL("CREATE TABLE IF NOT EXISTS $TableName($query)");
          echo 'Table Created or Already Exits<br/>';
       }

          function getImage($user)
          { 
            if(file_exists("membersPhoto/$user.jpg"))
           {
             $image = "membersPhoto/$user.jpg";
           }else
           {   
                $ret =  $this->executeSQL("SELECT * FROM members WHERE user='$user'");
                $index = mysql_fetch_row($ret);
                 if($index[5]=="male"){
                    $image = "membersPhoto/male.jpg";
                 }else{
                    $image = "membersPhoto/female.jpg";
               }
          
           }

          return $image;
          }

        function showProfile($user)
       {
            $image = $this->getImage($user);
           $numOne = $this->executeSQL("SELECT * FROM fans WHERE user='$user'");
           $numTwo = $this->executeSQL("SELECT * FROM followers WHERE user='$user'");
           $numThree = $this->executeSQL("SELECT * FROM friends WHERE user='$user'");
           $admirer =  mysql_num_rows($numOne);
           $follower = mysql_num_rows($numTwo);
           $friends = mysql_num_rows($numThree);
           $result = $this->executeSQL("SELECT * FROM profiles WHERE user='$user'");
           $row = mysql_fetch_row($result);

        echo '
        <div class="profile_field">
        <div class="profile_pict">
        <div class="colP"><a href="index.php?view='.$user.'"><img src='.$image.' width="150" height="150"></img></a></div>
        <div class="colP2">userName : '.$user.'<br/>
                           About : '.stripslashes($row[1]).'<br/>
                           College : '.stripslashes($row[2]).'<br/>
                           Major : '.stripslashes($row[3]).'<br/>
                           Interest : '.stripslashes($row[4]).'<br/>
                           Mood : '.stripslashes($row[5]).'<br/>
                           Relationship : '.stripslashes($row[6]).'<br/>
                           Famous : '.stripslashes($row[7]).
                           '</div>
        </div>
        <ul class="prof">
        <a href="followers.php?view='.$user.'"><div class="star-five">'.$follower.'</div></a>
        <a href="fans.php?view='.$user.'"><div class="heart-five">'.$admirer.'</div></a>
        <a href="friends.php?view='.$user.'"><div class="friend-five">'.$friends.'</div></a>
        <a id="adduser" href="index.php?adduser='.$user.'"><div class="add-friend">Add</div></a>
        <a href="messages.php?view='.$user.'" ><div class="user-msg">'.$this->getMessages($user).'</div></a>
        </ul>
        <div class="userProfNav">
         <ul>
            <li id="profilePhoto">Profile</li>
            <li id="backgroundPhoto">Background</li>
         </ul>
       </div>
       <div id="profileAtributes">
          
        </div>
      
        </div>';

      }
function getMessages($user)
{
   $query  = "SELECT * FROM messages WHERE recip='$user' ORDER BY time DESC";
    $result = $this->executeSQl($query);
    $num    = mysql_num_rows($result);
    return $num;
}

function eraseComment($user)
{
   if(isset($_GET['eraseComment']))
     {
          $auth = $this->preventHacks($_GET['eraseComment']);
          $id = $this->preventHacks($_GET['postId']);
          
          $this->executeSQL("DELETE FROM comments WHERE authPost='$auth' AND postId='$id' AND userPostin='$user'");
     }
}

function erasePost($user, $time)
{
   if(isset($_GET['erasePost']))
     {
          $auth = $this->preventHacks($_GET['erasePost']);
          $id = $this->preventHacks($_GET['postId']);
          
          $this->executeSQL("DELETE FROM feeds WHERE auth='$auth' AND Id='$id' AND time='$time'");
     }
}
function showIntroPost()
{
    $result = $this->executeSQL("SELECT * FROM feeds ORDER BY time DESC");  
               $col = mysql_fetch_array($result);
                $image = $this->getImage($col[1]);
                // $this->postComment($user);
                //$this->postLikes($user);
                //$this->eraseComment($user);
                // $this->erasePost($user, $col[3]);
                date_default_timezone_set('UTC');
                $time = date("l jS \of F Y h:i:s A", $col[3]);
   echo '
        <div class="profile_fieldFeed">';
       // if($col[1]==$user){echo "<a href='ecode.php?erasePost=".$col[1]."&postId=".$col[0]."'name='erasePost'><img src='icon/x.png' width='8px' height='8px' style='float:right; padding:1%;'></img></a>";}
        echo '<a href=index.php?view='.$col[1].'><img src='.$image.' width="150" height="150" ></img></a>
        <div class="time" id="time" name="time">Name: '.$col[1].'<br/>'.$time.'</div>
        <div class="comment"><ul><div> Tittle :'.$col[4].'</div><div><textArea id="textA" cols="43" rows="5">'.$col[5].'</textArea></div><div><span>Language type:'.$col[7].'</span></div>
        <div>
         <form id="PostComment" method="post" action="ecode.php?PostComment='.$col[1].'&post='.$col[0].'" enctype="multipart/form-date">
                        <textArea id="textA" type="text" id="commentInput" name="commentInput" cols="43" rows="2" > </textArea>
                        <input  type="submit" value="Post" class="submitComment" id="submitComment" name="submitComment"/></form>
         </div></ul></div>
        <div class="prevCode">Preview Code
        </div>
        <div class="showCase">

        </div>
        <div class="showComment">';
         
        $res = $this->executeSQL("SELECT * FROM comments WHERE authPost='$col[1]' AND postId='$col[0]' ORDER BY time DESC");
        $length = mysql_num_rows($res);
         for($i=0; $i<$length; $i++)
         {
                
                $inf = mysql_fetch_row($res);
                date_default_timezone_set('UTC');
                $timeC = date("l jS \of F Y h:i:s A",$inf[4]);
                $saveTo = 'membersPhoto/'.$inf[5].'.jpg';
                echo "<div id='commenters'>";
                 
               /* if($inf[5]==$user){
                echo "<a href='index.php?view=".$inf[5]."'><img src=".$saveTo." width='50px' height='50px'></img></a>";
                echo "<ul><li>".$inf[6]." <a href='ecode.php?eraseComment=".$col[1]."&postId=".$col[0]."'                  name='eraseComent'><img src='icon/x.png' width='8px' height='8px' style='float:right; padding:1%;'></img></a></li>";
                echo "<li>time ".$timeC."</li></ul>";
                 }else{ */     
                echo "<ol style='display: inline-block;'><li><a href='index.php?view=".$inf[5]."'><img src=".$saveTo." width='50px' height='50px'></img></a></li>";
                echo "<li>".$inf[6]."</li>";
                echo "<li>time ".$timeC."</li></ol>";
                // }

                 echo "</div>";
         }

        echo'</div>
        <ul class="prof">
        <a id="like" href="ecode.php?like='.$col[1].'&heart='.$col[0].'" ><div class="heart-five">';
          $q = $this->executeSQL("SELECT * FROM feeds WHERE time='$col[3]'");
          $val = mysql_fetch_row($q);
          echo $val[6];
          
        echo '</div><div><ol>';
         $q =  $this->executeSQL("SELECT * FROM feedLovers WHERE feedId='$col[0]' ORDER BY id DESC");
         if(mysql_num_rows($q)>0){
         while($h = mysql_fetch_row($q)){
         $saveT = 'membersPhoto/'.$h[3].'.jpg';  
         echo "<a href='index.php?view=".$h[3]."'><li><img src='".$saveT."' width=50px height=50px style='border-radius:100%;'></img></li></a>";}
         }
        echo '</ol></div></a>
        </ul>
       </div>
       ';

}
function showPost($user)
{
   $result = $this->executeSQL("SELECT * FROM feeds ORDER BY time DESC");  
            while($col = mysql_fetch_array($result)){
                $image = $this->getImage($col[1]);
                $this->postComment($user);
                $this->postLikes($user);
                $this->eraseComment($user);
                $this->erasePost($user, $col[3]);
                date_default_timezone_set('UTC');
                $time = date("l jS \of F Y h:i:s A", $col[3]);
   echo '
        <div class="profile_fieldFeed">';
        if($col[1]==$user){echo "<a href='ecode.php?erasePost=".$col[1]."&postId=".$col[0]."'name='erasePost'><img src='icon/x.png' width='8px' height='8px' style='float:right; padding:1%;'></img></a>";}
        echo '<a href=index.php?view='.$col[1].'><img src='.$image.' width="150" height="150" ></img></a>
        <div class="time" id="time" name="time">Name: '.$col[1].'<br/>'.$time.'</div>
        <div class="comment"><ul><div> Tittle :'.$col[4].'</div><div><textArea id="textA" cols="43" rows="5">'.$col[5].'</textArea></div><div><span>Language type:'.$col[7].'</span></div>
        <div>
         <form id="PostComment" method="post" action="ecode.php?PostComment='.$col[1].'&post='.$col[0].'" enctype="multipart/form-date">
                        <textArea id="textA" type="text" id="commentInput" name="commentInput" cols="43" rows="2" > </textArea>
                        <input  type="submit" value="Post" class="submitComment" id="submitComment" name="submitComment"/></form>
         </div></ul></div>
        <div class="prevCode">Preview Code
        </div>
        <div class="showCase">

        </div>
        <div class="showComment">';
         
        $res = $this->executeSQL("SELECT * FROM comments WHERE authPost='$col[1]' AND postId='$col[0]' ORDER BY time DESC");
        $length = mysql_num_rows($res);
         for($i=0; $i<$length; $i++)
         {
                
                $inf = mysql_fetch_row($res);
                date_default_timezone_set('UTC');
                $timeC = date("l jS \of F Y h:i:s A",$inf[4]);
                $saveTo = 'membersPhoto/'.$inf[5].'.jpg';
                echo "<div id='commenters'>";
                 
                if($inf[5]==$user){
                echo "<a href='index.php?view=".$inf[5]."'><img src=".$saveTo." width='50px' height='50px'></img></a>";
                echo "<ul><li>".$inf[6]." <a href='ecode.php?eraseComment=".$col[1]."&postId=".$col[0]."'                  name='eraseComent'><img src='icon/x.png' width='8px' height='8px' style='float:right; padding:1%;'></img></a></li>";
                echo "<li>time ".$timeC."</li></ul>";
                 }else{      
                echo "<a href='index.php?view=".$inf[5]."'><img src=".$saveTo." width='50px' height='50px'></img></a>";
                echo "<ul><li>".$inf[6]."</li>";
                echo "<li>time ".$timeC."</li></ul>";
                 }

                 echo "</div>";
         }

        echo'</div>
        <ul class="prof">
        <a id="like" href="ecode.php?like='.$col[1].'&heart='.$col[0].'" ><div class="heart-five">';
          $q = $this->executeSQL("SELECT * FROM feeds WHERE time='$col[3]'");
          $val = mysql_fetch_row($q);
          echo $val[6];
          
        echo '</div><div><ul class="lovers">';
         $q =  $this->executeSQL("SELECT * FROM feedLovers WHERE feedId='$col[0]' ORDER BY id DESC");
         if(mysql_num_rows($q)>0){
         while($h = mysql_fetch_row($q)){
         $saveT = 'membersPhoto/'.$h[3].'.jpg';  
         echo "<a href='index.php?view=".$h[3]."'><li><img src='".$saveT."' width=50px height=50px style='border-radius:100%;'></img></li></a>";}
         }
        echo '</ul></div></a>
        </ul>
       </div>
       ';

       }
}

        
        function OnlineUser($user)
        {   $on = 0;
            $this->executeSQL("UPDATE members SET ON_OFF='$on' WHERE user='$user'");
        }
        
        function OfflineUser($user)
       {    $off = 1;
            $this->executeSQL("UPDATE members SET ON_OFF='$off' WHERE user='$user'");

       }
      function addMembers($user)
    {
     if(isset($_GET['add']))
     {
         $add = $this->preventHacks($_GET['add']);
         if(!mysql_num_rows($this->executeSQL("SELECT * FROM friends WHERE user='$add' AND friend='$user'")))
          {
             $this->executeSQL("INSERT INTO friends VALUES ('$add','$user')");
            
          }
    
     }

     }

function addFollowing($user)
{
    if(isset($_GET['follow']))
    {
        $add = $this->preventHacks($_GET['follow']);
        if(!mysql_num_rows($this->executeSQL("SELECT * FROM followers WHERE user='$add' AND follower='$user'")))
        {
            $this->executeSQL("INSERT INTO followers VALUES('$add','$user')");
        }
    }
}

function addFans($user)
{
     if(isset($_GET['like']))
     {
        $add  = $this->preventHacks($_GET['like']);
        if(!mysql_num_rows($this->executeSQL("SELECT * FROM fans WHERE user='$add' AND fan='$user'")))
        {
            $this->executeSQL("INSERT INTO fans VALUES('$add','$user')");
        }
     }
}
function showMembers($user)
{
  
$result = $this->executeSQL("SELECT user FROM members ORDER BY user");
        $num    = mysql_num_rows($result);
        for( $i=0; $i<$num; $i++)
        {
            $row =  mysql_fetch_row($result);
            $this->addMembers($user);   //add members function
            $this->addFollowing($user); //add follower function
            $this->addFans($user); //add fans function


            $info ="Eadd";
            $info2 ="Efollow";
            $info3="Elikes";
            if($row[0] == $user){continue;}
             //adding attributes
             $t1 = mysql_num_rows($this->executeSQL("SELECT * FROM friends
              WHERE user='$row[0]' AND friend='$user'"));
             $t2 = mysql_num_rows($this->executeSQL("SELECT * FROM friends
              WHERE user='$user' AND friend='$row[0]'"));

             if($t1>= 1){
                 $info ="friend send";
             }//end of add attributes
             if($t1+$t2>1){ $info = "friends";} 
             //begin of following attributes
             $t3 = mysql_num_rows($this->executeSQL("SELECT * FROM followers
                WHERE user='$row[0]' AND follower='$user'"));
             $t4 = mysql_num_rows($this->executeSQL("SELECT * FROM followers
                WHERE user='$user' AND follower='$row[0]'"));

            
             if($t3>=1){ 
                $info2 ="Following";
             }
              if($t4>=1){ $info2="Follower";}
              //end of Following Section

              //Begin of Fan attributes 
              $t5 = mysql_num_rows($this->executeSQL("SELECT * FROM fans
                WHERE user='$row[0]' AND fan='$user'"));
              $t6 = mysql_num_rows($this->executeSQL("SELECT * FROM fans
                where user='$user' AND fan='$row[0]'"));
              if($t5>=1){
                $info3 = "Admires";
              }
              if($t6>=1)
              {
                $info3 = "Fan";
              }

            $saveto = $this->getImage($row[0]);
            echo '
        <div class="profile_fieldFriend">
        <a href="index.php?view='.$row[0].'"><img src='.$saveto.' width="100" height="100"><span id="profileAt">Name : '.$row[0].'</span></img></a>
        <ul class="prof">
        <a id="add" href="members.php?add='.$row[0].'  "><div class="add-five">'.$info.'</div></a>
        <a id="follow" href="members.php?follow='.$row[0].' "><div class="follow-five">'.$info2.'</div></a>
        <a id="like" href="members.php?like='.$row[0].' "><div class="like-five">'.$info3.'</div></a>
        </ul>
        </div>';

        }

}
function showMembersBySearch($member)
{
    
}

function getUserBackGroundImg($user)
{
    if(file_exists("membersBackground/$user.jpg"))
       return 'membersBackground/$user.jpg';
     
}

function getTotalFriendR($user)
{
     $query = $this->executeSQL("SELECT user FROM members ORDER BY user");
     $num = mysql_num_rows($query);
      $counter = 0 ;
      for($i=0; $i<$num; $i++)
      { 
           $row = mysql_fetch_row($query);
           if($row[0]==$user){continue;}
           $person1 =  mysql_num_rows($this->executeSQL("SELECT * FROM friends WHERE user='$user' AND             friend='$row[0]'"));
           $person2 =  mysql_num_rows($this->executeSQL("SELECT * FROM friends WHERE user='$row[0]' AND friend='$user'"));
          

           if($person1>=1 && $person2==0)
           {
               $counter++;
           }
      }
return $counter;
}
//===========================================================//

function acceptRequest($user)
{
    if(isset($_GET['EAccept']))
    {
         $add = $this->preventHacks($_GET['EAccept']);
         if(!mysql_num_rows($this->executeSQL("SELECT * FROM friends WHERE user='$add' AND friend='$user'")))
          {
             $this->executeSQL("INSERT INTO friends VALUES ('$add','$user')");
            
          }
    }


    if(isset($_GET['EReject']))
    { 
         $Reject  = $this->preventHacks($_GET['EReject']);
        if(mysql_num_rows($this->executeSQL("SELECT * FROM friends WHERE user='$user' AND friend='$Reject'")))
        {
            $this->executeSQL("DELETE FROM friends WHERE user='$user' AND friend='$Reject'");
        }

    }
}

function showFriendRequest($user)
{
     echo "<div id='friendRequestBox' >";
     echo "<span style='color: rgba(0,0,255,1);'><center>Friend Request</center></span>";
      $query = $this->executeSQL("SELECT user FROM members ORDER BY user");
      $num = mysql_num_rows($query);
       $counter = 0 ;
      for($i=0; $i<$num; $i++)
      {
           $this->acceptRequest($user);  //call to accept and reject button listener
           $row = mysql_fetch_row($query);
           if($row[0]==$user){continue;}
           $person1 =  mysql_num_rows($this->executeSQL("SELECT * FROM friends WHERE user='$user' AND friend='$row[0]'"));
           $person2 =  mysql_num_rows($this->executeSQL("SELECT * FROM friends WHERE user='$row[0]' AND friend='$user'"));
         

           if($person1>=1 && $person2==0)
           {
                $saveto = $this->getImage($row[0]);
                echo '
        <div class="profile_fieldFriend">
        <a href="index.php?view='.$row[0].'"><img src='.$saveto.' width="100" height="100"><span id="profileAt">Name :                 '.$row[0].'</span></img></a>
        <ul class="requestAtr">
             <li><a id="EAccept" href="index.php?EAccept='.$row[0].'">Accept</a></li>
             <li><a id="EReject" href="index.php?EReject='.$row[0].'">Reject</a></li>
         </ul>
        </div>';

 
           }
      }
    
     echo "</div>";

}


 function calcultateFamous($user)
 {
        $numOne = $this->executeSQL("SELECT * FROM fans WHERE user='$user'");
        $numTwo = $this->executeSQL("SELECT * FROM followers WHERE user='$user'");
        $post =  $this->executeSQL("SELECT * FROM feeds WHERE auth='$user'");
        $one = mysql_num_rows($numOne);
        $two =  mysql_num_rows($numTwo);
        $three =  mysql_num_rows($post);
        $total =  ((($one+$two+$three)/100)*10);
        $this->executeSQL("UPDATE profiles SET reputation='$total' WHERE user='$user'");

 }

 function showTopFamous()
 {
      $result =  $this->executeSQL("SELECT * FROM profiles ORDER BY reputation DESC");
       $counter=0;
      while($col = mysql_fetch_array($result))
      {
        
           $saveto = $this->getImage($col[0]);
           $numOne = $this->executeSQL("SELECT * FROM fans WHERE user='$col[0]'");
           $numTwo = $this->executeSQL("SELECT * FROM followers WHERE user='$col[0]'");
           $admirer =  mysql_num_rows($numOne);
           $follower = mysql_num_rows($numTwo);
           $this->calcultateFamous($col[0]); //will calculate for the famous person 
        if($counter++>100){break;}
        echo " <div class='backUser'>
        <a href=index.php?view=$col[0]><div class='photId'>
        <img src=".$saveto." width=200px height=150px></img>
        </div></a>
        <div class='atr'>
       <div class='fieldInfo'>
       <label>Name: ".$col[0]."</label>
       <label>reputation: ".$col[7]."%</label>
       </div>
       <div class='reputInfo'>
       <label>admirers: ".$admirer."</label>
       <label>followers: ".$follower."</label>
       </div>
       <div class='positionPlace'>
       <label>Position: ".$counter."</label>
       </div>
       </div>
       </div>";

      }
 }
//===========================================End of Navigation===================================================//
function deleteFriend($user)
{
    if(isset($_GET['remove']))
    {
        $remove = $this->preventHacks($_GET['remove']);
        $query = $this->executeSQL("DELETE FROM friends WHERE user='$remove' AND friend ='$user'");
    }

}

function showFriends($user)
{
     $result = $this->executeSQL("SELECT user FROM members ORDER BY user");
     $length =  mysql_num_rows($result);

     for( $i=0; $i<$length; $i++)
     {
         $row =  mysql_fetch_row($result);
         if($row[0] == $user)
         {
            continue;
         }
          $this->deleteFriend($user); //call function to delete a friend
         $saveto = $this->getImage($row[0]);
         $check =  mysql_num_rows($this->executeSQL("SELECT * FROM friends WHERE user='$row[0]' AND friend='$user'"));
         if($check>=1)
         {
             echo '
        <div class="profile_fieldFriend">
        <a href="index.php?view='.$row[0].'"><img src='.$saveto.' width="100" height="100"><span id="profileAt">Name : '.$row[0].'</span></img></a>
        <ul class="friendsAtr">
             <li><a id="chat" href="ecode.php?chat='.$row[0].'" >chat</a></li>
             <li><a id="block" href="ecode.php?block='.$row[0].'">block</a></li>
             <li><a id="remove" href="ecode.php?remove='.$row[0].'">erase</a></li>
            </ul>
        </div>';
  
         }

     }
  
}
function InsertOutline($user)
{
   $chapter=array("*Compilers and Runtime Environments (this section should have directions and links to downloads)",
"*Anatomy of a Code (broken up into the following sub sections)",
  "-Hello World",
   "-code Conventions ( section talking about style conventions and touches on Object Oriented nature  )",
   "-Data Types ( primitive data types, advanced data types/classes like strings, and arrays )",
"*Data Manipulation ( broken up into the following sub sections )",
   "-operators ( mathematical and logical )",
   "-casting",
   "-data protection ( things like final and private commands )",
"*Computer Decision making using Logical/Comparative Code Blocks",
   "-if statements",
   "-switch statements",
"*Code Recycling Techniques",
   "-loops",
   "-macros",
   "-methods",
   "-classes/objects",

"General Programming section:",
"*Vocabulary Terms (all basic words a person might need like syntax, variables, scope, high level programming language)",
"*Planning and Logic (broken up into following sub sections)",
  " -Pseudo Code",
   "-Flow Charting",
   "-UMLs",
"*Style and Conventions",
   "-being efficient (covers reason for minimizing variables for memory and code reuse through loops/methods )",
   "-spacing (covers how programmers use spacing uniquely for each language as a style to make things more readable)",
   "-maintenance (covers using proper documentation and the like to make code maintainable even in your absence)");
   
   for($i=0; $i<27; $i++)
   {
   $this->executeSQl("INSERT INTO tutorials VALUES(NULL,'$chapter[$i]','Java',NULL,'tut.php',NULL)");
   $this->executeSQl("INSERT INTO tutorials VALUES(NULL,'$chapter[$i]','Assembly',NULL,'tut.php',NULL)");
   $this->executeSQl("INSERT INTO tutorials VALUES(NULL,'$chapter[$i]','C++',NULL,'tut.php',NULL)");
   $this->executeSQl("INSERT INTO tutorials VALUES(NULL,'$chapter[$i]','C#',NULL,'tut.php',NULL)");
   $this->executeSQl("INSERT INTO tutorials VALUES(NULL,'$chapter[$i]','Php',NULL,'tut.php',NULL)");
   $this->executeSQl("INSERT INTO tutorials VALUES(NULL,'$chapter[$i]','JavaScript',NULL,'tut.php',NULL)");
   } 

}
//========================================tutorial==============================//
function printTutorialOutline($user)
{
     
     if(isset($_GET['Java']))
     {
        $query = $this->executeSQL("SELECT * FROM tutorials WHERE language='Java'");
        $length = mysql_num_rows($query);
        while($col = mysql_fetch_array($query))
        {
            
            echo "<a href=javascript:sendRequest('$col[4]?id=34','tutorial')><div class='tutContent'>$col[1]</div></a>";
          
        }  
     }
          if(isset($_GET['Cplus']))
     {
        $query = $this->executeSQL("SELECT * FROM tutorials WHERE language='C++'");
        $length = mysql_num_rows($query);
        while($col = mysql_fetch_array($query))
        {
            echo "<div class='tutContent'>".$col[1]."</div>";
        }  
     }

       if(isset($_GET['Assembly']))
     {
        $query = $this->executeSQL("SELECT * FROM tutorials WHERE language='Assembly'");
        $length = mysql_num_rows($query);
        while($col = mysql_fetch_array($query))
        {
            echo "<div class='tutContent'>".$col[1]."</div>";
        }  
     }

       if(isset($_GET['Csharp']))
     {
        $query = $this->executeSQL("SELECT * FROM tutorials WHERE language='C#'");
        $length = mysql_num_rows($query);
        while($col = mysql_fetch_array($query))
        {
            echo "<div class='tutContent'>".$col[1]."</div>";
        }  
     }
       if(isset($_GET['Php']))
     {
        $query = $this->executeSQL("SELECT * FROM tutorials WHERE language='Php'");
        $length = mysql_num_rows($query);
        while($col = mysql_fetch_array($query))
        {
            echo "<div class='tutContent'>".$col[1]."</div>";
        }  
     }

        if(isset($_GET['HTML']))
     {
        $query = $this->executeSQL("SELECT * FROM tutorials WHERE language='HTML'");
        $length = mysql_num_rows($query);
        while($col = mysql_fetch_array($query))
        {
            echo "<div class='tutContent'>".$col[1]."</div>";
        }  
     }
    

         if(isset($_GET['JavaScript']))
     {
        $query = $this->executeSQL("SELECT * FROM tutorials WHERE language='JavaScript'");
        $length = mysql_num_rows($query);
        while($col = mysql_fetch_array($query))
        {
            echo "<div class='tutContent'>".$col[1]."</div>";
        }  
     }
     

}

function getTutorialVid($user)
{ 
   echo "<div id='tutorial'> </div>";


}
//=======================================User Feed ==============================//

 //listener to my html function
function PostCode($user,$title,$text, $lang)
{
      if($text!=" ")
         {
              $time = time(); 
              $this->executeSQL("INSERT INTO feeds VALUES(NULL,'$user','feed','$time','$title','$text', 0,'$lang')"); 
         }
}



function postFeed($user)
{
  echo '<form method="post" action="index.php?UserFeed='.$user.'" enctype="multipart/form-date">
       <div>
        <div class="AboutFeed">
        <ul>
        <li id="html">HTML</li>
        <li id="Java">Java</li>
        <li id="JavaScript">C++</li>
        <li id="NormalFeed">Plain Feed</li>
        </ul>
        <textArea type="text" value="input title"  id="feedTitle" name="feedTitle" >Input your title</textArea>
        <TextArea type="text" class="FeedInput" id="feedText" name="feedText"  class="AboutFeed"></textArea>
        <div class="AboutFeedEnd">
         <input type="submit" id="postFeedText" caption='.$user.' value="Post Feed" />
         <div id="errorp"><p> </p></div>
        </div>
        </div>
       </div>
      </form>';
      
}



function Postlikes($user)
{
   static $counter=0;
    if($counter++<1&&isset($_GET['like']))
    {    $person = $this->preventHacks($_GET['like']);
         $id = $this->preventHacks($_GET['heart']);
         $check = mysql_num_rows($this->executeSQL("SELECT * FROM feedLovers WHERE feedId='$id' AND likerName='$user'"));
         if($check==0){
             $this->executeSQL("UPDATE feeds SET likes=likes+1 WHERE auth='$person' AND id='$id'");
             $this->executeSQL("INSERT INTO feedLovers VALUES(NULL,'$id','$person','$user')");
         }else{
               $this->executeSQL("UPDATE feeds SET likes=likes-1 WHERE auth='$person' AND id='$id'");
               $this->executeSQL("DELETE FROM feedLovers WHERE  feedId='$id' AND Author='$person' AND likerName='$user'");
              }
        
    }
    
}

function getLastTenPost()
{
   $result =  $this->executeSQL("SELECT * FROM feeds ORDER BY time DESC LIMIT 4");
   while($col =  mysql_fetch_row($result))
   {    $image = $this->getImage($col[1]);

       echo "<table style=' width: 200px; border: 1px solid;'>";
       echo "<tbody>";
       echo "<tr>";
       echo "<td>";
       echo '<a href=index.php?view='.$col[1].'><img src='.$image.' width="50" height="50" ></img></a>';
       echo "</td>";
       echo "<td>";
       echo "<label>".$col[1];
       echo "</td>";
       echo "</tr>";
       echo "<tr>";
       echo "<td>";
       echo "<p>".$col[4]."</p>";
       echo "</td>";
       echo "</tr>";
       echo "</tbody>";
       echo "</table>";
   } 

}
function getLastTenFamous()
{
   $result =  $this->executeSQL("SELECT * FROM profiles ORDER BY reputation DESC LIMIT 5");
   while($col =  mysql_fetch_row($result))
   {    $image = $this->getImage($col[0]);

       echo "<table style=' width: 300px; border: 1px solid;'>";
       echo "<tbody>";
       echo "<tr>";
       echo "<td>";
       echo '<a href=index.php?view='.$col[0].'><img src='.$image.' width="50" height="50" ></img></a>';
       echo "</td>";
       echo "<td>";
       echo "<label>".$col[0];
       echo "</td>";
       echo "</tr>";
       echo "<tr>";
       echo "<td>";
       echo "<p> Reputation: ".$col[7]."</p>";
       echo "</td>";
       echo "</tr>";
       echo "</tbody>";
       echo "</table>";
   } 

}


function getLastThreeAnsweredQ()
{
   $original = array();
   $numElements = 0;
   $result =  $this->executeSQL("SELECT * FROM feeds ORDER BY id DESC");
   $highest = 0;
   $id = 0;
   $canCheck =true;
   while($col= mysql_fetch_row($result))
   {   
           $theComments =  $this->executeSQL("SELECT * FROM comments WHERE postId='$col[0]'");
            $num = mysql_num_rows( $theComments);
           if($num > $highest)
           {
              $highest = $num;
              $id =  $col[0];
           } 
          
   }
   $inserted =  array($id);
   array_splice( $original, $numElements++, 0, $inserted );
  
    $id = 0;
    $highest = 0;
    $result =  $this->executeSQL("SELECT * FROM feeds ORDER BY id DESC");
    while($col= mysql_fetch_row($result))
   {    
         for($i=0; $i<$numElements; $i++){ if($original[$i]==$col[0]){$canCheck =  false;}}

          if($canCheck){
           $theComments =  $this->executeSQL("SELECT * FROM comments WHERE postId='$col[0]'");
            $num = mysql_num_rows( $theComments);
           if($num > $highest)
           {
              $highest = $num;
              $id =  $col[0];
           } 
         }
          $canCheck = true;
   }
   $inserted =  array($id);
   array_splice( $original, $numElements++, 0, $inserted );
  
    $id = 0;
    $highest = 0;
    $result =  $this->executeSQL("SELECT * FROM feeds ORDER BY id DESC");
    while($col= mysql_fetch_row($result))
   {    
         for($i=0; $i<$numElements; $i++){ if($original[$i]==$col[0]){$canCheck =  false;}}

          if($canCheck){
           $theComments =  $this->executeSQL("SELECT * FROM comments WHERE postId='$col[0]'");
            $num = mysql_num_rows( $theComments);
           if($num > $highest)
           {
              $highest = $num;
              $id =  $col[0];
           } 
         }
          $canCheck = true;
   }
   $inserted =  array($id);
   array_splice( $original, $numElements++, 0, $inserted );
  

   for($i=0; $i<$numElements; $i++)
   {  
      $result =  $this->executeSQL("SELECT * FROM feeds WHERE id='$original[$i]'");
      $col =  mysql_fetch_row($result);
      $image = $this->getImage($col[1]);
      echo "<table style=' width: 300px; border: 1px solid;'>";
       echo "<tbody>";
       echo "<tr>";
       echo "<td>";
       echo '<a href=index.php?view='.$col[1].'><img src='.$image.' width="50" height="50" ></img></a>';
       echo "</td>";
       echo "<td>";
       echo "<label>".$col[1];
       echo "</td>";
       echo "</tr>";
       echo "<tr>";
       echo "<td>";
       echo "<p> Question :<a href=ecode.php?view=#".$col[0].">".$col[4]."</a></p>";
       echo "</td>";
       echo "</tr>";
       echo "</tbody>";
       echo "</table>";
   }




   /*while($col =  mysql_fetch_row($result))
   {    $image = $this->getImage($col[0]);

       echo "<table style=' width: 300px; border: 1px solid;'>";
       echo "<tbody>";
       echo "<tr>";
       echo "<td>";
       echo '<a href=index.php?view='.$col[0].'><img src='.$image.' width="50" height="50" ></img></a>';
       echo "</td>";
       echo "<td>";
       echo "<label>".$col[0];
       echo "</td>";
       echo "</tr>";
       echo "<tr>";
       echo "<td>";
       echo "<p> Reputation: ".$col[7]."</p>";
       echo "</td>";
       echo "</tr>";
       echo "</tbody>";
       echo "</table>";
   } */

}









function getTopFiveProgrammers()
{
   $result =  $this->executeSQL("SELECT * FROM profiles ORDER BY reputation DESC LIMIT 5");
   while($col =  mysql_fetch_row($result))
   {    $image = $this->getImage($col[0]);

      echo "<img src=".$image." width=650px height=370px caption=".$col[0]."> </img>";
   } 

}



function postComment($user)
{   static $counter=0;
   if(!empty($_POST['commentInput'])&& count($_POST['commentInput'])> 0)
   {        
           if(++$counter<=1){
           $person = $this->preventHacks($_GET['PostComment']);
           $id = $this->preventHacks($_GET['post']);
           $Text = $this->preventHacks($_POST['commentInput']);
           $result = $this->executeSQL("SELECT * FROM feeds WHERE auth='$person' AND id=$id");
           $currT =  time();
           $values = mysql_fetch_row($result);
           $this->executeSQL("INSERT INTO comments VALUES(null,'$values[0]','$person', '$values[3]', '$currT','$user', '$Text', 0)");}
    }
}

function showUserPost($user)
{
         $result = $this->executeSQL("SELECT * FROM feeds WHERE auth='$user' ORDER BY time DESC");  
            while($col = mysql_fetch_array($result)){
                $image = $this->getImage($col[1]);
                $this->postComment($user);
                $this->postLikes($user);
                date_default_timezone_set('UTC');
                $time = date("l jS \of F Y h:i:s A", $col[3]);
   echo '
        <div class="profile_fieldFeed">
        <a href=index.php?view='.$col[1].'><img src='.$image.' width="150" height="150" ></img></a>
        <div class="time" id="time" name="time">Name: '.$col[1].'<br/>'.$time.'</div>
        <div class="comment"><ul><div> Tittle :'.$col[4].'</div><div><textArea id="textA" cols="43" rows="5">'.$col[5].'</textArea></div><div><span>Language type:'.$col[7].'</span></div>
        <div>
         <form id="PostComment" method="post" action="index.php?PostComment='.$col[1].'&post='.$col[0].'" enctype="multipart/form-date">
                        <textArea id="textA" type="text" id="commentInput" name="commentInput" cols="43" rows="2" > </textArea>
                        <input  type="submit" value="Post" class="submitComment" id="submitComment" name="submitComment"/></form>
         </div></ul></div>
        <div class="prevCode">Preview Code
        </div>
        <div class="showCase">

        </div>
         <div class="showComment">';
         
        $res = $this->executeSQL("SELECT * FROM comments WHERE authPost='$col[1]' AND postId='$col[0]' ORDER BY time DESC");
        $length = mysql_num_rows($res);
         for($i=0; $i<$length; $i++)
         {
                
                $inf = mysql_fetch_row($res);
                date_default_timezone_set('UTC');
                $timeC = date("l jS \of F Y h:i:s A",$inf[4]);
                $saveTo = 'membersPhoto/'.$inf[5].'.jpg';
                echo "<div id='commenters'>";
                 
                if($inf[5]==$user){
                echo "<a href='index.php?view=".$inf[5]."'><img src=".$saveTo." width='50px' height='50px'></img></a>";
                echo "<ul><li>".$inf[6]." <a href='ecode.php?eraseComment=".$col[1]."&postId=".$col[0]."'                  name='eraseComent'><img src='icon/x.png' width='8px' height='8px' style='float:right; padding:1%;'></img></a></li>";
                echo "<li>time ".$timeC."</li></ul>";
                 }else{      
                echo "<a href='index.php?view=".$inf[5]."'><img src=".$saveTo." width='50px' height='50px'></img></a>";
                echo "<ul><li>".$inf[6]."</li>";
                echo "<li>time ".$timeC."</li></ul>";
                 }

                 echo "</div>";
         }

        echo'</div>
        <ul class="prof">
        <a id="like" href="ecode.php?like='.$col[1].'&heart='.$col[0].'" ><div class="heart-five">';
          $q = $this->executeSQL("SELECT * FROM feeds WHERE time='$col[3]'");
          $val = mysql_fetch_row($q);
          echo $val[6];
          
        echo '</div><div><ul class="lovers">';
         $q =  $this->executeSQL("SELECT * FROM feedLovers WHERE feedId='$col[0]' ORDER BY id DESC");
         if(mysql_num_rows($q)>0){
         while($h = mysql_fetch_row($q)){
         $saveT = 'membersPhoto/'.$h[3].'.jpg';  
         echo "<a href='index.php?view=".$h[3]."'><li><img src='".$saveT."' width=50px height=50px style='border-radius:100%;'></img></li></a>";}
         }
        echo '</ul></div></a>
        </ul>
       </div>
       ';
       }
}

//=======================================Fans Query=============================//
function showFans($user)
{
       $query =  $this->executeSQL("SELECT user FROM members ORDER BY user");
       $length = mysql_num_rows($query);
       for($i=0; $i<$length; $i++)
       {

            $row = mysql_fetch_row($query);
            $saveTo =  $this->getImage($row[0]);
            if($row[0]==$user){continue;}
            if(mysql_num_rows($this->executeSQL("SELECT * FROM fans WHERE user='$user' AND fan='$row[0]'")))
            {    $queryR = $this->executeSQL("SELECT * FROM members WHERE user='$row[0]'");
                 $rep  = $this->executeSQL("SELECT * FROM profiles WHERE user='$row[0]'");
                 $reput = mysql_fetch_row($rep);
                 $col =  mysql_fetch_row($queryR);
                  $numOne = $this->executeSQL("SELECT * FROM fans WHERE user='$row[0]'");
                  $numTwo = $this->executeSQL("SELECT * FROM followers WHERE user='$row[0]'");
                  $numThree = $this->executeSQL("SELECT * FROM friends WHERE user='$row[0]'");
                  $admirer =  mysql_num_rows($numOne);
                  $follower = mysql_num_rows($numTwo);
                  $friends = mysql_num_rows($numThree);
                 
                 
                 echo " <div class='backUser'>
                 <a href=index.php?view=$col[0]><div class='photId' style='background-image: url(".$saveTo."); width=150px height=150px'>
         
                 </div></a>
                 <div class='atr'>
                 <div class='fieldInfo'>
                 <label>Name: ".$col[0]."</label>
                 <label>reputation: ".$reput[8]."%</label>
                 </div>
                 <div class='reputInfo'>
                <label>admirers: ".$admirer."</label>
                 <label>followers: ".$follower."</label>
                 </div>
                 </div>
       </div>";
            }    
           
       }
}


function showFollowers($user)
{
      $query =  $this->executeSQL("SELECT user FROM members ORDER BY user");
       $length = mysql_num_rows($query);
       for($i=0; $i<$length; $i++)
       {
            $row = mysql_fetch_row($query);
            if($row[0]==$user){continue;}
            if(mysql_num_rows($this->executeSQL("SELECT * FROM followers WHERE user='$user' AND follower='$row[0]'")))
            {   $saveTo = $this->getImage($row[0]);
                $queryR = $this->executeSQL("SELECT * FROM members WHERE user='$row[0]'");
                 $rep  = $this->executeSQL("SELECT * FROM profiles WHERE user='$row[0]'");
                 $reput = mysql_fetch_row($rep);
                 $col =  mysql_fetch_row($queryR);
                  $numOne = $this->executeSQL("SELECT * FROM fans WHERE user='$row[0]'");
                  $numTwo = $this->executeSQL("SELECT * FROM followers WHERE user='$row[0]'");
                  $numThree = $this->executeSQL("SELECT * FROM friends WHERE user='$row[0]'");
                  $admirer =  mysql_num_rows($numOne);
                  $follower = mysql_num_rows($numTwo);
                  $friends = mysql_num_rows($numThree);
                 
                 
                 echo " <div class='backUser'>
                 <a href=index.php?view=$col[0]><div class='photId' style='background-image: url(".$saveTo."); width=150px height=150px'>
         
                 </div></a>
                 <div class='atr'>
                 <div class='fieldInfo'>
                 <label>Name: ".$col[0]."</label>
                 <label>reputation: ".$reput[8]."%</label>
                 </div>
                 <div class='reputInfo'>
                <label>admirers: ".$admirer."</label>
                 <label>followers: ".$follower."</label>
                 </div>
                 </div>
       </div>";
            }    
           
       }

}

  }

 $object = new EProgram($host,$dbName,$user,$pass);
 $object->Connect();
 $object->selectDB();


//==========================================================================================//
//anonymous function that will contact my function with respect to user pick
/*if(isset($_POST['action']) && !empty($_POST['action'])) {
    $action = $_POST['action'];
    switch($action) {
        case 'htmlInput' : $object->HtmlChoice();break;
        case 'blah' : break;
        // ...etc...
    }
}*/
  if(isset($_POST['text']) && !empty($_POST['text']))
    {
        $text =$_POST['text'];
        $lang = $_POST['lang'];
        $title= $_POST['title'];
        $user = $_POST['user'];
        $object->PostCode($user,$title,$text,$lang);
         
    }

//===========================================================================================//

?>