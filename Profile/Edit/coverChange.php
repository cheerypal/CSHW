<?php
/**
 * Created by PhpStorm.
 * User: euang
 * Date: 22/02/2019
 * Time: 23:48
 */
require_once ('configureDataBase.php');
$cover = $_POST['C'];
$username = $_POST['username'];
$stmt = $con->prepare("UPDATE Users SET backgroundPic = ? WHERE username = ?");
$stmt->bind_param("ss", $cover, $username);
$stmt->execute();