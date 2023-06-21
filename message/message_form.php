<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>쪽지 보내기</title>
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/project/css/common.css' ?>">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/project/message/css/message.css' ?>">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/php_source/project/css/slide.css?v=<?= date('Ymdhis') ?>">
  <script src="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/project/js/slide.js' ?>"></script>
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/project/css/header.css' ?>">
  <script src="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/project/message/js/message.js' ?>"></script>
  <script src="https://kit.fontawesome.com/6a4aeaf8e1.js" crossorigin="anonymous"></script>
</head>

<body>
  <header>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/php_source/project/common/header.php";
    // include $_SERVER['DOCUMENT_ROOT'] . "/php_source/project/common/slide.php";
    include $_SERVER['DOCUMENT_ROOT'] . "/php_source/project/common/create_table.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/php_source/project/common/db_connect.php";
    create_table($conn, "message");
    ?>
  </header>
  <?php
  if ($userid == "") {
    echo ("<script>
				alert('로그인 후 이용해주세요!');
				self.location.href = 'http://{$_SERVER['HTTP_HOST']}/php_source/project/login/login_form.php';
				</script>
			");
    exit;
  }
  ?>
  <section>
    <div id="message_box">
      <h3 id="write_title">
        쪽지 보내기
      </h3>
      <ul class="top_buttons">
        <li><span><a href="message_box.php?mode=rv">수신 쪽지함 </a></span></li>
        <li><span><a href="message_box.php?mode=send">송신 쪽지함</a></span></li>
      </ul>
      <form name="message_form" method="post" action="message_insert.php" autocomplete="off">
        <input type="hidden" name="send_id" value="<?= $userid ?>">
        <div id="write_msg">
          <ul>
            <li>
              <span class="col1">보내는 사람 : </span>
              <span class="col2"><?= $userid ?></span>
            </li>
            <li>
              <span class="col1">수신 아이디 : </span>
              <span class="col2"><input name="rv_id" type="text"></span>
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
          </ul>
          <button type="button" id="message_send">보내기</button>
        </div>
      </form>
    </div> <!-- message_box -->
  </section>
  <footer>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/php_source/project/common/footer.php"; ?>
  </footer>
</body>

</html>