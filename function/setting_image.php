<?php

include '../koneksi.php';
include '../library/info.php';
$id = $_POST['id'];

$image_name = 'Image-'.date("Y-m-d_H_i_s");
$tipe_image = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
$file_name =  $image_name.'.'.$tipe_image;
$sql = mysqli_query($koneksi,"SELECT * FROM users WHERE id='$id'");
while($cek_data = mysqli_fetch_array($sql)){
    if(!empty($cek_data['avatar'])){
        if(file_exists('../assets/img/imageProfile/'.$cek_data['avatar'])){
            unlink('../assets/img/imageProfile/'.$cek_data['avatar']);
        }
    }
}
$upload_path          = '../assets/img/imageProfile/';
move_uploaded_file($_FILES["image"]["tmp_name"],$upload_path.$file_name);

$query = "UPDATE users SET avatar='$file_name' WHERE id='$id'";
mysqli_query($koneksi,$query);
$res = array(
    'status' => true,
    'messages' => 'Foto berhasil dirubah'
);
$info = (new Info())->info_set($res);
header('location:../user/setting.php');