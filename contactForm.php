<?php
/**
 * Created by JetBrains PhpStorm.
 * User: christopheresplin
 * Date: 1/1/13
 * Time: 9:26 PM
 */
$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$body = $_POST['body'];

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

if (count($errors) == 0) {
	$email = strip_tags($email);
	$headers = "From: $email\r\n";
	$headers .= "Reply-To: $email\r\n";
	$headers .= "Content-Type: text/html\r\n";
	$result = mail('melissa@melissaesplin.com', $subject, $body, $headers);
	if ($result) {
		echo json_encode(array( 'type' => 'success', 'notifications' => array(array('notification' => 'Email sent'))));
		return;
	} else {
		$errors[] = array('notification' => "Email was not sent due to server error.  This mail function uses php's native mail() function, so make sure that the server is configured correctly to send mail from PHP.");
	}
}
echo json_encode(array('type' => 'error', 'notifications' => $errors));