<?php

require_once 'Databases.php';
require_once 'Review.php';

class Review_DB {

    public static function getAllReviews() {
        $db = Databases::connectDB();
        $sql = 'select * from tbl_review';
        $results = $db->query($sql);

        $records = array();
        foreach ($results as $row) {
            $record = new Review($row['reviewid'], $row['productid'], $row['customerid'], $row['reviews'], $row['ratings'], $row['reviewts']);

            $records[] = $record;
        }
        return $records;
    }

    public static function getReviewByID($id) {
        $db = Databases::connectDB();
        $query = 'select * from tbl_review where reviewid=:reviewid';
        $stm = $db->prepare($query);
        $stm->bindParam(':reviewid', $id, PDO::PARAM_STR, 10);
        $stm->execute();

        $results = $stm->fetch();

        $record = new Review($results['reviewid'], $results['productid'], $results['customerid'], $results['reviews'], $results['ratings'], $results['reviewts']);

        return $record;
    }

    public static function getRandomReview() {
        $db = Databases::connectDB();
        $query = 'SELECT * FROM tbl_review, (SELECT reviewid AS sid FROM tbl_review ORDER BY RAND() LIMIT 1) tmp WHERE tbl_review.reviewid = tmp.sid';
        $stm = $db->prepare($query);
        $stm->execute();
        $results = $stm->fetch();
        $record = new Review($results['reviewid'], $results['productid'], $results['customerid'], $results['reviews'], $results['ratings'], $results['reviewts']);

        return $record;
    }

    public static function getReviewByProducts($productID) {
        $db = Databases::connectDB();
        $query = 'select * from tbl_review where productid=:productid';
        $stm = $db->prepare($query);
        $stm->bindParam(':productid', $productID, PDO::PARAM_STR, 10);
        $stm->execute();

        $results = $stm->fetchAll();
        if ($results == null) {
            $records = null;
        } else {

            $records = array();
            foreach ($results as $row) {
                $record = new Review($row['reviewid'], $row['productid'], $row['customerid'], $row['reviews'], $row['ratings'], $row['reviewts']);

                $records[] = $record;
            }
        }
        return $records;
    }

    public static function getReviewByCustomers($customerID) {
        $db = Databases::connectDB();
        $query = 'select * from tbl_review where customerid=:customerid';
        $stm = $db->prepare($query);
        $stm->bindParam(':customerid', $customerID, PDO::PARAM_STR, 10);
        $stm->execute();

        $results = $stm->fetchAll();

        $records = array();
        foreach ($results as $row) {
            $record = new Review($row['reviewid'], $row['productid'], $row['customerid'], $row['reviews'], $row['ratings'], $row['reviewts']);

            $records[] = $record;
        }
        return $records;
    }

    public static function addNewReview($review) {
        $productid = $review->getProductID();
        $customerid = $review->getCustomerID();
        $reviews = $review->getReviews();
        $ratings = $review->getRatings();

        $db = Databases::connectDB();
        $query = "insert into tbl_review (productid, customerid, reviews, ratings) values (:productid, :customerid, :reviews, :ratings)";
        $stm = $db->prepare($query);
        $stm->bindParam(':customerid', $customerid, PDO::PARAM_INT, 10);
        $stm->bindParam(':productid', $productid, PDO::PARAM_INT, 10);
        $stm->bindParam(':reviews', $reviews, PDO::PARAM_STR);
        $stm->bindParam(':ratings', $ratings, PDO::PARAM_INT, 1);
        $result = $stm->execute();
        // $lastid=$result->lastInsertId();
        return $result;
    }

}

?>
