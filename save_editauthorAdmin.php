<?php
    session_start();
    if (!isset($_SESSION['loggedin'])) {
        header("location: login.php");
    } else {
        if ($_SESSION['user_group'] == "U"){
        header("location: index1.php");
        }else if($_SESSION['user_group'] == "A"){
         // connect database 
            require_once('connection.php');

            $mysqli = new mysqli($db_host, $db_user, $db_password, $db_name);
            $mysqli->set_charset("utf8");

            // echo "<pre>";
            // print_r($_POST);
            // echo"</pre>";
            $username = $_POST['username'];
            $name = $_POST['name'];
            $penname = $_POST['penname'];
            $email = $_POST['email'];
            $id = trim($_REQUEST['id']);
            $susername = htmlspecialchars($username, ENT_QUOTES);
            $sname = htmlspecialchars($name, ENT_QUOTES);
            $spenname = htmlspecialchars($penname, ENT_QUOTES);
            $semail = htmlspecialchars($email, ENT_QUOTES);

        

            $sql = "UPDATE authors
                    SET 
                    username = ?,    
                    name =?,
                    penname =?,
                    email =?
                WHERE id  = ?";
            
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("sssss", $susername, $sname, $spenname , $semail, $id );
            $stmt->execute();

            // echo $stmt->error;  //ไว้ดู error
                
                // echo $stmt->affected_rows . " row inserted.";
                // echo $id;
            $_SESSION['username'] = $_POST['username'];
            header("location: Admin-edituser.php");
        }
    }
?>
