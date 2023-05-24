##                Authors: PanagitisPapastathis, el20056, Klarinetos                ##
##                                    20/5/2023                                     ##

#                         First attempt at creating the tables                       #


create table if not exists School (
	Name varchar(30) NOT NULL,
	address varchar(30) NOT NULL,
	postal_code int NOT NULL,
	city varchar(30) NOT NULL,
	phone_number int NOT NULL UNIQUE,
	email varchar(30) NOT NULL UNIQUE,
	Headmaster_name varchar(30) NOT NULL,
	School_admin_name varchar(30) NOT NULL,
	primary key (Name),                                    -- ίσως να θέλει άλλο PRIMARY KEY για να μπορούν να έχουν 2 ίδιο όνομα
	CONSTRAINT unique_address_postal_code_city UNIQUE (address, postal_code, city)
)
engine = InnoDB;

create table if not exists Books (
	ISBN varchar(30) NOT NULL, 
	Title varchar(30) NOT NULL,
	Summary longtext NOT NULL,               
	No_pages integer NOT NULL CHECK (No_pages>0),
	Image blob NOT NULL,                                      -- ίσως να πρέπει να υπάρχει default τιμή
	Book_language varchar(30) NOT NULL,
	Key_words text,                                                  -- να αποφασίσουμε αν θα παίρνει null  
	primary key(ISBN)
)
engine = InnoDB;

create table if not exists Copies(
	ISBN varchar(30) not null,
	Status enum('Free', 'Lended', 'Booked') NOT NULL,
	no_of_copies int NOT NULL CHECK (no_of_copies>0),
	Available_copies int NOT NULL CHECK (Available_copies>=0),
	primary key (ISBN),
	constraint fk_copies_books
		foreign key (ISBN)
		references Books (ISBN)
		ON DELETE RESTRICT ON UPDATE CASCADE
)
engine = InnoDB;

create table if not exists Publisher(
	Publisher_id INT NOT NULL AUTO_INCREMENT,
	Name varchar(30) NOT NULL,
	primary key(Publisher_id)
)
engine = InnoDB;

create table if not exists Book_Publisher(
	Book_Publisher_id int NOT NULL AUTO_INCREMENT,
    Publisher_id varchar(30) NOT NULL,
	ISBN varchar(30) NOT NULL,
	primary key (Book_Publisher_id),
	constraint fk_Publisher_id
		foreign key (Publisher_id)
		references Publisher (Publisher_id)
		ON DELETE RESTRICT ON UPDATE CASCADE,
	constraint fk_published_isbn
		foreign key (ISBN)
		references Books (ISBN) 
		ON DELETE RESTRICT ON UPDATE CASCADE
)
engine = InnoDB;

create table if not exists Users (
	Username Varchar(30) not null,
	Password Varchar(30) not null,
	First_Name Varchar(30) not null,
	Last_Name Varchar(30) not null,
	Status enum('General_Admin', 'School_Admin', 'Teacher', 'Student') not null,
	Phone_number Integer NOT NULL unique,
	Email Varchar(30) NOT NULL unique,
	Books_Lended Integer NOT NULL CHECK (Books_Lended<2 AND Books_Lended>=0),
	Books_Owed Integer NOT NULL CHECK (Books_Owed<2 AND Books_Lended>=0),
	School_Name Varchar(30) NOT NULL UNIQUE,
	Registration_Date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	primary key(Username),
	constraint fk_users_school
		foreign key(School_Name)
		references School(Name)
		ON DELETE RESTRICT ON UPDATE CASCADE                           --ON DELETE RESTRICT ή CASCADE 
)
engine = InnoDB;

create table if not exists Author(
	Author_id varchar(30) NOT NULL AUTO_INCREMENT,                     --μάλλον θέλει int αντί για varchar
	Name varchar(30) not null,
	primary key(Author_id)
)
engine = InnoDB;

create table if not exists Book_Author(
	Book_Author_id int NOT NULL AUTO_INCREMENT,
    Author_id varchar(30) not null,
	ISBN varchar(30) not null,
	primary key (Book_Author_id),                                                
	constraint fk_Author_id
		foreign key (Author_id)
		references Author (Author_id)
		ON DELETE RESTRICT ON UPDATE CASCADE,
	constraint fk_writen_isbn
		foreign key (ISBN)
		references Books (ISBN)
		ON DELETE RESTRICT ON UPDATE CASCADE
)
engine = InnoDB;

create table if not exists Subject(
	Subject_id int NOT NULL AUTO_INCREMENT,
	Subject_name varchar(30) not null,
	primary key(Subject_id)
)
engine = InnoDB;

create table if not exists Book_Subject(
    Book_Subject int NOT NULL AUTO_INCREMENT,
    Subject_id int not null,
	ISBN varchar(30) not null,
	primary key (Book_Subject_id),
	constraint fk_Subject_id
		foreign key (Subject_id)
		references Subject (Subject_id)
		ON DELETE RESTRICT ON UPDATE CASCADE,
	constraint fk_subject_isbn
		foreign key (ISBN)
		references Books (ISBN)
		ON DELETE RESTRICT ON UPDATE CASCADE
)
engine = InnoDB;

create table if not exists Reviews (
	Serial_Number Integer NOT NULL AUTO_INCREMENT,
	Review longtext not null,
	Username Varchar(30) NOT NULL UNIQUE,
	Post_Date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	Last_Update timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP CHECK (Post_Date<=Last_Update),
	ISBN Varchar(30) NOT NULL UNIQUE,
	Title Varchar(100) NOT NULL,
	Approval enum ('Approved', 'Not_Approved') NOT NULL,
	primary key(Serial_number),
	constraint fk_Username
		foreign key(Username) references Users(Username)
		ON DELETE RESTRICT ON UPDATE CASCADE,
	constraint fk_ISBN
		foreign key(ISBN) references Books(ISBN)
		ON DELETE RESTRICT ON UPDATE CASCADE
)
engine = InnoDB;

create table if not exists Lending (
	Serial_number int NOT NULL AUTO_INCREMENT,
	Making_date timestamp not null default CURRENT_TIMESTAMP,
	Expiration_date timestamp not null default timestampadd(DAY, 7, Making_date) CHECK (timestampdiff(DAY, Making_date, Expiration_date)=7),
	Username Varchar(30) NOT NULL UNIQUE,
	Return_status enum('Returned', 'Not_Returned') not null,
	ISBN Varchar(30) NOT NULL UNIQUE,
	primary key(Serial_number),
	constraint fk_Lending_User
	          foreign key (Username)
	          references Users (Username)
	          ON DELETE RESTRICT ON UPDATE CASCADE,
	constraint fk_Lending_ISBN
	          foreign key (ISBN)
	          references Books(ISBN)
	          ON DELETE RESTRICT ON UPDATE CASCADE
)
engine = InnoDB;

create table if not exists Booking (
	Serial_number int NOT NULL AUTO_INCREMENT,
	Making_date timestamp not null default CURRENT_TIMESTAMP,
	Expiration_date timestamp not null default timestampadd(DAY, 7, Making_date) CHECK (timestampdiff(DAY, Making_date, Expiration_date)=7),
	Username Varchar(30) NOT NULL UNIQUE,
	ISBN Varchar(30) NOT NULL UNIQUE,
	primary key(Serial_number),
	constraint fk_Booking_User
	          foreign key (Username)
	          references Users (Username)
	          ON DELETE RESTRICT ON UPDATE CASCADE,
	constraint fk_Booking_ISBN
	          foreign key (ISBN)
	          references Books(ISBN) 
	          ON DELETE RESTRICT ON UPDATE CASCADE
)
engine = InnoDB;

