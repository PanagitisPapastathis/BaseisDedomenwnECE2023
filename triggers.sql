create table if not exists School (
	Name Varchar(50) not null,
	Address Varchar(30) not null,
	Postal_code Varchar(10) not null,
	City Varchar(30) not null, #Integer -> Varchar
	Phone_number Varchar(15) not null,
	Email Varchar(60) not null,
	Headmaster_name Varchar(50) not null,
	#to admin name svhsthke
	primary key (Name)
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

#sta books na valoume index gia to isbn

create table if not exists Copies(
	Copy_id Integer Unsigned AUTO_INCREMENT,
	ISBN Varchar(30) not null,
	No_of_copies Integer Unsigned not null,
	Available_copies Integer Unsigned, #trigger on insert na ginei iso me to number of copies
	School_Name Varchar(50) not null,
	primary key (Copy_id),  #gia eukolia sta updates
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
engine = InnoDB; #Na ftiaxtei ena stored procedure gia otan ginetai insert an yparxei hdh apla na auksanetai

#ALTER TABLE Copies na mpainei apo default  to available  copies otan ginetai insert

create table if not exists Publisher(
	Publisher_id Integer Unsigned AUTO_INCREMENT,
	Name Varchar(30) not null,
	primary key(Publisher_id)
)
engine = InnoDB;

create table if not exists Book_Publisher(
	Publisher_id Integer Unsigned not null,
	ISBN Varchar(30) not null,
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


create table if not exists Users (#mallon oi users den tha prepei na mporoun na diagrafoun alla mono na ginoun deactivated
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
	primary key (ISBN,Author_id), # !!!!!!!!!!!!!!!!!!!!!!
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
	Subject_id Integer Unsigned AUTO_INCREMENT, # pali ligo apsyxologhto
	Subject_name Varchar(30) not null,
	primary key(Subject_id)
)
engine = InnoDB;

create table if not exists Book_Subject(
	Subject_id Integer Unsigned not null, # !!!!!!!!!!!!!!!!!!!!!!!!!!!
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
	Rating Integer Unsigned not null, ################################################ TO XAME KSEXASEI !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
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
	Copy_id Integer Unsigned not null,\
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
		on delete restrict # restrict omws mono ama xrwstaei alliws apla menei opws einai xwris na diagrafetai
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
	Status enum('Pending', 'Active') default 'Pending', #na mpei trigger on insert na elegxei thn diathesimothta  
	primary key(Username, Copy_id),
	constraint fk_Booking_User
		foreign key (Username)
		references Users (Username)
		on delete cascade
		on update cascade,
	constraint fk_Booking_Copy_id
		foreign key (Copy_id)
		references Copies(Copy_id)
		on delete cascade
		on update cascade
)
engine = InnoDB;




DELIMITER //

CREATE TRIGGER if not exists trg_Lending_Insert
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
		SET MESSAGE_TEXT = 'Maximum number of lendings reached for this user in one week for this user.';
	ELSE
	  UPDATE Users
	     SET Books_Lended = Books_Lended + 1
	     WHERE Username = NEW.Username;
	END IF;
	
END //

DELIMITER ;

DELIMITER //

CREATE TRIGGER IF NOT EXISTS trg_Lending_With_Overdue_Lending
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

DELIMITER //

CREATE TRIGGER IF NOT EXISTS trg_Booking_With_Overdue_Lending
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
        INSERT INTO Lending (Username, Copy_id) VALUES (NEW.Username, NEW.Copy_id);
        DELETE FROM Booking WHERE Username = NEW.Username AND Copy_id = New.Copy_id;
    END IF;
END //

DELIMITER ;

DELIMITER // 
CREATE TRIGGER IF NOT EXISTS trg_Copies_Lendings
BEFORE INSERT ON Lending
FOR EACH ROW
BEGIN
    IF (SELECT Available_copies FROM Copies WHERE Copy_id = NEW.Copy_id) > 0 THEN
      UPDATE Copies SET Available_copies = Available_copies -1
      WHERE School_Name=Scl AND ISBN=isbnnn;
    ELSE 
      SIGNAL SQLSTATE '45000'
		  SET MESSAGE_TEXT = 'No Available copies.';
    END IF;
END //

DELIMITER // 
CREATE TRIGGER IF NOT EXISTS trg_Copies_Bookings
BEFORE INSERT ON Booking
FOR EACH ROW
BEGIN
    DECLARE scl varchar(30);
    DECLARE isbnnn varchar(30);
    
    IF (SELECT Available_copies FROM Copies WHERE Copy_id = NEW.Copy_id) > 0 THEN
      UPDATE Copies SET Available_copies = Available_copies -1
      WHERE School_Name=Scl AND ISBN=isbnnn;
    ELSE 
      SIGNAL SQLSTATE '45000'
		  SET MESSAGE_TEXT = 'No Available copies.';
    END IF;
END //

DELIMITER ;

DELIMITER //

CREATE TRIGGER IF NOT EXISTS trg_Users_Status_Updates
BEFORE UPDATE ON Users
FOR EACH ROW
BEGIN
  IF OLD.Status = 'Administrator' THEN
    IF (SELECT COUNT(*) FROM Users WHERE School_Name = OLD.School_Name AND Status = 'Administrator') = 1 THEN
      SIGNAL SQLSTATE '45000'
      SET MESSAGE_TEXT = 'Error on update: School has no other administrators';
    END IF;
  END IF;
  
  IF OLD.Status = 'Central Administrator' THEN
    IF (SELECT COUNT(*) FROM Users WHERE Status = 'Central Administrator') = 1 THEN
      SIGNAL SQLSTATE '45000'
      SET MESSAGE_TEXT = 'Error on update: No other central administrators';
    END IF;
  END IF;
  
  IF NOT OLD.Status = 'Student' AND NEW.Status = 'Student' THEN
    SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'Error on update: Cannot change status to student';
  END IF;
END//

DELIMITER ;

DELIMITER //

CREATE TRIGGER IF NOT EXISTS trg_User_Deletions
BEFORE DELETE ON Users
FOR EACH ROW
BEGIN
  IF OLD.Status = 'Administrator' THEN
    IF (SELECT COUNT(*) FROM Users WHERE School_Name = OLD.School_Name AND Status = 'Administrator') = 1 THEN
      SIGNAL SQLSTATE '45000'
      SET MESSAGE_TEXT = 'Error on delete: School has no other administrators';
    END IF;
  END IF;
  
  IF OLD.Status = 'Central Administrator' THEN
    IF (SELECT COUNT(*) FROM Users WHERE Status = 'Central Administrator') = 1 THEN
      SIGNAL SQLSTATE '45000'
      SET MESSAGE_TEXT = 'Error on delete: No other central administrators';
    END IF;
  END IF;
END//

DELIMITER ;

DELIMITER //

CREATE TRIGGER IF NOT EXISTS trg_Last_Update_Reviews
BEFORE UPDATE ON Reviews
FOR EACH ROW
BEGIN
	IF NOT OLD.Review = NEW.Review THEN
		SET NEW.Last_Update = CURRENT_TIMESTAMP;
		IF (SELECT Status FROM Users WHERE Username = NEW.Username) = 'Student' THEN
			SET NEW.Status = 'Pending';
		END IF;
		SET NEW.Last_Update = CURRENT_TIMESTAMP;
	END IF;
END//

DELIMITER ;

DELIMITER //

CREATE TRIGGER IF NOT EXISTS trg_User_suspended_or_banned ################################### PITHANWS AXRHSTO
BEFORE UPDATE ON Users
FOR EACH ROW
BEGIN
	IF NEW.Status2 = 'Suspended' THEN
		UPDATE Reviews SET Status = 'Removed' WHERE Username = OLD.Username;
	END IF;
END//

DELIMITER ;

DELIMITER //

CREATE TRIGGER IF NOT EXISTS trg_set_available_copies 
BEFORE INSERT ON Copies
FOR EACH ROW
BEGIN
	SET NEW.Available_copies = NEW.No_of_copies;
END//

DELIMITER ;

DELIMITER //

#SET GLOBAL event_scheduler = ON;

CREATE EVENT IF NOT EXISTS delete_expired_bookings
ON SCHEDULE EVERY 1 DAY
STARTS CURRENT_DATE
DO 
BEGIN
    DELETE FROM Booking
    WHERE Making_date <= DATE_SUB(CURRENT_DATE, INTERVAL 7 DAY);
END//

DELIMITER ;
