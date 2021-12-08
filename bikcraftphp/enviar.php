<?php

// Trocar os valores abaixo

$emailenvio = 'contato@bikcraft.com';
$assunto = 'Formulário Bikcraft';
$url = 'http://bikcraft.com';

// Mude até aqui apenas

$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$mensagem = $_POST['mensagem'];

$body = "$mensagem\n\n---------------\n\n$nome\n$telefone\n$email";

if ($_POST['leaveblank'] != '' or $_POST['dontchange'] != 'http://') {

	echo "Não foi possível enviar o e-mail. Tente novamente ou entre em contato com " . $emailenvio;
	echo "<meta HTTP-EQUIV='Refresh' CONTENT='10;URL=" . $url . "'>";
} else if (isset($_POST['email'])) {

	require('./PHPMailer/PHPMailerAutoload.php');

	$mail = new PHPMailer;
	$mail->CharSet = 'UTF-8';
	$mail->WordWrap = 70;
	$mail->addAddress($emailenvio);

	$mail->From = $email;
	$mail->FromName = $nome;
	$mail->AddReplyTo($email, $nome);
	$mail->Subject = $assunto;

	$mail->Body = $body;

	if (!$mail->send()) {
		echo "Não foi possível enviar o e-mail. Tente novamente ou entre em contato com " . $emailenvio;
		echo "<meta HTTP-EQUIV='Refresh' CONTENT='10;URL=" . $url . "'>";
	} else {
		echo "E-mail enviado com sucesso!";
		echo "<meta HTTP-EQUIV='Refresh' CONTENT='2;URL=" . $url . "'>";
	}
}
