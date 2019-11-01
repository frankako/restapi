<?php declare (strict_types = 1);

class Response {

	private $_httpStatusCode;
	private $_message;
	private $_toCache = false;
	private $_success = false;
	private $data;
	private $responseData = array();

	public function __construct() {}

	public function setHttpStatusCode($httpStatusCode) {
		$this->_httpStatusCode = $httpStatusCode;
	}

	public function setSuccess($success) {
		$this->_success = $success;
	}

	public function addMessage($message) {
		$this->_message = $message;
	}

	public function setCache($cache) {
		$this->_toCache = $cache;
	}

	public function setData($data) {
		$this->data = $data;
	}

	public function send() {
		header("Access-Control-Allow-Origin: *");
		header("Content-type: application/json; charset=utf-8");
		header("Access-Control-Allow-Headers: Origin, Content-type, Authprization, Accept");

		if (isset($this->_toCache) && $this->_toCache === true) {
			header("Cache-control: max-age = 60");
		} else {header("Cache-control: no-cache, no-store");}

		if (($this->_success != true && $this->_success != false) || !is_numeric($this->_httpStatusCode)) {

			http_response_code(500);
			$this->responseData['statusCode'] = 500;
			$this->responseData['success'] = false;
			$this->responseData['message'] = array("Could not get response. Contact support");
		} else {

			$this->responseData['statusCode'] = $this->_httpStatusCode;
			$this->responseData['success'] = $this->_success;
			$this->responseData['cache'] = $this->_toCache;
			$this->responseData['message'] = $this->_message;
			$this->responseData['data'] = $this->data;
		}

		echo json_encode($this->responseData);
	}

}