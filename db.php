<?php
$host = "localhost";
$base = 'lab-parametros';
$charset = 'utf8mb4';
$usuario = 'root';
$contrasena = '';

$dsn = "mysql:host=$host;dbname=$base;charset=$charset";

$pdo = new PDO($dsn, $usuario, $contrasena);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);