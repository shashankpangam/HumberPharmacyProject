<?php

require_once 'Databases.php';
require_once 'Order.php';

class Order_DB {
    
    public static function getAllOrders(){
        $db = Databases::connectDB();
        $query = 'Select * from tbl_order';
        $results = $db->query($query);
        
        $records = array();
            foreach($results as $row)
            {
                $record = new Order($row['orderid'],
                        $row['customerid'],
                        $row['couponcode'],
                        $row['price'],
                        $row['orderdate']);
                $records[]=$record;
            }
            return $records;
    }
    
    public static function getOrderById($id)
    {
        $db = Databases::connectDB();
            $query = 'select * from tbl_order where id=:id';
            $stm=$db->prepare($query);
            $stm->bindParam(':id',$id, PDO::PARAM_STR, 10);
            $stm->execute();
        
            $result=$stm->fetch();
            
            $record = new Order($result['orderid'],
                        $result['customerid'],
                        $result['couponcode'],
                        $result['price'],
                        $result['orderdate']);
            return $record;
    }
    
    public static function getOrderByCustomer($customerid)
    {
        $db = Databases::connectDB();
        $query = 'select * from tbl_order where customerid=:customerid';
        $stm=$db->prepare($query);
        $stm->bindParam(':customerid',$customerid, PDO::PARAM_STR, 10);
        $stm->execute();
        $results=$stm->fetchAll();
        
        $records = array();
            foreach($results as $row)
            {
                $record = new Order($row['orderid'],
                        $row['customerid'],
                        $row['couponcode'],
                        $row['price'],
                        $row['orderdate']);
                
                $records[]=$record;
            }
            return $records;
    }
    
    public static function getOrderByProducts($productid)
    {
        $db = Databases::connectDB();
        $query = 'select * from tbl_order where productid=:productid';
        $stm=$db->prepare($query);
        $stm->bindParam(':productid',$productid, PDO::PARAM_STR, 10);
        $stm->execute();
        
        $results=$stm->fetchAll();
        
        $records = array();
            foreach($results as $row)
            {
                $record = new Order($row['orderid'],
                        $row['customerid'],
                        $row['couponcode'],
                        $row['price'],
                        $row['orderdate']);
                
                $records[]=$record;
            }
            return $records;
    }
    
    public static function addNewOrder($order)
    {
        $customerid=$order->getCustomerID();
        $price=$order->getPrice();
        
        $db = Databases::connectDB();
        $query = "insert into tbl_order (customerid,couponcode,price) values (:customerid,:price)";
        $stm = $db->prepare($query);
        
        $stm->bindParam(':customerid', $customerid, PDO::PARAM_INT, 10);
        $stm->bindParam(':price', $price);
        $stm->execute();
        $lastID=$stm->lastInsertId();
    }
}

?>
