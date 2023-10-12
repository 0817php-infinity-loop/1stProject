<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>삭제 페이지</title>
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
						<div class="layout_delete_top">
							<img src="/todolist/doc/img/heart.png">
						</div>
						<div class="align_center layout_delete_middle">
							<p class="align_center_txt_del">삭제하면 영구적으로 복구 할 수 없어요.</p>
							<br>
							<p class="align_center_txt_red">정말로 삭제하시나요?</p>
							<br>
							<p class="align_center_txt_del">삭제할 내용을 한 번 더 확인해 주세요!</p>
						</div>
						<div class="layout_delete_bottom">
							<img src="/todolist/doc/img/smile.png">
						</div>
					</div>
				</div>					
				<div class="right_box">
					<div class="box_layout">
						<div class="align_center date">
							<img class="delete_emo" src="/todolist/doc/img/emotion_1.png">
							<p class="align_center_date">2023년 10월 16일<br>
								금요일
							</p>
							<!-- php 데이터 연동 -->
						</div>
						<br>					
							<label for="title"></label>
							<input type="text" class ="textarea_1" name="title" id="title" maxlength="20" value="">
							<br><br>
							<label for="content"></label>
							<textarea class ="textarea_2" name="content" id="content" cols="25" rows="10"></textarea>
					</div>
				</div>
				<div class="side_box">
					<div class="side_category bgc_cate1">
						<button class= "side_text button_text" type="submit">삭제</button>
					</div>
					<div class="side_category bgc_cate3">
						<a class= "side_text" href="/todolist/src/02_detail.php">취소</a>
					</div>
				</div>
			</div>
		</div>
	</form>
</body>
</html>