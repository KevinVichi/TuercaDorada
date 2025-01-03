<?php
require_once 'config/config.php';
require_once 'config/database.php';

$db = new Database();
$con = $db->conectar();

$idCategoria = $_GET['cat'] ?? '';
$orden = $_GET['orden'] ?? '';
$buscar = $_GET['q'] ?? '';

$orders = [
  'asc' => 'nombre ASC',
  'desc' => 'nombre DESC',
  'precio_alto' => 'precio DESC',
  'precio_bajo' => 'precio ASC'
];

$order = $orders[$orden] ?? '';

$params = [];

$query = "SELECT id, slug, nombre, precio FROM productos WHERE activo = 1";

if ($buscar != '') {
  $query .= " AND nombre LIKE ?";
  $params[] = "%$buscar%";
}

if ($idCategoria != '') {
  $query .= " AND id_Categoria = ?";
  $params[] = $idCategoria;
}

if (!empty($order)) {
  $query .= " ORDER BY $order";
}

$query = $con->prepare($query);
$query->execute($params);

$resultado = $query->fetchAll(PDO::FETCH_ASSOC);

$sqlCategorias = $con->prepare("SELECT id, nombre FROM categorias WHERE activo = 1");
$sqlCategorias->execute();
$categorias = $sqlCategorias->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tuerca Dorada</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="../Ecommerce/css//index.css">
</head>

<body>
  <?php include 'menu.php'; ?>
  <main class="flex-shrink-0">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
          <div class="sidebar">
            <div class="sidebar-header">
              <h5>Categorías</h5>
            </div>
            <div class="list-group">
              <a href="index.php" class="list-group-item list-group-item-action">
                Todo
              </a>
              <?php foreach ($categorias as $categoria) { ?>
                <a href="index.php?cat=<?php echo $categoria['id']; ?>"
                  class="list-group-item list-group-item-action <?php if ($idCategoria == $categoria['id']) echo 'active'; ?>">
                  <?php echo $categoria['nombre']; ?>
                </a>
              <?php } ?>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-9 main-content">
          <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
            <?php foreach ($resultado as $row) { ?>
              <div class="col mb-2">
                <div class="card shadow-sm h-100">
                  <?php
                  $id = $row['id'];
                  $imagen = "images/productos/" . $id . "/principal.jpg";
                  if (!file_exists($imagen)) {
                    $imagen = "images/no-photo.jpg";
                  }
                  ?>
                  <a href="details/<?php echo $row['slug']; ?>">
                    <img alt="" src="<?php echo $imagen; ?>" class="d-block w-100">
                    <div class="card-body">
                  </a>
                  <h5 class="card-title"><?php echo $row['nombre']; ?></h5>
                  <p class="card-text">$ <?php echo $row['precio']; ?></p>
                  <div class="d-flex justify-content-between align-items-center">

                    <button class="btn btn-yellow" type="button"
                      onclick="addProducto(<?php echo $row['id']; ?>, '<?php echo hash_hmac('sha1', $row['id'], KEY_TOKEN); ?>')">
                      Agregar
                    </button>

                  </div>
                </div>
              </div>
          </div>
        <?php } ?>
        </div>
      </div>
    </div>
    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
  </script>
  <script>
    function addProducto(id, token) {
      let url = 'clases/carrito.php';
      let formData = new FormData();
      formData.append('id', id);
      formData.append('token', token);

      fetch(url, {
          method: 'POST',
          body: formData,
          mode: 'cors'
        }).then(response => response.json())
        .then(data => {
          if (data.ok) {
            let elemento = document.getElementById("num_cart");
            elemento.innerHTML = data.numero;
          } else {
            alert('No hay suficientes existencias');
          }
        });
    }
  </script>
</body>

</html>