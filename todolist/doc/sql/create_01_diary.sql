USE diarydb;
CREATE TABLE IF NOT EXISTS diary(

	id INT PRIMARY KEY AUTO_INCREMENT
	,title VARCHAR(200) NOT NULL
	,content VARCHAR(1000) NOT NULL
	,create_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP()
	,delete_flag CHAR(1) NOT NULL DEFAULT '0'
	,delete_at DATETIME DEFAULT NULL
	,em_id VARCHAR(2) NOT NULL
);