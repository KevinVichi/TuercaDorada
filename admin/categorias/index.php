<?php
require  '../config/database.php';
require  '../config/config.php';
require  '../header.php';

if (!isset($_SESSION['user_type'])) {
  header('Location: ../index.php');
  exit;
}

if ($_SESSION['user_type'] != 'admin') {
  header('Location: ../../index.php');
  exit;
}

$db = new Database();
$con = $db->conectar();

$sql = "SELECT * FROM categorias WHERE activo = 1";
$resultado = $con->query($sql);
$categorias = $resultado->fetchAll(PDO::FETCH_ASSOC);

?>

<head>
  <link href="../../css/checkout.css" rel="stylesheet" />
</head>

<main>
  <div class="container-fluid px-4">

    <div class="text-end">
      <a href="nuevo.php" class="btn btn-secondary">Nuevo</a>
    </div>
    <br>

    <div class="table-responsive">
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">CATEGORIA</th>
            <th scope="col">EDITAR</th>
            <th scope="col">ELIMINAR</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($categorias as $categoria) { ?>
          <tr>
            <td><?php echo $categoria['id'] ?></td>
            <td><?php echo $categoria['nombre'] ?></td>
            <td><a class="btn btn-secondary btn-sm" href="edita.php?id=<?php echo $categoria['id']; ?>">
                <img src=" ../../icons/edit.svg" alt="">
            </td>
            <td>
              <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalElimina"
                data-bs-id="<?php echo $categoria['id'] ?>">
                <img src=" ../../icons/delete.svg" alt="">
              </button>
            </td>
          </tr>

          <?php } ?>
        </tbody>
      </table>
    </div>

  </div>
</main>

<div class="modal fade" id="modalElimina" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
  aria-labelledby="modalTitleId" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitleId">
          Confirmar
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">¿Desea eliminar el registro?</div>
      <div class="modal-footer">
        <form action="elimina.php" method="post">
          <input type="hidden" name="id">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            Cerrar
          </button>
          <button type="submit" class="btn btn-danger">Eliminar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
let eliminaModal = document.getElementById('modalElimina');
eliminaModal.addEventListener('show.bs.modal', function($event) {
  let button = event.relatedTarget
  let id = button.getAttribute('data-bs-id')

  let modalInput = eliminaModal.querySelector('.modal-footer input')
  modalInput.value = id
})
</script>

<?php require '../footer.php' ?>