<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  <link rel="stylesheet" href="./estilos/login.css">
  <link rel="shortcut icon" href="./img/logo-removebg-preview.ico" type="image/x-icon">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
  <form action="" method="POST">
    <div class="login-box">
      <div class="form">
        <form class="login-form">
          <input type="text" placeholder="username" name="user" required />
          <input type="password" placeholder="password" name="pass" required />
          <input type="submit" value="Login" class="btn">
        </form>
      </div>
    </div>
  </form>
</body>
</html>

<?php
  require 'php/conexion.php';
  
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos enviados
    $nombreUsuario = $_POST['user'];
    $contrasena = $_POST['pass'];

    // Consultar la base de datos para verificar los datos
    $consulta = "SELECT * FROM loginadm WHERE user = '$nombreUsuario' AND pass = '$contrasena'";
    $resultado = mysqli_query($conn, $consulta);

    // Verificar si se encontró un registro con los datos proporcionados
    if (mysqli_num_rows($resultado) === 1) {
      // Datos válidos, redirigir al usuario a otro sitio
      session_start();
      $_SESSION['logged_in'] = true;
      header("Location: ./php/admin.php"); 
      exit();
    } else {
      // Datos inválidos, mostrar mensaje de error
      echo "<script> Swal.fire({
        icon: 'error',
        title: 'ERROR',
        text: 'Datos Invalidos!'
      });</script>";
    }
  }

  // Cerrar la conexión a la base de datos
  mysqli_close($conn);
?>