<?php
    session_start();
    if (!isset($_SESSION['loggedin'])) {
      header("location: login.php");
    } else {
      if ($_SESSION['user_group'] == "U"){
        header("location: index1.php");
      }else{
        //donot    
      }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
    <style>
img {
    border-radius: 50%;
}
</style>
<script src= "validation.edit.js"></script>
  <title>Sport-Blog</title>

</head>

<body onload="document.addform.title.focus();">

<?php
    // connect database 
    require_once('connection.php');

    $mysqli = new mysqli($db_host, $db_user, $db_password, $db_name);
    $mysqli->set_charset("utf8");

    if ($mysqli->connect_errno) {
      echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ")" . $mysqli->connect_error;
  } else {
      // connect success, do nothing
  }
$id = trim($_REQUEST['id']);
$sql = "SELECT *
        FROM authors
        WHERE id = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_object();
?>
   
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container">
    <a class="navbar-brand"><font color="#FFCC00">SportBlog!! </font></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="Admin-edituser.php"><font color="#FFCC00">Back <i class='fas fa-sign-out-alt' style='font-size:24px'></font></i></a>
        </li>
      </ul>
    </div>
  </div>
</nav>

   <center>
    <br><br><br><br>
    <h1>แก้ไขข้อมูลผู้ใช้</h1>
    <img src="upload/<?php echo $row->images ?>" width="150px" height="150px" alt=""><br>
    <form action="save_editauthorAdmin.php" method="post" name="registform" onSubmit="return formValidation();">
            <div class="form-group">
            <label for="id"></label>    
              <input type="hidden" name="id" value="<?php echo $id?>">
              </div>

            <div class="form-group">
              <div class="form-row">
                <label class="control-label col-sm-5" for="username">Username : </label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" name="username" id="username" placeholder="Username" maxlength="45" value="<?php echo $row->username; ?>">
                  </div>
              </div>
            </div>
            <div class="form-group">
              <div class="form-row">
                <label class="control-label col-sm-5" for="name">ชื่อ-นามสกุล : </label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" name="name" id="name" placeholder="Name" maxlength="45" value="<?php echo $row->name;?>">
                  </div>
              </div>
            </div>
            <div class="form-group">
              <div class="form-row">
                <label class="control-label col-sm-5" for="penname">นามปากกา : </label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" name="penname" id="penname" placeholder="Penname" maxlength="45" value="<?php echo $row->penname;?>">
                  </div>
              </div>
            </div>
            <div class="form-group">
              <div class="form-row">
                <label class="control-label col-sm-5" for="email">Email : </label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" name="email" id="email" placeholder="Email" maxlength="45" value="<?php echo $row->email;?>">
                  </div>
              </div>
            </div>
            
            <input type="hidden" name="file" value="<?php echo $row->images ?>">
            <div class="form-group">
                <label class="control-label col-sm-5" ></label>
                  <div class="col-sm-5">
                  <input type="submit" class='btn btn-success' value="Save"> 
                  <a href="Admin-edituser.php" class="btn btn-danger">Cancel</a>
              </div>
            </div>
            </form>
            
</center>
</body>
</html>




