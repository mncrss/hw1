<?php
    /*session_start();

    function checkAuth() {
        if(isset($_SESSION["log"])) {
            return $_SESSION["log"];
        } else 
            return 0;
    }*/
    
session_start();

function checkAuth() {
    if (isset($_SESSION["log"])) {
        return $_SESSION["log"];
    } else {
        return false;
    }
}
?>

