<?php

class Order {
    private $orderid;
    private $customerid;
    private $couponcode;
    private $price;
    private $orderdate;
    
    public function __construct($orderid,$customerid,$couponcode,$price,$orderdate) {
        $this->orderid=$orderid;
        $this->customerid=$customerid;
        $this->couponcode=$couponcode;
        $this->price=$price;
        $this->orderdate=$orderdate;
    }
    
    public function getOrderID()
    {
        return $this->orderid;
    }
    public function getCustomerID()
    {
        return $this->customerid;
    }
    public function setCustomerID($customerid)
    {
        $this->customerid=$customerid;
    }
    public function getCouponCode()
    {
        return $this->couponcode;
    }
    public function setCouponCode($couponcode)
    {
        $this->couponcode=$couponcode;
    }
    public function getPrice()
    {
        return $this->price;
    }
    public function setPrice($price)
    {
        $this->price=$price;
    }
    public function getOrderDate()
    {
        return $this->orderdate;
    }
}

?>