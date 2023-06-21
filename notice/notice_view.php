<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>공지사항</title>
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/project/css/common.css' ?>">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/php_source/project/notice/css/notice.css?v=<?= date('Ymdhis') ?>">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/project/css/header.css' ?>">
  <script src="https://kit.fontawesome.com/93edb85122.js" crossorigin="anonymous"></script>
</head>

<body>
  <header>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/php_source/project/common/header.php"; ?>
  </header>
  <section>
    <div id="notice_box">
      <h3 class="title">
        공지사항 > 내용보기
      </h3>
      <?php
      $num = (isset($_GET["num"]) && $_GET["num"] != '') ? $_GET["num"] : '';
      $page = (isset($_GET["page"]) && $_GET["page"] != '') ? $_GET["page"] : 1;

      if ($num == "") {
        die("
	        <script>
          alert('저장되는 정보가 없습니다.,');
          history.go(-1)
          </script>           
          ");
      }

      include_once $_SERVER['DOCUMENT_ROOT'] . "/php_source/project/common/db_connect.php";


      $sql = "select * from notice where num=:num";

      $stmt = $conn->prepare($sql);
      $stmt->setFetchMode(PDO::FETCH_ASSOC);
      $stmt->bindParam(':num', $num);
      $stmt->execute();
      $row = $stmt->fetch();

      $id      = $row["id"];
      $name      = $row["name"];
      $regist_day = $row["regist_day"];
      $subject    = $row["subject"];
      $content    = $row["content"];
      $file_name    = $row["file_name"];
      $file_type    = $row["file_type"];
      $file_copied  = $row["file_copied"];
      $hit          = $row["hit"];

      $content = str_replace(" ", "&nbsp;", $content);
      $content = str_replace("\n", "<br>", $content);

      $new_hit = $hit + 1;


      $sql2 = "update notice set hit=:new_hit where num=:num";
      $stmt2 = $conn->prepare($sql2);
      $stmt2->setFetchMode(PDO::FETCH_ASSOC);
      $stmt2->bindParam(':new_hit', $new_hit);
      $stmt2->bindParam(':num', $num);
      $stmt2->execute();
      ?>
      <ul id="view_content">
        <li>
          <span class="col1"><b>제목 :</b> <?= $subject ?></span>
          <span class="col2"><?= $name ?> | <?= $regist_day ?></span>
        </li>
        <li>
          <?php
          if ($file_name) {
            $real_name = $file_copied;
            $file_path = "./data/" . $real_name;
            $file_size = filesize($file_path);

            echo "▷ 첨부파일 : $file_name ($file_size Byte) &nbsp;&nbsp;&nbsp;&nbsp;
			       		<a href='notice_download.php?num=$num&real_name=$real_name&file_name=$file_name&file_type=$file_type'>[저장]</a><br><br>";
          }
          ?>
          <?= $content ?>
        </li>
      </ul>
      <ul class="buttons">
        <li><button onclick="location.href='notice_list.php?page=<?= $page ?>'">목록</button></li>
        <?php
        if (isset($_SESSION['userlevel'])) {
          if ($_SESSION['userlevel'] == 1) {
        ?>
            <li><button onclick="location.href='notice_modify_form.php?num=<?= $num ?>&page=<?= $page ?>'">수정</button></li>
            <li><button onclick="location.href='notice_delete.php?num=<?= $num ?>&page=<?= $page ?>'">삭제</button></li>
            <li><button onclick="location.href='notice_form.php'">글쓰기</button></li>
        <?php
          }
        }
        ?>

      </ul>
    </div> <!-- notice_box -->
  </section>
  <footer>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/php_source/project/common/footer.php"; ?>
  </footer>
</body>

</html>