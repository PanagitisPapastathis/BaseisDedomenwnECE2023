DROP TABLE IF EXISTS Lending;
DROP TABLE IF EXISTS Booking;
DROP TABLE IF EXISTS Reviews;
DROP TABLE IF EXISTS Book_Subject;
DROP TABLE IF EXISTS Subject;
DROP TABLE IF EXISTS Book_Author;
DROP TABLE IF EXISTS Author;
DROP TABLE IF EXISTS Users;
DROP TABLE IF EXISTS Book_Publisher; 
DROP TABLE IF EXISTS Publisher;
DROP TABLE IF EXISTS Copies;
DROP TABLE IF EXISTS Books;
DROP TABLE IF EXISTS School;

create table if not exists School (
	Name Varchar(50) not null,
	Address Varchar(30) not null,
	Postal_code Varchar(10) not null,
	City Varchar(30) not null,
	Phone_number Varchar(15) not null,
	Email Varchar(60) not null,
	Headmaster_name Varchar(50) not null,
	primary key (Name),
	UNIQUE(Phone_number)
)
engine = InnoDB;

create table if not exists Books (
	ISBN Varchar(30) not null,
	Title Varchar(100) not null,
	Summary text not null,
	No_pages Integer Unsigned not null,
	Image text not null,
	Book_language Varchar(30) not null,
	Key_words text not null,
	primary key(ISBN)
)
engine = InnoDB;

create table if not exists Copies(
	Copy_id Integer Unsigned AUTO_INCREMENT,
	ISBN Varchar(30) not null,
	No_of_copies Integer Unsigned not null,
	Available_copies Integer Unsigned,
	School_Name Varchar(50) not null,
	primary key (Copy_id),  
	unique(ISBN, School_Name),
	constraint fk_copies_isbn
		foreign key (ISBN)
		references Books (ISBN)
		on delete restrict
		on update cascade,
	constraint fk_copies_school_name
		foreign key(School_Name)
		references School(Name)
		on delete restrict
		on update cascade,
	constraint available_less_than_total
		CHECK (Available_copies <= No_of_copies)
)
engine = InnoDB; 


create table if not exists Publisher(
	Publisher_id Integer Unsigned AUTO_INCREMENT,
	Name Varchar(30) not null,
	primary key(Publisher_id)
)
engine = InnoDB;

create table if not exists Book_Publisher(
	Publisher_id Integer Unsigned not null,
	ISBN Varchar(30) not null,
	UNIQUE(ISBN), # katalavame arga oti den mporei 2 ekdotes na vgaloun vivlio me to idio isbn
	primary key (ISBN, Publisher_id),
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
	Birth_Date date not null,
	Status Enum ('Student', 'Teacher', 'Admin', 'Central Admin') not null,
	Status2 Enum ('Pending', 'Accepted', 'Requesting','Suspended') default 'Pending',
	Phone_number Varchar(15) not null, #Legit_Phone_Number() san function sthn php
	Email Varchar(60) not null,
	School_Name Varchar(30) not null,
	Registration_Date timestamp default CURRENT_TIMESTAMP,
	Last_Update timestamp default CURRENT_TIMESTAMP,
	primary key(Username),
	constraint fk_User_School
		FOREIGN KEY (School_Name)
		REFERENCES School (Name)
		ON DELETE RESTRICT
		ON UPDATE CASCADE
)
engine = InnoDB;

create table if not exists Author(
	Author_id Integer Unsigned AUTO_INCREMENT,
	Name Varchar(30) not null,
	primary key(Author_id)
)
engine = InnoDB;

create table if not exists Book_Author(
	Author_id Integer Unsigned not null, 
	ISBN Varchar(30) not null,
	primary key (ISBN,Author_id), 
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
	Subject_id Integer Unsigned AUTO_INCREMENT, 
	Subject_name Varchar(30) not null,
	primary key(Subject_id)
)
engine = InnoDB;

create table if not exists Book_Subject(
	Subject_id Integer Unsigned not null,
	ISBN Varchar(30) not null,
	primary key (ISBN,Subject_id),
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

create table if not exists Reviews (#dikia mas paradoxh: o kathe xrhsths mporei na kanei apo ena review se kathe vivlio
	Review longtext not null,
	Rating Integer Unsigned not null, 
	Username Varchar(30) not null,
	Post_Date timestamp default CURRENT_TIMESTAMP,
	Last_Update timestamp default CURRENT_TIMESTAMP,
	ISBN Varchar(30),
	Status ENUM ('Pending', 'Accepted','Removed'), #otan to svhnei o idios o xrhsthss na to kanoume delete apo th vash
	primary key(Username, ISBN),
	constraint fk_Username_rev
		foreign key (Username) 
		references Users (Username)
		on delete restrict
		on update cascade,
	constraint fk_ISBN_rev
		foreign key (ISBN) 
		references Books (ISBN)
		on delete restrict
		on update cascade,
	constraint rating_in_likert_scale
		CHECK (Rating >= 1 AND Rating<=5)
)
engine = InnoDB;

create table if not exists Lending (
	Serial_number Integer Unsigned AUTO_INCREMENT,
	Making_date date not null default CURRENT_DATE,
	Username Varchar(30) not null,
	Return_status ENUM('Owed', 'Returned') default 'Owed',
	Return_date date,
	Copy_id Integer Unsigned not null,
	Approved_by Varchar(30),
	primary key(Serial_number),
	constraint fk_Lending_User
		foreign key (Username)
		references Users (Username)
		on delete restrict
		on update cascade,
	constraint fk_Lending_Copy_Id
		foreign key (Copy_id)
		references Copies(Copy_id)
		on delete restrict 
		on update cascade,
	constraint fk_Lending_Approved_by
		foreign key (Approved_by)
		references Users (Username)
		on delete restrict
		on update cascade
)
engine = InnoDB;

create table if not exists Booking (
	Making_date date default CURRENT_DATE,
	Username Varchar(30) not null,
	Copy_id Integer Unsigned not null,
	Status enum('Pending', 'Active') default 'Active', 
	primary key(Username, Copy_id),
	constraint fk_Booking_User
		foreign key (Username)
		references Users (Username)
		on delete restrict 
		on update cascade,
	constraint fk_Booking_Copy_id
		foreign key (Copy_id)
		references Copies(Copy_id)
		on delete restrict
		on update cascade
)
engine = InnoDB;
