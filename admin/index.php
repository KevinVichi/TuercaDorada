<?php

require 'config/config.php';
require 'config/database.php';
require 'clases/adminFunciones.php';

$db = new Database();
$con = $db->conectar();

$errors = [];

if (!empty($_POST)) {
  $usuario = trim($_POST['usuario']);
  $password = trim($_POST['password']);

  if (esNulo([$usuario, $password])) {
    $errors[] = "Debe llenar todos los campos";
  }

  if (count($errors) == 0) {
    $errors[] = login($usuario, $password, $con);
  }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Login - SB Admin</title>
  <link href="css/styles.css" rel="stylesheet" />
  <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
  <link href="../admin/css/login.css" rel="stylesheet" />

</head>

<body>
  <div class="wrapper">
    <h2>Iniciar Sesión</h2>
    <?php mostrarMensajes($errors); ?>
    <form action="index.php" method="post" autocomplete="off">

      <div class="input-box">
        <input class="form-control" id="usuario" name="usuario" type="text" placeholder="Usuario" required />
      </div>

      <div class="input-box">
        <input class="form-control" id="password" name="password" type="password" placeholder="Contraseña" required />
      </div>


      <div class="d-grid gap-3">
        <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
      </div>

      <br>
      <div class="remember-forgot">
        <a href="../admin/cambiar_password.php">¿Olvidaste tu contraseña?</a>
      </div>

    </form>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
  </script>
  <script src="js/scripts.js"></script>
</body>

</html>