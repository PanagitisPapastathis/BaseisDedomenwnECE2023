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
	Title varchar(100) not null,
	Summary text not null,
	No_pages integer not null,
	Image BLOB not null not null,
	Book_language varchar(30) not null,
	Key_words text not null,
	primary key(ISBN)
)
engine = InnoDB;

#sta books na valoume index gia ton titlo

create table if not exists Copies( #SOSOSOSOSOSOSOSOSOSOSOSOSOSOSOSOS !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
  Copy_id Integer AUTO_INCREMENT, #!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!1
  ISBN varchar(30) not null,
  No_of_copies int DEFAULT 1,
  School_Name varchar(30) not null, # DEN YPHRXE PRIN !!!!!!!!!!!!!!!!!!!!!!!!!!!!!
  Available_copies int DEFAULT 1,
  primary key (Copy_id), 
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
  constraint total_copies_non_negative
    CHECK (No_of_copies >= 0),
  constraint available_copies_non_negative
    CHECK (Available_copies >= 0),
  constraint available_less_than_total
    CHECK (Available_copies >= No_of_copies)
)
engine = InnoDB;

create table if not exists Publisher(
	Publisher_id Integer AUTO_INCREMENT, # !!!!!!!!!!!!!!!!!!!!!!!!!!
	Name varchar(30) not null,
	primary key(Publisher_id)
)
engine = InnoDB;

create table if not exists Book_Publisher(
	Publisher_id Integer AUTO_INCREMENT not null, # !!!!!!!!!!!!!!!!!!!!!!!
	ISBN varchar(30) not null,
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
	Status Enum ('Student', 'Personnel', 'Admin', 'Central Admin', 'Suspended', 'Banned') not null, #!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	Phone_number Integer not null,
	Email Varchar(30) not null,
	Books_Lended Integer not null default 0,
	Books_Owed Integer not null default 0,
	School_Name Varchar(30) not null,
	Registration_Date timestamp default CURRENT_TIMESTAMP,
	Last_Update timestamp default CURRENT_TIMESTAMP,
	primary key(Username)
)
engine = InnoDB;

create table if not exists Author(
	Author_id Integer AUTO_INCREMENT, # !!!!!!!!!!!!!!!!!!!!!!!!!!!
	Name varchar(30) not null,
	primary key(Author_id)
)
engine = InnoDB;

create table if not exists Book_Author(
	Author_id Integer not null, # !!!!!!!!!!!!!!!!!!!!!!!!!!!
	ISBN varchar(30) not null,
	primary key (ISBN,Author_id), # !!!!!!!!!!!!!!!!!!!!!!!!!!!
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
	Subject_id Integer AUTO_INCREMENT, # !!!!!!!!!!!!!!!!!!!!!!!!!!!
	Subject_name varchar(30) not null,
	primary key(Subject_id)
)
engine = InnoDB;

create table if not exists Book_Subject(
	Subject_id INTEGER not null, # !!!!!!!!!!!!!!!!!!!!!!!!!!!
	ISBN varchar(30) not null,
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

create table if not exists Reviews (
	Serial_Number Integer AUTO_INCREMENT not null, # !!!!!!!!!!!!!!!!!!!!!!!!!!!
	Review longtext not null,
	Username Varchar(30) not null,
	Post_Date timestamp,
	Last_Update timestamp default CURRENT_TIMESTAMP, #gamw to spitaki mou
	ISBN Varchar(30),
	Status ENUM ('Pending', 'Accepted', 'Deleted', 'Removed'),
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
	Serial_number Integer AUTO_INCREMENT not null, # !!!!!!!!!!!!!!!!!!!!!!!!!!!
	Making_date date not null default CURRENT_DATE, #!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! timestamp -> date
	Username Varchar(30) not null,
	Return_status ENUM('Owed', 'Returned') default 'Owed',
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

create table if not exists Booking (
	Serial_number Integer AUTO_INCREMENT not null, # !!!!!!!!!!!!!!!!!!!!!!!!!!!
	Making_date date not null default CURRENT_DATE,
	Username Varchar(30) not null,
	ISBN Varchar(30) not null,
	Status enum('Pending', 'Accepted', 'Aborted', 'Denied') default 'Pending',
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