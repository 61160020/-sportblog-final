<!DOCTYPE html>
<?php
session_start();
$username = $_SESSION['username'];
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
<html lang="en">
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src='https://kit.fontawesome.com/a076d05399.js'></script>

  <!-- Font Awesome Icons -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Google Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">

  <!-- Plugin CSS -->
  <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

  <!-- Theme CSS - Includes Bootstrap -->
  <link href="css/creative.min.css" rel="stylesheet">
  <script src= "validation.js"></script> 
  <title>Sport-Blog</title>

</head>

<body class="p-3 mb-2 bg-light text-dark">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container">
    <a class="navbar-brand"><font color="#FFCC00">Sport Blog!!</font></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
          <a class="nav-link" href="index1-Admin.php"><font color="#FFCC00">Home <i class='fas fa-campground' style='font-size:24px'></font></i>
                <span class="sr-only"></span>
              </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php"><font color="#FFCC00">Logout <i class='fas fa-sign-out-alt' style='font-size:24px'></font></i></a>
        </li>
      </ul>
    </div>
  </div>
</nav>


    <div class="container">
    <br><br><br>
    <?php $b = (htmlspecialchars(isset($_GET['b']) ? $_GET['b'] : '')); ?>
    <h1>User : Admin </h1>
    <h4 align='center'>ข้อมูลทั้งหมดของ User</h4>
    <br>
          <form action="Admin-edituser.php" method="get" class="form-horizontal">
            <div class="form-group row">
              <div class="col-sm-3">
                <input type="text" name="b" class="form-control" >
              </div>
              <div class="col-sm-1">
                <button type="submit" class="btn btn-primary">ค้นหา
                </button>
              </div>
            </div>
          </form>
    <br>
      <?php
    if($b==''){
        // connect database 
    require_once('connection.php');

    $mysqli = new mysqli($db_host, $db_user, $db_password, $db_name);
    $mysqli->set_charset("utf8");
    // $id = $_SESSION['authors_id'];

    // select data from tables
    $sql = "SELECT *
    FROM authors
    WHERE user_group = 'U' ";
    $result = $mysqli->query($sql);

    if (!$result) {
            echo ("Error: ". $mysqli->error);
            
    } else {
    ?>
      
  
<center>
<table border='2'>

<tr>
<th>ID User</th>
<th>Username</th>
<th>Name</th>
<th>Penname</th>
<th>Email</th>
<th>Edit</th>
<th>Delete</th>
</tr>

<?php 
    while($row = $result->fetch_object()){ ?>

    <tr>
        <td>
            <center><?php echo $row->id ?></center>
        </td>
        <td>
            <center><?php echo $row->username ?></center>
        </td>
        <td>
        <center><?php echo $row->name ?></center>
        </td>
        <td>
        <center><?php echo $row->penname ?></center>
        </td>
       
        <td>
            <div>
            <center><?php echo $row->email ?></center>
            </div>
        </td>
        <td>
            <div>
            <center><a href="editauthor-Admin.php?id=<?php echo $row->id?>"><i class="fa fa-tools" style="font-size:20px;color:gray"></i></a></center>
            </div>
        </td>
        <td>
            <div>
            <center><a href="deleteauthor-Admin.php?id=<?php echo $row->id?>"><i class="fa fa-trash" style="font-size:24px;color:red"></i></a></center>
            </div>
        </td>
        
    </tr>

  <?php
          } 
  ?>
  <?php
          } 
    }else if($b!=''){
         // connect database 
    require_once('connection.php');

    $mysqli = new mysqli($db_host, $db_user, $db_password, $db_name);
    $mysqli->set_charset("utf8");
    // $id = $_SESSION['authors_id'];

    // select data from tables
    $sql = "SELECT *
    FROM authors
    WHERE username LIKE '%$b%' OR id LIKE '%$b%' OR name LIKE '%$b%' OR penname LIKE '%$b%' OR email LIKE '%$b%'";
    $result = $mysqli->query($sql);

    if (!$result) {
            echo ("Error: ". $mysqli->error);
            
    } else {
    ?>
      
  
<center>
<table border='2'>

<tr>
<th>ID User</th>
<th>Username</th>
<th>Name</th>
<th>Penname</th>
<th>Email</th>
<th>Edit</th>
<th>Delete</th>
</tr>

<?php 
    while($row = $result->fetch_object()){ ?>

    <tr>
        <td>
            <center><?php echo $row->id ?></center>
        </td>
        <td>
            <center><?php echo $row->username ?></center>
        </td>
        <td>
        <center><?php echo $row->name ?></center>
        </td>
        <td>
        <center><?php echo $row->penname ?></center>
        </td>
       
        <td>
            <div>
            <center><?php echo $row->email ?></center>
            </div>
        </td>
        <td>
            <div>
            <center><a href="editauthor-Admin.php?id=<?php echo $row->id?>"><i class="fa fa-tools" style="font-size:20px;color:gray"></i></a></center>
            </div>
        </td>
        <td>
            <div>
            <center><a href="deleteauthor-Admin.php?id=<?php echo $row->id?>"><i class="fa fa-trash" style="font-size:24px;color:red"></i></a></center>
            </div>
        </td>
        
    </tr>

  <?php
          } 
  ?>
  <?php
          } 
    }
    
  ?>
</table>
<hr />
</div>
</center>
</body>
</html>