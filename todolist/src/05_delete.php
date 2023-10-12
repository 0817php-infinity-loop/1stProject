<?php
define("ROOT", $_SERVER["DOCUMENT_ROOT"]."/todolist/src/");
// define("FILE_HEADER", ROOT."header.php");
require_once(ROOT."lib/lib_db.php");


try {
    // 2. DB Connect
    // 2-1. connection 함수호출
    $conn=null; // PDO 객체변수
    if(!todolist_db_conn($conn)){
        // 2-2 예외처리
        throw new Exception("DB Error : PDO instance");
    }
    // Method 획득
    $http_method = $_SERVER["REQUEST_METHOD"]; 

    if($http_method === "GET"){
        // 3-1. GET일 경우 (상세 페이지의 삭제 버튼 클릭)
        // 3-1-1. 파라미터에서 id 획득
        $id = isset($_GET["id"]) ? $_GET["id"] : "";
        $page = isset($_GET["page"]) ? $_GET["page"] : "";

        // 3-1-2. 게시글 정보 획득
        $arr_param = [
            "id" => $id
        ];
        $result = todolist_db_select_boards_id($conn, $arr_param);

        // 3-1-3. 예외 처리
        if($result === false){
            throw new Exception("DB Error : Select id");
        } else if(!(count($result) === 1)){
            throw new Exception("DB Error : Select id count");
        }
        $item = $result[0];
    } else {
        // 3-2-1.파라미터에서 id 획득
        $id = isset($_POST["id"]) ? $_POST["id"] : "";
        // 3-2-2.Transaction 시작
        $conn->beginTransaction();

        // 3-2-3. 게시글 정보 삭제
        $arr_param = [
            "id" => $id
        ];

        // 3-2-4. 예외 처리
        if(!todolist_db_delete_boards_id($conn, $arr_param)){
            throw new Exception("DB Error : Delete Boards id");
        }

        $conn->commit(); // commit
        // header("Location: list.php"); // 리스트 페이지로 이동 
        exit;
    }
} catch(Exception $e) {
    if($http_method === "POST"){
        $conn->rollback();
    }
    echo $e->getMessage(); //에러 메세지 출력
    exit; // 처리종료
} finally{
    todolist_db_destroy_conn($conn);
}

?>


<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>삭제 페이지</title>
	<link rel="stylesheet" href="/todolist/doc/design/css/common.css">
</head>
<body>
	<div class="top_container">
	</div>
	<div class="main_container">
		<div class="main_container_box">
			<div class="left_box">
				<div class="box_layout">
					<div class="layout_delete_top">
						<img src="/todolist/doc/img/list_spring.png">
					</div>
					<div class="align_center layout_delete_middle">
						<p class="align_center_txt_del">삭제하면 영구적으로 복구 할 수 없어요.</p>
						<br>
						<p class="align_center_txt_red">정말로 삭제하시나요?</p>
						<br>
						<p class="align_center_txt_del">삭제할 내용을 한 번 더 확인해 주세요!</p>
					</div>
					<div class="layout_delete_bottom">
						<img src="/todolist/doc/img/list_spring.png">
					</div>
				</div>
			</div>
				
			<div class="right_box">
				<div class="box_layout">
					<div class="align_center date">
						<img class="delete_emo" src="/todolist/doc/img/emotion_1.png">
						<p>2023년 10월 16일<br>
							금요일
						</p>
						<!-- php 데이터 연동 -->
					</div>
					<br>
					<form class="align_center" action="/todolist/src/05_delete.php" method="post">						
						<label for="title"></label>
						<input type="text" class ="textarea_1" name="title" id="title" maxlength="20" value="<?php echo $id; ?>">
						<br><br>
						<label for="content"></label>
						<textarea class ="textarea_2" name="content" id="content" cols="25" rows="10"><?php echo $item["content"] ?></textarea>
					</form>
				</div>
			</div>

			<div class="side_box">
				<div class="side_category bgc_cate1">
					<button class= "side_text button_text" type="submit">삭제</button>
				</div>
				<div class="side_category bgc_cate2">
					<a class= "side_text" href="/todolist/doc/design/02_detail.html">취소</a>
				</div>
			</div>
		</div>
	</div>
</body>
</html>