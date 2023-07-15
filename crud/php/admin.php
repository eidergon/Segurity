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
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="../estilos/style.css">
    <link rel="shortcut icon" href="../img/logo-removebg-preview.ico" type="image/x-icon">
    <script src="../js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <!-- botonespara mostrar los formularios -->
    <div class="btn">
        <button onclick="mostrarFormulario('usuarios')">Nuevo Usuario</button>
        <button onclick="mostrarFormulario('actualizar')">Actualizar Clave Usuario</button>
        <button onclick="mostrarFormulario('eliminar')">Eliminar Usuario</button>
        <button onclick="mostrarFormulario('formularioApp')">Asignar Aplicativo</button>
        <button><a href="./info.php">Tabla de usuarios</a></button>
    </div>

    <!-- agregar usuario -->
    <form action="" class="formulario usuarios" id="usuarios" method="POST">
        <h1>Nuevo Usuario</h1>
        <label for="cc_usuario">CC de usuario</label>
        <input type="text" name="cc_usuario" required>

        <label for="clave_usuario">Clave de usuario</label>
        <input type="text" name="clave_usuario" required>
        <div class="btn">
            <input type="submit" value="Crear Usuario" class="submit">
            <input type="reset" value="Limpiar" class="limpiar">
        </div>
    </form>

    <!-- actualizar la clave del usuario -->
    <form action="" class="formulario actualizar" id="actualizar" style="display: none;" method="POST">
        <h1>Actualizar clave Usuario</h1>
        <label for="cc_usuario_actualizar">CC de usuario</label>
        <input type="text" name="cc_usuario_actualizar" required>

        <label for="clave_usuario_actualizar">Clave nueva</label>
        <input type="text" name="clave_usuario_actualizar" required>
        <div class="btn">
            <input type="submit" value="Actualizar clave" class="submit">
            <input type="reset" value="Limpiar" class="limpiar">
        </div>
    </form>

    <!-- eliminar usuario -->
    <form action="" class="formulario eliminar" id="eliminar" style="display: none;" method="POST">
        <h1>Eliminar Usuario</h1>
        <label for="cc_usuario_eliminar">CC de usuario</label>
        <input type="text" name="cc_usuario_eliminar" required>
        <div class="btn">
            <input type="submit" value="Eliminar Usuario" class="submit">
        </div>
    </form>

    <!-- asignar aplicativo -->
    <form action="" class="formulario app" id="formularioApp" style="display: none;" method="POST">
        <h1>Asignar aplicativo</h1>
        <label for="usuario_asignar">CC de usuario</label>
        <input type="text" name="usuario_asignar" required>

        <label for="usuario_app">Usuario</label>
        <input type="text" name="usuario_app" required>

        <label for="clave_usuario_app">Clave de usuario</label>
        <input type="text" name="clave_usuario_app" required>

        <select name="aplicativos" id="app" class="select" required>
            <option value="">Selecciona el aplicativo</option>
            <option value="poliedro">Poliedro</option>
            <option value="id_vision">Id Visión</option>
            <option value="crm">CRM</option>
            <option value="my_app">My App</option>
            <option value="sap">SAP</option>
            <option value="visor">Visor</option>
            <option value="cali_express">Cali Express</option>
            <option value="lecta">Lecta</option>
            <option value="integra">Integra</option>
        </select>
        <div class="btn">
            <input type="submit" value="Asignar Aplicativo" class="submit">
        </div>
    </form>


    <!-- CRUD -->
    <?php
        require 'conexion.php';

        // Codigo para los formularios
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // guardar nuevo usuario
            if (isset($_POST["cc_usuario"]) && isset($_POST["clave_usuario"])) {
                $cc_usuario = $_POST["cc_usuario"];
                $clave_usuario = $_POST["clave_usuario"];

                $sql = "INSERT INTO Usuarios (usuario_onelock, contraseña_onelock) VALUES ('$cc_usuario', '$clave_usuario')";
                mysqli_query($conn, $sql);
                if (mysqli_affected_rows($conn) > 0){
                    echo "<script>Swal.fire(
                            'Good job!',
                            'Usuario agregado correctamente',
                            'success'
                        );</script>";
                } else {
                    echo "<script>Swal.fire({
                            icon: 'error',
                            title: 'ERROR',
                            text: 'No se pudo agregar el usuario'
                        });</script>";
                }
            } //. mysqli_error($conn) .

            //actualizar clave de usuario
            if (isset($_POST["cc_usuario_actualizar"]) && isset($_POST["clave_usuario_actualizar"])) {
                $cc_usuario_actualizar = $_POST["cc_usuario_actualizar"];
                $clave_usuario_actualizar = $_POST["clave_usuario_actualizar"];

                $sql = "UPDATE Usuarios SET contraseña_onelock = '$clave_usuario_actualizar' WHERE usuario_onelock = '$cc_usuario_actualizar'";
                mysqli_query($conn, $sql);
                if (mysqli_affected_rows($conn) > 0) {
                    echo "<script>Swal.fire(
                            'Good job!',
                            'Clave cambiada correctamente',
                            'success'
                        );</script>";
                } else {
                    echo "<script>Swal.fire({
                            icon: 'error',
                            title: 'ERROR',
                            text: 'No se pudo cambiar la clave'
                        });</script>";
                }
            }

            // Eliminar usuario
            if (isset($_POST["cc_usuario_eliminar"])) {
                $cc_usuario_eliminar = $_POST["cc_usuario_eliminar"];
            
                $sql = "DELETE FROM Usuarios WHERE usuario_onelock = '$cc_usuario_eliminar'";
                mysqli_query($conn, $sql);
            
                if (mysqli_affected_rows($conn) > 0) {
                    echo "<script>Swal.fire(
                            '¡Buen trabajo!',
                            'Usuario eliminado correctamente',
                            'success'
                        );</script>";
                } else {
                    echo "<script>Swal.fire({
                            icon: 'error',
                            title: 'ERROR',
                            text: 'No se pudo encontrar el usuario ocurrio un error al eliminarlo'
                        });</script>";
                }
            }
            
            //asignar aplicativos
            if (isset($_POST["usuario_app"]) && isset($_POST["aplicativos"]) && isset($_POST["usuario_asignar"]) && isset($_POST["clave_usuario_app"])) {
                $usuario_app = $_POST["usuario_app"];
                $clave_usuario_app = $_POST["clave_usuario_app"];
                $aplicativo = $_POST["aplicativos"];
                $usuario_asignar = $_POST["usuario_asignar"];

                $columna = "";
                $columna2 = "";

                if ($aplicativo === "poliedro") {
                    $columna = "contraseña_poliedro";
                    $columna2 = "poliedro";
                } elseif ($aplicativo === "id_vision") {
                    $columna = "contraseña_idvision";
                    $columna2 = "id_vision";
                } elseif ($aplicativo === "crm") {
                    $columna = "contraseña_crm";
                    $columna2 = "crm";
                } elseif ($aplicativo === "my_app") {
                    $columna = "contraseña_myapp";
                    $columna2 = "my_app";
                } elseif ($aplicativo === "sap") {
                    $columna = "contraseña_sap";
                    $columna2 = "sap";
                } elseif ($aplicativo === "visor") {
                    $columna = "contraseña_visor";
                    $columna2 = "visor";
                } elseif ($aplicativo === "cali_express") {
                    $columna = "contraseña_caliexpress";
                    $columna2 = "cali_express";
                } elseif ($aplicativo === "lecta") {
                    $columna = "contraseña_lecta";
                    $columna2 = "lecta";
                } elseif ($aplicativo === "integra") {
                    $columna = "contraseña_integra";
                    $columna2 = "integra";
                }

                $sql = "UPDATE Usuarios SET $columna = '$clave_usuario_app', $columna2 = '$usuario_app' WHERE usuario_onelock = '$usuario_asignar'";
                mysqli_query($conn, $sql);
                if (mysqli_affected_rows($conn) > 0){
                    echo "<script>Swal.fire(
                            'Good job!',
                            'Aplicativo asignado correctamente',
                            'success'
                        );</script>";
                } else {
                    echo "<script>Swal.fire({
                            icon: 'error',
                            title: 'ERROR',
                            text: 'No se pudo asignar el aplicativo'
                        });</script>";
                }
            }
        }
        // Cerrar la conexión con la base de datos
        mysqli_close($conn);
    ?>

</body>
</html>