<?php
require 'config/database.php';
require 'config/config.php';
require 'clases/adminFunciones.php';

$db = new Database();
$con = $db->conectar();

$errors = [];

if (!empty($_POST)) {

  $password = trim($_POST['password']);
  $repassword = trim($_POST['repassword']);

  if (esNulo([$user_id, $password, $repassword])) {
    $errors[] = "Debe llenar todos los campos";
  }

  if (!validaPassword($password, $repassword)) {
    $errors[] = "Las contraseñas no coinciden";
  }

  if (empty($errors)) {
    $pass_hash = password_hash($password, PASSWORD_DEFAULT);
    if (actualizaPasswordAdmin($user_id, $pass_hash, $con)) {
      $errors[] = "Contraseña modificada.";
    } else {
      $errors[] = "Error al modificar la contraseña. Intentalo nuevamente.";
    }
  }
}
?>

<head>
  <link href="../admin/css/login.css" rel="stylesheet" />
</head>

<main class="form-login m-auto pt-4">
  <h3>Cambiar contraseña</h3>

  <form action="cambiar_password.php" method="post" class="row g-3" autocomplete="off">

    <div class="form-floating">
      <input type="text" class="form-control" id="password">
      <label for="usuario">Usuario</label>
    </div>

    <div class="form-floating">
      <input type="password" class="form-control" id="password" name="password" placeholder="Nueva contraseña" require
        autofocus>
      <label for="password">Nueva Contraseña</label>
    </div>

    <div class="form-floating">
      <input type="password" class="form-control" id="repassword" name="repassword" placeholder="Confirmar contraseña"
        require>
      <label for="repassword">Confirmar Contraseña</label>
    </div>

    <div class="d-grid gap-3 col-12">
      <button type="submit" class="btn btn-primary">Actualizar</button>
    </div>

  </form>
</main>