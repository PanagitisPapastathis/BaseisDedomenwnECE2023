SELECT a.Name AS AuthorName, COUNT(ba.ISBN) AS NumberOfBooks
FROM Author a
JOIN Book_Author ba ON a.Author_id = ba.Author_id
GROUP BY a.Name;

SELECT sb.Subject_name, COUNT(r.Serial_Number) 
FROM Subject AS sb 
JOIN Book_Subject AS bs ON sb.Subject_id = bs.Subject_id
JOIN Reviews AS r ON bs.ISBN = r.ISBN
GROUP BY sb.Subject_name;

CREATE VIEW IF NOT EXISTS Admin_Lendings_count AS
SELECT User.Username, COUNT(Lending.Serial_number) AS No_of_Lendings
FROM Users JOIN Lending ON Users.Username = Lending.Approved_by
GROUP BY Users.Username
HAVING No_of_Lendings>=22;

SELECT adm1.Username AS adm1_Username, adm2.Username AS adm2_Username, adm1.No_of_Lendings
FROM Admin_Lendings_count AS adm1 JOIN Admin_Lendings_count AS adm2
ON adm1.No_of_Lendings = adm2.No_of_Lendings AND adm1.Username < adm2.Username;
