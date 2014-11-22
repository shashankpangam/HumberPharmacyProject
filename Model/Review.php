<?php

class Review {
    private $reviewid;
    private $productid;
    private $customerid;
    private $reviews;
    private $ratings;
    private $reviewts;
    
    public function __construct($reviewid,$productid,$customerid,$reviews,$ratings,$reviewts) {
        $this->reviewid=$reviewid;
        $this->productid=$productid;
        $this->customerid=$customerid;
        $this->reviews=$reviews;
        $this->ratings=$ratings;
        $this->reviewts=$reviewts;
    }
    
    public function getReviewID()
    {
        return $this->reviewid;
    }
    public function getProductID()
    {
        return $this->productid;
    }
    public function setProductID($productID)
    {
        $this->productid=$productID;
    }
    public function getCustomerID()
    {
        return $this->customerid;
    }
    public function setCustomerID($customerID)
    {
        $this->customerid=$customerID;
    }
    public function getReviews()
    {
        return $this->reviews;
    }
    public function setReviews($reviews)
    {
        $this->reviews=$reviews;
    }
    public function getRatings()
    {
        return $this->ratings;
    }
    public function setRatings($ratings)
    {
        $this->ratings=$ratings;
    }
}
?>