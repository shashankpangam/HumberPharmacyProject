<?php
require_once 'Databases.php';
require_once 'OrderItems.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of OrderItems_DB
 *
 * @author ShashankPangam
 */
class OrderItems_DB {
    public static function insertNewOrderItem($orderItem){
        $productid = $orderItem->getProductid();
        $orderid = $orderItem->getgetOrderid();
        $customerid=$orderItem->getCustomerid();
        $price=$orderItem->getPrice();
        $quantity=$orderItem->getQuantity();
        
        $db = Databases::connectDB();
        $query = "insert into tbl_orderitems (orderid,productid,customerid,price,quantity) values (:orderid,:productid,:custoemrid,:price,:quantity)";
        $stm = $db->prepare($query);
        $stm->bindParam(':orderid', $orderid, PDO::PARAM_INT, 10);
        $stm->bindParam(':productid', $productid, PDO::PARAM_INT, 10);
        $stm->bindParam(':customerid', $customerid, PDO::PARAM_INT, 10);
        $stm->bindParam(':price', $price);
        $stm->bindParam(':quantity', $quantity, PDO::PARAM_INT, 3);
        $result = $stm->execute();
    }
}
