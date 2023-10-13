<?php
define("ROOT", $_SERVER["DOCUMENT_ROOT"]."/todolist/src/");//웹서버root
define("ERROR_MSG_PARAM", "⛔ %s을 입력해 주세요.");// 파라미터 에러 메세지
require_once(ROOT."lib/lib_db.php");// DB관련 라이브러리

// post로 request가 있을 때 처리
$conn = null; // DB Connection 변수
$http_method = $_SERVER["REQUEST_METHOD"]; // Method 확인
$arr_err_msg = []; // 에러 메세지 저장용
$title = "";
$content = "";
$em_id = "";
// $create_at = "";
$yoil = array("일요일","월요일","화요일","수요일","목요일","금요일","토요일"); //요일 출력하기 위한 세팅

try {
    if(!db_conn($conn)) {
        // DB Instance 에러
        throw new Exception("DB Error : PDO Instance");		
    }
    $conn->beginTransaction(); // 트랜잭션 시작

    $result=db_insert_boards_now($conn);
    if($result === FALSE) {
        // DB Instance 에러
        throw new Exception("DB Error : 1 Boards");		
    }

    $conn->commit();
} catch(Exception $e) {
    if($conn !== null){
        $conn->rollBack();
    }
    echo $e->getMessage(); // 예외발생 메세지 출력 //v002 del
    // header("Location: error_test.php/?err_msg={$e->getMessage()}");	//v002 add
    exit;
} finally {
    db_destroy_conn($conn); // DB파기
}


if($http_method === "POST") {
	try {
		//파라미터 획득
		$arr_post = $_POST;		

		$title = isset($_POST["title"]) ? trim($_POST["title"]) : ""; //title 셋팅
		$content = isset($_POST["content"]) ? trim($_POST["content"]) : ""; //content 셋팅
		$em_id = isset($_POST["em_id"]) ? trim($_POST["em_id"]) : ""; //em_id 셋팅
		
		if($title === "") {
			$arr_err_msg[] = sprintf(ERROR_MSG_PARAM, "[제목]");
		}
		if($content === "") {
			$arr_err_msg[] = sprintf(ERROR_MSG_PARAM, "[내용]");
		}
		if($em_id === "") {
			$arr_err_msg[] = sprintf(ERROR_MSG_PARAM, "[감정]");
		}

		if(count($arr_err_msg) === 0) {
                
            // DB 접속
            if(!db_conn($conn)) {
                // DB Instance 에러
                throw new Exception("DB Error : PDO Instance");		
            }
            $conn->beginTransaction(); // 트랜잭션 시작
            
            // 게시글 작성을 위해 파라미터 셋팅
            $arr_param=$_POST;
            // insert
            if(!db_insert_boards($conn, $arr_param)) {
                // DB Instance 에러
                throw new Exception("DB Error : Insert Boards");		
            }
            $conn->commit(); // 모든 처리 완료 시 커밋		

            // 리스트 페이지로 이동
            header("Location: 01_list.php");
            exit;
		}

        if(count($arr_err_msg) >= 1) {
            throw new Exception(implode("<br>", $arr_err_msg));
        }
	} catch(Exception $e) {
		if($conn !== null){
			$conn->rollBack();
		}	
		echo $e->getMessage(); // 예외발생 메세지 출력 //v002 del
		// header("Location: error_test.php/?err_msg={$e->getMessage()}");	//v002 add
		exit;
	} finally {
		db_destroy_conn($conn); // DB파기
	}
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>삽입 페이지</title>
	<link rel="stylesheet" href="/todolist/src/css/common.css">	
</head>
<body>
	<div class="top_container">

	</div>	
	<form action="/todolist/src/03_insert.php" method="post">
        <div class="main_container">
            <div class="main_container_box">
                <div class="left_box">
                    <div class="box_layout">
                        <div class="post_it">
                            <div class="emotion_ma1">
                                <div class="emotion_lay1">
                                    <label class="emotion_each" for="emotion1">
                                    <input type="radio" name="em_id" id="emotion1" value="1">
                                    <img class="emo" src="/todolist/doc/img/emotion_1.png">
                                    <br>
                                    <p class="emotion_lay_p">행복</p>
                                    </label>
                                </div>
                                <div class="emotion_lay1">
                                    <label class="emotion_each" for="emotion2">
                                    <input type="radio" name="em_id" id="emotion2" value="2">
                                    <img class="emo" src="/todolist/doc/img/emotion_2.png">
                                    <br>
                                    <p class="emotion_lay_p">기쁨</p>
                                    </label>
                                </div>
                                <div class="emotion_lay1">
                                    <label class="emotion_each" for="emotion3">
                                    <input type="radio" name="em_id" id="emotion3" value="3">
                                    <img class="emo" src="/todolist/doc/img/emotion_3.png">
                                    <br>
                                    <p class="emotion_lay_p">평온</p>
                                    </label>
                                </div>
                            </div>
                            <div class="emotion_ma2">
                                <div class="emotion_lay2">
                                    <label class="emotion_each" for="emotion4">
                                    <input type="radio" name="em_id" id="emotion4" value="4">
                                    <img class="emo" src="/todolist/doc/img/emotion_4.png">
                                    <br>
                                    <p class="emotion_lay_p">슬픔</p>
                                    </label>
                                </div>
                                <div class="emotion_lay2">
                                    <label class="emotion_each" for="emotion5">
                                    <input type="radio" name="em_id" id="emotion5" value="5">
                                    <img class="emo" src="/todolist/doc/img/emotion_5.png">
                                    <br>
                                    <p class="emotion_lay_p">우울</p>
                                    </label>
                                </div>
                                <div class="emotion_lay2">
                                    <label class="emotion_each" for="emotion6">
                                    <input type="radio" name="em_id" id="emotion6" value="6">
                                    <img class="emo" src="/todolist/doc/img/emotion_6.png">
                                    <br>
                                    <p class="emotion_lay_p">피곤</p>
                                    </label>
                                </div>
                            </div>
                            <div class="emotion_ma3">
                                <div class="emotion_lay3">
                                    <label class="emotion_each" for="emotion7">
                                    <input type="radio" name="em_id" id="emotion7" value="7">
                                    <img class="emo" src="/todolist/doc/img/emotion_7.png">
                                    <br>
                                    <p class="emotion_lay_p">화남</p>
                                    </label>
                                </div>
                                <div class="emotion_lay3">
                                    <label class="emotion_each" for="emotion8">
                                    <input type="radio" name="em_id" id="emotion8" value="8">
                                    <img class="emo" src="/todolist/doc/img/emotion_8.png">
                                    <br>
                                    <p class="emotion_lay_p">불만</p>
                                    </label>
                                </div>
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
                            <img class="flower_y" src="/todolist/doc/img/flower_red.png">
                            <?php
                                $item_yoil=$yoil[date('w', strtotime($result))];
                                $string = preg_replace('/-/','년 ',$result,1);
                                $string = preg_replace('/-/','월 ',$string,1)."일 ";
                            ?>
                            <p class="align_center_date"><?php echo $string; ?><br><?php echo $item_yoil; ?></p>     
                        </div>
                        <br>
						<div class="align_center">
							<label for="title"></label>
							<input type="text" class = "textarea_1" name="title" id="title" value="<?php echo $title; ?>"
							maxlength="20" placeholder="제목을 작성해주세요.">
							<!-- value="title" id 뒤에 설정하기 -->
							<br><br>
							<label for="content"></label>
							<textarea class = "textarea_2" name="content" id="content" cols="25" rows="10"
							placeholder="내용을 작성해주세요."><?php echo $content; ?></textarea>
						</div>
                    </div>
                </div>
                <div class="side_box">
                    <div class="side_category bgc_cate1">
                        <button class= "side_text button_text" type= submit href="/todolist/src/03_insert.php">작성</button>
                    </div>
                    <div class="side_category bgc_cate3">
                        <a class= "side_text" href="/todolist/src/01_list.php/?page=1">취소</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>
</html>