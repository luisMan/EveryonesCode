<?php
  include_once('function.php');

if (isset($_SESSION['user']))
{
    $user     = $_SESSION['user'];
  
}
         $object->OfflineUser($user);
         echo "deteroying section";
    	 $object-> DestroySection($user);
    	 header("Location:  intro.php");

?>