<?php
$db_host = 'localhost';
$db_user = 'checkyou_nib1';
$db_password = 'Nib1n12%^';
$db_database = 'checkyou_nib1';

mysql_connect($db_host,$db_user,$db_password);
mysql_select_db($db_database);
echo mysql_error();
?>
