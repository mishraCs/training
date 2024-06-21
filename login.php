<?php
 include 'header.php'; 
 include 'db.php';

  include_once "./google-login-in-php/libraries/vendor/autoload.php";
  $google_client = new Google_Client();
  $google_client->setClientId($client_id); //Define your ClientID
  $google_client->setClientSecret($client_secret); //Define your Client Secret Key
  $google_client->setRedirectUri('http://localhost/MyCode/CRUD/home.php'); //Define your Redirect Uri
  $google_client->addScope('email');
  $google_client->addScope('profile');
  

  echo "<a href='".$google_client->createAuthUrl()."'>Login with Google";

  ob_start();

    if(isset($_GET['email']) && isset($_GET['active'])){
        $active = $_GET['active'];
        $email = $_GET['email'];

        $sql = "SELECT * FROM users WHERE active = '$active' AND email = '$email'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            header('Location: dashboard.php');
            die('not reditrefsdfvf');
        }else{
            die('try again');
        }
    }
 ?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $otp = rand(111111, 666666);
    $sql = "UPDATE users SET active = '$otp' WHERE email = '$email'";
    $result1 = $conn->query($sql);

    $sql1 = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql1);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['user_password'])) {
            $_SESSION['user_id'] = $row['id'];
            include('./phpmailer_smtp/smtp/PHPMailerAutoload.php');
            $message =  "Please click on this url to sign in to you this your own webseit http://localhost/MyCode/CRUD/login.php?email=".$email."&active=".$otp;
            $to = $email;
            function smtp_mailer($to,$subject, $msg){
                $mail = new PHPMailer(); 
                $mail->IsSMTP(); 
                $mail->SMTPAuth = true; 
                $mail->SMTPSecure = 'tls'; 
                $mail->Host = "smtp.gmail.com";
                $mail->Port = 587; 
                $mail->IsHTML(true);
                $mail->CharSet = 'UTF-8';
                //$mail->SMTPDebug = 2; 
                $mail->Username = "aakashthink0096@gmail.com";
                $mail->Password = "zkvn fwqz hffn kleo";
                $mail->SetFrom("aakashthink0096@gmail.com");
                $mail->Subject = $subject;
                $mail->Body =$msg;
                $mail->AddAddress($to);
                $mail->SMTPOptions=array('ssl'=>array(
                    'verify_peer'=>false,
                    'verify_peer_name'=>false,
                    'allow_self_signed'=>false
                ));
                if(!$mail->Send()){
                    echo $mail->ErrorInfo;
                }else{
                    return 'Sent';
                }
            }
            echo smtp_mailer($email,'Subject',$message);

            die('check otp send on your registered email ');
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found with this email.";
    }
}
?>
<div class=" form_div col-md-4">
    <h2>Login Form</h2>
    <form class="form-group" method="post">
        <label for="email">Email:</label>
        <input class="form-control" type="email" id="email" name="email" required><br>
        <label for="password">Password:</label>
        <input class="form-control" type="password" id="password" name="password" required><br>
        <button class="btn btn-primary" type="submit">Login</button>
    </form>
</div>
<?php include 'footer.php';?>
