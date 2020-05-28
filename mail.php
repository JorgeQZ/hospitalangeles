<?php
header('Content-Type: application/json');


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

        $cuerpo .= "Nombre: ".$_POST["nombre"] . "\n";
				$cuerpo .= "TelÃ©fono: " .$_POST["telefono"] . "\n";
				$cuerpo .= "Correo: " .$_POST["correo"] . "\n";
        $cuerpo .= "\n";
        $cuerpo .= "Tratamiento: ".$_POST["tratamiento"] . "\n";
        $cuerpo .= "\n";
				$cuerpo .= "Edad: " .$_POST["edad"] . "\n";
				$cuerpo .= "Peso: " .$_POST["peso"] . "\n";
				$cuerpo .= "Estatura: " .$_POST["Estatura"] . "\n";
				$cuerpo .= "IMC: " .$_POST["imc"] . "\n";
// mail("contacto@visionbariatrica.com","Contacto VisiÃ³n BariÃ¡trica",$cuerpo,$cabeceras);
mail("jorge_qzg@hotmail.com","Contacto VisiÃ³n BariÃ¡trica",$cuerpo,$cabeceras);
$data['type'] = 'success';
echo json_encode($data, JSON_FORCE_OBJECT);
exit;
}
