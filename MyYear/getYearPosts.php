<?php
/**
 * Created by PhpStorm.
 * User: euang
 * Date: 15/02/2019
 * Time: 22:01
 */

require_once('configureDataBase.php');
$yearNo = $_POST['yearNo'];
$sth = mysqli_query($con,"SELECT * FROM PostsYear WHERE years = $yearNo");
$rows = array();
while($r = mysqli_fetch_assoc($sth)) {
    $rows[] = $r;
}
echo json_encode($rows);
$sth->close();
$con->close();