<?php
class Product{
    private $productid;
    private $name;
    private $description;
    private $symptoms;
    private $category;
    private $price;
    private $ondiscount;
    private $quantity;
    private $sold;
    private $image;
    
    public function __construct($id,$name,$desc,$symptoms,$category,$price,$ondis,$qty,$sold,$image) {
        $this->productid=$id;
        $this->name=$name;
        $this->description=$desc;
        $this->category=$category;
        $this->ondiscount=$ondis;
        $this->price=$price;
        $this->quantity=$qty;
        $this->sold=$sold;
        $this->symptoms=$symptoms;
        $this->image=$image;
    }
    
    public function getProductID()
    {
        return $this->productid;
    }
    
    public function getProductName()
    {
        return $this->name;
    }
    public function setProductName($name)
    {
        $this->name=$name;
    }
    
    public function getProductDescription()
    {
        return $this->description;
    }
    public function setProductDescription($desc)
    {
        $this->description=$desc;
    }
    
    public function getSymptoms()
    {
        return $this->symptoms;
    }
    public function setSymptoms($symptoms)
    {
        $this->symptoms=$symptoms;
    }
    public function getProductCategory()
    {
        return $this->category;
    }
    public function setProductCategory($category)
    {
        $this->category=$category;
    }
    
    public function getProductPrice()
    {
        return $this->price;
    }
    public function setProductPrice($price)
    {
        $this->price=$price;
    }
    
    public function getIfOnDiscount()
    {
        return $this->ondiscount;
    }
    public function setOnDiscount($ondis)
    {
        $this->ondiscount=$ondis;
    }
    
    public function getProductQuantity()
    {
        return $this->quantity;
    }
    public function setProductQuantity($qty)
    {
        $this->quantity=$qty;
    }
    
    public function getProductSoldNo()
    {
        return $this->sold;
    }
    public function setProductSoldNo($sold)
    {
        $this->sold=$sold;
    }
    public function getProductImage()
    {
        return $this->image;
    }
    public function setProductImage($img)
    {
        $this->image=$img;
    }
}
?>

