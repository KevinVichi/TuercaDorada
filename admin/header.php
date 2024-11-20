<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Dashboard - SB Admin</title>
  <link href="<?php echo ADMIN_URL; ?>css/styles.css" rel="stylesheet" />
  <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link href="../css/header.css" rel="stylesheet" />


</head>

<body class="sb-nav-fixed">
  <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a href="../inicio.php" class="navbar-brand">

      <div class="sb-nav-link-icon"> <i class="fas fa-home" style="color: #fff"></i><strong> Tuerca Dorada</strong>
      </div>

    </a>

    <script>
      // Obtén la URL actual
      var currentUrl = window.location.pathname;

      // Encuentra el elemento del enlace por su ID
      var navbarBrand = document.getElementById('navbar-brand');

      // Verifica si la URL actual es "admin/inicio.php"
      if (currentUrl.endsWith("admin/inicio.php")) {
        // Si la URL es "admin/inicio.php", cambia el href a "inicio.php"
        navbarBrand.href = "admin/inicio.php";
      } else {
        // Si no es "admin/inicio.php", asegura que el href sea "../inicio.php"
        navbarBrand.href = "../inicio.php";
      }
    </script>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
        class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
      <div class="input-group">

      </div>
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
          aria-expanded="false"><i class="fas fa-user fa-fw"></i><?php echo $_SESSION['user_name']; ?></a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
          <li><a class="dropdown-item"
              href="<?php echo ADMIN_URL; ?>cambiar_password.php?id=<?php echo $_SESSION['user_id']; ?>">Cambiar
              Contraseña</a></li>
          <li>
            <hr class="dropdown-divider" />
          </li>
          <li><a class="dropdown-item" href="../logout.php">Cerrar Sesión</a></li>
        </ul>
      </li>
    </ul>
  </nav>
  <div id="layoutSidenav">
    <div id="layoutSidenav_nav">
      <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
          <div class="nav">

            <a class="nav-link" href="<?php echo ADMIN_URL; ?>usuarios">
              <div class="sb-nav-link-icon"><i class="fas fa-users" style="color: #fff"></i></div>
              Usuarios
            </a>


            <a class="nav-link" href="<?php echo ADMIN_URL; ?>categorias">
              <div class="sb-nav-link-icon"><i class="fas fa-folder" style="color: #fff"></i></div>
              Categorias
            </a>


            <a class="nav-link" href="<?php echo ADMIN_URL; ?>productos">
              <div class="sb-nav-link-icon"><i class="fas fa-box" style="color: #fff"></i></div>
              Productos
            </a>


            <a class="nav-link" href="<?php echo ADMIN_URL; ?>compras">
              <div class="sb-nav-link-icon"> <i class="fas fa-shopping-cart" style="color: #fff"></i></div>
              Compras
            </a>



            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
              <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth"
                  aria-expanded="false" aria-controls="pagesCollapseAuth">
                  Authentication
                  <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne"
                  data-bs-parent="#sidenavAccordionPages">
                  <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="login.html">Login</a>
                    <a class="nav-link" href="register.html">Register</a>
                    <a class="nav-link" href="password.html">Forgot Password</a>
                  </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError"
                  aria-expanded="false" aria-controls="pagesCollapseError">
                  Error
                  <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>

              </nav>
            </div>

          </div>
        </div>

      </nav>
    </div>
    <div id="layoutSidenav_content">

      <script>
        document.querySelectorAll('.nav-link').forEach(link => {
          link.addEventListener('click', function() {
            document.querySelectorAll('.nav-link').forEach(item => item.classList.remove('active'));
            this.classList.add('active');
          });
        });
      </script>