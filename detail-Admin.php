<?php session_start();
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
          <a class="nav-link" href="index-Admin.php"><font color="#FFCC00">Back <i class='fas fa-sign-out-alt' style='font-size:24px'></font></i></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"><font color="#FFCC00"><i class='fas fa-user' style='font-size:24px'></i> : <?php echo $_SESSION["username"]; ?></font></i></a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div class="container"> 
    <br><br><br>
    <center><h1>รายละเอียดบทความ</h1></center>
    <?php
    
    // connect database 
    require_once('connection.php');

    $mysqli = new mysqli($db_host, $db_user, $db_password, $db_name);
    $mysqli->set_charset("utf8");

    $arid = $_REQUEST['id'];
    $arid = htmlentities($arid);
    
    $sql = "SELECT *
    FROM articles ar INNER JOIN authors a
    ON authors_id = a.id
    WHERE ar.id = ? ";

$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s",$arid);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_object();
?>
    <center>
    <form> 
                  <input type="hidden" name="atriclesID" value= "<?php echo  $arid ?>">
                  <h3 name="atriclesID">Article ID : <?php echo $arid ?> </h3>
                  <div class="form-group">
                    <h4>ชื่อบทความ : <?php echo $row->title ?></h4>
                  </div>

                  <div class="form-group">
                  <h4>เนื้อหาบทความ</h4>
                  <textarea style="width:800px; height:200px;"><?php echo $row->body ?></textarea>
                  </div>
                  <br>
                  <h5>ID Author : <?php echo $row->id ?></h5> 
                  <h5>ผู้เขียน : <?php echo $row->penname ?></h5> 
                  <div class="form-group">
                  <h5>วันที่ สร้างบทความ : <?php echo $row->create_ts ?></h5> 
                  </div>              
    </form>
    </center>
</div>
</body>  
</html>  

