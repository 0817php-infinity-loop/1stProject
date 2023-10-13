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

			if(!isset($_GET["page"]) || $_GET["page"] === "") {
				throw new Exception("Parameter ERROR : No page"); // 강제 예외 발생 :
			}
			$page = $_GET["page"]; // page 셋팅
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
			$yoil = array("일요일","월요일","화요일","수요일","목요일","금요일","토요일");
			$item_yoil=$yoil[date('w', strtotime($item['create_at']))];
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
	<form action="/todolist/src/05_delete.php" method="post">
		<div class="main_container">

			
			<div class="main_container_box">
				<div class="left_box">
					<div class="box_layout">
						<div class="say">		
							<?php echo $item['em_comment']; ?>
						</div>
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
							<img class="detail_emo" src="<?php echo IMG.$item['em_path']; ?>">
							<p class="align_center_date"><?php echo $item['create_at']; ?></p>
							<p class="align_center_date"><?php echo $item_yoil ?></p>
							<br>
							<!-- php 데이터 연동 -->
						</div>
						<br>
						<table class ="detail_delete_table">
							<thead>
								<tr>
									<td class ="detail_textarea_1">
										<?php echo $item["title"]; ?>
									</td>
								</tr>
							</thead>
							<tr>
								<td class ="detail_textarea_3">
								</td>
							</tr>
							<tr>
								<td class ="detail_textarea_2">
									<?php echo $item["content"]; ?>
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
						<a class= "side_text" href="/todolist/src/04_update.php/?id=<?php echo $id ?>&page=<?php echo $page ?>">수정</a>
					</div>
					<div class="side_category bgc_cate3">
						<a class= "side_text" href="/todolist/src/05_delete.php/?id=<?php echo $id ?>&page=<?php echo $page ?>">삭제</a>
					</div>
				</div>
			</div>
		</div>
	</form>
</body>
</html>