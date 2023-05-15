CREATE DATABASE IF NOT EXISTS Andrew_Steven_DB;

USE Andrew_Steven_DB;

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
    readStatus TINYINT(1) NOT NULL,
    
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

-- Insert values into the Users table
INSERT INTO Users (name, email, password, zipcode, type, contactable) 
VALUES 
    ('John Smith', 'johnsmith@gmail.com', '$2y$10$ttKqD83qothMdAsBLEeI9.TXZvZ.WEH31H9aGP7/WfRZJq/Hbzqrq', 12345, 0, 1),
    ('Sarah Lee', 'sarahlee@yahoo.com', '$2y$10$33JhXU7mqcQjcsGPiAYQ7uxn5ZwH65Pomv4FSUMsz06QLpAcDfS8m', 23456, 1, 1),
    ('Mike Chang', 'mikechang@hotmail.com', '$2y$10$0RMsun3C2COEiumnHOqvk.VmE9yGUOydcoT8YhTmp9eL1a88Km7Cy', 34567, 0, 1),
    ('Kim Kim', 'kimkim@gmail.com', '$2y$10$sOMzi02EjCpkJq31fWCEyucs.l6PAmhUqxE.SBrvj7gI6TFM22GTK', 45678, 0, 1),
    ('Jenny Park', 'jennypark@yahoo.com', '$2y$10$jSZJq7WVgSiLHQkX8UL6d.NR/9.pbpfbFPydjyHZflM5j31VrQUom', 56789, 1, 1);

-- Insert values into the Suppliers table
INSERT IGNORE INTO Suppliers (userID) 
VALUES 
    (1),
    (3),
    (4);

-- Insert values into the Provisions table
INSERT IGNORE INTO Provisions (userID, supplierID, provision) 
VALUES 
    (1, 1, 'Medical equipment'),
    (3, 2, 'Pharmaceuticals'),
    (4, 3, 'Vaccines');

-- Insert values into the Doctors table
INSERT IGNORE INTO Doctors (userID) 
VALUES 
    (2),
    (5);

-- Insert values into the Titles table
INSERT IGNORE INTO Titles (userID, doctorID, title) 
VALUES 
    (2, 1, 'Cardiologist'),
    (5, 2, 'Dermatologist');

-- Insert values into the Messages table
INSERT IGNORE INTO Messages (userIDSender, userIDReceiver, msgContent, readStatus) 
VALUES 
    (1, 2, 'Hello, Dr. Lee. I would like to schedule a meeting to discuss your latest research.', 1),
    (2, 1, 'Hello, John. I would be happy to meet with you. What dates are you available?', 0),
    (4, 2, 'Hi, Dr. Lee. I am a new supplier of medical equipment and would like to discuss potential business opportunities.', 0),
    (2, 5, 'Hello, Sarah. Your recent research on skin cancer caught my attention. I would like to learn more.', 1),
    (5, 1, 'Hi, John. I am a dermatologist specializing in skin cancer research. I would be happy to discuss my work with you.', 0);

-- Insert values into the Appointments table
INSERT IGNORE INTO Appointments (userIDSender, userIDReceiver, apptDetails, apptDate, apptStatus) 
VALUES 
    (1, 2, 'Discuss latest research', '2023-05-15 09:00:00', 0),
    (2, 1, 'Meeting with John', '2023-05-17 14:30:00', 1),
    (4, 2, 'Business meeting', '2023-05-20 11:00:00', 1),
    (2, 5, 'Discuss skin cancer research', '2023-05-22 16:00:00', 2),
    (5, 1, 'Meet with John to discuss research', '2023-05-25 10:00:00', 0);