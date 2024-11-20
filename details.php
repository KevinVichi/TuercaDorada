<?php
require 'config/config.php';

$db = new Database();
$con = $db->conectar();

$slug = isset($_GET['slug']) ? $_GET['slug'] : '';
if ($slug == '') {
  echo 'Error al procesar la petición';
  exit;
} else {
  //$token_tmp = hash_hmac('sha1', $id, KEY_TOKEN);
  //if($token == $token_tmp) {
  $sql = $con->prepare("SELECT count(id) FROM productos WHERE slug=? AND activo = 1");
  $sql->execute([$slug]);
  if ($sql->fetchColumn() > 0) {
    $sql = $con->prepare("SELECT id, nombre, descripcion, precio, descuento FROM productos WHERE slug=? AND activo = 1
                LIMIT 1");
    $sql->execute([$slug]);
    $row = $sql->fetch(PDO::FETCH_ASSOC);
    $id = $row['id'];
    $nombre = $row['nombre'];
    $descripcion = $row['descripcion'];
    $precio = $row['precio'];
    $descuento = $row['descuento'];
    $precio_desc = $precio - (($precio * $descuento) / 100);
    $dir_images = 'images/productos/' . $id . '/';

    $rutaImg = $dir_images . 'principal.jpg';

    if (!file_exists($rutaImg)) {
      $rutaImg = 'images/no-photo.jpg';
    }
    $imagenes = array();
    if (file_exists($dir_images)) {
      $dir = dir($dir_images);

      while (($archivo = $dir->read()) != false) {
        if ($archivo != 'principal.jpg' && (strpos($archivo, 'jpg') || strpos($archivo, 'jpeg'))) {
          $imagenes[] = $dir_images . $archivo;
        }
      }
      $dir->close();
    }
    $sqlCaracter = $con->prepare("SELECT DISTINCT(det.id_caracteristica) AS idCat, 
            cat.caracteristica FROM det_prod_caracter AS det INNER JOIN caracteristicas AS cat ON 
            det.id_caracteristica=cat.id  WHERE det.id_producto =?");
    $sqlCaracter->execute([$id]);
  }
}


?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tuerca Dorada</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <base href="<?php echo SITE_URL; ?>/">
  <link rel="stylesheet" href="../Ecommerce/css//details.css">

</head>

<body>
  <?php include 'menu.php'; ?>
  <main>
    <div class="container">
      <div class="row">
        <div class="col-md-6 order-md-1">
          <div id="carouselImages" class="carousel slide">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="<?php echo $rutaImg; ?>" class="d-block w-100">
              </div>
              <?php foreach ($imagenes as $img) { ?>
                <div class="carousel-item">
                  <img src="<?php echo $img; ?>" class="d-block w-100">
                </div>
              <?php } ?>
            </div>

          </div>
        </div>

        <div class="col-md-6 order-md-2">
          <h2><?php echo $nombre; ?></h2>
          <?php if ($descuento > 0) { ?>
            <p><del><?php echo MONEDA . $precio; ?></del></p>
            <h2>
              <?php echo MONEDA . number_format($precio_desc, 2); ?>
              <small class="text-primary"><?php echo $descuento; ?>% descuento</small>
            </h2>
          <?php } else { ?>
            <h2><?php echo MONEDA . $precio; ?></h2>
          <?php } ?>
          <p class="lead">
            <?php echo $descripcion; ?>
          </p>
          <div class="col-3 my-3">
            <p>Cantidad:</p> <input class="form-control" id="cantidad" name="cantidad" type="number" min="1" max="10"
              value="1">
          </div>
          <div class="col-3 my-3">
            <?php
            while ($row_cat = $sqlCaracter->fetch(PDO::FETCH_ASSOC)) {
              $idCat = $row_cat['idCat'];
              echo $row_cat['caracteristica'] . ": ";
              echo "<select class='form-select' id='cat_$idCat'>";

              $sqlDet = $con->prepare("SELECT det.id, det.valor, det.stock FROM 
                        det_prod_caracter AS det WHERE id_producto=? AND 
                        id_caracteristica=?");
              $sqlDet->execute([$id, $idCat]);
              while ($row_det = $sqlDet->fetch(PDO::FETCH_ASSOC)) {
                echo "<option id='" . $row_det['id'] . "'>" . $row_det['valor'] . "</option>";
              }
              echo "</select>";
            }
            ?>
          </div>
          <div class="d-grid gap-3 col-10 mx-auto">

            <button class="btn btn-secondary" type="button" onclick="addProducto(<?php echo $id; ?>, cantidad.value)">
              Agregar al Carrito</button>
          </div>
        </div>
      </div>
    </div>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
  </script>

  <script>
    function addProducto(id, cantidad, token = '') {
      let url = 'clases/carrito.php'
      let formData = new FormData()
      formData.append('id', id)
      formData.append('cantidad', cantidad)
      formData.append('token', token)

      fetch(url, {
          method: 'POST',
          body: formData,
          mode: 'cors'
        }).then(response => response.json())
        .then(data => {
          if (data.ok) {
            let elemento = document.getElementById("num_cart")
            elemento.innerHTML = data.numero
          } else {
            alert('No hay suficientes existencias')
          }
        })
    }
  </script>
</body>

</html>