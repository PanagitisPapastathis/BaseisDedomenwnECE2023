#3.1.3
SELECT usr.Username, usr.First_Name, usr.Last_Name, Count(lnd.Serial_number) AS Books_Lended, usr.Birth_Date
FROM Users AS usr 
JOIN Lending AS lnd ON usr.Username = lnd.Username
WHERE usr.Birth_Date <= CURRENT_DATE - INTERVAL 40 YEAR
GROUP BY usr.Username, usr.First_Name, usr.Last_Name, usr.Birth_Date
ORDER BY Books_Lended DESC;

#3.1.4 leitourgei alla den katalavainw apolyta ti kanei to left join
SELECT Author_id FROM Author WHERE Author_id NOT IN 
    (SELECT DISTINCT Author.Author_id FROM Author
    JOIN Book_Author ON Author.Author_id = Book_Author.Author_id
    JOIN Copies ON Copies.ISBN = Book_Author.ISBN
    JOIN Lending ON Copies.Copy_id = Lending.Copy_id);

#3.1.5 to mono pou den exei testaristei einai auto
CREATE VIEW IF NOT EXISTS Admin_Lendings_count AS
SELECT User.Username, COUNT(Lending.Serial_number) AS No_of_Lendings
FROM Users JOIN Lending ON Users.Username = Lending.Approved_by
GROUP BY Users.Username
HAVING No_of_Lendings>=22;

SELECT adm1.Username AS adm1_Username, adm2.Username AS adm2_Username, adm1.No_of_Lendings
FROM Admin_Lendings_count AS adm1 JOIN Admin_Lendings_count AS adm2
ON adm1.No_of_Lendings = adm2.No_of_Lendings AND adm1.Username < adm2.Username;

#3.1.6 mallon einai ok dld kai to gpt 4 to egkrinei
CREATE VIEW IF NOT EXISTS Dual_Subject_Books AS
SELECT bs1.ISBN, s1.Subject_name as subject1, s2.Subject_name as subject2 
FROM Book_Subject bs1 
JOIN Book_Subject bs2 ON bs1.ISBN = bs2.ISBN AND bs1.Subject_id < bs2.Subject_id
JOIN Subject s1 ON bs1.Subject_id = s1.Subject_id
JOIN Subject s2 ON bs2.Subject_id = s2.Subject_id;

SELECT dsb.subject1, dsb.subject2, COUNT(ld.Serial_number) AS No_of_Lendings 
FROM Dual_Subject_Books dsb
JOIN Copies cp ON dsb.ISBN = cp.ISBN 
JOIN Lending ld ON cp.Copy_id = ld.Copy_id
GROUP BY dsb.subject1, dsb.subject2
ORDER BY No_of_Lendings DESC
LIMIT 3; #trexei sto dbeaver alla oxi sto vscode

#3.1.7
SELECT a.Name, COUNT(ba.ISBN) AS num_books FROM Author a JOIN Book_Author ba
ON a.Author_id = ba.Author_id
GROUP BY a.Author_id
HAVING num_books >= (SELECT MAX(num_books) - 5 FROM (
    SELECT COUNT(ba.ISBN) AS num_books
    FROM Book_Author ba
    GROUP BY ba.Author_id) subquery)
ORDER BY num_books DESC;