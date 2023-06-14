<?php
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