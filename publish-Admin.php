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
        $publish_sts = "";

        $mysqli = new mysqli($db_host, $db_user, $db_password, $db_name);
        $mysqli->set_charset("utf8");

        // check connection error 
        if ($mysqli->connect_errno) {
            echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        } else {
            // connect success, do nothing
        }
        $idY = $_GET['idY'];
        $idN = $_GET['idN'];

        if($idY !=""){
            $publish_sts='N';
            $id = $idY;
        }
        else{
            $publish_sts='Y';
            $id = $idN;
        }

        $sql = "UPDATE articles
        SET publish_sts = ?
        WHERE id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("ss", $publish_sts, $id);//order by ?(values)
        $stmt->execute();

        header("location: index-Admin.php");
    }
}
?>