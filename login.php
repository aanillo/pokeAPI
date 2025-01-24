<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<?php
$login_incorrecto = false;
require_once "header.php";

require_once "jsonhandler.php";
$usuarios = loadEventsFromJson();

if(isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    require_once "funciones.php";
    $logged = login($email, $password, $usuarios);

    if ($logged) {
        header("location: api.php");
        exit; 
    } else {
        $login_incorrecto = true;
        $error_message = "Email o contraseña incorrectos.";
    }
}
?>

<div class="div_login">
    <form method="POST" action="login.php"><br>
        <h1 class="white">LOGIN</h1><br>
        <label for="email">Email:</label><br>
        <input name="email" type="text" id="email" class="<?= $login_incorrecto ? 'input-error' : 'input-default' ?>" value="<?= isset($_POST["email"]) ? htmlspecialchars($_POST["email"]) : "" ?>"><br>
        <br>
        <label for="password">Password:</label><br>
        <input name="password" type="password" id="password" class="<?= $login_incorrecto ? 'input-error' : 'input-default' ?>" value="<?= isset($_POST["password"]) ? htmlspecialchars($_POST["password"]) : "" ?>"><br>
        <br>
        <button type="submit">Loguear</button>
    </form>
    <?php if ($login_incorrecto): ?>
        <div class="error-message"><?= $error_message; ?></div>
    <?php endif; ?>
</div>

</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>