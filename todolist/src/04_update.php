<?php

?>

<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>수정 페이지</title>
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
						<div class="emotions">
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
						</div>
					</div>
					<div class="align_center">
						<p class="align_center_txt">감정을 수정해 주세요 !</p>
					</div>
				</div>
			</div>
				
			<div class="right_box">
				<div class="box_layout">
					<div class="align_center date">
						<img class="flower_Y" src="../img/flower_yellow.png">
						<p class="align_center_date">2023년 10월 16일<br>
							금요일
						</p>
					</div>
					<br>
					<form class="align_center" action="" method="post">						
						<label for="title"></label>
						<input type="text" class = 'textarea_1' name="title" id="title" maxlength="20">
						<!-- value="title" id 뒤에 설정하기 -->
						<br><br>
						<label for="content"></label>
						<textarea class = 'textarea_2' name="content" id="content" cols="25" rows="10"></textarea>
						<!-- <?php echo $content; ?> textarea 닫는태그 앞 넣어주기 -->
					</form>
				</div>
			</div>

			<div class="side_box">
				<div class="side_category bgc_cate1">
					<a class= "side_text" href="#">수정</a>
				</div>
				<div class="side_category bgc_cate3">
					<a class= "side_text" href="/todolist/doc/design/02_detail.html">취소</a>
				</div>				
			</div>
		</div>
	</div>
</body>
</html>