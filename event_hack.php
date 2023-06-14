<?php
	session_start();
    require_once 'connection.php';

    $sql1 ="SELECT * FROM event_list WHERE event_type='hackathon' AND status='approved'";
    $all_events_et = $conn->query($sql1);

?>


<!DOCTYPE html>
<html>
<head>
	<title>Events</title>
	<link rel="stylesheet" type="text/css" href="event_page.css">
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="proj.js"></script>
</head>

<body>

	<div class="menu">
		<div class="page_name">Hackathons</div>
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
    <?php 
        while($row = mysqli_fetch_assoc($all_events_et)){
    ?>
    <div class="event_card">
        <a href="event_show.php?id=<?php echo $row['id']; ?>"><img src="<?php echo $row["eimage"]; ?>" alt="fest1">
		<div class="middle">
			<div class="evname"><?php echo $row["event_name"]; ?></div>
			<div class="edat"><?php echo date('jS F Y', strtotime($row["sdate"])); ?></div>
			<button class="register-btn">Register</button>
		</div>
	</div>
    <?php
        }
    ?>



</body>
</html>