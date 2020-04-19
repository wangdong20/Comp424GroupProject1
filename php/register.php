<?php
    include_once("connect.php");
    // Import PHPMailer classes into the global namespace
    // These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    // If necessary, modify the path in the require statement below to refer to the
    // location of your Composer autoload.php file.
    require '../vendor/autoload.php';

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

    $token = md5($username.$password.$regtime); //创建用于激活识别码 
    $token_exptime = time()+60*60*24;//过期时间为24小时后 
    $last_login_date = date("Y-m-d H:i:s");

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

    $sql = "insert into `t_user` (`username`,`password`,`email`, `token`, `token_exptime`, `last_login_date`, `regtime`, `firstname`, `lastname`, `birthdate`, `secure_question_1`, `secure_question_1_answer`, `secure_question_2`, `secure_question_2_answer`,`secure_question_3`, `secure_question_3_answer`)  
    values ('$username','$password','$email', '$token', '$token_exptime', '$last_login_date', '$regtime', '$firstname', '$lastname', '$birthdate', '$question_one', '$answer_one', '$question_two', '$answer_two', '$question_three', '$answer_three')"; 

    $result = mysqli_query($conn, $sql);
    
    if($result) {
        // echo "Account create successfully!";
        /* free result set */
        // mysqli_free_result($result);
        // Replace sender@example.com with your "From" address.
        // This address must be verified with Amazon SES.
        $sender = 'dong.wang.174@my.csun.edu';
        $senderName = 'Dong Wang';

        // Replace recipient@example.com with a "To" address. If your account
        // is still in the sandbox, this address must be verified.
        $recipient = $email;

        // Replace smtp_username with your Amazon SES SMTP user name.
        $usernameSmtp = 'AKIA2Y2N5I2MTFPI765L';

        // Replace smtp_password with your Amazon SES SMTP password.
        $passwordSmtp = 'BB5/p0EW4snt1drlxk1Zb8TIBIpRVg1gbot/82xMZQt5';

        // Specify a configuration set. If you do not want to use a configuration
        // set, comment or remove the next line.
        // $configurationSet = 'ConfigSet';

        // If you're using Amazon SES in a region other than US West (Oregon),
        // replace email-smtp.us-west-2.amazonaws.com with the Amazon SES SMTP
        // endpoint in the appropriate region.
        $host = 'email-smtp.us-west-2.amazonaws.com';
        $port = 587;

        // The subject line of the email
        $subject = 'Account verification';

        // The plain-text body of the email
        $bodyText =  "HTML Emails not supported by your Client. Please forward with this link to verify your account: http://ec2-54-153-72-11.us-west-1.compute.amazonaws.com/php/active.php?verify=".$token."";

        // The HTML-formatted body of the email
        $bodyHtml = '<p>Hi, '.$username.' : <br/> Thanks for you register an account on this website. <br/> Please click this link to verify your account. <br/>
            <a href="http://ec2-54-153-72-11.us-west-1.compute.amazonaws.com/php/active.php?verify='.$token.'">
            http://ec2-54-153-72-11.us-west-1.compute.amazonaws.com/php/active.php?verify='.$token.'</a></p>';

        $mail = new PHPMailer(true);

        try {
            // Specify the SMTP settings.
            $mail->isSMTP();
            $mail->setFrom($sender, $senderName);
            $mail->Username   = $usernameSmtp;
            $mail->Password   = $passwordSmtp;
            $mail->Host       = $host;
            $mail->Port       = $port;
            $mail->SMTPAuth   = true;
            $mail->SMTPSecure = 'tls';
            $mail->addCustomHeader('X-SES-CONFIGURATION-SET', $configurationSet);

            // Specify the message recipients.
            $mail->addAddress($recipient);
            // You can also add CC, BCC, and additional To recipients here.

            // Specify the content of the message.
            $mail->isHTML(true);
            $mail->Subject    = $subject;
            $mail->Body       = $bodyHtml;
            $mail->AltBody    = $bodyText;
            $mail->Send();
            echo "Email sent!" , PHP_EOL;
        } catch (phpmailerException $e) {
            echo "An error occurred. {$e->errorMessage()}", PHP_EOL; //Catch errors from PHPMailer.
        } catch (Exception $e) {
            echo "Email not sent. {$mail->ErrorInfo}", PHP_EOL; //Catch errors from Amazon SES.
        }
        mysqli_close($conn);
        // header("Location: /index.html");
        exit;
    }
    /* free result set */
    mysqli_free_result($result);
    mysqli_close($conn);
?>
