<?php
class Info{
    function cek_info(){
	    // session_start();
        if(empty($_SESSION['returnInput'])){
            return array('status' => 'kosong', 'messages' => 'test');
        }else{
            return $_SESSION['returnInput'];
        }
    }

    function info_set($val){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        // session_start();
        $_SESSION['returnInput'] = $val;
    }
    
    function info_remove(){
        // session_start();
        $_SESSION['returnInput'] = "";
    }
}
?>