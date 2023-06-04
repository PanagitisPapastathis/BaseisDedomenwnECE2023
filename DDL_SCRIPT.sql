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


drop view if exists Book_info;
drop view if exists BookDetails;
drop view if exists SubjectISBNTitleSchoolView;
drop view if exists Book_info_small;
drop view if exists School_info;
drop view if exists Book_info_small;
drop view if exists Lending_so_far;
drop view if exists Dual_Subject_Books;
drop view if exists Admin_Lendings_count;
DROP VIEW IF EXISTS Lending_Help;
DROP VIEW IF EXISTS Lending_Help2;
DROP VIEW IF EXISTS Booking_Help;
DROP VIEW IF EXISTS Accept_Reviews_Help;
DROP VIEW IF EXISTS Admin_query;

create view if not exists Admin_query as select u.Username, u.First_Name, u.Last_Name, r.ISBN, r.Rating, u.School_Name from Users as u inner join Reviews as r on u.Username=r.Username;

CREATE VIEW IF NOT EXISTS Admin_Lendings_count AS
SELECT Users.Username, COUNT(Lending.Serial_number) AS No_of_Lendings
FROM Users JOIN Lending ON Users.Username = Lending.Approved_by
GROUP BY Users.Username
HAVING No_of_Lendings>=22;
                        
CREATE VIEW IF NOT EXISTS Dual_Subject_Books AS
SELECT bs1.ISBN, s1.Subject_name as subject1, s2.Subject_name as subject2 
FROM Book_Subject bs1 
JOIN Book_Subject bs2 ON bs1.ISBN = bs2.ISBN AND bs1.Subject_id < bs2.Subject_id
JOIN Subject s1 ON bs1.Subject_id = s1.Subject_id
JOIN Subject s2 ON bs2.Subject_id = s2.Subject_id;

create view if not exists Lending_so_far as
select l.*, c.ISBN, b.Title
from Lending as l
join Copies as c on l.Copy_id = c.Copy_id 
join Books as b on c.ISBN = b.ISBN 
order by Making_date;


CREATE VIEW if not exists Book_info AS
SELECT B.*, C.School_Name, P.Name AS PublisherName,
CASE WHEN C.Available_copies > 0 THEN 'available' ELSE 'not available' END AS av_c,
GROUP_CONCAT(distinct S.subject_name SEPARATOR ', ') AS SubjectNames,
GROUP_CONCAT(distinct A.Name SEPARATOR ', ') AS AuthorName
FROM Books B
JOIN Book_Author BA ON B.ISBN = BA.ISBN
JOIN Author A ON BA.Author_id = A.Author_id
JOIN Book_Publisher BP ON B.ISBN = BP.ISBN
JOIN Publisher P ON BP.Publisher_id = P.Publisher_id
JOIN Copies C ON B.ISBN = C.ISBN
JOIN Book_Subject BS ON B.ISBN = BS.ISBN
JOIN Subject S ON BS.Subject_id = S.Subject_id
GROUP BY B.ISBN;

CREATE VIEW if not exists BookDetails AS
SELECT c.Copy_id, sc.Name AS School_Name, c.No_of_Copies, c.Available_copies, b.ISBN, b.Title, b.Summary, b.Image, p.Name as Publisher_name, b.No_pages, b.Book_language , a.Name as Author_name,  GROUP_CONCAT(DISTINCT s.Subject_name SEPARATOR ', ') AS Subject_Names
FROM Copies c
JOIN School sc ON c.School_Name = sc.name
JOIN Books b ON c.ISBN = b.ISBN
JOIN Book_Author ba ON b.ISBN = ba.ISBN
JOIN Author a ON ba.Author_id = a.Author_id
JOIN Book_Publisher bp ON b.ISBN = bp.ISBN
JOIN Publisher p ON bp.Publisher_id = p.Publisher_id
JOIN Book_Subject bs ON b.ISBN = bs.ISBN
JOIN Subject s ON bs.Subject_id = s.Subject_id
GROUP BY c.Copy_id, sc.Name, c.No_of_Copies, c.Available_copies, b.ISBN, b.Title, b.Summary, b.Image, p.Name, b.No_pages, b.Book_language, a.Name;


CREATE VIEW if not exists SubjectISBNTitleSchoolView AS
SELECT s.Subject_name, b.ISBN, c.School_Name, b.Title
FROM Subject s
JOIN Book_Subject bs on bs.Subject_id  = s.Subject_id  
JOIN Books b ON bs.ISBN  = b.ISBN
JOIN Copies c ON b.ISBN = c.ISBN
GROUP BY s.Subject_name , b.ISBN, b.Title, c.School_Name;


CREATE VIEW if not exists Book_info_small AS
SELECT B.Title, B.ISBN, C.School_Name, C.No_of_copies,
GROUP_CONCAT(S.subject_name SEPARATOR ', ') AS SubjectNames,
GROUP_CONCAT(distinct A.Name SEPARATOR ', ') AS AuthorName
FROM Books B
JOIN Book_Author BA ON B.ISBN = BA.ISBN
JOIN Author A ON BA.Author_id = A.Author_id
JOIN Copies C ON B.ISBN = C.ISBN
JOIN Book_Subject BS ON B.ISBN = BS.ISBN
JOIN Subject S ON BS.Subject_id = S.Subject_id
GROUP BY B.ISBN, C.School_Name;

CREATE VIEW if not exists School_info AS
SELECT s.*, u.Username AS AdminName
FROM School AS s
JOIN Users AS u ON s.Name = u.School_Name 
WHERE u.Status = 'Admin';

CREATE VIEW Lending_Help AS
SELECT Users.Username, Users.First_Name, Users.Last_Name, Books.Title, Copies.ISBN, Lending.Making_Date, Copies.Copy_id, Users.School_name
FROM Books
JOIN Copies ON Books.ISBN = Copies.ISBN
JOIN Lending ON Copies.Copy_id = Lending.Copy_id AND Lending.Return_status = 'Owed'
JOIN Users ON Lending.Username = Users.Username;

CREATE VIEW Lending_Help2 AS
SELECT Users.Username, Users.First_Name, Users.Last_Name, Books.Title, Copies.ISBN, Lending.Making_Date, Copies.Copy_id, Users.School_name
FROM Books
JOIN Copies ON Books.ISBN = Copies.ISBN
JOIN Lending ON Copies.Copy_id = Lending.Copy_id AND Lending.Return_status = 'Returned'
JOIN Users ON Lending.Username = Users.Username;

CREATE VIEW Booking_Help AS
SELECT Users.Username, Users.First_Name, Users.Last_Name, Books.Title, Copies.ISBN, Booking.Making_Date, Copies.Copy_id, Users.School_name
FROM Books
JOIN Copies ON Books.ISBN = Copies.ISBN
JOIN Booking ON Copies.Copy_id = Booking.Copy_id
JOIN Users ON Booking.Username = Users.Username;

CREATE VIEW IF NOT EXISTS Accept_Reviews_Help AS
SELECT Users.Username, Users.First_Name, Users.Last_Name, Books.Title, Reviews.ISBN, Reviews.Post_Date, Reviews.Review, Reviews.Status, Users.School_name
FROM Reviews
JOIN Users ON Reviews.Username = Users.Username 
JOIN Books ON Reviews.ISBN = Books.ISBN;



ALTER TABLE Copies DROP INDEX IF EXISTS idx_copies_isbn;
ALTER TABLE Copies DROP INDEX IF EXISTS idx_copies_school_name;
ALTER TABLE Book_Publisher DROP INDEX IF EXISTS idx_book_publisher_isbn;
ALTER TABLE Users DROP INDEX IF EXISTS idx_user_school_name;
ALTER TABLE Book_Author DROP INDEX IF EXISTS idx_book_author_isbn;
ALTER TABLE Book_Subject DROP INDEX IF EXISTS idx_book_subject_isbn;
ALTER TABLE Reviews DROP INDEX IF EXISTS idx_reviews_username;
ALTER TABLE Reviews DROP INDEX IF EXISTS idx_reviews_isbn;
ALTER TABLE Lending DROP INDEX IF EXISTS idx_lending_username;
ALTER TABLE Booking DROP INDEX IF EXISTS idx_booking_username;


CREATE INDEX idx_copies_isbn ON Copies (ISBN);
CREATE INDEX idx_copies_school_name ON Copies (School_Name);
CREATE INDEX idx_book_publisher_isbn ON Book_Publisher (ISBN);
CREATE INDEX idx_user_school_name ON Users (School_Name);
CREATE INDEX idx_book_author_isbn ON Book_Author (ISBN);
CREATE INDEX idx_book_subject_isbn ON Book_Subject (ISBN);
CREATE INDEX idx_reviews_username ON Reviews (Username);
CREATE INDEX idx_reviews_isbn ON Reviews (ISBN);
CREATE INDEX idx_lending_username ON Lending (Username);
CREATE INDEX idx_booking_username ON Booking (Username);





DROP TRIGGER IF EXISTS trg_Users_Status_Updates;

DROP TRIGGER IF EXISTS trg_User_Deletions;

DROP TRIGGER IF EXISTS trg_Last_Update_Reviews;

DROP TRIGGER IF EXISTS trg_User_suspended_or_banned;

DROP TRIGGER IF EXISTS trg_set_available_copies;

DROP TRIGGER IF EXISTS trg_limit_lendings;

DROP TRIGGER IF EXISTS trg_limit_bookings;

DROP TRIGGER IF EXISTS trg_increment_copies_lending;

DROP TRIGGER IF EXISTS trg_increment_copies_booking;

DROP TRIGGER IF EXISTS trg_copies_update;

DROP TRIGGER IF EXISTS trg_copies_update_pending_booking;


DELIMITER //

CREATE TRIGGER IF NOT EXISTS trg_Users_Status_Updates
BEFORE UPDATE ON Users
FOR EACH ROW
BEGIN
  IF NEW.Status = 'Admin' AND OLD.Status = 'Teacher' THEN
    UPDATE Users SET Status = 'Teacher' WHERE School_Name = NEW.School_Name;
  END IF;
  
  IF OLD.Status = 'Central Admin' AND NOT NEW.Status = 'Central Admin' THEN
      SIGNAL SQLSTATE '45000'
      SET MESSAGE_TEXT = 'Error: Update central admin? You prolly goofed up.';
  END IF;
  
  
END//

DELIMITER ;

DELIMITER //

CREATE TRIGGER IF NOT EXISTS trg_User_Deletions
BEFORE UPDATE  ON Users
FOR EACH ROW
BEGIN
  IF OLD.Status = 'Admin' THEN
    IF (SELECT COUNT(*) FROM Users WHERE School_Name = OLD.School_Name AND Status = 'Admin') = 1 THEN
      SIGNAL SQLSTATE '45000'
      SET MESSAGE_TEXT = 'Error on delete: School has no other administrators';
    END IF;
  END IF;
  
  IF OLD.Status = 'Central Admin' THEN
    IF (SELECT COUNT(*) FROM Users WHERE Status = 'Central Admin') = 1 THEN
      SIGNAL SQLSTATE '45000'
      SET MESSAGE_TEXT = 'Error on delete: No other central admin';
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

CREATE TRIGGER IF NOT EXISTS trg_limit_lendings

BEFORE INSERT ON Lending
FOR EACH ROW
BEGIN

DECLARE lnd INTEGER UNSIGNED;
DECLARE bkng INTEGER UNSIGNED;
DECLARE lim INTEGER UNSIGNED;

SELECT COUNT(*) INTO lnd FROM Lending WHERE Username = NEW.Username AND Return_status = 'Owed';
SELECT COUNT(*) INTO bkng FROM Booking WHERE Username = NEW.Username;

IF (SELECT Status FROM Users WHERE Username = NEW.Username) = 'Student' THEN
	SET lim = 2;
ELSE
	SET lim = 1;
END IF;

IF lnd + bkng >= lim THEN
	SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'Error creating the lending: Too many ledings/bookings in one week';
ELSE
	IF (SELECT Available_copies FROM Copies WHERE Copy_id = NEW.Copy_id) > 0 THEN
      UPDATE Copies SET Available_copies = Available_copies -1
      WHERE Copy_id=NEW.Copy_id;
      DELETE FROM Booking WHERE Username = NEW.Username AND Copy_id = New.Copy_id;
      SET NEW.Approved_by = (SELECT Username From Users WHERE School_Name = (SELECT School_Name FROM Copies WHERE Copy_id = NEW.Copy_id LIMIT 1) LIMIT 1);
    ELSE 
      SIGNAL SQLSTATE '45000'
	  SET MESSAGE_TEXT = 'No Available copies.';
    END IF;
END IF;


END//

DELIMITER ;


DELIMITER //

CREATE TRIGGER IF NOT EXISTS trg_limit_bookings

BEFORE INSERT ON Booking
FOR EACH ROW
BEGIN

DECLARE lnd INTEGER UNSIGNED;
DECLARE bkng INTEGER UNSIGNED;

SELECT COUNT(*) INTO lnd FROM Lending WHERE Username = NEW.Username AND Return_status = 'Owed';
SELECT COUNT(*) INTO bkng FROM Booking WHERE Username = NEW.Username;


IF lnd + bkng >= 2 THEN
	SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'Error creating the booking: Too many lendings/bookings in one week';
ELSE
	IF NOT (SELECT COUNT(*) FROM Lending WHERE Username = NEW.Username AND Copy_id) = 0 THEN
		IF (SELECT Available_copies FROM Copies WHERE Copy_id = NEW.Copy_id) > 0 THEN
	      UPDATE Copies SET Available_copies = Available_copies -1
	      WHERE Copy_id=NEW.Copy_id;
	 	ELSE
	 		SIGNAL SQLSTATE '45000'
    		SET MESSAGE_TEXT = 'Error creating the booking: Too many lendings/bookings in one week';
    	END IF;
    ELSE 
      SET NEW.Status = 'Pending';
    END IF;
END IF;


END//

DELIMITER ;

DELIMITER //

CREATE TRIGGER IF NOT EXISTS trg_increment_copies_lending

AFTER UPDATE ON Lending
FOR EACH ROW
BEGIN

IF NOT OLD.Return_status = NEW.Return_Status AND OLD.Return_status = 'Owed' THEN 
	UPDATE Copies SET Available_copies = Available_copies+1 WHERE Copy_id=NEW.Copy_id;
END IF;
	
END//

DELIMITER ;

DELIMITER //

CREATE TRIGGER IF NOT EXISTS trg_increment_copies_booking

AFTER DELETE ON Booking
FOR EACH ROW
BEGIN

IF OLD.Status = 'Active' THEN 
	UPDATE Copies SET Available_copies = Available_copies+1 WHERE Copy_id=OLD.Copy_id;
END IF;
	
END//

DELIMITER ;	

DELIMITER //

CREATE TRIGGER IF NOT EXISTS trg_copies_update
BEFORE UPDATE ON Copies
FOR EACH ROW
BEGIN
  IF NOT NEW.No_of_copies = OLD.No_of_copies THEN
    SET NEW.Available_copies = OLD.Available_copies + (NEW.No_of_copies - OLD.No_of_copies);
  END IF;
END//

DELIMITER ;

