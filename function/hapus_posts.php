<?php

include '../koneksi.php';

$id = $_GET['id'];
$query = "DELETE FROM posts WHERE id='$id'";
$sql = mysqli_query($koneksi,"SELECT * FROM posts WHERE id='$id'");
while($cek_data = mysqli_fetch_array($sql)){
    if(!empty($cek_data['image'])){
        if(file_exists('../assets/img/imageUpload/'.$cek_data['image'])){
            unlink('../assets/img/imageUpload/'.$cek_data['image']);
        }
    }
}

mysqli_query($koneksi,$query);
header('location:../user/posts.php');