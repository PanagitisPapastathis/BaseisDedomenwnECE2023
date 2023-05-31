-- Inserting dummy data into Publisher table
INSERT INTO Publisher (Name)
VALUES
    ('Publisher A'),
    ('Publisher B'),
    ('Publisher C'),
    ('Publisher D'),
    ('Publisher E'),
    ('Publisher F'),
    ('Publisher G'),
    ('Publisher H');

-- Inserting dummy data into Author table
INSERT INTO Author (Name)
VALUES
    ('Author A'),
    ('Author B'),
    ('Author C'),
    ('Author D'),
    ('Author E'),
    ('Author F'),
    ('Author G'),
    ('Author H'),
    ('Author I'),
    ('Author J'),
    ('Author K'),
    ('Author L'),
    ('Author M'),
    ('Author N'),
    ('Author O'),
    ('Author P');

-- Inserting dummy data into Subject table
INSERT INTO Subject (Subject_name)
VALUES
    ('Subject A'),
    ('Subject B'),
    ('Subject C'),
    ('Subject D'),
    ('Subject E'),
    ('Subject F');

-- Inserting dummy data into School table
INSERT INTO School (Name, Address, Postal_code, City, Phone_number, Email, Headmaster_name, School_admin_name)
VALUES
    ('ABC School', '123 Main Street', 12345, 'Cityville', '555-1234', 'school1@example.com', 'John Smith', 'Jane Doe'),
    ('XYZ School', '456 Elm Street', 67890, 'Townville', '555-5678', 'school2@example.com', 'Robert Johnson', 'Emily Davis'),
    ('123 School', '789 Oak Street', 54321, 'Villageville', '555-9876', 'school3@example.com', 'Michael Brown', 'Sarah Wilson'),
    ('456 School', '321 Pine Street', 98765, 'Hamletville', '555-4321', 'school4@example.com', 'David Lee', 'Laura Thompson'),
    ('789 School', '654 Cedar Street', 23456, 'Suburbville', '555-8765', 'school5@example.com', 'Daniel Clark', 'Olivia Taylor');

-- Inserting dummy data into Books table
INSERT INTO Books (ISBN, Title, Summary, No_pages, Image, Book_language, Key_words)
VALUES
    ('9781234567890', 'Sample Book 1', 'This is a sample book 1.', 200, 'sample1.jpg', 'English', 'sample, book, fiction'),
    ('9782345678901', 'Sample Book 2', 'This is a sample book 2.', 250, 'sample2.jpg', 'English', 'sample, book, non-fiction'),
    ('9783456789012', 'Sample Book 3', 'This is a sample book 3.', 180, 'sample3.jpg', 'English', 'sample, book, fantasy'),
    ('9784567890123', 'Sample Book 4', 'This is a sample book 4.', 300, 'sample4.jpg', 'English', 'sample, book, mystery'),
    ('9785678901234', 'Sample Book 5', 'This is a sample book 5.', 220, 'sample5.jpg', 'English', 'sample, book, science fiction'),
    ('9786789012345', 'Sample Book 6', 'This is a sample book 6.', 280, 'sample6.jpg', 'English', 'sample, book, romance'),
    ('9787890123456', 'Sample Book 7', 'This is a sample book 7.', 190, 'sample7.jpg', 'English', 'sample, book, thriller'),
    ('9788901234567', 'Sample Book 8', 'This is a sample book 8.', 260, 'sample8.jpg', 'English', 'sample, book, biography'),
    ('9789012345678', 'Sample Book 9', 'This is a sample book 9.', 240, 'sample9.jpg', 'English', 'sample, book, history'),
    ('9780123456789', 'Sample Book 10', 'This is a sample book 10.', 320, 'sample10.jpg', 'English', 'sample, book, poetry');

-- Inserting dummy data into Copies table
INSERT INTO Copies (ISBN, No_of_copies, School_Name, Available_copies)
VALUES
    ('9781234567890', 5, 'ABC School', 5),
    ('9781234567890', 5, 'XYZ School', 5),
    ('9781234567890', 5, '123 School', 5),
    ('9782345678901', 4, 'ABC School', 4),
    ('9782345678901', 4, 'XYZ School', 4),
    ('9782345678901', 4, '456 School', 4),
    ('9783456789012', 3, 'XYZ School', 3),
    ('9783456789012', 3, '123 School', 3),
    ('9783456789012', 3, '789 School', 3),
    ('9784567890123', 3, 'ABC School', 3),
    ('9784567890123', 3, '456 School', 3),
    ('9784567890123', 3, '789 School', 3),
    ('9785678901234', 2, 'XYZ School', 2),
    ('9785678901234', 2, '123 School', 2),
    ('9785678901234', 2, '456 School', 2),
    ('9785678901234', 2, '789 School', 2),
    ('9786789012345', 2, 'ABC School', 2),
    ('9786789012345', 2, 'XYZ School', 2),
    ('9786789012345', 2, '123 School', 2),
    ('9786789012345', 2, '789 School', 2),
    ('9787890123456', 1, 'ABC School', 1),
    ('9787890123456', 1, '456 School', 1),
    ('9787890123456', 1, '789 School', 1),
    ('9788901234567', 1, 'ABC School', 1),
    ('9788901234567', 1, 'XYZ School', 1),
    ('9788901234567', 1, '123 School', 1),
    ('9788901234567', 1, '456 School', 1),
    ('9788901234567', 1, '789 School', 1),
    ('9789012345678', 1, 'XYZ School', 1),
    ('9789012345678', 1, '789 School', 1),
    ('9789012345678', 1, '456 School', 1);

-- Inserting dummy data into Book_Publisher table
INSERT INTO Book_Publisher (Publisher_id, ISBN)
VALUES
    (1, '9781234567890'),
    (2, '9782345678901'),
    (3, '9783456789012'),
    (4, '9784567890123'),
    (5, '9785678901234'),
    (6, '9786789012345'),
    (7, '9787890123456'),
    (8, '9788901234567'),
    (1, '9789012345678'),
    (2, '9780123456789');

-- Inserting dummy data into Users table
INSERT INTO Users (Username, Password, First_Name, Last_Name, Status, Status2, Phone_number, Email, Books_Lended, Books_Owed, School_Name)
VALUES
    ('user1', 'password1', 'John', 'Doe', 'Student', 'Accepted', 123456789, 'john.doe@example.com', 2, 1, 'ABC School'),
    ('user2', 'password2', 'Jane', 'Smith', 'Teacher', 'Accepted', 987654321, 'jane.smith@example.com', 0, 0, 'ABC School'),
    ('user3', 'password3', 'Mike', 'Johnson', 'Student', 'Accepted', 456789123, 'mike.johnson@example.com', 1, 1, 'XYZ School'),
    ('user4', 'password4', 'Sarah', 'Williams', 'Teacher', 'Accepted', 321654987, 'sarah.williams@example.com', 3, 2, 'XYZ School'),
    ('user5', 'password5', 'David', 'Brown', 'Student', 'Accepted', 789123456, 'david.brown@example.com', 0, 0, 'ABC School'),
    ('user6', 'password6', 'Emily', 'Jones', 'Teacher', 'Accepted', 654987321, 'emily.jones@example.com', 2, 1, 'ABC School'),
    ('user7', 'password7', 'Chris', 'Lee', 'Student', 'Accepted', 951753852, 'chris.lee@example.com', 1, 1, 'XYZ School'),
    ('user8', 'password8', 'Michelle', 'Taylor', 'Teacher', 'Accepted', 753951852, 'michelle.taylor@example.com', 0, 0, 'XYZ School'),
    ('user9', 'password9', 'Andrew', 'Clark', 'Student', 'Accepted', 852963741, 'andrew.clark@example.com', 1, 0, 'ABC School'),
    ('user10', 'password10', 'Jessica', 'Anderson', 'Teacher', 'Accepted', 369258147, 'jessica.anderson@example.com', 0, 0, 'XYZ School'),
    ('user11', 'password11', 'Matthew', 'Wilson', 'Student', 'Accepted', 147258369, 'matthew.wilson@example.com', 2, 1, 'ABC School'),
    ('user12', 'password12', 'Ashley', 'Martin', 'Teacher', 'Accepted', 963852741, 'ashley.martin@example.com', 1, 1, 'XYZ School'),
    ('user13', 'password13', 'Daniel', 'Thomas', 'Student', 'Accepted', 258369147, 'daniel.thomas@example.com', 0, 0, 'ABC School'),
    ('user14', 'password14', 'Olivia', 'Walker', 'Teacher', 'Accepted', 741852963, 'olivia.walker@example.com', 3, 2, 'XYZ School'),
    ('user15', 'password15', 'Jason', 'Harris', 'Student', 'Accepted', 369741852, 'jason.harris@example.com', 1, 1, 'ABC School'),
    ('user17', 'password17', 'Lucas', 'Scott', 'Student', 'Accepted', 741258963, 'lucas.scott@example.com', 0, 0, 'ABC School'),
    ('user18', 'password18', 'Ava', 'Garcia', 'Teacher', 'Accepted', 852963741, 'ava.garcia@example.com', 1, 1, 'XYZ School'),
    ('user19', 'password19', 'Benjamin', 'Brown', 'Student', 'Accepted', 963852741, 'benjamin.brown@example.com', 2, 1, 'ABC School'),
    ('user20', 'password20', 'Nora', 'Robinson', 'Teacher', 'Accepted', 741963852, 'nora.robinson@example.com', 0, 0, 'XYZ School');

-- Inserting dummy data into Book_Author table
INSERT INTO Book_Author (Author_id, ISBN)
VALUES
    (1, '9781234567890'),
    (2, '9781234567890'),
    (3, '9782345678901'),
    (4, '9782345678901'),
    (5, '9783456789012'),
    (6, '9783456789012'),
    (7, '9784567890123'),
    (8, '9784567890123'),
    (9, '9785678901234'),
    (10, '9785678901234'),
    (11, '9786789012345'),
    (12, '9786789012345'),
    (13, '9787890123456'),
    (14, '9787890123456'),
    (15, '9788901234567'),
    (16, '9788901234567');

-- Inserting dummy data into Book_Subject table
INSERT INTO Book_Subject (Subject_id, ISBN)
VALUES
    (1, '9781234567890'),
    (2, '9781234567890'),
    (3, '9782345678901'),
    (4, '9782345678901'),
    (5, '9783456789012'),
    (6, '9783456789012'),
    (1, '9784567890123'),
    (2, '9784567890123'),
    (3, '9785678901234'),
    (4, '9785678901234'),
    (5, '9786789012345'),
    (6, '9786789012345'),
    (1, '9787890123456'),
    (2, '9787890123456'),
    (3, '9788901234567'),
    (4, '9788901234567');

-- Inserting dummy data into Reviews table
INSERT INTO Reviews (Review, Username, Post_Date, Last_Update, ISBN, Status, Title)
VALUES
    ('This book is amazing!', 'user1', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '9781234567890', 'Accepted', 'Sample Book 1'),
    ('Highly recommended!', 'user2', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '9782345678901', 'Accepted', 'Sample Book 2'),
    ('Not my cup of tea.', 'user3', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '9783456789012', 'Accepted', 'Sample Book 3'),
    ('Couldn''t put it down!', 'user4', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '9784567890123', 'Accepted', 'Sample Book 4'),
    ('A must-read!', 'user5', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '9785678901234', 'Accepted', 'Sample Book 5'),
    ('Great book!', 'user6', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '9786789012345', 'Accepted', 'Sample Book 6'),
    ('Enjoyable read!', 'user7', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '9787890123456', 'Accepted', 'Sample Book 7'),
    ('Interesting story!', 'user8', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '9788901234567', 'Accepted', 'Sample Book 8'),
    ('Well-written and captivating!', 'user9', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '9789012345678', 'Accepted', 'Sample Book 9'),
    ('Couldn''t recommend it enough!', 'user10', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '9780123456789', 'Accepted', 'Sample Book 10');

-- Inserting dummy data into Lending table
INSERT INTO Lending (Making_date, Username, Return_status, Copy_id)
VALUES
    (CURRENT_DATE, 'user1', 'Owed', 1),
    (CURRENT_DATE, 'user2', 'Owed', 2),
    (CURRENT_DATE, 'user3', 'Owed', 3),
    (CURRENT_DATE, 'user4', 'Owed', 4),
    (CURRENT_DATE, 'user5', 'Owed', 5),
    (CURRENT_DATE, 'user6', 'Owed', 6),
    (CURRENT_DATE, 'user7', 'Owed', 7),
    (CURRENT_DATE, 'user8', 'Owed', 8),
    (CURRENT_DATE, 'user9', 'Owed', 9),
    (CURRENT_DATE, 'user10', 'Owed', 10),
    (CURRENT_DATE, 'user11', 'Owed', 11),
    (CURRENT_DATE, 'user12', 'Owed', 12),
    (CURRENT_DATE, 'user13', 'Owed', 13),
    (CURRENT_DATE, 'user14', 'Owed', 14),
    (CURRENT_DATE, 'user15', 'Owed', 15),
    (CURRENT_DATE, 'user17', 'Owed', 16),
    (CURRENT_DATE, 'user18', 'Owed', 17),
    (CURRENT_DATE, 'user19', 'Owed', 18),
    (CURRENT_DATE, 'user20', 'Owed', 19),
    (CURRENT_DATE, 'user8', 'Owed', 20);

-- Inserting dummy data into Booking table
INSERT INTO Booking (Making_date, Username, Copy_id, Status)
VALUES
    (CURRENT_DATE, 'user1', 1, 'Pending'),
    (CURRENT_DATE, 'user2', 2, 'Pending'),
    (CURRENT_DATE, 'user3', 3, 'Pending'),
    (CURRENT_DATE, 'user4', 4, 'Pending'),
    (CURRENT_DATE, 'user5', 5, 'Pending'),
    (CURRENT_DATE, 'user6', 6, 'Pending'),
    (CURRENT_DATE, 'user7', 7, 'Pending'),
    (CURRENT_DATE, 'user8', 8, 'Pending'),
    (CURRENT_DATE, 'user9', 9, 'Pending'),
    (CURRENT_DATE, 'user10', 10, 'Pending'),
    (CURRENT_DATE, 'user11', 11, 'Pending'),
    (CURRENT_DATE, 'user12', 12, 'Pending'),
    (CURRENT_DATE, 'user13', 13, 'Pending'),
    (CURRENT_DATE, 'user14', 14, 'Pending'),
    (CURRENT_DATE, 'user15', 15, 'Pending');

-- Inserting dummy data for a student user
INSERT INTO Users (Username, Password, First_Name, Last_Name, Status, Status2, Phone_number, Email, Books_Lended, Books_Owed, School_Name)
VALUES ('student', '1111', 'John', 'Smith', 'Student', 'Accepted', 987654321, 'john.smith@example.com', 2, 1, 'ABC School');

-- Inserting dummy data for a teacher user
INSERT INTO Users (Username, Password, First_Name, Last_Name, Status, Status2, Phone_number, Email, Books_Lended, Books_Owed, School_Name)
VALUES ('teacher', '1111', 'Jane', 'Doe', 'Teacher', 'Accepted', 123456789, 'jane.doe@example.com', 1, 0, 'XYZ School');

-- Inserting dummy data for an admin user
INSERT INTO Users (Username, Password, First_Name, Last_Name, Status, Status2, Phone_number, Email, Books_Lended, Books_Owed, School_Name)
VALUES ('admin', '1111', 'Robert', 'Johnson', 'Admin', 'Accepted', 987654321, 'robert.johnson@example.com', 0, 0, 'BLIP');

-- Inserting dummy data for a central admin user
INSERT INTO Users (Username, Password, First_Name, Last_Name, Status, Status2, Phone_number, Email, Books_Lended, Books_Owed, School_Name)
VALUES ('central_admin', '1111', 'Michael', 'Brown', 'Central Admin', 'Accepted', 123456789, 'michael.brown@example.com', 0, 0, 'BLOOP');

INSERT INTO Users (Username, Password, First_Name, Last_Name, Status, Status2, Phone_number, Email, Books_Lended, Books_Owed, School_Name, Registration_Date, Last_Update)
VALUES ('pending1', '1111', 'Pending 1', 'User', 'Student', 'Pending', 1234567890, 'pending1@example.com', 0, 0, 'Your School', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT INTO Users (Username, Password, First_Name, Last_Name, Status, Status2, Phone_number, Email, Books_Lended, Books_Owed, School_Name, Registration_Date, Last_Update)
VALUES ('pending2', '1111', 'Pending 2', 'User', 'Teacher', 'Pending', 1234567890, 'pending2@example.com', 0, 0, 'Your School', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT INTO Users (Username, Password, First_Name, Last_Name, Status, Status2, Phone_number, Email, Books_Lended, Books_Owed, School_Name, Registration_Date, Last_Update)
VALUES ('pending3', '1111', 'Pending 3', 'User', 'Admin', 'Pending', 1234567890, 'pending3@example.com', 0, 0, 'Your School', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT INTO Users (Username, Password, First_Name, Last_Name, Status, Status2, Phone_number, Email, Books_Lended, Books_Owed, School_Name, Registration_Date, Last_Update)
VALUES ('pending4', '1111', 'Pending 4', 'User', 'Central Admin', 'Pending', 1234567890, 'pending4@example.com', 0, 0, 'Your School', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

