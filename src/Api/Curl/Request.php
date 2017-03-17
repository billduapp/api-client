<?php

namespace iInvoices\Api\Curl;


use Nette\Utils\Json;

/**
 * @author Martin Bažík <martin@bazo.sk>
 */
class Request
{

	/** @var string */
	private $type;

	/** @var string */
	private $url;

	/** @var string */
	private $path = '';

	/** @var array */
	private $query = [];

	/** @var array */
	private $data = [];

	/** @var array */
	private $headers = [];

	/** @var array */
	private $callbacks = [];

	public function __construct($type, $url, $data = [], $headers = [], $callbacks = [])
	{
		$this->type = $type;

		$this->url	 = $url;
		$parsedUrl	 = parse_url($url);
		$query		 = [];

		if (isset($parsedUrl['query'])) {
			parse_str($parsedUrl['query'], $query);
		}

		if ($type === 'GET') {
			$query = array_merge($data);
		}

		$this->path		 = $parsedUrl['path'];
		$this->query	 = $query;
		$this->data		 = $data;
		$this->headers	 = $headers;
		$this->callbacks = $callbacks;
	}


	public function setQuery($key, $value)
	{
		$this->query[$key] = $value;
		return $this;
	}


	public function setHeader($key, $value)
	{
		$this->headers[$key] = $value;
		return $this;
	}


	public function getData()
	{
		return $this->data;
	}


	public function send()
	{
		$url = $this->buildUrl();
		$ch	 = curl_init($url);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
		curl_setopt($ch, CURLOPT_VERBOSE, TRUE);
		switch ($this->type) {
			case 'GET':
				curl_setopt($ch, CURLOPT_HTTPGET, TRUE);
				break;
			case 'POST':
				curl_setopt($ch, CURLOPT_POST, TRUE);
				break;
			case 'PATCH':
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
				break;
			case 'DELETE':
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
				break;
		}

		if (!empty($this->data)) {
			$json							 = Json::encode($this->data);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
			$this->headers['Content-Type']	 = 'application/json';
		}

		$headers = $this->buildHeaders();
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

		$response	 = curl_exec($ch);
		$info		 = curl_getinfo($ch);

		$httpCode = $info['http_code'];

		if ($httpCode >= 400 && $httpCode < 500) {
			$e = new ClientException('Client error on url: ' . $url, $httpCode);
			$e->setBody($response);

			throw $e;
		}

		if ($httpCode >= 500 && $httpCode < 600) {
			$e = new ServerException('Server error on url: ' . $url, $httpCode);
			$e->setBody($response);

			throw $e;
		}

		if ($response === FALSE) {
			$error		 = curl_error($ch);
			$errorNumber = curl_errno($ch);

			throw new CurlException($error, $errorNumber);
		}

		curl_close($ch);

		foreach ($this->callbacks['onBeforeResponse'] as $callback) {
			$response = call_user_func_array($callback, [$response]);
		}

		return $response;
	}


	public function buildUrl()
	{
		$this->fireCallbacks($this->callbacks['onBeforeRequest'], [$this]);
		$url = $this->url;

		if (!empty($this->query)) {
			$url .= '?' . http_build_query($this->query);
		}

		return $url;
	}


	private function buildHeaders()
	{
		$headers = [];

		foreach ($this->headers as $key => $value) {
			$headers[] = $key . ': ' . $value;
		}

		return $headers;
	}


	protected function fireCallbacks($callbacks, $args = [])
	{
		foreach ($callbacks as $callback) {
			call_user_func_array($callback, $args);
		}
	}


}
