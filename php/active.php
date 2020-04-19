<?php
	include_once("connect.php");//连接数据库 

	$verify = stripslashes(trim($_GET['verify'])); 
	$nowtime = time(); 

	$query = mysqli_query($conn, "select id,token_exptime from t_user where status='0' and  
	`token`='$verify'"); 
	$row = mysqli_fetch_array($query); 
	if($row){ 
	    if($nowtime>$row['token_exptime']){ //24hour 
	        $msg = 'Your register time has expired. Please verify your account again.'; 
	    }else{ 
	        mysqli_query($conn, "update t_user set status=1 where id=".$row['id']); 
	        if(mysqli_affected_rows($conn)!=1) die(0); 
	        $msg = 'Account verified successfully!'; 
	        header("Location: /index.html", true);
	        exit;
	    } 
	}else{ 
	    $msg = 'error.';     
	} 
	echo $msg; 
?>