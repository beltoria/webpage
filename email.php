<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/PHPMailer-master/src/Exception.php';
require "PHPMailer-master/PHPMailer-master/src/PHPMailer.php";
require 'PHPMailer-master/PHPMailer-master/src/SMTP.php';

$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->SMTPAuth   = true;
//$mail->SMTPDebug = 2;
$mail->Debugoutput = function($str, $level) {$GLOBALS['data']['debug'][] = $str;};
$mail->Host='smtp.yandex.ru';
$mail->Username='genericmail666@yandex.ru';
$mail->Password='vfcgtwzfqklsrbwx';
$mail->SMTPSecure='ssl';
$mail->Port=465;

$mail->CharSet="UTF-8";
$mail->IsHTML(true);

$name = $_POST["name"];
$email = $_POST["email"];
$message = $_POST["message"];
$email_template = "template.html";
$body = file_get_contents($email_template);
$body = str_replace('%name%', $name, $body);
$body = str_replace('%name%', $name, $body);
$body = str_replace('%email%', $email, $body);
$body = str_replace('%message%', $message, $body);

$mail->addAddress("genericmail666@yandex.ru"); 
$mail->setFrom($email);
$mail->Subject = "[Заявка с формы]";
$mail->MsgHTML($body);

if (!$mail->send()) {
    $message = "Error";
  } else {
    $message = "Message has been sent!";
  }
  
  $response = ["message" => $message];
  
  header('Content-type: application/json');
  echo json_encode($response);

?>