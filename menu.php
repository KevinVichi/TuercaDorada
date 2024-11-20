<head>
  <link rel="stylesheet" href="../Ecommerce//css/estilos.css">
</head>

<header>
  <div class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a href="index.php" class="navbar-brand">
        <img src="../Ecommerce/icons/nut.svg" alt="">
        <strong>Tuerca Dorada</strong>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader"
        aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarHeader">

        <div class="search-bar mx-auto">
          <form action="index.php" method="get" autocomplete="off">
            <div class="input-group pe-3">
              <input type="text" name="q" id="q" class="form-control form-control-sm" placeholder="Buscar"
                aria-describedby="icon-buscar">
              <button type="submit" id="icon-buscar" class="btn btn-outline-primary btn-sm">
                <i class="fas fa-search"><img src="../Ecommerce/icons//search.svg" alt=""></i>
              </button>
            </div>
          </form>
        </div>

        <a href="checkout.php" class="btn btn-primary btn-sm me-2">
          <img src="../Ecommerce/icons/cart-shop.svg" alt="">
          <i class="fas fa-shopping-cart"></i> <span id="num_cart"
            class="badge bg-secondary"><?php echo $num_cart; ?></span>
        </a>
        <?php if (isset($_SESSION['user_id'])) { ?>

          <div class="dropdown">
            <button class="btn btn-success btn-sm dropdown-toggle" type="button" id="btn_session"
              data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa-solid fa-user"><img src="../Ecommerce//icons//user.svg" alt=""></i> &nbsp;
              <?php echo $_SESSION['user_name']; ?>
            </button>

            <ul class="dropdown-menu" aria-labelledby="btn_session">
              <li><a class="dropdown-item" href="compras.php">Mis Compras</a></li>
              <li><a class="dropdown-item" href="logout.php">Cerrar sesión</a></li>
              <li><a class="dropdown-item" href="../Ecommerce/admin/index.php">Administrador</a></li>
            </ul>

          </div>
        <?php } else { ?>
          <a href="login.php" class="btn btn-secondary btn-sm">
            <i class="fa-solid fa-user"><img src="../Ecommerce//icons//user-plus.svg" alt=""></i> Ingresar </a>
        <?php } ?>
      </div>
    </div>
  </div>
</header>