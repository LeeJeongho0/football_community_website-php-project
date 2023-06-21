<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>PHP 프로그래밍 입문</title>
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/project/css/common.css' ?>">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/php_source/project/board/css/board.css?v=<?= date('Ymdhis') ?>">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/project/css/slide.css?er=1' ?>">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/project/css/header.css' ?>">
  <script src="http://<?= $_SERVER['HTTP_HOST'] ?>/php_source/project/board/js/board.js?v=<?= date('Ymdhis') ?>"></script>
  <script src="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/project/js/slide.js' ?>" defer></script>
  <script src="https://kit.fontawesome.com/6a4aeaf8e1.js" crossorigin="anonymous"></script>
</head>

<body>
  <header>
    <?php
    include $_SERVER['DOCUMENT_ROOT'] . "/php_source/project/common/header.php";
    // include $_SERVER['DOCUMENT_ROOT'] . "/php_source/project/common/slide.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/php_source/project/common/db_connect.php";
    include $_SERVER['DOCUMENT_ROOT'] . "/php_source/project/common/create_table.php";
    create_table($conn, "board");
    ?>
  </header>
  <section>
    <div id="board_box">
      <h3 id="board_title">
        게시판 > 글 쓰기
      </h3>
      <form name="board_form" method="post" action="board_insert.php" enctype="multipart/form-data">
        <ul id="board_form">
          <li>
            <span class="col1">작성자 : </span>
            <span class="col2"><?= $_SESSION["username"] ?></span>
          </li>
          <li>
            <span class="col1">제목 : </span>
            <span class="col2"><input name="subject" type="text"></span>
          </li>
          <li id="text_area">
            <span class="col1">내용 : </span>
            <span class="col2">
              <textarea name="content"></textarea>
            </span>
          </li>
          <li>
            <span class="col1"> 첨부 파일</span>
            <span class="col2"><input type="file" name="upfile"></span>
          </li>
        </ul>
        <ul class="buttons">
          <li><button type="button" id="complete">완료</button></li>
          <li><button type="button" onclick="location.href='board_list.php'">목록</button></li>
        </ul>
      </form>
    </div>
  </section>
  <footer>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/php_source/project/common/footer.php"; ?>
  </footer>
</body>

</html>