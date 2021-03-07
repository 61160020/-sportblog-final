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
  <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>

  <!-- Plugin CSS -->
  <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

  <!-- Theme CSS - Includes Bootstrap -->
  <link href="css/creative.min.css" rel="stylesheet">
  <title>Sport-Blog</title>
  <style>
img {
    border-radius: 50%;
}
</style>
</head>

<body id="page-top">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container">
    <a class="navbar-brand"><font color="#FFCC00">Sport Blog!!</font></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="Admin-edituser.php"><font color="#FFCC00"><i class='fas fa-user' style='font-size:24px'></i> จัดการข้อมูล User</font></i></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index-Admin.php"><font color="#FFCC00"><i class='fas fa-book' style='font-size:24px'></i> จัดการบทความทั้งหมด </font></i></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php"><font color="#FFCC00">Logout <i class='fas fa-sign-out-alt' style='font-size:24px'></font></i></a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<header class="masthead">
    <div class="container h-100">
      <div class="row h-100 align-items-center justify-content-center text-center">
        <div class="col-lg-10 align-self-end">
          <h1 class="text-uppercase text-white font-weight-bold">เว็บไซต์กีฬา</h1>
          <hr class="divider my-4">
        </div>
        <div class="col-lg-8 align-self-baseline">
          <p class="text-white-75 font-weight-light mb-5">ที่รวมบทความที่เกี่ยวกับกีฬาเอาไว้</p>
        </div>
      </div>
    </div>
  </header>

    <div class="container">
    <br>
    <?php $q = (htmlspecialchars(isset($_GET['q']) ? $_GET['q'] : '')); ?>
    <h1>บทความทั้งหมด</h1>
          <form action="index1-Admin.php" method="get" class="form-horizontal">
            <div class="form-group row">
              <div class="col-sm-5">
                <input type="text" name="q" class="form-control">
              </div>
              <div class="col-sm-2">
                <button type="submit" class="btn btn-primary">ค้นหา
                </button>
              </div>
            </div>
          </form>
          
      <?php
    if($q==''){
      
          // connect database 
    require_once('connection.php');

    $mysqli = new mysqli($db_host, $db_user, $db_password, $db_name);
    $mysqli->set_charset("utf8");

    // check connection error 
    if ($mysqli->connect_errno) {
      echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    } else {
      // connect success, do nothng
    }

    // select data from tables
    // $limit = ($_GET['limit']<>"")? $_GET['limit'] : 10;
    $sql = "SELECT *
          FROM articles ar INNER JOIN authors a
          ON authors_id = a.id
          WHERE publish_sts = 'Y'
          ORDER BY updatetime DESC";
    $result = $mysqli->query($sql);

    if (!$result) {
          echo ("Error: ". $mysqli->error);
          
    } else {
    ?>

    <table class="table table-hover">


    <?php while($row = $result->fetch_object()){ ?>


    <!-- Page Heading -->
    <h1 class="my-4" ></h1>
    <div class="row" >
    <div class="card " >
    <div class="card-body ">
        <div> 
        <h2 class="card-title"><?php echo $row->title ?></h2>
        </div>

        <?php echo $row->body ?>
    </div>
      <div class="page-link">
      วันที่สร้าง <?php echo $row->create_ts ?> โดย <a class="avatar"><img src="upload/<?php echo $row->images ?>" width="50px" height="50px" alt=""> </a>  <?php echo $row->penname ?>
      </div>
    </div>
    </div>  
    <?php
      } 
    ?>
    <?php
      } 
    }else if($q!=''){
    // connect database 
    require_once('connection.php');

    $mysqli = new mysqli($db_host, $db_user, $db_password, $db_name);
    $mysqli->set_charset("utf8");

    // check connection error 
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    } else {
        // connect success, do nothng
    }

    // select data from tables
    // $limit = ($_GET['limit']<>"")? $_GET['limit'] : 10;
    $sql = "SELECT *
            FROM articles ar INNER JOIN authors a
            ON authors_id = a.id
            WHERE publish_sts = 'Y' AND title LIKE '%$q%' OR body LIKE '%$q%' OR penname LIKE '%$q%'
            ORDER BY updatetime DESC";
    $result = $mysqli->query($sql);

    if (!$result) {
            echo ("Error: ". $mysqli->error);
            
    } else {
    ?>

    <table class="table table-hover">


    <?php while($row = $result->fetch_object()){ ?>


    <!-- Page Heading -->
    <h1 class="my-4" ></h1>
    <div class="row" >
    <div class="card " >
    <div class="card-body ">
          <div> 
          <h2 class="card-title"><?php echo $row->title ?></h2>
          </div>

          <?php echo $row->body ?>
    </div>
        <div class="page-link">
        วันที่สร้าง <?php echo $row->create_ts ?> โดย <a class="avatar"><img src="upload/<?php echo $row->images ?>" width="50px" height="50px" alt=""> </a>  <?php echo $row->penname ?>
        </div>
      </div>
    </div>  
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

<footer class="bg-light py-5">
    <div class="container">
      <div class="small text-center text-muted">Prepared by Group-05</div>
    </div>
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

  

</body>
</html>