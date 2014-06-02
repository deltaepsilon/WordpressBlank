<?php
/**
 * Created by JetBrains PhpStorm.
 * User: christopheresplin
 * Date: 1/1/13
 * Time: 9:26 PM
 */
$name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
$email = $_POST['email'];
$subject = filter_var($_POST['subject'], FILTER_SANITIZE_STRING);
$body = filter_var($_POST['body'], FILTER_SANITIZE_STRING);
$captcha = filter_var(intval($_POST['captcha']), FILTER_SANITIZE_NUMBER_INT);
$errors = array();

if (empty($name)) {
	$errors[] = array('notification' => 'Sender name is empty.');
}

if (empty($email)) {
	$errors[] = array('notification' => 'Sender email is empty.');
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	$errors[] = array('notification' => 'Sender email is invalid.');
}

if (empty($body)) {
	$errors[] = array('notification' => 'Sender body is empty.');
}

if (empty($captcha) || $captcha != 2) {
	$errors[] = array('notification' => "You'd best not be a dirty spammer. What is 1+1? Just type 2. Really. Just 2.  You typed ".$captcha.".");
}

if (count($errors) == 0) {
	$email = strip_tags($email);
	$headers = "From: melissa@melissaesplin.com\r\n";
	$headers .= "Reply-To: $email\r\n";
	$headers .= "Content-Type: text/html\r\n";
	$result = mail('melissaesplin@gmail.com', $subject, $body, $headers);
	$secondCopy = mail('melissa@melissaesplin.com', $subject, $body, $headers);
	if ($result) {
		echo json_encode(array( 'type' => 'success', 'notifications' => array(array('notification' => 'Email sent'))));
		return;
	} else {
		$errors[] = array('notification' => "Email was not sent due to server error.  This mail function uses php's native mail() function, so make sure that the server is configured correctly to send mail from PHP.");
	}
}
echo json_encode(array('type' => 'error', 'notifications' => $errors));
