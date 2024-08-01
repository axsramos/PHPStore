<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$message  = new MessageDictionary;
$messages = array();

http_response_code(401);
array_push($messages, $message->getDictionaryError(1, "Messages", "Access denied."));
echo json_encode(
  array("messages" => $messages )
);

