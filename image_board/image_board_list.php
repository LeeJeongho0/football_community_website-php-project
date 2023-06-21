<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>이미지 게시판</title>
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/project/css/common.css' ?>">
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/php_source/project/board/css/board.css?v=<?= date('Ymdhis') ?>">
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/php_source/project/css/slide.css?v=<?= date('Ymdhis') ?>">
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/php_source/project/image_board/css/board.css?v=<?= date('Ymdhis') ?>">
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/project/css/header.css' ?>">
    <!-- board_excel 자바스크립트 -->
    <script src="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/project/board/js/board_excel.js' ?>" defer></script>
    <script src="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/project/js/slide.js' ?>" defer></script>
    <!-- 부트스트랩 script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <!-- 부트스트랩 CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/93edb85122.js" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <?php
        include $_SERVER['DOCUMENT_ROOT'] . "/php_source/project/common/header.php";
        // include $_SERVER['DOCUMENT_ROOT'] . "/php_source/project/common/slide.php";
        include $_SERVER['DOCUMENT_ROOT'] . "/php_source/project/common/page_lib.php";
        include_once $_SERVER['DOCUMENT_ROOT'] . "/php_source/project/common/db_connect.php";
        include $_SERVER['DOCUMENT_ROOT'] . "/php_source/project/common/create_table.php";
        create_table($conn, "image_board");
        create_table($conn, "image_board_ripple");

        ?>
    </header>
    <section>
        <div id="board_box">
            <h3>
                이미지 게시판 > 목록보기
            </h3>
            <ul id="board_list">
                <?php
                include_once $_SERVER['DOCUMENT_ROOT'] . "/php_source/project/common/db_connect.php";
                $page = (isset($_GET["page"]) && $_GET["page"] != '' && is_numeric($_GET["page"])) ? $_GET["page"] : 1;

                $sql = "select count(*) as cnt from image_board order by num desc";
                $stmt = $conn->prepare($sql);
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $result = $stmt->execute();
                $row = $stmt->fetch();
                $total_record = $row['cnt'];
                $scale = 10;             // 전체 페이지 수($total_page) 계산

                $start = ($page - 1) * $scale;

                $number = $total_record - $start;
                $sql2 = "select * from image_board order by num desc limit {$start}, {$scale}";
                $stmt2 = $conn->prepare($sql2);
                $stmt2->setFetchMode(PDO::FETCH_ASSOC);
                $result2 = $stmt2->execute();
                $rowArray = $stmt2->fetchAll();


                foreach ($rowArray as $row) {
                    $num = $row["num"];
                    $id = $row["id"];
                    $name = $row["name"];
                    $subject = $row["subject"];
                    $regist_day = $row["regist_day"];
                    $hit = $row["hit"];
                    $file_name_0 = $row['file_name'];
                    $file_copied_0 = $row['file_copied'];
                    $file_type_0 = $row['file_type'];
                    $image_width = 300;
                    $image_height = 200;

                ?>
                    <li>
                        <span>
                            <a href="image_board_view.php?num=<?= $num ?>&page=<?= $page ?>">
                                <?php
                                if (strpos($file_type_0, "image") !== false) {
                                    echo "<img src='./data/$file_copied_0' width='$image_width' height='$image_height'><br>";
                                } else {
                                    echo "<img src='./img/user.jpg' width='$image_width' height='$image_height'><br>";
                                }
                                ?>
                                <?= $subject ?></a><br>
                            <?= $name ?><br>
                            <?= $regist_day ?>
                        </span>
                    </li>
                <?php
                }
                $number--;
                ?>
            </ul>

            <div class="container d-flex justify-content-center align-items-start gap-2 mb-3">
                <?php
                $page_limit = 5;
                echo pagination($total_record, $scale, $page_limit, $page);
                ?>
            </div>

            <ul class="buttons">
                <li>
                    <button onclick="location.href='image_board_list.php'" class="btn btn-secondary">목록</button>
                </li>
                <li>
                    <?php
                    if ($userid) {
                    ?>
                        <button onclick="location.href='image_board_form.php'" class="btn btn-secondary">글쓰기</button>
                    <?php
                    }
                    ?>
                </li>
            </ul>
        </div> <!-- board_box -->
    </section>
    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/php_source/project/common/footer.php"; ?>
    </footer>
</body>

</html>