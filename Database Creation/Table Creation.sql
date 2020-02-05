/*The Following was created by Samantha Langlois for Crafty Activity Development Team
for the purpose of Database testing on local systems prior to database server implementation.
*/
Create table collection
(
collectionID int NOT NULL AUTO_INCREMENT,
brandName varchar(40) NOT NULL,
PRIMARY KEY(collectionID));

Create Table item
(
itemID int not NULL AUTO_INCREMENT,
item_name varchar(40),
sku varchar(20),
collectionID int NOT NULL,
description varchar(100),
PRIMARY KEY (itemID)
);

Create Table users
(
userID int NOT NULL AUTO_INCREMENT,
username varchar(20),
password varchar(20),
email varchar(50),
PRIMARY KEY (userID)
);

Create Table user_collections
(
ucID int NOT NULL AUTO_INCREMENT,
flags varchar(10),
itemID int NOT NULL,
userID int NOT NULL,
PRIMARY KEY (ucID)
);

