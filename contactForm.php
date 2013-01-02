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
	$errors[] = array('error' => 'Sender name is empty.');
}

if (empty($email)) {
	$errors[] = array('error' => 'Sender email is empty.');
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	$errors[] = array('error' => 'Sender email is invalid.');
}

if (empty($body)) {
	$errors[] = array('error' => 'Sender body is empty.');
}

if (count($errors) == 0) {
	$email = strip_tags($email);
	$headers = "From: $email\r\n";
	$headers .= "Reply-To: $email\r\n";
	$headers .= "Content-Type: text/html\r\n";
	$result = mail('christopheresplin@gmail.com', $subject, $body, $headers);
	if ($result) {
		echo json_encode(array('success' => 'Email sent'));
	} else {
		echo json_encode(array('error' => "Email was not sent due to server error.  This mail function uses php's native mail() function, so make sure that the server is configured correctly to send mail from PHP."));
	}
} else {
	echo json_encode(array('errors' => $errors));
}