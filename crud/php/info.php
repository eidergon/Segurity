<?php
    session_start();

    // Verificar si la sesión de inicio de sesión existe
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
        // La sesión no existe o no ha iniciado sesión correctamente, redirigir a la página de inicio de sesión
        header('Location: ../index.php');
        exit();
    }

    // Si se ha iniciado sesión correctamente, continúa con el resto del contenido de la página
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Data</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  <link rel="stylesheet" href="../estilos/info.css">
  <link rel="shortcut icon" href="../img/logo-removebg-preview.ico" type="image/x-icon">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
  <?php
    require 'conexion.php';
    $resultado = $conn->query("SELECT * FROM Usuarios");
    ?>

  <div class="btn">
    <button><a href="./admin.php">Administracion de usuarios</a></button>
  </div>

  <h1>Tabla de datos</h1>
  <table class="table table-bordered">
    <tr>
      <th scope="col">Usuario </th>
      <th scope="col">Contraseña</th>
      <th scope="col">Usuario Poliedro</th>
      <th scope="col">Contraseña Poliedro</th>
    </tr>
    <?php while ($fila = $resultado->fetch_assoc()) { ?>
      <tr scope="row">
        <td><?php echo $fila['usuario_onelock']; ?></td>
        <td><?php echo $fila['contraseña_onelock']; ?></td>
        <td><?php echo $fila['poliedro']; ?></td>
        <td><?php echo $fila['contraseña_poliedro']; ?></td>
      </tr>
    <?php } ?>
  </table>

</body>
</html>