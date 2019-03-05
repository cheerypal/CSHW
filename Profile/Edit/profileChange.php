<?php
/**
 * Created by PhpStorm.
 * User: euang
 * Date: 22/02/2019
 * Time: 23:27
 */
require_once ('configureDataBase.php');
$profile = $_POST['p'];
$username = $_POST['username'];
$stmt = $con->prepare("UPDATE Users SET pic = ? WHERE username = ?");
$stmt->bind_param("ss", $profile, $username);
$stmt->execute();