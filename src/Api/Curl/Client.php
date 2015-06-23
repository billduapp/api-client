<?php

namespace iInvoices\Api\Curl;


/**
 * @author Martin Bažík <martin@bazo.sk>
 */
class Client
{

	/** @var string */
	private $baseUrl;

	/** @var array */
	public $onBeforeRequest = [];

	/** @var array */
	public $onBeforeResponse = [];

	public function __construct($config)
	{
		$baseUrl		 = $config['base_url'];
		$this->baseUrl	 = $baseUrl;
	}


	public function createRequest($method, $path, $data = [], $headers = [])
	{
		return new Request($method, $this->buildUrl($path), $data, $headers, $this->buildCallbacks());
	}


	public function get($path, $headers = [])
	{
		$request	 = $this->createRequest('GET', $path, NULL, $headers, $this->buildCallbacks());
		$response	 = $request->send();

		return $response;
	}


	public function post($path, $data = [], $headers = [])
	{
		$request = $this->createRequest('POST', $path, $data, $headers, $this->buildCallbacks());

		$response = $request->send();

		return $response;
	}


	private function buildUrl($path)
	{
		return $this->baseUrl . $path;
	}


	private function buildCallbacks()
	{
		return [
			'onBeforeRequest' => $this->onBeforeRequest,
			'onBeforeResponse' => $this->onBeforeResponse
		];
	}


}
