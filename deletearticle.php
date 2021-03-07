<?php
if (!isset($_SESSION['loggedin'])) {
    header("location: login.php");
} else {
    if ($_SESSION['user_group'] == "A"){
    header("location: index1-Admin.php");
    }else if($_SESSION['user_group'] == "U"){
        require_once('connection.php');

        $mysqli = new mysqli($db_host, $db_user, $db_password, $db_name);
        $mysqli->set_charset("utf8");
    
    if (isset($_REQUEST['id'])) {
        $id = trim($_REQUEST['id']);
        
        $id = stripslashes($id);
        $id = htmlspecialchars($id);
    
        $sql = "DELETE 
            FROM articles
            WHERE id =?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("s", $id);
        $stmt->execute();
    
        echo "<script> alert('ลบบทความแล้ว') </script>";
        header("Refresh:0; url=index2.php");
    }else {
        header("location: editarticle.php");
    }
    }
}

?>