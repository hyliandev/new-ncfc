CREATE TABLE IF NOT EXISTS ncfc_events (
	eid int unsigned primary key not null auto_increment,
	begin_date int unsigned,
	end_date int unsigned,
	title varchar(255)
);