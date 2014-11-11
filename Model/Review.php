<?php

class Review {
    private $reviewid;
    private $productid;
    private $customerid;
    private $review;
    private $stars;
    private $reviewts;
    
    public function __construct($reviewid,$productid,$customerid,$review,$stars,$reviewts) {
        $this->reviewid=$reviewid;
        $this->productid=$productid;
        $this->customerid=$customerid;
        $this->review=$review;
        $this->stars=$stars;
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
    public function getReview()
    {
        return $this->review;
    }
    public function setReview($review)
    {
        $this->review=$review;
    }
    public function getStars()
    {
        return $this->stars;
    }
    public function setStars($stars)
    {
        $this->stars=$stars;
    }
}
?>