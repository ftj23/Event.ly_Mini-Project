<?php
  session_start();
  error_reporting();
  $servername = "localhost:4306";
  $username = "root";
  $password = "";
  $dbname = "eventdetails";

  $conn = mysqli_connect($servername,$username ,$password ,$dbname);

  if ($conn) {
    //connection ok
  }
  else
  {
    echo "Connection failed".mysqli_connect_error();
  }
?>

<!DOCTYPE html>
  <html lang="en" >
  <head>
    <meta charset="UTF-8">
    <title>Event.ly</title>
    <!-- <link rel="stylesheet" href="./style.css"> -->
    <link rel="stylesheet" href="./event_listing.css">
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
  <div class="list-space">
    </div>
  
  <!-- event image container  -->
  <div class="event_box">
    <div class="form-container">
    <div class="event_list_title">Event Listing</div>

      <form id="myForm" action="#" method="POST" enctype="multipart/form-data">
          <label for="event-name">Event Name:</label>
          <input type="text" id="event-name" name="eventname" required><br><br>
          
          <label for="college-name">College Name:</label>
          <input type="text" id="college-name" name="collegename" required><br><br>
  
          <label for="event-type">Event Type:</label>
          <select id="event-type" name="eventtype"required>
            <option value="not selected">Select</option>
            <option value="techfest">Technical Fest</option>
            <option value="hackathon">Hackathon</option>
            <option value="workshop">Workshop</option>
            <option value="other">Other</option>
          </select><br><br>
  
          <label for="start-date">Start date:</label>
          <input type="date" id="sdate" name="sdate" required>
  
          <label for="end-date">End date:</label>
          <input type="date" id="edate" name="edate" required><br><br>
          
          <label for="address">Location:</label>
          <input type="text" id="location" name="location" required><br><br>
    </div>
    <div class="form-container">
          <div class="space"></div>
          <label for="description">Description:</label><br>
          <textarea cols="50" rows="10" id="large-textarea" name="message" required></textarea><br><br>
          
          <label for="image">Upload Image:</label>
          <input type="file" id="event-image" name="eventimage" accept="image/*"><br><br>
          
          <label for="url">Event URL:</label>
          <input type="text" id="url" name="url"><br><br>
          
          <input type="submit" value="Submit" name="register">
        </form>
    </div>
  
  </div>
  
  
  </body>
  </html>

  <?php

if(isset($_POST["register"])){
  
  //data retrieve
  $eventname = $_POST["eventname"];
  $collegename = $_POST["collegename"];
  $eventtype = $_POST["eventtype"];
  $sdate = $_POST["sdate"];
  $edate = $_POST["edate"];
  $location = $_POST["location"];
  $message = $_POST["message"];
  $url = $_POST["url"];

  //image upload
  $eventimage = $_FILES["eventimage"]["name"];
  $tempname = $_FILES["eventimage"]["tmp_name"];
  $folder = "db_uploads/".$eventimage;
  move_uploaded_file($tempname,$folder);

  // $query = "INSERT INTO event_list(event_name, college_name, event_type, sdate, edate, eloc,event_desc,eimage,event_url,status) VALUES ('$eventname', '$collegename', '$eventtype', '$sdate', '$edate', '$location', ?, '$folder', '$url','pending')";
  $query = "INSERT INTO event_list(event_name, college_name, event_type, sdate, edate, eloc,event_desc,eimage,event_url,listed_by,status) VALUES (?, ?, ?, ? ,? ,?, ?, ?, ?,?,'pending')";
  // $data=mysqli_query($conn,$query);

  // Create a prepared statement
  $stmt = $conn->prepare($query);

  // Bind the parameters to the statement
  $stmt->bind_param("ssssssssss", $eventname, $collegename, $eventtype, $sdate, $edate, $location, $message, $folder, $url, $_SESSION['lemail']);
  
  $stmt->execute();


  if($stmt->affected_rows > 0){
    echo '<script type="text/javascript">';
    echo 'alert("Your data has been sent for approval");';
    echo '</script>';
  }else{
    echo "Failed";
  }

}
?>