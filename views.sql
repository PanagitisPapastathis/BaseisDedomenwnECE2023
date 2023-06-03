drop view if exists Book_info;
drop view if exists BookDetails;
drop view if exists SubjectISBNTitleSchoolView;
drop view if exists Book_info_small;
drop view if exists School_info;
drop view if exists Book_info_small;
drop view if exists Lending_so_far;
drop view if exists Dual_Subject_Books;
drop view if exists Admin_Lendings_count;

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
SELECT B.*, A.Name AS AuthorName, C.School_Name, P.Name AS PublisherName,
CASE WHEN C.Available_copies > 0 THEN 'available' ELSE 'not available' END AS av_c,
GROUP_CONCAT(S.subject_name SEPARATOR ', ') AS SubjectNames
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
SELECT B.Title, B.ISBN, A.Name AS AuthorName, C.School_Name,
GROUP_CONCAT(S.subject_name SEPARATOR ', ') AS SubjectNames
FROM Books B
JOIN Book_Author BA ON B.ISBN = BA.ISBN
JOIN Author A ON BA.Author_id = A.Author_id
JOIN Copies C ON B.ISBN = C.ISBN
JOIN Book_Subject BS ON B.ISBN = BS.ISBN
JOIN Subject S ON BS.Subject_id = S.Subject_id
GROUP BY B.Title, A.Name, B.ISBN;

CREATE VIEW if not exists School_info AS
SELECT s.*, u.Username AS AdminName
FROM School AS s
JOIN Users AS u ON s.Name = u.School_Name 
WHERE u.Status = 'Admin';


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
SELECT Users.Username, Users.First_Name, Users.Last_Name, Books.Title, Reviews.ISBN, Reviews.Post_Date, Reviews.Review, Reviews.Status
FROM Reviews
JOIN Users ON Reviews.Username = Users.Username 
JOIN Books ON Reviews.ISBN = Books.ISBN


