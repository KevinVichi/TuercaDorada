<?php
require '../config/config.php';

session_start();

$db = new Database();
$con = $db->conectar();

$json = file_get_contents('php://input');
$datos = json_decode($json, true);

print_r($datos);

if (is_array($datos)) {

  $idCliente = $_SESSION['user_cliente'];
  $sql = $con->prepare("SELECT email FROM clientes WHERE id=? AND estatus = 1");
  $sql->execute([$idCliente]);
  $row_cliente = $sql->fetch(PDO::FETCH_ASSOC);

  $id_transaccion = $datos['detalles']['id'];
  $total = $datos['detalles']['purchase_units'][0]['amount']['value'];
  $status = $datos['detalles']['status'];
  $fecha = $datos['detalles']['update_time'];
  $fecha_nueva = date('Y-m-d H:i:s');
  $email = $row_cliente['email'];

  $sql = $con->prepare("INSERT INTO compras (id_transaccion, fecha, status, email, id_cliente, total, medio_pago) VALUES (?,?,?,?,?,?,?)");
  $sql->execute([$id_transaccion, $fecha, $status, $email, $idCliente, $total, 'paypal']);
  $id = $con->lastInsertId();

  if ($id > 0) {
    $productos = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] : null;
    if ($productos != null) {
      foreach ($productos as $clave => $cantidad) {
        $sql = $con->prepare("SELECT id, nombre, precio, descuento FROM productos WHERE id=? AND activo = 1");
        $sql->execute([$clave]);
        $row_prod = $sql->fetch(PDO::FETCH_ASSOC);

        $precio = $row_prod['precio'];
        $descuento = $row_prod['descuento'];
        $precio_desc = $precio - (($precio * $descuento) / 100);

        $sql_insert = $con->prepare("INSERT INTO detalle_compra (id_compra, id_producto, nombre, precio, cantidad) VALUES (?,?,?,?,?)");
        if ($sql_insert->execute([$id, $row_prod['id'],  $row_prod['nombre'], $precio_desc, $cantidad])) {
          restarStock($row_prod['id'], $cantidad, $con);
        }
      }

      require 'Mailer.php';

      $asunto = "Detalles de su compra";
      $cuerpo = '<div style="font-family: Arial, sans-serif; color: #333; padding: 20px; border: 1px solid #ddd; border-radius: 5px;">';
      $cuerpo .= '<h2 style="color: #4CAF50;">Gracias por preferirnos :)</h2>';
      $cuerpo .= '<img src="https://elements-resized.envatousercontent.com/elements-cover-images/00ac97bf-ba4f-4167-9982-99986ded3703?w=1370&cf_fit=scale-down&q=85&format=auto&s=5f2a614cde2a8719b64242a042b1f06327e45458d05716b8c312d146f41fce8b" alt="Logo de la tienda" style="width: 100%; max-width: 300px; margin-bottom: 20px;">';
      $cuerpo .= '<table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">';
      $cuerpo .= '<tr style="background-color: #f2f2f2;">';
      $cuerpo .= '<th style="border: 1px solid #ddd; padding: 8px;">Descripción</th>';
      $cuerpo .= '<th style="border: 1px solid #ddd; padding: 8px;">Detalles</th>';
      $cuerpo .= '</tr>';
      $cuerpo .= '<tr>';
      $cuerpo .= '<td style="border: 1px solid #ddd; padding: 8px;">Folio de la compra</td>';
      $cuerpo .= '<td style="border: 1px solid #ddd; padding: 8px;">' . $id_transaccion . '</td>';
      $cuerpo .= '</tr>';
      $cuerpo .= '<tr>';
      $cuerpo .= '<td style="border: 1px solid #ddd; padding: 8px;">Fecha de la compra</td>';
      $cuerpo .= '<td style="border: 1px solid #ddd; padding: 8px;">' . $fecha . '</td>';
      $cuerpo .= '</tr>';
      $cuerpo .= '<tr>';
      $cuerpo .= '<td style="border: 1px solid #ddd; padding: 8px;">Total</td>';
      $cuerpo .= '<td style="border: 1px solid #ddd; padding: 8px;">' . $total . '</td>';
      $cuerpo .= '</tr>';
      $cuerpo .= '</table>';
      $cuerpo .= '<h4>Puede ver los detalles de su pago en el siguiente enlace:</h4>';
      $cuerpo .= '<p><a href="http://localhost/Ecommerce/completado.php?key=' . $id_transaccion . '" style="color: #4CAF50; text-decoration: none;">Ver detalles del pago</a></p>';
      $cuerpo .= '</div>';

      $mailer = new Mailer();
      $mailer->enviarEmail($email, $asunto, $cuerpo);
    }
    unset($_SESSION['carrito']);
  }
}

function restarStock($id, $cantidad, $con)
{
  $sql = $con->prepare("UPDATE productos SET stock = stock - ? WHERE id = ?");
  $sql->execute([$cantidad, $id]);
}
