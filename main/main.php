<section style="height:calc(100vh - 350px);">
  <div id="main_content">
    <div id="announce">
      <h4>&nbsp;공지사항</h4>
      <?php
      if (!isset($conn)) {
        include $_SERVER['DOCUMENT_ROOT'] . "/php_source/project/common/db_connect.php";
      }
      $sql = "SELECT * FROM notice  ORDER BY num DESC LIMIT 5";
      $stmt = $conn->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

      if (empty($result)) {
        echo "아직 공지사항이 없습니다.";
      } else {
        foreach ($result as $row) {
      ?>
          <ul>
            <li>
              <span><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/php_source/project/notice/notice_view.php?num=<?= $row['num'] ?>"><?= $row["subject"] ?></a></span>
              <span><?= substr($row["regist_day"], 0, 10) ?></span>
            </li>
          </ul>
      <?php
        }
      }
      ?>
    </div>
    <div id="announce">
      <h4>&nbsp;게시판</h4>
      <?php
      if (!isset($conn)) {
        include $_SERVER['DOCUMENT_ROOT'] . "/php_source/project/common/db_connect.php";
      }
      $sql = "SELECT * FROM board  ORDER BY num DESC LIMIT 5";
      $stmt = $conn->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

      if (empty($result)) {
        echo "아직 게시글이 없습니다.";
      } else {
        foreach ($result as $row) {
      ?>
          <ul>
            <li>
              <span><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/php_source/project/board/board_view.php?num=<?= $row['num'] ?>"><?= $row["subject"] ?></a></span>
              <span><?= substr($row["regist_day"], 0, 10) ?></span>
            </li>
          </ul>
      <?php
        }
      }
      ?>
    </div>



    <!-- <div id="digital">
      <h4>&nbsp;제이풋볼JFootball</h4>
      <iframe width="560" height="309" src="https://www.youtube.com/embed/Nodxm-ztO7E" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
    </div>
  </div> -->

</section>