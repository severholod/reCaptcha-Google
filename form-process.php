<?php
require_once '/home/e/elixe/cosmetik.elixire-samara/public_html/phpmailer/Exception.php';
require_once '/home/e/elixe/cosmetik.elixire-samara/public_html/phpmailer/PHPMailer.php';
require_once '/home/e/elixe/cosmetik.elixire-samara/public_html/phpmailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (!empty($_POST["phone"]) || !empty($_POST['email'])){ 
  $name = $_POST["name"];
  $phone = $_POST["phone"];
  $email = $_POST["email"];
  $Body = 'Заказ звонка <br/>';
  $Body .= 'Имя: ';
  $Body .= $name;
  $Body .= '<br/>';
  $Body .= 'Телефон: ';
  $Body .= $phone;
  if (!empty($_POST['email'])){
    $Body .= 'Заказ учебного плана на почту: ';
    $Body .= $email;
  }
  $mail = new PHPMailer(true);   
  try {
    $mail->SMTPDebug = 0;                                
    $mail->isSMTP();                                      
    $mail->Host = 'ssl://smtp.yandex.ru';  
    $mail->SMTPAuth = true;                              
    $mail->Username = 'teplosnab-sait@yandex.ru';          
    $mail->Password = 'SjRWLMske7n7wuc';                         
    $mail->SMTPSecure = 'tls';                           
    $mail->Port = 465;                      

    $mail->setFrom('teplosnab-sait@yandex.ru', 'Elixir');
    $mail->addAddress('info@sdomed.ru', 'Joe User');
    $mail->addAddress('2703060@gmail.com', 'Joe User');    

    $mail->isHTML(true);       
    $mail->Subject = 'Заказ звонка Elixir курс';
    $mail->Body    = str_replace ( "\n" , "" , $Body);

    $mail->send();
    echo 'success';
  } catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
  }
}
?>