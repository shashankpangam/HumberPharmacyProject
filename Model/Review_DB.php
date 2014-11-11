<?php

require_once 'Databases.php';
require_once 'Review.php';

class Review_DB {
    public static function getAllReviews()
    {
        $db = Databases::connectDB();
            $sql = 'select * from tbl_review';
            $results = $db->query($sql);
            
            $records = array();
            foreach($results as $row)
            {
                $record = new Review($row['reviewid'],
                        $row['productid'],
                        $row['customerid'],
                        $row['review'],
                        $row['stars'],
                        $row['reviewts']);
                
                $records[]=$record;
            }
            return $records;
    }
    
    public static function getReviewByID($id)
    {
        $db = Databases::connectDB();
        $query = 'select * from tbl_review where reviewid=:reviewid';
        $stm=$db->prepare($query);
        $stm->bindParam(':reviewid',$id, PDO::PARAM_STR, 10);
        $stm->execute();
        
        $results=$stm->fetch();
            
                $record = new Review($results['reviewid'],
                        $results['productid'],
                        $results['customerid'],
                        $results['review'],
                        $results['stars'],
                        $results['reviewts']);
                
            return $record;
    }
    
    public static function getReviewByProducts($productID)
    {
        $db = Databases::connectDB();
        $query = 'select * from tbl_review where productid=:productid';
        $stm=$db->prepare($query);
        $stm->bindParam(':productid',$productID, PDO::PARAM_STR, 10);
        $stm->execute();
        
        $results=$stm->fetchAll();
        
        $records = array();
            foreach($results as $row)
            {
                $record = new Review($row['reviewid'],
                        $row['productid'],
                        $row['customerid'],
                        $row['review'],
                        $row['stars'],
                        $row['reviewts']);
                
                $records[]=$record;
            }
            return $records;
    }
    
    public static function getReviewByCustomers($customerID)
    {
        $db = Databases::connectDB();
        $query = 'select * from tbl_review where customerid=:customerid';
        $stm=$db->prepare($query);
        $stm->bindParam(':customerid',$customerID, PDO::PARAM_STR, 10);
        $stm->execute();
        
        $results=$stm->fetchAll();
        
        $records = array();
            foreach($results as $row)
            {
                $record = new Review($row['reviewid'],
                        $row['productid'],
                        $row['customerid'],
                        $row['review'],
                        $row['stars'],
                        $row['reviewts']);
                
                $records[]=$record;
            }
            return $records;
    }
    
    public static function addNewReview($review)
    {
        $prodid=$review->productid;
        $custid=$review->customerid;
        $rev=$review->review;
        $stars=$review->stars;
        
        $query = "insert into tbl_review (productid, customerid, review, stars) values (:productid, :customerid, :review, :stars)";
        $stm=$db->prepare($query);
        $stm->bindParam(':customerid',$custid, PDO::PARAM_INT, 10);
        $stm->bindParam(':productid',$prodid, PDO::PARAM_INT, 10);
        $stm->bindParam(':review',$rev, PDO::PARAM_STR);
        $stm->bindParam(':stars',$stars, PDO::PARAM_INT, 1);
        $result = $stm->execute();
        $lastid=$result->lastInsertId();
        return $lastid;
    }
}
?>
