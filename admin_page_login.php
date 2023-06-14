<?php
   
    require 'connection.php';

?>

<!DOCTYPE html>
  <html lang="en" >
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event.ly</title>
    <!-- <link rel="stylesheet" href="./style.css"> -->
    <link rel="stylesheet" href="./admin_page.css">
    <script src="proj.js"></script>
  </head>
  <body>
    <div class="center">
        <h1>User Details</h1>
        
        


        <?php
                $query ="SELECT * FROM login WHERE log_status = 'pending'";
                $result = mysqli_query($conn,$query);
                while ($row = mysqli_fetch_array($result)){

            ?>
        <table id ="user_details">
            
            <tr>
                <th>Name</th>
                <th>College name</th>
                <th>Mobile no</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
             <?php 
                // $query ="SELECT * FROM event_list WHERE status = 'pending'";
                // $result = mysqli_query($conn,$query);
                // while ($row = mysqli_fetch_array($result)){

            // ?>
             <tr>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['college']; ?></td>
                <td><?php echo $row['mobile_no']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td>
                    <form  action="#" method="POST">
                        <input type="hidden" name="id" value="<?php echo $row['id'];?>"/>
                        <input type="submit" name="approve" value="Approve"/>
                        <input type="submit" name="deny" value="Deny"/>
                    </form>
                </td>        
            </tr>
            
        </table>
        <?php 
            } 
        ?>
    </div>
    
    <?php

    if (empty($result)) {
        echo "No users are pending for approval";
    }

    if(isset($_POST['approve'])){
        $id = $_POST['id'];

        $select ="UPDATE login SET log_status = 'approved' WHERE id ='$id'";
        $result = mysqli_query($conn,$select);

        echo '<script type="text/javascript">';
        echo 'alert("User approved!");';
        echo 'window.location.href - "admin_page.php"';
        echo '</script>';
    }

    if(isset($_POST['deny'])){
        $id = $_POST['id'];

        // $select ="UPDATE event_list SET status = 'deny' WHERE id ='$id";
        $select ="DELETE FROM login WHERE id ='$id'";
        $result = mysqli_query($conn,$select);

        echo '<script type="text/javascript">';
        echo 'alert("The user has been denied!");';
        echo 'window.location.href - "admin_page.php"';
        echo '</script>';
    }

    ?>
  
  </body>
  </html>