<div class="inner-nav">
   <a href="ecode.php"><div class="logo"></div></a>
   <a href="intro.php" style="text-decoration: none; color: white; "><div class="logoIntro">Intro</div></a>

   <div id="feeds" class="feeds"><?php echo $object->getTotalFriendR($user); ?><div id="feed-post"><?php $object->showFriendRequest($user); ?></div></div>
   <div class="search">
    <div><input type="text" value="search for person" id="search"></input></div> 
    <div id="Settings"></div>
   </div>
   <div id="menuBox">
     <ul>
        <?php
     echo "<li><a href='index.php'>Your profile</a></li>";
     echo "<li><a href='fans.php?view=".$user."'>your Fans</a></li>";
     echo "<li><a href='followers.php?view=".$user."'>your Followers</a></li>";
     echo "<li><a href='famous.php'>Top 100 famous</a></li>";
     echo "<li><a href='members.php'>Members</a></li>";
     echo "<li><a href='account.php'>Account Settings</a></li>";
      echo "<li><a id='logout' href='logout.php'>log out</a></li>";
        ?>
     </ul>
     </div>
     <script type="text/javascript" src="js/menu.js"></script>
</div>