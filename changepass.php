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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Sport-Blog</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>

<div class="container text-center">
<br>
<h1>เปลี่ยนรหัสผ่าน</h1>
<form action="save-pass.php" method="post" class="form-horizontal" enctype="multipart/form-data" >
<br>
        <input type="hidden" name="id" value="<?php echo $_SESSION['authors_id'] ?>">
        <input type="hidden" name="username" value="<?php echo $_SESSION["username"]; ?>">
       
        <br>
        <div class="form-group">
            <div class="form-group">
              <div class="form-row">
                <label class="control-label col-sm-5" for="passwd">รหัสผ่านใหม่ : </label>
                <div class="col-sm-5">
                  <input type="password" class="form-control" placeholder="New Password" name="passwd" id="passwd" maxlength="45" >
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="form-row">
                <label class="control-label col-sm-5" for="passwd">ยืนยันรหัสผ่านใหม่ : </label>
                <div class="col-sm-5">
                  <input type="password" class="form-control" placeholder="Confirm New Password" name="cpasswd" id="cpasswd" maxlength="45" >
                </div>
              </div>
            </div>
            <br>
            <div class="form-group">
            <div class="col-sm-12">
                <input type="submit" name="submitpass" class="btn btn-success" value="Submit">
                <a href="editauthor.php" class="btn btn-danger">Cancel</a>
            </div>
        </div>
</form>
</div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>