<?php declare (strict_types = 1);

function responseText($response, int $code, $success = false, $cache = false, $message, array $data) {
	$response->setHttpStatusCode($code);
	$response->setSuccess($success);
	$response->setCache($cache);
	$response->addMessage($message);
	$response->setData($data);
	$response->send();
}