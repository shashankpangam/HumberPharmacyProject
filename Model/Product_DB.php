<?php
require_once 'Databases.php';
require_once 'Product.php';

class Product_DB{
    public static function getAllProducts(){
        $db = Databases::connectDB();
            $query = 'select * from tbl_product';
            $results = $db->query($query);
            
            $records = array();
            foreach($results as $row)
            {
                $record = new Product($row['productid'],
                        $row['name'],
                        $row['description'],
                        $row['symptoms'],
                        $row['category'],
                        $row['price'],
                        $row['ondiscount'],
                        $row['quantity'],
                        $row['sold'],
                        $row['images']);
                
                $records[]=$record;
            }
            return $records;
    }
    
    public static function getProductCountByCategory($category){
       
        return 42;
    }
    public static function getProductByID($id){
            $db = Databases::connectDB();
            $query = 'select * from tbl_product where productid=:id';
            $stm=$db->prepare($query);
            $stm->bindParam(':id',$id, PDO::PARAM_STR, 10);
            $stm->execute();
            $result=$stm->fetch();
            
            $record = new Product($result['productid'],
                        $result['name'],
                        $result['description'],
                        $result['symptoms'],
                        $result['category'],
                        $result['price'],
                        $result['ondiscount'],
                        $result['quantity'],
                        $result['sold'],
                        $result['images']);
            
            return $record;
    }
    
    public static function getProductByCategory($category, $min, $max){
        $db = Databases::connectDB();
        $db->setAttribute( PDO::ATTR_EMULATE_PREPARES, false );
        $query='select * from tbl_product where category=? LIMIT ?, ?';
        
        $stm=$db->prepare($query);
        $stm->bindParam(1,$category, PDO::PARAM_STR);
         $stm->bindParam(2,$min);
          $stm->bindParam(3,$max);
        $stm->execute();
        
        $results=$stm->fetchAll();
        $records = array();
            foreach($results as $row)
            {
                $record = new Product($row['productid'],
                        $row['name'],
                        $row['description'],
                        $row['symptoms'],
                        $row['category'],
                        $row['price'],
                        $row['ondiscount'],
                        $row['quantity'],
                        $row['sold'],
                        $row['images']);
                
                $records[]=$record;
            }
            return $records;
    }
    
    public static function getProductByOffers(){
        $db = Databases::connectDB();
        $query='select a.* from tbl_product a join tbl_offers b  on a.productid=b.productid where date_add(b.dateadded, interval b.days day ) > now() ;';
        $stm=$db->prepare($query);
        $stm->execute();
        
        $results=$stm->fetchAll();
        $records = array();
            foreach($results as $row)
            {
                $record = new Product($row['productid'],
                        $row['name'],
                        $row['description'],
                        $row['symptoms'],
                        $row['category'],
                        $row['price'],
                        $row['ondiscount'],
                        $row['quantity'],
                        $row['sold'],
                        $row['images']);
                
                $records[]=$record;
            }
            return $records;
    }
}
?>