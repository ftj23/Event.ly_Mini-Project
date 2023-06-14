<?php
	session_start();
    require_once 'connection.php';
    $query1 ="SELECT * FROM event_list WHERE status='approved' ORDER BY sdate ASC LIMIT 1";
    $query2 ="SELECT * FROM event_list WHERE status='approved' ORDER BY sdate ASC LIMIT 1 OFFSET 1";
    $query3 ="SELECT * FROM event_list WHERE status='approved' ORDER BY sdate ASC LIMIT 1 OFFSET 2";
    $query4 ="SELECT * FROM event_list WHERE status='approved' ORDER BY sdate ASC LIMIT 5";

    $slide1 = mysqli_query($conn, $query1);
    $slide2 = mysqli_query($conn, $query2);
    $slide3 = mysqli_query($conn, $query3);
    $slide4 = mysqli_query($conn, $query4);
	
	$row1 = mysqli_fetch_assoc($slide1);
	$row2 = mysqli_fetch_assoc($slide2);
	$row3 = mysqli_fetch_assoc($slide3);
	// $row4 = mysqli_fetch_assoc($slide4);

?>


<!DOCTYPE html>
<html>
<head>
	<title>Event.ly</title>
	<link rel="stylesheet" type="text/css" href="style.css">
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

		<form class="search-form" method="GET" action="search.php" onsubmit="return validateForm()">
			<input type="text" id="searchQuery" name="searchQuery" placeholder="Search for Events">
			<input type="submit" value="Search">
		</form>

	</div>

	<div class="space">
	</div>

	<section class="container">
		<div class="slider-wrapper">
			<div class="slider">
				<img id="slide1" src="<?php echo $row1['eimage']; ?>" alt="<?php echo $row1['event_name']; ?>">
				<img id="slide2"src="<?php echo $row2['eimage']; ?>" alt="<?php echo $row2['event_name']; ?>">
				<img id="slide3" src="<?php echo $row3['eimage']; ?>" alt="<?php echo $row3['event_name']; ?>" >
			</div>
			<div class="slider-nav">
				<a href="#slide1"></a>
				<a href="#slide2"></a>
				<a href="#slide3"></a>
			</div>
			<div class="navigation-auto" >
				<div class="auto-btn1"></div>
				<div class="auto-btn2"></div>
				<div class="auto-btn3"></div>
			</div>
		</div>
	</section>

	<div class="sec-nav">
		<div class="s-left">
			<a href="event_ty.php"><p>Techical fests</p></a>
			<a href="event_work.php"><p>Workshops</p></a>
			<a href="event_hack.php"><p>Hackathons</p></a>
			<a href="event_other.php"><p>Other Events</p></a>
		</div>
	</div>

	<div class="upc-eve">
		<h1>Upcoming Events</h1>
		<!-- <div class="card">
			<a href="event_show.php?id=<?php echo $row1['id']; ?>"><img src="<?php echo $row1['eimage']; ?>" alt="<?php echo $row1['event_name']; ?>"></a>
		</div>

		<div class="card">
			<a href="event_show.php?id=<?php echo $row2['id']; ?>"><img src="<?php echo $row2['eimage']; ?>" alt="<?php echo $row2['event_name']; ?>"></a>
		</div>

		<div class="card">
			<a href="event_show.php?id=<?php echo $row3['id']; ?>"><img src="<?php echo $row3['eimage']; ?>" alt="<?php echo $row3['event_name']; ?>"></a>
		</div>

		<div class="card">
			<a href="event_show.php?id=<?php echo $row4['id']; ?>"><img src="<?php echo $row4['eimage']; ?>" alt="<?php echo $row4['event_name']; ?>"></a>
		</div>

		<div class="card">
			<img src="image\fest5.jpg" alt="fest4">
		</div> -->
		<?php 
        while($row4 = mysqli_fetch_assoc($slide4)){
    	?>
		<div class="card">
			<a href="event_show.php?id=<?php echo $row4['id']; ?>"><img src="<?php echo $row4['eimage']; ?>" alt="<?php echo $row4['event_name']; ?>"></a>
		</div>

		<?php
        	}
    	?>
	</div>

	
	<div class="event_hm_page_heading">
		<h1>Discover and Promote Exciting Events with Evently</h1>
	</div>
	<div class="event_hm_page">
	<div class="content">
      <img src="image/p1.png" alt="Event Image">
      <div class="content-text">
        <h2>Discover and Explore Exciting Events</h2>
        <p>At Evently, we provide a platform to list and showcase a wide range of events. Whether you're looking for concerts, conferences, workshops, or sports events, Evently is the perfect place to discover and explore what's happening in your area. Our website offers a comprehensive collection of events that cater to various interests and preferences.</p>
      </div>
    </div>

    <div class="content">
      <img src="image/p2.png" alt="Event Image 2">
      <div class="content-text">
        <h2>List and Promote Your Events with Ease</h2>
        <p>With Evently, it's incredibly easy to list and showcase your own events. Our user-friendly interface allows event organizers to create and manage event listings effortlessly. You can add event details, upload images, set ticket prices, and provide additional information to attract attendees. By listing your events on Evently, you can effectively promote your gatherings to a wider audience, ensuring maximum exposure and increased participation.</p>
      </div>
    </div>
	</div>


	
	<script>
	// Get the slider element
	var slider = document.querySelector('.slider');

	// Get the individual slide elements
	var slides = slider.getElementsByTagName('img');

	// Set the index of the currently displayed slide
	var currentSlide = 0;

	// Function to show the next slide
	function showNextSlide() {
		// Hide the current slide
		slides[currentSlide].style.display = 'none';

		// Increment the current slide index
		currentSlide = (currentSlide + 1) % slides.length;

		// Show the next slide
		slides[currentSlide].style.display = 'block';
	}

	// Automatically show the next slide every 3 seconds
	setInterval(showNextSlide, 3000);


	function validateForm() {
        var searchQuery = document.getElementById("searchQuery").value;
        if (searchQuery.trim() === "") {
            alert("Please enter a search query");
            return false; // Prevent form submission
        }
        return true; // Allow form submission
    }
	</script>

</body>
</html>