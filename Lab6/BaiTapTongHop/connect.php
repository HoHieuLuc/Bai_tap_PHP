<?php 
DEFINE ('DB_USER', 'root');
DEFINE ('DB_PASSWORD', '');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'quanly_nhanvien');

$conn = @mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) 
		OR die ('Could not connect to MySQL: ' . mysqli_connect_error() );

mysqli_set_charset($conn, 'utf8');
