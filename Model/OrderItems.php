<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of OrderItems
 *
 * @author ShashankPangam
 */
class OrderItems {
    private $orderitemsid;
    private $orderid;
    private $productid;
    private $customerid;
    private $price;
    private $quantity;
    private $timestamp;
    
    public function __construct($oiID, $orderid,$pid,$custid, $price,$quantity,$ts) {
        $this->orderitemsid=$oiID;
        $this->orderid=$orderid;
        $this->productid=$pid;
        $this->customerid=$custid;
        $this->price=$price;
        $this->quantity=$quantity;
        $this->timestamp=$ts;
    }
    function getOrderitemsid() {
        return $this->orderitemsid;
    }

    function getOrderid() {
        return $this->orderid;
    }

    function getProductid() {
        return $this->productid;
    }

    function getCustomerid() {
        return $this->customerid;
    }

    function getPrice() {
        return $this->price;
    }

    function getQuantity() {
        return $this->quantity;
    }

    function setOrderitemsid($orderitemsid) {
        $this->orderitemsid = $orderitemsid;
    }

    function setOrderid($orderid) {
        $this->orderid = $orderid;
    }

    function setProductid($productid) {
        $this->productid = $productid;
    }

    function setCustomerid($customerid) {
        $this->customerid = $customerid;
    }

    function setPrice($price) {
        $this->price = $price;
    }

    function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

    function getTimestamp() {
        return $this->timestamp;
    }

    function setTimestamp($timestamp) {
        $this->timestamp = $timestamp;
    }


}
