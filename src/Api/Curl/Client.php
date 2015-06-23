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

	public function __construct($config)
	{
		$baseUrl		 = $config['base_url'];
		$this->baseUrl	 = $baseUrl;
	}


	public function get($path, $headers = [])
	{
		$request	 = new Request('GET', $this->buildUrl($path), NULL, $headers, $this->buildCallbacks());
		$response	 = $request->send();

		return $response;
	}


	public function post($path, $data = [], $headers = [])
	{
		$request = new Request('POST', $this->buildUrl($path), $data, $headers, $this->buildCallbacks());

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
			'onBeforeRequest' => $this->onBeforeRequest
		];
	}


}
