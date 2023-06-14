<?php
  session_start();
  require_once 'connection.php';

	$eid = $_GET['id'];
  $query ="SELECT * FROM event_list where id=$eid";
	$result = mysqli_query($conn, $query);

	// Fetch the data from the query result
	$data = mysqli_fetch_assoc($result);
    //$all_events = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Event.ly</title>
	<link rel="stylesheet" type="text/css" href="event_sh.css">
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="proj.js"></script>
</head>
<body>
	<div class="menu">
  <div class="page_name"><?php echo $data['event_name']; ?></div>
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
			<a href="./index.php"><img src="image\new_logo.png" alt="Event.ly"></a>
		</div>	
	</div>
  <div class="space">
	</div>



     <!-- <div class="container1">
        <div class="image">
          <img src="https://i0.wp.com/indiacollegefest.com/wp-content/uploads/2022/04/Nakshatra-2022-Saintgits-College-of-Engineering.jpg?fit=770%2C440&ssl=1" alt="Event Image">
        </div>
        <div class="content">
          <h1 class="event-name">Event Name</h1>
          <p class="event-date">Date</p>
          <p class="event-time">Time</p>
          <p class="event-location">Location</p>
          <button class="register-button">Register</button>
        </div>
    </div> -->
<div class="container1">
  <div class="image">
    <img src="<?php echo $data['eimage']; ?>" alt="Event Image">
  </div>
  <div class="content1">
    <h1 class="event-name"><?php echo $data['event_name']; ?></h1>
    <p class="event-date">Event Date: <?php echo date('jS F Y', strtotime($data["sdate"])); ?> - <?php echo date('jS F Y', strtotime($data["edate"])); ?></p>
    <p class="event-location">Event location: <?php echo $data['eloc']; ?></p>
  </div>
</div>

      
      <div class="desc_box">
        <!-- <p><?php echo $data['event_desc']; ?></p>  -->
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, optio? Nulla voluptatum quidem atque voluptas, veniam eum aut ut nisi deleniti excepturi ullam minima, molestias recusandae asperiores voluptatem modi in praesentium quod hic sed ab! Ut temporibus sunt minus assumenda consectetur ex eveniet quidem quisquam maxime. Aliquam ullam, dolor pariatur, sunt id soluta quae reprehenderit tenetur voluptatum fugit nulla a voluptas reiciendis impedit praesentium! Ea itaque officia fuga obcaecati quasi quidem nobis. Quisquam, a explicabo quibusdam quos ratione corrupti earum ut nobis magnam doloribus, beatae laborum sit placeat? Similique non voluptatibus iure. A consequatur omnis, similique veniam dignissimos quis excepturi.</p>
      </div>

      <a href="<?php echo $data['event_url']; ?>"><button class="register-button">Register</button></a>

      <!-- <button class="last_reg">Register</button> -->

</body>
</html>