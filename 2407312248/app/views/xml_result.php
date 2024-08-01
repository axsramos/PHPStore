<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/xml; charset=UTF-8");

echo xmlrpc_encode($data);

