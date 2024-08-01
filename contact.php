<?php

date_default_timezone_set('America/Chicago');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
    // Function to sanitize and encode form data
    function sanitize_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        return $data;
    }

    // Collect, sanitize, and encode form data
	foreach ($_POST as $key => $value) {
        $sanitized_post[$key] = sanitize_input($value);
    }
	
	// ***** UPDATE THIS VARIABLE ONLY ***** //
	// ***** UPDATE THIS VARIABLE ONLY ***** //
    $send_to = strtolower('craftingpixelsteam@gmail.com'); /** CHANGE THIS EMAIL **/

	$hash_key = md5($send_to.md5(strtoupper($_SERVER['HTTP_USER_AGENT'])));
	
	$hash_salt = base64_encode(strtolower(strrev(substr(str_rot13(preg_replace('#[a-zA-Z]#','',$send_to)),0,12))));
	$hash_salt = substr(str_rot13(preg_replace('#[a-zA-Z0-9]#','',$hash_salt)),1,10);
	
	$hash_output = hash('sha256',$hash_salt.$hash_key);

    // URL of the script on the recipient's domain to handle the form submission
    $url = 'http://mailer.zappyengine.com/mailer-forward.php';

    // Initialize cURL session
    $ch = curl_init($url);

    // Set the POST method, form data, and other options
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array_merge($sanitized_post, array(
        'hash_output' => $hash_output,
        'send_to' => $send_to,
		'user_agent' => $_SERVER['HTTP_USER_AGENT']
    ))));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);

    // Execute the cURL session
    $response = curl_exec($ch);

    // Check for errors
    if ($response === false) {
        die('cURL error: ' . curl_error($ch));
    }
	
    // Close cURL session
    curl_close($ch);
    // Redirect user to a thank you page
    header("Location: thank-you.html"); // ***** THANK YOU PAGE ***** //
    exit;
}
?>