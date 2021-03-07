<?php
  session_start();
  if (isset($_SESSION['loggedin'])) {
    if ($_SESSION['user_group'] == "U"){
      header("location: index1.php");
    }else if($_SESSION['user_group'] == "A"){
      header("location: index1-Admin.php");
    } 
  } else {
    //do nothing
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src='https://kit.fontawesome.com/a076d05399.js'></script>
  
  <script src= "validation.js"></script> 
  <title>Sign up</title>

</head>

<body onload="document.registform.username.focus();">

   
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container">
    <a class="navbar-brand"><font color="#FFCC00">Sport Blog!!</font></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        
        <li class="nav-item active">
          <a class="nav-link" href="index.php"><font color="#FFCC00">Home <i class='fas fa-campground' style='font-size:24px'></font></i>
                <span class="sr-only"></span>
              </a>
        </li>
        
      </ul>
    </div>
  </div>
</nav>
   <center>
    <br><br><br>
    <h1>สมัครสมาชิก</h1>
    <br>
    <form  method="post" name="registform" onSubmit="return formValidation();"  action="save.php">
    <div class="form-group">
              <div class="form-row">
                <label class="control-label col-sm-5" for="username">Username : </label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" placeholder="Enter username" name="username" id="username" maxlength="45" onkeyup="show()">
                  <div aline="right" id="disp" type="text"></div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="form-row">
                <label class="control-label col-sm-5" for="passwd">Password : </label>
                <div class="col-sm-5">
                  <input type="password" class="form-control" placeholder="Enter Password" name="passwd" id="passwd" maxlength="45" >
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="form-row">
                <label class="control-label col-sm-5" for="passwd">Confirm Password : </label>
                <div class="col-sm-5">
                  <input type="password" class="form-control" placeholder="Confirm Password" name="cpasswd" id="cpasswd" maxlength="45" >
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="form-row">
                <label class="control-label col-sm-5" for="name">Name : </label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" placeholder="Enter name" name="name" id="name" maxlength="45" >
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="form-row">
                <label class="control-label col-sm-5" for="penname">Penname : </label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" placeholder="Enter penname" name="penname" id="penname" maxlength="45" >
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="form-row">
                <label class="control-label col-sm-5" for="email">Email : </label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" placeholder="Enter email" name="email" id="email" maxlength="45" >
                </div>
              </div>
            </div>
            <input type="hidden" name="file" value="default.png">
            <input type="hidden" id="user_group" name="user_group" value="U">
            <div class="form-group">
            <button type="submit" class="btn btn-success btn-lg">Submit</button>
            </div>
</form>
</center>
<script>
function show() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("disp").innerHTML = this.responseText;
    }
  };

  var Mname = document.getElementById('username').value;
  var queryString = "?username=" + Mname;
  xhttp.open("GET", "search.php" + queryString);
  xhttp.send();
}
</script>
</body>
</html>




