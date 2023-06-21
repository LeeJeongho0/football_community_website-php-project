<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/php_source/project/common/db_connect.php";

//1. 현재페이지 요청을 받는다.
$page = (isset($_GET['page']) && $_GET['page'] != '' && is_numeric($_GET['page'])) ? $_GET['page'] : 1;
//2. 전체게시물 조회 쿼리 : select count(*) as count from message;
$sql = "select count(*) as cnt from members";
$stmt = $conn->prepare($sql);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$row = $stmt->fetch();
$total = $row['cnt'];
//3. 화면에 보여줄 개수
$limit = 10;
//4. 데이터베이스 테이블로부터 전체 내용을 가져온다.(만약 1page : 0, 5 :: 2page : 5, 5 :: 3page 10, 5)가져온다.
$start = ($page - 1) * $limit;
$sql = "select * from members order by num limit {$start},{$limit}";
$stmt = $conn->prepare($sql);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$rows = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="ko">

<head>
  <meta charset="utf-8">
  <title>회원리스트</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- 회원가입폼 스크립트 -->
  <script src="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/project/member/js/member.js' ?>"></script>
  <!-- member_list_to_excel.php 스크립트 -->
  <script src="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/project/member/js/member_excel.js' ?>"></script>
  <!-- 부트스트랩 CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <!-- 부트스트랩 JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <!-- 공통, 슬라이드, 해더 스타일 -->
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/project/css/common.css' ?>">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/project/css/slide.css?er=1' ?>">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/project/css/header.css' ?>">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/php_source/project/member/css/member.css?v=<?= date('Ymdhis') ?>">
  <!-- 구글폰트 -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+KR:wght@200&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/93edb85122.js" crossorigin="anonymous"></script>
</head>

<body>
  <header>
    <?php
    include $_SERVER['DOCUMENT_ROOT'] . "/php_source/project/common/header.php";
    include $_SERVER['DOCUMENT_ROOT'] . "/php_source/project/common/page_lib.php";
    ?>
  </header>
  <div class="container w-80" style="height: 660px;">
    <!-- 테이블시작 -->
    <h3 class="text-center  mt-5">회원리스트</h3>
    <table class="table table-hover mb-5">
      <thead>
        <tr>
          <th scope="col">NUM</th>
          <th scope="col">ID</th>
          <th scope="col">NAME</th>
          <th scope="col">EMAIL</th>
          <th scope="col">ZIPCODE</th>
          <th scope="col">ADDRESS1</th>
          <th scope="col">ADDRESS2</th>
          <th scope="col">DATE</th>
          <th scope="col">LEVEL</th>
          <th scope="col">POINT</th>
          <th scope="col">삭제</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($rows as $row) {
          print "
            <tr>
              <th scope='row'>{$row['num']}</th>
              <td>{$row['id']}</td>
              <td>{$row['name']}</td>
              <td>{$row['email']}</td>
              <td>{$row['zipcode']}</td>
              <td>{$row['addr1']}</td>
              <td>{$row['addr2']}</td>
              <td>{$row['regist_day']}</td>
              <td>{$row['level']}</td>
              <td>{$row['point']}</td>
              <td><button type ='button'
               onclick='location.href=\"http://{$_SERVER['HTTP_HOST']}/php_source/project/member/member_delete.php?id={$row['id']}\"'>삭제</button></td>
            </tr>";
        }
        ?>
      </tbody>
    </table>
    <!-- 테이블종료 -->
    <div class="container d-flex justify-content-center align-items-start gap-2 mb-3">
      <?php
      $page_limit = 5;
      echo pagination($total, $limit, $page_limit, $page)
      ?>
      <button type="button" class="btn btn-outline-primary" id="btn_excel">엑셀로 저장</button>
    </div>
  </div>
  <footer>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/php_source/project/common/footer.php"; ?>
  </footer>
</body>

</html>