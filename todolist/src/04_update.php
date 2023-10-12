<?php
define("ROOT", $_SERVER["DOCUMENT_ROOT"]."/todolist/src/"); // 웹서버 root 패스 생성
define("ERROR_MSG_PARAM", "⛔ %s을 입력해 주세요."); //파라미터 에러 메세지
require_once(ROOT."lib/lib_db.php");// DB관련 라이브러리

$conn = null; // DB 연결용 변수
$http_method = $_SERVER["REQUEST_METHOD"]; // Method 확인
$arr_err_msg = []; // 에러 메세지 저장용
$title = "";
$content = "";

?>

<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>수정 페이지</title>
	<link rel="stylesheet" href="/todolist/src/css/common.css">	
</head>
<body>
	<div class="top_container">
	</div>
	<form action="" method="post">
        <div class="main_container">
            <div class="main_container_box">
                <div class="left_box">
                    <div class="box_layout">
                        <div class="post_it">
							<div class="emotion_ma1">
								<div class="emotion_lay1">
									<label class="emotion_each" for="emotion1">
									<input type="radio" name="emotion" id="emotion1" value="1">
									<img class="emotions" src="/todolist/doc/img/emotion_1.png">
									</label>
								</div>
								<div class="emotion_lay1">
									<label class="emotion_each" for="emotion2">
									<input type="radio" name="emotion" id="emotion2" value="2">
									<img class="emotions" src="/todolist/doc/img/emotion_2.png">
									</label>
								</div>
								<div class="emotion_lay1">
									<label class="emotion_each" for="emotion3">
									<input type="radio" name="emotion" id="emotion3" value="3">
									<img class="emotions" src="/todolist/doc/img/emotion_3.png">
									</label>
								</div>
							</div>
							<div class="emotion_ma2">
								<div class="emotion_lay2">
									<label class="emotion_each" for="emotion4">
									<input type="radio" name="emotion" id="emotion4" value="4">
									<img class="emotions" src="/todolist/doc/img/emotion_4.png">
									</label>
								</div>
								<div class="emotion_lay2">
									<label class="emotion_each" for="emotion5">
									<input type="radio" name="emotion" id="emotion5" value="5">
									<img class="emotions" src="/todolist/doc/img/emotion_5.png">
									</label>
								</div>
								<div class="emotion_lay2">
									<label class="emotion_each" for="emotion6">
									<input type="radio" name="emotion" id="emotion6" value="6">
									<img class="emotions" src="/todolist/doc/img/emotion_6.png">
									</label>
								</div>
							</div>
							<div class="emotion_ma3">
								<div class="emotion_lay3">
									<label class="emotion_each" for="emotion7">
									<input type="radio" name="emotion" id="emotion7" value="7">
									<img class="emotions" src="/todolist/doc/img/emotion_7.png">
									</label>
								</div>
								<div class="emotion_lay3">
									<label class="emotion_each" for="emotion8">
									<input type="radio" name="emotion" id="emotion8" value="8">
									<img class="emotions" src="/todolist/doc/img/emotion_8.png">
									</label>
								</div>
							</div>
						<!-- <div class="emotions">
								<div>
									<input type="image" class="emotion_each" name="emotion_each" src="../img/emotion_1.png">
									<input type="image" class="emotion_each" name="emotion_each" src="../img/emotion_2.png">
									<input type="image" class="emotion_each" name="emotion_each" src="../img/emotion_3.png">
								</div>
								<div>
									<input type="image" class="emotion_each" name="emotion_each" src="../img/emotion_4.png">
									<input type="image" class="emotion_each" name="emotion_each" src="../img/emotion_5.png">
									<input type="image" class="emotion_each" name="emotion_each" src="../img/emotion_6.png">
								</div>
								<div>
									<input type="image" class="emotion_each" name="emotion_each" src="../img/emotion_7.png">
									<input type="image" class="emotion_each" name="emotion_each" src="../img/emotion_8.png">
								</div>
							</div> -->
                        </div>
                        <div class="align_center">
                                <p class="align_center_txt">감정을 수정해 주세요 !</p>
                        </div>
                    </div>
                </div>
                <div class="right_box">
                    <div class="box_layout">
                        <div class="align_center date">
                            <img class="flower_y" src="/todolist/doc/img/flower_yellow.png">
                            <p class="align_center_date">2023년 10월 20일<br>
                                금요일
                            </p>
                            <!-- php 데이터 연동 -->
                        </div>
                        <br>
                        <!-- <form class="align_center" action="" method="post"> -->
                        <div class="align_center">
                            <label for="title"></label>
                            <input type="text" class = 'text_tit' name="title" id="title" value="<?php echo $title; ?>"
                            maxlength="20">
                            <!-- value="title" id 뒤에 설정하기 -->
                            <br><br>
                            <label for="content"></label>
                            <textarea class = 'text_con' name="content" id="content" cols="25" rows="10"><?php echo $content; ?></textarea>
                        </div>	
                    </div>
                </div>
                <div class="side_box">
                    <div class="side_category bgc_cate1">
						<!-- 수정 버튼 클릭 시 수정
                             post > update.php
                            게시글의 id를 이용해서 update -->
                        <button class= "side_text button_text" href="/todolist/src/04_update.php">수정</button>
                    </div>
                    <div class="side_category bgc_cate3">
						<!-- 취소 버튼 클릭 시 디테일 페이지로 이동 -->
                        <a class= "side_text" href="/todolist/src/02_detail.php">취소</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>
</html>