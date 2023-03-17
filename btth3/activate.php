<?php
require 'vendor/autoload.php';
require_once("DBConnection.php");

$email = $_GET['email'];
$hash = $_GET['hash'];

$sql = "SELECT user_email, user_hash FROM users ";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);


if ($row['user_email'] = $email && $row['user_hash'] = $hash) {

    $sql_act = "UPDATE users SET user_act = 1 WHERE user_email = '$email' ";
    $result2 = mysqli_query($conn, $sql_act);
    if($result2){
        echo "activate thành công";
    }else{
        echo "lỗi";
    }
}

?>