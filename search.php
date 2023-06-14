<?php
    require_once 'connection.php';


    $ename = $_GET['searchQuery'];
    $query = "SELECT * FROM event_list WHERE status='approved' AND event_name LIKE '%$ename%' OR college_name LIKE '%$ename%' OR eloc LIKE '%$ename%'";
	$all_events = mysqli_query($conn, $query);

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
		<div class="page_name">Showing results for : <?php echo $ename; ?></div>
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
        while($row1 = mysqli_fetch_assoc($all_events)){
    ?>
    <div class="event_card">
        <a href="event_show.php?id=<?php echo $row1['id']; ?>"><img src="<?php echo $row1["eimage"]; ?>" alt="fest1"></a>
		<div class="middle">
			<div class="evname"><?php echo $row1["event_name"]; ?></div>
			<div class="edat"><?php echo date('jS F Y', strtotime($row1["sdate"])); ?></div>
			<a href="event_show.php?id=<?php echo $row1['id']; ?>"><button class="register-btn">Register</button></a>
		</div>
	</div>
    <?php
        }
    ?>

	



</body>
</html>