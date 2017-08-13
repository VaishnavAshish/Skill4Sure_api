<?php 
if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }

    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

        exit(0);
    }
	include_once("../conn.php");
	 $d = json_decode(file_get_contents("php://input"), false);
	 
	 
$encryption_key="aksAKSPQKFD9456235547559632105487hay"; 
function encrypt($pure_string, $encryption_key) {
 return  openssl_encrypt($pure_string,"AES-128-ECB",$encryption_key);
}
function decrypt($encrypted_string, $encryption_key) {
	return openssl_decrypt($encrypted_string,"AES-128-ECB",$encryption_key);
}
	 
	 
    if(isset($d->module) && $d->module!="")
    {
        $query = mysql_query("SELECT * from module");
        if($row=mysql_fetch_array($query))
        {
            $res[] = $row;
        }
       echo json_encode($res);
    }
	 
?>