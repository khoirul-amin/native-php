<?php
include '../koneksi.php';
$id = $_GET['id'];

$result = mysqli_query($koneksi,"SELECT * FROM v_keterangan WHERE keterangan='$id'");
$data_keterangan = array();
while($data = mysqli_fetch_assoc($result)){
    $data_keterangan[] = $data;
}
header('Content-Type: application/json');

echo json_encode($data_keterangan[0]);