<?php
	include_once("connect.php");
   if(isset($_POST["submit_login_info"]))
   {
      $username = trim($_POST["username"]);
      $password = trim($_POST["password"]);
      $query = mysqli_query($conn, "select id, password, status, login_times from t_user where `username`='$username'"); 
      $row = mysqli_fetch_array($query);
      if($row) {
      	if(password_verify($password, $row['password'])) {
      		/* free result set */
            if($row['status'] == 1) {
               mysqli_query($conn, "update t_user set login_times = login_times + 1 where id=".$row['id']);
               mysqli_free_result($query);
               mysqli_close($conn);
               header("Location: /welcome.html");
               exit;
            } else {
               echo "Account not verified. Please check your email and verify again";
            }
			
      	} else {
      		echo 'Incorrect password!' . '<br>';
      	}
      } else {
      	echo 'Unknown username!' . '<br>';
      }
      /* free result set */
		mysqli_free_result($query);
   } else {
   	echo("Cannot get submit information");
   }
   mysqli_close($conn);
?>

