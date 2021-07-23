<?php
include '../koneksi.php';
include '../library/session.php';
include '../library/info.php';
$session = (new Session())->cek_session();

$id = $_POST['id'];
$proses = $_POST['proses'];
$keterangan = $_POST['keterangan'];
$admin = $session->id;
$pesan = '';

if($proses == 2){
    $pesan = 'Proses';
}elseif($proses == 3){
    $pesan = 'Tolak';
}elseif($proses == 4){
    $pesan = 'Update';
}else{
    $pesan = 'Update';
}

$query = "UPDATE pemesanan SET status='$proses',ket_ditolak='$keterangan',admin_id='$admin' WHERE id='$id'";

mysqli_query($koneksi,$query);
$res = array(
    'status' => true,
    'messages' => 'Status berhasil di'.$pesan
);
$info = (new Info())->info_set($res);
header('location:../user/proyek.php');
?>