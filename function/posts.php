<?php

include '../koneksi.php';
include '../library/session.php';
$session = (new Session())->cek_session();

$judul = $_POST['nama'];
$jenis = $_POST['jenis'];
$isi = $_POST['isi'];
$slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $judul)));
$author = $session->nama;
$tanggal = date('Y-m-d H:i:s');


if(!empty($_POST['id'])){
    $id = $_POST['id'];
    if($_FILES["image"]["name"]){
        $image_name = 'Image-'.date("Y-m-d_H_i_s");
        $tipe_image = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
        $file_name =  $image_name.'.'.$tipe_image;
        $sql = mysqli_query($koneksi,"SELECT * FROM posts WHERE id='$id'");
        while($cek_data = mysqli_fetch_array($sql)){
			if(!empty($cek_data['image'])){
				if(file_exists('../assets/img/imageUpload/'.$cek_data['image'])){
					unlink('../assets/img/imageUpload/'.$cek_data['image']);
				}
			}
        }
        $upload_path          = '../assets/img/imageUpload/';
        move_uploaded_file($_FILES["image"]["tmp_name"],$upload_path.$file_name);

        $query = "UPDATE posts SET `judul`='$judul',`image`='$file_name',`isi`='$isi',`tanggal`='$tanggal',`slug`='$slug',`author`='$author',`jenis`='$jenis' WHERE id='$id'";
    }else{
        $query = "UPDATE posts SET `judul`='$judul',`isi`='$isi',`tanggal`='$tanggal',`slug`='$slug',`author`='$author',`jenis`='$jenis' WHERE id='$id'";
    }
}else{
    if($_FILES["image"]["name"]){
        $image_name = 'Image-'.date("Y-m-d_H_i_s");
        $tipe_image = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
        $file_name =  $image_name.'.'.$tipe_image;

        $upload_path          = '../assets/img/imageUpload/';
        move_uploaded_file($_FILES["image"]["tmp_name"],$upload_path.$file_name);
        $query = "INSERT INTO `posts`(`id`, `judul`, `image`, `isi`, `tanggal`, `slug`, `author`, `jenis`) VALUES (null,'$judul','$file_name','$isi','$tanggal','$slug','$author','$jenis')";
    }else{
        $query = "INSERT INTO `posts`(`id`, `judul`, `image`, `isi`, `tanggal`, `slug`, `author`, `jenis`) VALUES (null,'$judul',null,'$isi','$tanggal','$slug','$author','$jenis')";
    }
}

mysqli_query($koneksi,$query);
// if ( false===$result ) {
// printf("error: %s\n", mysqli_error($koneksi));
// }
header('location:../user/posts.php');