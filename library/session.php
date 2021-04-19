<?php
class Session{
    function cek_session(){
	    session_start();
        // cek apakah yang mengakses halaman ini sudah login
        if(empty($_SESSION['userLogin'])){
            return false;
        }else{
            return $_SESSION['userLogin'];
        }
    }

    function session_set($key){
        session_start();
        $_SESSION[$key] = $val;
    }
    
    function session_remove($key){
        session_start();
        $_SESSION[$key] = "";
    }
}
?>