CREATE DATABASE IF NOT EXISTS mdunite_2;

USE mdunite_2;

-- create a table
CREATE TABLE IF NOT EXISTS Users (
    userID int AUTO_INCREMENT NOT NULL,
    email varchar(50) NOT NULL,
    password varchar(50),
    zipcode int,
    type TINYINT(1) NOT NULL,
  
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
    PRIMARY KEY (supplierID, userID)
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
    PRIMARY KEY (doctorID, userID)
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

INSERT INTO Users (email, password, zipcode, type)
VALUES
('johndoe@gmail.com', 'password123', 12345, 0),
('janedoe@gmail.com', 'password456', 23456, 1),
('bobsmith@yahoo.com', 'password789', 34567, 0),
('sarahjones@hotmail.com', 'password101', 45678, 1),
('brianlee@gmail.com', 'password112', 56789, 0),
('amycruz@gmail.com', 'password131', 67890, 1),
('ericlopez@yahoo.com', 'password415', 78901, 0),
('lisabrown@hotmail.com', 'password161', 89012, 1),
('johnnytan@gmail.com', 'password718', 90123, 0),
('emilynguyen@yahoo.com', 'password921', 12345, 1);

INSERT INTO Suppliers (userID)
VALUES
(2),
(4),
(6),
(8),
(10);

INSERT INTO Provisions (userID, supplierID, provision)
VALUES
(2, 1, 'Medical Equipment'),
(4, 2, 'Pharmaceuticals'),
(6, 3, 'Medical Supplies'),
(8, 4, 'Lab Equipment'),
(10, 5, 'Medical Equipment');

INSERT INTO Doctors (userID)
VALUES
(1),
(3),
(5),
(7),
(9);

INSERT INTO Titles (userID, doctorID, title)
VALUES
(1, 1, 'Dr.'),
(3, 2, 'Dr.'),
(5, 3, 'Dr.'),
(7, 4, 'Dr.'),
(9, 5, 'Dr.');

INSERT INTO Messages (userIDSender, userIDReceiver, msgContent)
VALUES
(1, 2, 'Hello, I need some medical supplies'),
(3, 4, 'I need to refill my prescription'),
(5, 6, 'Do you have any face masks in stock?'),
(7, 8, 'I need to order some lab equipment'),
(9, 10, 'Can you deliver my medication to my office?'),
(2, 1, 'Yes, we have the supplies you need'),
(4, 3, 'Your prescription has been refilled'),
(6, 5, 'Sorry, we are out of stock at the moment'),
(8, 7, 'Sure, what do you need?'),
(10, 9, 'Yes, we can deliver to your office');

SELECT *
FROM Users
ORDER BY userID;

SELECT *
FROM Messages
ORDER BY msgID;

-- This is used to get the last AUTO_INCREMENT id that was given
-- SELECT LAST_INSERT_ID() AS msgID;