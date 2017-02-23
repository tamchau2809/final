<?php
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
?>