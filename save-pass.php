<?php
    session_start();
    if (!isset($_SESSION['loggedin'])) {
        header("location: login.php");
    } else {
      if($_SESSION['user_group'] == "A"){
        header("location: index1-Admin.php");
      }else{
        //donot    
      }
    }
?>
<html>
<meta charset="UTF-8">
    <?php
    // connect database 
    require_once('connection.php');

    $mysqli = new mysqli($db_host, $db_user, $db_password, $db_name);
    $mysqli->set_charset("utf8");

    // echo "<pre>";
    // print_r($_POST);
    // echo"</pre>";

    $id = $_REQUEST['id'];
    $username = $_POST['username'];
    $passwd = $_POST['passwd'];
    $cpass = $_POST['cpasswd'];
    $spasswd = MD5(htmlspecialchars($passwd, ENT_QUOTES));
    $scpass = MD5(htmlspecialchars($cpass, ENT_QUOTES));
    

    if($passwd == "" & $cpass == ""){

        echo "<script> alert('กรุณากรอกรหัสผ่านทั้ง 2 ช่อง') </script>";
        header("Refresh:0;changepass.php");

    }else if($spasswd == $scpass){
            $sql = "UPDATE authors
                    SET passwd = ?
                    WHERE id  = ?";
        
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("ss", $spasswd,$id );
        $stmt->execute();

        $_SESSION['username'] = $_POST['username'];
        header("location: index2.php");
    }else{
        $_SESSION['username'] = $_POST['username'];
        echo "<script> alert('รหัสผ่านและรหัสผ่านยืนยันไม่ตรงกัน') </script>";
        header("Refresh:0;changepass.php");
    }

    
?>
