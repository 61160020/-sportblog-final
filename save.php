
<?php
session_start();
if (isset($_SESSION['loggedin'])) {
  if ($_SESSION['user_group'] == "U"){
    header("location: index1.php");
  }else if($_SESSION['user_group'] == "A"){
    header("location: index1-Admin.php");
  } 
} else {
        require_once('connection.php');

        $mysqli = new mysqli($db_host, $db_user, $db_password, $db_name);
        $mysqli->set_charset("utf8");
        
        
        $uname = $_POST['username'];
        $passwd = md5($_POST['passwd']);
        $cpass = md5($_POST['cpasswd']);
        $name = $_POST['name'];
        $penname = $_POST['penname'];
        $email = $_POST['email'];
        $images = $_POST['file'];
        $user_group = $_POST['user_group'];
        
        $suname = htmlspecialchars($uname, ENT_QUOTES);
        $spasswd = htmlspecialchars($passwd, ENT_QUOTES);
        $scpass = htmlspecialchars($cpass, ENT_QUOTES);
        $sname = htmlspecialchars($name, ENT_QUOTES);
        $spenname = htmlspecialchars($penname, ENT_QUOTES);
        $semail = htmlspecialchars($email, ENT_QUOTES);
        $suser_group  = htmlspecialchars($user_group, ENT_QUOTES);
        
        
        $sql = "INSERT 
                    INTO authors (username,passwd,name,penname,email,images,user_group) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("sssssss", $suname,$spasswd, $sname,$spenname,$semail,$images,$suser_group);
           
            $stmt->execute();
            // echo $stmt->affected_rows . " row inserted. ";
        
            header("location: login2.php");
}
?>
    