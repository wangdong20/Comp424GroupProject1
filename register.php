<?php
    include_once("connect.php");
    $username = stripslashes(trim($_POST['userId']));
    $query = mysqli_query($conn, "select id from t_user where username='$username'"); 
    $num = mysqli_num_rows($query); 
    if($num==1){ 
        echo 'Username already exists please select another username.'; 
        exit; 
    }

    $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT); //加密密码 
    $email = trim($_POST['email']); //邮箱 
    $regtime = time(); 
    $firstname = trim($_POST['firstName']);
    $lastname = trim($_POST['lastName']);
    $birthdate = trim($_POST['birthDate']);
    $question_one = trim($_POST['questionOne']);
    $answer_one = trim($_POST['answerOne']);
    $question_two = trim($_POST['questionTwo']);
    $answer_two = trim($_POST['answerTwo']);
    $question_three = trim($_POST['questionThree']);
    $answer_three = trim($_POST['answerThree']);

    // echo "UserId: " . $username . "<br>";
    // echo "First name: " . $firstname . "<br>";
    // echo "Last name: " . $lastname . "<br>";
    // echo "Password: " . $password . "<br>";
    // echo "Email: " . $email . "<br>";
    // echo "Regist time: " . $regtime . "<br>";
    // echo "Question1: " . $question_one . "<br>";
    // echo "Answer1: " . $answer_one . "<br>";
    // echo "Question2: " . $question_two . "<br>";
    // echo "Answer2: " . $answer_two . "<br>";
    // echo "Question3: " . $question_three . "<br>";
    // echo "Answer3: " . $answer_three . "<br>";

    $sql = "insert into `t_user` (`username`,`password`,`email`,`regtime`, `firstname`, `lastname`, `birthdate`, `secure_question_1`, `secure_question_1_answer`, `secure_question_2`, `secure_question_2_answer`,`secure_question_3`, `secure_question_3_answer`)  
    values ('$username','$password','$email','$regtime', '$firstname', '$lastname', '$birthdate', '$question_one', '$answer_one', '$question_two', '$answer_two', '$question_three', '$answer_three')"; 

    $result = mysqli_query($conn, $sql);
    
    if($result) {
        // echo "Account create successfully!";
        /* free result set */
        // mysqli_free_result($result);
        mysqli_close($conn);
        header("Location: /index.html");
        exit;
    }
    /* free result set */
    mysqli_free_result($result);
    mysqli_close($conn);
?>
