
<?php

session_start();
if (!isset($_SESSION['loggedin'])) {
    header("location: login.php");
} else {
    if ($_SESSION['user_group'] == "A"){
    header("location: index1-Admin.php");
    }else if($_SESSION['user_group'] == "U"){
        require_once('connection.php');

        $mysqli = new mysqli($db_host, $db_user, $db_password, $db_name);
        $mysqli->set_charset("utf8");

            // echo "<pre>";
            // print_r($_POST);
            // echo"</pre>";


        $title = $_POST['title'];
        $body = $_POST['body'];
        $authors_id=$_POST['authors_id'];
        $updatetime=$_POST['updatetime'];
        $publish_sts=$_POST['publish_sts'];

        $stitle = htmlspecialchars($title, ENT_QUOTES);
        $sbody = htmlspecialchars($body, ENT_QUOTES);


        $sql = "INSERT 
                INTO articles (title, body, authors_id, updatetime, publish_sts)
                VALUES (?, ?, ?, ?, ?)";

        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("ssiss",$stitle,$sbody, $authors_id,$updatetime,$publish_sts);
        $stmt->execute();
            //echo $stmt->affected_rows . " row inserted. ";

        header("location: index2.php");
    }
}
?>