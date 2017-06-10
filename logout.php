<?php
session_start();
//unset($_SESSION['email_id']);
unset($_SESSION['adminuser']);
unset($_SESSION['token_id']);
header("location:index.php");

?>