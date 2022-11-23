<?php

$db_name = 'mysql:host=localhost;dbname=shop_db';
$user_name = 'root';
$user_password = 'Wtf@windows10';

$conn = new PDO($db_name, $user_name, $user_password);
$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING ); 
$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION ); 
?>