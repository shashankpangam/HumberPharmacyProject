<?php

require_once 'Databases.php';
require_once 'RecentView.php';

class RecentView_DB {

    public static function getRecentViews($id) {
        $db = Databases::connectDB();
        $query = 'select distinct productid, viewtime,customerid from tbl_recentview where customerid=:customerid group by productid order by viewtime desc LIMIT 5';
        $stm = $db->prepare($query);
        $stm->bindParam(':customerid', $id, PDO::PARAM_STR, 10);
        $stm->execute();

        $results = $stm->fetchAll();

        if ($results == null) {
            $records = null;
        } else {
            $records = array();
            foreach ($results as $row) {
                $record = new RecentView(null, $row['customerid'], $row['productid'], $row['viewtime']);

                $records[] = $record;
            }
        }

        return $records;
    }

    public static function newRecentView($customerid, $productid) {
        $db = Databases::connectDB();
        $query = "insert into tbl_recentview (customerid, productid) values (:customerid, :productid)";
        $stm = $db->prepare($query);
        $stm->bindParam(':customerid', $customerid, PDO::PARAM_INT, 10);
        $stm->bindParam(':productid', $productid, PDO::PARAM_INT, 10);
        $result = $stm->execute();
        return $result;
    }

}

?>
