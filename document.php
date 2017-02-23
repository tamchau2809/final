<?php
if(isset($_GET['upload']) == true)
{
	$path = null;
	$file_post = $_FILES['uploaded_file'];
	$file_ary = reArrayFiles($file_post);
	if($file_post != NULL)
	{
		foreach ($file_ary as $file) {
			$file['name'] = uniqid().'.jpg';
			$target_path1 = "uploads/" . $file['name'];
			if(move_uploaded_file($file['tmp_name'], $target_path1)) 
			{	
				$path = $path.$target_path1."\r\n";
			} 
			else
			{
				echo "2";
			}
		}
		echo $path;
	}
}
if(isset($_GET['insert']) == true)
{
	//------------------------------------------------------------
	//--------------------------LOCATION--------------------------
	//------------------------------------------------------------
	$latitude = isset($_POST['LATITUDE']) ? $_POST['LATITUDE'] : '';
	$longitude = isset($_POST['LONGITUDE']) ? $_POST['LONGITUDE'] : ''; 
	if(empty($latitude) || empty($longitude))
	{
		$location = 'NOT FOUND';
	}
	else
	{	
		$geolocation = $latitude.','.$longitude;
		$geolocation = trim($geolocation);
		//$url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=$geolocation";
		$url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=$geolocation&key=AIzaSyArEyhaQMgdvOZlISXO_Jf80DHl1gpMXac";
		$json = file_get_contents($url);
		$json_decode = json_decode($json);
		$location = $json_decode->results[0]->formatted_address;
	}

	//------------------------------------------------------------
	//--------------------------DATABASE--------------------------
	//------------------------------------------------------------
	$loan_type = isset($_POST['LOAN_TYPE']) ? $_POST['LOAN_TYPE'] : '';
	$tenure = isset($_POST['TENURE']) ? $_POST['TENURE'] : '';
	$loan_purpose = isset($_POST['LOAN_PURPOSE']) ? $_POST['LOAN_PURPOSE'] : '';
	$industry = isset($_POST['INDUSTRY']) ? $_POST['INDUSTRY'] : '';
	$img_url = isset($_POST['IMG_URL']) ? $_POST['IMG_URL'] : '';
	if(!is_null($_POST['LOAN_TYPE']))
	{	
		// $serverName = '127.0.0.1:3306';
		// $username = 'root';
		// $password = '';
		// $database = 'dbcustomer';

		$mongo = new MongoClient();
		$dtb = $mongo->dbbank;
		$collection = new MongoCollection($dtb, "main");

		$document = array (
			"_loan_type" => "$loan_type",
			"_tenure" => "$tenure",
			"_loan_purpose" => "$loan_purpose",
			"_industry" => "$industry",
			"_url" => explode(',', $img_url),
			"_location" => "$location"
			);
		$collection->insert($document);

		// $conn = new mysqli($serverName, $username, $password, $database);

		/* $sql = "INSERT INTO tbmain (loan_type, tenure, loan_purpose, industry, url, location)
			VALUES ('$loan_type',  '$tenure',  '$loan_purpose', '$industry', '$img_url', N'$location')";
		if($conn->query($sql) === TRUE)
		{
			file_put_contents("data.txt","Connected! - "
				.date("h : i : sa - l, d/M/y")."\r\n"."--------------------------"
				."\r\n", FILE_APPEND);
		}
		else
		{
			file_put_contents("data.txt",$conn->error
				.date("h : i : sa - l, d/M/y")."\r\n"."--------------------------"
				."\r\n", FILE_APPEND);
		}
		$conn->close(); */
	}
}

if(isset($_GET['pin']) == true)
{
	$EMAIL = isset($_POST["EMAIL"]) ? $_POST["EMAIL"] : '';
	$var = "abcdefghijkmnopqrstuvwxyz0123456789";
	srand((double)microtime()*1000000);
	$i = 0;
	$PIN_SERVER = "" ;
	while ($i <= 3) {
		$num = rand() % 33;
		$tmp = substr($var, $num, 1);
		$PIN_SERVER = $PIN_SERVER . $tmp;
		$i++;
	}

	mail($EMAIL, "TEST", $PIN_SERVER);

	file_put_contents("pin.txt", $PIN_SERVER."\r\n".$EMAIL."\r\n", FILE_APPEND);

	echo($PIN_SERVER);
}
	
function reArrayFiles(&$file_post) {

    $file_ary = array();
    $file_count = count($file_post['name']);
    $file_keys = array_keys($file_post);

    for ($i=0; $i<$file_count; $i++) {
        foreach ($file_keys as $key) {
            $file_ary[$i][$key] = $file_post[$key][$i];
        }
    }
    return $file_ary;
}
?>