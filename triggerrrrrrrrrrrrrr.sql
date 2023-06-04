DROP TRIGGER IF EXISTS trg_Lending_Insert;
DROP TRIGGER IF EXISTS trg_Lending_With_Overdue_Lending;
DROP TRIGGER IF EXISTS trg_Booking_With_Overdue_Lending;
DROP TRIGGER IF EXISTS trg_Lending_with_pending_booking;
DROP TRIGGER IF EXISTS trg_Copies_Lendings;
DROP TRIGGER IF EXISTS trg_Copies_Bookings;
DROP TRIGGER IF EXISTS trg_Users_Status_Updates;
DROP TRIGGER IF EXISTS trg_User_Deletions;
DROP TRIGGER IF EXISTS trg_Last_Update_Reviews;
DROP TRIGGER IF EXISTS trg_User_suspended_or_banned;
DROP TRIGGER IF EXISTS trg_set_available_copies;
DROP TRIGGER IF EXISTS trg_Lending_Approved_by;

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
CREATE TRIGGER IF NOT EXISTS trg_Lending_with_pending_booking
BEFORE INSERT ON Lending
FOR EACH ROW
BEGIN
	DELETE FROM Booking WHERE Username = NEW.Username AND Copy_id = New.Copy_id;
END //
DELIMITER ;


DELIMITER // 
CREATE TRIGGER IF NOT EXISTS trg_Lending_Approved_by
BEFORE INSERT ON Lending
FOR EACH ROW
BEGIN
	SET NEW.Approved_by = (SELECT Username From Users WHERE School_Name = (SELECT School_Name FROM Copies WHERE Copy_id = NEW.Copy_id LIMIT 1) LIMIT 1);
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

CREATE TRIGGER IF NOT EXISTS trg_Users_Status_Updates
BEFORE UPDATE ON Users
FOR EACH ROW
BEGIN
  IF OLD.Status = 'Admin' THEN
    IF (SELECT COUNT(*) FROM Users WHERE School_Name = OLD.School_Name AND Status = 'Admin') = 1 THEN
      SIGNAL SQLSTATE '45000'
      SET MESSAGE_TEXT = 'Error on update: School has no other administrators';
    END IF;
  END IF;
  
  IF OLD.Status = 'Central Admin' THEN
    IF (SELECT COUNT(*) FROM Users WHERE Status = 'Central Admin') = 1 THEN
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

