<?php

class RecentView {
    private $recentviewid;
    private $customerid;
    private $productid;
    private $viewtime;
    
    public function __construct($recentviewid,$customerid,$productid,$viewtime) {
        $this->recentviewid=$recentviewid;
        $this->customerid=$customerid;
        $this->productid=$productid;
        $this->viewtime=$viewtime;
    }
    
    public function getRecentViewID()
    {
        return $this->recentviewid;
    }
    public function getCustomerID()
    {
        return $this->customerid;
    }
    public function getProductID()
    {
        return $this->productid;
    }
    public function getViewTime()
    {
        return $this->viewtime;
    }
    public function setViewTime($viewtime)
    {
        $this->viewtime=$viewtime;
    }   
}

?>
