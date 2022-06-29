<?php

session_start();

if(isset($_SESSION['askquery_userid'])){
    # code...
    $_SESSION['askquery_userid']= NULL;
    unset($_SESSION['askquery_userid']);
}
header("location: login.php");
die;

?>