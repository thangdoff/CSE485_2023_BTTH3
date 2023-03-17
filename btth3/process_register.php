<?php
include("Util/MyEmailServer.php");
require_once("DBConnection.php");


if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM users WHERE user_email = '$email'";
    $result = mysqli_query($conn, $sql);
   

        if (mysqli_num_rows($result) > 0) {
            echo "tài khoản đã tồn tài";
        } else {
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $code_hash = "12344";
            $sql_res = "INSERT INTO users(user_email, user_pass, user_hash) VALUES ('$email','$password','$code_hash');";
            if (mysqli_query($conn, $sql_res)) {
                require_once 'vendor/autoload.php';
                require_once 'Util/MyEmailServer.php';
                require_once 'Util/EmailSender.php';

                $emailServer = new MyEmailServer();
                $emailSender = new EmailSender($emailServer);
                $emailSender->send($email, "Activation", "http://localhost/BTTH3/activate.php?email=".$email."&hash=".$code_hash);

            } else {
                echo "lỗi";
            }
        }
    }
?>