<?php
require_once ('abstractDao.php');
require_once ('./model/customer.php');


 class customerDao extends abstractDao {
    
    function __construct() {
        try{
             parent::__construct() ;
        } catch (mysqli_sql_exception $e){
            throw $e;
        }        
    }
 

    // gets from collection table
   public function getCollections(){
    $result = $this->mysqli->query('SELECT * FROM collections');
    $collection = array();
    
    // fetches associated columns from collection table
    if($result->num_rows >= 1){
        while( $row = $result->fetch_assoc()){
            $collection = new collection($row['collectionID'],$row['brandName']);
            $collections[] = $collection;
        }
        $result->free();
        return $collections;
    }
        $result->free();
        return false;    
   }
   
   // gets from item table
   public function getItem(){
    $result = $this->mysqli->query('SELECT * FROM item');
    $item = array();
    
    // fetches associated columns from item table
    if($result->num_rows >= 1){
        while( $row = $result->fetch_assoc()){
            $item = new item($row['itemID'],$row['item_name'],$row['sku'],$row['collectionID'],$row['description']);
            $items[] = $item;
        }
        $result->free();
        return $items;
    }
        $result->free();
        return false;    
   }

   // gets from users table
   public function getUsers(){
    $result = $this->mysqli->query('SELECT * FROM users');
    $user = array();
    
    // fetches associated columns from users table
    if($result->num_rows >= 1){
        while( $row = $result->fetch_assoc()){
            $user = new user($row['userID'],$row['username'],$row['password'],$row['email']);
            $users[] = $user;
        }
        $result->free();
        return $users;
    }
        $result->free();
        return false;    
   }


     // gets from user_collections table
     public function getUserCollections(){
      $result = $this->mysqli->query('SELECT * FROM user_collections');
      $userCollection = array();
      
      // fetches associated columns from user_collections table
      if($result->num_rows >= 1){
          while( $row = $result->fetch_assoc()){
              $userCollection = new userCollection($row['userID'],$row['username'],$row['password'],$row['email']);
              $userCollections[] = $userCollection;
          }
          $result->free();
          return $userCollections;
      }
          $result->free();
          return false;    
     }
   


 
   // ********************************* TO DO: add user
   public function getCustomer($id){
    $query = 'SELECT * FROM mailinglist WHERE _id = ?';
    $stmt = $this->mysqli->prepare($query);
    $stmt->bind_param('i',$id);
    $stmt->execute();
    $result = $stem->get_result();
    if($result->num_rows == 1){
        $temp = $result->fetch_assoc();
        $customer = new customer($temp['customerName'],$temo['phoneNumber'],$temp['emailAddress'],$temp['referrer']);
        $result->free();
        return $customer;
    }
        $result->free();
        return false;   
   }
   
   
   
   public function addCustomer($customer){
      if(!$this->mysqli->connect_errno){
        $query = 'INSERT INTO mailinglist (customerName,phoneNumber,emailAddress,referrer) values (?,?,?,?)';
        $stmt = $this->mysqli->prepare($query);
        $name=$customer->getName();
        $phone=$customer->getPhone();
        $email=$customer->getEmail();
        $ref=$customer->getReferrer();
        $stmt->bind_param('ssss',$name,$phone,$email,$ref);
        //$stmt->bind_param('siss',$customer->getName(),$customer->getPhone(),$customer->getEmail(),$customer->getReferrer());
        $stmt->execute();
        if($stmt->error){
            return $stmt->error;
        }else {
            return '<span style=\'color:gold\'>' . $customer->getName().' signed up successfully' . '</span>';
            //return echo '<h3>'.'Signed up successfully'.'</h3>';
        }
      }else{
        return 'Could not connect to Database.';
      }
   }
   
   
   // check to see if email exists
   public function duplicateEmail($emailAddress){     
      if(!$this->mysqli->connect_errno){
         $result = $this->mysqli->query('SELECT emailAddress FROM mailinglist');
         $email = array();   
         if($result->num_rows >= 1){
            while( $row = $result->fetch_assoc()){
               $email[] = $row['emailAddress'];
            }
            $result->free();
         }
        foreach( $email as $value){
          $hash = $value;
          if(password_verify($emailAddress,$hash)){
            return true;
          } 
        }
          return false;
       }
       return false;
   }

 
 
 }