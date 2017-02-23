<?php
$response = array();
$response["Tenure"] = array();
$response["LoanType"] = array();
$response["LoanPurpose"] = array();
$response["WorkingStatus"] = array();
$response["CompanyType"] = array();
$response["Industry"] = array();

//-------------------------------------------------------------------
//-------------------------GET FROM DATABASE-------------------------
// connect to mongodb
$m = new MongoClient();

// select a database
$db = $m->dbbank;
$collection = new MongoCollection($db, "col_tenure");
$cursor = $collection -> find();
foreach($cursor as $row)
{	
	$tmp = array();
	$tmp["DATA"] = $row["_tenure"];
	$tmp["DETAILS"] = $row["_details"];
	array_push($response["Tenure"], $tmp);
}

$collection = new MongoCollection($db, "col_loan_type");
$cursor = $collection -> find();
foreach($cursor as $row)
{	
	$tmp = array();
	$tmp["DATA"] = $row["_loan_type"];
	$tmp["DETAILS"] = $row["_details"];
	array_push($response["LoanType"], $tmp);
}

$collection = new MongoCollection($db, "col_loan_purpose");
$cursor = $collection -> find();
foreach($cursor as $row)
{	
	$tmp = array();
	$tmp["DATA"] = $row["_loan_purpose"];
	$tmp["DETAILS"] = $row["_details"];
	array_push($response["LoanPurpose"], $tmp);
}

$collection = new MongoCollection($db, "col_working_status");
$cursor = $collection -> find();
foreach($cursor as $row)
{	
	$tmp = array();
	$tmp["DATA"] = $row["_working_status"];
	$tmp["DETAILS"] = $row["_details"];
	array_push($response["WorkingStatus"], $tmp);
}

$collection = new MongoCollection($db, "col_company_type");
$cursor = $collection -> find();
foreach($cursor as $row)
{	
	$tmp = array();
	$tmp["DATA"] = $row["_company_type"];
	$tmp["DETAILS"] = $row["_details"];
	array_push($response["CompanyType"], $tmp);
}

// keeping response header to json
header('Content-Type: application/json');
    
//---echoing json result----------
echo json_encode($response);
//--------------------------------
?>