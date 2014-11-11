<?php

require_once 'Databases.php';
require_once 'Offer.php';

class Offer_DB {
    public static function getAllOffers()
    {
        $db = Databases::connectDB();
        $query='select * from tbl_offers';
        $results = $db->query($sql);
        
        $records = array();
            foreach($results as $row)
            {
                $record = new Offer($row['offerid'],
                        $row['productid'],
                        $row['discountrate'],
                        $row['dateadded'],
                        $row['days']);
                
                $records[]=$record;
            }
            return $records;
    }
    public static function getOfferByID($id)
    {
        $db = Databases::connectDB();
        $query='select * from tbl_offers where offerid=:id';
        $stm=$db->prepare($query);
        $stm->bindParam(':id',$id, PDO::PARAM_STR, 10);
        $stm->execute();
        
        $result=$stm->fetch();
        
        $record = new Offer($result['offerid'],
                $result['productid'], 
                $result['discountrate'], 
                $result['dateadded'], 
                $result['days']);
        
        return $record;
    }
}

?>
