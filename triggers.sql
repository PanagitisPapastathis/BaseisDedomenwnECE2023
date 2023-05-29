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
		SET MESSAGE_TEXT = 'Maximum number of lendings reached for this user in one week.';
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
        INSERT INTO Lending (Username, ISBN)
        VALUES (NEW.Username, NEW.ISBN);
    END IF;
END //

DELIMITER ;

DELIMITER // 
CREATE TRIGGER IF NOT EXISTS trg_Copies_Lendings
BEFORE INSERT ON Lending
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
BEFORE INSERT ON Booking
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

CREATE TRIGGER IF NOT EXISTS trg_User_suspended_or_banned
BEFORE UPDATE ON Users
FOR EACH ROW
BEGIN
	IF NEW.Status = 'Suspended' THEN
		UPDATE Reviews SET Status = 'Pending' WHERE Username = OLD.Username;
	END IF;
	IF NEW.Status = 'Banned' THEN
		DELETE FROM Reviews WHERE Username = OLD.Username;
	END IF;
END//

DELIMITER ;

DELIMITER //

CREATE TRIGGER delete_expired_bookings
AFTER INSERT ON Booking
FOR EACH ROW
BEGIN
    DECLARE expired_date DATE;
    SET expired_date = DATE_SUB(NEW.Making_date, INTERVAL 1 WEEK);
    
    DELETE FROM Booking
    WHERE Making_date <= expired_date;
END;

DELIMITER;
