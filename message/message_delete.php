<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/php_source/project/common/db_connect.php";

$num = (isset($_GET['num']) && $_GET['num'] != '') ? $_GET['num'] : '';
$mode = (isset($_GET['mode']) && $_GET['mode'] != '') ? $_GET['mode'] : '';

$sql = "delete from message where num=:num";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':num', $num);
$result = $stmt->execute();
// $result =  mysqli_query($conn, $sql);

if (!$result) {
  // echo ("<h2 style='text-align: center'>메시지 삭제 쿼리문 오류: {mysqli_error($conn)}</h2>");
  die("<script>
  alert('메시지 삭제 오류');
      history.go(-1);
    </script>");
}

if ($mode == "send") {
  $url = "http://{$_SERVER['HTTP_HOST']}/php_source/project/message/message_box.php?mode=send";
} else {
  $url = "http://{$_SERVER['HTTP_HOST']}/php_source/project/message/message_box.php?mode=rv";
}

// mysqli_close($conn);

echo "
<script>
  location.href = '$url';
</script>
";
