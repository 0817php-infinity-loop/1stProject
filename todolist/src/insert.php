<?php
define("ROOT", $_SERVER["DOCUMENT_ROOT"]."/todolist/src/");//웹서버root
define("ERROR_MSG_PARAM", "%s필수 입력 사항입니다.");// 파라미터 에러 메세지
require_once(ROOT."lib/lib_db.php");// DB관련 라이브러리

// post로 request가 있을 때 처리
$conn = null; // DB Connection 변수
$http_method = $_SERVER["REQUEST_METHOD"]; // Method 확인
$arr_err_msg = []; // 에러 메세지 저장용
$title = "";
$content = "";

if($http_method === "POST") {
	try {
		//파라미터 획득
		$arr_post = $_POST;		

		$title = isset($_POST["title"]) ? trim($_POST["title"]) : ""; //title 셋팅
		$content = isset($_POST["content"]) ? trim($_POST["content"]) : "";
		
		if($title === "") {
			$arr_err_msg[] = sprintf(ERROR_MSG_PARAM, "[제목]");
		}
		if($content === "") {
			$arr_err_msg[] = sprintf(ERROR_MSG_PARAM, "[내용]");
		}
		if(count($arr_err_msg) === 0) {
			
		// DB 접속
		if(!todolist_db_conn($conn)) {
			// DB Instance 에러
			throw new Exception("DB Error : PDO Instance");		
		}
		$conn->beginTransaction(); // 트랜잭션 시작
				
		// 게시글 작성을 위해 파라미터 셋팅
		$arr_param = [
			"title" => $_POST["title"]
			,"content" => $_POST["content"]
		];

		// insert
		if(!todolist_db_insert_boards($conn, $arr_post)) {
			// DB Instance 에러
			throw new Exception("DB Error : Insert Boards");		
		}
		$conn->commit(); // 모든 처리 완료 시 커밋		

		// 리스트 페이지로 이동
		header("Location: list.php");
		exit;
		}
	} catch(Exception $e) {
		if($conn !== null){
			$conn->rollBack();
		}	
		// echo $e->getMessage(); // 예외발생 메세지 출력 //v002 del
		// header("Location: error_test.php/?err_msg={$e->getMessage()}");	//v002 add
		exit;
	} finally {
		todolist_db_destroy_conn($conn); // DB파기
	}	
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>삽입 페이지</title>
	<link rel="stylesheet" href="/todolist/doc/design/css/common.css">	
</head>
<body>
	<div class="top_container">

	</div>
	<div class="main_container">
		<div class="main_container_box">
			<div class="left_box">
				<div class="box_layout">
					<div class="post_it">
						<div class="emoticon_1">
							<a class="emoticon_2" href="#"><img class="emo" src="/todolist/doc/img/emotion_1.png"></a>
							<a class="emoticon_2" href="#"><img class="emo" src="/todolist/doc/img/emotion_2.png"></a>
							<a class="emoticon_2" href="#"><img class="emo" src="/todolist/doc/img/emotion_3.png"></a>
							<!-- #으로 링크되어 있는 주소에서 a:visited 스타일 적용 안됨/반드시 css 확인할 것 -->
						</div>
						<div>
							<a class="emoticon_2" href="#"><img class="emo" src="/todolist/doc/img/emotion_4.png"></a>
							<a class="emoticon_2" href="#"><img class="emo" src="/todolist/doc/img/emotion_5.png"></a>
							<a class="emoticon_2" href="#"><img class="emo" src="/todolist/doc/img/emotion_6.png"></a>
							<!-- #으로 링크되어 있는 주소에서 a:visited 스타일 적용 안됨/반드시 css 확인할 것 -->
						</div>
						<div>
							<a class="emoticon_2" href="#"><img class="emo" src="/todolist/doc/img/emotion_7.png"></a>
							<a class="emoticon_2" href="#"><img class="emo" src="/todolist/doc/img/emotion_8.png"></a>
							<!-- #으로 링크되어 있는 주소에서 a:visited 스타일 적용 안됨/반드시 css 확인할 것 -->
						</div>
					</div>
					<div class="align_center">
						<p class="align_center_txt">감정을 선택해 주세요 !</p>
					</div>
				</div>
			</div>
				
			<div class="right_box">
				<div class="box_layout">
					<div class="align_center date">
						<img class="flower" src="/todolist/doc/img/flower_red.png">
						<p class="align_center_date">2023년 10월 16일<br>
							금요일
						</p>
						<!-- php 데이터 연동 -->
					</div>
					<br>
					<form class="align_center" action="" method="post">						
						<label for="title"></label>
						<input type="text" class = 'textarea_1' name="title" id="title" value="<?php echo $title; ?>" 
						maxlength="20" placeholder="제목을 작성해주세요.">
						<!-- value="title" id 뒤에 설정하기 -->
						<br><br>
						<label for="content"></label>
						<textarea class = 'textarea_2' name="content" id="content" cols="25" rows="10"
						placeholder="내용을 작성해주세요."><?php echo $content; ?></textarea>						
					</form>
				</div>
			</div>

			<div class="side_box">
				<div class="side_category bgc_cate1">
					<button class= "side_text button_text" href="/todolist/doc/design/03_insert.html">작성</button>
				</div>
				<div class="side_category bgc_cate3">
					<a class= "side_text" href="/todolist/doc/design/01_list.html">취소</a>
				</div>				
			</div>
		</div>
	</div>
</body>
</html>