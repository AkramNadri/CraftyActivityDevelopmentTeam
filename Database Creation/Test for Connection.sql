/*The Following was created by Samantha Langlois for Crafty Activity Development Team
for the purpose of Database testing on local systems prior to database server implementation.
*/
Select itemID,item_name,brandName
From item,collection
where item.collectionID = collection.collectionID;