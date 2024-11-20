<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '/xampp/htdocs/ITUTISHOP/phpmailer/src/Exception.php';
require '/xampp/htdocs/ITUTISHOP/phpmailer/src/PHPMailer.php';
require '/xampp/htdocs/ITUTISHOP/phpmailer/src/SMTP.php';

$mail = new PHPMailer(true);

try {
  $mail->SMTPDebug = SMTP::DEBUG_OFF;
  $mail->isSMTP();
  $mail->Host       = 'smtp.gmail.com';
  $mail->SMTPAuth   = true;
  $mail->Username   = 'vichicelakevin@gmail.com';
  $mail->Password   = 'vfui kswd eojy nwku';
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
  $mail->Port       = 465;
  solicitaPassword($user_id, $con);
  // Configuración del correo electrónico
  $mail->setFrom('vichicelakevin@gmail.com');
  $mail->addAddress('dayanagualpa385@gmail.com');

  // Contenido del correo
  $mail->isHTML(true);
  $mail->Subject = 'Detalles de su compra';

  $cuerpo = '<div style="font-family: Arial, sans-serif; color: #333; padding: 20px; border: 1px solid #ddd; border-radius: 5px;">';
  $cuerpo .= '<h2 style="color: #4CAF50;">Gracias por preferirnos :)</h2>';
  $cuerpo .= '<img src="../images\fondo.jpg" alt="Logo de la tienda" style="width: 100%; max-width: 300px; margin-bottom: 20px;">';
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

  $mail->Body .= $cuerpo;

  $mail->send();
} catch (Exception $e) {
  echo "Error de correo electrónico: " . $e->getCode() . " - " . $e->getMessage();
}
