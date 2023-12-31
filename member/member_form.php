<!DOCTYPE html>
<html lang="ko">

<head>
  <meta charset="utf-8">
  <title>회원가입</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!--회원가입폼 스크립트 -->
  <script src="http://<?= $_SERVER['HTTP_HOST'] ?>/php_source/project/member/js/member.js?v=<?= date('Ymdhis') ?>" defer>
  </script>
  <!-- 다음 우편번호 검색 스크립트 -->
  <script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
  <!-- 공통, 슬라이드, 헤더 스타일 -->
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/project/css/common.css' ?>">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/project/css/slide.css?er=1' ?>">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/project/css/header.css' ?>">
  <!--회원가입폼 스타일  -->
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/project/member/css/member.css' ?>">
  <!-- 구글폰트 -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <script src="https://kit.fontawesome.com/6a4aeaf8e1.js" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+KR:wght@200&display=swap" rel="stylesheet">

</head>

<body>
  <header>
    <?php
    include $_SERVER['DOCUMENT_ROOT'] . "/php_source/project/common/header.php";
    include $_SERVER['DOCUMENT_ROOT'] . "/php_source/project/common/create_table.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/php_source/project/common/db_connect.php";
    create_table($conn, "members");
    ?>

  </header>
  <section style="height: calc(100vh - 200px);">
    <div id="main_content">
      <article id="latest">
      </article>
      <div id="main_content">
        <article id="latest">
          <ul></ul>
        </article>
        <section>
          <div id="main_img_bar">
          </div>
          <div id="main_content">
            <div id="join_box">
              <form name="member_form" method="post" action="./member_insert.php">
                <input type="hidden" name="id_check" value="0">
                <h2>회원 가입</h2>
                <div class="form id">
                  <div class="col1">아이디</div>
                  <div class="col2">
                    <input type="text" name="id" id="input_id">
                  </div>
                  <div class="col3">
                    <button type="button" onclick="check_id()">중복확인</button>
                  </div>
                </div>
                <div class="clear"></div>
                <div class="form">
                  <div class="col1">비밀번호</div>
                  <div class="col2">
                    <input id="input_pwd" type="password" name="pass" disabled>
                  </div>
                </div>
                <div class="clear"></div>
                <div class="form">
                  <div class="col1">비밀번호 확인</div>
                  <div class="col2">
                    <input id="input_chkpwd" type="password" name="pass_confirm" disabled>
                  </div>
                </div>
                <div class="clear"></div>
                <div class="form">
                  <div class="col1">이름</div>
                  <div class="col2">
                    <input type="text" name="name">
                  </div>
                </div>
                <div class="clear"></div>
                <div class="form email">
                  <input type="hidden" name="email_check" value="0">
                  <div class="col1">이메일</div>
                  <div class="col2">
                    <input type="text" name="email1" id="input_email1">@
                    <select name="email2" id="select_email2">
                      <option value="">-선택하세요-</option>
                      <option value="naver.com">naver.com</option>
                      <option value="google.com">google.com</option>
                      <option value="daum.net">daum.net</option>
                    </select>
                  </div>
                  <div class="col3">
                    <button type="button" onclick="check_email()">중복확인</button>
                  </div>
                </div>
                <div class="clear"></div>
                <div class="form">
                  <div class="col1">우편번호</div>
                  <div class="col2">
                    <input type="text" name="zipcode" id="f_zipcode">
                  </div>
                  <div class="col3">
                    <button type="button" id="btn_zipcode">우편번호찾기</button>
                  </div>
                </div>
                <div class="clear"></div>
                <div class="form">
                  <div class="col1">주소</div>
                  <div class="col2">
                    <input type="text" name="addr1" id="f_addr1">
                  </div>
                </div>
                <div class="clear"></div>
                <div class="form">
                  <div class="col1">상세주소</div>
                  <div class="col2">
                    <input type="text" name="addr2" id="f_addr2" placeholder="상세주소를 입력">
                  </div>
                </div>
                <div class="buttons">
                  <input type="button" value="전송" id="send">
                  <input type="reset" value="취소" id="cancel">
                </div>
                <br>
                <hr>
              </form>
            </div> <!-- join_box -->
          </div> <!-- main_content -->
        </section>
      </div>
    </div>
  </section>
  <footer>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/php_source/project/common/footer.php"; ?>
  </footer>

</body>

</html>