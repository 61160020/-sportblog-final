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
<html>
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
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container">
    <a class="navbar-brand"><font color="#FFCC00">SportBlog!! </font></a>
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
<div class="container">
    <br><br>
    <center><h1>----------------------------------------</h1></center>
    <center><h1>แก้ไขบทความ</h1></center>
    <?php
    
    // connect database 
    require_once('connection.php');

    $mysqli = new mysqli($db_host, $db_user, $db_password, $db_name);
    $mysqli->set_charset("utf8");

if(isset($_REQUEST['id'])){
    
      $arid = trim($_REQUEST['id']);

      $arid = htmlentities($arid);
      // $arid = stripslashes($arid);
      // $arid = htmlspecialchars($arid);

      $sql = "SELECT *
      FROM articles
      WHERE articles.id = ? ";

      $stmt = $mysqli->prepare($sql);
      $stmt->bind_param("s",$arid);
      $stmt->execute();
      $result = $stmt->get_result();
      $row = $result->fetch_object();
    
    

?>
    <center>
    <form action="save2_edit.php" method="post"> 
                  <input type="hidden" name="atriclesID" value= "<?php echo  $arid ?>">
                  <h5 name="atriclesID">Article ID : <?php echo $arid ?></h5>
                  <div class="form-group">
                    <label for="title">ชื่อบทความ :</label>
                    <input type="text" class="form-control" value= "<?php echo $row->title ?>" name="title">
                  </div>
                  <div class="form-group">
                  <label for="body">เนื้อหาบทความ:</label>
                  <textarea class="form-control" rows="5" name="body"> <?php echo $row->body ?> </textarea>
                  </div>
                  <div class="form-group">
                  <label for="updatetime">วันที่ เวลา ที่ปรับปรุงบทความล่าสุด :</label>
                  <input type="datetime-local" class="form-control"  name="updatetime" required>
                  </div>
                  <br> </br>
                  <div class="form-group">
                  <button type="submit" class="btn btn-success btn-lg" name="editsubmit">Submit</button> 
                  <a href="deletearticle.php?id=<?php echo $row->id?>" class="btn btn-danger" onClick="return confirm('คุณต้องการที่จะลบบทความนี้หรือไม่ ?');" >Delete Post</a>
                  </div>  
    </form>
    <h1>----------------------------------------</h1>
    </center>
<?php
 }else {
  header("location: index2.php");
}
?>
</div>
</body>  
</html>  

