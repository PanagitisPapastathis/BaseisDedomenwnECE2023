DELIMITER $$

CREATE TRIGGER trg_central_admin
BEFORE INSERT ON Users
FOR EACH ROW
BEGIN
    IF NEW.Status = 'Central Admin' THEN
        IF (SELECT COUNT(*) FROM Users WHERE Status = 'Central Admin') > 0 THEN
            SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'There can only be one Central Admin';
        END IF;
    END IF;
END; $$

CREATE TRIGGER trg_school_admin
BEFORE INSERT ON Users
FOR EACH ROW
BEGIN
    IF NEW.Status = 'Admin' THEN
        IF (SELECT COUNT(*) FROM Users WHERE Status = 'Admin' AND School_Name = NEW.School_Name) > 0 THEN
            SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'There can only be one Admin per School';
        END IF;
    END IF;
END; $$

DELIMITER ;
