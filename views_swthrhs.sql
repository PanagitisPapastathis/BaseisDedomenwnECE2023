DROP VIEW IF EXISTS Lending_Help;
DROP VIEW IF EXISTS Lending_Help2;
DROP VIEW IF EXISTS Booking_Help;

CREATE VIEW Lending_Help AS
SELECT Users.Username, Users.First_Name, Users.Last_Name, Books.Title, Copies.ISBN, Lending.Making_Date, Copies.Copy_id
FROM Books
JOIN Copies ON Books.ISBN = Copies.ISBN
JOIN Lending ON Copies.Copy_id = Lending.Copy_id AND Lending.Return_status = 'Owed'
JOIN Users ON Lending.Username = Users.Username;

CREATE VIEW Lending_Help2 AS
SELECT Users.Username, Users.First_Name, Users.Last_Name, Books.Title, Copies.ISBN, Lending.Making_Date, Copies.Copy_id
FROM Books
JOIN Copies ON Books.ISBN = Copies.ISBN
JOIN Lending ON Copies.Copy_id = Lending.Copy_id AND Lending.Return_status = 'Returned'
JOIN Users ON Lending.Username = Users.Username;

CREATE VIEW Booking_Help AS
SELECT Users.Username, Users.First_Name, Users.Last_Name, Books.Title, Copies.ISBN, Booking.Making_Date, Copies.Copy_id
FROM Books
JOIN Copies ON Books.ISBN = Copies.ISBN
JOIN Booking ON Copies.Copy_id = Booking.Copy_id
JOIN Users ON Booking.Username = Users.Username;
