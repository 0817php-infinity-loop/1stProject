USE diarydb;
INSERT INTO emotion
(em_id, em_name, em_comment, em_path)
VALUES
('1','행복','명언1','emotion_1.png')
,('2','기쁨','명언2','emotion_2.png')
,('3','평온','명언3','emotion_3.png')
,('4','슬픔','명언4','emotion_4.png')
,('5','우울','명언5','emotion_5.png')
,('6','피곤','명언6','emotion_6.png')
,('7','화남','명언7','emotion_7.png')
,('8','불만','명언8','emotion_8.png');

COMMIT;