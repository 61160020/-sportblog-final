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
            $id = $_POST['id'];
        if(isset($_POST['submit'])){
            
            $checktype = $_FILES["images"]["type"];
            $checksize = $_FILES["images"]["size"];
            
            if($checktype == "image/jpg" || $checktype == "image/png" || $checktype == "image/jpeg"){
                if ($checksize < 1000000) { // check file size 1MB
                    $ext = pathinfo(basename($_FILES['images']['name']), PATHINFO_EXTENSION);
                    $new_image_name = 'img_'.uniqid().".".$ext;
                    $path = "upload/";
                    $upload_path = $path.$new_image_name;
                    
                    //uploading
                    $success = move_uploaded_file($_FILES['images']['tmp_name'], $upload_path);
                
                    $images = $new_image_name;
                    
                    $sql = "UPDATE authors
                            SET images = ?
                            WHERE id  = ?";
                    $stmt = $mysqli->prepare($sql);
                    $stmt->bind_param("ss", $images, $id);
                
                    $stmt->execute();
                        echo "<script> alert('อัพโหลดไฟล์ภาพเสร็จแล้ว') </script>";
                        header("Refresh:0; url=editauthor.php");
                
                } else {
                    echo "<script> alert('ไฟล์ภาพของคุณมีขนาดใหญ่เกิน 1 MB') </script>";
                    header("Refresh:0;editauthor.php");
                }
            } else {
                echo "<script> alert('โปรดอัพโหลดเป็นไฟล์ภาพ png และ jpg เท่านั้น') </script>";
                header("Refresh:0;editauthor.php");
            }  
        }else {
            header("location: editauthor.php");
        }
    }
}
?>