<?php
define("ROOT", $_SERVER["DOCUMENT_ROOT"]."/todolist/src/");
// define("FILE_HEADER", ROOT."header.php");
require_once(ROOT."lib/lib_db.php");

$id = "";
$conn = null; // DB Connect


try {
    // id 확인
    if(!isset($_GET["id"]) || $_GET["id"] === "") {
        throw new Exception("Parameter ERROR : No id"); // 강제 예외 발생 :
    }
    $id = $_GET["id"]; // id 셋팅

    // DB 연결
    if(!todolist_db_conn($conn)) {
        // DB Instance 에러
        throw new Exception("DB Error : PDO Instance");
    }


    // 게시글 데이터 조회
    $arr_param = [
        "id" => $id
    ];    
   $result = todolist_db_select_boards_id($conn, $arr_param); 

   // 게시글 조회 예외처리
   if($result === false ) {
        // 게시글 조회 에러
        throw new Exception("DB Error : PDO Select_id");
   } else if(!(count($result) === 1)) {
    // 게시글 조회 count 에러
    throw new Exception("DB Error : PDO Select_id count, ".count($result));
   }
        
   $item = $result[0];
} catch(Exception $e) {
    echo $e->getMessage();
    exit;
} finally {
   todolist_db_destroy_conn($conn); // DB 파기
}

$page = $_GET["page"];


?>

<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>상세 페이지</title>
	<link rel="stylesheet" href="/todolist/doc/design/css/common.css"> 
</head>
<body>
	<div class="top_container">

	</div>
	<div class="main_container">
		<div class="main_container_box">
			<div class="left_box">
				<div class="box_layout">
					<div class="say">명언</div>
					<div class="calender">
					</div>
					<div class="detail_img">
					</div>
					<div class="chklist">
					</div>	
				</div>
			</div>
				
			<div class="right_box">
				<div class="box_layout">
					<div class="align_center date">
						<img class="detail_emo" src="/todolist/doc/img/emotion_2.png">
						<p class="align_center_date">2023년 10월 16일<br>
							금요일
						</p>
						<!-- php 데이터 연동 -->
					</div>
					<br>
					<form class="align_center" action="" method="post">						
						<label for="title"></label>
						<input type="text" class ="textarea_1" name="title" id="title" maxlength="20" value="test제목1">
						<br><br>
						<label for="content"></label>
						<textarea class ="textarea_2" name="content" id="content" cols="25" rows="10"></textarea>
					</form>
				</div>
			</div>

			<div class="side_box">
				<div class="side_category bgc_cate1">
					<a class= "side_text" href="/todolist/doc/design/01_list.html">목록</a>
				</div>
				<div class="side_category bgc_cate2">
					<a class= "side_text" href="/todolist/doc/design/04_update.html">수정</a>
				</div>
				<div class="side_category bgc_cate3">
					<a class= "side_text" href="/todolist/doc/design/05_delete.html">삭제</a>
				</div>
			</div>
		</div>
	</div>
</body>
</html>