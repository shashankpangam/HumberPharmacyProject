<?php

require_once 'Databases.php';
require_once 'RecentView.php';

class RecentView_DB {
    public static function getRecentViews($id)
    {
        $db = Databases::connectDB();
        $query = 'select top 5 * from tbl_recentview where customerid=:customerid order by viewtime desc';
        $stm=$db->prepare($query);
        $stm->bindParam(':customerid',$id, PDO::PARAM_STR, 10);
        $stm->execute();
        
        $results=$stm->fetchAll();
        
        $records = array();
            foreach($results as $row)
            {
                $record = new RecentView($row['recentviewid'],
                        $row['customerid'],
                        $row['productid'],
                        $row['viewtime']);
                
                $records[]=$record;
            }
            return $records;
    }
    
    public function newRecentView($customerid,$productid)
    {
        $db=Databases::connectDB();
            $query = "insert into tbl_recentview (customerid, productid) values (:customerid, :productid)";
            $stm=$db->prepare($query);
            $stm->bindParam(':customerid',$customerid, PDO::PARAM_INT, 10);
            $stm->bindParam(':productid',$productid, PDO::PARAM_INT, 10);
            $result = $stm->execute();
            $lastid=$stm->lastInsertId();
            return $lastid;
    }
}

?>
