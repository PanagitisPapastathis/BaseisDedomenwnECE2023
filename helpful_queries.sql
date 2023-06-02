SELECT a.Name AS AuthorName, COUNT(ba.ISBN) AS NumberOfBooks
FROM Author a
JOIN Book_Author ba ON a.Author_id = ba.Author_id
GROUP BY a.Name;

SELECT sb.Subject_name, COUNT(r.Serial_Number) 
FROM Subject AS sb 
JOIN Book_Subject AS bs ON sb.Subject_id = bs.Subject_id
JOIN Reviews AS r ON bs.ISBN = r.ISBN
GROUP BY sb.Subject_name;
