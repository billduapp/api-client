<?php

namespace iInvoices\Api;

use iInvoices\CurlClient;

/**
 * @author Martin Bažík <martin@bazo.sk>
 */
class ApiClient
{

	/** @var string */
	private $domain;

	/** @var string */
	private $apiKey;

	/** @var string */
	private $apiSecret;

	/** @var CurlClient */
	private $curl;

	/** @var \iInvoices\Api\Clients */
	public $clients;

	public function __construct($domain, $apiKey = NULL, $apiSecret = NULL)
	{
		$this->domain	 = $domain;
		$this->apiKey	 = $apiKey;
		$this->apiSecret = $apiSecret;

		$this->curl = new CurlClient($domain);
		$this->setDefaultCurlHeaders();

		$this->clients = new \iInvoices\Api\Clients($this->curl);
	}


	private function setDefaultCurlHeaders()
	{
		$this->curl->setDefaultHeaders([
			'apiKey'	 => $this->apiKey,
			'apiSecret'	 => $this->apiSecret
		]);
	}


	/**
	 * Change currently used apiKey and apiSecret
	 * @param string $apiKey
	 * @param string $apiSecret
	 * @return \iinvoices\ApiClient
	 */
	public function changeCredentials($apiKey, $apiSecret)
	{
		$this->apiKey	 = $apiKey;
		$this->apiSecret = $apiSecret;

		$this->setDefaultCurlHeaders();

		return $this;
	}


	public function listAllClients()
	{
		$response = $this->curl->execute(CurlClient::GET, '/clients');

		return $response;
	}


}
