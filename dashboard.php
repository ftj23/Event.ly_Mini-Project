<?php
	session_start();
    require_once 'connection.php';
    $sql ="SELECT * FROM event_list WHERE status='approved' AND listed_by ='{$_SESSION['lemail']}'";
    $all_events = $conn->query($sql);

?>


<!DOCTYPE html>
<html>
<head>
	<title>My Dashboard</title>
	<link rel="stylesheet" type="text/css" href="event_page.css">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="dashboard.css">
	<script src="proj.js"></script>
</head>

<body>

	<div class="menu">
		<div class="page_name">Dashboard</div>
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
	<div class="space"></div>


    <div class="dashboard">

        <div class="user_img">
            <img src="image/user.png" alt="user image">
        </div>        

        <div class="info">

            <?php
            echo "<p>Name: ".$_SESSION['username']."</p>
            <p>College: ".$_SESSION['college']."</p>
            <p>Mobile: " .$_SESSION['mobno']."</p>";
            
            ?>
        </div>
    </div>
    <div class="space"></div>

    <div class="user_listed_events">Your listed events: </div>
    


    <?php 
        while($row = mysqli_fetch_assoc($all_events)){
    ?>
    <div class="event_card">
        <a href="event_show.php?id=<?php echo $row['id']; ?>"><img src="<?php echo $row["eimage"]; ?>" alt="fest1"></a>
        <div class="middle">
            <div class="evname"><?php echo $row["event_name"]; ?></div>
            <div class="edat"><?php echo date('jS F Y', strtotime($row["sdate"])); ?></div>
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <input type="hidden" name="event_id" value="<?php echo $row['id']; ?>">
                <button type="submit" name="delete_event" class="delete-btn">Delete</button>
            </form>
        </div>
    </div>
    <?php
        }
    ?>

<?php
    if (isset($_POST['delete_event'])) {
        $eventID = $_POST['event_id'];

        $sql = "DELETE FROM event_list WHERE id = '$eventID'";
        $result = $conn->query($sql);

        if ($conn->affected_rows > 0) {
            // Event deleted successfully
            echo '<script type="text/javascript">';
            echo 'alert("Event deleted successfully!");';
            echo '</script>';
        } else {
            // Failed to delete event
            echo '<script type="text/javascript">';
            echo 'alert("Error: Failed to delete the event.");';
            echo '</script>';
        }
    }
?>



</body>
</html>