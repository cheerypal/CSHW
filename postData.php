<?php
/**
 * Created by PhpStorm.
 * User: euang
 * Date: 13/02/2019
 * Time: 23:32
 */

require_once('configureDataBase.php');
$topic = $_POST['topic'];
$desc = $_POST['desc'];
$tags = $_POST['tags'];
$time = date("H:i:s");
$date = date('Y-m-d');
$username = $_POST['username'];

echo $tags;
$stmt = $con->prepare("INSERT INTO Posts(topic, description, timeOfPost, dateOfPost, username, tags) VALUES (?, ?, ?, ?, ?, ?) ");
$stmt->bind_param("ssssss", $topic, $desc, $time, $date, $username, $tags);
$stmt->execute();
