CREATE TABLE IF NOT EXISTS ncfc_games (
	gid int unsigned primary key not null auto_increment,
	bid int unsigned,
	post_date int unsigned,
	approved tinyint,
	uid int unsigned,
	title varchar(255),
	cover_image text,
	description text
);