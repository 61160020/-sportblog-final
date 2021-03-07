<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("location: login.php");
} else {
    if ($_SESSION['user_group'] == "A"){
    header("location: index1-Admin.php");
    }else if($_SESSION['user_group'] == "U"){
        // connect database 
        require_once('connection.php');

        $mysqli = new mysqli($db_host, $db_user, $db_password, $db_name);
        $mysqli->set_charset("utf8");

    if(isset($_POST['editsubmit'])){

            $arid = trim($_POST['atriclesID']);
            $title = trim($_POST['title']);
            $body = trim($_POST['body']);
            $updatetime=trim($_POST['updatetime']);
            $stitle = htmlspecialchars($title, ENT_QUOTES);
            $sbody = htmlspecialchars($body, ENT_QUOTES);

            $sql = "UPDATE articles
                    SET
                    title = ?,
                    body = ?,
                    updatetime = ?
                    WHERE id = ?";
                
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("ssss", $stitle,$sbody,$updatetime,$arid);
        $stmt->execute();

        echo "<script> alert('แก้บทความเรียบร้อยแล้ว') </script>";
        header("Refresh:0; url=index2.php");
    }else {
        header("location: editarticle.php");
    }
    }
}
?>

    
