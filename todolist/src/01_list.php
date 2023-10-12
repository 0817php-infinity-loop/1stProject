<?php

?>


<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>메인 페이지</title>
	<link rel="stylesheet" href="/todolist/doc/design/css/common.css">
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

							<tr onclick="location.href='02_detail.html'" class="table_tr1 table_cursor">
								<td class="table_emotion"><img src="/todolist/doc/img/emotion_1.png"></td>
								<td class="table_date">10월 6일<br>금요일</td>
							</tr>
							<tr onclick="location.href='02_detail.html'" class="table_tr2 table_cursor">
								<td class="table_title"colspan="2">아싸 ! 주말이다 !</td>
							</tr>
							<tr class="table_tr1">
								<td class="table_emotion"><img src="/todolist/doc/img/emotion_2.png"></td>
								<td class="table_date">10월 7일<br>토요일</td>
							</tr>
							<tr class="table_tr2">
								<td class="table_title"colspan="2">집에 가고 시포</td>
							</tr>
							<tr class="table_tr1">
								<td class="table_emotion"><img src="/todolist/doc/img/emotion_3.png"></td>
								<td class="table_date">10월 8일<br>일요일</td>
							</tr>
							<tr class="table_tr2">
								<td class="table_title"colspan="2">운동 가기 귀찮다</td>
							</tr>
							<tr class="table_tr1">
								<td class="table_emotion"><img src="/todolist/doc/img/emotion_4.png"></td>
								<td class="table_date">10월 9일<br>월요일</td>
							</tr>
							<tr class="table_tr2">
								<td class="table_title"colspan="2">배고파악</td>
							</tr>
							<tr class="table_tr1">
								<td class="table_emotion"><img src="/todolist/doc/img/emotion_5.png"></td>
								<td class="table_date">10월 10일<br>화요일</td>
							</tr>
							<tr class="table_tr2">
								<td class="table_title table_border_none"colspan="2">행복해엥</td>
							</tr>
					</table>
					<br><br>
					<div class="right_page">
						<a class="right_page_num" href="#"><</a>
						<a class="right_page_num" href="#">1</a>
						<a class="right_page_num" href="#">2</a>
						<a class="right_page_num" href="#">3</a>
						<a class="right_page_num" href="#">4</a>
						<a class="right_page_num" href="#">5</a>
						<a class="right_page_num" href="#">></a>
					</div>
				</div>
			</div>

			<div class="side_box">
				<div class="side_category bgc_cate1">
					<a class= "side_text" href="/todolist/doc/design/03_insert.html">작성</a>
				</div>
			</div>
		</div>
	</div>
</body>
</html>