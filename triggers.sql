
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
    AND Making_date >= DATE_SUB(CURRENT_DATE, INTERVAL 7 DAY) AND Status='Owed') > 0 THEN
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
    IF NEW.Status = 'Active' AND OLD.Status = 'Pending' THEN
        INSERT INTO Lending (Making_date, Username, Copy_id, Return_status) VALUES (CURRENT_DATE, NEW.Username, NEW.Copy_id, 'Owed');
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
      WHERE Copy_id=NEW.Copy_id;
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
