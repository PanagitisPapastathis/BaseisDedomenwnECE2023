-- Drop Tables
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

-- Drop Triggers
DROP TRIGGER IF EXISTS trg_Lending_Insert;
DROP TRIGGER IF EXISTS trg_Lending_With_Overdue_Lending;
DROP TRIGGER IF EXISTS trg_Booking_With_Overdue_Lending;
DROP TRIGGER IF EXISTS trg_Booking_to_Lending;
DROP TRIGGER IF EXISTS trg_Copies_Lendings;
DROP TRIGGER IF EXISTS trg_Copies_Bookings;
DROP TRIGGER IF EXISTS trg_Users_Status_Updates;
DROP TRIGGER IF EXISTS trg_User_Deletions;
DROP TRIGGER IF EXISTS trg_Last_Update_Reviews;
DROP TRIGGER IF EXISTS trg_User_suspended_or_banned;
