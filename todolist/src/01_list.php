<?php
	define("ROOT", $_SERVER["DOCUMENT_ROOT"]."/todolist/src/");
	define("IMG", "/todolist/doc/img/");
	require_once(ROOT."lib/lib_db.php");

	$conn = null; // DB connection 변수
	$list_cnt = 5; //한 페이지에 최대 표시 수
	$page_num = 1; // 페이지 번호 초기화

	try{
		// ---------
		// DB 접속
		// ---------
		if (!db_conn($conn)) {
			throw new Exception("DB Error : PDO instance");
		}
		// ---------
		// 페이징 처리
		// ---------
		// 총 게시글 수 검색
		$boards_cnt = db_select_boards_cnt($conn);
		if ($boards_cnt === false){
			throw new Exception("DB Error : select COUNT ERROR");
		}

		// 유저가 보내온 페이지 세팅
		
		$max_page_num = ceil(db_select_boards_cnt($conn) / $list_cnt); // 최대 페이지 수
		if (isset($_GET["page"])) {
			$page_num = (int)$_GET["page"];
		};
		$offset = ($page_num - 1) * $list_cnt; // 오프셋 계산
	
		// 이전 버튼
		$prev_page_num = $page_num - 1;
		if ($prev_page_num === 0) {
			$prev_page_num = 1;
		}

		// 다음 버튼
		$next_page_num = $page_num + 1;
		if ($next_page_num > $max_page_num) {
			$next_page_num = $max_page_num;
		}
	
		// DB 조회시 사용할 데이터 배열
		$arr_param = [
			"list_cnt" => $list_cnt
			,"offset" => $offset
		];
		
		$result = db_select_boards_paging($conn, $arr_param);
		if(!$result) {
			throw new Exception("DB Error : SELECT boards paging ERROR");
		}

	} catch (Exception $e) {
		// echo $e->getMessage(); 예외발생 메세지 출력 //v002del
		echo $e->getMessage();
		exit;
	} finally {
		db_destroy_conn($conn);
	}
?>


<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>메인 페이지</title>
	<link rel="stylesheet" href="/todolist/src/css/common.css">
</head>
<body>
	<div class="top_container">

	</div>
	<div class="main_container">
		<div class="main_container_box">
			<div class="left_box">
				<div class="box_layout">
					<div class="left_top">
						<img src="/todolist/doc/img/list_spring.png">
					</div>
					<div class="left_top2">
						<p class="left_top2_text1">나의 감정은 어때 ?</p>
						<p class="left_top2_text2">-자주 기록했던 감정을 확인할 수 있어요</p>
					</div>
					<div class="left_middle">
						<div class="left_bottom_layout1">
							<img class="left_emotion_size1" src="/todolist/doc/img/emotion_1.png">
							<img class="left_star_size1" src="/todolist/doc/img/star_1.png">
							<p>행복 : 30</p>
						</div>
						<div class="left_bottom_layout1">
							<img class="left_emotion_size1" src="/todolist/doc/img/emotion_3.png">
							<img class="left_star_size1" src="/todolist/doc/img/star_2.png">
							<p>평온 : 22</p>
						</div>
						<div class="left_bottom_layout1">
							<img class="left_emotion_size1" src="/todolist/doc/img/emotion_5.png">
							<img class="left_star_size1" src="/todolist/doc/img/star_3.png">
							<p>우울 : 13</p>
						</div>
					</div>
					<div class="left_bottom">
						<div class="left_bottom_layout2">
							<img class="left_emotion_size2" src="/todolist/doc/img/emotion_4.png">
							<img class="left_star_size2" src="/todolist/doc/img/star_4.png">
							<p>슬픔 : 7</p>
						</div>
						<div class="left_bottom_layout2">
							<img class="left_emotion_size2" src="/todolist/doc/img/emotion_8.png">
							<img class="left_star_size2" src="/todolist/doc/img/star_5.png">
							<p>불안 : 4</p>
						</div>
					</div>
				</div>
			</div>
				
			<div class="right_box">
				<div class="box_layout">
					<div class="right_top">
						<p>2023</p>
					</div>
					<table class="right_table">
						<colgroup>
							<col width= "12%">
							<col width= "88%">
						</colgroup>
						<?php
							//리스트 생성
							foreach ($result as $item) {
						?>
							<tr onclick="location.href='/todolist/src/02_detail.php/?id=<?php echo $item['id']; ?>&page=<?php echo $page_num;?>'" class="table_tr1 table_cursor">
								<td class="table_emotion"><img src='<?php echo IMG.$item['em_path']; ?>'></td>
								<td class="table_date"><?php echo $item["create_at"]; ?><br>금요일</td>
							</tr>
							<tr onclick="location.href='/todolist/src/02_detail.php/?id=<?php echo $item['id']; ?>&page=<?php echo $page_num;?>'" class="table_tr2 table_cursor">
								<td class="table_title"colspan="2"><?php echo $item['title']; ?></td>
							</tr>
						<?php
							}
						?>
					</table>
					<br><br>
					<div class="right_page">
						<a class="right_page_num" href="/todolist/src/01_list.php/?page=<?php echo $prev_page_num; ?>"><<</a>
						<?php
						$block_num=(int)ceil($page_num/5); // 블럭 페이지
						$block_first_num=(5*$block_num)-4; // 블럭당 첫번째 값
						$present_num=$block_first_num-1;
						for($i = $block_first_num; $i <= $block_num*5; $i++) {
							$present_num+=1;
							
							if ($i > $max_page_num) {
								break;
							} //max page num 까지만 출력하는 if문
							
						?>	
							<a class="right_page_num" href="/todolist/src/01_list.php/?page=<?php echo $i; ?>"><?php echo $i; ?></a>
						<?php
						}
						?>
						<a class="right_page_num"  href="/todolist/src/01_list.php/?page=<?php echo $next_page_num; ?>">>></a>
					</div>
				</div>
			</div>

			<div class="side_box">
				<div class="side_category bgc_cate1">
					<a class= "side_text" href="/todolist/src/03_insert.php">작성</a>
				</div>
			</div>
		</div>
	</div>
</body>
</html>