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

create table if not exists Copies( #SOSOSOSOSOSOSOSOSOSOSOSOSOSOSOSOS !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
  ISBN varchar(30) not null,
  No_of_copies int DEFAULT 1,
  School_Name varchar(30) not null, # DEN YPHRXE PRIN !!!!!!!!!!!!!!!!!!!!!!!!!!!!!
  Available_copies int DEFAULT 1,
  primary key (ISBN, School_Name), 
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
    CHECK (Available_copies >= 0)
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
	Books_Lended Integer not null default 0,
	Books_Owed Integer not null default 0,
	School_Name Varchar(30) not null,
	Registration_Date timestamp,
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
	primary key (Author_id, ISBN), # !!!!!!!!!!!!!!!!!!!!!!!!!!!
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
	Subject_id Integer AUTO_INCREMENT not null, # !!!!!!!!!!!!!!!!!!!!!!!!!!!
	Subject_name varchar(30) not null,
	primary key(Subject_id)
)
engine = InnoDB;

create table if not exists Book_Subject(
	Subject_id INTEGER not null, # !!!!!!!!!!!!!!!!!!!!!!!!!!!
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
	Serial_Number Integer AUTO_INCREMENT not null, # !!!!!!!!!!!!!!!!!!!!!!!!!!!
	Review longtext not null,
	Username Varchar(30) not null,
	Post_Date timestamp,
	Last_Update timestamp, #gamw to spitaki mou
	ISBN Varchar(30),
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
	Making_date timestamp not null default CURRENT_DATE,
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
		AND Making_date >= DATE_SUB(CURRENT_DATE, INTERVAL 7 DAY)
	);

	IF lending_count >= 2 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'Maximum number of lendings reached for this user in one week.';
	ELSE
	  UPDATE Users
	     SET Books_Lended = Books_Lended + 1
	     WHERE Username = NEW.Username;
	END IF;
	
END //

DELIMITER ;

DELIMITER ;

DELIMITER //
CREATE TRIGGER IF NOT EXISTS trg_Overdue_Lending_Lending
BEFORE INSERT ON Lending
FOR EACH ROW
BEGIN
  IF (SELECT COUNT(*) FROM Lending WHERE Username = NEW.Username
    AND Making_date >= DATE_SUB(CURRENT_DATE, INTERVAL 7 DAY)) > 0 THEN
    SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'User has an overdue lending.';
  END IF;
END //

DELIMITER ;

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

DELIMITER //
CREATE TRIGGER IF NOT EXISTS trg_Overdue_Lending_Booking
BEFORE INSERT ON Booking
FOR EACH ROW
BEGIN
  IF (SELECT COUNT(*) FROM Lending WHERE Username = NEW.Username
    AND Making_date >= DATE_SUB(CURRENT_DATE, INTERVAL 7 DAY)) > 0 THEN
    SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'User has an overdue lending.';
  END IF;
END //

DELIMITER ;

DELIMITER // 
CREATE TRIGGER IF NOT EXISTS trg_Booking_to_Lending
AFTER UPDATE ON Booking
FOR EACH ROW
BEGIN
    IF NEW.Status = 'Accepted' AND OLD.Status = 'Pending' THEN
        INSERT INTO Lending (Username, ISBN)
        VALUES (NEW.Username, NEW.ISBN);
    END IF;
END //

DELIMITER ;

DELIMITER // 
CREATE TRIGGER IF NOT EXISTS trg_Copies_Lendings
BEFORE UPDATE ON Lending
FOR EACH ROW
BEGIN
    DECLARE scl varchar(30);
    DECLARE isbnnn varchar(30);

    SELECT School_Name INTO scl FROM Users Where Username = NEW.Username;
    SET isbnnn = NEW.ISBN;
    
    IF (SELECT Available_copies FROM Copies WHERE School_Name=Scl
      AND ISBN=isbnnn) > 0 THEN
      UPDATE Copies SET Available_copies = Available_copies -1
      WHERE School_Name=Scl AND ISBN=isbnnn;
    ELSE 
      SIGNAL SQLSTATE '45000'
		  SET MESSAGE_TEXT = 'No Available copies.';
    END IF;
END //

DELIMITER // 
CREATE TRIGGER IF NOT EXISTS trg_Copies_Bookings
BEFORE UPDATE ON Booking
FOR EACH ROW
BEGIN
    DECLARE scl varchar(30);
    DECLARE isbnnn varchar(30);

    SELECT School_Name INTO scl FROM Users Where Username = NEW.Username;
    SET isbnnn = NEW.ISBN;
    
    IF (SELECT Available_copies FROM Copies WHERE School_Name=Scl
      AND ISBN=isbnnn) > 0 THEN
      UPDATE Copies SET Available_copies = Available_copies -1
      WHERE School_Name=Scl AND ISBN=isbnnn;
    ELSE 
      SIGNAL SQLSTATE '45000'
		  SET MESSAGE_TEXT = 'No Available copies.';
    END IF;
END //

DELIMITER ;
