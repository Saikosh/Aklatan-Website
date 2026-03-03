<?php 
$serverName="LAPTOP-UTHIUMTV\SQLEXPRESS"; 
$connectionOptions=[ 
"Database"=>"Authentication", 
"Uid"=>"", 
"PWD"=>"" 
]; 
$conn=sqlsrv_connect($serverName, $connectionOptions); 