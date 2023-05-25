create table if not exists School (
	Name varchar(30) not null,
	Address varchar(30) not null,
	Postal_code int not null,
	City varchar(30) not null,
	Phone_number int not null,
	Email varchar(30) not null,
	Headmaster_name varchar(30) not null,
	School_admin_name varchar(30) not null,
	primary key (Name)
)
engine = InnoDB;

create table if not exists Books (
	ISBN varchar(30) not null,
	Title varchar(30) not null,
	Summary text not null,
	No_pages integer not null,
	Image BLOB not null not null,
	Book_language varchar(30) not null,
	Key_words text not null,
	primary key(ISBN)
)
engine = InnoDB;

create table if not exists Copies(
	ISBN varchar(30) not null,
	Status enum('Free', 'Lended', 'Booked'),
	No_of_copies int not null,
	Available_copies int not null,
	primary key (ISBN),
	constraint fk_copies_isbn
		foreign key (ISBN)
		references Books (ISBN)
		on delete restrict
		on update cascade
)
engine = InnoDB;
create table if not exists Publisher(
	Publisher_id varchar(30) not null,
	Name varchar(30) not null,
	primary key(Publisher_id)
)
engine = InnoDB;

create table if not exists Book_Publisher(
	Publisher_id varchar(30) not null,
	ISBN varchar(30) not null,
	primary key (Publisher_id),
	constraint fk_Publisher_id
		foreign key (Publisher_id)
		references Publisher (Publisher_id)
		on delete restrict
		on update cascade,
	constraint fk_published_isbn
		foreign key (ISBN)
		references Books (ISBN)
		on delete restrict
		on update cascade
)
engine = InnoDB;


create table if not exists Users (
	Username Varchar(30) not null,
	Password Varchar(30) not null,
	First_Name Varchar(30) not null,
	Last_Name Varchar(30) not null,
	Status Varchar(30) not null,
	Phone_number Integer not null,
	Email Varchar(30) not null,
	Books_Lended Integer not null,
	Books_Owed Integer not null,
	School_Name Varchar(30) not null,
	Registration_Date timestamp,
	primary key(Username)
)
engine = InnoDB;

create table if not exists Author(
	Author_id varchar(30) not null,
	Name varchar(30) not null,
	primary key(Author_id)
)
engine = InnoDB;

create table if not exists Book_Author(
	Author_id varchar(30) not null,
	ISBN varchar(30) not null,
	primary key (Author_id),
	constraint fk_Author_id
		foreign key (Author_id)
		references Author (Author_id)
		on delete restrict
		on update cascade,
	constraint fk_writen_isbn
		foreign key (ISBN)
		references Books (ISBN)
		on delete restrict
		on update cascade
)
engine = InnoDB;


create table if not exists Subject(
	Subject_id int not null,
	Subject_name varchar(30) not null,
	primary key(Subject_id)
)
engine = InnoDB;

create table if not exists Book_Subject(
	Subject_id int not null,
	ISBN varchar(30) not null,
	primary key (Subject_id),
	constraint fk_Subject_id	
		foreign key (Subject_id)
		references Subject (Subject_id)
		on delete restrict
		on update cascade,
	constraint fk_subject_isbn
		foreign key (ISBN)
		references Books (ISBN)
		on delete restrict
		on update cascade
)
engine = InnoDB;

create table if not exists Reviews (
	Serial_Number Integer not null,
	Review longtext not null,
	Username Varchar(30) not null,
	Post_Date timestamp,
	Last_Update timestamp, #emena den mou vgazei thema alla to allazw giati san timestamp vgazei pio poly nohma - swthrhs
	ISBN Varchar(30),θέμα
	Title Varchar(30),
	primary key(Serial_number),
	constraint fk_Username_rev
		foreign key (Username) 
		references Users (Username)
		on delete restrict
		on update cascade,
	constraint fk_ISBN_rev
		foreign key (ISBN) 
		references Books (ISBN)
		on delete restrict
		on update cascade
)
engine = InnoDB;

create table if not exists Lending (
	Serial_number int not null,
	Working_date timestamp not null default CURRENT_DATE,
	Expiration_date timestamp not null default CURRENT_DATE,
	Username Varchar(30) not null,
	Return_status Varchar(30) not null,
	ISBN Varchar(30) not null,
	primary key(Serial_number),
	constraint fk_Lending_User
	      foreign key (Username)
	      references Users (Username)
	      on delete restrict
		  on update cascade,
	constraint fk_Lending_ISBN
	      foreign key (ISBN)
	      references Books(ISBN)
	      on delete restrict
		  on update cascade
)
engine = InnoDB;

DELIMITER //

CREATE trigger if not exists trg_LendingInsert
	BEFORE INSERT ON Lending
	FOR EACH ROW
BEGIN
	DECLARE lending_count INT;

	SET lending_count = (
		SELECT COUNT(*)
		FROM Lending
		WHERE Username = NEW.Username
		AND Working_date >= DATE_SUB(CURRENT_DATE, INTERVAL 7 DAY)
	);

	IF lending_count >= 2 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'Maximum number of lendings reached for this user in one week.';
	END IF;
END //

DELIMITER ;

create table if not exists Booking (
	Serial_number int not null,
	Making_date timestamp not null default CURRENT_DATE,
	Expiration_date timestamp not null default CURRENT_DATE,
	Username Varchar(30) not null,
	ISBN Varchar(30) not null,
	primary key(Serial_number),
	constraint fk_Booking_User
	      foreign key (Username)
	      references Users (Username)
	      on delete restrict
		  on update cascade,
	constraint fk_Booking_ISBN
	      foreign key (ISBN)
	      references Books(ISBN)
	      on delete restrict
		  on update cascade
)
engine = InnoDB;
