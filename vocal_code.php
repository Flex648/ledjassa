<?php
$code = $_GET['code'] ?? '000000';
$code_lisible = implode(' ', str_split($code));

header('Content-Type: text/xml');
echo <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<Response>
    <Say voice="alice" language="en-US">Your verification code is: $code_lisible.</Say>
    <Pause length="1"/>
    <Say voice="alice" language="en-US">Once again, your code is: $code_lisible.</Say>
</Response>
XML;
