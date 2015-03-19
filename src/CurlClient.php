<?php

namespace iInvoices;


/**
 * @author Martin Bažík <martin@bazo.sk>
 */
class CurlClient
{

	const GET		 = 'GET';
	const POST	 = 'POST';
	const PUT		 = 'PUT';
	const PATCH	 = 'PATCH';
	const DELETE	 = 'DELETE';

	/** @var string */
	private $endpoint;

	/** @var array */
	private $defaultHeaders = [];

	public function __construct($endpoint)
	{
		$this->endpoint = $endpoint;
	}


	public function setDefaultHeaders($defaultHeaders)
	{
		$this->defaultHeaders = $defaultHeaders;

		return $this;
	}

	private function getHeaders($headers = []) {
		$contentType = ['Content-Type' => 'application/json'];
		$merged = \array_merge($contentType, $this->defaultHeaders, $headers);

		$result = [];

		foreach($merged as $header => $value) {
			$result[] = "$header: $value";
		}

		return $result;
	}

	public function execute($method, $path, $data = NULL, $headers = [])
	{
		$url = $this->endpoint . $path;

		$ch = \curl_init();

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, TRUE);

		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

		$json = \json_encode($data);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $json);

		curl_setopt($ch, CURLOPT_HTTPHEADER, $this->getHeaders($headers));
		curl_setopt($ch, CURLOPT_HTTPHEADER, ['Expect:']);
		$response = curl_exec($ch);

		list($header, $body) = explode("\r\n\r\n", $response, 2);

		curl_close($ch);

		return \iInvoices\Api\ResponseParser::parse($body);
	}


}
