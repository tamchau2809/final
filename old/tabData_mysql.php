<?php
$serverName = '127.0.0.1:3306';
$username = 'root';
$password = '';
$database = 'dbcustomer';

$conn = new mysqli($serverName, $username, $password, $database);
$response = array();
$response["Tenure"] = array();
$response["LoanType"] = array();
$response["LoanPurpose"] = array();
$response["WorkingStatus"] = array();
$response["CompanyType"] = array();
$response["Industry"] = array();

//-------------------------------------------------------------------
//-------------------------GET FROM DATABASE-------------------------
/*$sql_getTENURE = "SELECT tenure, details FROM tbtenure";
$result = $conn->query($sql_getTENURE);
if($result->num_rows > 0)
{
	while($row = $result->fetch_assoc())
	{
		$tmp = array();
		$tmp["DATA"] = $row["tenure"];
		$tmp["DETAILS"] = $row["details"];
		array_push($response["Tenure"], $tmp);
	}
}*/

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

$sql_getTYPE = "SELECT loan_type, details FROM tbloantype";
$result1 = $conn->query($sql_getTYPE);
if($result1->num_rows > 0)
{
	while($row1 = $result1->fetch_assoc())
	{
		$tmp1 = array();
		$tmp1["DATA"] = $row1["loan_type"];
		$tmp1["DETAILS"] = $row1["details"];
		array_push($response["LoanType"], $tmp1);
	}
}

$sql_getPURPOSE = "SELECT loan_purpose, details FROM tbloanpurpose";
$result2 = $conn->query($sql_getPURPOSE);
if($result2->num_rows > 0)
{
	while($row2 = $result2->fetch_assoc())
	{
		$tmp2 = array();
		$tmp2["DATA"] = $row2["loan_purpose"];
		$tmp2["DETAILS"] = $row2["details"];
		array_push($response["LoanPurpose"], $tmp2);
	}
}

$sql_getWSTT = "SELECT working_status, details FROM tbworkingstatus";
$result3 = $conn->query($sql_getWSTT);
if($result3->num_rows > 0)
{
	while($row3 = $result3->fetch_assoc())
	{
		$tmp3 = array();
		$tmp3["DATA"] = $row3["working_status"];
		$tmp3["DETAILS"] = $row3["details"];
		array_push($response["WorkingStatus"], $tmp3);
	}
}

$sql_getCompanyType = "SELECT company_type, details FROM tbcompanytype";
$result4 = $conn->query($sql_getCompanyType);
if($result4->num_rows > 0)
{
	while($row4 = $result4->fetch_assoc())
	{
		$tmp4 = array();
		$tmp4["DATA"] = $row4["company_type"];
		$tmp4["DETAILS"] = $row4["details"];
		array_push($response["CompanyType"], $tmp4);
	}
}

$sql_getIndustry = "SELECT industry, details FROM tbindustry";
$result5 = $conn->query($sql_getIndustry);
if($result5->num_rows > 0)
{
	while($row5 = $result5->fetch_assoc())
	{
		$tmp5 = array();
		$tmp5["DATA"] = $row5["industry"];
		$tmp5["DETAILS"] = $row5["details"];
		array_push($response["Industry"], $tmp5);
	}
}

// keeping response header to json
header('Content-Type: application/json');
    
//---echoing json result----------
echo json_encode($response);
//--------------------------------
?>