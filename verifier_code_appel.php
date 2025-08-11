<?php
$from = $_POST['From'] ?? '';
$body = trim($_POST['Body'] ?? '');

header('Content-Type: text/xml');

$stored_code = @file_get_contents("codes/$from.txt");

if ($body === $stored_code) {
    $response_message = "Code vérifié avec succès !";
} else {
    $response_message = "Code incorrect, veuillez réessayer.";
}

echo "<?xml version='1.0' encoding='UTF-8'?>\n";
?>
<Response>
    <Message><?php echo $response_message; ?></Message>
</Response>