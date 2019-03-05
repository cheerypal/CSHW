<?php
/**
 * Created by PhpStorm.
 * User: euang
 * Date: 11/02/2019
 * Time: 21:15
 */

$email = $_POST['email'];
$pass = $_POST['password'];
include_once('configureDataBase.php');

session_start();

if(!empty($_POST)){
    if(isset($email) && isset($password)) {
        $stmt = $con->prepare("SELECT * FROM Users WHERE email=?;");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_object();
        if (password_verify($pass, $user->password)) {
            $_SESSION['user_id'] = $user->username;
            header("Location: http://www2.macs.hw.ac.uk/~ejg9/CSHW/");
        } else {
            header("Location: http://www2.macs.hw.ac.uk/~ejg9/CSHW/Login");
        }
    }
}
$con->close();