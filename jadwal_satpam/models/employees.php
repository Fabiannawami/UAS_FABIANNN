<?php
class Employee{
// Connection
private $conn;
// Table
private $db_table = "employee";
// Columns
public $id;
public $nama;
public $alamat;
public $tanggal;
public $umur;
public $created;
// Db connection
public function __construct($db){
$this->conn = $db;
}
// GET ALL
public function getEmployees(){
$sqlQuery = "SELECT id, nama, alamat, tanggal, umur, created FROM "
. $this->db_table . "";
$stmt = $this->conn->prepare($sqlQuery);
$stmt->execute();
return $stmt;
}
// CREATE
public function createEmployee(){
$sqlQuery = "INSERT INTO
". $this->db_table ."
SET
nama = :nama,
alamat = :alamat,
tanggal = :tanggal,
umur = :umur,
created = :created";
$stmt = $this->conn->prepare($sqlQuery);
// sanitize
$this->nama=htmlspecialchars(strip_tags($this->nama));
$this->alamat=htmlspecialchars(strip_tags($this->alamat));
$this->tanggal=htmlspecialchars(strip_tags($this->tanggal));
$this->umur=htmlspecialchars(strip_tags($this->umur));
$this->created=htmlspecialchars(strip_tags($this->created));
// bind data
$stmt->bindParam(":nama", $this->nama);
$stmt->bindParam(":alamat", $this->alamat);
$stmt->bindParam(":tanggal", $this->tanggal);
$stmt->bindParam(":umur", $this->umur);
$stmt->bindParam(":created", $this->created);
if($stmt->execute()){
    return true;
}
return false;
}
// READ single
public function getSingleEmployee(){
$sqlQuery = "SELECT
id,
nama,
alamat,
tanggal,
umur,
created
FROM
". $this->db_table ."
WHERE
id = ?
LIMIT 0,1";
$stmt = $this->conn->prepare($sqlQuery);
$stmt->bindParam(1, $this->id);
$stmt->execute();
$dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
$this->nama = $dataRow['nama'];
$this->alamat = $dataRow['alamat'];
$this->tanggal = $dataRow['tanggal'];
$this->umur = $dataRow['umur'];
$this->created = $dataRow['created'];
}
// UPDATE
public function updateEmployee(){
$sqlQuery = "UPDATE
". $this->db_table ."
SET
nama = :nama,
alamat = :alamat,
tanggal = :tanggal,
umur = :umur,
created = :created
WHERE
id = :id";

$stmt = $this->conn->prepare($sqlQuery);
$this->id=htmlspecialchars(strip_tags($this->id));
$this->nama=htmlspecialchars(strip_tags($this->nama));
$this->alamat=htmlspecialchars(strip_tags($this->alamat));
$this->tanggal=htmlspecialchars(strip_tags($this->tanggal));
$this->umur=htmlspecialchars(strip_tags($this->umur));
$this->created=htmlspecialchars(strip_tags($this->created));

// bind data
$stmt->bindParam(":id", $this->id);
$stmt->bindParam(":nama", $this->nama);
$stmt->bindParam(":alamat", $this->alamat);
$stmt->bindParam(":tanggal", $this->tanggal);
$stmt->bindParam(":umur", $this->umur);
$stmt->bindParam(":created", $this->created);

if($stmt->execute()){
return true;
}
return false;
}
// DELETE
function deleteEmployee(){
$sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
$stmt = $this->conn->prepare($sqlQuery);
$this->id=htmlspecialchars(strip_tags($this->id));
$stmt->bindParam(1, $this->id);
if($stmt->execute()){
return true;
}
return false;
}
}
?>