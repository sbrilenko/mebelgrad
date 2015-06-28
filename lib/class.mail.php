<?php
/*

 * 
 */

$to = $_POST['mail_to']; 
$subject = $_POST['name']; 
// тема письма 

$message = 'Как к вам обращаться: '.$_POST['name'].'<br />Контактные данные: '.$_POST['mail_to'].' <br />Вопрос: '.$_POST['text']; 

$header="Content-type: text/html; charset=\"utf-8\"";
$header.="From: ".$subject." ".$to;
$header.="Subject: ".$subject;
$header.="Content-type: text/html; charset=\"utf-8\"";

//$message = '=?utf-8?B?'.base64_encode($message).'?=';
$subject = '=?utf-8?B?'.base64_encode("Вопрос с сайта «EXTRA»").'?=';
$headers = "From: ".$subject." mail ".$to." \n";
mail("manager@anafta.dn.ua, yunia@mail.ru", $subject, $message, $header);
//manager@anafta.dn.ua
?>
