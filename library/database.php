<?php

include '../koneksi.php';

class DB{
    
    function get($query){
        echo $query;
    }
    function insert($value){
        echo $value;
    }
    function update($query){
        echo $query;
    }

    function delete($where){
        echo $where;
    }

    function cek_user($query){
        $koneksi = mysqli_connect("localhost","root","","konstruksi");
        // $query = "SELECT * FROM users where  $key='$value'";
         
        $result = mysqli_query($koneksi,$query);
        $cek = mysqli_num_rows($result);

        if($cek == 0 ){
            return false;
        }else{
            return true;
        }
    }
}
?>