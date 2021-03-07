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
    <h4 align='center'>บทความทั้งหมดของ Sport-Blog</h4>
    <br>
          <form action="index-Admin.php" method="get" class="form-horizontal">
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
    $id = $_SESSION['authors_id'];

    // select data from tables
    $sql = "SELECT *
    FROM articles 
    ORDER BY updatetime DESC";
    $result = $mysqli->query($sql);

    if (!$result) {
            echo ("Error: ". $mysqli->error);
            
    } else {
    ?>
      
  
<center>
<table border='2'>

<tr>
<th>ID Article</th>
<th>Title</th>
<th>CreateTime</th>
<th>UpdateTime</th>
<th>Publish</th>
<th>Detail</th>
<th>Delete</th>
</tr>

<?php 
    while($row = $result->fetch_object()){ ?>

    <tr>
        <td>
            <center><?php echo $row->id ?></center>
        </td>
        <td>
            <center><?php echo $row->title ?></center>
        </td>
        <td>
            <?php echo $row->create_ts ?>
        </td>
        <td>
            <?php echo $row->updatetime ?>
        </td>
        
        <td>
           <center> <?php 
                    if ($row->publish_sts == 'Y'){
                    echo "<a href='publish-Admin.php?idY=$row->id'><button type='button' class='btn btn-danger'>Unpublish</button></a>";
                    }elseif($row->publish_sts == 'N') { 
                    echo "<a href='publish-Admin.php?idN=$row->id'><button type='button' class='btn btn-success'>Publish</button></a>";
                    }; ?> </center>
                  
        </td>
       
        <td>
            <div>
            <center><a href="detail-Admin.php?id=<?php echo $row->id?>"><i class="far fa-clipboard" style="font-size:24px;color:black"></i></a></center>
            </div>
        </td>

        <td>
            <div>
            <center><a href="deletearticle-Admin.php?id=<?php echo $row->id?>"><i class="fa fa-trash" style="font-size:24px;color:red"></i></a></center>
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
    $id = $_SESSION['authors_id'];

    // select data from tables
    $sql = "SELECT *
    FROM articles
    WHERE title LIKE '%$b%' OR id LIKE '%$b%'";
    $result = $mysqli->query($sql);

    if (!$result) {
            echo ("Error: ". $mysqli->error);
            
    } else {
    ?>
      
  
<center>
<table border='2'>

<tr>
<th>ID Article</th>
<th>Title</th>
<th>CreateTime</th>
<th>UpdateTime</th>
<th>Publish</th>
<th>Detail</th>
<th>Delete</th>
</tr>

<?php 
    while($row = $result->fetch_object()){ ?>

    <tr>
        <td>
            <center><?php echo $row->id ?></center>
        </td>
        <td>
            <center><?php echo $row->title ?></center>
        </td>
        <td>
            <?php echo $row->create_ts ?>
        </td>
        <td>
            <?php echo $row->updatetime ?>
        </td>
        
        <td>
           <center> <?php 
                    if ($row->publish_sts == 'Y'){
                    echo "<a href='publish-Admin.php?idY=$row->id'><button type='button' class='btn btn-danger'>Unpublish</button></a>";
                    }elseif($row->publish_sts == 'N') { 
                    echo "<a href='publish-Admin.php?idN=$row->id'><button type='button' class='btn btn-success'>Publish</button></a>";
                    }; ?> </center>
                  
        </td>
       
        <td>
            <div>
            <center><a href="detail-Admin.php?id=<?php echo $row->id?>"><i class="far fa-clipboard" style="font-size:24px;color:black"></i></a></center>
            </div>
        </td>

        <td>
            <div>
            <center><a href="deletearticle-Admin.php?id=<?php echo $row->id?>"><i class="fa fa-trash" style="font-size:24px;color:red"></i></a></center>
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