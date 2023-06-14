<?php
    session_start();
?>    

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width , initial-scale=1.0">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.15.4/css/all.css"/>
	<!-- <link rel="stylesheet" type="text/css" href="style.css"> -->
	<link rel="stylesheet" type="text/css" href="aboutus.css">
    <title>About Us - Event.ly</title>
	<script src="proj.js"></script>
</head>
<body>
	
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
			<a href=""><img src="image\new_logo.png" alt="Event.ly"></a>
		</div>	
	</div>

    <div class="about_us">   
        <div class="content-section">
            <div class="title">
                <h1>About Us</h1>
                  </div>
                  <div class="content">
                <h3>Empowering College Events, Unleashing Student Creativity</h3>
                <p>Welcome to Event.ly, the premier event hosting platform for colleges! 
                    We specialize in providing colleges with a user-friendly and efficient platform to organize and host their events. 
                    From technical competitions and cultural extravaganzas to workshops and hackathons, Event.ly is here to support and 
                    promote your college-based events. With our comprehensive services and innovative features, we make event management 
                    a breeze for colleges, ensuring a successful and memorable experience for all participants. Join Event.ly today and take your 
                    college events to the next level!</p>

                    <div class="button">
                        <a href="">Learn More</a>
                    </div>
            </div>

            <div class="social">
                <a href=""><i class="fab fa-facebook-f"></i></a>
                <a href=""><i class="fab fa-twitter"></i></a>
                <a href=""><i class="fab fa-instagram"></i></a>
            </div>
        </div>
           
        <div class="image-section">
            <img src="image/new_logo.png">
        </div>
    </div>

</body>
</html>