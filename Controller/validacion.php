<?php

session_start();
ob_start();

if($_SESSION['sesion_exitosa']!=1){
    header("Location:index.php");
    exit();
}