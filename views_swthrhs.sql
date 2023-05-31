DROP VIEW IF EXISTS Lending_Help;
DROP VIEW IF EXISTS Lending_Help2;
DROP VIEW IF EXISTS Booking_Help;
DROP VIEW IF EXISTS Accept_Reviews_Help;

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

CREATE VIEW IF NOT EXISTS Accept_Reviews_Help AS
SELECT Users.Username, Users.First_Name, Users.Last_Name, Books.Title, Reviews.ISBN, Reviews.Post_Date, Reviews.Serial_Number, Reviews.Review, Reviews.Status
FROM Reviews
JOIN Users ON Reviews.Username = Users.Username 
JOIN Books ON Reviews.ISBN = Books.ISBN


