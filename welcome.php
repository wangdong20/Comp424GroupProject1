<?php
session_start();
require("function.php");
?>
<!DOCTYPE html>
<!-- this html will be connected with back-end, which means when user login successfully, it will load this page. -->
<html>
	<head>
		<title>Welcome!</title>
		<link rel="stylesheet" type="text/css" href="flipcard.css">
		<script src="https://kit.fontawesome.com/37f6515aab.js" crossorigin="anonymous"></script>
	</head>
	<body>
		<p class = "main_font">Welcome!, you login successfully!</p>
		<?php 
		if(isset($_SESSION['username'])){
			$usersData = getUsersData(getId($_SESSION['username']));
			?>
		<div id ="setname">
		<?php echo $usersData['lastname']." ".$usersData['firstname']." you last login date is ".$usersData['last_login_date']." and you had login ".$usersData['login_times']." times"; ?>
		</div>
		<?php}
		?>
		<a href = "" id="download">Download file</a>
		<div class = "main_container_welcome">
			<div class = "first_part_container">		
				<div class = "first_box_welcome_card">
					<div class = "first_member_front">
						<p class = "front_text">First Member!</p>
					</div>
					<div class = "first_member_back">
						<div class = "text_in_middle">
							<h2>Haemin Lee</h2>
							<span>First Group Project</span>
							<div class = "social_link">
								<a href ="https://www.linkedin.com/in/haemin-lee-810400198/"><i class="fab fa-linkedin-in"></i></a> <!-- linkedin -->
								<a href ="https://github.com/haemin9014?tab=repositories"><i class="fab fa-github"></i></a> <!-- github --> 						
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class = "second_part_container">		
				<div class = "second_box_welcome_card">
					<div class = "second_member_front">
						<p class = "front_text">Second Member!</p>
					</div>
					<div class = "second_member_back">
						<div class = "text_in_middle">
							<h2>Dong Wang</h2>
							<span>First Group Project</span>
							<div class = "social_link">
								<a href ="https://www.linkedin.com/in/dong-wang-b2b298134/"><i class="fab fa-linkedin-in"></i></a> <!-- linkedin -->
								<a href ="https://github.com/wangdong20?tab=repositories"><i class="fab fa-github"></i></a> <!-- github --> 						
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class = "third_part_container">		
				<div class = "third_box_welcome_card">
					<div class = "third_member_front">
						<p class = "front_text">Third Member!</p>
					</div>
					<div class = "third_member_back">
						<div class = "text_in_middle">
							<h2>Christopher Yun</h2>
							<span>First Group Project</span>
							<div class = "social_link">
								<a href ="https://github.com/topheryun?tab=repositories"><i class="fab fa-github"></i></a> 					
							</div>
						</div>
					</div>
				</div>
			</div>
			<input type="submit" class="logout_button" value="Logout" >
			<!-- this part will be connected with back-end -->
		</div>
	</body>
	<footer>

	</footer>
	<script>
		var downloadalbeFile = 'company_confidential_file';
	  	var inText = 'download successfully!';
	  	var textFile = new Blob([inText], {type: 'text/plain'});
	  	window.URL = window.URL || window.webkitURL;
	  	document.getElementById('download').setAttribute('href', window.URL.createObjectURL(textFile));
	  	document.getElementById('download').setAttribute('download', downloadalbeFile);
	</script>
</html>