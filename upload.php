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
    <title>Insert file page</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
<div class="container text-center">
<h1>Insert file</h1>
<form action="save-upload.php" method="post" class="form-horizontal" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $_SESSION['authors_id'] ?>">
        <div class="form-group">
            <div class="row">
            <label for="name" class="col-sm-3 control-label">File</label>
            <div class="col-sm-9">
                <input type="file" name="images" class="form-control">
            </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-12">
                <input type="submit" name="submit" class="btn btn-success" value="Insert">
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