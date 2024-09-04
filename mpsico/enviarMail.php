<?php

if((isset($_POST['email'])&&(isset($_POST['name']))&&(isset($_POST['message'])))) {

// Debes editar las próximas dos líneas de código de acuerdo con tus preferencias
$email_to = 'gerencia@mpsicocupacional.com';
$email_subject = "Mensaje de Contacto";

// Aquí se deberían validar los datos ingresados por el usuario
if(!isset($_POST['name']) ||
!isset($_POST['message']) ||
!isset($_POST['email'])) {

header("Location: index.php?estado=error");
die();
}

$email_message = "Detalles del formulario de contacto:\n\n";
$email_message .= "Nombre: " . $_POST['name'] . "\n";
$email_message .= "Empresa: " . $_POST['company'] . "\n";
$email_message .= "Telefono: " . $_POST['tel'] . "\n";
$email_message .= "E-mail: " . $_POST['email'] . "\n";
$email_message .= "Comentarios: " . $_POST['message'] . "\n\n";

$email_from = "noreply@ismaelcastro.com";
// Ahora se envía el e-mail usando la función mail() de PHP
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();

mail($email_to, $email_subject, $email_message, $headers);

header("Location: contacto?state=enviado");
}