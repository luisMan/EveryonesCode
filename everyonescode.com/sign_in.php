<?php
$error = $user = $pass="";

if (isset($_POST['user']))
{
    $user = $object->preventHacks($_POST['user']);
    $pass = $object->preventHacks($_POST['pass']);
   


    if ($user == "" || $pass == ""  )
    {
        $error = "fields are missing<br />";
    }
    else
    {
        $query = "SELECT user,pass FROM members
            WHERE user='$user' AND pass='$pass'";

        if (mysql_num_rows($object->executeSQL($query)) == 0)
        {
            $error = "<span class='error'>Username/Password
                      invalid</span><br /><br />";
        }
        else
        {
          
            
            $_SESSION['user'] = $user;
            $_SESSION['pass'] = $pass;
            header ("Location: ecode.php");
            die();
        }
    }
}
      $error2 = $newuser = $newpass = $newname = $newlast = $newemail = $newGender= $area="";
      $notValid ;
if (isset($_SESSION['newuser'])) $this->destroySession();

if (isset($_POST['newuser']))
{
    $newuser = $object->preventHacks($_POST['newuser']);
    $newpass = $object->preventHacks($_POST['newpass']);
    $newname = $object->preventHacks($_POST['newname']);
    $newlast = $object->preventHacks($_POST['newlast']);
    $newemail= $object->preventHacks($_POST['newemail']);
    $area    = $object->preventHacks($_POST['interest']);
  
    $newGender= $object->preventHacks($_POST['contact_by']);
    
    if(strtolower($newuser) == "gay" || strtolower($newuser) == "suck" ){$error ="Invalid userName host!";
       $notValid = false;}else{$notValid = true;}
    
    if ($newuser == "" || $newpass == "" || $newname == "" || $newlast == "" || $newemail == " "){
        $error = "Not all fields were entered";
        echo '<script type="text/javascript"> alert("error+'.$error.'"); </script>';
   } else
    {  
         if($notValid){
       
        
        if(mysql_num_rows($object->executeSQL("SELECT * FROM members
              WHERE user='$newuser'")) || mysql_num_rows($object->executeSQL("SELECT * FROM members
              WHERE email='$newemail'")))
        {
            $error = "That UserName / Email already exits host!";
             echo '<script type="text/javascript"> alert("error ='.$error.'"); </script>';

        }else
          {
            $object->executeSQL("INSERT INTO members VALUES('$newuser', '$newpass', '$newemail', '$newname','$newlast','$newGender','$area',1)");
            $error = "Account Created";
            header('LOCATION: signIn.php');
        }
    }
    }
}


?>