CREATE DATABASE IF NOT EXISTS mdunite;

USE mdunite;

-- create a table
CREATE TABLE IF NOT EXISTS Users (
    userID int AUTO_INCREMENT NOT NULL,
    name varchar(50) NOT NULL,
    email varchar(50) NOT NULL,
    password varchar(500) NOT NULL,
    zipcode int NOT NULL,
    type TINYINT(1) NOT NULL,
    contactable TINYINT(1) NOT NULL,
  
    UNIQUE (email),
    PRIMARY KEY (userID)
);

CREATE TABLE IF NOT EXISTS Suppliers (

    userID int NOT NULL,
    supplierID int AUTO_INCREMENT NOT NULL,

    UNIQUE (userID),
    FOREIGN KEY (userID) REFERENCES Users(userID),
    PRIMARY KEY (supplierID, userID)
);

CREATE TABLE IF NOT EXISTS Provisions (

    userID int NOT NULL,
    supplierID int NOT NULL,
    provision varchar(100) NOT NULL,

    FOREIGN KEY (userID) REFERENCES Suppliers(userID),
    FOREIGN KEY (supplierID) REFERENCES Suppliers(supplierID),
    PRIMARY KEY (supplierID, userID, provision)
);

CREATE TABLE IF NOT EXISTS Doctors (

    userID int NOT NULL,
    doctorID int AUTO_INCREMENT NOT NULL,
    
    UNIQUE (userID),
    FOREIGN KEY (userID) REFERENCES Users(userID),
    PRIMARY KEY (doctorID, userID)

);

CREATE TABLE IF NOT EXISTS Titles (

    userID int NOT NULL,
    doctorID int NOT NULL,
    title varchar(100) NOT NULL,

    FOREIGN KEY (userID) REFERENCES Doctors(userID),
    FOREIGN KEY (doctorID) REFERENCES Doctors(doctorID),
    PRIMARY KEY (doctorID, userID, title)
);

CREATE TABLE IF NOT EXISTS Messages (

    userIDSender int NOT NULL,
    userIDReceiver int NOT NULL,
    msgID int AUTO_INCREMENT NOT NULL,
    msgContent varchar(500),
    
    UNIQUE (msgID),
    FOREIGN KEY (userIDSender) REFERENCES Users(userID),
    FOREIGN KEY (userIDReceiver) REFERENCES Users(userID),
    PRIMARY KEY (userIDReceiver, msgID)
);

CREATE TABLE IF NOT EXISTS Appointments (

    userIDSender int NOT NULL,
    userIDReceiver int NOT NULL,
    apptID int AUTO_INCREMENT NOT NULL,
    apptDetails varchar(500) NOT NULL,
    apptDate DATETIME NOT NULL,
    apptStatus TINYINT(1) NOT NULL,

    UNIQUE (apptID),
    FOREIGN KEY (userIDSender) REFERENCES Users(userID),
    FOREIGN KEY (userIDReceiver) REFERENCES Users(userID),
    PRIMARY KEY (userIDReceiver, apptID)
);

-- INSERT INTO Users VALUES (1, "email@email.com", "password", 12345, 1);
-- INSERT INTO Users VALUES (2, "email2@email.com", "password", 12345, 1);

-- INSERT INTO Suppliers VALUES (1, "Minerals");
-- INSERT INTO Suppliers VALUES (1, "Gloves");
-- INSERT INTO Suppliers VALUES (2, "Gloves");

-- INSERT INTO Users(email, password, zipcode, type) VALUES
-- ("email@email.com", "password", 12345, 1),
-- ("email2@email.com", "password", 12345, 0);

-- INSERT INTO Messages(userIDSender, userIDReceiver, msgContent) VALUES
-- (1, 2, "Hello1"),
-- (1, 1, "Hello2"),
-- (1, 1, "Hello3"),
-- (1, 1, "Hello4"),
-- (1, 1, "Hello5"),
-- (1, 1, "Hello6");





-- INSERT INTO Users (name, email, password, zipcode, type)
-- VALUES
-- ('John Doe', 'johndoe@gmail.com', 'password123', 12345, 0),
-- ('Jane Doe', 'janedoe@gmail.com', 'password456', 23456, 1),
-- ('Bob Smith', 'bobsmith@yahoo.com', 'password789', 34567, 0),
-- ('Sarah Jones', 'sarahjones@hotmail.com', 'password101', 45678, 1),
-- ('Brian Lee', 'brianlee@gmail.com', 'password112', 56789, 0),
-- ('Amy Cruz', 'amycruz@gmail.com', 'password131', 67890, 1),
-- ('Eric Lopez', 'ericlopez@yahoo.com', 'password415', 78901, 0),
-- ('Lisa Brown', 'lisabrown@hotmail.com', 'password161', 89012, 1),
-- ('Johnny Tan', 'johnnytan@gmail.com', 'password718', 90123, 0),
-- ('Emily Nguyen', 'emilynguyen@yahoo.com', 'password921', 12345, 1);

-- INSERT INTO Suppliers (userID)
-- VALUES
-- (2),
-- (4),
-- (6),
-- (8),
-- (10);

-- INSERT INTO Provisions (userID, supplierID, provision)
-- VALUES
-- (2, 1, 'Medical Equipment'),
-- (2, 2, 'Medical Gloves'),
-- (4, 2, 'Pharmaceuticals'),
-- (6, 3, 'Medical Supplies'),
-- (8, 4, 'Lab Equipment'),
-- (10, 5, 'Medical Equipment');

-- INSERT INTO Doctors (userID)
-- VALUES
-- (1),
-- (3),
-- (5),
-- (7),
-- (9);

-- INSERT INTO Titles (userID, doctorID, title)
-- VALUES
-- (1, 1, 'Dr.'),
-- (1, 2, 'M.D.'),
-- (3, 2, 'Dr.'),
-- (5, 3, 'Dr.'),
-- (7, 4, 'Dr.'),
-- (9, 5, 'Dr.');

-- INSERT INTO Messages (userIDSender, userIDReceiver, msgContent)
-- VALUES
-- (1, 2, 'Hello, I need some medical supplies'),
-- (3, 4, 'I need to refill my prescription'),
-- (5, 6, 'Do you have any face masks in stock?'),
-- (7, 8, 'I need to order some lab equipment'),
-- (9, 10, 'Can you deliver my medication to my office?'),
-- (2, 1, 'Yes, we have the supplies you need'),
-- (4, 3, 'Your prescription has been refilled'),
-- (6, 5, 'Sorry, we are out of stock at the moment'),
-- (8, 7, 'Sure, what do you need?'),
-- (10, 9, 'Yes, we can deliver to your office');

-- -- This is used to get the last AUTO_INCREMENT id that was given
-- -- SELECT LAST_INSERT_ID() AS msgID;

-- -- Find all user info with email: johndoe@gmail.com
-- -- and password: password123
-- SELECT *
-- FROM Users AS U
-- WHERE U.email = "johndoe@gmail.com" AND U.password = "password123";

-- -- Find the emails of all doctors
-- SELECT U.email
-- FROM Users AS U, Doctors AS D
-- WHERE U.userID = D.userID;

-- -- Find all titles belonging to john doe
-- SELECT T.title
-- FROM Users AS U, Titles AS T
-- WHERE U.userID = T.userID AND U.email = "johndoe@gmail.com";

-- -- Find the names of all Doctors with Dr. Titles
-- -- in the zipcode 12345 or 23456
-- SELECT U.name
-- FROM Users AS U, Titles AS T
-- WHERE U.userID = T.userID AND (U.zipcode = 12345 OR U.zipcode = 23456);