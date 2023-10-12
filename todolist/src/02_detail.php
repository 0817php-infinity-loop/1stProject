<?php
		define("ROOT", $_SERVER["DOCUMENT_ROOT"]."/todolist/src/");
		define("IMG", "/todolist/doc/img/");
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
			if(!db_conn($conn)) {
				// DB Instance 에러
				throw new Exception("DB Error : PDO Instance");
			}
			    // 게시글 데이터 조회
				$arr_param = [
					"id" => $id
				];    
			   $result = db_select_boards_id($conn, $arr_param); 
			
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
			   db_destroy_conn($conn); // DB 파기
			}
			
			// $page = $_GET["page"];
?>


<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>상세 페이지</title>
	<link rel="stylesheet" href="/todolist/src/css/common.css"> 
</head>
<body>
	<div class="top_container">
	</div>
	<form class="align_center" action="/todolist/src/05_delete.php" method="post">
		<div class="main_container">
			<div class="main_container_box">
				<div class="left_box">
					<div class="box_layout">
						<div class="say">명언 위치</div>
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
						<table class ="detail_table">
							<tr>
								<td class ="detail_textarea_1">
									<span><?php echo $item["title"] ?></span>
								</td>
							</tr>
							<tr>
								<td class ="detail_textarea_2">
									<span><?php echo $item["content"] ?></span>
								</td>
							</tr>
						</table>
					</div>
				</div>

				<div class="side_box">
					<div class="side_category bgc_cate1">
						<a class= "side_text" href="/todolist/src/01_list.php">목록</a>
					</div>
					<div class="side_category bgc_cate2">
						<a class= "side_text" href="/todolist/src/04_update.php">수정</a>
					</div>
					<div class="side_category bgc_cate3">
						<a class= "side_text" href="/todolist/src/05_delete.php">삭제</a>
					</div>
				</div>
			</div>
		</div>
	</form>
</body>
</html>