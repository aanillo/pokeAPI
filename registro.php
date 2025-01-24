<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
</head>


<?php
require_once "header.php";


$registro_incorrecto = false;
if (isset($_POST['nombre']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password2'])) {
    $emailInput = $_POST['email'] ?? '';
    $passwordInput = $_POST['password'] ?? '';
    $nombreInput = $_POST['nombre'] ?? '';
    $passwordInput2 = $_POST['password2'] ?? '';

    require_once "jsonhandler.php";
    $usuarios = loadEventsFromJson();
    require_once "funciones.php"; 
    $emailExiste = emailCorrecto($emailInput, $usuarios);

    if ($emailExiste === true) {
        $registro_incorrecto = true;
        $error_message = "Error, el email ya existe";
    } elseif ($passwordInput === $passwordInput2) {
        $usuarios = loadEventsFromJson();
        $user = ["email" => $emailInput, "password" => $passwordInput, "nombre" => $nombreInput];
        $usuarios[] = $user;
        saveEventsToJson($usuarios);
        header("Location: login.php");
    } else {
        $registro_incorrecto = true;
        $error_message = "Error, ambas contraseñas deben ser iguales.";
    }
}
?>


<div class="div_reg">
    <form method="POST" action="registro.php"><br>
    <h1 class="white">FORMULARIO DE REGISTRO</h1><br>
    <label for="nombre">Nombre:</label><br>
    <input name="nombre" type="text" id="nombre"  class="<?= $registro_incorrecto ? 'input-error' : 'input-default' ?>" value="<?= isset($_POST["nombre"]) ? $_POST["nombre"] : "" ?>" required><br>
    <br>
    <label for="email">Email:</label><br>
    <input name="email" type="text" id="email" class="<?= $registro_incorrecto ? 'input-error' : 'input-default' ?>" value="<?= isset($_POST["email"]) ? $_POST["email"] : "" ?>" required><br>
    <br>
    <label for="password">Contraseña:</label><br>
    <input name="password" type="password" id="password"  class= "<?= $registro_incorrecto ? 'input-error' : 'input-default' ?>" value="<?= isset($_POST["password"]) ? $_POST["password"] : "" ?>" required><br>
    <br>
    <label for="password2">Repita su contraseña:</label><br>
    <input name="password2" type="password" id="password2" class= "<?= $registro_incorrecto ? 'input-error' : 'input-default' ?>" value="<?= isset($_POST["password2"]) ? $_POST["password2"] : "" ?>" required><br>
    <br>
    <button type="submit">Registrar</button>
    </form>
    <?php if ($registro_incorrecto): ?>
        <div class="error-message"><?= $error_message; ?></div>
    <?php endif; ?>
</div>
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>