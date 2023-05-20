##                Authors: PanagitisPapastathis, el20056, Klarinetos                ##
##                                    20/5/2023                                     ##

#                         First attempt at creating the tables                       #


create table if not exists School (
	Name varchar(30) not null,
	address varchar(30),
	postal_code int,
	city varchar(30),
	phone_number int,
	email varchar(30),
	Headmaster_name varchar(30),
	School_admin_name varchar(30),
	primary key (Name)
)
engine = InnoDB;
create table if not exists Books (
	ISBN varchar(30) not null,
	Title varchar(30),
	Summary longtext,
	No_pages integer,
	Image blob not null,
	Book_language varchar(30),
	Key_words text,
	primary key(ISBN)
)
engine = InnoDB;
create table if not exists Copies(
	ISBN varchar(30) not null,
	Status enum('Free', 'Lended', 'Booked'),
	no_of_copies int,
	Available_copies int,
	primary key (ISBN),
	constraint fk_copies_isbn
		foreign key (ISBN)
		references Books (ISBN)
)
engine = InnoDB;
create table if not exists Publisher(
	Publisher_id varchar(30) not null,
	Name varchar(30),
	primary key(Publisher_id)
)
engine = InnoDB;
create table if not exists Book_Publisher(
	Publisher_id varchar(30) not null,
	ISBN varchar(30) not null,
	primary key (Publisher_id),
	constraint fk_Publisher_id
		foreign key (Publisher_id)
		references Publisher (Publisher_id),
	constraint fk_published_isbn
		foreign key (ISBN)
		references Books (ISBN)
)
engine = InnoDB;
create table if not exists Users (
	Username Varchar(30) not null,
	Password Varchar(30) not null,
	First_Name Varchar(30) not null,
	Last_Name Varchar(30) not null,
	Status enum('General_Admin', 'School_Admin', 'Teacher', 'Student') not null,
	Phone_number Integer not null,
	Email Varchar(30) not null,
	Books_Lended Integer,
	Books_Owed Integer,
	School_Name Varchar(30) not null,
	Registration_Date timestamp,
	primary key(Username)
	constraint fk_school_name
		foreign key(School_Name)
		refferences School(Name)
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
		references Author (Author_id),
	constraint fk_writen_isbn
		foreign key (ISBN)
		references Books (ISBN)
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
		references Subject (Subject_id),
	constraint fk_subject_isbn
		foreign key (ISBN)
		references Books (ISBN)
)
engine = InnoDB;
create table if not exists Reviews (
	Serial_Number Integer not null,
	Review longtext not null,
	Username Varchar(30) not null,
	Post_Date timestamp,
	Last_Update timestamp,
	ISBN Varchar(30),
	Title Varchar(30),
	primary key(Serial_number),
	constraint fk_Username
		foreign key(Username) references Users(Username),
	constraint fk_ISBN
		foreign key(ISBN) references Books(ISBN)
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
	          references User (Username),
	constraint fk_Lending_ISBN
	          foreign key (ISBN)
	          references Books(ISBN)
)
engine = InnoDB;
create table if not exists Booking (
	Serial_number int not null,
	Making_date timestamp not null default CURRENT_DATE,
	Expiration_date timestamp not null default CURRENT_DATE,
	Username Varchar(30) not null,
	ISBN Varchar(30) not null,
	primary key(Serial_number),
	constraint fk_Booking_User
	          foreign key (Username)
	          references User (Username),
	constraint fk_Booking_ISBN
	          foreign key (ISBN)
	          references Books(ISBN)
)
engine = InnoDB;

