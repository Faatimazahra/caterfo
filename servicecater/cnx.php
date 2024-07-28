<?php
const DB_USER = 'root';         // Database username
const DB_PASSWORD = '';         // Database password
const DB_HOST = 'localhost';    // Database host
const DB_NAME = 'caterserv';    // Database name

// Assign values of constants to variables to build the DSN (Data Source Name)
$dbhost = DB_HOST;              // Database host
$dbname = DB_NAME;              // Database name
$dsn = "mysql:host=$dbhost;dbname=$dbname";
?>