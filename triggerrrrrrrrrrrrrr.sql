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

CREATE TRIGGER IF NOT EXISTS trg_copies_update_pending_booking
BEFORE UPDATE ON Copies
FOR EACH ROW
BEGIN
  IF NOT NEW.No_of_copies = OLD.No_of_copies THEN
    SET NEW.Available_copies = OLD.Available_copies + (NEW.No_of_copies - OLD.No_of_copies);
  END IF;
END//

DELIMITER ;

DELIMITER //

CREATE TRIGGER IF NOT EXISTS trg_copies_update_pending_booking
AFTER UPDATE ON Copies
FOR EACH ROW
BEGIN
  IF NEW.Available_copies > OLD.Available_copies THEN
    UPDATE Booking SET Status = 'Active', Making_date = CURRENT_DATE
    WHERE Copy_id = (SELECT Copy_id FROM Booking
      WHERE School_Name = OLD.School_Name AND Status = 'Pending'
      ORDER BY Making_date LIMIT 1);
  END IF;
END//

DELIMITER ;
