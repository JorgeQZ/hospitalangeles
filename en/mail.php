<?php

// RECAPTCHA
$recaptcha = $_POST["g-recaptcha-response"];
$url = 'https://www.google.com/recaptcha/api/siteverify';
$data = array(
    'secret' => '6LedFf0UAAAAADqTtfOvbmvzhWcEfnRUy_P3QD4q',
    'response' => $recaptcha
);

$options = array(
    'http' => array (
        'method' => 'POST',
        'content' => http_build_query($data)
    )
);

$context  = stream_context_create($options);
$verify = file_get_contents($url, false, $context);
$captcha_success = json_decode($verify);

if ($captcha_success->success) {
  $cabeceras = 'From: contacto@visionbariatrica.com' . "\r\n" .
  'Reply-To: '.$_POST["correo"]. "\r\n" .
  'X-Mailer: PHP/' . phpversion();

  $cuerpo = '<!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Document</title>
      <style>
        * {
          font-family: Arial, Helvetica, sans-serif;
        }

      </style>
    </head>

    <body>
      <center>
        <table style="width: 100%; max-width: 500px;">
          <thead>
            <th>Name</th>
            <th>Phone</th>
            <th>Email</th>
          </thead>
          <tbody>
            <tr>
              <td align="center">'.$_POST['nombre'].'</td>
              <td align="center">'.$_POST['telefono'].'</td>
              <td align="center">'.$_POST['correo'].'</td>
            </tr>
          </tbody>
        </table>
        <br>
        <table style="width: 100%; max-width: 500px;">
          <thead>
            <th>Tratamiento de interes</th>
          </thead>
          <tbody>
            <tr>
              <td align="center">'.$_POST['tratamiento'].'</td>
            </tr>
          </tbody>
        </table>
        <br>
        <table style="width: 100%; max-width: 500px;">
          <thead>
            <th>Age</th>
            <th>Weight (lb)</th>
            <th>Heitgh (Ft)</th>
            <th>Heitgh (Inch)</th>
            <th>BMI</th>
          </thead>
          <tbody>
            <tr>
              <td align="center">'.$_POST['edad'].'</td>
              <td align="center">'.$_POST['pesolb'].'</td>
              <td align="center">'.$_POST['estaturaft'].'</td>
              <td align="center">'.$_POST['estaturainch'].'</td>
              <td align="center">'.$_POST['imc'].'</td>
            </tr>
          </tbody>
        </table>
      </center>
    </body>
    </html>
    ';
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    mail("jorge_qzg@hotmail.com","Contacto VisiÃ³n BariÃ¡trica",$cuerpo,$cabeceras);
    $data['type'] = 'success';
    echo json_encode($data, JSON_FORCE_OBJECT);
    exit;
}
