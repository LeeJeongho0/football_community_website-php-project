<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/php_source/project/common/db_connect.php";

$id = (isset($_GET["id"]) &&  $_GET["id"] != '') ? $_GET["id"] : '';

$sql = "delete from members where id =:id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();

$sql = "delete from image_board where id =:id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();

$sql = "delete from image_board_ripple where id =:id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();

$sql = "delete from message where send_id =:id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();

$sql = "delete from message where rv_id =:id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();

$sql = "delete from notice where id =:id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();

$sql = "delete from board where id =:id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();



echo "
  <script>
    self.location.href = 'http://{$_SERVER['HTTP_HOST']}/php_source/project/member/member_list.php'
  </script>
";
