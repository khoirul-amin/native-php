<?php

include '../koneksi.php';
$id = $_POST['id'];

$image_name = 'File-'.date("Y-m-d_H_i_s");
$tipe_image = pathinfo($_FILES["pdf"]["name"], PATHINFO_EXTENSION);
$file_name =  $image_name.'.'.$tipe_image;
$sql = mysqli_query($koneksi,"SELECT * FROM pemesanan WHERE id='$id'");
while($cek_data = mysqli_fetch_array($sql)){
    if(!empty($cek_data['image'])){
        if(file_exists('../assets/pdfUpload/'.$cek_data['desain_rumah'])){
            unlink('../assets/pdfUpload/'.$cek_data['desain_rumah']);
        }
    }
}
$upload_path          = '../assets/pdfUpload/';
move_uploaded_file($_FILES["pdf"]["tmp_name"],$upload_path.$file_name);

$query = "UPDATE pemesanan SET desain_rumah='$file_name' WHERE id='$id'";
mysqli_query($koneksi,$query);
header('location:../user/proyek.php');