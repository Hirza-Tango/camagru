<?php
require_once($_SERVER['DOCUMENT_ROOT']."/init.php");
session_unset();
$_SESSION['last_status'] = "Successfully logged out";
header("Location: /");
?>