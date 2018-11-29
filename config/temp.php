<?php
$password = readline('Enter password');
echo password_hash($password, PASSWORD_BCRYPT) . PHP_EOL;
?>