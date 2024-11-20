<?php
require_once 'config/config.php';
require_once 'clases/clienteFunciones.php';
$db = new Database();
$con = $db->conectar();

$proceso = isset($_GET['pago']) ? 'pago' : 'login';

$errors = [];

if (!empty($_POST)) {

  $usuario = trim($_POST['usuario']);
  $password = trim($_POST['password']);
  $proceso = $_POST['proceso'] ?? 'login';

  if (esNulo([$usuario, $password])) {
    $errors[] = "Debe llenar todos los campos";
  }
  if (count($errors) == 0) {
    $errors[] = login($usuario, $password, $con, $proceso);
  }
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Tuerca Dorada</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="../Ecommerce/css/login.css" rel="stylesheet">

</head>

<body>
  <header>
    <div class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <a href="index.php" class="navbar-brand">
          <strong> <img src=".//icons//nut.svg" alt="">Tuerca Dorada</strong>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader"
          aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarHeader">
          <div class="ms-auto">
            <a href="checkout.php" class="btn btn-primary btn-sm me-2">
              <i class="fas fa-shopping-cart"></i> <img src="../Ecommerce/icons/cart-shop.svg" alt=""> <span
                id="num_cart" class="badge bg-secondary"><?php echo $num_cart; ?></span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </header>


  <div class="main-container">
    <main class="form-login pt-4">
      <div class="wrapper">
        <h2>Iniciar Sesión</h2>
        <?php mostrarMensajes($errors); ?>

        <form class="row g-3" action="login.php" method="post" autocomplete="off">
          <input type="hidden" name="proceso" value="<?php echo $proceso; ?>">

          <div class="input-box">
            <input class="form-control" type="text" name="usuario" id="usuario" placeholder="Usuario" required>
          </div>

          <div class="input-box">
            <input class="form-control" type="password" name="password" id="password" placeholder="Contraseña" required>
          </div>

          <div class="remember-forgot">
            <a href="recupera.php">¿Olvidaste tu contraseña?</a>
          </div>

          <div class="d-grid gap-3 col-12">
            <button type="submit" class="btn btn-primary">Ingresar</button>
          </div>
          <div class="col-12">
            ¿No tienes cuenta? <a href="registro.php">Regístrate aquí</a>
          </div>
          <!--
          <div class="d-grid gap-3 col-12">
            <button class="btn btn-primary" onclick="window.location.href='/Ecommerce/admin/index.php'">Ingresar como
              administrador</button>
          </div>
          -->
        </form>
      </div>
    </main>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
  </script>
</body>


</html>