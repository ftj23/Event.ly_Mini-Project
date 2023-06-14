<?php
  session_start();
  require_once 'connection.php';  

?>

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Login - Event.ly</title>
  <link rel="stylesheet" href="./login.css">
  <link rel="stylesheet" href="./style.css">
  <script src="proj.js"></script>
</head>
<body>
<!-- menu bar -->
<div class="menu">
  <div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    
    <?php
			if (isset($_SESSION['lemail'])) {
				echo "<a href='dashboard.php'><p class='welcome-message' style='color: white; font-size: 48px;
				font-size: 40px;
				font-family: 'Roboto', sans-serif;
				color: #818181;
				text-transform: uppercase;
				display: block;
				transition: 0.3s;''>Hi, <span>" . $_SESSION['username'] . "</span>!</p></a>";
			}
			?>

    <a href="index.php">Home</a>
		<a href="event_page.php">Events</a>
		<a href="aboutus.php">About us</a>
    
    <?php
      if (isset($_SESSION['lemail'])) {
          echo "<a href='event_listing.php'>List event</a>";
      }
    ?>

    <?php
      if (isset($_SESSION['lemail'])) {
          echo "<a href='logout.php'>Logout</a>";
      }else{
        echo "<a href='login.php'>Login</a>";
      }
    ?>
		
  </div>
    
  <div class="icon" onclick="openNav()">
    <span></span>
    <span></span>
    <span></span>
    <span></span>
  </div>	
  <div class="logo">
    <a href="index.php"><img src="image\new_logo.png" alt="Event.ly"></a>
  </div>	
</div>
<div class="login-space">
</div>

<!-- partial:index.partial.html -->
<div class="login-page">
    <div class="login-title">
        <h1>LOGIN / SIGN-UP</h1>
    </div>
  <div class="form">
    <form class="register-form" method="POST" enctype="multipart/form-data">
      <input type="text" name="username" placeholder="Name"/>
      <input type="text" name="clg" placeholder="College"/>
      <input type="text" name="mobno" placeholder="Mobile number"/>
      <input type="text" name="email" placeholder="Email Address"/>   
      <input type="password" name="password" placeholder="Password"/>
      <button id="signUp" name="signUp" >create</button>
      <p class="message">Already registered? <a href="#">Log In</a></p>
    </form>
    <form class="login-form" method="POST" enctype="multipart/form-data">
      <input type="text" name='log-email' placeholder="Email"/>
      <input type="password" name="log-password" placeholder="Password"/>
      <button id="logIn" name="logIn">login</button>
      <p class="message">Not registered? <a href="#">Create an account</a></p>
    </form>
  </div>
</div>


</div>
<?php

  if(isset($_POST["signUp"])){
    $username = $_POST["username"];
    $clg = $_POST["clg"];
    $mobno = $_POST["mobno"];
    $email = $_POST["email"];
    $pwd = $_POST["password"];

    $select ="SELECT * FROM login WHERE email='$email'";
    $result = mysqli_query($conn,$select);

    if(mysqli_num_rows($result) > 0){
      echo '<script type="text/javascript">';
      echo 'alert("Email already taken!");';
      echo 'window.location.href = "login.php";';
      echo '</script>';
    }
    else
    {
      $register = "INSERT INTO login (name, college,mobile_no,email, password,log_status) VALUES ('$username','$clg','$mobno','$email','$pwd','pending')";
      mysqli_query($conn,$register);
      echo '<script type="text/javascript">';
      echo 'alert("Your account is now pending for approval. After approval you can list events. Check after 1 hr!");';
      // echo 'window.location.href = "login.php";';
      echo '</script>';
    }

  }

  if(isset($_POST["logIn"])){
    $lemail = $_POST["log-email"];
    $lpassword = $_POST["log-password"];

    $select1 = mysqli_query($conn,"SELECT * FROM login WHERE email='$lemail' AND password='$lpassword'");
    $row=mysqli_fetch_array($select1);

    $status =$row['log_status'];

   
    $select2 = mysqli_query($conn,"SELECT * FROM login WHERE email='$lemail' AND password='$lpassword'");
    $check_user=mysqli_num_rows($select2);


    if($check_user == 1){

      
      $_SESSION["log_status"]=$row['log_status'];
      $_SESSION["lemail"]=$row['email'];
      $_SESSION["username"]=$row['name'];
      $_SESSION["college"]=$row['college'];
      $_SESSION["mobno"]=$row['mobile_no'];

      if($status =="approved"){
        echo '<script type="text/javascript">';
        echo 'alert("Login success!");';
        echo 'window.location.href = "index.php";';
        echo '</script>';
      }

      elseif($status =="pending"){
        echo '<script type="text/javascript">';
        echo 'alert("Your account is still pending for approval!");';
        echo 'window.location.href = "login.php";';
        echo '</script>';
      }
      else{
        echo '<script type="text/javascript">';
        echo 'alert("Incorrect email or password!");';
        echo '</script>';
      }
     
    }
  }



?>

<!-- partial -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script><script  src="./script.js"></script>

</body>
</html>
