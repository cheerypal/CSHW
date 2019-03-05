<?php
require_once ('configureDataBase.php');
$search = "%{$_POST['searchText']}%";

$stmt = $con->prepare("SELECT * FROM PostsYear WHERE topic LIKE  ? ");
$stmt->bind_param("s", $search);
$stmt->execute();
$result = $stmt->get_result();
$rows = array();
while($r = mysqli_fetch_array($result)){
    $rows[] = $r;
}
echo json_encode($rows);

