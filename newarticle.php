<?php
session_start();
// $id = $_SESSION['id'];

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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Sport-Blog</title>
    
</head>
<body onload="document.registform.username.focus();">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container">
    <a class="navbar-brand"><font color="#FFCC00">Sport Blog!!</font></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="index2.php"><font color="#FFCC00">Back <i class='fas fa-sign-out-alt' style='font-size:24px'></font></i></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"><font color="#FFCC00"><i class='fas fa-user' style='font-size:24px'></i> : <?php echo $_SESSION["username"]; ?></font></i></a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<center>
<div class="container">
    <br><br><br><br>
    <h1>เพิ่มบทความใหม่</h1>
    <form action="save2.php" method="post">

                  <div class="form-group">
                    <label for="title">ชื่อบทความ :</label>
                    <input type="text" class="form-control" placeholder="Enter Title" name="title" required>
                  </div>

                  <div class="form-group">
                  <label for="body">เนื้อหาบทความ:</label>
                  <textarea class="form-control" rows="5" placeholder="Enter Body" name="body"></textarea>
                  </div>

                  <input type="hidden" name="authors_id" value= "<?php echo  $_SESSION['authors_id'] ?>">

                  <div class="col-md-4 mb-4">
                  <label for="updatetime">วันที่ เวลา ที่สร้างบทความ :</label>
                  <input type="datetime-local" class="form-control" placeholder="Enter Createtime" name="create_ts">
                  </div>

                  <div class="col-md-4 mb-4">
                  <label for="updatetime">วันที่ เวลา ที่ปรับปรุงบทความล่าสุด :</label>
                  <input type="datetime-local" class="form-control" placeholder="Enter Updatetime" name="updatetime" >
                  </div>

                  <div class="form-check-inline">
                    <label class="form-check-label" for="publish_sts">สถานะบทความ : 
                    <input type="radio" class="form-check-input"  name="publish_sts" value="N" checked> N
                    <input type="radio" class="form-check-input"  name="publish_sts" value="Y"> Y
                    </label>
                  </div>
                  <br>
                  <br>
                  <div class="form-group">
                  <button type="submit" class="btn btn-success btn-lg " name="btn_insert">Submit</button>
                  </div>
                  
        </form>
    </div>
    </center>
</body>  
</html>  
