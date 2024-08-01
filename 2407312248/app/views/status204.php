<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$message  = new MessageDictionary;
$messages = array();

//http_response_code(204);
http_response_code(200);
array_push($messages, $message->getDictionaryError(3, "Messages", "No Content."));
echo json_encode(
  array("messages" => $messages )
);

