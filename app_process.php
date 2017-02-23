<?php
    header('Content-Type: application/json');
	$m = new MongoClient();
    $db = $m->dbbank;
    $collection = new MongoCollection($db, "main");
    $cursor = $collection -> find();
    $response = array();
    $i=0;    
    if (isset($_GET['mongoID_removing'])) 
    {
        $php_var = $_GET['mongoID_removing'];
        $collection->remove(array("_id" => new MongoId($php_var))); 
    }
	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        // foreach($cursor as $row)
        // {
        //     $response[]
        //     $tmp = array();
        //     $tmp["_loan_type"] = $row["_loan_type"];
        //     array_push($response, $tmp);
        // }
        while($cursor -> hasNext())
        {
            $response[$i] = $cursor->getNext();
            // key() function returns the records '_id'
            $response[$i++]['_id'] = $cursor->key();
        }
        echo json_encode($response);
	}
?>
