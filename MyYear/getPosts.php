<?php
/**
 * Created by PhpStorm.
 * User: euang
 * Date: 14/02/2019
 * Time: 20:55
 */
require_once('configureDataBase.php');
$sth = mysqli_query($con,"SELECT * FROM recentPosts");
$rows = array();
while($r = mysqli_fetch_assoc($sth)) {
    $rows[] = $r;
}
echo json_encode($rows);
$sth->close();
$con->close();