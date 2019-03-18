CREATE TABLE IF NOT EXISTS ncfc_brands (
	bid int unsigned primary key not null auto_increment,
	added_date int unsigned,
	title varchar(255),
	slug varchar(255)
);