<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-AllowHeaders, Authorization, X-Requested-With");
include_once '../../config/database.php';
include_once '../../models/employees.php';
$database = new Database();
$db = $database->getConnection();
$item = new employee($db);
$data = json_decode(file_get_contents("php://input"));

$item->nama = $data->nama;
$item->alamat = $data->alamat;
$item->tanggal = $data->tanggal;
$item->umur = $data->umur;
$item->created = date('Y-m-d H:i:s');

if($item->createEmployee()){
  
    echo json_encode(['message'=>'Employee created successfully.']);
} else{
    
    echo json_encode(['message'=>'Employee could not be created.']);
}
?>