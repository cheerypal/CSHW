<?php
/**
 * Created by PhpStorm.
 * User: euang
 * Date: 22/02/2019
 * Time: 22:38
 */
$username = $_POST['username'];
$original = $_POST['password'];
$new = $_POST['cPassword'];

require_once ('configureDataBase.php');
$stmt = $con->prepare("SELECT * FROM Users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_object();
if(password_verify($original, $user->password)){
    $encrypted = password_hash($new, PASSWORD_DEFAULT);
    $stmt2 = $con->prepare("UPDATE Users SET password = ? WHERE username = ?");
    $stmt2->bind_param("ss", $encrypted, $username);
    $stmt2->execute();
}else{
    header("Location: http://www2.macs.hw.ac.uk/~ejg9/notfinished/edit.php");
}


