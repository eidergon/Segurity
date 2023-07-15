<?php
    $servername = "10.206.69.198:12125";
    $username = "mysqldb";
    $password = "Colombia2025=";
    $database = "Onecontact";
  
    // Crear la conexión
    $conn = mysqli_connect($servername, $username, $password, $database);
  
    // Verificar la conexión
    if (!$conn) {
      die("Error de conexión: " . mysqli_connect_error());
    } else {
     
    }
?>