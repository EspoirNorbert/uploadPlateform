<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

//allow method
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
require_once("./includes/function.php");
$uploded = upload_folder();
 if(gettype($uploded) == 'array'){
    echo json_encode(array("status" => 'failed',"errors" => array($uploded)),JSON_UNESCAPED_UNICODE);
    http_response_code(400);
} else if (gettype($uploded) == 'boolean' && $uploded == 'true'){
    echo json_encode(array("status" => 'success', "message" => 'Folder successful uploaded'));
    http_response_code(200);
} 
} else {
    echo json_encode(array("message" => 'This method is not authorized for this resource'));
    http_response_code(405);
}
 

