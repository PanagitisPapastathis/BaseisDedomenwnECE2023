DELIMITER //
CREATE EVENT IF NOT EXISTS Delete_Expired_Bookings
ON SCHEDULE EVERY 1 DAY
STARTS CURRENT_DATE
DO 
BEGIN
  DELETE FROM Booking 
  WHERE Making_date <= DATE_SUB(CURRENT_DATE, INTERVAL 7 DAY) 
  AND Status = 'Active'; // osa den einai active den theloun svhsimo, to trigger apo ta copies tha ta kanei active (hopefully)
END//
DELIMITER ;
